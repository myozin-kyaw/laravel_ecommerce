@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center py-3">

            <h3>Create Last Slide</h3>
            <div><a href="{{ url('/slide') }}" class="btn btn-default">Back</a></div>

        </div>

        <div class="row">

            <form action="{{ route('lastSlide.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="mb-3">
                    <label for="label" class="form-label">Last Product Label</label>
                    <input type="text" name="l_label" class="form-control" id="label" value="{{ old('l_label') }}">
                </div>

                <div class="mb-3">
                    <label for="textarea" class="form-label">Last Product Description</label>
                    <textarea class="form-control" name="l_desc" id="textarea" rows="3">{{ old('l_desc') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="Img" class="form-label">Last Product Img</label>
                    <input type="file" class="form-control" name="l_Slide" id="Img" value="{{ old('l_Slide') }}">
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

            </form>

        </div>
    
    </div>

@endsection