<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function add($product_slug)
    {
        $product = Product::where('slug', $product_slug)->where('status','0')->first();
        if ($product) {
            $product_id = $product->id;
            $review_check = Review::where('user_id', Auth::id())->where('prod_id',$product_id)->first();
            if ($review_check) {
                return view('frontend.review.edit', compact('review'));
            } else {
            $verify_purchase = Order::where('orders.user_id', Auth::id())
            ->join('order_items', 'orders.id','order_items.order_id')
            ->where('order_items.prod_id', $product_id)->get();
            return view('frontend.review.index', compact('product', 'verify_purchase'));
            }
        } else {
            return redirect()->back()->with('status', 'The link you follow was broken');
        }
    }

    public function addReview(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_check = Product::where('id', $product_id)->where('status','0')->first();
        if ($product_check) {
            $user_review = $request->input('user_review');
            $new_review = Review::create([
                'user_id' => Auth::id(),
                'prod_id' => $product_check->id,
                'user_review' => $user_review 
            ]);
            $category_slug = $product_check->category->slug;
            $product_slug = $product_check->slug;
            if ($new_review) {
                return redirect('category/'.$category_slug.'/'.$product_slug)->with('status', 'Thank you for writing review');
            }
        } else {
            return redirect()->back()->with('status', 'The link you follow was broken');
        }
    }

    public function edit($product_slug)
    {
        $product = Product::where('slug', $product_slug)->where('status','0')->first();
        if ($product) {
            $prodcut_id = $product->id;
            $review = Review::where('user_id', Auth::id())->where('prod_id', $prodcut_id)->first();
            if ($review) {
                return view('frontend.review.edit', compact('review'));
            } else {
                return redirect()->back()->with('status', 'The link you follow was broken');
            }
        } else {
            return redirect()->back()->with('status', 'The link you follow was broken');
        }
    }

    public function update(Request $request)
    {
        $user_review = $request->input('user_review');
        if ($user_review != '') {
            $review_id = $request->input('review_id');
            $review = Review::where('id', $review_id)->where('user_id', Auth::id())->first();
            if ($review) {
                $review->user_review = $request->input('user_review');
                $review->update();
                return redirect('category/'.$review->product->category->slug.'/'.$review->product->slug)->with('status', 'Reveiw updated successfully');
            } else {
                return redirect()->back()->with('status', 'The link you follow was broken');
            }
        } else {
            return redirect()->back()->with('status', 'You cannot submit an empty review');
        }
    }
}
