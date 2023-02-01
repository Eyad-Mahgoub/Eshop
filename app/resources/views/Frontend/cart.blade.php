@extends('layouts.front')

@section('title')
{{ 'Cart' }}
@endsection

@section('lang')
<ul class="dropdown-menu">

    @foreach (config('laravellocalization.supportedLocales') as $key => $local)
        @if ($key != app()->getLocale())
            <li>
                <a class="dropdown-item" rel="alternate" hreflang="{{ $key }}" href="{{ LaravelLocalization::getLocalizedURL($key, route(Route::currentRouteName())) }}">
                    {{ $local['native'] }} - {{ $key }}
                </a>
            </li>
        @endif

    @endforeach
</ul>
@endsection

@section('content')

<div class="container">

    <h1 class="mb-5 p-2">{{ __('frontend/index.cart') }}</h1>

    <div class="card shadow cartitems">
        <div class="card-body ">
            @php
                $total = 0;
            @endphp
            @if ($cartItems->count() > 0)
            @foreach ($cartItems as $item)
            <div class="row my-3 product-data align-items-center">
                <div class="col-md-2">
                    <img class="w-100" src="{{ asset('uploads/product/'.$item->product->image) }}" alt="">
                </div>
                <div class="col-md-3">
                    <h3>{{ $item->product->name }}</h3>
                </div>
                <div class="col-md-2">
                    <h3><b>$<span class="selling-price">{{ $item->product->selling_price }}</span></b></h3>
                </div>
                <div class="col-md-3">
                    <input type="hidden" value="{{ $item->prod_id }}" class="prod_id">
                    <input type="text" value="{{ $item->product->quantity }}" class="maxquantity d-none">
                    <label for="">{{ __('frontend/index.quantity') }}</label>

                    @if ($item->product->quantity >= $item->prod_qty)
                    <div class="input-group text-center mb-3" style="width: 130px;">
                        <button class="input-group-text changeQuantity decrementbtn">-</button>
                        <input type="text" name="quantity" value="{{ $item->prod_qty }}" class="form-control quantity changeQuantity text-center">
                        <button class="input-group-text changeQuantity incrementbtn">+</button>
                    </div>
                    @php
                        $total += $item->product->selling_price * $item->prod_qty;
                    @endphp
                    @else
                    <h6>{{ __('frontend/index.outofstock') }}</h6>
                    @endif

                </div>
                <div class="col md 2">
                    <button class="btn btn-danger delete-cart-item">{{ __('frontend/index.remove') }}</button>
                </div>
            </div>
            @endforeach
        </div>

        <div class="card-footer d-flex justify-content-between align-items-center">
            <h6>{{ __('frontend/index.total') }}: <span class="total-price">${{ $total }}</span></h6>
            <a href="{{ url('/checkout') }}">
                <button class="btn btn-success">{{ __('frontend/index.checkout') }}</button>
            </a>
        </div>
            @else
            
            <div class="card-body text-center">
                <h2>{{ __('frontend/index.emptycart') }}</h2>
                <a href="{{ url('/categories') }}" class="btn btn-primary float-end">{{ __('frontend/index.continueshopping') }}</a>
            </div>
        </div>
            @endif
    </div>


</div>

@endsection


