<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $query = Coupon::query()->orderBy('id', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', '%'.$search.'%')
                    ->orWhere('coupon', 'like', '%'.$search.'%')
                    ->orWhere('price', 'like', '%'.$search.'%')
                    ->orWhere('start_date', 'like', '%'.$search.'%')
                    ->orWhere('end_date', 'like', '%'.$search.'%');
            });
        }

        $coupons = $query->paginate(10)->appends([
            'search' => $search,
        ]);

        return view('admin.coupon.index', [
            'coupons' => $coupons,
            'search' => $search,
        ]);
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);

        return view('admin.coupon.edit-page', compact('coupon'));
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'coupon' => 'required|string|unique:coupon,coupon',
            'price' => 'required|numeric|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', $validator->errors()->first())
                ->withInput();
        }

        $coupon = new Coupon;
        $coupon->coupon = strtoupper($request->coupon);
        $coupon->price = $request->price;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->one_time = $request->has('one_time') ? 'Yes' : 'No';
        $coupon->added_date = now();
        $coupon->added_by = Auth::id();
        $coupon->save();

        return redirect()->route('coupon.index')
            ->with('success', 'Coupon created successfully.');
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'coupon' => 'required|string|unique:coupon,coupon,'.$id,
            'price' => 'required|numeric|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', $validator->errors()->first())
                ->withInput();
        }

        $coupon = Coupon::findOrFail($id);

        $coupon->update([
            'coupon' => strtoupper($request->coupon),
            'last_modified_by' => Auth::id(),
            'last_modified_date' => Carbon::now()->format('Y-m-d'),
            'price' => $request->price,
            'end_date' => $request->end_date,
            'one_time' => $request->has('one_time') ? 'Yes' : 'No',
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
