
    <div class="search-result-header">
        <h6 class="title">
            {{ $products->count() }} {{ __('lang.Result Found') }} </h6>
        <a href="{{ route('product.index') }}" class="view-all">
            {{ __('lang.View All') }}
        </a>
    </div>
    <div class="psearch-results">
        @foreach($products as $product)
            <div class="axil-product-list">
                <div class="thumbnail">
                    <a href="{{ route('product.show' , $product->id) }}">
                        <img src="{{ Request::root() . '/dashboard/images/' . $product->image }}"
                            width="150" height="150" alt="Yantiti Leather Bags">
                    </a>
                </div>
                <div class="product-content">
                    <div class="product-rating">
                                <span class="rating-icon">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fal fa-star"></i>
                                </span>
                        <span class="rating-number"><span>100+</span> Reviews</span>
                    </div>
                    <h6 class="product-title">
                        <a href="{{ route('product.show' , $product->id) }}">
                            @if( app()->getLocale() == 'en' )
                                {{ $product->name_en }}
                            @else
                                {{ $product->name_ar }}
                            @endif
                        </a>
                    </h6>
                    <div class="product-price-variant">
                        @if($product->discount > 0)
                            <span class="price old-price">
                                    {{ __('lang.sar') . ' ' . number_format($product->price + (($tax_tax/100) * $product->price) , 2) }}
                                </span>
                            <span class="price current-price">{{ __('lang.sar') . ' ' . number_format(($product->price-($product->price*$product->discount/100))  + (($tax_tax/100) * $product->price) , 2) }}</span>
                        @else
                            <span class="price current-price">
                                    {{ __('lang.sar') . ' ' . number_format($product->price + (($tax_tax/100) * $product->price) , 2) }}
                                </span>
                        @endif
{{--                        @if($product->discount > 0)--}}
{{--                            <span class="price old-price">--}}
{{--                                        {{ __('lang.sar') . ' ' . $product->price }}--}}
{{--                                    </span>--}}
{{--                            <span class="price current-price">{{ __('lang.sar') . ' ' . $product->price-($product->price*$product->discount/100) }}</span>--}}
{{--                        @else--}}
{{--                            <span class="price current-price">--}}
{{--                                        {{ __('lang.sar') . ' ' . $product->price }}--}}
{{--                                    </span>--}}
{{--                        @endif--}}
                    </div>
                    <div class="product-cart">
{{--                        <a href="cart.html" class="cart-btn"><i class="fal fa-shopping-cart"></i></a>--}}
                        <li class="cart-btn" id="add_fav_add_fav" style="cursor: pointer"
                            data-id="{{ $product->id }}">
                            <a>
                                @forelse ($product->favorite as $favorites)
                                    @if(\Illuminate\Support\Facades\Auth::user())
                                        @if($favorites->user_id == \Illuminate\Support\Facades\Auth::user()->id)
                                            <i class="far fa-heart red-color" id="heart"></i>
                                            @break
                                        @else
                                            <i class="far fa-heart" id="heart"></i>
                                            @break
                                        @endif
                                        @break
                                    @else
                                        <i class="far fa-heart" id="heart"></i>
                                        @break
                                    @endif
                                @empty
                                    <i class="far fa-heart" id="heart"></i>
                                @endforelse
                            </a>
                        </li>
                    </div>
                </div>
            </div>
        @endforeach
</div>
