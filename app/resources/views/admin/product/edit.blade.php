@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>{{ __('admin/products.products') }}</h1>

        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __('admin/products.editprod') }}</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

            </div>
            <div class="card-body">
                <form action="{{ route('admin.product.update') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="text" name="id" value="{{ $product->id }}" class="d-none">

                    <div class="my-3">
                        <label class="form-label" for="">{{ __('admin/categories.categories') }}</label>
                        <select name="category_id" class="form-select ps-3" aria-label="Default select example">
                            @foreach (App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $product->category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            @foreach (config('translatable.locales') as $lang)
                            <button class="nav-link {{ config('app.locale') == $lang ? 'active' : '' }}" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-{{ $lang }}" type="button" role="tab" aria-controls="nav-home" aria-selected="true">{{ $lang }}</button>
                            @endforeach
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        @foreach (config('translatable.locales') as $lang)
                        <div class="proddetails tab-pane fade show {{ config('app.locale') == $lang ? 'active' : '' }}" id="nav-{{ $lang }}" role="tabpanel" aria-labelledby="nav-{{ $lang }}-tab" tabindex="0">
                            <div class="row">
                                <div class="col-8">
                                    <div class="input-group input-group-outline my-3 focused is-focused">
                                        <label class="form-label" for="">{{ __('admin/products.name') }}</label>
                                        <input class="name form-control w-100 " type="text" name="{{ $lang }}[name]" value="{{ $product->translate($lang)->name }}">
                                        @error($lang.'.name')
                                            <small id="nameHelp" class="text-form text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group input-group-outline my-3 focused is-focused">
                                        <label class="form-label " for="">Slug</label>
                                        <input id="slug" class="form-control w-100" type="text" name="{{ $lang }}[slug]" value="{{ $product->translate($lang)->slug }}">
                                        @error($lang.'.slug')
                                            <small id="small_descriptionHelp" class="text-form text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="input-group input-group-outline my-3 focused is-focused">
                                <p class="mb-1">{{ __('admin/products.description') }}</p>
                                <textarea style="resize: none;" class="form-control w-100" name="{{ $lang }}[description]" rows="5">{{ $product->translate($lang)->description }}</textarea>
                                @error($lang.'.description')
                                    <small id="descriptionHelp" class="text-form text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="input-group input-group-outline my-3">
                                <p class="mb-1">{{ __('admin/products.content') }}</p>
                                <textarea id="summernote" class="form-control w-100" name="{{ $lang }}[content]" rows="5">{{ $product->translate($lang)->content }}</textarea>
                                @error($lang.'.content')
                                    <small id="descriptionHelp" class="text-form text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <h4>{{ __('admin/products.SEOTags') }}</h4>
                            <div class="input-group input-group-outline my-3 focused is-focused">
                                <label class="form-label" for="">{{ __('admin/products.metatitle') }}</label>
                                <input type="text" class="form-control w-100" name="{{ $lang }}[meta_title]" value="{{ $product->translate($lang)->meta_title }}">
                                @error($lang.'.meta_description')
                                    <small id="meta_descriptionHelp" class="text-form text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="input-group input-group-outline my-3 focused is-focused">
                                <label class="form-label" for="">{{ __('admin/products.metakeyword') }}</label>
                                <input type="text" class="form-control w-100" name="{{ $lang }}[meta_keyword]" value="{{ $product->translate($lang)->meta_keyword }}">
                                @error($lang.'.meta_keyword')
                                    <small id="meta_keywordHelp" class="text-form text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="input-group input-group-outline my-3 focused is-focused">
                                <label class="form-label" for="">{{ __('admin/products.metadescription') }}</label>
                                <textarea style="resize: none;" class="form-control w-100" name="{{ $lang }}[meta_description]" rows="3">{{ $product->translate($lang)->meta_description }}</textarea>
                                @error($lang.'.meta_description')
                                    <small id="meta_descriptionHelp" class="text-form text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="form-check form-switch ps-0 my-3">
                        <label class="form-check-label" for="">{{ __('admin/products.status') }}</label>
                        <input class="form-check-input ms-auto" type="checkbox" name="status" id="flexSwitchCheckDefault" {{ $product->status == 1 ? 'checked' : '' }}>
                    </div>
                    <div class="form-check form-switch ps-0 my-3">
                        <label class="form-check-label" for="">{{ __('admin/products.trending') }}</label>
                        <input class="form-check-input ms-auto" type="checkbox" name="trending" id="flexSwitchCheckDefault" {{ $product->trending == 1 ? 'checked' : '' }} >
                    </div>

                    <h4>{{ __('admin/products.pricingdetails') }}</h4>
                    <div class=" input-group input-group-outline my-3 focus is-focused">
                        <label class="form-label" for="">{{ __('admin/products.ogprice') }}</label>
                        <input id="originalPrice" class="form-control price-calc" type="text" name="original_price" id="" value="{{ $product->original_price }}">
                    </div>
                    <div class=" input-group input-group-outline my-3 focus is-focused">
                        <label class="form-label" for="">{{ __('admin/products.sellingprice') }}</label>
                        <input id="sellingPrice" class="form-control" type="text" name="selling_price" id="" value="{{ $product->selling_price }}">
                    </div>
                    <div class="input-group input-group-outline mb-3 col-lg-4 focus is-focused">
                        <label class="form-label" for="">{{ __('admin/products.tax') }}</label>
                        <input id="tax" class="form-control price-calc" type="text" name="tax" id="" value="{{ $product->tax }}">
                    </div>

                    <div class="input-group input-group-outline my-3">
                        <input type="file" name="image" class="form-control w-100" value="{{ old('image') }}">
                        @error('image')
                            <small id="imageHelp" class="text-form text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <button class="btn btn-primary" type="submit">{{ __('admin/products.submit') }}</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.price-calc').keyup(function (e) {
                let tax = $('#tax').val();
                let originalPrice = $('#originalPrice').val();
                let selling = $('#sellingPrice')

                if (tax) {
                    let total = originalPrice * (1 + tax/100);
                    selling.val(parseInt(total));
                } else {
                    selling.val(originalPrice);
                }


            });
        });
    </script>
@endsection
