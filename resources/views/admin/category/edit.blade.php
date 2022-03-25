@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="navbar-nav float-start me-auto">
                    <h4>Editing New Category Page</h4>
                </div>
                <div class="navbar-nav float-end">
                    <a href="{{ route('categories.index') }}" class="btn btn-warning">Back to Categories</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.update', [$category->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $category->name) }}" />
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ old('slug', $category->slug) }}"/>
                            @error('slug')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="description">Description</label>
                            <textarea type="textarea" class="form-control @error('description') is-invalid @enderror" row="3" name="description" id="description">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status">Status</label>
                            <input type="checkbox" name="status" id="status" {{ ($category->status == 1 ? ' checked' : '') }} />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="popular">Popular</label>
                            <input type="checkbox" name="popular" id="popular" {{ ($category->popular == 1 ? ' checked' : '') }} />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" id="meta_title" value="{{ old('meta_title', $category->meta_title) }}" />
                            @error('meta_title')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="meta_keywords">Meta Keywords</label>
                            <textarea type="textarea" class="form-control @error('meta_keywords') is-invalid @enderror" row="3" name="meta_keywords" id="meta_keywords">{{ old('meta_keywords', $category->meta_keywords) }}</textarea>
                            @error('meta_keywords')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="meta_description">Meta Description</label>
                            <textarea type="textarea" class="form-control @error('meta_description') is-invalid @enderror" row="3" name="meta_description" id="meta_description">{{ old('meta_description', $category->meta_description) }}</textarea>
                            @error('meta_description')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-8 mb-3">
                            <label for="image">Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" />
                            @error('image')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        @if($category->image)
                        <div class="col-md-4 text-end">
                            <img class="editCategoryImg" src="{{ asset('images/category/'. $category->image) }}" alt="{{ $category->name }}">
                        </div>
                        @endif

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection