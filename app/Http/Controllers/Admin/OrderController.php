<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orderStatus = $request->get('order_status');

        $query = Order::query()->orderByDesc('id');

        if ($request->has('order_status')) {
            $query->where('order_status', $orderStatus);
        }

        $orders = $query->paginate(10);

        return view('admin.orders.index', [
            'orders' => $orders,
            'order_status' => $orderStatus,
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
                'created_at' => Carbon::parse($message->adate)->diffForHumans(),
                'attachments' => $message->attachment ? [$message->attachment] : [],
                'type' => $message->type,
                'show_templates' => $showTemplates,
            ];
        }

        $formattedMessages = collect($formattedMessages);

        return view('admin.orders.show', compact('order', 'formattedMessages', 'customer', 'paymentDetails', 'templates', 'templateCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            // 'writer' => $request->writer_id,
            'order_status' => $request->order_status,
            // 'payment_status' => $request->payment_status,
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
            Message::create([
                'oid' => $order->id,
                'fid' => Auth::id(),
                'tid' => $order->uid,
                'message' => 'your order delivered',
                'status' => 0,
                'type' => 'admin',
                'adate' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Order updated successfully.');
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

    public function storeMessage(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:10240',
        ]);

        $order = Order::findOrFail($id);
        $admin = Auth::user();

        $message = new Message;
        $message->oid = $order->id;
        $message->fid = $admin->id;
        $message->tid = $order->uid;
        $message->message = $request->message;
        $message->status = 0;
        $message->type = 'admin';
        $message->adate = now();

        if ($request->hasFile('attachment')) {
            $filePath = $request->file('attachment')->store('attachments', 'public');
            $message->attachment = $filePath;
        }

        $message->save();

        return redirect()->back()->with('success', 'Message sent successfully.');
    }
}
