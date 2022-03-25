<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('status','0')->get();
        return view('admin.userorders.index', compact('orders'));
    }

    public function viewOrder($id)
    {
        $orders = Order::where('id', $id)->first();
        return view('admin.userorders.vieworder', compact('orders'));
    }

    public function orderDeliver(Request $request, $id)
    {
        $orders = Order::findOrFail($id);
        $orders->status = $request->input('orderDeliverStatus');
        $orders->save();
        
        return redirect('/user-orders')->with('status', 'Order is Delivering to the customer');
    }

    public function orderCancel(Request $request, $id)
    {
        $orders = Order::findOrFail($id);

        $orderItem = OrderItem::where('user_id', $orders->user_id)->get();
        foreach($orderItem as $item) {
            $product = Product::where('id', $item->prod_id)->first();
            $product->qty = $product->qty + $item->prod_qty;
            $product->save();
        }

        $orders->status = $request->input('orderCancelStatus');
        $orders->save();

        return redirect('/user-orders')->with('status', 'Order cancel');
    }

    public function orderHistory()
    {
        $orders = Order::where('status', '!=', '3')->get();
        return view('admin.userorders.orderhistory', compact('orders'));
    }
}