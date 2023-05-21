@if( app()->getLocale() == 'en' )
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('dashboard/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Vendors Javascript(used by this page)-->
    <script src="{{ asset('dashboard/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <!--end::Page Vendors Javascript-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{ asset('dashboard/assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/custom/modals/create-app.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/custom/modals/upgrade-plan.js') }}"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
@elseif( app()->getLocale() == 'ar' )

    <script src="{{ asset('dashboard/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/scripts.bundle.js') }}"></script>

    <script src="{{ asset('dashboard/assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/custom/utilities/modals/new-target.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/custom/utilities/modals/users-search.js') }}"></script>
@endif
@yield('js')
