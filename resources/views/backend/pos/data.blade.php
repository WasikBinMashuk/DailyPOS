@foreach ($products as $product)
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mt-2">
        <a href="javascript:void(0)" class="pos-product-card" data-id="{{ $product->product->id }}"
            data-name="{{ $product->product->product_name }}" data-price="{{ $product->product->price }}"
            data-stock="{{ $product->quantity }}" style="text-decoration: none;">
            <div class="card shadow" style="width: 8rem; height: 8rem;" title="{{ $product->product->product_name }}">
                <div class="card-body" style="text-align: center">
                    @if ($product->product->product_image)
                        <img src="{{ asset('images/' . $product->product->product_image) }}" class="card-img-top"
                            style="height: 40px; width:40px;">
                    @else
                        <img src="{{ asset('images/no.jpg') }}" class="card-img-top" style="height: 40px; width:40px;"
                            alt="...">
                    @endif
                </div>
                <div class="card-body" style="text-align: center">
                    <p class="card-text text-wrap fs-5 fw-bolder">
                        @if (strlen($product->product->product_name) > 15)
                            {{-- Adjust the character limit as needed --}}
                            {{ substr($product->product->product_name, 0, 15) }}...
                        @else
                            {{ $product->product->product_name }}
                        @endif
                    </p>
                </div>
            </div>
        </a>
    </div>
@endforeach
