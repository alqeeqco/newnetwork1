<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - #1 Selling Bootstrap 5 HTML Multi-demo Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->
<head><base href="../../../">
    <meta charset="utf-8" />
    <title>Login To Dashboard</title>
    <meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
    <meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular 11, VueJs, React, Laravel, admin themes, web design, figma, web development, ree admin themes, bootstrap admin, bootstrap dashboard" />
    <link rel="canonical" href="Https://preview.keenthemes.com/metronic8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('dashboard/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="bg-white">
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-color: #F2C98A">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                <!--begin::Content-->
                <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                    <!--begin::Logo-->
                    <a href="{{ route('home') }}" class="site-logo">
                        <img src="{{ Request::root() . '/dashboard/images/' . \App\Models\Settings::where('key_id' , 'logo')->first()->value }}"alt="{{ env('APP_NAME') }}"
                             style="width: 130px; height:80px; padding: 10px;">
                    </a>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #986923;">{{ __('lang.Welcome_to_Dashboard') }}</h1>
                    <!--end::Title-->

                </div>
                <!--end::Content-->
                <!--begin::Illustration-->
                <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url(assets/media/illustrations/checkout.png)"></div>
                <!--end::Illustration-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid py-10">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid">
                <!-- Validation Errors -->

                <x-auth-validation-errors class="mb-4 alert alert-danger" :errors="$errors" />


                <!--begin::Wrapper-->
                <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    <form class="form w-100" action="{{ route('login.admin.store') }}" method="POST">
                        @csrf
                        @method('POST')

                        <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">{{__('lang.Sign_Dashboard')}}</h1>
                            <!--end::Title-->
                        </div>
                        <!--begin::Heading-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="form-label fs-6 fw-bolder text-dark">{{__('lang.email')}}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-lg form-control-solid" type="text" name="email" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack mb-2">
                                <!--begin::Label-->
                                <label class="form-label fw-bolder text-dark fs-6 mb-0">{{__('lang.password')}}</label>
                                <!--end::Label-->
                                <!--begin::Link-->
{{--                                <a href="authentication/flows/aside/password-reset.html" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>--}}
                                <!--end::Link-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Input-->
                            <input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <!--begin::Submit button-->
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                                <span class="indicator-label">{{ __('lang.Continue') }}</span>
{{--                                <span class="indicator-progress">Please wait...--}}
{{--										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>--}}
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
{{--            <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">--}}
{{--                <!--begin::Links-->--}}
{{--                <div class="d-flex flex-center fw-bold fs-6">--}}
{{--                    <a href="https://keenthemes.com" class="text-muted text-hover-primary px-2" target="_blank">About</a>--}}
{{--                    <a href="https://keenthemes.com/support" class="text-muted text-hover-primary px-2" target="_blank">Support</a>--}}
{{--                    <a href="https://1.envato.market/EA4JP" class="text-muted text-hover-primary px-2" target="_blank">Purchase</a>--}}
{{--                </div>--}}
{{--                <!--end::Links-->--}}
{{--            </div>--}}
            <!--end::Footer-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Main-->
<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('dashboard/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('dashboard/assets/js/custom/authentication/sign-in/general.js') }}"></script>
<!--end::Page Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
