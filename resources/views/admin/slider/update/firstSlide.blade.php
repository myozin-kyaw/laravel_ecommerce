@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center py-3">

            <h3>Update First Slide</h3>
            <div><a href="{{ url('/slide') }}" class="btn btn-default">Back</a></div>

        </div>

        <div class="row">

            <form action="{{ route('firstSlide.update',[$fSlider->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="mb-3">
                    <label for="label" class="form-label">First Product Label</label>
                    <input type="text" name="f_label"  class="form-control" id="label" value="{{ old('f_label', $fSlider->slider_label) }}">
                </div>

                <div class="mb-3">
                    <label for="textarea" class="form-label">First Product Description</label>
                    <textarea class="form-control" name="f_desc" id="textarea" rows="3">{{ old('f_desc', $fSlider->slider_desc) }}</textarea>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-8">
                            <label for="Img" class="form-label">First Product Img</label>
                            <input type="file" name="f_Slide" class="form-control" id="Img" value="{{ old('f_Slide', $fSlider->slider_img) }}">
                        </div>
                        <div class="col-md-4">
                            <img src="{{ asset('/storage/'.$fSlider->slider_img) }}" class="slide_img" alt="{{ $fSlider->slider_img }}">
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>

        </div>
    
    </div>

@endsection