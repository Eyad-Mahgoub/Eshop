<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true" >
    <div class="carousel-indicators">
        @php
            $i = 0;
        @endphp
        @foreach ($featured_products as $product)
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}" aria-current="{{ $i == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $i+1 }}"></button>
        @php
            $i++;
        @endphp
        @endforeach
    </div>
    <div class="carousel-inner bg-black d-flex justify-content-center p-5">
        @php
            $i = 0
        @endphp
        @foreach ($featured_products as $product)
        <div class="carousel-item {{ $i == 0 ? 'active' : '' }}" style="left:-250px">
            <a href="{{ route('product.details', ['category_slug' => $product->category->slug, 'product_slug' => $product->slug ]) }}">
                <img class="d-block" style="width: 250px; height: 250px" src="{{ asset('uploads/product/'.$product->image) }}" alt="First slide">
            </a>
            <div class="carousel-caption" style="left: 270px">
                <h5 class="text-start">{{ $product->name }}</h5>
                <p class="text-start">{{ $product->description }}</p>
            </div>
        </div>
        @php
            $i++;
        @endphp
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

