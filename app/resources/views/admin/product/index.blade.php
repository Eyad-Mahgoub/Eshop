@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row my-3">
            <div class="d-flex justify-content-between">
                <h1>{{ __('admin/products.products') }}</h1>
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary">{{ __('admin/products.addprod') }}</a>
            </div>

            @if ($products->isEmpty())
            <div class="card p-5 d-flex justify-content-center align-items-center">
                <h2>{{ __('admin/products.empty') }}</h2>
            </div>
            @else
            <div class="card p-3">
                <div class="table-responsive p-0">
                    <table id="product-table" class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('admin/products.name') }}</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('admin/categories.categories') }}</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('admin/products.sellingprice') }}</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('admin/products.image') }}</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('admin/products.more') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td class="text-center">{{ $product->id }}</td>
                                <td class="text-center">{{ $product->name }}</td>
                                <td class="text-center">{{ $product->category->name }}</td>
                                <td class="text-center">${{ $product->selling_price }}</td>
                                <td class="text-center"><img src="{{ asset('/uploads/product/'.$product->image) }}" class="" height="100" width="100"></td>
                                <td class="text-center">
                                    <a href="{{ route('admin.product.edit', ['product' => $product]) }}" class="btn btn-primary">{{ __('admin/products.edit') }}</a>
                                    <button type="button" class="modalbtn btn btn-primary" data-bs-toggle="modal" data-bs-target="#quantityModal">
                                        {{ __('admin/products.addquantity') }}
                                    </button>
                                    <a href="{{ route('admin.product.delete', ['product' => $product]) }}" class="btn btn-primary">{{ __('admin/products.delete') }}</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="modal fade" id="quantityModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('admin/products.addquantity') }}</h5>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <form action="/add-quantity" method="post">
                @csrf
                <div class="modal-body">
                    <div class=" input-group input-group-outline my-3">
                        <label class="form-label" for="">{{ __('admin/products.amount') }}</label>
                        <input class="form-control" type="number" name="quantity">
                    </div>
                    <input type="text" name="product_id" class="product-id d-none">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('admin/products.submit') }}</button>
                </div>
            </form>

            </div>
        </div>
    </div>
@endsection


@section('scripts')
<script>
    $(document).ready(function () {
        $('#product-table').on('click', '.modalbtn', function () {
            let currentRow = $(this).closest('tr');
            let id = currentRow.find('td:eq(0)').text();
            $('.product-id').val(id);
        });
    });
</script>
@endsection

