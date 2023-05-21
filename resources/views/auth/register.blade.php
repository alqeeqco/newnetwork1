
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>eTrade || Sign Up</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('web/assets/images/favicon.png') }}">

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
    <link rel="stylesheet" href="{{ asset('web/assets/css/style.min.css') }}">

</head>


<body>
    <div class="axil-signin-area">

        <!-- Start Header -->
        <div class="signin-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <a href="{{ route('home') }}" class="site-logo">
                        <img src="{{ asset('web/assets/images/logo/logo.png') }}" alt="logo">
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="singin-header-btn">
{{--                        <p>--}}
{{--                            <a href="">{{ __('lang.already_member') }}</a>--}}
{{--                        </p>--}}
                        <a href="{{ route('login') }}" class="axil-btn btn-bg-secondary sign-up-btn">
                            {{ __('lang.login') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <div class="axil-signin-banner bg_image bg_image--10">
                    <h3 class="title">
                        {{ __('lang.best_product') }}
                    </h3>
                </div>
            </div>
            <div class="col-lg-6 offset-xl-2">
                <div class="axil-signin-form-wrap">
                    <div class="axil-signin-form">
                        <x-auth-validation-errors class="mb-4 alert alert-danger" :errors="$errors" />
                        <h3 class="title">
                            {{ __('lang.new_here') }}
                        </h3>
                        <p class="b2 mb--55">
                            {{ __('lang.enter_details') }}
                        </p>
                        <form action="{{ route('register') }}" method="POST" class="singin-form">
                            @csrf
                            @method('POST')

                            <div class="form-group">
                                <label>
                                    {{ __('lang.user_name') }}
                                </label>
                                <input type="text" class="form-control" name="user_name" placeholder="anniemario">
                            </div>
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
                                <input type="password" class="form-control" name="password" placeholder="********">
                            </div>

                            <div class="form-group">
                                <label>
                                    {{ __('lang.confirm_password') }}
                                </label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="********">
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <input class="position-static opacity-100" style="width:20px; height:20px" type="checkbox" name="Terms" required>
                                <a href="{{ route('link.terms_use') }}" class="mx-2">{{ __('lang.Agree_terms') }}</a>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="axil-btn btn-bg-primary submit-btn">
                                    {{ __('lang.create_account') }}
                                </button>
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

</body>

</html>
