@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card p-3">
        <div class="card-header">
            <h1>{{ __('admin/index.title') }}</h1>
        </div>
        <div class="row p-1">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        {{ __('admin/index.totalCategories') }}
                        <h5>{{ $catcount }}</h5>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link text-decoration-none" href="{{ route('admin.category') }}">{{ __('admin/index.viewCat') }}</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-secondary text-white mb-4">
                    <div class="card-body">
                        {{ __('admin/index.totalProducts') }}
                        <h5>{{ $prodcount }}</h5>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link text-decoration-none" href="{{ route('admin.product') }}">{{ __('admin/index.viewProd') }}</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body">
                        {{ __('admin/index.totalUsers') }}
                        <h5>{{ $usercount }}</h5>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link text-decoration-none" href="{{ route('admin.users') }}">{{ __('admin/index.viewUser') }}</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        {{ __('admin/index.totalOrders') }}
                        <h5>{{ $ordercount }}</h5>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link text-decoration-none" href="{{ route('admin.orders') }}">{{ __('admin/index.viewOrder') }}</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
