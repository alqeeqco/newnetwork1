<head>
    <base href="">
    <meta charset="utf-8"/>
    <title>
        @yield('main_title')
    </title>
    <meta name="description"
          content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets."/>
    <meta name="keywords"
          content="Metronic, bootstrap, bootstrap 5, Angular 11, VueJs, React, Laravel, admin themes, web design, figma, web development, ree admin themes, bootstrap admin, bootstrap dashboard"/>
    <link rel="canonical" href="Https://preview.keenthemes.com/metronic8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('web/assets/images/favicon.png') }}">
    @if( app()->getLocale() == 'en' )
        <!--begin::Page Vendor Stylesheets(used by this page)-->
        <link href="{{ asset('dashboard/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}"
              rel="stylesheet"
              type="text/css"/>
        <!--end::Page Vendor Stylesheets-->
        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="{{ asset('dashboard/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet"
              type="text/css"/>
        <link href="{{ asset('dashboard/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <!--end::Global Stylesheets Bundle-->
    @elseif( \Illuminate\Support\Facades\App::getLocale() == 'ar' )

        <link href="{{ asset('dashboard/assets/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet"
              type="text/css"/>

        <!--begin::Vendor Stylesheets(used for this page only)-->
        <link href="{{ asset('dashboard/assets/plugins/custom/fullcalender/fullcalendar.bundle.css') }}"
              rel="stylesheet" type="text/css"/>
        <link href="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.rtl.css') }}"
              rel="stylesheet" type="text/css"/>
        <!--end::Vendor Stylesheets-->

        <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
        <link href="{{ asset('dashboard/assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet"
              type="text/css"/>
        <link href="{{ asset('dashboard/assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
        <!--end::Global Stylesheets Bundle-->
    @endif

    @yield('css')
</head>
