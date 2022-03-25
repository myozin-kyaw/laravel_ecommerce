@extends('layouts.front')

@section('title')
    My Cart
@endsection

@section('content')

    <div class="py-3 mb-3 shoadow-sm bg-main border-top">

        <div class="container">

            <h6 class="mb-0"> <a href="{{ url('/') }}">Home</a> > My Cart({{ count($cartItems) }}) </h6>

        </div>

    </div>

    <div class="container my-3">

        <div class="card shadow">

            <div class="card-body">

                <div class="row">

                    <table class="table cartTable">

                        <thead>

                            <tr>

                                <th scope="col">Product Name</th>
                                <th scope="col">Product Image</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th>Remove</th>

                            </tr>

                        </thead>

                        @if(count($cartItems) > 0) 
                        <tbody>

                            @php 
                                $total = 0; 
                            @endphp

                            @foreach($cartItems as $item)

                                <tr class="product_data">

                                    <td>{{ $item->cartProduct->name }}</td>
                                    <td><img src="{{ asset('images/product/'.$item->cartProduct->image) }}" class="cartImg" alt="{{ $item->cartProduct->name }}"></td>
                                    <td>

                                        <input type="hidden" class="prod_id" value="{{ $item->prod_id }}">
                                        @if ($item->cartProduct->qty >= $item->prod_qty)
                                        <div class="input-group text-center mb-3" style="width:130px;">

                                            <button class="input-group-text changeQuantity decrement-btn">-</button>
                                            <input type="text" name="quantity" class="form-control qty-input text-center" min="0" value="{{ $item->prod_qty }}">
                                            <button class="input-group-text changeQuantity increment-btn">+</button>

                                        </div>
                                        @php 
                                            $total += $item->cartProduct->selling_price * $item->prod_qty;
                                        @endphp
                                        @else
                                        <div class="input-group text-center mb-3" style="width:130px;">

                                            <button class="input-group-text changeQuantity decrement-btn">-</button>
                                            <input type="text" name="quantity" class="form-control qty-input text-center" min="0" value="{{ $item->prod_qty }}">
                                            <label class="badge bg-danger">Insufficient material</label>
                                        </div>
                                        @endif

                                    </td>
                                    <td>{{ $item->cartProduct->selling_price }} Ks</td>
                                    <td><button class="btn btn-danger delete-cartItem">Remove</button></td>
                                
                                </tr>

                            @endforeach 

                        </tbody>

                        <tfoot>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total : {{ $total }} Ks</td>
                                <td><a href="{{ url('/checkout') }}" class="btn btn-main">Checkout</a></td>

                            </tr>

                        </tfoot>
                        @else 
                        <tbody>

                            <tr>

                                <td>No cart item ...</td>

                            </tr>

                        </tbody>
                        @endif

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection