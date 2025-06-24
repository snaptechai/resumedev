<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Order;
use App\Models\OrderAdminFile;
use App\Models\OrderAttachment;
use App\Models\Payment;
use App\Models\Template;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $orderStatus = $request->get('order_status');
        $search = $request->get('search');

        $query = Order::query()->orderByDesc('id');

        if ($orderStatus) {
            $query->where('order_status', $orderStatus);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', '%'.$search.'%')
                    ->orWhereHas('user', function ($q2) use ($search) {
                        $q2->where('full_name', 'like', '%'.$search.'%');
                    })
                    ->orWhereHas('assignedWriter', function ($q3) use ($search) {
                        $q3->where('full_name', 'like', '%'.$search.'%');
                    });
            });
        }

        $orders = $query->paginate(10)->appends([
            'order_status' => $orderStatus,
            'search' => $search,
        ]);

        return view('admin.orders.index', [
            'orders' => $orders,
            'order_status' => $orderStatus,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        $files = OrderAdminFile::where('oid',$id)->get();
        $messages = Message::where('oid', $id)
            ->orderBy('adate', 'asc')
            ->get();

        $customer = User::find($order->uid);
        $paymentDetails = Payment::where('order_id', $id)->first();

        $templates = \App\Models\Template::where('is_active', 1)->get();
        $templateCount = $templates->count();

        $formattedMessages = [];
        foreach ($messages as $message) {
            $sender = User::find($message->fid);
            $senderName = $sender ? $sender->full_name : 'Unknown';
            $side = ($message->fid == $order->uid) ? 'left' : 'right';

            $showTemplates = false;
            if (stripos($message->message, 'please tell us your preferred template from the options below') !== false) {
                $showTemplates = true;
            }

            $formattedMessages[] = [
                'id' => $message->id,
                'message' => $message->message,
                'side' => $side,
                'user' => $senderName,
                'created_at' => $message->adate,
                'attachments' => $message->attachment ? [$message->attachment] : [],
                'type' => $message->type,
                'show_templates' => $showTemplates,
            ];
        }

        $formattedMessages = collect($formattedMessages);

        return view('admin.orders.show', compact('order', 'formattedMessages', 'customer', 'paymentDetails', 'templates', 'templateCount','files'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update_admin_note(Request $request,string $id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'admin_note' => $request->admin_note,
            'last_modified_by' => Auth::id(),
            'last_modified_date' => Carbon::now()->format('Y-m-d'),
        ]);
        return redirect()->back()->with('success', 'Admin Note updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        $validator = validator($request->all(), [
            'writer' => 'nullable',
            'order_status' => 'required',
        ]);

        if ($request->order_status == 4) {
            $validator = validator($request->all(), [
                'completion_files' => 'required|array',
                'completion_files.*' => 'file|max:10240',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Please attach the completed files before marking the order as completed.');
            }
        }

        $oldOrderStatus = $order->order_status;

        $order->update([
            'writer' => $request->writer,
            'order_status' => $request->order_status,
            'last_modified_by' => Auth::id(),
            'last_modified_date' => Carbon::now()->format('Y-m-d'),
        ]);

        if ($request->order_status == 2) {
            Message::create([
                'oid' => $order->id,
                'fid' => Auth::id(),
                'tid' => $order->uid,
                'message' => 'you submitted the requirements',
                'status' => 0,
                'type' => 'admin',
                'adate' => now(),
            ]);
        } elseif ($request->order_status == 3) {
            if ($oldOrderStatus == 1) {
                Message::create([
                    'oid' => $order->id,
                    'fid' => Auth::id(),
                    'tid' => $order->uid,
                    'message' => 'you submitted the requirements',
                    'status' => 0,
                    'type' => 'admin',
                    'adate' => now(),
                ]);
            }

            Message::create([
                'oid' => $order->id,
                'fid' => Auth::id(),
                'tid' => $order->uid,
                'message' => 'your order started',
                'status' => 0,
                'type' => 'admin',
                'adate' => now(),
            ]);
        } elseif ($request->order_status == 4) {
            $fileAttachments = [];
            $attachmentPaths = [];

            if ($request->hasFile('completion_files')) {
                $attachmentPaths = [];
                $fileAttachments = [];

                $message = new Message;
                $message->oid = $order->id;
                $message->fid = Auth::id();
                $message->tid = $order->uid;
                $message->message = 'Order completed with attachments.';
                $message->status = 0;
                $message->type = 'admin';
                $message->adate = now();
                $message->save();

                foreach ($request->file('completion_files') as $file) {
                    $originalFilename = $file->getClientOriginalName();
                    $timestamp = time();
                    $newFilename = $timestamp . '_' . $originalFilename;

                    $filePath = $file->storeAs(
                        'order_completions/' . $order->id,
                        $newFilename,
                        'public'
                    );

                    $attachmentPaths[] = $filePath;
                    $fileAttachments[] = $filePath;

                    $OrderAttachment = new OrderAttachment;
                    $OrderAttachment->order_id = $order->id;
                    $OrderAttachment->message_id = $message->id;
                    $OrderAttachment->file_name = $originalFilename;
                    $OrderAttachment->file_path = $filePath;
                    $OrderAttachment->save();
                }
            }

            Message::create([
                'oid' => $order->id,
                'fid' => Auth::id(),
                'tid' => $order->uid,
                'message' => 'your order delivered',
                'status' => 0,
                'type' => 'admin',
                'adate' => now(),
            ]);

            $email = $order->user->username;

            Mail::to($email)->queue(new \App\Mail\OrderReady($order, $fileAttachments));
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        return redirect()->back()->with('error', 'Order Removed successfully.');
    }

    // public function storeMessage(Request $request, $id)
    // {
    //     $request->validate([
    //         'message' => 'nullable|string',
    //         'attachment' => 'nullable|file|max:20480',
    //     ]);

    //     if (empty($request->message) && !$request->hasFile('attachment')) {
    //         return redirect()->back()->with('error', 'Please provide either a message or an attachment.');
    //     }
    //     $order = Order::findOrFail($id);
    //     $admin = Auth::user();

    //     $message = new Message;
    //     $message->oid = $order->id;
    //     $message->fid = $admin->id;
    //     $message->tid = $order->uid;
    //     $message->message = $request->message ?? '';
    //     $message->status = 0;
    //     $message->type = 'admin';
    //     $message->adate = now();

    //     if ($request->hasFile('attachment')) {
    //         $file = $request->file('attachment');
    //         $originalFilename = $file->getClientOriginalName();
    //         $timestamp = time();
    //         $newFilename = $timestamp . '_' . $originalFilename;
    //         $filePath = $file->storeAs(
    //             'attachments/' . $order->id, 
    //             $newFilename, 
    //             'public'
    //         );
    //         $message->attachment = $filePath;
    //     }

    //     if ($message->save()) {
    //         Message::where('oid', $order->id)
    //             ->where('type', 'user')
    //             ->update(['status' => 1]);
    //     }

    //     $email = $order->user->username;

    //     Mail::to($email)->queue(new \App\Mail\NewMessage($message, $order));

    //     return redirect()->back();
    // }

    public function storeMessage(Request $request, $id)
    {
        $request->validate([
            'message' => 'nullable|string',
            'attachment.*' => 'nullable|file|max:20480',
        ]);

        if (empty($request->message) && !$request->hasFile('attachment')) {
            return redirect()->back()->with('error', 'Please provide either a message or an attachment.');
        }

        $order = Order::findOrFail($id);
        $admin = Auth::user();

        $message = new Message;
        $message->oid = $order->id;
        $message->fid = $admin->id;
        $message->tid = $order->uid;
        $message->message = $request->message ?? '';
        $message->status = 0;
        $message->type = 'admin';
        $message->adate = now();
        $message->save();
 
        if ($request->hasFile('attachment')) {
            foreach ($request->file('attachment') as $file) {
                $originalFilename = $file->getClientOriginalName();
                $timestamp = time();
                $newFilename = $timestamp . '_' . $originalFilename;

                $filePath = $file->storeAs(
                    'order_attachments/' . $order->id,
                    $newFilename,
                    'public'
                );
                $OrderAttachment = new OrderAttachment;
                $OrderAttachment->order_id = $order->id;
                $OrderAttachment->message_id = $message->id;
                $OrderAttachment->file_name = $originalFilename;
                $OrderAttachment->file_path = $filePath;
                $OrderAttachment->save();
            }
        }
 
        Message::where('oid', $order->id)
            ->where('type', 'user')
            ->update(['status' => 1]);

        $email = $order->user->username;
        Mail::to($email)->queue(new \App\Mail\NewMessage($message, $order));

        return redirect()->back()->with('success', 'Message and attachments sent successfully.');
    }


    public function getMessages(string $id)
    {
        $order = Order::findOrFail($id);
        $messages = Message::where('oid', $id)
            ->with('attachments')
            ->orderBy('adate', 'asc')
            ->get();

        $customer = User::find($order->uid);
        $templates = Template::where('is_active', 1)->get();
        $templateCount = $templates->count();

        $formattedMessages = [];
        foreach ($messages as $message) {
            $sender = User::find($message->fid);
            $senderName = $sender ? $sender->full_name : 'Unknown';
            $side = ($message->fid == $order->uid) ? 'left' : 'right';

            $showTemplates = false;
            if (stripos($message->message, 'please tell us your preferred template from the options below') !== false) {
                $showTemplates = true;
            }
            $attachments = $message->attachments->map(function ($attachment) {
                return $attachment->file_path;
            })->toArray();

            $formattedMessages[] = [
                'id' => $message->id,
                'message' => $message->message,
                'side' => $side,
                'user' => $senderName,
                'adate' => Carbon::parse($message->adate)->format('M d, Y'),
                'created_at' => Carbon::parse($message->adate)->diffForHumans(),
                'attachments' =>   $attachments,
                'type' => $message->type,
                'show_templates' => $showTemplates,
            ];
        }

        $formattedMessages = collect($formattedMessages);
 
        $html = view('admin.orders.partials.messages', compact(
            'formattedMessages', 
            'templates', 
            'templateCount'
        ))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'messageCount' => $formattedMessages->count(),
            'lastMessageId' => $formattedMessages->last()['id'] ?? null
        ]);
    }

    public function uploadAdminNoteFile(Request $request, $orderId)
    {
        $request->validate([
            'admin_note_attachment' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,xlsx,xls,txt|max:5120'
        ]);

        $file = $request->file('admin_note_attachment');
 
        $extension = $file->getClientOriginalExtension();
        $random = Str::random(4);
        $filename = "rm_{$orderId}_{$random}." . $extension;
 
        $path = $file->storeAs('admin_files', $filename, 'public');
 
        OrderAdminFile::create([
            'oid' => $orderId,
            'file_path' => $path,
            'added_by' => Auth::id(),
            'added_date' => now()
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully!');
    }

    public function deleteAdminNoteFile($orderId, $fileId)
    {
        $file = \App\Models\OrderAdminFile::where('oid', $orderId)->where('id', $fileId)->firstOrFail();
        
        if (Storage::disk('public')->exists($file->file_path)) {
            Storage::disk('public')->delete($file->file_path);
        }
        
        $file->delete();

        return redirect()->back()->with('success', 'File deleted successfully!');
    }


}