<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $messages = collect();

        if ($user->id == 1) {
            $latestMessageIds = Message::selectRaw('MAX(id) as id')
                ->where('status', '0')
                ->where('type', 'user')
                ->groupBy('oid');

            $messages = Message::whereIn('id', $latestMessageIds)
                ->orderByDesc('id')
                ->paginate(10);
        } else {
            $orderIds = Order::where('writer', $user->id)->pluck('id');

            if ($orderIds->isNotEmpty()) {
                $latestMessageIds = Message::selectRaw('MAX(id) as id')
                    ->where('status', '0')
                    ->where('type', 'user')
                    ->whereIn('oid', $orderIds)
                    ->groupBy('oid');

                $messages = Message::whereIn('id', $latestMessageIds)
                    ->orderByDesc('id')
                    ->paginate(10);
            }
        }

        return view('admin.notification.index', compact('messages'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}