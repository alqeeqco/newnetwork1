<table class="table axil-product-table axil-wishlist-table">
    <thead>
    <tr>
        <th scope="col" class="product-remove"></th>
        <th scope="col" class="product-thumbnail">{{ __('lang.Product') }}</th>
        <th scope="col" class="product-title"></th>
        <th scope="col" class="product-price">{{ __('lang.price') }}</th>
        <th scope="col" class="product-add-cart">{{ __('lang.Colors') }}</th>
        <th scope="col" class="product-title"></th>

    </tr>
    </thead>

    <tbody>
    @foreach($favorites as $favorite)
        <tr>
            <td class="product-remove">

                <button type="submit" class="remove-wishlist" data-id="{{ $favorite->id }}">
                    <i class="fal fa-times"></i>
                </button>

            </td>
            <td class="product-thumbnail">
                <a href="{{ route('product.show', $favorite->product->id) }}">
                    <img src="{{ Request::root() . '/dashboard/images/' . $favorite->product->image }}" alt="Digital Product">
                </a>
            </td>
            <td class="product-title">
                <a href="{{ route('product.show', $favorite->product->id) }}">
                    @if(  app()->getLocale() == 'en')
                        {{ $favorite->product->name_en }}
                    @else
                        {{ $favorite->product->name_ar }}
                    @endif
                </a>
            </td>
            <td class="product-price" data-title="Price">
                <span class="currency-symbol">{{ __('lang.sar') }}</span>


                {{ number_format(($favorite->product->price - ($favorite->product->price * $favorite->product->discount/100))  + (($tax_tax/100) * $favorite->product->price) , 2) }}
                <br>
                <span class="text-tax">{{__('lang.tax_pro')}}</span>
            </td>
            <td class="product-add-cart">
                <div class="color-variant-wrapper">
                    <ul class="color-variant">
                        @foreach($favorite->product->colors as $colors)
                            <li class="mx-2 color-extra-01">
                            <div class="box-color d-flex">
                                <div class="container-color-box d-flex mb-4">
                                    <input name="color" class="color" type="radio" data-id="{{ $favorite->product->id }}" id="color-{{ $colors->id }}"
                                           value="{{ $colors->color }}" data-color="{{ $colors->color }}"/>
                                    <label for="color-{{ $colors->id }}" style="--myVar:{{ $colors->color }};"></label>
                                </div>
                            </div>
{{--                                <span class="color-name mx-2 py-1 px-3"> {{ $colors->color }}</span>--}}
{{--                                <span style="background-color:{{ $colors->color }}" class="color"></span>--}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </td>
            <td>
                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="color" id="colorForm{{ $favorite->product->id }}">

                    <input type="hidden" name="quantity" id="in_quantity_{{ $favorite->product->id }}">

                    <input type="hidden" name="product_id" value="{{ $favorite->product->id }}">

                    <button type="submit" id="cart-btn" class="add-product" data-id="{{ $favorite->product->id }}">
                        {{ __('lang.add-cart') }}
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
