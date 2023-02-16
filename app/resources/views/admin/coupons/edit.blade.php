@extends('layouts.admin')

@section('title')
    Edit Coupon
@endsection

@section('content')
<div class="container">
    <h1>Coupons</h1>

    <div class="card mt-3">
        <div class="card-header">
            <h4>Edit Coupon</h2>

            @if (session('message'))
                <div class="alert alert-danger">{{ session('message') }}</div>
            @endif
        </div>
        <div class="card-body">
            <form action="{{ route('admin.coupons.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="id" class="d-none" value="{{ $coupon->id }}">
                <div class="input-group input-group-outline my-3 focused is-focused">
                    <label class="form-label" for="">Name</label>
                    <input class="name form-control w-100 " type="text" name="name" value="{{ $coupon->name }}">
                    @error('name')
                        <small id="nameHelp" class="text-form text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="input-group input-group-outline my-3 focused is-focused">
                    <label class="form-label" for="">Code</label>
                    <input class="code form-control w-100 " type="text" name="code" value="{{ $coupon->code }}">
                    @error('code')
                        <small id="codeHelp" class="text-form text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="my-3">
                    <label class="form-label" for="">Discount Type</label>
                    <select name="type" class="discount-type form-select ps-3" aria-label="Default select example">
                        <option value="1" {{ $coupon->type == 1 ? 'selected' : '' }}>Percentage</option>
                        <option value="0" {{ $coupon->type == 0 ? 'selected' : '' }}>Flat Amount</option>
                    </select>
                    @error('type')
                        <small id="typeHelp" class="text-form text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="input-group input-group-outline my-3 focused is-focused">
                    <label class="form-label" for="">Value</label>
                    <input class="value form-control w-100 " type="number" name="value" value="{{ $coupon->value }}">
                    @error('value')
                        <small id="valueHelp" class="text-form text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="max-amount input-group input-group-outline my-3 {{ $coupon->max_amount ? 'focused is-focused' : '' }}">
                    <label class="form-label" for="">Max Amount Discounted</label>
                    <input class=" form-control w-100 " type="number" name="max_amount" value="{{ $coupon->max_amount ?? '' }}">
                    @error('max_amount')
                        <small id="max_amountHelp" class="text-form text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="input-group input-group-static my-3">
                    <label>Start Date</label>
                    <input name="start_date" type="date" class="form-control" value="{{ $coupon->start_date }}">
                </div>
                <div class="input-group input-group-static my-3">
                    <label>End Date</label>
                    <input name="end_date" type="date" class="form-control" value="{{ $coupon->end_date }}">
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
