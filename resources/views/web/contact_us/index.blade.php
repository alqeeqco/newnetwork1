@extends('layouts.front_layout')

@section('title', 'Contact Us')

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

    <!-- Start Contact Area  -->
    <div class="axil-contact-page-area axil-section-gap">
        <div class="container">
            <div class="axil-contact-page">
                <div class="row row--30">
                    <div class="col-lg-8">
                        <div class="contact-form">
                            <h3 class="title mb--10">{{ __('lang.We_would') }}</h3>
                            <p>{{ __('lang.If_you’ve') }}</p>
                            <form action="{{ route('contact-us.store') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="row row--10">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="contact-name">{{ __('lang.name') }} <span>*</span></label>
                                            <input type="text" class="@error('name') is-invalid @enderror" name="name" id="contact-name">
                                            @error('name')
                                                <div class="alert text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="contact-phone">{{ __('lang.phone') }} <span>*</span></label>
                                            <input type="text" class="@error('phone') is-invalid @enderror" name="phone" id="contact-phone">
                                            @error('phone')
                                                <div class="alert text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="contact-email">{{ __('lang.email') }} <span>*</span></label>
                                            <input type="email" class="@error('email') is-invalid @enderror" name="email" id="contact-email">
                                            @error('email')
                                                <div class="alert text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-message">{{ __('lang.Your_Message') }}</label>
                                            <textarea class="@error('massage') is-invalid @enderror"  name="message" id="message" cols="1" rows="2"></textarea>
                                            @error('message')
                                                <div class="alert text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb--0">
                                            <button name="submit" type="submit" id="submit" class="axil-btn btn-bg-primary">{{ __('lang.Send_Message') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-location mb--40">
                            <h4 class="title mb--20">{{ __('lang.Our_Store') }}</h4>
                            <span class="address mb--20">
                                @if(\Illuminate\Support\Facades\App::getLocale() == 'ar')
                                    {{ \App\Models\Settings::where('key_id' , 'location_ar')->first()->value }}
                                @else
                                    {{ \App\Models\Settings::where('key_id' , 'location_en')->first()->value }}
                                @endif
                            </span>
                            <span class="phone">{{ __('lang.phone') }}: {{ \App\Models\Settings::where('key_id' , 'phone')->first()->value }}</span>
                            <span class="email">{{ __('lang.email') }}: {{ \App\Models\Settings::where('key_id' , 'email')->first()->value }}</span>
                        </div>
                        <div class="opening-hour">
                            <h4 class="title mb--20">{{ __('lang.Opening_Hours') }}:</h4>
                            <p>
                                @if(\Illuminate\Support\Facades\App::getLocale() == 'ar')
                                    {{ \App\Models\Settings::where('key_id' , 'opening_hours_ar')->first()->value }}
                                @else
                                    {{ \App\Models\Settings::where('key_id' , 'opening_hours_en')->first()->value }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Google Map Area  -->
            <div class="axil-google-map-wrap axil-section-gap pb--0">
                <div class="mapouter">
                    <div class="gmap_canvas">
                        <iframe width="1080" height="500" id="gmap_canvas" src="https://www.google.com/maps/embed/v1/search?q=الشبكة+الجديدة+لبيع+وتقسيط+الجوالات&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe>
                    </div>
                </div>
            </div>
             <!-- End Google Map Area  -->  
        </div>
    </div>
    <!-- End Contact Area  -->
@endsection
