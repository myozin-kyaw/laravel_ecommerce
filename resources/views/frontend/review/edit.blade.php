@extends('layouts.front')

@section('title', 'Edit a review')

@section('content')

    <div class="contaienr">

        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-body review-body my-3">

                        <h5 class="pb-3">You are writing a review for {{ $review->product->name }}</h5>
                        <form action="{{ url('/update-review') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="review_id" value="{{ $review->id }}">
                            <textarea name="user_review" class="form-control" rows="5" placeholder="Write a review">{{ $review->user_review }}</textarea>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Update Review</button>
                                <a href="" class="btn btn-warning">Back</a>
                            </div>
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection