<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('frontend.order.index', compact('orders'));
    }

    public function viewOrder($id)
    {
        $orders = Order::where('id', $id)->where('user_id', Auth::id())->first();
        return view('frontend.order.viewOrder', compact('orders'));
    }

    public function orderAccepted(Request $request, $id)
    {
        $orders = Order::findOrFail($id);
        $orders->status = $request->input('order_accepted');
        $orders->save();

        return redirect('/')->with('status', 'Order Accepted');
    }
}
