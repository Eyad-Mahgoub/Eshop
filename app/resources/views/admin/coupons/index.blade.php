@extends('layouts.admin')

@section('title')
    Coupons
@endsection

@section('content')
<div class="container">
    <div class="row my-3">
        <div class="d-flex justify-content-between">
            <h1>Coupons</h1>
            <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">Add Coupon</a>
        </div>

        @if ($coupons->isEmpty())
        <div class="card p-5 d-flex justify-content-center align-items-center">
            <h2>There are no coupons in the database</h2>
        </div>
        @else
        <div class="card p-3">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                    <tr>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Code</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Value</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">More</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $coupon)
                        <tr>
                            <td class="text-center">{{ $coupon->id }}</td>
                            <td class="text-center"><h6>{{ $coupon->name }}</h6></td>
                            <td class="text-center"><p>{{ $coupon->code }}</p></td>
                            <td class="text-center"><p>{{ $coupon->value }}</p></td>
                            <td class="text-center"><p>{{ $coupon->type == 1 ? 'percentage' : 'flat' }}</p></td>
                            <td class="text-center">
                                <a href="{{ route('admin.coupons.edit', ['coupon' => $coupon]) }}" class="btn btn-primary">{{ __('admin/categories.edit') }}</a>
                                <a href="{{ route('admin.coupons.delete', ['coupon' => $coupon]) }}" class="btn btn-primary">{{ __('admin/categories.delete') }}</a>
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
