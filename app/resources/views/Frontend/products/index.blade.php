@extends('layouts.front')

@section('title')
{{ $category->name }}
@endsection

@section('lang')
<ul class="dropdown-menu">

    @foreach (config('laravellocalization.supportedLocales') as $key => $local)
        @if ($key != app()->getLocale())
            <li>
                <a class="dropdown-item" rel="alternate" hreflang="{{ $key }}" href="{{ LaravelLocalization::getLocalizedURL($key, route(Route::currentRouteName(), ['category_slug' => $category->translate($key)->slug])) }}">
                    {{ $local['native'] }}
                </a>
            </li>
        @endif

    @endforeach
</ul>
@endsection

@section('content')

<div class="py-5">
    <div class="container">
        <div class="row">
            <h2 class="mb-5">{{ $category->name }}</h2>
            <div class="col-md-12">
                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('product.details', ['category_slug' => $category->slug, 'product_slug' => $product->slug]) }}" class="text-decoration-none text-dark">
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
            </div>
        </div>
    </div>
</div>

@endsection
