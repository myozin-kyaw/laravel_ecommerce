@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <div class="card">

            <div class="card-body">

                <h4>Registered as User</h4>

                <table class="table table-hover">

                    <thead>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role As</th>
                        <th>Action</th>
                    </thead>

                    <tbody class="categoryTbody">
                        @if (count($admins) === 0)
                            <tr>
                                <td>No user found</td>
                            </tr>
                        @else
                        @foreach($admins as $admin)
                            <tr>
                                <td>{{ $admin->id }}</td>
                                @if ($admin->fname && $admin->lname != NULL) 
                                    <td>{{ $admin->fname.' '.$admin->lname }}</td>
                                @else
                                    <td>{{ $admin->name }}</td>
                                @endif
                                <td>{{ $admin->email}}</td>
                                <td>{{ $admin->phone }}</td>
                                <td>{{ $admin->role_as === 1 ? 'Admin' : 'User' }}</td>
                                <td>
                                    <div class="dFlexRowGap">
                                        <a href="{{ url('view-user/'.$admin->id) }}" class="btn btn-primary">View</a>
                                        <form action="{{ url('/delete-user/'. $admin->id) }}" method="POST">
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

            <div class="card-body">

                <h4>Registered as User</h4>

                <table class="table table-hover">

                    <thead>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role As</th>
                        <th>Action</th>
                    </thead>

                    <tbody class="categoryTbody">
                        @if (count($users) === 0)
                            <tr>
                                <td>No user found</td>
                            </tr>
                        @else
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                @if ($user->fname && $user->lname != NULL) 
                                    <td>{{ $user->fname.' '.$user->lname }}</td>
                                @else
                                    <td>{{ $user->name }}</td>
                                @endif
                                <td>{{ $user->email}}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->role_as === 1 ? 'Admin' : 'User' }}</td>
                                <td>
                                    <div class="dFlexRowGap">
                                        <a href="{{ url('view-user/'.$user->id) }}" class="btn btn-primary">View</a>
                                        <form action="{{ url('/delete-user/'. $user->id) }}" method="POST">
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

        </div>
        
    </div>

@endsection