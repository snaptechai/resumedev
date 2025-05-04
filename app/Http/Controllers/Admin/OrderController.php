<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
    $tab = $request->get('tab', 'all');
     
    $statusMap = [
        'all' => null,
        'pending' => 1,
        'completed' => 2,
        'accepted' => 3,
        'canceled' => 4,
        'rejected' => 5,
    ];

    $query = Order::query()->orderByDesc('added_date');

    if (!is_null($statusMap[$tab])) {
        $query->where('order_status', $statusMap[$tab]);
    }

    $Orders = $query->paginate(10);

    $writers = User::where('type','Writer')->get();

    return view('admin.order.index', compact('Orders', 'tab','writers'));
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
        return view('admin.order.show', compact('order'));
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
            'writer' => $request->writer_id,
            'order_status' => $request->order_status,
            'payment_status' => $request->payment_status,
            'last_modified_by' => Auth::id(),
            'last_modified_date' => Carbon::now()->format('yy-mm-dd'),
        ]);  

        return redirect()->back()->with('success', 'Coupon updated successfully.');
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
}