@extends('layouts.front_layout')

@section('title', 'Home')

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
                                                <li class="wishlist" id="add_favadd_fav" style="cursor: pointer">
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
    @if($products_first_home_page->isNotEmpty())
        <div class="axil-main-slider-area main-slider-style-1" id='hot-deal-this-week' xmlns="">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-sm-6">
                        <div class="main-slider-content">
                            <div class="slider-content-activation-one">
                                @foreach($products_first_home_page as $key)
                                    <div class="single-slide slick-slide" data-sal="slide-up" data-sal-delay="400"
                                         data-sal-duration="800">
                                        @if(app()->getLocale() == 'ar')
                                            <h1 class="title">{{ $key->name_ar }}</h1>
                                        @else
                                            <h1 class="title">{{ $key->name_en }}</h1>
                                        @endif
                                        <div class="slide-action">
                                            <div class="shop-btn">
                                                <a href="{{ route('product.index') }}" class="axil-btn btn-bg-white"><i
                                                        class="fal fa-shopping-cart"></i>{{ __('lang.Shop_Now') }}</a>
                                            </div>
                                            <div class="item-rating">
                                                <div class="thumb">
                                                    <ul>
                                                        @foreach($key->reviews as $p => $images)
                                                            <p hidden>{{ $p+=1 }}</p>
                                                            @if($p == 5)
                                                                @break
                                                            @endif
                                                            <li><img
                                                                    src="@if($images->user->avatar != null){{ Request::root() . '/dashboard/images/' . $images->user->avatar }}@else{{ asset('pp.jpg') }}@endif"
                                                                    alt="Author"
                                                                    style="width: 40px; height:40px;object-fit:cover;">
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="content">
                                        <span class="rating-icon">
                                            @if($key->reviews_sum_rate != null)
                                                @for($i = 1 ; $i <= $key->reviews_sum_rate/$key->reviews_count ; $i++)
                                                    <i class="fas fa-star"></i>
                                                @endfor
                                            @else
                                                <i class="fal fa-star"></i>
                                                <i class="fal fa-star"></i>
                                                <i class="fal fa-star"></i>
                                                <i class="fal fa-star"></i>
                                                <i class="fal fa-star"></i>
                                            @endif
                                        </span>
                                                    <span class="review-text">
                                            <span>{{ $key->reviews_count }}+</span> {{ __('lang.customer_reviews') }}
                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-sm-6">
                        <div class="main-slider-large-thumb">
                            <div class="slider-thumb-activation-one axil-slick-dots">
                                @foreach($products_first_home_page as $key)
                                    <div class="single-slide slick-slide" data-sal="slide-up" data-sal-delay="600"
                                         data-sal-duration="1500">
                                        <img src="{{ Request::root() . '/dashboard/images/' . $key->image }}"
                                             alt="Product">
                                        <div class="product-price">
                                            <span class="text" style="font-size: 12px;">{{ __('lang.from') }}</span>
                                            <span class="price-amount"
                                                  style="font-size: 12px;">{{ __('lang.sar') . ' ' .str_replace(',', '', number_format( $key->price  + (($tax_tax/100) * $key->price) , 2)) }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <ul class="shape-group">
                 <li class="shape-1"><img src="{{ asset('web/shape-1.png') }}" alt="Shape"></li>
                 <li class="shape-2"><img src="{{ asset('web/shape-2.png') }}" alt="Shape"></li>
             </ul>
        </div>
    @endif

    @if($categories->isNotEmpty())
        <!-- Start Categorie Area  -->
        <div class="axil-categorie-area bg-color-white axil-section-gapcommon" id='categories'>
            <div class="container">
                <div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-secondary"> <i class="far fa-tags"></i>{{ __('lang.titlecat') }}</span>
                    <h2 class="title">{{ __('lang.Browse_by_Category') }}</h2>
                </div>
                <div class="categrie-product-activation slick-layout-wrapper--15 axil-slick-arrow  arrow-top-slide">
                    @foreach($categories as $category)
                        <div class="slick-single-layout">
                            <div class="categrie-product" data-sal="zoom-out" data-sal-delay="200"
                                 data-sal-duration="500">
                                <a href="{{ route('product.show_products' , $category->id) }}">
                                    <img class="img-fluid"
                                         src="{{ Request::root() . '/dashboard/images/' . $category->image }}"
                                         alt="product categorie">
                                    <h6 class="cat-title">

                                        @if( app()->getLocale() == 'en' )
                                            {{ $category->name_en }}
                                        @elseif( app()->getLocale() == 'ar' )
                                            {{ $category->name_ar }}
                                        @endif
                                    </h6>
                                </a>
                            </div>
                            <!-- End .categrie-product -->
                        </div>
                        <!-- End .slick-single-layout -->
                    @endforeach
                </div>
            </div>
        </div>
        <!-- End Categorie Area  -->
    @endif

    @if(!empty($single_product))
        <!-- Poster Countdown Area  -->
        <div class="axil-poster-countdown">
            <div class="container">
                <div class="poster-countdown-wrap bg-lighter">
                    <div class="row">
                        <div class="col-xl-5 col-lg-6">
                            <div class="poster-countdown-content">
                                <div class="section-title-wrapper">
                                    <h2 class="title">
                                        @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                            {{ $single_product->name_en }}
                                        @else
                                            {{ $single_product->name_ar }}
                                        @endif
                                    </h2>
                                </div>
                                <div class="poster-countdown countdown mb--40">
                                    <div class="poster-countdown countdown mb--40">
                                        <div class="countdown-section">
                                            <div>
                                                <div id="day" class="countdown-number">0</div>
                                                <div class="countdown-unit">Day</div>
                                            </div>
                                        </div>
                                        <div class="countdown-section">
                                            <div>
                                                <div id="hrs" class="countdown-number">00</div>
                                                <div class="countdown-unit">Hrs</div>
                                            </div>
                                        </div>
                                        <div class="countdown-section">
                                            <div>
                                                <div id="min" class="countdown-number">00</div>
                                                <div class="countdown-unit">Min</div>
                                            </div>
                                        </div>
                                        <div class="countdown-section">
                                            <div>
                                                <div id="sec" class="countdown-number">00</div>
                                                <div class="countdown-unit">Sec</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="axil-btn btn-bg-primary">{{ __('lang.Check_it_Out') }}</a>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6">
                            <div class="poster-countdown-thumbnail">
                                <img src="{{  Request::root() . '/dashboard/images/' . $single_product->image ?? '' }}"
                                     alt="@if(\Illuminate\Support\Facades\App::getLocale() == 'en') {{ $single_product->name_en ?? '' }} @else {{ $single_product->name_ar ?? '' }} @endif">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Poster Countdown Area  -->
    @endif

    @if($products_s->isNotEmpty())
        <!-- Start Expolre Product Area  -->
        <div class="axil-product-area bg-color-white axil-section-gap" id='all-products'>
            <div class="container">
                <div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-primary"> <i class="far fa-shopping-basket"></i> {{ __('lang.Our_Products') }}</span>
                    <h2 class="title">{{ __('lang.Explore_our_Products') }}</h2>
                </div>
                <div
                    class="explore-product-activation slick-layout-wrapper slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">
                    <div class="slick-single-layout">
                        <div class="row row--15">
                            @foreach( $products_s as $product )
                                <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb--30">
                                    <div class="axil-product product-style-one">
                                        <div class="thumbnail">
                                            <a href="{{ route('product.show', ['id' => $product->id]) }}">
                                                <img data-sal="zoom-out" data-sal-delay="200" data-sal-duration="800"
                                                     loading="lazy" class="main-img"
                                                     src="{{ Request::root() . '/dashboard/images/' . $product->image }}"
                                                     alt="Product Images">
                                            </a>
                                            @if($product->discount > 0)
                                                <div class="label-block label-right">
                                                    <div class="product-badget">{{ $product->discount }}% Off</div>
                                                </div>
                                            @endif
                                            <div class="product-hover-action">
                                                <ul class="cart-action">
                                                    <li class="quickview">
                                                        <a href="#" data-bs-toggle="modal" class="eye-modal"
                                                           data-id="{{ $product->id }}"
                                                           data-bs-target="#quick-view-modal">
                                                            <i class="far fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    <li class="select-option">
                                                        <button>
                                                            <a href="{{ route('product.show' , $product->id ) }}"
                                                               style="color: white">
                                                                {{ __('lang.Select_Option') }}
                                                            </a>
                                                        </button>
                                                    </li>
                                                    <li class="wishlist" id="add_fav" style="cursor: pointer"
                                                        data-id="{{ $product->id }}">
                                                        <a>
                                                            @forelse ($product->favorite as $favorites)
                                                                @if(\Illuminate\Support\Facades\Auth::user())
                                                                    @if($favorites->user_id == \Illuminate\Support\Facades\Auth::user()->id)
                                                                        <i class="far fa-heart red-color"
                                                                           id="heart"></i>
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
                                                <div class="product-rating">
                                        <span class="icon">

                                            @if($product->reviews_sum_rate != null)
                                                @for($i = 1 ; $i <= $product->reviews_sum_rate/$product->reviews_count ; $i++)
                                                    <i class="fas fa-star"></i>
                                                @endfor
                                            @else
                                                <i class="fal fa-star"></i>
                                                <i class="fal fa-star"></i>
                                                <i class="fal fa-star"></i>
                                                <i class="fal fa-star"></i>
                                                <i class="fal fa-star"></i>
                                            @endif
                                        </span>
                                                    <span class="rating-number">({{ $product->reviews_count }})</span>
                                                </div>
                                                <h5 class="title">
                                                    <a href="{{ route('product.show' , $product->id ) }}">
                                                        @if( app()->getLocale() == 'en' )
                                                            {{ $product->name_en }}
                                                        @elseif( app()->getLocale() == 'ar' )
                                                            {{ $product->name_ar }}
                                                        @endif
                                                    </a>
                                                </h5>
                                                <div class="product-price-variant">
                                                    @if($product->discount > 0)
                                                        <span class="price old-price">
                                            {{ __('lang.sar') . ' ' . str_replace(',', '', number_format( $product->price  + (($tax_tax/100) * $product->price) , 2)) }}

                                            </span>
                                                        <span
                                                            class="price current-price">{{ __('lang.sar') . ' ' . str_replace(',', '', number_format( $product->price  + (($tax_tax/100) * $product->price) , 2))  }}</span>
                                                        </span>
                                                    @else
                                                        <span class="price current-price">
                                            {{ __('lang.sar') . ' ' .  str_replace(',', '', number_format( $product->price  + (($tax_tax/100) * $product->price) , 2)) }}
                                            </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <span class="text-tax">{{__('lang.tax_pro')}}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Product  -->
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center mt--20 mt_sm--0">
                        <a href="{{ route('product.index') }}" class="axil-btn btn-bg-lighter btn-load-more">
                            {{ __('lang.View_All_Products') }}
                        </a>
                    </div>
                </div>

            </div>
        </div>
        <!-- End Expolre Product Area  -->
    @endif

    @if($products_most_recent->isNotEmpty())
        <!-- Start New Arrivals Product Area  -->
        <div class="axil-new-arrivals-product-area bg-color-white axil-section-gap pb--0" id='new-arrivals'>
            <div class="container">
                <div class="product-area pb--50">
                    <div class="section-title-wrapper">
                        <span class="title-highlighter highlighter-primary"><i class="far fa-shopping-basket"></i>{{ __('lang.This_Week') }}</span>
                        <h2 class="title">{{ __('lang.New_Arrivals') }}</h2>
                    </div>
                    <div
                        class="new-arrivals-product-activation slick-layout-wrapper--30 axil-slick-arrow  arrow-top-slide">
                        @foreach($products_most_recent as $key)
                            <div class="slick-single-layout">
                                <div class="axil-product product-style-two">
                                    <div class="thumbnail">
                                        <a href="{{ route('product.show', ['id' => $key->id]) }}">
                                            <img data-sal="zoom-out" data-sal-delay="200" data-sal-duration="500"
                                                 src="{{ Request::root() . '/dashboard/images/' . $key->image }}"
                                                 alt="@if( app()->getLocale() == 'en' ) {{ $key->name_en }} @elseif( app()->getLocale() == 'ar' ) {{ $key->name_ar }} @endif"
                                                 style="height: 100%; width: 100%">
                                        </a>
                                        @if($key->discount > 0)
                                            <div class="label-block label-right">
                                                <div class="product-badget">{{ $key->discount }}% Off</div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="product-content">
                                        <div class="inner">
                                            <div class="color-variant-wrapper">
                                                <ul class="color-variant">
                                                    @foreach($key->colors as $colors)
                                                        {{--                                                    <li class="mx-2 color-extra-01">--}}
                                                        <li class="mx-2 color-extra-01" id="product_colors">
                                                            <span style="background-color:{{ $colors->color }}"
                                                                  class="color"></span>
                                                        </li>
                                                        {{--                                                        <span--}}
                                                        {{--                                                            class="color-name mx-2 py-1 px-3"> {{ $colors->color }}</span>--}}
                                                        {{--                                                <p style="color: black;">{{ $colors->color }}</p>--}}
                                                        {{--                                                    </li>--}}
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <h5 class="title"><a href="{{ route('product.show' , $key->id ) }}">
                                                    @if( app()->getLocale() == 'en' )
                                                        {{ $key->name_en }}
                                                    @elseif( app()->getLocale() == 'ar' )
                                                        {{ $key->name_ar }}
                                                    @endif
                                                </a></h5>
                                            <div class="product-price-variant">
                                                @if($key->discount > 0)
                                                    <span class="price old-price">
                                        {{ __('lang.sar') . ' ' .  str_replace(',', '', number_format( $key->price  + (($tax_tax/100) * $key->price) , 2))  }}
                                    </span>
                                                    <span
                                                        class="price current-price">{{ __('lang.sar') . ' ' .str_replace(',', '',  number_format(($key->price-($key->price*$key->discount/100)) + (($tax_tax/100) * $key->price) , 2) ) }}</span>
                                                @else
                                                    <span class="price current-price">
                                        {{ __('lang.sar') . ' ' .  str_replace(',', '', number_format( $key->price  + (($tax_tax/100) * $key->price) , 2)) }}
                                    </span>
                                                @endif
                                                <br>
                                                <span class="text-tax">{{__('lang.tax_pro')}}</span>
                                            </div>
                                            <div class="product-hover-action">
                                                <ul class="cart-action">
                                                    <li class="quickview">
                                                        <a href="#" data-bs-toggle="modal" class="eye-modal"
                                                           data-id="{{ $key->id }}" data-bs-target="#quick-view-modal">
                                                            <i class="far fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    <li class="select-option">
                                                        <button>
                                                            <a href="{{ route('product.show' , $key->id ) }}"
                                                               style="color: white">
                                                                {{ __('lang.Select_Option') }}
                                                            </a>
                                                        </button>
                                                    </li>
                                                    <li class="wishlist" id="add_fav" style="cursor: pointer"
                                                        data-id="{{ $key->id }}">
                                                        <a>
                                                            @forelse ($key->favorite as $favorites)
                                                                @if(\Illuminate\Support\Facades\Auth::user())
                                                                    @if($favorites->user_id == \Illuminate\Support\Facades\Auth::user()->id)
                                                                        <i class="far fa-heart red-color"
                                                                           id="heart"></i>
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
                                    </div>
                                </div>
                            </div>
                            <!-- End .slick-single-layout -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- End New Arrivals Product Area  -->
    @endif

    @if($products_best_seller->isNotEmpty())
        <!-- Start Most Sold Product Area  -->
        <div class="axil-most-sold-product axil-section-gap" id='most-sold'>
            <div class="container">
                <div class="product-area pb--50">
                    <div class="section-title-wrapper section-title-center">
                        <span class="title-highlighter highlighter-primary"><i class="fas fa-star"></i>{{ __('lang.Most_Sold') }}</span>
                        <h2 class="title">{{ __('lang.Most_Sold_in') }}</h2>
                    </div>
                    <div class="row row-cols-xl-2 row-cols-1 row--15">
                        @foreach($products_best_seller as $key1)
                            <div class="col">
                                <div class="axil-product-list">
                                    <div class="thumbnail">
                                        <a href="{{ route('product.show' , $key1->id ) }}">
                                            <img data-sal="zoom-in" data-sal-delay="100" data-sal-duration="1500"
                                                 src="{{ Request::root() . '/dashboard/images/' . $key1->image }}"
                                                 alt="@if( app()->getLocale() == 'en' ) {{ $key1->name_en }} @elseif( app()->getLocale() == 'ar' ) {{ $key1->name_ar }} @endif"
                                                 class="sal-animate"
                                                 style="width: 120px; height:120px;object-fit:cover;">
                                            {{-- <img data-sal="zoom-in" data-sal-delay="100" data-sal-duration="1500"--}}
                                            {{-- src="{{ Request::root() . '/dashboard/images/' . $key1->image }}"--}}
                                            {{-- alt="@if( app()->getLocale() == 'en' ) {{ $key1->name_en }} @elseif( app()->getLocale() == 'ar' ) {{ $key1->name_ar }} @endif">--}}
                                        </a>

                                    </div>
                                    <div class="product-content">
                                        <div class="product-rating">
                                <span class="rating-icon">
                                    @if($key1->reviews_sum_rate != null)
                                        @for($i = 1 ; $i <= $key1->reviews_sum_rate/$key1->reviews_count ; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                    @else
                                        <i class="fal fa-star"></i>
                                        <i class="fal fa-star"></i>
                                        <i class="fal fa-star"></i>
                                        <i class="fal fa-star"></i>
                                        <i class="fal fa-star"></i>
                                    @endif
                                </span>
                                            <span class="rating-number"><span>{{ $key1->reviews_count }}+</span> {{ __('lang.customer_reviews') }}</span>
                                        </div>
                                        <h6 class="product-title"><a href="{{ route('product.show' , $key1->id ) }}">
                                                @if( app()->getLocale() == 'en' )
                                                    {{ $key1->name_en }}
                                                @elseif( app()->getLocale() == 'ar' )
                                                    {{ $key1->name_ar }}
                                                @endif
                                            </a></h6>
                                        <div class="product-price-variant">
                                            @if($key1->discount > 0)
                                                <span class="price old-price">
                                    {{ __('lang.sar') . ' ' .str_replace(',', '', number_format( $key1->price  + (($tax_tax/100) * $key1->price) , 2))  }}
                                </span>
                                                <span
                                                    class="price current-price">{{ __('lang.sar') . ' ' . str_replace(',', '',  number_format(($key1->price-($key1->price*$key1->discount/100)) + (($tax_tax/100) * $key1->price) , 2))  }}</span>
                                            @else
                                                <span class="price current-price">
                                    {{ __('lang.sar') . ' ' .str_replace(',', '', number_format( $key1->price  + (($tax_tax/100) * $key1->price) , 2)) }}
                                </span>
                                            @endif

                                        </div>
                                        <span class="text-tax">{{__('lang.tax_pro')}}</span>
                                        <div class="product-cart">
                                            {{--                                <a href="cart.html" class="cart-btn"><i class="fal fa-shopping-cart"></i></a>--}}
                                            <li class="cart-btn" id="add_fav" style="cursor: pointer"
                                                data-id="{{ $key1->id }}">
                                                <a>
                                                    @forelse ($key1->favorite as $favorites)
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
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- End Most Sold Product Area  -->
    @endif

    @if($Why_People_Choose_Us->isNotEmpty())
        <!-- Start Why Choose Area  -->
        <div class="axil-why-choose-area pb--50 pb_sm--30" id='why-us'>
            <div class="container">
                <div class="section-title-wrapper section-title-center">
                    <span class="title-highlighter highlighter-secondary"><i class="fal fa-thumbs-up"></i>{{ __('lang.Why_Us') }}</span>
                    <h2 class="title">{{ __('lang.Why_People_Choose_Us') }}</h2>
                </div>
                <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 row--20">
                    @foreach($Why_People_Choose_Us as $key2)

                        <div class="col">
                            <div class="service-box">
                                <div class="icon">
                                    <img src="{{ Request::root() . '/dashboard/images/' . $key2->image }}"
                                         alt="Service">
                                </div>
                                <h6 class="title">
                                    @if( app()->getLocale() == 'en' )
                                        {{ $key2->title_en }}
                                    @elseif( app()->getLocale() == 'ar' )
                                        {{ $key2->title_ar }}
                                    @endif
                                </h6>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- End Why Choose Area  -->
    @endif

    @if($ads->isNotEmpty())
        <!-- Start Axil Product Poster Area  -->
        <div class="axil-poster" id='ads'>
            <div class="container">
                <div class="row">
                    @foreach($ads as $key3)
                        <div class="col-lg-6 mb--30">
                            <div class="single-poster">
                                <a href="{{ $key3->url }}" target="_blank">
                                    <img src="{{ Request::root() . '/dashboard/images/' . $key3->image }}"
                                         alt="@if( app()->getLocale() == 'en' ) {{ $key3->title_en }} @elseif( app()->getLocale() == 'ar' ) {{ $key3->title_ar }} @endif"
                                         style="width: 700px; height:300px;object-fit:cover;">
                                    <div class="poster-content content-left">
                                        <div class="inner">
                                            <h3 class="title">
                                                @if( app()->getLocale() == 'en' )
                                                    {{ $key3->title_en }}
                                                @elseif( app()->getLocale() == 'ar' )
                                                    {{ $key3->title_ar }}
                                                @endif
                                            </h3>
                                        </div>
                                    </div>
                                    <!-- End .poster-content -->
                                </a>
                            </div>
                            <!-- End .single-poster -->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- End Axil Product Poster Area  -->
    @endif

    <div class="axil-poster" style="direction: {{ app()->getLocale() == 'ar' ? 'ltr' : 'rtl' }}">
        <div class="container">
            <div class="row">
                <div class="slider-image">
                    @foreach(\App\Models\Paymentoptions::where('status' , '1')->get() as $key)
                    <div class="img-box" style="padding: 30px">
                        <img src="{{ Request::root() . '/dashboard/images/' . $key->image }}" alt="">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- Start Axil Newsletter Area  -->
    <div class="axil-newsletter-area axil-section-gap pt--0" id='subscribe'>
        <div class="container">
            <div class="etrade-newsletter-wrapper bg_image bg_image--5"
                 style="background-image: url({{ asset('web/assets/images/istockphoto.jpg') }})">
                <div class="newsletter-content">
                <span class="title-highlighter highlighter-primary2">
                    <i class="fas fa-envelope-open"></i>{{ __('lang.Newsletter') }}</span>
                    <h2 class="title mb--40 mb_sm--30">{{ __('lang.Get_weekly_update') }}</h2>
                    <form action="{{ route('subscribe.store') }}" method="POST">
                        @csrf
                        <div class="input-group newsletter-form">
                            <div class="position-relative newsletter-inner mb--15">
                                <input placeholder="example@gmail.com" type="text" name="email"
                                       class="@error('email') is-invalid @enderror">
                            </div>
                            <button type="submit" class="axil-btn mb--15">
                                {{ __('lang.subscribe') }}
                            </button>
                        </div>
                        @error('email')
                        <div class="alert text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
        <!-- End .container -->
    </div>
    <!-- End Axil Newsletter Area  -->

@endsection
@section('js')
<script>
    $('.slider-image').slick({
        dots: false,
        infinite: true,
        speed: 300,
        autoplay: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: true,
        // prevArrow: '<i class="fas fa-chevron-left"></i>',
        // nextArrow: '<i class="fas fa-chevron-right"></i>',
        responsive: [{
            breakpoint: 1199,
            settings: {
                slidesToShow: 4,
            }
        },
        {
            breakpoint: 991,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 600,
                settings: {
                slidesToShow: 2,
            }
        }
    ]
    });
</script>

<script src="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>


        {{--$(document).on('click', '#add_favadd_fav', function (e) {--}}
        {{--    var id = $(this).data('id');--}}
        {{--    if ('{{ \Illuminate\Support\Facades\Auth::user() }}') {--}}
        {{--        $(this).children('a').children('button').children('.fa-heart').toggleClass("red-color-single");--}}
        {{--        $.ajaxSetup({--}}
        {{--            headers: {--}}
        {{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--            }--}}
        {{--        });--}}
        {{--        $.ajax({--}}
        {{--            type: 'POST',--}}
        {{--            url: '{{ route("product.add_fav") }}',--}}
        {{--            data: {--}}
        {{--                'user_id': '{{ \Illuminate\Support\Facades\Auth::id() }}',--}}
        {{--                'product_id': id,--}}
        {{--            },--}}
        {{--            success: function (response) {--}}
        {{--            }--}}
        {{--        });--}}
        {{--    } else {--}}
        {{--        window.location.href = "{{ route('login') }}";--}}
        {{--    }--}}

        {{--});--}}

        // $(document).on('click', '#cart-btn', function (e) {
        //
        //     var quantity = $('#out_quantity').val();
        //
        //     $('#in_quantity').attr('value', quantity);
        //
        //     var color = $('input[name="color"]:checked').data('color');
        //
        //     $('#colorForm').val(color);
        //
        // });
    </script>
    <script>
        $('.name-filter').on('input', function (e) {
            var name = $('.name-filter').val();
            if (name.length > 3 || name.length <= 0) {
                var url = "{{ url('/search') }}";
                $.ajax({
                    url: url,
                    data: {
                        name_en: name,
                    },
                }).done(function (data) {
                    $("#card-body").html(data);
                });
            }
            ;
        });
    </script>
    <script>
        $(document).on('click', '#add_fav', function (e) {
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
                    success: function (response) {
                    }
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

                    $('#product_iddd').attr('value', data.product.id);
                    $('#add_favadd_fav').attr('data-id', data.product.id);
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
                        $('#add_favadd_fav').children('a').children('button').children('.fa-heart').addClass("red-color-single");
                    } else {
                        $('#add_favadd_fav').children('a').children('button').children('.fa-heart').removeClass("red-color-single");
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
        $('#add_favadd_fav').click(function (e) {
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
