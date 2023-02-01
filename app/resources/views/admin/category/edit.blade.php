@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>{{ __('admin/categories.categories') }}</h1>

        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __('admin/categories.editcat') }}</h2>

            </div>
            <div class="card-body">
                <form action="{{ route('admin.category.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" class="d-none" name='id' value="{{ $category->id }}">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            @foreach (config('translatable.locales') as $lang)
                            <button class="nav-link {{ config('app.locale') == $lang ? 'active' : '' }}" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-{{ $lang }}" type="button" role="tab" aria-controls="nav-home" aria-selected="true">{{ $lang }}</button>
                            @endforeach
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        @foreach (config('translatable.locales') as $lang)
                        <div class="tab-pane fade show {{ config('app.locale') == $lang ? 'active' : '' }}" id="nav-{{ $lang }}" role="tabpanel" aria-labelledby="nav-{{ $lang }}-tab" tabindex="0">
                            <div class="row catdetails">
                                <div class="col-8">
                                    <div class="input-group input-group-outline my-3 focused is-focused">
                                        <label class="form-label" for="">{{ __('admin/categories.name') }}</label>
                                        <input class="name form-control w-100 " type="text" name="{{ $lang }}[name]" value="{{ $category->translate($lang)->name }}">
                                        @error($lang.'.name')
                                            <small id="nameHelp" class="text-form text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group input-group-outline my-3 focused is-focused">
                                        <label class="form-label " for="">Slug</label>
                                        <input id="slug" class="form-control w-100" type="text" name="{{ $lang }}[slug]" value="{{ $category->translate($lang)->slug }}">
                                        @error($lang.'.slug')
                                            <small id="slugHelp" class="text-form text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="input-group input-group-outline my-3 focused is-focused">
                                <label class="form-label" for="">{{ __('admin/categories.description') }}</label>
                                <textarea style="resize: none;" class="form-control w-100" name="{{ $lang }}[description]" rows="5">{{ $category->translate($lang)->description }}</textarea>
                                @error($lang.'.description')
                                    <small id="descriptionHelp" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <h4>{{ __('admin/categories.SEOTags') }}</h4>
                            <div class="input-group input-group-outline my-3 focused is-focused">
                                <label class="form-label" for="">Meta Title</label>
                                <input type="text" class="form-control w-100" name="{{ $lang }}[meta_title]" value="{{ $category->translate($lang)->meta_title }}">
                                @error($lang.'.meta_title')
                                    <small id="meta_titleHelp" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="input-group input-group-outline my-3 focused is-focused">
                                <label class="form-label" for="">Meta Keyword</label>
                                <input type="text" class="form-control w-100" name="{{ $lang }}[meta_keyword]" value="{{ $category->translate($lang)->meta_keyword }}">
                                @error($lang.'.meta_keyword')
                                    <small id="meta_keywordHelp" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="input-group input-group-outline my-3 focused is-focused">
                                <label class="form-label" for="">Meta Description</label>
                                <textarea style="resize: none;" class="form-control w-100" name="{{ $lang }}[meta_description]" rows="3">{{ $category->translate($lang)->meta_description }}</textarea>
                                @error($lang.'.meta_description')
                                    <small id="meta_descriptionHelp" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        @endforeach
                    </div>


                    <div class="form-check form-switch ps-0 my-3">
                        <label class="form-check-label" for="">{{ __('admin/categories.status') }}</label>
                        <input class="form-check-input ms-auto" type="checkbox" name="status" id="flexSwitchCheckDefault" {{ $category->status == 1 ? 'checked' : '' }}>
                    </div>
                    <div class="form-check form-switch ps-0 my-3">
                        <label class="form-check-label" for="">{{ __('admin/categories.popular') }}</label>
                        <input class="form-check-input ms-auto" type="checkbox" name="popular" id="flexSwitchCheckDefault" {{ $category->popular == 1 ? 'checked' : '' }}>
                    </div>

                    <div class="input-group input-group-outline my-3">
                        <input type="file" name="image" class="form-control">
                        @error('image')
                            <small id="imageHelp" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button class="btn btn-primary" type="submit">{{ __('admin/categories.submit') }}</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        function convertToSlug(Text) {
           return Text.toLowerCase()
                    .replace(/ /g, '-')
                    .replace(/[^\w-]+/g, '');
        }

        $(document).ready(function () {
            $('#name').keyup(function (e) {
                $('#slug').val(convertToSlug($('#name').val()));
            });
        });
    </script>
@endsection
