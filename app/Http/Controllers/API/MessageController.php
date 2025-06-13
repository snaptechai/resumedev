<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Order;
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

            $formattedMessages[] = [
                'id' => $message->id,
                'message' => $message->message,
                'side' => $side,
                'user' => $senderName,
                'created_at' => date('Y-m-d H:i:s', strtotime($message->adate)),
                'attachments' => $message->attachment ? collect([
                    [
                        'url' => asset('storage/'.$message->attachment),
                        'name' => basename($message->attachment),
                    ],
                ]) : collect([]),
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

        if ($request->hasFile('attachment')) {
            $filePath = $request->file('attachment')->store('attachments', 'public');
            $message->attachment = $filePath;
        }

        $message->save();

        return response()->json([
            'http_status' => 201,
            'http_status_message' => 'Created',
            'message' => 'Message sent successfully',
            'data' => $message,
        ], 201);
    }
}
