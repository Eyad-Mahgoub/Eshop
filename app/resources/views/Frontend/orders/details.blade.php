@extends('layouts.front')

@section('lang')
<ul class="dropdown-menu">

    @foreach (config('laravellocalization.supportedLocales') as $key => $local)
        @if ($key != app()->getLocale())
            <li>
                <a class="dropdown-item" rel="alternate" hreflang="{{ $key }}" href="{{ LaravelLocalization::getLocalizedURL($key, route(Route::currentRouteName(), ['order' => $order])) }}">
                    {{ $local['native'] }}
                </a>
            </li>
        @endif

    @endforeach
</ul>
@endsection

@section('content')

<div class="container my-3">
    <div class="d-flex justify-content-between my-3">
        <h2>{{ __('admin/orders.orderdetails') }}</h2>
        <a href="{{ route('orders') }}"><button class="btn btn-primary">{{ __('admin/orders.back') }}</button></a>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6>{{ __('frontend/index.basicdetails') }}</h6>
                    <hr>
                    <div class="row form-checkout">
                        <div class="col-md-6 mt-3">
                            <label for="">{{ __('auth/userdetails.firstname') }}</label>
                            <h6 class="form-control">{{ $userDetails->first_name }}</h6>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">{{ __('auth/userdetails.lastname') }}</label>
                            <h6 class="form-control">{{ $userDetails->last_name }}</h6>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">{{ __('auth/userdetails.email') }}</label>
                            <h6 class="form-control">{{ $userDetails->email }}</h6>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">{{ __('auth/userdetails.phoneno') }}</label>
                            <h6 class="form-control">{{ $userDetails->phone_no }}</h6>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">{{ __('auth/userdetails.address1') }}</label>
                            <h6 class="form-control">{{ $userDetails->address1 }}</h6>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">{{ __('auth/userdetails.address2') }}</label>
                            <h6 class="form-control">{{ $userDetails->address2 ?? '-' }}</h6>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">{{ __('auth/userdetails.city') }}</label>
                            <h6 class="form-control">{{ $userDetails->city }}</h6>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">{{ __('auth/userdetails.state') }}</label>
                            <h6 class="form-control">{{ $userDetails->state }}</h6>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">{{ __('auth/userdetails.country') }}</label>
                            <h6 class="form-control">{{ $userDetails->country }}</h6>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">Pin Code</label>
                            <h6 class="form-control">{{ $userDetails->pincode }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6>{{ __('admin/orders.orderdetails') }}</h6>
                    <hr>

                    <table class="w-100">
                        <thead>
                            <th>{{ __('frontend/index.name') }}</th>
                            <th>{{ __('admin/orders.quantity') }}</th>
                            <th>{{ __('admin/orders.price') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($orderItems as $item)
                            <tr>
                                <td class="pb-1">
                                    {{ $item->product->name }}
                                </td>
                                <td class="pb-1">
                                    {{ $item->qty }}
                                </td>
                                <td class="pb-1">
                                    ${{ $item->product->selling_price }}
                                </td>
                            </tr>
                            @endforeach
                            <tr class="border-top">
                                <th class="pt-2">{{ __('admin/orders.totalprice') }}</th>
                                <td class="pt-2"></td>
                                <td class="pt-2">${{ $item->order->total_price }}</td>
                        </tbody>
                    </table>

                </div>
            </div>


        </div>

    </div>
</div>

@endsection

@section('title', 'Order Details')
