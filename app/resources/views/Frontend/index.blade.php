@extends('layouts.front')

@section('lang')
<ul class="dropdown-menu">

    @foreach (config('laravellocalization.supportedLocales') as $key => $local)
        @if ($key != app()->getLocale())
            <li>
                <a class="dropdown-item" rel="alternate" hreflang="{{ $key }}" href="{{ LaravelLocalization::getLocalizedURL($key, route(Route::currentRouteName())) }}">
                    {{ $local['native'] }}
                </a>
            </li>
        @endif

    @endforeach
</ul>
@endsection

@section('content')
@include('layouts.inc.slider')
<div class="container">

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h3 class="mb-3">{{ __('frontend/index.featuredprod') }}</h3>
                <div class="owl-carousel owl-theme">
                    @foreach ($featured_products as $product)
                    <div class="item">
                        <a class="text-decoration-none text-dark" href="{{ route('product.details', ['category_slug' => $product->category->slug, 'product_slug' => $product->slug]) }}">
                            <div class="card">
                                <img src="{{ asset('/uploads/product/'.$product->image) }}" alt="" width="250px" height="250px">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h5>{{ $product->name }}</h5>
                                        <small>${{ $product->selling_price }}</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>

                <h3 class="mb-3 mt-5">{{ __('frontend/index.featuredcat') }}</h3>
                <div class="owl-carousel owl-theme">
                    @foreach ($featured_categories as $category)
                    <a href="{{ route('category.details', ['category_slug' => $category->slug] ) }}" class="text-decoration-none text-dark">
                        <div class="item">
                            <div class="card">
                                <img src="{{ asset('/uploads/category/'.$category->image) }}" alt="">
                                <div class="card-body">
                                    <h5>{{ $category->name }}</h5>
                                    <small>{{ $category->description }}</small>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('title', 'Eshop')
