@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center py-3">

            <h3>Create Middle Slide</h3>
            <div><a href="{{ url('/slide') }}" class="btn btn-default">Back</a></div>

        </div>

        <div class="row">

            <form action="{{ route('middleSlide.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="mb-3">
                    <label for="label" class="form-label">Middle Product Label</label>
                    <input type="text" name="m_label"  class="form-control" id="label" value="{{ old('m_label') }}">
                </div>

                <div class="mb-3">
                    <label for="textarea" class="form-label">Middle Product Description</label>
                    <textarea class="form-control" name="m_desc" id="textarea" rows="3">{{ old('m_desc') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="Img" class="form-label">Middle Product Img</label>
                    <input type="file" name="m_Slide" class="form-control" id="Img" value="{{ old('m_Slide') }}">
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

            </form>

        </div>
    
    </div>

@endsection