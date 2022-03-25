@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <div class="card">

            <div class="card-header">

                <div class="navbar-nav float-start me-auto">
                    <h4>User Details</h4>
                </div>

                <div class="navbar-nav float-end">
                    <a href="{{ url('/my-users') }}" class="btn btn-warning">Back to All users</a>
                </div>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-12">

                        <div class="card-body mb-3">

                            <div class="row g-3 viewOrderLabel">

                                <div class="col-md-6">
                                    <label>User ID</label>
                                    <div class="form-control">{{ $user->id }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label>Role As</label>
                                    <div class="form-control">{{ $user->role_as === 1 ? 'Admin' : 'User' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label>Name</label>
                                    <div class="form-control">{{ $user->name }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label>First Name</label>
                                    <div class="form-control">{{ $user->fname }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label>Last Name</label>
                                    <div class="form-control">{{ $user->lname }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label>Email</label>
                                    <div class="form-control">{{ $user->email }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label>Phone</label>
                                    <div class="form-control">{{ $user->phone }}</div>
                                </div>
                                <div class="col-6">
                                    <label>Address1</label>
                                    <div class="form-control">{{ $user->address1 }}</div>
                                </div>
                                <div class="col-6">
                                    <label>Address2</label>
                                    <div class="form-control">{{ $user->address2 }}</div>
                                </div>
                                <div class="col-6">
                                    <label>City</label>
                                    <div class="form-control">{{ $user->city }}</div>
                                </div>
                                <div class="col-6">
                                    <label>State</label>
                                    <div class="form-control">{{ $user->state }}</div>
                                </div>
                                <div class="col-6">
                                    <label>Country</label>
                                    <div class="form-control">{{ $user->country }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label>Zip Code</label>
                                    <div class="form-control">{{ $user->pin_code }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label>Created At</label>
                                    <div class="form-control">{{ date('d-m-Y', strtotime($user->created_at)) }} / {{ date('H:i:s', strtotime($user->created_at)) }}</div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        
    </div>

@endsection