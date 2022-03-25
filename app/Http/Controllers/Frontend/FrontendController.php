<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Rating;
use App\Models\Review;
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
        $feature_products = Product::where('trending', '1')->take(15)->get();
        $popular_category = Category::where('popular', '1')->take(15)->get();
        $fSlider = Slider::first();
        $mSlider = Slider::skip(1)->take(1)->first();
        $lSlider = Slider::skip(2)->take(1)->first();
        return view('frontend.index', compact('feature_products', 'popular_category', 'fSlider', 'mSlider', 'lSlider'));
    }

    public function category()
    {
        $category = Category::where('status', '0')->get();
        return view('frontend.category', compact('category'));
    }

    public function viewCategory($slug)
    {
        if (Category::where('slug', $slug)->exists()) {
            $category = Category::where('slug', $slug)->first();            
            $product = Product::where('cat_id', $category->id)->where('status','0')->get();
            return view('frontend.product.index', compact('category', 'product'));
        } else {
            return redirect('/')->with('status', "Your Click Category doesn't exit");
        }
    }

    public function viewProduct($cat_slug, $prod_slug)
    {
        if (Category::where('slug', $cat_slug)->exists()) {
            if (Product::where('slug', $prod_slug)->exists()) {
                $category = Category::where('slug', $cat_slug)->first();
                $product = Product::where('slug', $prod_slug)->first();
                $ratings = Rating::where('prod_id', $product->id)->get();
                $rating_sum = Rating::where('prod_id', $product->id)->sum('stars_rated');
                $user_rating = Rating::where('prod_id', $product->id)->where('user_id', Auth::id())->first();
                $customer_review = Review::where('prod_id', $product->id)->get();
                if ($ratings->count() > 0) {
                    $rating_value = $rating_sum/$ratings->count();
                } else {
                    $rating_value = 0;
                }
                return view('frontend.product.viewProduct', compact('category', 'product','ratings','rating_value','user_rating','customer_review'));
            } else {
                return redirect('/')->with('status', "Your Click Product doesn't exit");
            }
        } else {
            return redirect('/')->with('status', "Your Click Category doesn't exit");
        }
    }

    public function getProduct()
    {
        $products = Product::select('name')->where('status', '0')->get();
        $data = [];
        foreach ($products as $item) {
            $data[] = $item['name'];
        }

        return $data;
    }

    public function search(Request $request)
    {
        $search_prodcut = $request->product_name;

        if ($search_prodcut != "") {
            $product = Product::where("name", "LIKE", "%$search_prodcut%")->first();
            if ($product) {
                return redirect('category/'. $product->category->slug.'/'.$product->slug);
            } else {
                return redirect()->back()->with('status', 'No products match your search');
            }
        } else {
            return redirect()->back();
        }
    }
}
