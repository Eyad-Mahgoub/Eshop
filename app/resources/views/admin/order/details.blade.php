@extends('layouts.admin')

@section('title')
{{ 'Order Details' }}
@endsection

@section('content')

<div class="container">
    <div class="row my-3">
        <div class="d-flex justify-content-between align-items-center">
            <h1>{{ __('admin/orders.orderdetails') }}</h1>
            <a href="{{ route('admin.orders') }}">
                <button class="btn btn-primary">{{ __('admin/orders.back') }}</button>
            </a>
        </div>

        @if ($orderItems->isEmpty())
        <div class="card p-5 d-flex justify-content-center align-items-center">
            <h2>{{ __('admin/orders.emptyitems') }}</h2>
        </div>
        @else
        <div class="card p-3">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                    <tr>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('admin/orders.pname') }}</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('admin/orders.image') }}</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('admin/orders.quantity') }}</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('admin/orders.price') }}</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('admin/orders.totalprice') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderItems as $item)
                        <tr>
                            <td class="text-center">{{ $item->id }}</td>
                            <td class="text-center"><h6>{{ $item->product->name }}</h6></td>
                            <td class="text-center">
                                <img src="{{ asset('uploads/product/'.$item->product->image) }}" height="100" width="100">
                            </td>
                            <td class="text-center"><p>{{ $item->qty }}</p></td>
                            <td class="text-center"><p>${{ $item->price }}</p></td>
                            <td class="text-center"><p>${{ $item->price * $item->qty }}</p></td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection
