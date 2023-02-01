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

    <h1 class="mb-5 p-2">{{ __('frontend/index.wishlist') }}</h1>

    <div class="card shadow">
        <div class="card-body">
            @if ($wishlistItems->count() > 0)
            @foreach ($wishlistItems as $item)
            <div class="row my-3 product-data align-items-center">
                <div class="col-md-2">
                    <img class="w-100" src="{{ asset('uploads/product/'.$item->product->image) }}" alt="">
                </div>
                <div class="col-md-3">
                    <h3>{{ $item->product->name }}</h3>
                </div>
                <div class="col-md-2">
                    <h3><b>${{ $item->product->selling_price }}</b></h3>
                </div>
                <div class="col-md-3">
                    <input type="hidden" value="{{ $item->product_id }}" id="prod_id">
                    <input type="text" value="{{ $item->product->quantity }}"  class="maxquantity d-none">
                    <label for="">{{ __('frontend/index.quantity') }}</label>

                    @if ($item->product->quantity >= 1)
                    <div class="input-group text-center mb-3" style="width: 130px;">
                        <button class="input-group-text changeQuantity decrementbtn">-</button>
                        <input type="text" id="quantity" value="1" class="text-center form-control quantity changeQuantity">
                        <button class="input-group-text changeQuantity incrementbtn">+</button>
                    </div>
                    @else
                    <h6>{{ __('frontend/index.outofstock') }}</h6>
                    @endif

                </div>
                <div class="col md 2">
                    @if ($item->product->quantity > 0)
                    <button id="addtoCart" type="button" class="btn btn-primary me-3 float-start">{{ __('frontend/index.addtocart') }}</button>
                    @endif
                    <button class="btn btn-danger delete-wishlist-item">{{ __('frontend/index.delete') }}</button>
                </div>
            </div>
            @endforeach
            @else
            <div class="card-body text-center">
                <h2 class="mb-4">{{ __('frontend/index.emptywishlist') }}</h2>
                <a href="{{ route('category') }}" class="btn btn-primary float-end">{{ __('frontend/index.continueshopping') }}</a>
            </div>
            @endif
        </div>
    </div>


</div>

@endsection

