@extends('layouts.admin')

@section('title')
    Add Coupon
@endsection

@section('content')
<div class="container">
    <h1>Coupons</h1>

    <div class="card mt-3">
        <div class="card-header">
            <h4>Add Coupon</h2>

            @if (session('message'))
                <div class="alert alert-danger">{{ session('message') }}</div>
            @endif
        </div>
        <div class="card-body">
            <form action="{{ route('admin.coupons.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="input-group input-group-outline my-3 ">
                    <label class="form-label" for="">Name</label>
                    <input class="name form-control w-100 " type="text" name="name" value="{{ old('name') }}">
                    @error('name')
                        <small id="nameHelp" class="text-form text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="input-group input-group-outline my-3 ">
                    <label class="form-label" for="">Code</label>
                    <input class="code form-control w-100 " type="text" name="code" value="{{ old('code') }}">
                    @error('code')
                        <small id="codeHelp" class="text-form text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="my-3">
                    <label class="form-label" for="">Discount Type</label>
                    <select name="type" class="discount-type form-select ps-3" aria-label="Default select example">
                        <option value="1">Percentage</option>
                        <option value="0">Flat Amount</option>
                    </select>
                    @error('type')
                        <small id="typeHelp" class="text-form text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="input-group input-group-outline my-3 ">
                    <label class="form-label" for="">Value</label>
                    <input class="value form-control w-100 " type="number" name="value" value="{{ old('value') }}">
                    @error('value')
                        <small id="valueHelp" class="text-form text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="max-amount input-group input-group-outline my-3 ">
                    <label class="form-label" for="">Max Amount Discounted</label>
                    <input class=" form-control w-100 " type="number" name="max_amount" value="{{ old('max_amount') }}">
                    @error('max_amount')
                        <small id="max_amountHelp" class="text-form text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="input-group input-group-static my-3">
                    <label>Start Date</label>
                    <input name="start_date" type="date" class="form-control">
                </div>
                <div class="input-group input-group-static my-3">
                    <label>End Date</label>
                    <input name="end_date" type="date" class="form-control">
                </div>

                <button class="btn btn-primary" type="submit">{{ __('admin/categories.submit') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        if ($('.discount-type option:selected').val() == 0) $('.max-amount').hide();

        $('.discount-type').change(function () {
            if ($('.discount-type option:selected').val() == 1) $('.max-amount').show();
            else $('.max-amount').hide();
        });
    });
</script>
@endsection
