@foreach ($products as $product)
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mt-2">
        <a href="javascript:void(0)" class="pos-product-card" data-id="{{ $product->id }}"
            data-name="{{ $product->product_name }}" data-price="{{ $product->price }}" style="text-decoration: none;">
            <div class="card shadow" style="width: 8rem; height: 8rem;">
                <div class="card-body" style="text-align: center">
                    @if ($product->product_image)
                        <img src="{{ asset('images/' . $product->product_image) }}" class="card-img-top"
                            style="height: 40px; width:40px;">
                    @else
                        <img src="{{ asset('images/no.jpg') }}" class="card-img-top" style="height: 40px; width:40px;"
                            alt="...">
                    @endif
                </div>
                {{-- <img src="..." class="card-img-top" alt="..."> --}}
                <div class="card-body" style="text-align: center">
                    <p class="card-text text-wrap fs-5 fw-bolder">
                        {{ $product->product_name }}
                    </p>
                </div>
            </div>
        </a>
    </div>
@endforeach