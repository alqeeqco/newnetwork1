
<!doctype html>
<html class="no-js" lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        {{ __('lang.login') }}
    </title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
{{--    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('web/assets/images/favicon.png') }}">--}}

    <!-- CSS
    ============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/flaticon/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/sal.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/base.css') }}">

    @if( app()->getLocale() == 'en')
        <link rel="stylesheet" href="{{ asset('web/assets/css/style.min.css') }}">
    @elseif( app()->getLocale() == 'ar' )
        <link rel="stylesheet" href="{{ asset('web/rtl_assets/css/style.min.css') }}">
    @endif


</head>


<body>
    <div class="axil-signin-area">

        <!-- Start Header -->
        <div class="signin-header">
            <div class="row align-items-center">
                <div class="col-sm-4">
                    <a href="{{ route('home') }}" class="site-logo">
                        <img src="{{ Request::root() . '/dashboard/images/' . \App\Models\Settings::where('key_id' , 'logo')->first()->value }}"alt="{{ env('APP_NAME') }}" style="width: 130px; height:80px; padding: 10px;">
                    </a>
                </div>
                <div class="col-sm-8">
                    <div class="singin-header-btn">
                        <p>
                            <a href="{{ url(app()->getLocale().'/') }}">{{ __('lang.not_a_member') }}</a>
                        </p>
                        <a href="{{ route('register') }}" class="axil-btn btn-bg-secondary sign-up-btn">
                            {{ __('lang.sign_up') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <div class="axil-signin-banner bg_image bg_image--9">
                    <h3 class="title">
                        {{ __('lang.best_product') }}
                    </h3>
                </div>
            </div>
            <div class="col-lg-4 offset-xl-2">
                <div class="axil-signin-form-wrap">
                    <div class="axil-signin-form">
                        <x-auth-validation-errors class="mb-4 alert alert-danger" :errors="$errors" />
                        <h3 class="title">
                            {{ __('lang.login') }}
                        </h3>
                        <p class="b2 mb--55">
                            {{ __('lang.enter_details') }}
                        </p>
                        <form action="{{ route('login') }}" method="POST" class="singin-form">
                            @csrf
                            @method('POST')

                            <div class="form-group">
                                <label>
                                    {{ __('lang.email') }}
                                </label>
                                <input type="email" class="form-control" name="email" placeholder="annie@example.com">

                            </div>

                            <div class="form-group">
                                <label>
                                    {{ __('lang.password') }}
                                </label>
                                <input type="password" class="form-control" name="password" placeholder="*********">
                            </div>
{{--                            <div class="d-flex align-items-center mb-4">--}}
{{--                                <input class="position-static opacity-100" style="width:20px; height:20px" type="checkbox" name="Terms" required>--}}
{{--                                <a href="{{ route('link.terms_use') }}" class="mx-2">{{ __('lang.Agree_terms') }}</a>--}}
{{--                            </div>--}}
                            <div class="form-group d-flex align-items-center justify-content-between">
                                <button type="submit" class="axil-btn btn-bg-primary submit-btn">
                                    {{ __('lang.login') }}
                                </button>
{{--                                <a href="{{ route('GETforgotPassword') }}" class="forgot-btn">--}}
                                <a href="{{ route('password.request') }}" class="forgot-btn">
                                    {{ __('lang.forget_password') . ' ?' }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS
============================================ -->
    <!-- Modernizer JS -->
    <script src="{{ asset('assets/js/vendor/modernizr.min.js') }}"></script>
    <!-- jQuery JS -->
    <script src="{{ asset('assets/js/vendor/jquery.js') }}"></script>
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

</body>

</html>
