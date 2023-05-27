<!doctype html>
<html class="no-js" lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>
    @yield('title')
  </title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="robots" content="noindex, follow" />
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('web/assets/images/LOGO.png') }}">
  <link href="{{ asset('dashboard/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
  <!-- CSS
    ============================================ -->
<<<<<<< HEAD
    @if( app()->getLocale() == 'en' )

    <!-- Bootstrap CSS - English -->
    <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/flaticon/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/sal.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/base.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/style.min.css') }}">

    @elseif( app()->getLocale() == 'ar' )
    <!-- Bootstrap CSS - Arabic -->
    <link rel="stylesheet" href="{{ asset('web/rtl_assets/css/vendor/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/rtl_assets/css/vendor/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('web/rtl_assets/css/vendor/flaticon/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('web/rtl_assets/css/vendor/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('web/rtl_assets/css/vendor/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('web/rtl_assets/css/vendor/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/rtl_assets/css/vendor/sal.css') }}">
    <link rel="stylesheet" href="{{ asset('web/rtl_assets/css/vendor/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('web/rtl_assets/css/vendor/base.css') }}">
    <link rel="stylesheet" href="{{ asset('web/rtl_assets/css/style.min.css') }}">
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css">

    @yield('css')
=======
  @if( app()->getLocale() == 'en' )

  <!-- Bootstrap CSS - English -->
  <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/font-awesome.css') }}">
  <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/flaticon/flaticon.css') }}">
  <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/slick-theme.css') }}">
  <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/jquery-ui.min.css') }}">
  <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/sal.css') }}">
  <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/magnific-popup.css') }}">
  <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/base.css') }}">
  <link rel="stylesheet" href="{{ asset('web/assets/css/style.min.css') }}">

  @elseif( app()->getLocale() == 'ar' )
  <!-- Bootstrap CSS - Arabic -->
  <link rel="stylesheet" href="{{ asset('web/rtl_assets/css/vendor/bootstrap.rtl.min.css') }}">
  <link rel="stylesheet" href="{{ asset('web/rtl_assets/css/vendor/font-awesome.css') }}">
  <link rel="stylesheet" href="{{ asset('web/rtl_assets/css/vendor/flaticon/flaticon.css') }}">
  <link rel="stylesheet" href="{{ asset('web/rtl_assets/css/vendor/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('web/rtl_assets/css/vendor/slick-theme.css') }}">
  <link rel="stylesheet" href="{{ asset('web/rtl_assets/css/vendor/jquery-ui.min.css') }}">
  <link rel="stylesheet" href="{{ asset('web/rtl_assets/css/vendor/sal.css') }}">
  <link rel="stylesheet" href="{{ asset('web/rtl_assets/css/vendor/magnific-popup.css') }}">
  <link rel="stylesheet" href="{{ asset('web/rtl_assets/css/vendor/base.css') }}">
  <link rel="stylesheet" href="{{ asset('web/rtl_assets/css/style.min.css') }}">
  @endif

  @yield('css')
>>>>>>> bcf8eca4aa0b7edc30c432e4fca0fdd08162a8bb
</head>

<body class="sticky-header newsletter-popup-modal" style="font-family: cairo, sans-serif;font-style: normal;font-weight: 200;">

  <a href="#top" class="back-to-top" id="backto-top"><i class="fal fa-arrow-up"></i></a>

  <header class="header axil-header header-style-1">
    <div class="axil-header-top">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-sm-6">
            <div class="header-top-dropdown">

<<<<<<< HEAD
                            @if( app()->getLocale() == 'en' )
                              <a rel="alternate" href="{{ LaravelLocalization::getLocalizedURL('en') }}">
                                {{ 'English' }}
                            </a>
                            @else
                            <a rel="alternate" href="{{ LaravelLocalization::getLocalizedURL('ar') }}">
                                {{ 'العربية' }}
                            </a>
                            @endif
=======
              @if( app()->getLocale() == 'en' )
              <a rel="alternate" href="{{ LaravelLocalization::getLocalizedURL('ar') }}">
                {{ 'العربية' }}
              </a>
              @else
              <a rel="alternate" href="{{ LaravelLocalization::getLocalizedURL('en') }}">
                {{ 'English' }}
              </a>
              @endif
>>>>>>> bcf8eca4aa0b7edc30c432e4fca0fdd08162a8bb


            </div>
          </div>
          <div class="col-sm-6">
            <div class="header-top-link">
              <ul class="quick-link">
                @if(\Illuminate\Support\Facades\Auth::user())
                @else
                <li><a href="{{ route('register') }}">{{ __('lang.Join') }}</a></li>
                <li><a href="{{ route('login') }}">{{ __('lang.Login') }}</a></li>
                @endif
              </ul>
            </div>
          </div>
        </div>
<<<<<<< HEAD
        <!-- Start Mainmenu Area  -->
        <div id="axil-sticky-placeholder"></div>
        <div class="axil-mainmenu">
            <div class="container">
                <div class="header-navbar">
                    <div class="header-brand">

                        <a href="{{ url(\Illuminate\Support\Facades\App::getLocale().'/') }}" class="logo logo-dark">
                            <img src="{{ Request::root() . '/dashboard/images/' . \App\Models\Settings::where('key_id' , 'logo')->first()->value }}" alt="{{ env('APP_NAME') }}" style="width: 130px; height:80px; /*object-fit:cover;*/ padding: 10px;">

                        </a>

                    </div>
                    <div class="header-main-nav">
                        <!-- Start Mainmanu Nav -->
                        <nav class="mainmenu-nav">
                            <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i></button>
                            <div class="mobile-nav-brand">
                                <a href="{{ url(app()->getLocale().'/') }}" class="logo">
                                    <img src="{{ Request::root() . '/dashboard/images/' . \App\Models\Settings::where('key_id' , 'logo')->first()->value }}" alt="{{ env('APP_NAME') }}" style="width: 130px; height:80px;object-fit:cover; padding: 10px;">
                                </a>
                            </div>
                            <ul class="mainmenu">
                                <li class="menu-item-has-children">
                                    <a href="#">{{ __('lang.Home') }}</a>
                                    <ul class="axil-submenu">
                                        <li><a href="{{ route('home') }}/#hot-deal-this-week">{{ __('lang.Home1') }}</a></li>
                                        <li><a href="{{ route('home') }}/#categories">{{ __('lang.Home2') }}</a></li>
                                        <li><a href="{{ route('home') }}/#all-products">{{ __('lang.Home3') }}</a></li>
                                        <li><a href="{{ route('home') }}/#new-arrivals">{{ __('lang.Home4') }}</a></li>
                                        <li><a href="{{ route('home') }}/#why-us">{{ __('lang.Home6') }}</a></li>
                                        <li><a href="{{ route('home') }}/#ads">{{ __('lang.Home7') }}</a></li>
                                        <li><a href="{{ route('home') }}/#subscribe">{{ __('lang.Home8') }}</a></li>
                                        <li><a href="{{ route('home') }}/#footer">{{ __('lang.Home9') }}</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">{{ __('lang.Categories') }}</a>
                                    <ul class="axil-submenu">
                                        @foreach ($categories_key as $categories_key1)
                                        <li class="menu-item-has-children position-relative">
                                            <a href="#">{{ app()->getLocale() == 'en' ? $categories_key1->name_en : $categories_key1->name_ar }}</a>
                                            <ul class="axil-submenu nested">
                                                @foreach ($categories_key1->products as $products_key)
                                                <li><a href="{{ route('product.show' , $products_key->id) }}">{{ app()->getLocale() == 'en' ? $products_key->name_en : $products_key->name_ar }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">{{ __('lang.Products') }}</a>
                                    <ul class="axil-submenu">
                                        <li><a href="{{ route('product.index') }}">{{ __('lang.Products1') }}</a></li>
                                        <li><a href="{{ url(\Illuminate\Support\Facades\App::getLocale().'/products/new-arrivals?type=new') }}">{{ __('lang.Products2') }}</a></li>
                                        <li><a href="{{ url(\Illuminate\Support\Facades\App::getLocale().'/products/most-sold?type=sold') }}">{{ __('lang.Products3') }}</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('link.about') }}">{{ __('lang.about') }}</a></li>
                                <li><a href="{{ route('contact-us.index') }}">{{ __('lang.contact') }}</a></li>
                            </ul>
                        </nav>

                        <!-- End Mainmanu Nav -->
                    </div>
                    <div class="header-action">
                        <ul class="action-list">
                            <li class="axil-search">
                                <a href="javascript:void(0)" class="header-search-icon" title="Search">
                                    <i class="flaticon-magnifying-glass"></i>
                                </a>
                            </li>
                            <li class="wishlist">
                                <a href="{{ route('favorite.index') }}">
                                    <i class="flaticon-heart"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('cart.index') }}">
                                    <span class="cart-count">
                                        @if($cart)
                                        {{ $cart->get()->count() ?? 0 }}
                                        @else
                                        0
                                        @endif
                                    </span>
                                    <i class="flaticon-shopping-cart"></i>
                                </a>
                            </li>
                            <li>
                                <a href="http://www.smsaexpress.com/ar/trackingdetails" target="_blank">
                                    <i class="flaticon-truck"></i>
                                </a>
                            </li>
                            <li class="my-account">
                                <a href="javascript:void(0)">
                                    <i class="flaticon-person"></i>
                                </a>
                                <div class="my-account-dropdown">
                                    <span class="title">{{ __('lang.QUICKLINKS') }}</span>
                                    <ul>
                                        <li>
                                            <a href={{ route('account.index') }}>{{ __('lang.my-account') }}</a>
                                        </li>
                                    </ul>
                                    @if(\Illuminate\Support\Facades\Auth::user())
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button class="nav-item nav-link">
                                            <i class="fal fa-sign-out"></i>
                                            Logout
                                        </button>
                                    </form>
                                    @else
                                    <div class="login-btn">
                                        <a href="{{ route('login') }}" class="axil-btn btn-bg-primary">{{ __('lang.Login') }}</a>
                                    </div>
                                    @endif
                                    {{-- <div class="reg-footer text-center">No account yet? <a href={{ route('register') }}--}}
                                    {{-- class="btn-link">{{ __('lang.REGISTER') }}</a>
                                </div>--}}
                    </div>
=======
      </div>
    </div>
    <!-- Start Mainmenu Area  -->
    <div id="axil-sticky-placeholder"></div>
    <div class="axil-mainmenu">
      <div class="container">
        <div class="header-navbar">
          <div class="header-brand">

            <a href="{{ url(\Illuminate\Support\Facades\App::getLocale().'/') }}" class="logo logo-dark">
              <img src="{{ Request::root() . '/dashboard/images/' . \App\Models\Settings::where('key_id' , 'logo')->first()->value }}" alt="{{ env('APP_NAME') }}" style="width: 130px; height:80px; /*object-fit:cover;*/ padding: 10px;">
            </a>

          </div>
          <div class="header-main-nav">
            <!-- Start Mainmanu Nav -->
            <nav class="mainmenu-nav">
              <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i></button>
              <div class="mobile-nav-brand">
                <a href="{{ url(app()->getLocale().'/') }}" class="logo">
                  <img src="{{ Request::root() . '/dashboard/images/' . \App\Models\Settings::where('key_id' , 'logo')->first()->value }}" alt="{{ env('APP_NAME') }}" style="width: 130px; height:80px;object-fit:cover; padding: 10px;">
                </a>
              </div>
              <ul class="mainmenu">
                <li class="menu-item-has-children">
                  <a href="#">{{ __('lang.Home') }}</a>
                  <ul class="axil-submenu">
                    <li><a href="{{ route('home') }}/#hot-deal-this-week">{{ __('lang.Home1') }}</a></li>
                    <li><a href="{{ route('home') }}/#categories">{{ __('lang.Home2') }}</a></li>
                    <li><a href="{{ route('home') }}/#all-products">{{ __('lang.Home3') }}</a></li>
                    <li><a href="{{ route('home') }}/#new-arrivals">{{ __('lang.Home4') }}</a></li>
                    <li class="menu-item-has-children position-relative">
                      <a href="#">{{ __('lang.Home5') }}</a>
                      <ul class="axil-submenu nested">
                        <li><a href="{{ route('home') }}/#why-us">{{ __('lang.Home5.1') }}</a></li>
                        <li><a href="{{ route('home') }}/#ads">{{ __('lang.Home5.2') }}</a></li>
                      </ul>
>>>>>>> bcf8eca4aa0b7edc30c432e4fca0fdd08162a8bb
                    </li>
                    <li class="menu-item-has-children position-relative">
                      <a href="#">{{ __('lang.Home5') }}</a>
                      <ul class="axil-submenu nested">
                        <li><a href="{{ route('home') }}/#why-us">{{ __('lang.Home5.3') }}</a></li>
                        <li><a href="{{ route('home') }}/#ads">{{ __('lang.Home5.4') }}</a></li>
                      </ul>
                    </li>
                    <li><a href="{{ route('home') }}/#why-us">{{ __('lang.Home6') }}</a></li>
                    <li><a href="{{ route('home') }}/#ads">{{ __('lang.Home7') }}</a></li>
                    <li><a href="{{ route('home') }}/#subscribe">{{ __('lang.Home8') }}</a></li>
                    <li><a href="{{ route('home') }}/#footer">{{ __('lang.Home9') }}</a></li>
                  </ul>
                </li>
                <li class="menu-item-has-children">
                  <a href="#">{{ __('lang.Products') }}</a>
                  <ul class="axil-submenu">
                    <li><a href="{{ route('product.index') }}">{{ __('lang.Products1') }}</a></li>
                    <li><a href="{{ url(\Illuminate\Support\Facades\App::getLocale().'/products/new-arrivals?type=new') }}">{{ __('lang.Products2') }}</a></li>
                    <li><a href="{{ url(\Illuminate\Support\Facades\App::getLocale().'/products/most-sold?type=sold') }}">{{ __('lang.Products3') }}</a></li>
                  </ul>
                </li>
                <li><a href="{{ route('link.about') }}">{{ __('lang.about') }}</a></li>
                <li><a href="{{ route('contact-us.index') }}">{{ __('lang.contact') }}</a></li>
              </ul>
            </nav>

            <!-- End Mainmanu Nav -->
          </div>
          <div class="header-action">
            <ul class="action-list">
              <li class="axil-search">
                <a href="javascript:void(0)" class="header-search-icon" title="Search">
                  <i class="flaticon-magnifying-glass"></i>
                </a>
              </li>
              <li class="wishlist">
                <a href="{{ route('favorite.index') }}">
                  <i class="flaticon-heart"></i>
                </a>
              </li>
              <li>
                <a href="{{ route('cart.index') }}">
                  <span class="cart-count">
                    @if($cart)
                    {{ $cart->get()->count() ?? 0 }}
                    @else
                    0
                    @endif
                  </span>
                  <i class="flaticon-shopping-cart"></i>
                </a>
              </li>
              <li>
                <a href="{{ route('cart.index') }}">
                  <i class="flaticon-truck"></i>
                </a>
              </li>
              <li class="my-account">
                <a href="javascript:void(0)">
                  <i class="flaticon-person"></i>
                </a>
                <div class="my-account-dropdown">
                  <span class="title">{{ __('lang.QUICKLINKS') }}</span>
                  <ul>
                    <li>
                      <a href={{ route('account.index') }}>{{ __('lang.my-account') }}</a>
                    </li>
                  </ul>
                  @if(\Illuminate\Support\Facades\Auth::user())
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    @method('POST')
                    <button class="nav-item nav-link">
                      <i class="fal fa-sign-out"></i>
                      Logout
                    </button>
                  </form>
                  @else
                  <div class="login-btn">
                    <a href="{{ route('login') }}" class="axil-btn btn-bg-primary">{{ __('lang.Login') }}</a>
                  </div>
                  @endif
                  {{-- <div class="reg-footer text-center">No account yet? <a href={{ route('register') }}--}}
                  {{-- class="btn-link">{{ __('lang.REGISTER') }}</a>
                </div>--}}
          </div>
          </li>
          <li class="axil-mobile-toggle">
            <button class="menu-btn mobile-nav-toggler">
              <i class="flaticon-menu-2"></i>
            </button>
          </li>
          </ul>
        </div>
      </div>
    </div>
    </div>
    <!-- End Mainmenu Area -->
  </header>

  <main class="main-wrapper">

    @yield('content')

  </main>


  <!-- <div class="service-area">
        <div class="container">
            <div class="row row-cols-xl-4 row-cols-sm-2 row-cols-1 row--20">
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img src="{{ asset('web/assets/images/icons/service1.png') }}" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">Fast &amp; Secure Delivery</h6>
                            <p>Tell about your service.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img src="{{ asset('web/assets/images/icons/service2.png') }}" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">Money Back Guarantee</h6>
                            <p>Within 10 days.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img src="{{ asset('web/assets/images/icons/service3.png') }}" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">24 Hour Return Policy</h6>
                            <p>No question ask.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img src="{{ asset('web/assets/images/icons/service4.png') }}" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">Pro Quality Support</h6>
                            <p>24/7 Live support.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
  <!-- Start Footer Area  -->
  <footer class="axil-footer-area footer-style-2" id='footer'>
    <!-- Start Footer Top Area  -->
    <div class="footer-top separator-top">
      <div class="container">
        <div class="row">
          <!-- about us -->
          <div class="col-12 col-lg-4 mb-4">
            <h5 class="widget-title">about us</h5>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus fugiat autem veniam tempora, iure maxime sit, ut omnis, perferendis dolorem nesciunt quidem dignissimos ad necessitatibus earum molestias sapiente commodi repellat.
            </p>
          </div>
          <div class="col-lg-8 d-flex flex-wrap">
            <!-- Start Single Widget  -->
            <div class="col-12 col-lg-4 col-sm-6">
              <div class="axil-footer-widget">
                <h5 class="widget-title">{{ __('lang.Support') }}</h5>
                <!-- <div class="logo mb--30">
                    <a href="index.html">
                        <img class="light-logo" src="assets/images/logo/logo.png" alt="Logo Images">
                    </a>
                </div> -->
                <div class="inner">
                  <p>
                    @if(\Illuminate\Support\Facades\App::getLocale() == 'ar')
                    {{ \App\Models\Settings::where('key_id' , 'location_ar')->first()->value }}
                    @else
                    {{ \App\Models\Settings::where('key_id' , 'location_en')->first()->value }}
                    @endif
                  </p>
                  <ul class="support-list-item">
                    <li>
                      <a href="mailto:{{ \App\Models\Settings::where('key_id' , 'email')->first()->value }}"><i class="fal fa-envelope-open"></i>
                        {{ \App\Models\Settings::where('key_id' , 'email')->first()->value }}</a>
                    </li>
                    <li><a href="tel:(+01)850-315-5862"><i class="fal fa-phone-alt"></i>
                        {{ \App\Models\Settings::where('key_id' , 'phone')->first()->value }}</a></li>
                    <!-- <li><i class="fal fa-map-marker-alt"></i> 685 Market Street,  <br> Las Vegas, LA 95820, <br> United States.</li> -->
                  </ul>
                </div>
              </div>
            </div>
            <!-- End Single Widget  -->
            <!-- Start Single Widget  -->
            <div class="col-12 col-lg-4 col-sm-6">
              <div class="axil-footer-widget">
                <h5 class="widget-title">{{ __('lang.account') }}</h5>
                <div class="inner">
                  <ul>
                    <li><a href="{{ route('account.index') }}">{{ __('lang.my-account') }}</a></li>
                    @if(\Illuminate\Support\Facades\Auth::user())
                    @else
                    <li><a href="{{ route('login') }}">{{ __('lang.l') }}</a></li>
                    @endif
                    <li><a href="{{ route('cart.index') }}">{{ __('lang.cart') }}</a></li>
                    <li><a href="{{ route('favorite.index') }}">{{ __('lang.wishlist') }}</a></li>
                    <li><a href="{{ route('product.index') }}">{{ __('lang.shop') }}</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- End Single Widget  -->
            <!-- Start Single Widget  -->
            <div class="col-12 col-lg-4 col-sm-6">
              <div class="axil-footer-widget">
                <h5 class="widget-title">{{ __('lang.quick-link') }}</h5>
                <div class="inner">
                  <ul>
                    <li><a href="{{ route('link.privacy_policy') }}">{{ __('lang.privacy-policy') }}</a>
                    </li>
                    <li><a href="{{ route('link.terms_use') }}">{{ __('lang.Terms-of-use') }}</a></li>
                    <li><a href="{{ route('link.faq') }}">{{ __('lang.FAQ') }}</a></li>
                    <li><a href="{{ route('contact-us.index') }}">{{ __('lang.contact') }}</a></li>
                    <li><a href="{{ route('link.about') }}">{{ __('lang.about') }}</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Footer Top Area  -->
    <!-- Start Copyright Area  -->
    <div class="copyright-area copyright-default separator-top">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xl-4">
            <div class="social-share">
              <a href="{{ \App\Models\Settings::where('key_id' , 'facebook')->first()->value }}">
                <!-- <i class="fab fa-facebook-f"></i> -->
                <img src="{{ asset('web/assets/images/facebook.png') }}" alt="facebook">
              </a>
              <a href="{{ \App\Models\Settings::where('key_id' , 'Instagram')->first()->value }}">
                <!-- <i class="fab fa-instagram"></i> -->
                <img src="{{ asset('web/assets/images/instagram.png') }}" alt="instagram">

              </a>
              <a href="{{ \App\Models\Settings::where('key_id' , 'twitter')->first()->value }}">
                <!-- <i class="fab fa-twitter"></i> -->
                <img src="{{ asset('web/assets/images/twitter.png') }}" alt="twitter">

              </a>
              <a href="{{ \App\Models\Settings::where('key_id' , 'TikTok')->first()->value }}">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                                    <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3V0Z" />
                                </svg> -->
                <img src="{{ asset('web/assets/images/tik-tok.png') }}" alt="tik-tok">

              </a>
            </div>
          </div>
          <div class="col-xl-4 col-lg-12">
            <div class="copyright-left d-flex flex-wrap justify-content-center">
              <ul class="quick-link">
                <li>
                  @if(\Illuminate\Support\Facades\App::getLocale() == 'ar')
                  {{ \App\Models\Settings::where('key_id' , 'copy_right_ar')->first()->value }}
                  @else
                  {{ \App\Models\Settings::where('key_id' , 'copy_right_en')->first()->value }}
                  @endif
                </li>
              </ul>
            </div>
          </div>
          <div class="col-xl-4 col-lg-12">
            <div class="copyright-right d-flex flex-wrap justify-content-xl-end justify-content-center align-items-center">
              <span class="card-text">{{ __('lang.accept_for') }}</span>
              <ul class="payment-icons-bottom quick-link">
                @foreach(\App\Models\Paymentoptions::where('status' , '1')->take(3)->get() as $key)
                <li>
                  <img src="{{ Request::root() . '/dashboard/images/' . $key->image }}">
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Copyright Area  -->
  </footer>
  <!-- End Footer Area  -->



  <!-- Header Search Modal End -->
  <div class="header-search-modal" id="header-search-modal">
    <button class="card-close sidebar-close"><i class="fas fa-times"></i></button>
    <div class="header-search-wrap">
      <div class="card-header">

        <div class="input-group">
          <input type="search" class="form-control name-filter" name="name-filter" id="prod-search" placeholder="Write Something....">
          <button type="submit" class="axil-btn btn-bg-primary"><i class="far fa-search"></i></button>
        </div>

      </div>
      <div class="card-body" id="card-body">
        <x-search />
      </div>
    </div>
  </div>
  <!-- Header Search Modal End -->

  <!-- Offer Modal Start -->
  <div class="offer-popup-modal" id="offer-popup-modal">
    <div class="offer-popup-wrap">
      <div class="card-body">
        <button class="popup-close"><i class="fas fa-times"></i></button>
        <div class="content">
          <div class="content">
            <div class="section-title-wrapper">
              <span class="title-highlighter highlighter-primary"> <i class="far fa-shopping-basket"></i>
                Don’t Miss!!</span>
              <h3 class="title">Best Sales Offer<br> Grab Yours</h3>
            </div>
            <div class="poster-countdown countdown"></div>
            <a href="shop.html" class="axil-btn btn-bg-primary">Shop Now <i class="fal fa-long-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="closeMask"></div>
    <!-- Offer Modal End -->
    <!-- JS
============================================ -->
<<<<<<< HEAD
        @if( app()->getLocale() == 'en')
        <!-- Modernizer JS -->
        <script src="{{ asset('web/assets/js/vendor/modernizr.min.js') }}"></script>
        <!-- jQuery JS -->
        <script src="{{ asset('web/assets/js/vendor/jquery.js') }}"></script>
        <!-- Bootstrap JS -->
        <script src="{{ asset('web/assets/js/vendor/popper.min.js') }}"></script>
        <script src="{{ asset('web/assets/js/vendor/bootstrap.min.js') }}"></script>
        <script src="{{ asset('web/assets/js/vendor/slick.min.js') }}"></script>
        <script src="{{ asset('web/assets/js/vendor/js.cookie.js') }}"></script>
        <script src="{{ asset('web/assets/js/vendor/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('web/assets/js/vendor/jquery.countdown.min.js') }}"></script>
        <script src="{{ asset('web/assets/js/vendor/sal.js') }}"></script>
        <script src="{{ asset('web/assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('web/assets/js/vendor/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('web/assets/js/vendor/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('web/assets/js/vendor/counterup.js') }}"></script>
        <script src="{{ asset('web/assets/js/vendor/waypoints.min.js') }}"></script>

        <!-- Main JS -->
        <script src="{{ asset('web/assets/js/main.js') }}"></script>

        @elseif( app()->getLocale() == 'ar' )
        <!-- Modernizer JS -->
        <script src="{{ asset('web/rtl_assets/js/vendor/modernizr.min.js') }}"></script>
        <!-- jQuery JS -->
        <script src="{{ asset('web/rtl_assets/js/vendor/jquery.js') }}"></script>
        <!-- Bootstrap JS -->
        <script src="{{ asset('web/rtl_assets/js/vendor/popper.min.js') }}"></script>
        <script src="{{ asset('web/rtl_assets/js/vendor/bootstrap.min.js') }}"></script>
        <script src="{{ asset('web/rtl_assets/js/vendor/slick.min.js') }}"></script>
        <script src="{{ asset('web/rtl_assets/js/vendor/js.cookie.js') }}"></script>
        <script src="{{ asset('web/rtl_assets/js/vendor/jquery.style.switcher.js') }}"></script>
        <script src="{{ asset('web/rtl_assets/js/vendor/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('web/rtl_assets/js/vendor/jquery.countdown.min.js') }}"></script>
        <script src="{{ asset('web/rtl_assets/js/vendor/sal.js') }}"></script>
        <script src="{{ asset('web/rtl_assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('web/rtl_assets/js/vendor/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('web/rtl_assets/js/vendor/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('web/rtl_assets/js/vendor/counterup.js') }}"></script>
        <script src="{{ asset('web/rtl_assets/js/vendor/waypoints.min.js') }}"></script>

        <!-- Main JS -->
        <script src="{{ asset('web/rtl_assets/js/rtl-main.js') }}"></script>
        @endif
        <script src="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
        <script>
            $('.name-filter').on('change', function(e) {
                var name = $('.name-filter').val();
                if (name.length > 3 || name.length <= 0) {
                    var url = "{{ url('/search') }}";
                    $.ajax({
                        url: url,
                        data: {
                            name_en: name,
                        },
                    }).done(function(data) {
                        $("#card-body").html(data);
                    });
                }
            });
        </script>
        <script>
        {{--$(document).on('click', '#add_fav_add_fav', function (e) {--}}
        {{-- var id = $(this).data('id');--}}
        {{-- if ('{{ \Illuminate\Support\Facades\Auth::user() }}') {--}}
        {{-- $(this).children('a').children('.fa-heart').toggleClass("red-color");--}}
        {{-- $.ajaxSetup({--}}
        {{-- headers: {--}}
        {{-- 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{-- }--}}
        {{-- });--}}
        {{-- $.ajax({--}}
        {{-- type: 'POST',--}}
        {{-- url: '{{ route("product.add_fav") }}',--}}
        {{-- data: {--}}
        {{-- 'user_id': '{{ \Illuminate\Support\Facades\Auth::id() }}',--}}
        {{-- 'product_id': id,--}}
        {{-- },--}}
        {{-- success: function (response) {--}}
        {{-- }--}}
        {{-- });--}}
        {{-- } else {--}}
        {{-- window.location.href = "{{ route('login') }}";--}}
        {{-- }--}}
        {{--});--}}


        </script>

        @yield('js')
=======
    @if( app()->getLocale() == 'en')
    <!-- Modernizer JS -->
    <script src="{{ asset('web/assets/js/vendor/modernizr.min.js') }}"></script>
    <!-- jQuery JS -->
    <script src="{{ asset('web/assets/js/vendor/jquery.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('web/assets/js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/js.cookie.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/sal.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/counterup.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/waypoints.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('web/assets/js/main.js') }}"></script>

    @elseif( app()->getLocale() == 'ar' )
    <!-- Modernizer JS -->
    <script src="{{ asset('web/rtl_assets/js/vendor/modernizr.min.js') }}"></script>
    <!-- jQuery JS -->
    <script src="{{ asset('web/rtl_assets/js/vendor/jquery.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('web/rtl_assets/js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('web/rtl_assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('web/rtl_assets/js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('web/rtl_assets/js/vendor/js.cookie.js') }}"></script>
    <script src="{{ asset('web/rtl_assets/js/vendor/jquery.style.switcher.js') }}"></script>
    <script src="{{ asset('web/rtl_assets/js/vendor/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('web/rtl_assets/js/vendor/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('web/rtl_assets/js/vendor/sal.js') }}"></script>
    <script src="{{ asset('web/rtl_assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('web/rtl_assets/js/vendor/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('web/rtl_assets/js/vendor/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('web/rtl_assets/js/vendor/counterup.js') }}"></script>
    <script src="{{ asset('web/rtl_assets/js/vendor/waypoints.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('web/rtl_assets/js/rtl-main.js') }}"></script>
    @endif
    <script src="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
      $('.name-filter').on('change', function(e) {
        var name = $('.name-filter').val();
        if (name.length > 3 || name.length <= 0) {
          var url = "{{ url('/search') }}";
          $.ajax({
            url: url,
            data: {
              name_en: name,
            },
          }).done(function(data) {
            $("#card-body").html(data);
          });
        }
      });
    </script>
    <script>
    {{--$(document).on('click', '#add_fav_add_fav', function (e) {--}}
    {{-- var id = $(this).data('id');--}}
    {{-- if ('{{ \Illuminate\Support\Facades\Auth::user() }}') {--}}
    {{-- $(this).children('a').children('.fa-heart').toggleClass("red-color");--}}
    {{-- $.ajaxSetup({--}}
    {{-- headers: {--}}
    {{-- 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
    {{-- }--}}
    {{-- });--}}
    {{-- $.ajax({--}}
    {{-- type: 'POST',--}}
    {{-- url: '{{ route("product.add_fav") }}',--}}
    {{-- data: {--}}
    {{-- 'user_id': '{{ \Illuminate\Support\Facades\Auth::id() }}',--}}
    {{-- 'product_id': id,--}}
    {{-- },--}}
    {{-- success: function (response) {--}}
    {{-- }--}}
    {{-- });--}}
    {{-- } else {--}}
    {{-- window.location.href = "{{ route('login') }}";--}}
    {{-- }--}}
    {{--});--}}


    </script>

    @yield('js')
>>>>>>> bcf8eca4aa0b7edc30c432e4fca0fdd08162a8bb
</body>

</html>
