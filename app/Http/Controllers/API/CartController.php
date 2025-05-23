<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\Order_Email;
use App\Models\Addon;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderPackage;
use App\Models\Package;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function getCoupon(Request $request)
    {
        $coupon = $request->get('coupon');
        if (! isset($coupon)) {
            return response()->json([
                'http_status' => 400,
                'http_status_message' => 'Bad Request',
                'message' => 'Enter the Coupon',
            ], 400);
        }
        $date = date('Y-m-d');
        $check = DB::table('coupon')->where('coupon', $coupon)
            ->where('start_date', '<=', $date)
            ->where('end_date', '>=', $date)
            ->where(function ($query) {
                $query->whereNull('one_time')
                    ->orWhere(function ($query) {
                        $query->whereNotNull('one_time')
                            ->whereNull('used_by');
                    });
            })
            ->first();

        if (isset($check)) {
            return response()->json([
                'http_status' => 200,
                'http_status_message' => 'Success',
                'message' => 'Coupon Available',
                'data' => $check,
            ], 200);
        } else {
            return response()->json([
                'http_status' => 404,
                'http_status_message' => 'Not Found',
                'message' => 'Coupon Not Found',
            ], 404);
        }
    }

    public function addCart(Request $request)
    {

        $input = $request->except('_token');
        $input['order_status'] = 1;

        $user = auth()->user()->id;

        $input['location_id'] = 1;
        $order = Order::where('order_status', 1)->where('uid', $user)->first();
        $package = Package::where('id', $input['package_id'])->first();

        if (! isset($order)) {
            $order = new Order;
        } else {
            OrderPackage::where('oid', $order->id)->delete();
            $order->total_price = 0;
            $order->save();
        }

        $order->uid = $user;
        $order->package_id = $input['package_id'];
        $order->added_by = $user;
        $order->added_date = date('Y-m-d');
        $order->end_date = date('Y-m-d');
        $order->payment_status = 'pending';
        $order->order_status = 1;
        $order->total_price = isset($package) ? $package->price : 0;
        $order->currency_symbol = '$';
        $order->currency = 'usd';
        $order->coupon = null;
        $order->save();

        $toEmail = auth()->user()->username;
        $maildata = ['name' => auth()->user()->full_name, 'order' => $order];
        Mail::to($toEmail)->queue(new Order_Email($maildata));

        $data['order'] = $order;

        return response()->json([
            'http_status' => 200,
            'http_status_message' => 'Success',
            'data' => $data,
        ], 200);
    }

    public function getCart()
    {
        $user = auth()->user()->id;
        $input['location_id'] = 1;

        $transaction = Order::where('order_status', 1)->where('uid', $user)->first();

        $lines = [];

        if (isset($transaction)) {
            $order_lines = OrderPackage::where('oid', $transaction->id)->get();
            $package = DB::table('package')->where('id', $transaction->package_id)->first();
            $lines = [
                'order_id' => $transaction->id,
                'total' => (string) $transaction->total_price,
                'currency_code' => $transaction->currency_symbol,
                'package_id' => $transaction->package_id,
                'package' => $package->title,
                'package_price' => (string) $package->price,
                'short_description' => $package->short_description,
                'lines' => [],
            ];
            foreach ($order_lines as $line) {
                $addon = DB::table('addons')->where('id', $line->addon_id)->first();
                $data = [
                    'line_id' => $line->id,
                    'addon_id' => $line->addon_id,
                    'addon' => isset($addon) ? $addon->title : '',
                    'description' => isset($addon) ? $addon->description : '',
                    'quantity' => $line->quantity,
                    'price' => (string) $line->price ?? '0,00',
                ];

                array_push($lines['lines'], $data);
            }
        }

        if (! isset($transaction)) {
            return response()->json([
                'transaction_id' => 0,
                'total_amount' => 0,
                'data' => [],
                'message' => 'Cart is empty',
            ], 200);
        } else {
            return response()->json([
                'http_status' => 200,
                'http_status_message' => 'Success',
                'transaction_id' => $transaction->id,
                'data' => $lines,
            ], 200);
        }
    }

    public function update(Request $request)
    {
        $input = $request->except('_token');
        $order_id = $request->order_id;
        $addon = Addon::find($input['addon_id']);
        $transaction = Order::find($order_id);
        $addon_price = $input['quantity'] * $addon->price;
        $transaction->total_price = $addon_price + $transaction->total_price;
        $transaction->save();
        $package = OrderPackage::where('addon_id', $input['addon_id'])->where('oid', $order_id)->first();
        if (! isset($package)) {
            $package = new OrderPackage;
        }

        $package->oid = $transaction->id;
        $package->pid = $transaction->package_id;
        $package->addon_id = $input['addon_id'];
        $package->quantity = $input['quantity'];
        $package->price = $addon->price;
        $package->created_at = now();
        $package->save();

        $lines = [];
        if (isset($transaction)) {
            $order_lines = OrderPackage::where('oid', $transaction->id)->get();
            $package = DB::table('package')->where('id', $transaction->package_id)->first();
            $lines = [
                'order_id' => $transaction->id,
                'total' => (string) $transaction->total_price,
                'currency_code' => $transaction->currency_symbol,
                'package_id' => $transaction->package_id,
                'package' => isset($package) ? $package->title : '',
                'lines' => [],
            ];
            foreach ($order_lines as $line) {
                $addon = DB::table('addons')->where('id', $line->addon_id)->first();
                $data = [
                    'line_id' => $line->id,
                    'addon_id' => $line->addon_id,
                    'addon' => isset($addon) ? $addon->title : '',
                    'description' => isset($addon) ? $addon->description : '',
                    'quantity' => $line->quantity,
                    'price' => (string) $line->price ?? '0,00',
                ];

                array_push($lines['lines'], $data);

            }
        }

        return response()->json([
            'http_status' => 200,
            'http_status_message' => 'Success',
            'transaction_id' => $transaction->id,
            'data' => $lines,
            'message' => 'Success Updated',
        ], 200);
    }

    public function delete($id)
    {
        $line = OrderPackage::find($id);

        if (isset($line)) {
            $order_id = $line->oid;
            $line_price = $line->price * $line->quantity;
            $order = Order::find($order_id);
            $order->total_price = $order->total_price - $line_price;
            $order->save();
            $line->delete();

            return response()->json([
                'http_status' => 200,
                'http_status_message' => 'Success',
                'message' => 'Success Deleted',
            ], 200);

        }

        return response()->json([
            'http_status' => 404,
            'http_status_message' => 'warning',
            'message' => 'Bad Request',
        ], 404);
    }

    public function clear(Request $request)
    {
        $user = auth()->user()->id;
        $order = Order::where('order_status', 1)->where('uid', $user)->first();
        if (isset($order)) {
            OrderPackage::where('oid', $order->id)->delete();
            $order->delete();

            return response()->json([
                'http_status' => 200,
                'http_status_message' => 'Success',
                'message' => 'Success Deleted',
            ], 200);

        }

        return response()->json([
            'http_status' => 404,
            'http_status_message' => 'warning',
            'message' => 'Bad Request',
        ], 404);

    }

    public function post(Request $request)
    {
        $order_id = $request->order_id;
        $user = auth()->user()->id;
        $transaction = Order::find($order_id);

        if (isset($transaction) && $transaction->payment_status !== 'paid') {
            $transaction->coupon = $request->coupon_id;
            $transaction->save();

            $sub_total = $transaction->total_price;

            if (isset($request->coupon_id)) {
                $coupon = Coupon::find($request->coupon_id);
                $sub_total = $sub_total - $coupon->price;
            }

            $transaction->total_price = $sub_total;
            $transaction->save();

            $paid = Payment::where('order_id', $transaction->id)->sum('amount');

            $due = $transaction->total_price - $paid;

            if ($request->payment_method_id) {
                $stripe = new \Stripe\StripeClient('sk_test_51LzZb5Fp8KE7uxpzr67sAT2BfstMXudx3uRHozPJPKZAhyEQbGEm7bvQAg9oLl6CDsghApc6dCKzpoXJZ8eaHU2Y00EHwAfclJ');

                $paymentIntent = $stripe->paymentIntents->create([
                    'amount' => $due * 100,
                    'currency' => 'usd',
                    'payment_method_types' => ['card'],
                    'payment_method' => $request->payment_method_id,
                    'confirm' => true,
                ]);

                $transaction->order_status = '1';
                $transaction->payment_status = 'paid';
                $transaction->save();

                $payment = new Payment;
                $payment->order_id = $transaction->id;
                $payment->amount = $due;
                $payment->transaction_id = $paymentIntent->id;
                $payment->save();

                $writer = User::where('type', 'Writer')
                    ->leftJoin('order', function ($join) {
                        $join->on('user.id', '=', 'order.writer')
                            ->whereNotIn('order.order_status', [4, 5]);
                    })
                    ->select('user.id')
                    ->groupBy('user.id')
                    ->orderByRaw('COUNT(order.id) ASC')
                    ->first();

                if ($writer) {
                    $transaction->writer = $writer->id;
                    $transaction->save();
                }
            }
            $lines = [];
            if (isset($transaction)) {
                $order_lines = OrderPackage::where('oid', $transaction->id)->get();
                $package = DB::table('package')->where('id', $transaction->package_id)->first();
                $lines = [
                    'order_id' => $transaction->id,
                    'total' => (string) $transaction->total_price,
                    'currency_code' => $transaction->currency_symbol,
                    'package_id' => $transaction->package_id,
                    'package' => isset($package) ? $package->title : '',
                    'lines' => [],
                ];
                foreach ($order_lines as $line) {
                    $addon = DB::table('addons')->where('id', $line->addon_id)->first();
                    $data = [
                        'line_id' => $line->id,
                        'addon_id' => $line->addon_id,
                        'addon' => isset($addon) ? $addon->title : '',
                        'description' => isset($addon) ? $addon->description : '',
                        'quantity' => $line->quantity,
                        'price' => (string) $line->price ?? '0,00',
                    ];

                    array_push($lines['lines'], $data);
                }
            }

            return response()->json([
                'http_status' => 200,
                'http_status_message' => 'Success',
                'message' => 'Added Successfully',
                'data' => $lines,
            ], 200);
        }

        return response()->json([
            'http_status' => 404,
            'http_status_message' => 'Warning',
            'message' => 'Transaction not Found',
        ], 404);
    }

    public function getPrevious()
    {
        $user = auth()->user()->id;
        $transactions = Order::where('uid', $user)->get();
        $orders = [];
        foreach ($transactions as $transaction) {
            $order_lines = OrderPackage::where('oid', $transaction->id)->distinct()->pluck('pid')->toArray();
            $package = DB::table('package')->whereIn('id', $order_lines)->first();
            $status = DB::table('order_setps')->where('id', $transaction->order_status)->first();

            $lines = [
                'order_id' => $transaction->id,
                'name' => isset($package) ? $package->title : '',
                'ID' => 'ORDER #'.$transaction->id,
                'status' => isset($status) ? $status->step : '',
            ];
            array_push($orders, $lines);
        }

        return response()->json([
            'http_status' => 200,
            'http_status_message' => 'Success',
            'data' => $orders,
        ], 200);
    }

    public function currentOrder()
    {
        $user = auth()->user()->id;
        $transaction = Order::orderBy('id', 'DESC')->whereNotIn('order_status', [5])->where('uid', $user)->first();

        $lines = [];
        if (isset($transaction)) {
            $order_lines = OrderPackage::where('oid', $transaction->id)->get();
            $package = DB::table('package')->where('id', $transaction->package_id)->first();
            $lines = [
                'order_id' => $transaction->id,
                'total' => (string) $transaction->total_price,
                'currency_code' => $transaction->currency_symbol,
                'package_id' => $transaction->package_id,
                'package' => isset($package) ? $package->title : '',
                'lines' => [],
                'status' => $transaction->order_status,
                'created_at' => $transaction->added_date,
            ];
            foreach ($order_lines as $line) {
                $addon = DB::table('addons')->where('id', $line->addon_id)->first();
                $data = [
                    'line_id' => $line->id,
                    'addon_id' => $line->addon_id,
                    'addon' => isset($addon) ? $addon->title : '',
                    'description' => isset($addon) ? $addon->description : '',
                    'quantity' => $line->quantity,
                    'price' => (string) $line->price ?? '0,00',
                ];

                array_push($lines['lines'], $data);

            }
        }

        return response()->json([
            'http_status' => 200,
            'http_status_message' => 'Success',
            'message' => 'Success',
            'data' => $lines,
        ], 200);
    }

    public function updateCurrentOrder(Request $request)
    {
        $input = $request->except('_token');
        $order_id = $request->order_id;
        $addon = Addon::find($input['addon_id']);
        $transaction = Order::find($order_id);
        $addon_price = $input['quantity'] * $addon->price;
        $transaction->total_price = $addon_price + $transaction->total_price;
        $transaction->payment_status = 'partial';
        $transaction->save();
        $package = OrderPackage::where('addon_id', $input['addon_id'])->where('oid', $order_id)->first();
        if (! isset($package)) {
            $package = new OrderPackage;
        }

        $package->oid = $transaction->id;
        $package->pid = $transaction->package_id;
        $package->addon_id = $input['addon_id'];
        $package->quantity = $package->quantity + $input['quantity'];
        $package->price = $package->price + $addon_price;
        $package->save();
        $paid = Payment::where('order_id', $transaction->id)->sum('amount');
        $due = $transaction->total_price - $paid;
        if ($request->payment_method_id) {
            $stripe = new \Stripe\StripeClient('sk_test_51LzZb5Fp8KE7uxpzr67sAT2BfstMXudx3uRHozPJPKZAhyEQbGEm7bvQAg9oLl6CDsghApc6dCKzpoXJZ8eaHU2Y00EHwAfclJ');

            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => $due * 100,
                'currency' => 'usd',
                'payment_method_types' => ['card'],
                'payment_method' => $request->payment_method_id,
                'confirm' => true,
            ]);

            $transaction->order_status = '1';
            $transaction->payment_status = 'paid';
            $transaction->save();

            $payment = new Payment;
            $payment->order_id = $transaction->id;
            $payment->amount = $due;
            $payment->transaction_id = $paymentIntent->id;
            $payment->save();
        }

        $lines = [];
        if (isset($transaction)) {
            $order_lines = OrderPackage::where('oid', $transaction->id)->get();
            $package = DB::table('package')->where('id', $transaction->package_id)->first();
            $lines = [
                'order_id' => $transaction->id,
                'total' => (string) $transaction->total_price,
                'currency_code' => $transaction->currency_symbol,
                'package_id' => $transaction->package_id,
                'package' => isset($package) ? $package->title : '',
                'lines' => [],
            ];
            foreach ($order_lines as $line) {
                $addon = DB::table('addons')->where('id', $line->addon_id)->first();
                $data = [
                    'line_id' => $line->id,
                    'addon_id' => $line->addon_id,
                    'addon' => isset($addon) ? $addon->title : '',
                    'description' => isset($addon) ? $addon->description : '',
                    'quantity' => $line->quantity,
                    'price' => (string) $line->price ?? '0,00',
                ];

                array_push($lines['lines'], $data);

            }
        }

        return response()->json([
            'http_status' => 200,
            'http_status_message' => 'Success',
            'transaction_id' => $transaction->id,
            'data' => $lines,
            'message' => 'Success Updated',
        ], 200);
    }

    public function getDetails($order_id)
    {
        $transaction = Order::find($order_id);
        $lines = [];
        if (isset($transaction)) {
            $order_lines = OrderPackage::where('oid', $transaction->id)->get();
            $package = DB::table('package')->where('id', $transaction->package_id)->first();
            $lines = [
                'order_id' => $transaction->id,
                'total' => (string) $transaction->total_price,
                'currency_code' => $transaction->currency_symbol,
                'package_id' => $transaction->package_id,
                'package' => isset($package) ? $package->title : '',
                'lines' => [],
            ];
            foreach ($order_lines as $line) {
                $addon = DB::table('addons')->where('id', $line->addon_id)->first();
                $data = [
                    'line_id' => $line->id,
                    'addon_id' => $line->addon_id,
                    'addon' => isset($addon) ? $addon->title : '',
                    'description' => isset($addon) ? $addon->description : '',
                    'quantity' => $line->quantity,
                    'price' => (string) $line->price ?? '0,00',
                ];

                array_push($lines['lines'], $data);

            }
        }

        return response()->json([
            'http_status' => 200,
            'http_status_message' => 'Success',
            'data' => $lines,
        ], 200);
    }
}
