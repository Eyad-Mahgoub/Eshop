@extends('layouts.front')

@section('title')
{{ $product->name }}
@endsection

@section('lang')
<ul class="dropdown-menu">

    @foreach (config('laravellocalization.supportedLocales') as $key => $local)
        @if ($key != app()->getLocale())
            <li>
                <a class="dropdown-item" rel="alternate" hreflang="{{ $key }}" href="{{ LaravelLocalization::getLocalizedURL($key, route(Route::currentRouteName(), ['category_slug' => $product->category->translate($key)->slug, 'product_slug' => $product->translate($key)->slug])) }}">
                    {{ $local['native'] }} - {{ $key }}
                </a>
            </li>
        @endif

    @endforeach
</ul>
@endsection

@section('content')

<div class="container">
    <div class="card shadow my-5">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 border-right">
                    <img src="{{ asset('uploads/product/'.$product->image) }}" class="w-100">
                </div>
                <div class="col-md-8 d-flex flex-column justify-content-between product-data">
                    <div>
                        <h2 class="mb-0">
                            {{ $product->name }}
                            @if ($product->trending == 1)
                            <label style="font-size: 20px;" class="float-end badge bg-danger trending_tag" for="">Trending</label>
                            @endif
                        </h2>
                        <hr>
                        @for ($i = 0; $i < $rating; $i++)
                        <i class="fa fa-star" style="color: gold"></i>
                        @endfor
                        @for ($i = $rating;  $i < 5; $i++)
                        <i class="fa fa-star"></i>
                        @endfor

                        <small>{{ $ratingCount }} {{ __('frontend/index.ratings') }}</small>
                        <hr>
                    </div>


                    <div>
                        <label class="me-3">{{ __('frontend/index.price') }}: ${{ $product->selling_price }}</label>
                        <p class="mb-0">{{ __('frontend/index.description') }}: {{ $product->description }}</p>
                    </div>


                    <div>
                        <hr>
                        @if ($product->quantity > 0)
                            <label class="badge bg-success">{{ __('frontend/index.instock') }}</label>
                        @else
                            <label class="badge bg-success">{{ __('frontend/index.outofstock') }}</label>
                        @endif
                    </div>

                    @if (Auth::user())
                    <div class="d-flex justify-content-between ">
                        <div class="col-md-2">
                            <input id="prod_id" type="text" class="prod_id d-none" value="{{ $product->id }}">
                            <input id="prod_qty" type="text" class="prod_qty d-none" value="{{ $product->quantity }}">
                            <input type="text" class="d-none maxquantity" value="{{ $product->quantity }}">

                            @if ($product->quantity > 0)
                            <label for="Quantity">{{ __('frontend/index.quantity') }}</label>
                            <div class="input-group text-center mb-3">
                                <span id="decrementbtn" class="decrementbtn input-group-text">-</span>
                                <input id="quantity" type="text" name="quantity" value="1" class="quantity form-control text-center">
                                <span id="incrementbtn" class="incrementbtn input-group-text">+</span>
                            </div>
                            @endif
                        </div>

                        <div class="">
                            <br>
                            <button id="addtoWishlist" type="button" class="btn btn-success me-3 float-start">{{ __('frontend/index.addtowishlist') }}</button>
                            @if ($product->quantity > 0)
                            <button id="addtoCart" type="button" class="btn btn-primary me-3 float-start">{{ __('frontend/index.addtocart') }}</button>
                            @endif
                            @if ($owned)
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                {{ __('frontend/index.rateprod') }}
                            </button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="/add-rating" method="post">
                                            <input type="text" name="product_id" value="{{ $product->id }}" class="d-none">
                                            @csrf
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('frontend/index.rateprod') }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="rating-css">
                                                    <div class="star-icon">
                                                        @for ($i = 1; $i < $userRating + 1; $i++)
                                                        <input type="radio" value="{{ $i }}" name="product_rating" id="{{ "rating".$i }}" checked>
                                                        <label for="{{ "rating".$i }}" class="fa fa-star"></label>
                                                        @endfor
                                                        @for ($i = $userRating + 1; $i <= 5; $i++)
                                                        <input type="radio" value="{{ $i }}" name="product_rating" id="{{ "rating".$i }}">
                                                        <label for="{{ "rating".$i }}" class="fa fa-star"></label>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">{{ __('frontend/index.rateprod') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="my-3">
        <h3 class=""> {{ __('frontend/index.description') }} </h3>
        <div class="p-3">
            {!! $product->content !!}
        </div>
        <hr>
    </div>
    <div class="my-3">
        <h3> {{ __('frontend/index.reviews') }} </h3>

        @foreach ($reviews as $review)
        <div class="card shadow my-3 review-data">
            <div class="card-header d-flex bg-white">
                <div class="">
                    {{ $review->user->name }} -
                    @for ($i = 0; $i < $review->prodrating->rating; $i++)
                        <i class="fa fa-star" style="color: gold"></i>
                    @endfor
                    @for ($i = $review->prodrating->rating;  $i < 5; $i++)
                        <i class="fa fa-star"></i>
                    @endfor
                </div>
                <div class="ms-auto fw-lighter">
                    {{ $review->created_at->format('m/d/Y') }}
                </div>
            </div>
            <div class="card-body review-content">{{ $review->review }}</div>

            @if (Auth::id() == $review->user->id)
            <div class="card-footer">
                <div class="float-end">
                    <button type="button" class="modalbtn btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                        {{ __('frontend/index.edit') }}
                    </button>
                    <a href="{{ route('review.delete', ['review' => $review]) }}"><button class=" btn btn-primary">{{ __('frontend/index.delete') }}</button></a>
                </div>
            </div>
            @endif
        </div>
        @endforeach

        <div class="card shadow my-3">
            @if ($owned && Auth::user()->ratings->where('product_id', $product->id)->all() == [])
            <div class="card-body">
                <h4 class="mb-4">{{ __('frontend/index.writereview') }}</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    {{ __('frontend/index.rateprod') }}
                </button>
            </div>
            @elseif ($owned && Auth::user()->ratings->where('product_id', $product->id)->first()->review == [])
            <form action="/add-review" method="post">
                @csrf
                <div class="card-body">
                    <h4 class="mb-4">{{ __('frontend/index.reviewprod') }}</h4>
                    <input type="text" value="{{ Auth::user()->ratings->where('product_id', $product->id)->first()->id }}" class="d-none" name="rating_id">
                    <input type="text" value="{{ $product->id }}" class="d-none" name="product_id">
                    <textarea name="review" id="" rows="7" class="form-control" style="resize: none"></textarea>
                    @error('review')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="card-footer">
                    <button type="submit" class="float-end btn btn-primary">{{ __('admin/categories.submit') }}</button>
                </div>
            </form>
            @else
            @endif
        </div>

    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('frontend/index.edit') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/edit-review" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="text" name="product_id" value="{{ $product->id }}" class="d-none">
                        <div class=" input-group input-group-outline my-3">
                            <label class="form-label" for="">{{ __('frontend/index.edit') }}</label>
                            <textarea style="resize: none;" class="review-edit form-control w-100" name="review" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('admin/categories.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
<script>
    $(document).ready(function () {
        $('.review-data').on('click', '.modalbtn', function () {
            let review = $(this).closest('.review-data').find('.review-content').html() ;
            $('.review-edit').html(review);
        });
    });
</script>
@endsection
