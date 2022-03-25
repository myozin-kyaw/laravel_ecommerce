@extends('layouts.front')

@section('title', 'Write a review')

@section('content')

    <div class="contaienr">

        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-body review-body my-3">

                        @if($verify_purchase->count() > 0)

                            <h5 class="pb-3">You are writing a review for {{ $product->name }}</h5>
                            <form action="{{ url('/add-review') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <textarea name="user_review" class="form-control" rows="5" placeholder="Write a review"></textarea>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Submit Review</button>
                                    <a href="" class="btn btn-warning">Back</a>
                                </div>
                            </form>

                        @else
                            <div class="alert alert-danger">
                                <h5>You are not eligible to review this review</h5>
                                <p>
                                    For the trustworthiness of the reviews, only customers who purchased
                                    the product can write a review about the product.
                                </p>
                                <a href="{{ url('/') }}" class="btn btn-primary">Go to home page</a>
                            </div>
                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection