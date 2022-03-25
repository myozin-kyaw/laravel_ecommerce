<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index() 
    {
        $products = Product::get();
        $categories = Category::get();
        $newOrders = Order::where('status', '0')->get();
        $deliver = Order::where('status', '1')->get();
        $soldout = Order::where('status', '2')->get();
        $cancel = Order::where('status', '3')->get();
        $users = User::where('role_as', '0')->get();
        $customers = Order::where('user_id', Auth::id())->get();
        $admins = User::where('role_as', '1')->get();
        return view('admin.index', compact('products', 'categories', 'newOrders', 'deliver', 'soldout', 'cancel', 'users', 'customers', 'admins'));
    }

    public function sliderIndex()
    {
        $fSlider = Slider::first();
        $mSlider = Slider::skip(1)->take(1)->first();
        $lSlider = Slider::skip(2)->take(1)->first();
        return view('admin.slider.index', compact('fSlider', 'mSlider', 'lSlider'));
    }
}
