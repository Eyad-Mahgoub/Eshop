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
                        <tr class="coupon-data">
                            <td class="coupon-id text-center">{{ $coupon->id }}</td>
                            <td class="text-center"><h6>{{ $coupon->name }}</h6></td>
                            <td class="text-center"><p>{{ $coupon->code }}</p></td>
                            <td class="text-center"><p>{{ $coupon->value }}</p></td>
                            <td class="text-center"><p>{{ $coupon->type == 1 ? 'percentage' : 'flat' }}</p></td>
                            <td class="text-center">
                                <a href="{{ route('admin.coupons.edit', ['coupon' => $coupon]) }}" class="btn btn-primary">{{ __('admin/categories.edit') }}</a>
                                <a href="{{ route('admin.coupons.delete', ['coupon' => $coupon]) }}" class="btn btn-primary">{{ __('admin/categories.delete') }}</a>
                                <button class="addprods btn btn-primary">Add Products</button>
                            </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>
<div class="modal fade" id="addproducts" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Products</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.coupons.addproducts') }}" method="post">
                    @csrf
                    <input type="text" name="coupon_id" id="coupon_id" class="d-none">
                    <select name="category" class="categories form-select ps-3 mb-3" aria-label="Default select example">
                        <option value="-1">Select Category</option>
                        @foreach (App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div class="spinner-border d-none" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <select name="product_id" class="form-select ps-3 mb-3 products">

                    </select>
                    <button type="submit" class="save-button btn btn-primary d-none">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
$(document).ready(function () {
    if ($('.categories option:selected').val() == -1) $('.products').hide();

    $(document).on('click','.addprods' ,function () {
        $('#coupon_id').val($(this).closest('.coupon-data').find('.coupon-id').text());
        $('#addproducts').modal('toggle');
    });

    $('.categories').change(function (e) {
        e.preventDefault();
        let catId = $('.categories option:selected').val();

        if (catId == -1) $('.products').hide();
        else {
            $('.spinner-border').removeClass('d-none');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "/getproducts",
                data: {
                    'id': catId
                },
                success: function (response) {
                    response.forEach(function (product) {
                        $('.spinner-border').addClass('d-none');
                        $('.save-button').removeClass('d-none');
                        $('.products').show();
                        $('.products').append('<option value="'+ product.id +'">'+ product.name +'</option>');
                    });
                }
            });

        }

    });
});
</script>
@endsection
