@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center py-3">

            <h3>Update Last Slide</h3>
            <div><a href="{{ url('/slide') }}" class="btn btn-default">Back</a></div>

        </div>

        <div class="row">

            <form action="{{ route('lastSlide.update',[$lSlider->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="mb-3">
                    <label for="label" class="form-label">Last Product Label</label>
                    <input type="text" name="l_label"  class="form-control" id="label" value="{{ old('l_label', $lSlider->slider_label) }}">
                </div>

                <div class="mb-3">
                    <label for="textarea" class="form-label">Last Product Description</label>
                    <textarea class="form-control" name="l_desc" id="textarea" rows="3">{{ old('l_Slide', $lSlider->slider_desc) }}</textarea>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-8">
                            <label for="Img" class="form-label">Last Product Img</label>
                            <input type="file" name="l_Slide" class="form-control" id="Img" value="{{ old('l_label', $lSlider->slider_img) }}">
                        </div>
                        <div class="col-md-4">
                            <img src="{{ asset('/storage/'.$lSlider->slider_img) }}" class="slide_img" value="{{ old('l_Slide', $lSlider->slider_img) }}" alt="{{ $lSlider->slider_img }}">
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