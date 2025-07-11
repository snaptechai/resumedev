<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Notification::query()->whereHas('order');

        if (!$user->hasPermission('View Admin Notifications')) {
            $query->where('to_id', $user->id);
        }

        if ($request->get('filter') === 'unread') {
            $query->where('status', 0);
        }

        $notifications = $query->orderBy('added_date', 'desc')->paginate(10);

        return view('admin.notification.index', compact('notifications'));
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
        $user = Auth::user();
        $not = Notification::findOrFail($id);

        if ($not->to_id == 1 || $user->id == $not->to_id) {
            $not->status = 1;
            $not->save();
        }

        return redirect()->route('orders.show', $not->order_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}