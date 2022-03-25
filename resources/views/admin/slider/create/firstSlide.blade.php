@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center py-3">

            <h3>Create First Slide</h3>
            <div><a href="{{ url('/slide') }}" class="btn btn-default">Back</a></div>

        </div>

        <div class="row">

            <form action="{{ route('firstSlide.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="mb-3">
                    <label for="label" class="form-label">First Product Label</label>
                    <input type="text" name="f_label"  class="form-control" id="label" value="{{ old('f_label') }}">
                </div>

                <div class="mb-3">
                    <label for="textarea" class="form-label">First Product Description</label>
                    <textarea class="form-control" name="f_desc" id="textarea" rows="3">{{ old('f_desc') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="Img" class="form-label">First Product Img</label>
                    <input type="file" name="f_Slide" class="form-control" id="Img" value="{{ old('f_Slide') }}">
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

            </form>

        </div>
    
    </div>

@endsection