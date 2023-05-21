@extends('layouts.front_layout')

@section('title', __('lang.products'))

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

@if($single_product)
<!-- Start Breadcrumb Area  -->
<div class="axil-breadcrumb-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-8">
                <div class="inner">
                    <ul class="axil-breadcrumb">
                        <li class="axil-breadcrumb-item"><a href="{{ url('/') }}">{{ __('lang.Home') }}</a></li>
                        <li class="separator"></li>
                        <li class="axil-breadcrumb-item active" aria-current="page">{{ __('lang.Products1') }}</li>
                    </ul>
                    <h1 class="title">{{ __('lang.explore-product') }}</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-4">
                <div class="inner d-flex justify-content-end">
                    <div class="bradcrumb-thumb">
                        <div class="content-img">
                            <img data-sal-delay="200" data-sal-duration="500" src="{{ Request::root() . '/dashboard/images/' . $single_product->image }}" alt="Image" style="height: 90%; width: 90%">
                        </div>
                        <!-- <br> -->
                        <a style="font-size: 14px;" href="{{ route('product.show' , $single_product->id ) }}">
                            @if( app()->getLocale() == 'en' )
                            {{ $single_product->name_en }}
                            @elseif( app()->getLocale() == 'ar' )
                            {{ $single_product->name_ar }}
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End Breadcrumb Area  -->
@endif
<!-- Start Shop Area  -->
<div class="axil-shop-area axil-section-gap bg-color-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="axil-shop-top">
                    <form action="{{ route('product.index') }}" method="get">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="category-select">
                                    <!-- Start Single Select  -->
                                    <select class="single-select" name="category">
                                        <option value="">{{ __('lang.Categories') }}</option>
                                        @foreach($cat as $cat)
                                        <option value="{{ $cat->id }}" @if(request()->input('category') == $cat->id) selected="selected" @endif>
                                            @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                            {{ $cat->name_en }}
                                            @else
                                            {{ $cat->name_ar }}
                                            @endif
                                        </option>
                                        @endforeach
                                    </select>
                                    <!-- End Single Select  -->

                                    <!-- Start Single Select  -->
{{--                                    <select class="single-select" name="color">--}}
{{--                                        <option value="">{{ __('lang.Colors') }}</option>--}}
{{--                                        @foreach($colors as $color)--}}
{{--                                            @foreach($colors as $color2)--}}
{{--                                                @if($color2->color != $color->color)--}}
{{--                                                    <option value="">000000</option>--}}
{{--                                                @else--}}
{{--                                                    <option value="">111111</option>--}}
{{--                                                    <option value="" @if(request()->input('color')) selected="selected" @endif--}}
{{--                                                    style="background-color: red">00</option>--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
                                    <!-- End Single Select  -->
                                    <!-- Start Single Select  -->
                                    <select class="single-select" name="price">
                                        <option value="">{{ __('lang.Price_Range') }}</option>
                                        <option value="0 - 100" @if(request()->input('price') == '0 - 100') selected="selected" @endif>0 - 100</option>
                                        <option value="100 - 500" @if(request()->input('price') == '100 - 500') selected="selected" @endif>100 - 500</option>
                                        <option value="500 - 1000" @if(request()->input('price') == '500 - 1000') selected="selected" @endif>500 - 1000</option>
                                        <option value="1000 - 1500" @if(request()->input('price') == '1000 - 1500') selected="selected" @endif>1000 - 1500</option>
                                    </select>
                                    <!-- End Single Select  -->
                                    <select class="single-select" name="sort_order">
                                        <option value="desc" @if(request()->input('sort_order')== 'desc') selected="selected" @endif>{{ __('lang.Sort_by_Latest') }}</option>
                                        <option value="name" @if(request()->input('sort_order')== 'name') selected="selected" @endif>{{ __('lang.Sort_by_Name') }}</option>
                                        <option value="price" @if(request()->input('sort_order')== 'price') selected="selected" @endif>{{ __('lang.Sort_by_Price') }}</option>
                                    </select>
                                </div>
                                <!-- <div class="category-select mt_md--10 mt_sm--10 justify-content-lg-start"> -->
                                <!-- Start Single Select  -->

                                <!-- End Single Select  -->
                                <!-- </div> -->
                            </div>
                            <div class="col-lg-4 d-flex justify-content-between align-items-center btn-box">

                                <div class="category-select category-submit justify-content-lg-between">
                                    <button type="submit" class="btn-submit">{{ __('lang.search') }}</button>
                                </div>
                                <a class="reset h-100" href="{{ url('/products') }}">{{ __('lang.Reset') }}</a>

                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row row--15">
            @foreach($products_s as $product)
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="axil-product product-style-one has-color-pick mt--40">
                    <div class="thumbnail">
                        <a href="{{ route('product.show', ['id' => $product->id]) }}">
                            <img src="{{ Request::root() . '/dashboard/images/' . $product->image }}" alt="Product Images">
                        </a>
                        @if($product->discount > 0)
                        <div class="label-block label-right">
                            <div class="product-badget">{{ $product->discount }}% Off</div>
                        </div>
                        @endif
                        <div class="product-hover-action">
                            <ul class="cart-action">
                                <li class="quickview">
                                    <a href="#" data-bs-toggle="modal" class="eye-modal" data-id="{{ $product->id }}" data-bs-target="#quick-view-modal">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </li>
                                <li class="select-option">
                                    <button>
                                        <a href="{{ route('product.show' , $product->id ) }}" style="color: white">
                                            {{ __('lang.Select_Option') }}
                                        </a>
                                    </button>
                                </li>
                                <li class="wishlist" id="add_fav" style="cursor: pointer" data-id="{{ $product->id }}">
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
                            </ul>
                        </div>
                    </div>
                    <div class="product-content">
                        <div class="inner">
                            <h5 class="title">
                                <a href="{{ route('product.show' , $product->id) }}">
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
                                <span class="price current-price">{{ __('lang.sar') . ' ' .  str_replace(',', '', number_format(($product->price-($product->price*$product->discount/100))  + (($tax_tax/100) * $product->price) , 2)) }}</span>
                                @else
                                <span class="price current-price">
                                    {{ __('lang.sar') . ' ' . str_replace(',', '', number_format( $product->price  + (($tax_tax/100) * $product->price) , 2)) }}
                                </span>
                                @endif
                            </div>
                            <span class="text-tax">{{__('lang.tax_pro')}}</span>
                            <div class="color-variant-wrapper">
                                <ul class="color-variant">

                                    @foreach($product->colors as $colors)
                                    <li class="mx-2 color-extra-01">
                                        <!-- <span class="color-name mx-2 py-1 px-3"> ${color}</span> -->
                                        <span style="background-color:{{ $colors->color }}" class="color"></span>
                                    </li>
                                        <!-- <li class="mx-2 color-extra-01">
                                            <span class="color-name mx-2 py-1 px-3">{{ $colors->color }}</span>
                                        </li> -->
                                    @endforeach
{{--                                    </li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Single Product  -->
            @endforeach
        </div>
    </div>
    <!-- End .container -->
</div>
<!-- End Shop Area  -->

<!-- Start Axil Newsletter Area  -->
<div class="axil-newsletter-area axil-section-gap pt--0" id='subscribe'>
    <div class="container">
        <div class="etrade-newsletter-wrapper bg_image bg_image--5" style="background-image: url({{ asset('web/assets/images/istockphoto.jpg') }})">
            <div class="newsletter-content">
                <span class="title-highlighter highlighter-primary2">
                    <i class="fas fa-envelope-open"></i>{{ __('lang.Newsletter') }}</span>
                <h2 class="title mb--40 mb_sm--30">{{ __('lang.Get_weekly_update') }}</h2>
                <form action="{{ route('subscribe.store') }}" method="POST">
                    @csrf

                    <div class="input-group newsletter-form">
                        <div class="position-relative newsletter-inner mb--15">
                            <input placeholder="example@gmail.com" type="text" name="email" class="@error('email') is-invalid @enderror">
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
<script src="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

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
                success: function(response) {
                }
            });
        } else {
            window.location.href = "{{ route('login') }}";
        }
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
                $('#out_quantity_out').val(1);
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
