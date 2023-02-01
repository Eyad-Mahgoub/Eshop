@extends('layouts.front')

@section('title')
{{ 'My Orders' }}
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

<div class="container my-3">

    <h3 class="my-3">{{ __('admin/orders.order') }}</h3>

    @if($orders->isEmpty())
    <div class="card p-3 my-3">
        <div class="row align-items-center">
            <div class="card-body text-center">
                <h2>{{ __('frontend/index.emptyorders') }}</h2>
                <a href="{{ url('/categories') }}" class="btn btn-primary float-end">{{ __('frontend/index.continueshopping') }}</a>
            </div>
        </div>
    </div>
    @endif

    @foreach ($orders as $order)
    <div class="card p-3 my-3">
        <div class="row align-items-center">
            <div class="col-9">
                <table class="w-100">
                    <thead>
                        <th>{{ __('admin/orders.trackingno') }}</th>
                        <th>{{ __('admin/orders.totalprice') }}</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $order->tracking_no }}</td>
                            <td>${{ $order->total_price }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-2">
                <a href="{{ route('order.details', ['order' => $order]) }}" class="btn btn-primary">{{ __('admin/orders.details') }}</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
