@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <div class="card">

            <div class="card-header">

                <div class="navbar-nav float-start me-auto">
                    <h4>View Order Details</h4>
                </div>

                <div class="navbar-nav float-end">
                    <a href="{{ url('/order-history') }}" class="btn btn-warning">Order History</a>
                </div>

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
                                    <div class="form-control" style="height: 200px;">
                                        {{ $orders->address1 }}, <br>
                                        {{ $orders->address2 }}, <br>
                                        {{ $orders->city }}, <br>
                                        {{ $orders->state }}, <br>
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

                                        <td colspan="4">Final Total Price : <b>{{ $orders->total_price }} Ks</b></td>

                                    </tr>

                                    <tr>

                                        @if ($orders->status === 0) 
                                        
                                            <form action="{{ url('/order-deliver/'.$orders->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="orderDeliverStatus" value="1">
                                                <td colspan="2">
                                                    <button type="submit" class="btn btn-success w-100">Deliver</button>
                                                </td>
                                            </form>
                                            <form action="{{ url('/order-cancel/'.$orders->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="orderCancelStatus" value="3">
                                                <td colspan="2">
                                                    <button type="submit" class="btn btn-danger w-100">Cancel</button>
                                                </td> 
                                            </form>
                                        @elseif ($orders->status == 1) 
                                            <td colspan="4" class="text-warning"><b><h4>Customer order is now delivering ...</h4></b> </td>
                                        @elseif ($orders->status == 2)
                                            <td colspan="4" class="text-success"><b><h4>Order Completely Finished</h4> </b></td>
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

@endsection


<!-- <div class="row">

<div class="col-md-6">

    <div class="card-body mb-3">

        

    </div>

    

</div>

</div> -->