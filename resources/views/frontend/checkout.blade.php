@extends('layouts.front')

@section('title')
    Checkout
@endsection

@section('content')

    <div class="py-3 mb-3 shoadow-sm bg-main border-top">

        <div class="container">

            <h6 class="mb-0"> <a href="{{ url('/') }}">Home</a> >  <a href="{{ url('/cart') }}">My Cart</a> > Checkout </h6>

        </div>

    </div>

    <div class="container my-3">

        <form action="{{ url('/confirm-order') }}" method="POST">
        @csrf

            <div class="row">
            
                <div class="col-md-7">

                    <div class="card shadow mb-3">

                        <div class="card-body">

                            <h5 class="mb-3">Info Details</h5>

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="fname" value="@if(Auth::user()->fname === null){{ old('fname') }}@else{{ auth()->user()->fname }}@endif" placeholder="First Name" />
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="lname" value="@if(Auth::user()->lname === null){{ old('lname') }}@else{{ auth()->user()->lname }}@endif" placeholder="Last Name" />
                                </div>
                                @error('fname')
                                <div class="col-md-6">
                                    <div class="form-control alert alert-danger">{{ $message }}</div>
                                </div>
                                @enderror
                                @error('lname')
                                <div class="col-md-6">
                                    <div class="form-control alert alert-danger">{{ $message }}</div>
                                </div>
                                @enderror
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" placeholder="Email" />
                                </div>
                                <div class="col-md-6">
                                    <input type="tel" class="form-control" name="phone" value="@if(Auth::user()->phone === null){{ old('phone') }}@else{{ auth()->user()->phone }}@endif"  placeholder="Mobile Phone" />
                                </div>
                                @error('email')
                                <div class="col-md-6">
                                    <div class="form-control alert alert-danger">{{ $message }}</div>
                                </div>
                                @enderror
                                @error('phone')
                                <div class="col-md-6">
                                    <div class="form-control alert alert-danger">{{ $message }}</div>
                                </div>
                                @enderror
                                <div class="col-12">
                                    <input type="text" class="form-control" name="address1" value="@if(Auth::user()->address1 === null){{ old('address1') }}@else{{ auth()->user()->address1 }}@endif" placeholder="Apartment, studio, or floor" />
                                </div>
                                @error('address1')
                                <div class="col-md-12">
                                    <div class="form-control alert alert-danger">{{ $message }}</div>
                                </div>
                                @enderror
                                <div class="col-12">
                                    <input type="text" class="form-control" name="address2" value="@if(Auth::user()->address2 === null){{ old('address2') }}@else{{ auth()->user()->address2 }}@endif" placeholder="1234 Main St" />
                                </div>
                                @error('address2')
                                <div class="col-md-12">
                                    <div class="form-control alert alert-danger">{{ $message }}</div>
                                </div>
                                @enderror
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="country" value="@if(Auth::user()->country === null){{ old('country') }}@else{{ auth()->user()->country }}@endif" placeholder="Country" />
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="state" value="@if(Auth::user()->state === null){{ old('state') }}@else{{ auth()->user()->state }}@endif" placeholder="State" />
                                </div>
                                @error('country')
                                <div class="col-md-6">
                                    <div class="form-control alert alert-danger">{{ $message }}</div>
                                </div>
                                @enderror
                                @error('state')
                                <div class="col-md-6">
                                    <div class="form-control alert alert-danger">{{ $message }}</div>
                                </div>
                                @enderror
                                <div class="col-md-8">
                                    <input type="text" class="form-control" value="@if(Auth::user()->city === null){{ old('city') }}@else{{ auth()->user()->city }}@endif" name="city" placeholder="City" />
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="pin_code" value="@if(Auth::user()->pin_code === null){{ old('pin_code') }}@else{{ auth()->user()->pin_code }}@endif" id="pin_code" placeholder="Pin Code" />
                                </div>
                                @error('city')
                                <div class="col-md-12">
                                    <div class="form-control alert alert-danger">{{ $message }}</div>
                                </div>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-5">

                    <div class="card shadow">

                        <div class="card-body">

                            <h5 class="mb-3">Order Details</h5>

                            <table class="table">

                                <thead>

                                    <tr>

                                        <th scope="col">Name</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Price</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @php 
                                        $total = 0; 
                                    @endphp

                                    @foreach($cartItems as $item)

                                        <tr>

                                            <td>{{ $item->cartProduct->name }}</td>
                                            <td>{{ $item->prod_qty }}</td>
                                            <td>{{ $item->cartProduct->selling_price }}</td>

                                        </tr>

                                        @php 
                                        $total += $item->cartProduct->selling_price * $item->prod_qty;
                                        @endphp

                                    @endforeach

                                </tbody>

                                @if (count($cartItems) > 0) 
                                <tfoot>

                                    <tr>

                                        <td>Total : {{ $total }} Ks</td>
                                        <td></td>
                                        <td><button class="btn btn-main" type="submit">Order</button></td>
                                        

                                    </tr>

                                </tfoot>
                                @else
                                <tbody>

                                    <tr>
                                        
                                        <td>No item ...</td>

                                    </tr>

                                </tbody>
                                @endif

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>

@endsection