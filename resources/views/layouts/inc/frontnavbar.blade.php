<nav class="navbar navbar-expand-lg navbar-light container main-nav">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ url('/') }}">E-Shop</a>
    <div class="search-bar">
      <form action="{{ url('searchItem') }}" method="POST">
        @csrf
        <div class="input-group">
          <input type="search" class="form-control" id="product_name" name="product_name" placeholder="Search your item">
          <button type="submit" class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></button>
        </div>
      </form>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item me-3">
          <a class="nav-link main-nav-a {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link main-nav-a {{ Request::segment(1) == 'category' ? 'active' : '' }}" href="{{ url('category') }}">Category</a>
        </li>
        <li class="nav-item me-3">
          <a href="{{ url('cart') }}" class="position-relative nav-link main-nav-a {{ Request::segment(1) == 'cart' ? 'active' : '' }}">
            <i class="fa fa-shopping-cart text-danger"></i>
            <span class="position-absolute top-10 start-100 translate-middle badge rounded-pill bg-danger cart-count">
            
              <span class="visually-hidden">unread messages</span>
            </span>
          </a>
        </li>
        @if (Auth::check())
        <li class="nav-item dropdown">
            <a class="nav-link main-nav-a dropdown-toggle" href="{{ url('/') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ auth()->user()->name }}
            </a>
            @if (Auth::user()->role_as === 1) 
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ url('/dashboard') }}"><span><i class="fas fa-user me-2"></i></span> Admin Panel </a></li>
                <li><a class="dropdown-item" href="{{ url('/my-orders') }}"><span><i class="fas fa-box-open me-2"></i></span> My Orders </a></li>
                <li class="dropdown-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="logout" type="submit"><span><i class="fas fa-sign-out-alt me-2"></i></span> Logout</button>
                    </form>
                </li>
            </ul>
            @else
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="{{ url('/my-orders') }}"><span><i class="fas fa-box-open me-2"></i></span> My Orders </a></li>
                <li class="dropdown-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="logout" type="submit"><span><i class="fas fa-sign-out-alt me-2"></i></span> Logout</button>
                    </form>
                </li>
            </ul>
            @endif
        </li>
        @else
        <li class="nav-item dropdown">
          <a class="nav-link main-nav-a dropdown-toggle text-gray" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user text-gray"></i>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
            <li><a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a></li>
          </ul>
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>