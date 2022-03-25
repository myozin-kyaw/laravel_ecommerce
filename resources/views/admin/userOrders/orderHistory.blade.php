@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <div class="card">

            <div class="card-header">

                <div class="navbar-nav float-start me-auto">
                    <h4>Order History</h4>
                </div>

                <div class="navbar-nav float-end">
                    <a href="{{ url('/user-orders') }}" class="btn btn-warning">New Order</a>
                </div>

            </div>

            <br>

            <table class="table table-hover">

                <thead>

                    <tr>
                        <th>User ID</th>
                        <th scope="col">Tracking Number</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Status</th>
                        <th scope="col">Order at</th>
                        <th scope="col">Action </th>

                    </tr>

                </thead>

                @if (count($orders) > 0)

                <tbody>

                    @foreach($orders as $item)

                        <tr>

                            <td>{{ $item->user_id }}</td>
                            <td>{{ $item->tracking_no }}</td>
                            <td>{{ $item->total_price }} Ks</td>
                            <td>
                                @if ($item->status === 0)
                                    <label class="badge bg-warning">Ordering</label>
                                @elseif ($item->status === 1)
                                    <label class="badge bg-success">Delivering</label>
                                @elseif ($item->status === 2) 
                                    <label class="badge bg-success">Order Completed</label>
                                @elseif ($item->status === 3)
                                    <label class="badge bg-danger">Order Placed to cancel</label>
                                @endif
                            </td>
                            <td>{{ date('d-m-Y', strtotime($item->created_at)) }} / {{ date('H:i:s', strtotime($item->created_at)) }}</td>
                            <td><a href="{{ url('/view-orderByAdmin/'.$item->id) }}" class="btn btn-warning">View</a></td>

                        </tr>

                    @endforeach

                </tbody>

                @else 

                <tbody>

                    <tr>

                        <td>No order ...</td>

                    </tr>

                </tbody>

                @endif

            </table>

        </div>

    </div>

@endsection