@extends('layouts.front_layout')

@section('title', 'Terms of use')

@section('content')
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
    <div class="axil-about-area about-style-1 axil-section-gap ">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <div class="axil-privacy-policy">
                        {!! $conditions->value !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                <img src="{{ Request::root() . '/dashboard/images/' . $key2->image }}" alt="Service">
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
@endsection
