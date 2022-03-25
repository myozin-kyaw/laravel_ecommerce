@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <div class="card-header">

            <div class="navbar-nav float-start me-auto">
                <h4>Products Page</h4>
            </div>

            <div class="navbar-nav float-end">
                <a href="{{ route('products.create') }}" class="btn btn-warning">Add new Product</a>
            </div>

        </div>

        <br>
        
        <table class="table table-hover">

            <thead>
                <th>Id</th>
                <th>Name</th>
                <th>Category</th>
                <th>Selling Price</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Action</th>
            </thead>

            <tbody class="categoryTbody">
                @if (count($products) === 0)
                    <tr>
                        <td>No items found</td>
                    </tr>
                @else
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->selling_price }}</td>
                        <td>{{ $product->qty }}</td>
                        <td><img class="showImgTable" src="{{ asset('images/product/' . $product->image) }}" alt="{{ $product->name }}"></td>
                        <td>
                            <div class="dFlexRowGap">
                                <a href="{{ route('products.edit', [$product->id]) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('products.destroy', [$product->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                @endif
            </tbody>

        </table>
    </div>

@endsection