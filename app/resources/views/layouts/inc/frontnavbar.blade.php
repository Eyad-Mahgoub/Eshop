<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Eshop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ url('/') }}">{{ __('frontend/navbar.home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('categories') }}">{{ __('frontend/navbar.category') }}</a>
                </li>

                @guest
                @if (Route::has('login'))
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">{{ __('frontend/navbar.login') }}</a>
                </li>
                @endif
                @if (Route::has('register'))
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">{{ __('frontend/navbar.register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ url('cart') }}">
                                {{ __('frontend/navbar.cart') }}
                                <span class="badge badge-pill bg-success cart-count">0</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('wishlist') }}">
                                {{ __('frontend/navbar.wishlist') }}
                                <span class="badge badge-pill bg-success wishlist-count">0</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('/my-orders') }}">{{ __('frontend/navbar.myorders') }}</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('frontend/navbar.logout') }}
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </a>
                        </li>
                    </ul>
                </li>
                @endguest
                @include('layouts.inc.changelang')



            </ul>
            <form class="d-flex" role="search" action="{{ route('product.search') }}" method="POST">
                @csrf
                <input id="tags" class="form-control me-2" required type="search" name="search" placeholder="{{ __('frontend/navbar.search') }}" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">{{ __('frontend/navbar.search') }}</button>
            </form>

        </div>
    </div>
</nav>
