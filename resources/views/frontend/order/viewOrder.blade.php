@extends('layouts.front')

@section('title')
    My Orders
@endsection

@section('content')

    <div class="py-3 mb-3 shoadow-sm bg-main border-top">

        <div class="container">

            <h6 class="mb-0"> <a href="{{ url('/') }}">Home</a> >  <a href="{{ url('/my-orders') }}">My Orders</a> > Order View  </h6>

        </div>

    </div>

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <div class="card shadow">

                    <div class="card-header">

                        <h4>Order View</h4>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="card-body mb-3">

                                    <div class="row g-3 viewOrderLabel">

                                        <h4 class="orderViewHead">Shopping Details</h4>

                                        <div class="col-md-6">
                                            <label>First Name</label>
                                            <div class="form-control">{{ $orders->fname }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Last Name</label>
                                            <div class="form-control">{{ $orders->lname }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Email</label>
                                            <div class="form-control">{{ $orders->email }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Phone</label>
                                            <div class="form-control">{{ $orders->phone }}</div>
                                        </div>
                                        <div class="col-12">
                                            <label>Shopping Address</label>
                                            <div class="form-control">
                                                {{ $orders->address1 }}, <br>
                                                {{ $orders->address2 }},<br>
                                                {{ $orders->city }},<br>
                                                {{ $orders->state }},<br>
                                                {{ $orders->country }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Zip Code</label>
                                            <div class="form-control">{{ $orders->pin_code }}</div>
                                        </div>

                                        </div>

                                    </div>

                                </div>

                            <div class="col-md-6">

                                <div class="card-body">

                                    <h4 class="orderViewHead">Order Details</h4>

                                    <table class="table viewOrderTable">

                                        <thead>

                                            <tr>

                                                <th scope="col">Name</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Image</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            @foreach($orders->orderItems as $item)

                                                <tr>

                                                    <td scope="row">{{ $item->products->name }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>{{ $item->price }}</td>
                                                    <td><img class="viewOrder" src="{{ asset('images/product/'.$item->products->image) }}" alt=""></td>

                                                </tr>

                                            @endforeach

                                        </tbody>

                                        <tfoot>

                                            <tr>

                                                <td colspan="2"> Final Total Price : <b>{{ $orders->total_price }} Ks</b></td>
                                                @if ($orders->status === 1)
                                                <td colspan="2">
                                                    <form action="{{ url('order-accepted/'.$orders->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="order_accepted" value="2">
                                                        <button type="submit" class="btn btn-success w-100">Accepted</button>
                                                    </form>
                                                </td>
                                                @endif

                                            </tr>

                                        </tfoot>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection