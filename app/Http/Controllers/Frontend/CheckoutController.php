<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ConfirmOrderRequest;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Auth::check()) {

            if ($cartItems = Cart::where('user_id', Auth::id())) {

                $old_cartItems = Cart::where('user_id', Auth::id())->get();
                foreach($old_cartItems as $item) {
                    if (!Product::where('id',$item->prod_id)->where('qty', '>=', $item->prod_qty)->exists()) {
                        $removeItem = Cart::where('user_id',Auth::id())->where('prod_id',$item->prod_id)->first();
                        $removeItem->delete();
                    }
                }
                $cartItems = Cart::where('user_id',Auth::id())->get();
                return view('frontend.checkout', compact('cartItems'));

            } else {

                return redirect('/cart')->with('status', "This Product is'nt exit in cart");

            }
        } else {

            return redirect('/')->with('status', "Login to Continue");

        }
    }

    public function placeOrder(ConfirmOrderRequest $request)
    {
        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');

        // Total Price
        $total = 0;
        $cartItems_total = Cart::where('user_id', Auth::id())->get();
        foreach($cartItems_total as $item) {
            $total += $item->cartProduct->selling_price;
        }
        $order->total_price = $total;

        $order->address1 = $request->input('address1');
        $order->address2 = $request->input('address2');
        $order->country = $request->input('country');
        $order->state = $request->input('state');
        $order->city = $request->input('city');
        $order->pin_code = $request->input('pin_code');
        $order->tracking_no = 'Rainbow'.rand(11111,99999);
        $order->save();

        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach($cartItems as $item) {
            OrderItem::create([
                'user_id' => $item->user_id,
                'order_id' => $order->id,
                'prod_id' => $item->prod_id,
                'qty' => $item->prod_qty,
                'price' => $item->cartProduct->selling_price,
            ]);

            $product = Product::where('id', $item->prod_id)->first();
            $product->qty = $product->qty - $item->prod_qty;
            $product->save();
        }

        if(Auth::user()->address1 == NULL) {
            $user = User::findOrFail(Auth::id());
            $user->fname = $request->input('fname');
            $user->lname = $request->input('lname');
            $user->phone = $request->input('phone');
            $user->address1 = $request->input('address1');
            $user->address2 = $request->input('address2');
            $user->country = $request->input('country');
            $user->state = $request->input('state');
            $user->city = $request->input('city');
            $user->pin_code = $request->input('pin_code');
            $user->save();
        }

        $cartItems = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartItems);

        return redirect('/')->with('status', 'Order successfully placed to the Rainbow Shop');
    }
}
