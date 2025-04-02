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
        $coupons = Coupon::paginate(10);
        return view('admin.coupon.index', compact('coupons'));
    } 

    public function store(Request $request)
    {
        $coupon = new Coupon();
        $coupon->coupon = strtoupper($request->coupon);
        $coupon->price = $request->price;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->one_time = $request->has('one_time') ? 'yes' : 'no';
        $coupon->added_by = Auth::id();
        $coupon->added_date = Carbon::now()->format('yy-mm-dd');
        $coupon->save();

        return redirect()->route('coupon.index')
            ->with('success', 'Coupon created successfully.');
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id); 

        $coupon->update([
            'coupon'=> strtoupper($request->coupon),
            // 'used_by' => $request->price, 
            'last_modified_by' => Auth::id(),
            'last_modified_date' => Carbon::now()->format('yy-mm-dd'),
            'price' => $request->price,
            'end_date' => $request->end_date,
            'one_time' => $request->has('one_time') ? 'yes' : 'no',
            'start_date' => $request->start_date
        ]); 

        return redirect()->route('coupon.index')
            ->with('success', 'Coupon updated successfully.');
    }
    
    public function destroy(string $id)
    {
        $coupon = Coupon::findOrFail($id);

        $coupon->delete();

        return redirect()->route('coupon.index')->with('error', 'Coupon successfully Removed.');
    } 
}