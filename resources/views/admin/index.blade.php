@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <h3 class="mt-3 mb-4">Dashboard</h3>

        <div class="row mb-3">

            <div class="col-md-4">
                
                <div class="dashboard-category">

                    <div class="dashboard-flex category">

                        <h4>Categories</h4>
                        <div><i class="fas fa-layer-group"></i> {{ $categories->count() }}</div>

                    </div>

                </div>

            </div>

            <div class="col-md-4">
                
                <div class="dashboard-category">

                    <div class="dashboard-flex product">

                        <h4>Products</h4>
                        <div><i class="fab fa-product-hunt"></i> {{ $products->count() }}</div>

                    </div>
                
                </div>

            </div>

            <div class="col-md-4">
                
                <div class="dashboard-category">

                    <div class="dashboard-flex customers">

                        <h4>Customers</h4>
                        <div><i class='bx bx-user-check'></i> {{ $customers->count() }}</div>

                    </div>

                </div>

            </div>

        </div>
        
        <div class="row mb-3">

            <div class="col-md-4">
                
                <div class="dashboard-category">

                    <div class="dashboard-flex newOrders">

                        <h4>New Orders</h4>
                        <div><i class="fas fa-box-open"></i> {{ $newOrders->count() }}</div>

                    </div>

                </div>

            </div>

            <div class="col-md-4">
                
                <div class="dashboard-category">

                    <div class="dashboard-flex deliver">

                        <h4>Order Deliver</h4>
                        <div><i class="fas fa-box-open"></i> {{ $deliver->count() }}</div>

                    </div>

                </div>

            </div>

            <div class="col-md-4">
                
                <div class="dashboard-category">

                    <div class="dashboard-flex soldout">

                        <h4>Soldout</h4>
                        <div><i class="fas fa-box-open"></i> {{ $soldout->count() }}</div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row mb-3">

            <div class="col-md-4">
                
                <div class="dashboard-category">

                    <div class="dashboard-flex cancel">

                        <h4>Order Cancel</h4>
                        <div><i class="fas fa-box-open"></i> {{ $cancel->count() }}</div>

                    </div>

                </div>

            </div>

            <div class="col-md-4">
                
                <div class="dashboard-category">

                    <div class="dashboard-flex users">

                        <h4>Users</h4>
                        <div><i class="fas fa-users"></i> {{ $users->count() }}</div>

                    </div>

                </div>

            </div>

            <div class="col-md-4">
                
                <div class="dashboard-category">

                    <div class="dashboard-flex admins">

                        <h4>Admins</h4>
                        <div><i class='bx bx-user-circle'></i> {{ $admins->count() }}</div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection