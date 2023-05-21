@extends('layouts.front_layout')
@section('title', $product->name_en)

@section('content')


<!-- Product Quick View Modal Start -->
<div class="modal fade quick-view-product" id="quick-view-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="far fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="single-product-thumb">
                    <div class="row">
                        <div class="col-lg-7 mb--40">
                            <div class="row">
                                <div class="col-lg-10 order-lg-2">
                                    <div
                                        class="single-product-thumbnail product-large-thumbnail axil-product thumbnail-badge zoom-gallery">
                                        <div class="thumbnail">
                                            <img id="product-image"
                                                 src="{{ asset('web/assets/images/product/product-big-01.png') }}"
                                                 alt="Product Images">
                                            <div class="label-block label-right">
                                                <div class="product-badget" id="dicount_text">0 % OFF</div>
                                            </div>
                                            <div class="product-quick-view position-view">
                                                <a id="popup_image"
                                                   href="{{ asset('web/assets/images/product/product-big-01.png') }}"
                                                   class="popup-zoom">
                                                    <i class="far fa-search-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 order-lg-1" id="sadsads">
                                    <div class="product-small-thumb small-thumb-wrapper" id="show_images">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 mb--40">
                            <div class="single-product-content">
                                <div class="inner">
                                    <div class="product-rating">
                                        <div class="star-rating" id="div_reviews">
                                            <i class="fal fa-star" id="box_reviews"></i>
                                            <i class="fal fa-star" id="box_reviews"></i>
                                            <i class="fal fa-star" id="box_reviews"></i>
                                            <i class="fal fa-star" id="box_reviews"></i>
                                            <i class="fal fa-star" id="box_reviews"></i>
                                        </div>
                                        <div class="review-link">
                                            <a>(<span id="count_reviews"></span> {{ __('lang.customer_reviews') }})</a>
                                        </div>
                                    </div>
                                    <h3 id="product-title" class="product-title">Serif Coffee Table</h3>
                                    <span id="product-price" class="price-amount">
                                            $255.00
                                        </span>
                                    {{-- <ul class="product-meta">--}}
                                    {{-- <li><i class="fal fa-check"></i>In stock</li>--}}
                                    {{-- <li><i class="fal fa-check"></i>Free delivery available</li>--}}
                                    {{-- <li><i class="fal fa-check"></i>Sales 30% Off Use Code: MOTIVE30</li>--}}
                                    {{-- </ul>--}}
                                    <div class="description row" id="show_descriptions">
                                        <div class="d-flex align-items-center col-sm-12" id="show_description"
                                             style="margin-bottom: 3px">
                                            <h6 class="mb-0">
                                                title_en
                                            </h6>
                                            <div class="box-container d-flex flex-wrap mx-3">
                                                <span class="description-text">
                                                    option_ar
                                                </span>
                                                <span class="description-text">
                                                   other_option_en
                                                </span>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="product-variation">
                                        <h6 class="title">{{ __('lang.Colors') }}:</h6>
                                        <!-- mona color radio button -->
                                        <div class="box-color d-flex" id="products_colors">
                                            <div class="container-color-box d-flex mb-4" id="product_colors">
                                                <input name="colorcolor" class="color" type="radio"
                                                       id="color-#000000"
                                                       value="#000000" data-color="#000000"/>
                                                <label for="color-#000000"></label>
                                            </div>
                                        </div>
                                        <!-- end -->
                                    </div>

                                    <!-- Start Product Action Wrapper  -->
                                    <div class="product-action-wrapper d-flex-center">
                                        <!-- Start Product Action  -->
                                        <ul class="product-action d-flex-center mb--0">
                                            <div class="pro-qty mr--20">
                                                <span class="dec qtybtn">-</span>
                                                <input type="text" name="quantity" id="out_quantity_out" value="1">
                                                <span class="inc qtybtn">+</span>
                                            </div>
                                            <li class="add-to-cart">
                                                <form action="{{ route('cart.store') }}" method="POST">
                                                    @csrf

                                                    <input type="hidden" name="color" id="colorForm_colorForm">

                                                    <input type="hidden" name="quantity" id="in_quantity_in">

                                                    <input type="hidden" name="product_id" id="product_iddd">

                                                    <button type="submit" id="cart-btn" class="add-product">
                                                        {{ __('lang.add-cart') }}
                                                    </button>
                                                </form>
                                            </li>
                                            <li class="wishlist" id="add_fav__add_fav" style="cursor: pointer">
                                                <a>
                                                    <button class="axil-btn wishlist-btn">
                                                        <i class="far fa-heart red-color " id="heart"></i>
                                                    </button>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- End Product Action  -->

                                    </div>
                                    <!-- End Product Action Wrapper  -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Quick View Modal End -->

<!-- Start Shop Area  -->
<div class="axil-single-product-area bg-color-white">
    <div class="single-product-thumb axil-section-gap pb--20 pb_sm--0 bg-vista-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb--40">
                    <div class="row">
                        <div class="col-lg-10 order-lg-2">
                            <div class="single-product-thumbnail-wrap zoom-gallery">
                                <div class="product-large-thumbnail single-product-thumbnail axil-product">
                                    @if(count($images) == 0)
                                    <div class="thumbnail">
                                        <a href="{{ Request::root() . '/dashboard/images/' . $product->image }}" class="popup-zoom">
                                            <img src="{{ Request::root() . '/dashboard/images/' . $product->image }}" alt="Product Images">
                                        </a>
                                    </div>

                                    @else
                                    <div class="thumbnail">
                                        <a href="{{ Request::root() . '/dashboard/images/' . $product->image }}" class="popup-zoom">
                                            <img src="{{ Request::root() . '/dashboard/images/' . $product->image }}" class="popup-zoom" alt="Product Images">
                                        </a>
                                    </div>
                                    @foreach($images as $image)
                                    <div class="thumbnail">
                                        <a href="{{ Request::root() . '/dashboard/images/' . $image->image }} " class="popup-zoom">
                                            <img src="{{ Request::root() . '/dashboard/images/' . $image->image }}" class="popup-zoom" alt="Product Images">
                                        </a>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                                @if($product->discount > 0)
                                <div class="label-block">
                                    <div class="product-badget">{{ number_format($product->discount , 1) }}% OFF</div>
                                </div>
                                @endif

                            </div>
                        </div>
                        <div class="col-lg-2 order-lg-1">
                            <div class="product-small-thumb small-thumb-wrapper small-thumb-style-two">
                                @if(count($images) == 0)
                                <div class="thumbnail">
                                    <a href="{{ Request::root() . '/dashboard/images/' . $product->image }}" class="popup-zoom">
                                        <img src="{{ Request::root() . '/dashboard/images/' . $product->image }}" alt="Product Images">
                                    </a>
                                </div>

                                @else
                                <div class="small-thumb-img ">
                                    <img src="{{ Request::root() . '/dashboard/images/' . $product->image }}" class="popup-zoom" alt="Product Images">
                                </div>
                                @foreach($images as $image)
                                <div class="small-thumb-img ">
                                    <img src="{{ Request::root() . '/dashboard/images/' . $image->image }}" class="popup-zoom" alt="Product Images">
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb--40">
                    <div class="single-product-content">
                        <div class="inner">
                            <h2 class="product-title">
                                @if( app()->getLocale() == 'en' )
                                {{ $product->name_en }}
                                @elseif( app()->getLocale() == 'ar' )
                                {{ $product->name_ar }}
                                @endif
                            </h2>
                            <span class="price-amount">
                                {{ __('lang.sar') . ' ' . str_replace(',', '', number_format(($product->price-($product->price*$product->discount/100))  + (($tax_tax/100) * $product->price) , 2)) }}
                                <br>
                            <span class="text-tax">{{__('lang.tax_pro')}}</span>
                            </span>
                            <div class="product-rating">
                                <div class="star-rating">
                                    {{-- @if($product->reviews_sum_rate != null)--}}
                                    {{-- @for($i = 0 ; $i <= $product->reviews_sum_rate/$product->reviews_count ; $i++)--}}
                                    {{-- <i class="fas fa-star"></i>--}}
                                    {{-- @endfor--}}
                                    {{-- @else--}}
                                    {{-- <i class="fal fa-star"></i>--}}
                                    {{-- <i class="fal fa-star"></i>--}}
                                    {{-- <i class="fal fa-star"></i>--}}
                                    {{-- <i class="fal fa-star"></i>--}}
                                    {{-- <i class="fal fa-star"></i>--}}
                                    {{-- @endif--}}
                                    <form id="form_review">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <div class="star-rating" id="post_review">
                                            <div class="star-rating__wrap">
                                                @forelse ($product->reviews2 as $reviews)
                                                @if(auth()->user())
                                                @if($reviews->user_id == auth()->user()->id)
                                                @switch($reviews->rate)
                                                @case(1.00)
                                                <input class="star-rating__input" id="star-rating-5" type="radio" name="rating" value="5">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-5" title="5 out of 5 stars"></label>
                                                <input class="star-rating__input" id="star-rating-4" type="radio" name="rating" value="4">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-4" title="4 out of 5 stars"></label>
                                                <input class="star-rating__input" id="star-rating-3" type="radio" name="rating" value="3">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-3" title="3 out of 5 stars"></label>
                                                <input class="star-rating__input" id="star-rating-2" type="radio" name="rating" value="2">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-2" title="2 out of 5 stars"></label>
                                                <input class="star-rating__input" id="star-rating-1" type="radio" name="rating" value="1">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-1" title="1 out of 5 stars" style="color: rgb(255, 234, 0)"></label>
                                                @break
                                                @case(2.00)
                                                <input class="star-rating__input" id="star-rating-5" type="radio" name="rating" value="5">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-5" title="5 out of 5 stars"></label>
                                                <input class="star-rating__input" id="star-rating-4" type="radio" name="rating" value="4">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-4" title="4 out of 5 stars"></label>
                                                <input class="star-rating__input" id="star-rating-3" type="radio" name="rating" value="3">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-3" title="3 out of 5 stars"></label>
                                                <input class="star-rating__input" id="star-rating-2" type="radio" name="rating" value="2">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-2" title="2 out of 5 stars" style="color: rgb(255, 234, 0)"></label>
                                                <input class="star-rating__input" id="star-rating-1" type="radio" name="rating" value="1">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-1" title="1 out of 5 stars" style="color: rgb(255, 234, 0)"></label>
                                                @break
                                                @case(3.00)
                                                <input class="star-rating__input" id="star-rating-5" type="radio" name="rating" value="5">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-5" title="5 out of 5 stars"></label>
                                                <input class="star-rating__input" id="star-rating-4" type="radio" name="rating" value="4">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-4" title="4 out of 5 stars"></label>
                                                <input class="star-rating__input" id="star-rating-3" type="radio" name="rating" value="3">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-3" title="3 out of 5 stars" style="color: rgb(255, 234, 0)"></label>
                                                <input class="star-rating__input" id="star-rating-2" type="radio" name="rating" value="2">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-2" title="2 out of 5 stars" style="color: rgb(255, 234, 0)"></label>
                                                <input class="star-rating__input" id="star-rating-1" type="radio" name="rating" value="1">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-1" title="1 out of 5 stars" style="color: rgb(255, 234, 0)"></label>
                                                @break
                                                @case(4.00)
                                                <input class="star-rating__input" id="star-rating-5" type="radio" name="rating" value="5">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-5" title="5 out of 5 stars"></label>
                                                <input class="star-rating__input" id="star-rating-4" type="radio" name="rating" value="4">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-4" title="4 out of 5 stars" style="color: rgb(255, 234, 0)"></label>
                                                <input class="star-rating__input" id="star-rating-3" type="radio" name="rating" value="3">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-3" title="3 out of 5 stars" style="color: rgb(255, 234, 0)"></label>
                                                <input class="star-rating__input" id="star-rating-2" type="radio" name="rating" value="2">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-2" title="2 out of 5 stars" style="color: rgb(255, 234, 0)"></label>
                                                <input class="star-rating__input" id="star-rating-1" type="radio" name="rating" value="1">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-1" title="1 out of 5 stars" style="color: rgb(255, 234, 0)"></label>
                                                @break
                                                @case(5.00)
                                                <input class="star-rating__input" id="star-rating-5" type="radio" name="rating" value="5">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-5" title="5 out of 5 stars" style="color: rgb(255, 234, 0)"></label>
                                                <input class="star-rating__input" id="star-rating-4" type="radio" name="rating" value="4">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-4" title="4 out of 5 stars" style="color: rgb(255, 234, 0)"></label>
                                                <input class="star-rating__input" id="star-rating-3" type="radio" name="rating" value="3">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-3" title="3 out of 5 stars" style="color: rgb(255, 234, 0)"></label>
                                                <input class="star-rating__input" id="star-rating-2" type="radio" name="rating" value="2">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-2" title="2 out of 5 stars" style="color: rgb(255, 234, 0)"></label>
                                                <input class="star-rating__input" id="star-rating-1" type="radio" name="rating" value="1">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-1" title="1 out of 5 stars" style="color: rgb(255, 234, 0)"></label>
                                                @break
                                                @default

                                                @endswitch
                                                @break


                                                @else
                                                {{auth()->user()->id}}
                                                <input class="star-rating__input" id="star-rating-5" type="radio" name="rating" value="5">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-5" title="5 out of 5 stars"></label>
                                                <input class="star-rating__input" id="star-rating-4" type="radio" name="rating" value="4">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-4" title="4 out of 5 stars"></label>
                                                <input class="star-rating__input" id="star-rating-3" type="radio" name="rating" value="3">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-3" title="3 out of 5 stars"></label>
                                                <input class="star-rating__input" id="star-rating-2" type="radio" name="rating" value="2">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-2" title="2 out of 5 stars"></label>
                                                <input class="star-rating__input" id="star-rating-1" type="radio" name="rating" value="1">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-1" title="1 out of 5 stars"></label>
                                                @break
                                                @endif
                                                @break
                                                @else
                                                <input class="star-rating__input" id="star-rating-5" type="radio" name="rating" value="5">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-5" title="5 out of 5 stars"></label>
                                                <input class="star-rating__input" id="star-rating-4" type="radio" name="rating" value="4">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-4" title="4 out of 5 stars"></label>
                                                <input class="star-rating__input" id="star-rating-3" type="radio" name="rating" value="3">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-3" title="3 out of 5 stars"></label>
                                                <input class="star-rating__input" id="star-rating-2" type="radio" name="rating" value="2">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-2" title="2 out of 5 stars"></label>
                                                <input class="star-rating__input" id="star-rating-1" type="radio" name="rating" value="1">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-1" title="1 out of 5 stars"></label>
                                                @break
                                                @endif
                                                @empty
                                                <input class="star-rating__input" id="star-rating-5" type="radio" name="rating" value="5">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-5" title="5 out of 5 stars"></label>
                                                <input class="star-rating__input" id="star-rating-4" type="radio" name="rating" value="4">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-4" title="4 out of 5 stars"></label>
                                                <input class="star-rating__input" id="star-rating-3" type="radio" name="rating" value="3">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-3" title="3 out of 5 stars"></label>
                                                <input class="star-rating__input" id="star-rating-2" type="radio" name="rating" value="2">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-2" title="2 out of 5 stars"></label>
                                                <input class="star-rating__input" id="star-rating-1" type="radio" name="rating" value="1">
                                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-1" title="1 out of 5 stars"></label>
                                                @endforelse
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="review-link">
                                    <a>(<span>{{ $product->reviews_count }}</span> {{ __('lang.customer_reviews') }}
                                        )</a>
                                </div>
                            </div>
                            {{-- <ul class="product-meta">--}}
                            {{-- <li><i class="fal fa-check"></i>In stock</li>--}}
                            {{-- <li><i class="fal fa-check"></i>Free delivery avai<l/li>--}}
                            {{-- <li><i class="fal fa-check"></i>Sales 30% Off Use Code: MOTIVE30</li>--}}
                            {{-- </ul>--}}
                            <div class="description row">
                                @foreach($product->specifications as $specifications)
                                    <div class="d-flex align-items-center col-sm-12" style="margin-bottom: 3px">
                                        <h6 class="mb-0">
                                            @if(app()->getLocale() == 'en')
                                                {{ $specifications->title_en }}
                                            @else
                                                {{ $specifications->title_ar }}
                                            @endif
                                        </h6>
                                        <div class="box-container d-flex flex-wrap mx-3">
                                            <span class="description-text">
                                                @if(app()->getLocale() == 'en')
                                                    {{ $specifications->option_en }}
                                                @else
                                                    {{ $specifications->option_ar }}
                                                @endif
                                            </span>
                                            @if($specifications->other_option_en != null && $specifications->other_option_ar != null)
                                                <span class="description-text">
                                                    @if(app()->getLocale() == 'en')
                                                        {{ $specifications->other_option_en }}
                                                    @else
                                                        {{ $specifications->other_option_en }}
                                                    @endif
                                                </span>
                                            @else
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

{{--                                <div class="d-flex align-items-center col-sm-4" style="padding: 15px">--}}
{{--                                    <h6 class="mb-0">مواصفات الشاشة</h6>--}}
{{--                                    <div class="box-container d-flex flex-wrap mx-3">--}}
{{--                                        <span class="description-text">حجم الشاشة بالبوصة 7.6بوصة</span>--}}
{{--                                        <span class="description-text">حجم الشاشة بالبوصة 7.6بوصة</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                @if( app()->getLocale() == 'en' )--}}
{{--                                {{ $product->des_en }}--}}
{{--                                @elseif( app()->getLocale() == 'ar' )--}}
{{--                                {{ $product->des_ar }}--}}
{{--                                @endif--}}
                            </div>


                            <div class="product-variations-wrapper">

                                <!-- Start Product Variation  -->
                                <div class="product-variation">
                                    <h6 class="title">{{ __('lang.Colors') }}:</h6>
                                    <!-- mona color radio button -->
                                    <div class="box-color d-flex">
                                        @foreach($product->colors as $colors)
                                        <div class="container-color-box d-flex mb-4">
                                            {{-- <p style="color: black; margin: 5px">{{ $colors->color }}</p>--}}
                                            <input name="color" class="color" @if($loop->first) checked @endif type="radio" id="color-{{ $colors->id }}"
                                            value="{{ $colors->id }}" data-color="{{ $colors->color }}"/>
                                            <label for="color-{{ $colors->id }}"></label>

                                            <!-- <label class="color-name d-flex justify-content-center align-items-center mx-2 py-1 px-3"
                                             for="color-{{ $colors->id }}">
                                                {{ $colors->color }}
                                            </label> -->
                                        </div>
                                        @endforeach
                                    </div>
                                    <!-- end -->
                                </div>

                                <!-- End Product Variation  -->
                            </div>
                            <!-- Start Product Action Wrapper  -->
                            <div class="product-action-wrapper d-flex-center">
                                <!-- Start Quentity Action  -->
                                <div class="pro-qty mr--20">
                                    <span class="dec qtybtn">-</span>
                                    <input type="text" name="quantity" id="out_quantity" value="1">
                                    <span class="inc qtybtn">+</span>
                                </div>
                                <!-- End Quentity Action  -->

                                <!-- Start Product Action  -->
                                <ul class="product-action d-flex-center mb--0">
                                    <li class="add-to-cart">
                                        <form action="{{ route('cart.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="color" id="colorForm">

                                            <input type="hidden" name="quantity" id="in_quantity">

                                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                                            <button type="submit" id="cart-btn" class="add-product">
                                                {{ __('lang.add-cart') }}
                                            </button>
                                        </form>
                                    </li>
                                    <li class="wishlist" id="add_favadd_fav" style="cursor: pointer" data-id="{{ $product->id }}">
                                        <a>
                                            @forelse ($product->favorite as $favorites)
                                            @if(\Illuminate\Support\Facades\Auth::user())
                                            @if($favorites->user_id == \Illuminate\Support\Facades\Auth::user()->id)
                                            <button class="axil-btn wishlist-btn">
                                                <i class="far fa-heart red-color red-color-single" id="heart"></i>
                                            </button>
                                            @break
                                            @else
                                            <button class="axil-btn wishlist-btn">
                                                <i class="far fa-heart" id="heart"></i>
                                            </button>
                                            @break
                                            @endif
                                            @break
                                            @else
                                            <button class="axil-btn wishlist-btn">
                                                <i class="far fa-heart" id="heart"></i>
                                            </button>
                                            @break
                                            @endif
                                            @empty
                                            <button class="axil-btn wishlist-btn">
                                                <i class="far fa-heart" id="heart"></i>
                                            </button>
                                            @endforelse
                                        </a>
                                        {{-- <li class="wishlist">--}}
                                        {{-- <form action="{{ route('favorite.store') }}" method="POST">--}}
                                        {{-- @csrf--}}
                                        {{-- <input type="hidden" name="product_id" value="{{ $product->id }}">--}}
                                        {{-- <button type="submit" class="axil-btn wishlist-btn">--}}
                                        {{-- <i class="far fa-heart"></i>--}}
                                        {{-- </button>--}}
                                        {{-- </form>--}}
                                        {{-- </li>--}}
                                </ul>
                                <!-- End Product Action  -->
                            </div>
                            <!-- End Product Action Wrapper  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End .single-product-thumb -->
</div>
<!-- End Shop Area  -->
<!-- Start Recently Viewed Product Area  -->
<div class="axil-product-area bg-color-white axil-section-gap pb--50 pb_sm--30">
    <div class="container">
        <div class="section-title-wrapper">
            {{-- <span class="title-highlighter highlighter-primary"><i class="far fa-shopping-basket"></i> {{ __('lang.Your_Recently') }}</span>--}}
            <h2 class="title">{{ __('lang.viewed_Products') }}</h2>
        </div>
        <div class="recent-product-activation slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">
            @foreach($products_s as $key)
            <div class="slick-single-layout">
                <div class="axil-product">
                    <div class="thumbnail">
                        <a href="{{ route('product.show' , $key->id) }}">
                            <img src="{{ Request::root() . '/dashboard/images/' . $key->image }}" alt="@if( app()->getLocale() == 'en' ) {{ $key->name_en }} @elseif( app()->getLocale() == 'ar' ) {{ $key->name_ar }} @endif">
                        </a>
                        @if($key->discount > 0)
                        <div class="label-block label-right">
                            <div class="product-badget">{{ number_format($key->discount , 1) }}% Off</div>
                        </div>
                        @endif
                        <div class="product-hover-action">
                            <ul class="cart-action">
                                <li class="quickview">
                                    <a href="#" data-bs-toggle="modal" class="eye-modal" data-id="{{ $key->id }}" data-bs-target="#quick-view-modal">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </li>
                                <li class="select-option">
                                    <button>
                                        <a href="{{ route('product.show' , $key->id ) }}" style="color: white">
                                            {{ __('lang.Select_Option') }}
                                        </a>
                                    </button>
                                </li>
                                <li class="wishlist" id="add_fav" style="cursor: pointer" data-id="{{ $key->id }}">
                                    <a>
                                        @forelse ($key->favorite as $favorites)
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
                            </ul>
                        </div>
                    </div>
                    <div class="product-content">
                        <div class="inner">
                            <h5 class="title"><a href="{{ route('product.show' , $key->id) }}">
                                    @if( app()->getLocale() == 'en' )
                                    {{ $key->name_en }}
                                    @elseif( app()->getLocale() == 'ar' )
                                    {{ $key->name_ar }}
                                    @endif
                                </a></h5>

                            <div class="product-price-variant">
                                @if($key->discount > 0)
                                <span class="price old-price">
                                    {{ __('lang.sar') . ' ' .str_replace(',', '', number_format( $key->price  + (($tax_tax/100) * $key->price) , 2)) }}
                                </span>
                                <span class="price current-price">{{ __('lang.sar') . ' ' . str_replace(',', '', number_format(($key->price-($key->price*$key->discount/100))  + (($tax_tax/100) * $key->price) , 2)) }}</span>
                                @else
                                <span class="price current-price">
                                    {{ __('lang.sar') . ' ' .str_replace(',', '', number_format( $key->price  + (($tax_tax/100) * $key->price) , 2)) }}
                                </span>
                                @endif
                                {{-- --}}
                                {{-- @if($key->discount > 0)--}}
                                {{-- <span class="price old-price">--}}
                                {{-- {{ __('lang.sar') . ' ' . number_format($key->price  + (($tax_tax/100) * $key->price) , 2) }}--}}

                                {{-- </span>--}}
                                {{-- <span class="price current-price">{{ __('lang.sar') . ' ' . number_format($key->price-($key->price*$key->discount/100) , 2) }}</span>--}}
                                {{-- </span>--}}
                                {{-- @else--}}
                                {{-- <span class="price current-price">--}}
                                {{-- {{ __('lang.sar') . ' ' . number_format($key->price  + (($tax_tax/100) * $key->price) , 2) }}--}}
                                {{-- </span>--}}
                                {{-- @endif--}}

                            </div>
                            <span class="text-tax">{{__('lang.tax_pro')}}</span>
                            <div class="color-variant-wrapper">
                                <ul class="color-variant">
                                    @foreach($key->colors as $colors)
                                    <li class="mx-2 color-extra-01">
                                        <!-- <span class="color-name mx-2 py-1 px-3"> ${color}</span> -->
                                        <span style="background-color:{{ $colors->color }}" class="color"></span>
                                    </li>
                                    {{-- <li class="mx-2 color-extra-01">--}}
                                    {{-- <span class="color-name mx-2 py-1 px-3"> {{ $colors->color }}</span>--}}
                                    {{-- <label class="color-name d-flex justify-content-center align-items-center mx-2 py-1 px-3"--}}
                                    {{-- for="color-{{ $colors->id }}">--}}
                                    {{-- {{ $colors->color }}--}}
                                    {{-- </label>--}}
                                    {{-- </li>--}}
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

<script>
    $(document).on('click', '#add_favadd_fav', function(e) {
        var id = $(this).data('id');
        if ('{{ \Illuminate\Support\Facades\Auth::user() }}') {
            $(this).children('a').children('button').children('.fa-heart').toggleClass("red-color-single");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{ route("product.add_fav") }}',
                data: {
                    'user_id': '{{ \Illuminate\Support\Facades\Auth::id() }}',
                    'product_id': id,
                },
                success: function(response) {}
            });
        } else {
            window.location.href = "{{ route('login') }}";
        }

    });
    $(document).on('click', '#add_fav', function(e) {
        var id = $(this).data('id');
        if ('{{ \Illuminate\Support\Facades\Auth::user() }}') {
            $(this).children('a').children('.fa-heart').toggleClass("red-color");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{ route("product.add_fav") }}',
                data: {
                    'user_id': '{{ \Illuminate\Support\Facades\Auth::id() }}',
                    'product_id': id,
                },
                success: function(response) {}
            });
        } else {
            window.location.href = "{{ route('login') }}";
        }
    });
</script>
<script>
    $(".qtybtn").on("click", function () {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.hasClass("inc")) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find("input").val(newVal);
    });

    $(document).on('click', '#cart-btn', function (e) {

        var quantity = $('#out_quantity').val();

        $('#in_quantity').attr('value', quantity);

        var color = $('input[name="color"]:checked').data('color');

        $('#colorForm').val(color);

    });
</script>
<script>
    function post_review() {
        $(document).off("click", "#post_review").on("click", "#post_review", function(e) {
            // e.preventDefault();
            let formdata = new FormData($('#form_review')[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: "{{ route('product.add-review') }}",
                data: formdata,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log('done');
                }
            });
        });
    };
    post_review();

    // change color of radio buttons
    $(".box-color .container-color-box").each(function() {
        var curent_color = $(this).children('input').attr('data-color');
        $(this).children('label').css('--myVar', curent_color);
    });


    // Get Color
    $('.color').change(function(e) {

        color = $(this).data('color');

        console.log(color);

    })

    $(document).on('click', '#cart-btn', function(e) {
        color = $('input[name="color"]:checked').data('color');
        // color = $('input[name="color"]:checked').val();

        $('#colorForm').val(color);

    })
    // $(".qtybtn").on("click", function() {
    //     var $button = $(this);
    //     var oldValue = $button.parent().find("input").val();
    //     if ($button.hasClass("inc")) {
    //         var newVal = parseFloat(oldValue) + 1;
    //     } else {
    //         // Don't allow decrementing below zero
    //         if (oldValue > 0) {
    //             var newVal = parseFloat(oldValue) - 1;
    //         } else {
    //             newVal = 0;
    //         }
    //     }
    //     $button.parent().find("input").val(newVal);
    // });
</script>

<script>
    var lang = '{{ \Illuminate\Support\Facades\App::getLocale() }}';
    $('.eye-modal').click(function () {
        var id = $(this).data('id');
        $.ajax({
            type: 'get',
            url: "{{ url('products/getData') }}/" + id,
            success: function (data) {
                console.log(data);
                $('#out_quantity_out').val(1);
                $('#product_iddd').attr('value', data.product.id);
                $('#add_fav__add_fav').attr('data-id', data.product.id);
                var product_qty = $('#product_qty').val();
                $('#in_quantity').attr('value', product_qty);
                $('#product-image').attr('src', '')
                $('#product-image').attr('src', '/dashboard/images/' + data.product.image)
                $('#product-title').text('')
                if (lang == 'en') {
                    $('#product-title').text(data.product.name_en);
                } else {
                    $('#product-title').text(data.product.name_ar);
                }
                $('#product-price').text('')
                $('#product-price').text(data.product.price)
                $('#description').text('')
                // if (lang == 'en') {
                //     $('#description').text(data.product.des_en);
                // } else {
                //     $('#description').text(data.product.des_ar);
                // }
                $('#popup_image').attr('href', '');
                $('#popup_image').attr('href', '/dashboard/images/' + data.product.image);
                $('#dicount_text').text('');
                if (data.product.discount > 0 ) {
                    $('#dicount_text').css('display' , 'inline-flex').text(data.product.discount + ' % OFF');
                } else {
                    $('#dicount_text').css('display' , 'none');
                }
                $('#count_reviews').text(data.product.reviews_count);
                const boxes = document.querySelectorAll('#show_img');
                boxes.forEach(box => {
                    box.remove();
                });
                data.product.imageable.forEach(myFunction);

                function myFunction(item) {
                    html(item.image);
                }

                const boxColors = document.querySelectorAll('#product_colors');
                boxColors.forEach(box => {
                    box.remove();
                });
                data.product.colors.forEach(myFunction2);
                console.log(data.product.colors);

                function myFunction2(item) {
                    html2(item);
                    $('input[name="color_input"]').attr('checked', 'checked');

                }


                const box_reviews = document.querySelectorAll('#box_reviews');
                box_reviews.forEach(box => {
                    box.remove();
                });

                if (data.product.reviews_sum_rate != null) {
                    for (var i = 1; i <= data.product.reviews_sum_rate / data.product.reviews_count; i++) {
                        const show_reviews = document.getElementById("div_reviews");
                        let reviews = `
                        <i class="fas fa-star" id="box_reviews"></i>
                        `;
                        show_reviews.insertAdjacentHTML("afterbegin", reviews);
                    }
                } else {
                    const show_reviews = document.getElementById("div_reviews");
                    let reviews = `
                                <i class="fal fa-star" id="box_reviews"></i>
                                <i class="fal fa-star" id="box_reviews"></i>
                                <i class="fal fa-star" id="box_reviews"></i>
                                <i class="fal fa-star" id="box_reviews"></i>
                                <i class="fal fa-star" id="box_reviews"></i>
                        `;
                    show_reviews.insertAdjacentHTML("afterbegin", reviews);
                }

                const show_description = document.querySelectorAll('#show_description');
                show_description.forEach(box => {
                    box.remove();
                });

                console.log(data.product.specifications);
                data.product.specifications.forEach(myFunction3);

                function myFunction3(item) {
                    html3(item);
                }

                if (data.product.favorite.length != 0) {
                    $('#add_fav__add_fav').children('a').children('button').children('.fa-heart').addClass("red-color-single");
                } else {
                    $('#add_fav__add_fav').children('a').children('button').children('.fa-heart').removeClass("red-color-single");
                }
                // $('#add_favadd_fav').attr('data-id', data.product.id);

            },
            error: function (data) {
                console.log('data')
            },

        });
    });

    function html(image) {
        const show_images = document.getElementById("show_images");
        let business = `
               <div class="small-thumb-img" id="show_img">
                    <img src="{{ Request::root() . '/dashboard/images/'}}${image}"
                        alt="thumb image">
                </div>`;
        show_images.insertAdjacentHTML("afterbegin", business);
    }

    function html2(color) {
        const show_color = document.getElementById("products_colors");
//             let cc = `
//             <!--                 <div class="container-color-box d-flex" id="product_colors">-->
// <!--                    <p style="color: black; margin: 5px"></p>-->
// <!--                    <input name="color" class="color color_input" type="radio" id="${color}"-->
//                             value="${color}" data-color="${color}"/>
// <!--                    <label-->
// <!--                        class="color-name d-flex justify-content-center align-items-center mx-2 py-1 px-3"-->
// <!--                        for="${color}">-->
// <!--                        ${color}-->
// <!--                    </label>-->
// <!--                </div>-->
// `;
//             let colors = `
//                 <li class="mx-2 color-extra-01" id="product_colors">
//                     <span style="background-color:${color}" class="color"></span>
//                 </li>`;
        let colors = `
                <div class="container-color-box d-flex mb-4" id="product_colors">
                    <input name="color_input" class="color" type="radio" id="color-${color.id}"
                        value="${color.id}" data-color="${color.color}"/>
                    <label for="color-${color.id}" style="--myVar:${color.color};"></label>
                </div>
                `;
        show_color.insertAdjacentHTML("afterbegin", colors);
    }

    function html3(description) {
        const show_descriptions = document.getElementById("show_descriptions");
        if (lang == 'ar') {
            if (description.other_option_ar != null) {
                var descriptions = `
                <div class="d-flex align-items-center col-sm-12" id="show_description" style="margin-bottom: 3px">
                    <h6 class="mb-0">
                    ${description.title_ar}
                    </h6>
                    <div class="box-container d-flex flex-wrap mx-3">
                        <span class="description-text">
                            ${description.option_ar}
                        </span>
                        <span class="description-text">
                            ${description.other_option_ar}
                        </span>
                    </div>
                </div>
                `;
            } else {
                var descriptions = `
                <div class="d-flex align-items-center col-sm-12" id="show_description" style="margin-bottom: 3px">
                    <h6 class="mb-0">
                    ${description.title_ar}
                    </h6>
                    <div class="box-container d-flex flex-wrap mx-3">
                        <span class="description-text">
                            ${description.option_ar}
                        </span>
                    </div>
                </div>
                `;
            }

        } else {
            if (description.other_option_en != null) {
                var descriptions = `
                <div class="d-flex align-items-center col-sm-12" id="show_description" style="margin-bottom: 3px">
                    <h6 class="mb-0">
                    ${description.title_en}
                    </h6>
                    <div class="box-container d-flex flex-wrap mx-3">
                        <span class="description-text">
                            ${description.option_en}
                        </span>
                        <span class="description-text">
                            ${description.other_option_en}
                        </span>
                    </div>
                </div>
                `;
            } else {
                var descriptions = `
                <div class="d-flex align-items-center col-sm-12" id="show_description" style="margin-bottom: 3px">
                    <h6 class="mb-0">
                    ${description.title_en}
                    </h6>
                    <div class="box-container d-flex flex-wrap mx-3">
                        <span class="description-text">
                            ${description.option_en}
                        </span>

                    </div>
                </div>
                `;
            }

        }

        show_descriptions.insertAdjacentHTML("afterbegin", descriptions);
    }


    // $(document).on('click', '#add_favadd_fav', function (e) {
    $('#add_fav__add_fav').click(function (e) {
        e.preventDefault();
        //     $(document).off("click", "#add_favadd_fav").on("click", "#add_favadd_fav", function (e) {
        var id = $(this).data('id');
        if ('{{ \Illuminate\Support\Facades\Auth::user() }}') {
            $(this).children('a').children('button').children('.fa-heart').toggleClass("red-color-single");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{ route("product.add_fav") }}',
                data: {
                    'user_id': '{{ \Illuminate\Support\Facades\Auth::id() }}',
                    'product_id': id,
                },
                success: function (response) {
                }
            });
        } else {
            window.location.href = "{{ route('login') }}";
        }
    });

    $(document).on('click', '.add-product', function (e) {
        var quantity = $('#out_quantity_out').val();

        $('#in_quantity_in').val(quantity);

        var color = $('input[name="color_input"]:checked').data('color');


        $('#colorForm_colorForm').val(color);

    });
</script>
@endsection
