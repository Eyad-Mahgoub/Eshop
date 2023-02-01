@extends('layouts.admin')

@section('title')
{{ 'Orders' }}
@endsection

@section('content')

<div class="container">
    <div class="row my-3">
        <div class="d-flex justify-content-between">
            <h1>{{ __('admin/orders.order') }}</h1>
        </div>

        @if ($orders->isEmpty())
        <div class="card p-5 d-flex justify-content-center align-items-center">
            <h2>{{ __('admin/orders.empty') }}</h2>
        </div>
        @else
        <div class="card p-3">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                    <tr>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('admin/orders.trackingno') }}</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('admin/orders.noofitems') }}</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('admin/orders.totalprice') }}</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('admin/orders.dateordered') }}</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('admin/orders.more') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td class="text-center">{{ $order->id }}</td>
                            <td class="text-center"><h6>{{ $order->tracking_no }}</h6></td>
                            <td class="text-center"><p>{{ $order->orders->count() }}</p></td>
                            <td class="text-center"><p>${{ $order->total_price }}</p></td>
                            <td class="text-center"><p>{{ $order->created_at->format('d/m/Y - h:iA ') }}</p></td>
                            <td class="text-center">
                                <a href="{{ route('admin.orders.details', ['order' => $order]) }}"><button class="btn btn-primary">{{ __('admin/orders.details') }}</button></a>
                            </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection
