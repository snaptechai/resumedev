<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::orderBy('id', 'desc')->paginate(10);

        return view('admin.coupon.index', compact('coupons'));
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);

        return view('admin.coupon.edit-page', compact('coupon'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'coupon' => 'required|string|unique:coupon,coupon',
            'price' => 'required|numeric|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $coupon = new Coupon;
        $coupon->coupon = strtoupper($request->coupon);
        $coupon->price = $request->price;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->one_time = $request->has('one_time') ? 1 : 0;
        $coupon->added_by = Auth::id();
        $coupon->added_date = Carbon::now()->format('Y-m-d');
        $coupon->save();

        return redirect()->route('coupon.index')
            ->with('success', 'Coupon created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'coupon' => 'required|string|unique:coupon,coupon,'.$id,
            'price' => 'required|numeric|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $coupon = Coupon::findOrFail($id);

        $coupon->update([
            'coupon' => strtoupper($request->coupon),
            'last_modified_by' => Auth::id(),
            'last_modified_date' => Carbon::now()->format('Y-m-d'),
            'price' => $request->price,
            'end_date' => $request->end_date,
            'one_time' => $request->has('one_time') ? 1 : 0,
            'start_date' => $request->start_date,
        ]);

        return redirect()->route('coupon.index')
            ->with('success', 'Coupon updated successfully.');
    }

    public function destroy(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('coupon.index')
            ->with('success', 'Coupon deleted successfully.');
    }
}
