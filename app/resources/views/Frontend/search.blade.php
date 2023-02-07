@extends('layouts.front')

@section('title', 'Search Result')

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

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <h2 class="mb-3">Search Results for: <i>{{ $search }}</i> </h2>
                    @if (! $products->isEmpty())
                        @foreach ($products as $product)
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('product.details', ['category_slug' => $product->category->slug , 'product_slug' => $product->slug]) }}" class="text-decoration-none text-dark">
                                <div class="card">
                                    <img src="{{ asset('/uploads/product/'.$product->image) }}" alt="" class="w-100" height="250px">
                                    <div class="card-body">
                                        <h5>{{ $product->name }}</h5>
                                        <small>{{ $product->description }}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    @else
                        <div class="card shadow p-3">
                            <div class="card-body text-center">
                                <h2>Nothing Found Try Again</h2>
                                <a href="{{ url('/categories') }}" class="btn btn-primary float-end">View Categories</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
