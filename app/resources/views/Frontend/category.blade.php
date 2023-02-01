@extends('layouts.front')

@section('title', 'Categories')

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
                    @foreach ($categories as $category)
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('category.details', ['category_slug' => $category->slug]) }}" class="text-decoration-none text-dark">
                        <div class="card">
                            <img src="{{ asset('/uploads/category/'.$category->image) }}" alt="">
                            <div class="card-body">
                                <h5>{{ $category->name }}</h5>
                                <small>{{ $category->description }}</small>
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
