@extends('layouts.front')

@section('title', $product->name)

@section('content')

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        
        <div class="modal-dialog">

            <div class="modal-content">

                <form action="{{ url('/add-rating') }}" method="POST">
                @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rate {{ $product->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="rating-css">

                            <div class="star-icon">
                                @if($user_rating)
                                    @for($i = 1; $i <= $user_rating->stars_rated; $i++)
                                        <input type="radio" value="{{ $i }}" name="product_rating" checked id="rating{{ $i }}">
                                        <label for="rating{{ $i }}" class="fa fa-star"></label>
                                    @endfor
                                    @for($j = $user_rating->stars_rated + 1; $j <= 5; $j++)
                                        <input type="radio" value="{{ $j }}" name="product_rating" id="rating{{ $j }}">
                                        <label for="rating{{ $j }}" class="fa fa-star"></label>
                                    @endfor
                                @else 
                                    <input type="radio" value="1" name="product_rating" checked id="rating1">
                                    <label for="rating1" class="fa fa-star"></label>
                                    <input type="radio" value="2" name="product_rating" id="rating2">
                                    <label for="rating2" class="fa fa-star"></label>
                                    <input type="radio" value="3" name="product_rating" id="rating3">
                                    <label for="rating3" class="fa fa-star"></label>
                                    <input type="radio" value="4" name="product_rating" id="rating4">
                                    <label for="rating4" class="fa fa-star"></label>
                                    <input type="radio" value="5" name="product_rating" id="rating5">
                                    <label for="rating5" class="fa fa-star"></label>
                                @endif
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Rate</button>
                    </div>

                </form>    

            </div>

        </div>

    </div>

    <div class="py-3 mb-3 shoadow-sm bg-main border-top">

        <div class="container">

            <h6 class="mb-0"> Collections > <a href="{{ url('/category') }}">Category</a> > <a href="{{ url('/view-category/'.$category->slug) }}"> {{ $category->name }} </a> > {{ $product->name }} </h6>

        </div>

    </div>

    <div class="container my-5">

        <div class="card shadow product_data">

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4 border-right">

                        <img src="{{ asset('images/product/'.$product->image) }}" class="w-100" alt="{{ $product->name }}">

                    </div>

                    <div class="col-md-8">

                        <h2 class="mb-0">

                            {{ $product->name }}
                            @if ($product->trending === 1)
                            <label style="font-size:1rem;" class="float-end badge bg-danger trending_tag">Trending</label>
                            @endif

                        </h2>

                        <hr>

                        <label class="me-3"> Original Price : <s>{{ $product->original_price }}</s> Ks </label>
                        <label class="fw-bold"> Selling Price : {{ $product->selling_price }} Ks </label>
                        <div class="rating">
                            @php $rating_stars =  number_format($rating_value)  @endphp
                            @for($i = 1; $i <= $rating_stars; $i++)
                                <i class="fa fa-star checked"></i>
                            @endfor
                            @for($j = $rating_stars+1; $j <= 5; $j++)
                                <i class="fa fa-star"></i>
                            @endfor
                            <span>
                                @if ($ratings->count() > 0)
                                    {{ $ratings->count() }} Ratings
                                @else
                                    No rating
                                @endif
                            </span>
                        </div>
                        
                        <p class="mt-3"> {{ $product->small_description }} </p>

                        <hr>

                        @if ($product->qty > 0)
                            <label class="badge bg-success">In stock</label>
                        @else
                            <label class="badge bg-danger">Out of stock</label>
                        @endif

                        <div class="row mt-2">

                            <div class="col-md-2">

                                <input type="hidden" value="{{ $product->id }}" class="prod_id">
                                <label for="Quantity">Quantity</label>
                                <div class="input-group text-center mb-3">

                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" name="quantity" min="0" value="1" class="form-control qty-input">
                                    <button class="input-group-text increment-btn">+</button>

                                </div>

                            </div>

                            <div class="col-md-10">

                                <br/>
                                @if ($product->qty > 0)
                                <button type="button" class="btn btn-main me-3 addToCartBtn float-start">  Add to Cart <i class="fa fa-shopping-cart"></i> </button>
                                @endif
                                <button type="button" class="btn btn-success me-3 float-start">  Purchase <i class="fas fa-heart"></i> </button>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-12 my-3">

                        <h2 class="mb-3">Description</h2>

                        {{ $product->description }}

                    </div>

                </div>

                <hr>

                <div class="row">

                    <div class="col-md-4">

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Rate this product
                        </button>

                        <a href="{{ url('/add-review/' . $product->slug . '/userreview') }}" class="btn btn-link"> Write a review </a>

                    </div>

                    <div class="col-md-8">

                        @foreach($customer_review as $review)

                            <div class="row">
                                
                                <div class="col-md-8 mb-3">

                                    @php

                                    $rating = App\Models\Rating::where('prod_id', $product->id)->where('user_id', $review->customer->id)->first();

                                    @endphp

                                    @if ($rating)
                                        @php $user_rated = $rating->stars_rated @endphp
                                        @for($i = 1; $i <= $user_rated; $i++)
                                            <i class="fa fa-star checked"></i>
                                        @endfor
                                        @for($j = $user_rated+1; $j <= 5; $j++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                    @endif
                                    <label for=""><b>{{ $review->customer->fname . ' ' . $review->customer->lname  }}</b></label>

                                </div>

                                <div class="col-md-4">

                                    <small>Review on {{ $review->created_at->format('d/F/Y') }}</small>

                                </div>

                                <p class="col-md-12">
                                    {{ $review->user_review }}
                                    @if ($review->user_id == Auth::id())
                                    <a href="{{ url('/review-edit/'.$product->slug.'/userreview') }}" class="btn btn-link">Edit</a>
                                    @endif
                                </p>

                                <hr>
                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection