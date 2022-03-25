@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <h3 class="my-3">Sliders</h3>

        <div class="row">

            <div class="col-md-4">

                @if (empty($fSlider)) 

                    <div><a href="{{ route('firstSlide.create') }}">Create First Slide</a></div>

                @else

                    <img src="{{ asset('/storage/'.$fSlider->slider_img) }}" class="slide_img" alt="">
                    <div><a href="{{ route('firstSlide.edit',[$fSlider->id]) }}" class="btn btn-success mt-3">Update First Slide</a></div>

                @endif
            
            </div>

            <div class="col-md-4">

                @if (empty($mSlider)) 

                    <div><a href="{{ route('middleSlide.create') }}">Create Middle Slide</a></div>

                @else

                    <img src="{{ asset('/storage/'.$mSlider->slider_img) }}" class="slide_img" alt="">
                    <div><a href="{{ route('middleSlide.edit',[$mSlider->id]) }}" class="btn btn-success mt-3">Update Middle Slide</a></div>

                @endif
            
            </div>
            
            <div class="col-md-4">

                @if (empty($lSlider)) 

                    <div><a href="{{ route('lastSlide.create') }}">Create Last Slide</a></div>

                @else

                    <img src="{{ asset('/storage/'.$lSlider->slider_img) }}" class="slide_img" alt="">
                    <div><a href="{{ route('lastSlide.edit',[$lSlider->id]) }}" class="btn btn-success mt-3">Update Last Slide</a></div>

                @endif
            
            </div>

        </div>

    </div>

@endsection
