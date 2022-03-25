@extends('layouts.front')

@section('title')
    E-shop - Category
@endsection

@section('content')

<div class="py-3 shoadow-sm bg-main border-top">

    <div class="container">

        <h6 class="mb-0"> Collections > Category</h6>

    </div>

</div>

<div class="py-3">

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <h2 class="mb-3">All Categories</h2>

                <div class="row">

                    @foreach($category as $cat)

                        <div class="col-md-3 mb-3">

                            <a href="{{ url('view-category/'.$cat->slug) }}">

                                <div class="card">

                                    <img class="trendImg" src="{{ asset('images/category/' . $cat->image) }}" alt="{{ $cat->name }}">
                                    <div class="card-body">
                                        <h5>{{ $cat->name }}</h5>
                                        <p>{{ $cat->description }}</p>
                                    </div>

                                </div>

                            </a>

                        </div>
                    @endforeach

                </div>

            </div>

        </div>

    </div>

</div>

@endsection