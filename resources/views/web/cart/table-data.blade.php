<div class="product-table-heading">
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

<div class="table-responsive">
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
                {{ __('lang.tax') }}
            </th>
            <th scope="col" class="product-quantity">
                {{ __('lang.quantity') }}
            </th>
            <th scope="col" class="color-row">
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

                    <td class="product-price" data-title="{{ __('lang.price') }}">
                        @if($item->product->discount > 0)
                            {{ __('lang.sar') . ' ' . number_format(($item->product->price -($item->product->price * $item->product->discount/100))  + (($tax_tax/100) * $item->product->price) , 2) }}
                        @else
                            {{ __('lang.sar') . ' ' . number_format($item->product->price + (($tax_tax/100) * $item->product->price) , 2) }}
                        @endif
{{--                        {{ __('lang.sar').' '.number_format($item->product->price + (($tax_tax/100) * $item->product->price) , 2) }}--}}
                            <br>
                            <span class="text-tax">{{__('lang.tax_pro')}}</span>
                    </td>
                    <td class="product-price" data-title="{{ __('lang.tax') }}">
                        {{ number_format((($tax_tax/100) * $item->product->price) , 2) }}
                    </td>
                    <td class="product-quantity" data-id="{{ $item->id }}" data-title="{{ __('lang.quantity') }}">
                        <div class="pro-qty">
                            <span class="dec qtybtn" id="qty-btn-mix" data-id="{{ $item->id }}">-</span>
                            <input type="number" id="qty_input" max="{{ $item->product->quantity }}"
                                   class="quantity-input" style="pointer-events: none" data-id="{{ $item->id }}"
                                   value="{{ $item->quantity }}">
                            <span class="inc qtybtn" id="qty-btn-max" data-id="{{ $item->id }}">+</span>
                        </div>
                    </td>
                    <td>
                        <div
                            style="background-color: {{ $item->color }}; width: 15px; height: 15px; border-radius: 50%;"
                            title="{{ $item->color }}"></div>
                    </td>

                    <td class="product-subtotal" data-title="{{ __('lang.subtotal') }}" style="font-size: 18px">
                        @if($item->product->discount > 0)
                            {{ __('lang.sar').' '.number_format(($item->product->price * $item->quantity) - (($item->product->price * $item->quantity) * $item->product->discount/100) + (($tax_tax/100) * ($item->product->price * $item->quantity)) , 2)  }}
                        @else
                            {{ __('lang.sar').' '.number_format(($item->product->price * $item->quantity) + (($tax_tax/100) * ($item->product->price * $item->quantity)) , 2)  }}
                        @endif
{{--                        {{ __('lang.sar').' '.number_format(($item->product->price * $item->quantity) + (($tax_tax/100) * ($item->product->price * $item->quantity)) , 2)  }}--}}
                            <br>
                            <span class="text-tax">{{__('lang.tax_pro')}}</span>
                    </td>

                </tr>
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
        <div class="col-xl-5 col-lg-7 offset-xl-7 offset-lg-5">
            <div class="axil-order-summery mt--80">
                <h5 class="title mb--20">
                    {{ __('lang.order_summery') }}
                </h5>
                <div class="summery-table-wrap">
                    <table class="table summery-table mb--30">
                        <tbody>
                        <tr class="order-subtotal">
{{--                            <td>--}}
{{--                                {{ __('lang.subtotal') }}--}}
{{--                            </td>--}}
{{--                            <td class="total" id="subtotal">--}}
{{--                                {{ round($items->total()) }}--}}
{{--                            </td>--}}
                        </tr>
{{--                        <tr class="order-shipping">--}}
{{--                            <td>{{ __('lang.shipping') }}</td>--}}
{{--                            <td>--}}
{{--                                <div class="input-group">--}}
{{--                                    <input type="radio" id="shipping_value-0" data-id="0" value="0"--}}
{{--                                           class="shipping_value" name="shipping" checked>--}}
{{--                                    <label for="shipping_value-0">--}}
{{--                                        {{ __('lang.free_shipping') }}</label>--}}
{{--                                </div>--}}
{{--                                @foreach( $shipping_options as $option )--}}
{{--                                    <div class="input-group">--}}
{{--                                        <input type="radio" id="shipping_value-{{ $option->id }}"--}}
{{--                                               data-id="{{ $option->id }}" class="shipping_value" name="shipping"--}}
{{--                                               value="{{ round($option->price) }}">--}}
{{--                                        @if( app()->getLocale() == 'en' )--}}
{{--                                            <label for="shipping_value-{{ $option->id }}">{{ $option->name_en }}--}}
{{--                                                : {{ number_format($option->price , 2)  }}</label>--}}
{{--                                        @else--}}
{{--                                            <label for="shipping_value-{{ $option->id }}">{{ $option->name_ar }}--}}
{{--                                                : {{ number_format($option->price , 2) }}</label>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}

{{--                            </td>--}}
{{--                        </tr>--}}
                        {{--                        <tr class="order-tax">--}}
                        {{--                            <td>--}}
                        {{--                                {{ __('lang.state_tax') }}--}}
                        {{--                            </td>--}}
                        {{--                            <td id="tax" data-value="{{ $tax->value }}">--}}
                        {{--                                {{ $tax->value.' %' }}--}}
                        {{--                            </td>--}}
                        {{--                        </tr>--}}
                        @if( $coupon )
                            <tr class="order-coupons_des">
                                <td>
                                    {{ __('lang.coupons_des') }}
                                </td>
                                <td id="coupons_des">
{{--                                    {{  $items->total() * ($coupon->coupon->discount / 100)  }}--}}
                                    {{ Cookie::get('total_ca') }}
                                </td>
                            </tr>
                        @endif


                        <tr class="order-total">

                            <td>
                                {{ __('lang.total') }}
                                <br>
                                <span class="text-tax">{{__('lang.tax_pro')}}</span>
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
