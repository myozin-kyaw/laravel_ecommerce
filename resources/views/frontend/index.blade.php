@extends('layouts.front')

@section('title')
    Welcome to E-shop
@endsection

@section('content')

    @include('layouts.inc.slider')

    <div class="">

        <div class="container">

            <div class="row">

                <h2 class="my-5">Featured Products</h2>

                <div class="owl-carousel trending-carousel owl-theme">

                    @foreach($popular_category as $p_category)

                        @foreach($feature_products as $products)
                        <div class="item">

                            <a href="{{ url('/category/'.$p_category->slug.'/'. $products->slug) }}">

                                <div class="card">

                                    <img class="trendImg" src="{{ asset('images/product/' . $products->image) }}" alt="{{ $products->name }}">
                                    <div class="card-body">
                                        <h5>{{ $products->name }}</h5>
                                        <span class="float-start">{{ $products->selling_price }} ks</span>
                                        <span class="float-end"> <s>{{ $products->original_price }}</s>  ks</span>
                                    </div>

                                </div>

                            </a>

                        </div>
                        @endforeach

                    @endforeach

                </div>

            </div>

        </div>

    </div>

    <div class="">

        <div class="container">

            <div class="row">

                <h2 class="my-5">Popular Categories</h2>

                <div class="owl-carousel trending-carousel owl-theme">
                    
                    @foreach($popular_category as $p_category)
                    <div class="item">

                        <a href="{{ url('view-category/'.$p_category->slug) }}">

                            <div class="card">

                                <img class="trendImg" src="{{ asset('images/category/' . $p_category->image) }}" alt="{{ $p_category->name }}">
                                <div class="card-body">
                                    <h5>{{ $p_category->name }}</h5>
                                    <p>{{ $p_category->description }}</p>
                                </div>

                            </div>

                        </a>

                    </div>
                    @endforeach

                </div>

            </div>

        </div>

    </div>

@endsection

@section('scripts')
<script>
    $('.trending-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        dots:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    })
</script>
@endsection