@extends('layouts.front')

@section('title')
    My Orders
@endsection

@section('content')

    <div class="py-3 mb-3 shoadow-sm bg-main border-top">

        <div class="container">

            <h6 class="mb-0"> <a href="{{ url('/') }}">Home</a> >  My Orders </h6>

        </div>

    </div>

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">

                        <h5>My Orders</h5>

                    </div>

                    <div class="card-body">

                        <table class="table my-orderTable">

                            <thead>

                                <tr>
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
                                            <td>{{ $item->created_at }}</td>
                                            <td><a href="{{ url('/view-order/'.$item->id) }}" class="btn btn-main">View</a></td>

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

            </div>

        </div>

    </div>



@endsection