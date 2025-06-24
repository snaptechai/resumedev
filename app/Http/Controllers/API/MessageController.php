<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Order;
use App\Models\OrderAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function getMessages($orderId)
    {
        $order = Order::find($orderId);
        if (! $order) {
            return response()->json([
                'http_status' => 404,
                'http_status_message' => 'Not Found',
                'message' => 'Order not found',
            ], 404);
        }

        $user = Auth::user();
        if ($order->uid != $user->id) {
            return response()->json([
                'http_status' => 403,
                'http_status_message' => 'Forbidden',
                'message' => 'You do not have permission to view these messages',
            ], 403);
        }

        $messages = Message::where('oid', $orderId)
            ->orderBy('adate', 'desc')
            ->get();

        $formattedMessages = [];
        foreach ($messages as $message) {
            $side = ($message->fid == $user->id) ? 'right' : 'left';

            $senderName = ($message->fid == $user->id) ? 'You' : 'Resume Mansion';

            $attachments = OrderAttachment::where('message_id', $message->id)
                ->get()
                ->map(function ($attachment) {
                    return [
                        'url' => asset('storage/' . $attachment->file_path),
                        'name' => $attachment->file_name,
                    ];
                });

            $formattedMessages[] = [
                'id' => $message->id,
                'message' => $message->message,
                'side' => $side,
                'user' => $senderName,
                'created_at' => date('Y-m-d H:i:s', strtotime($message->adate)),
                'attachments' => $attachments,
            ];
        }

        return response()->json([
            'http_status' => 200,
            'http_status_message' => 'Success',
            'messages' => $formattedMessages,
        ], 200);
    }

    public function postMessage(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:order,id',
            'message' => 'nullable|string',
            // 'attachment' => 'nullable|file|max:10240',
        ]);

        $order = Order::find($request->order_id);
        if (! $order) {
            return response()->json([
                'http_status' => 404,
                'http_status_message' => 'Not Found',
                'message' => 'Order not found',
            ], 404);
        }

        $user = Auth::user();
        if ($order->uid != $user->id) {
            return response()->json([
                'http_status' => 403,
                'http_status_message' => 'Forbidden',
                'message' => 'You do not have permission to post messages to this order',
            ], 403);
        }

        $message = new Message;
        $message->oid = $request->order_id;
        $message->fid = $user->id;
        $message->tid = 1;
        $message->message = $request->message ? $request->message : '';
        $message->status = 0;
        $message->type = 'user';
        $message->adate = now();

        if (str_contains($request->message, "I would like to request a modification for my resume.")) {
            $order->order_status = 3;
            $order->save();
            Message::create([
                'oid' => $order->id,
                'fid' => 1,
                'tid' => $order->uid,
                'message' => 'you requested revision',
                'status' => 0,
                'type' => 'admin',
                'adate' => now()->addSeconds(5),
            ]);
        }

        $message->save();

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $originalFilename = $file->getClientOriginalName();
                $timestamp = time();
                $newFilename = $timestamp . '_' . $originalFilename;
                $filePath = $file->storeAs(
                    'attachments/' . $order->id,
                    $newFilename,
                    'public'
                );

                OrderAttachment::create([
                    'order_id' => $order->id,
                    'message_id' => $message->id,
                    'file_name' => $originalFilename,
                    'file_path' => $filePath,
                ]);
            }
        }

        return response()->json([
            'http_status' => 201,
            'http_status_message' => 'Created',
            'message' => 'Message sent successfully',
            'data' => $message,
        ], 201);
    }
}
