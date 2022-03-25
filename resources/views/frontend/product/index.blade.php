@extends('layouts.front')

@section('title')
    {{ $category->slug }}
@endsection

@section('content')

<div class="py-3 mb-3 shoadow-sm bg-main border-top">

    <div class="container">

        <h6 class="mb-0"> Collections > <a href="{{ url('/category') }}">Category</a>  > {{ $category->slug }} </h6>

    </div>

</div>

<div class="my-3">

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <h2 class="mb-3">{{ $category->name }}</h2>

                <div class="row">

                    @foreach($product as $prod)

                        <div class="col-md-3 mb-3">

                            <a href="{{ url('category/'.$category->slug.'/'.$prod->slug) }}">

                                <div class="card">

                                    <img class="trendImg" src="{{ asset('images/product/' . $prod->image) }}" alt="{{ $prod->name }}">
                                    <div class="card-body">
                                        <h5>{{ $prod->name }}</h5>
                                        <span class="float-start">{{ $prod->selling_price }} ks</span>
                                        <span class="float-end"> <s>{{ $prod->original_price }}</s>  ks</span>
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