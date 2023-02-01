@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>{{ __('admin/products.products') }}</h1>

        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __('admin/products.addprod') }}</h2>

            </div>
            <div class="card-body">
                <form action="{{ route('admin.product.create') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="my-3">
                        <label class="form-label" for="">{{ __('admin/categories.categories') }}</label>
                        <select name="category_id" class="form-select ps-3" aria-label="Default select example">
                            @foreach (App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            @foreach (config('translatable.locales') as $lang)
                            <button class="nav-link {{ $loop->index == 0 ? 'active' : '' }}" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-{{ $lang }}" type="button" role="tab" aria-controls="nav-home" aria-selected="true">{{ $lang }}</button>
                            @endforeach
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        @foreach (config('translatable.locales') as $lang)
                        <div class="proddetails tab-pane fade show {{ $loop->index == 0 ? 'active' : '' }}" id="nav-{{ $lang }}" role="tabpanel" aria-labelledby="nav-{{ $lang }}-tab" tabindex="0">
                            <div class="row">
                                <div class="col-8">
                                    <div class="input-group input-group-outline my-3 {{ old($lang.'.name') ? 'focused is-focused' : '' }}">
                                        <label class="form-label" for="">{{ __('admin/products.name') }}</label>
                                        <input class="name form-control w-100 " type="text" name="{{ $lang }}[name]" value="{{ old($lang.'.name') }}">
                                        @error($lang.'.name')
                                            <small id="nameHelp" class="text-form text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group input-group-outline my-3 focused is-focused">
                                        <label class="form-label " for="">Slug</label>
                                        <input id="slug" class="form-control w-100" type="text" name="{{ $lang }}[slug]" value="{{ old($lang.'.slug') }}">
                                        @error($lang.'.slug')
                                            <small id="small_descriptionHelp" class="text-form text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="input-group input-group-outline my-3 {{ old('small_description') ? 'focused is-focused' : '' }}">
                                <p class="mb-1">{{ __('admin/products.description') }}</p>
                                <textarea style="resize: none;" class="form-control w-100" name="{{ $lang }}[description]" rows="5">{{ old($lang.'.description') }}</textarea>
                                @error($lang.'.description')
                                    <small id="descriptionHelp" class="text-form text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="input-group input-group-outline my-3">
                                <p class="mb-1">{{ __('admin/products.content') }}</p>
                                <textarea id="summernote" class="form-control w-100" name="{{ $lang }}[content]" rows="5">{{ old($lang.'.content') }}</textarea>
                                @error($lang.'.content')
                                    <small id="descriptionHelp" class="text-form text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <h4>{{ __('admin/products.SEOTags') }}</h4>
                            <div class="input-group input-group-outline my-3 {{ old($lang.'.meta_title') ? 'focused is-focused' : '' }}">
                                <label class="form-label" for="">{{ __('admin/products.metatitle') }}</label>
                                <input type="text" class="form-control w-100" name="{{ $lang }}[meta_title]" value="{{ old($lang.'.meta_title') }}">
                                @error($lang.'.meta_description')
                                    <small id="meta_descriptionHelp" class="text-form text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="input-group input-group-outline my-3 {{ old($lang.'.meta_keyword') ? 'focused is-focused' : '' }}">
                                <label class="form-label" for="">{{ __('admin/products.metakeyword') }}</label>
                                <input type="text" class="form-control w-100" name="{{ $lang }}[meta_keyword]" value="{{ old($lang.'.meta_keyword') }}">
                                @error($lang.'.meta_keyword')
                                    <small id="meta_keywordHelp" class="text-form text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="input-group input-group-outline my-3 {{ old($lang.'.meta_description') ? 'focused is-focused' : '' }}">
                                <label class="form-label" for="">{{ __('admin/products.metadescription') }}</label>
                                <textarea style="resize: none;" class="form-control w-100" name="{{ $lang }}[meta_description]" rows="3">{{ old($lang.'.meta_description') }}</textarea>
                                @error($lang.'.meta_description')
                                    <small id="meta_descriptionHelp" class="text-form text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="form-check form-switch ps-0 my-3">
                        <label class="form-check-label" for="">{{ __('admin/products.status') }}</label>
                        <input class="form-check-input ms-auto " type="checkbox" name="status" id="flexSwitchCheckDefault" {{ old('status') ? 'checked' : '' }}>
                    </div>
                    <div class="form-check form-switch ps-0 my-3">
                        <label class="form-check-label" for="">{{ __('admin/products.trending') }}</label>
                        <input class="form-check-input ms-auto " type="checkbox" name="trending" id="flexSwitchCheckDefault" {{ old('trending') ? 'checked' : '' }}>
                    </div>

                    <h4>{{ __('admin/products.pricingdetails') }}</h4>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class=" input-group input-group-outline my-3 {{ old('original_price') ? 'focused is-focused' : '' }}">
                                <label class="form-label" for="">{{ __('admin/products.ogprice') }}</label>
                                <input id="originalPrice" class="form-control price-stuff w-100" type="text" name="original_price" id="" value="{{ old('original_price') }}">
                                @error('original_price')
                                    <small id="original_priceHelp" class="text-form text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="input-group input-group-outline mb-3 col-lg-4 {{ old('tax') ? 'focused is-focused' : '' }}">
                                <label class="form-label" for="">{{ __('admin/products.tax') }}</label>
                                <input id="tax" class="form-control w-100 price-stuff" type="text" name="tax" value="{{ old('tax') }}">
                                @error('tax')
                                    <small id="taxHelp" class="text-form text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-8">
                            <div class=" input-group input-group-outline my-3 focused is-focused">
                                <label class="form-label" for="sellingPrice">{{ __('admin/products.sellingprice') }}</label>
                                <p class="form-control" id="sellingPrice">$0.00{{ old('selling_price') }}</p>
                                @error('selling_price')
                                    <small id="selling_priceHelp" class="text-form text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
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
        function convertToSlug(Text) {
            return Text.toString().toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^\w\u0621-\u064A0-9-]+/g, '')
                .replace(/\-\-+/g, '-')
                .replace(/^-+/, '').replace(/-+$/, '');
        };

        $(document).ready(function () {
            $('.name').keyup(function (e) {
                $(this).closest('.proddetails').find('#slug').val(convertToSlug($(this).val()))
            });
        });

        $(document).ready(function () {
            $('.price-stuff').keyup(function (e) {
                let tax = $('#tax').val();
                let originalPrice = $('#originalPrice').val();
                let selling = $('#sellingPrice')

                if (tax) {
                    let total = originalPrice * (1 + tax/100);
                    selling.html("$"+parseFloat(total).toFixed(2));
                } else {
                    selling.html("$"+parseFloat(originalPrice).toFixed(2));
                }


            });
        });
    </script>
@endsection
