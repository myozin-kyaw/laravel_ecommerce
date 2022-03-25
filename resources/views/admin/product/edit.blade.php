@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="navbar-nav float-start me-auto">
                    <h4>Editing Product Page</h4>
                </div>
                <div class="navbar-nav float-end">
                    <a href="{{ route('products.index') }}" class="btn btn-warning">Back to Products</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('products.update', [$product->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <label for="cat_id">Category</label>
                            <select name="cat_id" class="form-control @error('cat_id') is-invalid @enderror">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"{{ $category->id === $product->cat_id ? 'selected' : ''}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('cat_id')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $product->name) }}"/>
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ old('slug', $product->slug) }}"/>
                            @error('slug')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="small_description">Small Description</label>
                            <textarea class="form-control @error('small_description') is-invalid @enderror" row="3" name="small_description" id="small_description">{{ old('small_description', $product->small_description) }}</textarea>
                            @error('small_description')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" row="3" name="description" id="description">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="original_price">Original Price</label>
                            <input type="number" class="form-control @error('original_price') is-invalid @enderror" min="0" name="original_price" id="original_price" value="{{ old('original_price', $product->original_price) }}" />
                            @error('original_price')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="selling_price">Selling Price</label>
                            <input type="number" class="form-control @error('selling_price') is-invalid @enderror" min="0" name="selling_price" id="selling_price" value="{{ old('selling_price', $product->selling_price) }}"/>
                            @error('selling_price')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="qty">Quantity</label>
                            <input type="number" min="0" class="form-control @error('qty') is-invalid @enderror" min="0" name="qty" id="qty" value="{{ old('qty', $product->qty) }}"/>
                            @error('qty')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tax">Tax</label>
                            <input type="number" min="0" class="form-control @error('tax') is-invalid @enderror" min="0" name="tax" id="tax" value="{{ old('tax', $product->tax) }}"/>
                            @error('tax')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status">Status</label>
                            <input type="checkbox" name="status" id="status" {{ ($product->status == 1 ? ' checked' : '') }} />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="trending">Trending</label>
                            <input type="checkbox" name="trending" id="trending" {{ ($product->trending == 1 ? ' checked' : '') }} />
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" id="meta_title"  value="{{ old('meta_title', $product->meta_title) }}"/>
                            @error('meta_title')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="meta_keywords">Meta Keywords</label>
                            <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $product->meta_keywords) }}"/>
                            @error('meta_keywords')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="meta_description">Meta Description</label>
                            <textarea class="form-control @error('meta_description') is-invalid @enderror" row="3" name="meta_description" id="meta_description">{{ old('meta_description', $product->meta_description) }}</textarea>
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
                            <img class="editCategoryImg" src="{{ asset('images/product/'. $product->image) }}" alt="{{ $category->name }}">
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