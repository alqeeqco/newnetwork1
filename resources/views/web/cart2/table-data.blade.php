
    <div class="product-table-heading" id="remove_div">
        <h4 class="title">
            {{ __('lang.your_cart') }}
        </h4>
        @if( $items->get()->count() > 0 )
        <form action="#" method="POST">
            @csrf
            <button type="submit" class="cart-clear" style="background-color: transparent;">
                {{ __('lang.clear_cart') }}
            </button>
        </form>
        @endif
    </div>

    <div class="table-responsive" id="remove_div">
        <table class="table axil-product-table axil-cart-table mb--40">
            <thead>
                <tr>
                    <th scope="col" class="product-remove"></th>
                    <th scope="col" class="product-thumbnail">
                        {{ __('lang.product') }}
                    </th>
                    <th scope="col" class="product-title"></th>
                    <th scope="col" class="product-price">
                        {{ __('lang.price') }}
                    </th>
                    <th scope="col" class="product-quantity">
                        {{ __('lang.quantity') }}
                    </th>
                    <th scope="col" class=color-row">
                        {{ __('lang.Colors') }}
                    </th>
                    <th scope="col" class="product-subtotal">
                        {{ __('lang.subtotal') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @if( $items->get()->count() > 0 )
                @foreach($items->get() as $item)
                <tr>
                    <td class="product-remove">
                        <form action="{{ route('cart.delete', ['id' => $item->id]) }}">
                            @csrf
                            @method('DELETE')

<<<<<<< Updated upstream
=======
<<<<<<< Updated upstream
                                <button type="submit" class="remove-wishlist" data-id="{{ $item->id }}">
                                    <i class="fal fa-times"></i>
                                </button>
                            </form>
                        </td>
                        <td class="product-thumbnail">
                            <a href="{{ route('product.show', ['id' => $item->product->id]) }}">
                                <img src="{{ Request::root() . '/dashboard/images/' . $item->product->image }}"
                                     alt="Digital Product">
                            </a>
                        </td>
                        <td class="product-title">
                            <a href="{{ route('product.show', ['id' => $item->product->id]) }}">
                                {{ $item->product->name_en }}
                            </a>
                        </td>
                        <td class="product-price" data-title="Price"
                        ><span class="currency-symbol">
                                            SAR</span>
                            {{ $item->product->price }}
                        </td>
                        <td class="product-quantity" data-title="Qty">
                            <div class="pro-qty">
                                <span class="dec qtybtn" id="qty-btn-mix" data-id="{{ $item->id }}">-</span>
                                <input type="number" id="qty_input" max="{{ $item->product->quantity }}" class="quantity-input"
                                       style="pointer-events: none" data-id="{{ $item->id }}"
                                       value="{{ $item->quantity }}">
                                <span class="inc qtybtn" id="qty-btn-max" data-id="{{ $item->id }}">+</span>
                            </div>
                        </td>
                        <td>
                            <div class="container-color-box d-flex mb-4">
                                <div
                                    style="background-color: {{ $item->color }}; width: 15px; height: 15px; border-radius: 50%;"
                                    title="{{ $item->color }}"></div>
                            </div>
                        </td>
                        <td class="product-subtotal" data-title="Subtotal"><span class="currency-symbol">SAR</span>
                            {{ $item->product->price * $item->quantity }}
                        </td>
                    </tr>
=======
>>>>>>> Stashed changes
                            <button type="submit" class="remove-wishlist" data-id="{{ $item->id }}">
                                <i class="fal fa-times"></i>
                            </button>
                        </form>
                    </td>
                    <td class="product-thumbnail">
                        <a href="{{ route('product.show', ['id' => $item->product->id]) }}">
                            <img src="{{ Request::root() . '/dashboard/images/' . $item->product->image }}" alt="Digital Product">
                        </a>
                    </td>
                    <td class="product-title">
                        <a href="{{ route('product.show', ['id' => $item->product->id]) }}">
                            {{ $item->product->name_en }}
                        </a>
                    </td>
                    <td class="product-price" data-title="Price"><span class="currency-symbol">
                            SAR</span>
                        {{ $item->product->price }}
                    </td>
                    <td class="product-quantity" data-title="Qty">
                        <div class="pro-qty">
                            <span class="dec qtybtn" id="qty-btn-mix" data-id="{{ $item->id }}">-</span>
<<<<<<< Updated upstream
                            <input type="number" id="qty_input" max="{{ $item->product->quantity }}" class="quantity-input" style="pointer-events: none" data-id="{{ $item->id }}" value="{{ $item->quantity }}">
=======
                                <input type="number" id="qty_input"  class="quantity-input" style="pointer-events: none" data-id="{{ $item->id }}" value="{{ $item->quantity }}">
>>>>>>> Stashed changes
                            <span class="inc qtybtn" id="qty-btn-max" data-id="{{ $item->id }}">+</span>
                        </div>
                    </td>
                    <td>
                        <div class="container-color-box d-flex mb-4">
                            <div style="background-color: {{ $item->color }}; width: 15px; height: 15px; border-radius: 50%;" title="{{ $item->color }}"></div>
                        </div>
                    </td>
                    <td class="product-subtotal" data-title="Subtotal"><span class="currency-symbol">SAR</span>
                        {{ $item->product->price * $item->quantity }}
                    </td>
                </tr>
<<<<<<< Updated upstream
=======
>>>>>>> Stashed changes
>>>>>>> Stashed changes
                @endforeach
                @else
                <tr>
                    <td class="text-center text-danger" colspan="7">
                        {{ __('lang.no_product') }}
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    @if( $items->get()->count() > 0 )
<<<<<<< Updated upstream
    <div class="cart-update-btn-area">
        @if( $coupon )
        <form action="{{ route('cart.coupon') }}" id="coupon_form" method="POST">
            @csrf
            <div class="input-group product-cupon">
                <input placeholder="{{ __('lang.enter_coupon_code') }}" id="input_cancel_coupon" name="coupon" type="text" disabled>
                <div class="product-cupon-btn">
                    <button type="submit" class="axil-btn btn-outline" id="coupon_cancel" style="background-color: red; color: white;">
                        {{ __('lang.cancel') }}
                    </button>
                </div>
            </div>
        </form>
        {{-- <span class="text-success">--}}
        {{-- {{ __('lang.coupon_exists') }}--}}
        {{-- </span>--}}
        @else
        <form action="{{ route('cart.coupon') }}" id="coupon_form" method="POST">
            @csrf
            <div class="input-group product-cupon">
                <input placeholder="{{ __('lang.enter_coupon_code') }}" id="coupon" name="coupon" type="text">
                <div class="product-cupon-btn">
                    <button type="submit" class="axil-btn btn-outline couponBtn">
                        {{ __('lang.apply') }}
                    </button>
                </div>
            </div>
        </form>
        @endif
    </div>
    @endif

    @if( $items->get()->count() > 0 )
    <div class="row orderDetails">
=======
<<<<<<< Updated upstream
        <div class="cart-update-btn-area">
            @if( $coupon )
                <form action="{{ route('cart.coupon') }}" id="coupon_form" method="POST">
                    @csrf
                    <div class="input-group product-cupon">
                        <input placeholder="{{ __('lang.enter_coupon_code') }}" id="input_cancel_coupon" name="coupon"
                               type="text" disabled>
                        <div class="product-cupon-btn">
                            <button type="submit" class="axil-btn btn-outline" id="coupon_cancel"
                                    style="background-color: red; color: white;">
                                {{ __('lang.cancel') }}
                            </button>
                        </div>
                    </div>
                </form>
                {{--            <span class="text-success">--}}
                {{--            {{ __('lang.coupon_exists') }}--}}
                {{--        </span>--}}
            @else
                <form action="{{ route('cart.coupon') }}" id="coupon_form" method="POST">
                    @csrf
                    <div class="input-group product-cupon">
                        <input placeholder="{{ __('lang.enter_coupon_code') }}" id="coupon" name="coupon" type="text">
                        <div class="product-cupon-btn">
                            <button type="submit" class="axil-btn btn-outline couponBtn">
                                {{ __('lang.apply') }}
                            </button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    @endif

    @if( $items->get()->count() > 0 )
        <div class="row orderDetails">
            <div class="col-xl-5 col-lg-7 offset-xl-7 offset-lg-5">
                <div class="axil-order-summery mt--80">
                    <h5 class="title mb--20">
                        {{ __('lang.order_summery') }}
                    </h5>
                    <div class="summery-table-wrap">
                        <table class="table summery-table mb--30">
                            <tbody>
=======
    <div class="cart-update-btn-area" id="remove_div">
        @if( $coupon )
        <form action="{{ route('cart.coupon') }}" id="coupon_form" method="POST">
            @csrf
            <div class="input-group product-cupon">
                <input placeholder="{{ __('lang.enter_coupon_code') }}" id="input_cancel_coupon" name="coupon" type="text" disabled>
                <div class="product-cupon-btn">
                    <button type="submit" class="axil-btn btn-outline" id="coupon_cancel" style="background-color: red; color: white;">
                        {{ __('lang.cancel') }}
                    </button>
                </div>
            </div>
        </form>
        {{-- <span class="text-success">--}}
        {{-- {{ __('lang.coupon_exists') }}--}}
        {{-- </span>--}}
        @else
        <form action="{{ route('cart.coupon') }}" id="coupon_form" method="POST">
            @csrf
            <div class="input-group product-cupon">
                <input placeholder="{{ __('lang.enter_coupon_code') }}" id="coupon" name="coupon" type="text">
                <div class="product-cupon-btn">
                    <button type="submit" class="axil-btn btn-outline couponBtn">
                        {{ __('lang.apply') }}
                    </button>
                </div>
            </div>
        </form>
        @endif
    </div>
    @endif

    @if( $items->get()->count() > 0 )
    <div class="row orderDetails" id="remove_div">
>>>>>>> Stashed changes
        <div class="col-xl-5 col-lg-7 offset-xl-7 offset-lg-5">
            <div class="axil-order-summery mt--80">
                <h5 class="title mb--20">
                    {{ __('lang.order_summery') }}
                </h5>
                <div class="summery-table-wrap">
                    <table class="table summery-table mb--30">
                        <tbody>
<<<<<<< Updated upstream
=======
>>>>>>> Stashed changes
>>>>>>> Stashed changes
                            <tr class="order-subtotal">
                                <td>
                                    {{ __('lang.subtotal') }}
                                </td>
                                <td class="total" id="subtotal">
                                    {{ $items->total() }}
                                </td>
                            </tr>
                            <tr class="order-shipping">
                                <td>{{ __('lang.shipping') }}</td>
                                <td>
                                    <div class="input-group">
                                        <input type="radio" id="shipping_value-0" data-id="0" value="0" class="shipping_value" name="shipping" checked>
                                        <label for="shipping_value-0">
                                            {{ __('lang.free_shipping') }}</label>
                                    </div>
                                    @foreach( $shipping_options as $option )
                                    <div class="input-group">
                                        <input type="radio" id="shipping_value-{{ $option->id }}" data-id="{{ $option->id }}" class="shipping_value" name="shipping" value="{{ round($option->price) }}">
                                        @if( app()->getLocale() == 'en' )
                                        <label for="shipping_value-{{ $option->id }}">{{ $option->name_en }}
                                            : {{ round($option->price)  }}</label>
                                        @else
                                        <label for="shipping_value-{{ $option->id }}">{{ $option->name_ar }}
                                            : {{ round($option->price) }}</label>
                                        @endif
                                    </div>
                                    @endforeach

                                </td>
                            </tr>
                            <tr class="order-tax">
                                <td>
                                    {{ __('lang.state_tax') }}
                                </td>
                                <td id="tax" data-value="{{ $tax->value }}">
                                    {{ $tax->value . ' % ' }}
                                </td>
                            </tr>
                            <tr class="order-total">
                                <td>
                                    {{ __('lang.total') }}
                                </td>
                                <input type="hidden" id="total_amount" name="total" value="0">
                                    <td class="order-total-amount">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('order.create') }}" class="axil-btn btn-bg-primary checkout-btn">
                    {{ __('lang.process_to_checkout') }}
                </a>
            </div>
        </div>
    </div>
    @endif

<<<<<<< Updated upstream
</div>
=======
<<<<<<< Updated upstream
</div>
=======
>>>>>>> Stashed changes
>>>>>>> Stashed changes
