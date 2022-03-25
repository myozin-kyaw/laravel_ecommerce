@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <div class="card-header">

            <div class="navbar-nav float-start me-auto">
                <h4>Category Page</h4>
            </div>

            <div class="navbar-nav float-end">
                <a href="{{ route('categories.create') }}" class="btn btn-warning">Add new Category</a>
            </div>

        </div>

        <br>
        
        <table class="table table-hover">

            <thead>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </thead>

            <tbody class="categoryTbody">
                @if (count($categories) === 0)
                    <tr>
                        <td>No items found</td>
                    </tr>
                @else
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td><img class="showImgTable" src="{{ asset('images/category/' . $category->image) }}" alt="{{ $category->name }}"></td>
                        <td>
                            <div class="dFlexRowGap">
                                <a href="{{ route('categories.edit', [$category->id]) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('categories.destroy', [$category->id]) }}" method="POST">
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