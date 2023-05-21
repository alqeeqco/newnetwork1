@extends('layouts.master')

@section('main_title', 'Home Page')
@section('header_title', 'Home')
@section('subheader_title', '#XV2')

@section('content')
    <div class="modal fade" tabindex="-1" id="kt_modal_1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('lang.title_modal') }}</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                         aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <p>{{ __('lang.body_modal') }}</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                            data-bs-dismiss="modal">{{ __('lang.but_cancel') }}</button>
                    <button class="btn btn-danger" id="save-delete">{{ __('lang.but_save') }}</button>
                </div>
            </div>
        </div>
    </div>
{{--    <div class="modal fade" tabindex="-1" id="kt_modal_2">--}}
{{--        <div class="modal-dialog">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title">{{ __('lang.title_modals') }}</h5>--}}

{{--                    <!--begin::Close-->--}}
{{--                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"--}}
{{--                         aria-label="Close">--}}
{{--                        <span class="svg-icon svg-icon-2x"></span>--}}
{{--                    </div>--}}
{{--                    <!--end::Close-->--}}
{{--                </div>--}}

{{--                <div class="modal-body">--}}
{{--                    <div class="row">--}}
{{--                        <table class="table table-row-bordered gy-5">--}}
{{--                            <thead>--}}
{{--                            <tr class="fw-bold fs-6 text-muted text-center">--}}
{{--                                <th>العنوان</th>--}}
{{--                                <th>الوصف</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            <tr class="text-center">--}}
{{--                                <th>--}}
{{--                                    <div class="d-flex justify-content-start flex-column">--}}
{{--                                        <p class="text-dark fw-bolder text-hover-primary fs-6">--}}
{{--                                            {{ __('lang.id') }}--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </th>--}}
{{--                                <td>--}}
{{--                                    <div class="d-flex justify-content-start flex-column">--}}
{{--                                        <p class="text-dark fw-bolder text-hover-primary fs-6" id="Numberorders">--}}
{{--                                            id--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </td>--}}

{{--                                <th>--}}
{{--                                    <div class="d-flex justify-content-start flex-column">--}}
{{--                                        <p class="text-dark fw-bolder text-hover-primary fs-6">--}}
{{--                                            {{ __('lang.name') }}--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </th>--}}
{{--                                <td>--}}
{{--                                    <div class="d-flex justify-content-start flex-column">--}}
{{--                                        <p class="text-dark fw-bolder text-hover-primary fs-6" id="Numberorders">--}}
{{--                                            name--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </td>--}}

{{--                                <th>--}}
{{--                                    <div class="d-flex justify-content-start flex-column">--}}
{{--                                        <p class="text-dark fw-bolder text-hover-primary fs-6">--}}
{{--                                            {{ __('lang.user_name') }}--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </th>--}}
{{--                                <td>--}}
{{--                                    <div class="d-flex justify-content-start flex-column">--}}
{{--                                        <p class="text-dark fw-bolder text-hover-primary fs-6" id="Numberorders">--}}
{{--                                            user_name--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </td>--}}

{{--                                <th>--}}
{{--                                    <div class="d-flex justify-content-start flex-column">--}}
{{--                                        <p class="text-dark fw-bolder text-hover-primary fs-6">--}}
{{--                                            {{ __('lang.email') }}--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </th>--}}
{{--                                <td>--}}
{{--                                    <div class="d-flex justify-content-start flex-column">--}}
{{--                                        <p class="text-dark fw-bolder text-hover-primary fs-6" id="Numberorders">--}}
{{--                                            email--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </td>--}}

{{--                                <th>--}}
{{--                                    <div class="d-flex justify-content-start flex-column">--}}
{{--                                        <p class="text-dark fw-bolder text-hover-primary fs-6">--}}
{{--                                            {{ __('lang.email') }}--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </th>--}}
{{--                                <td>--}}
{{--                                    <div class="d-flex justify-content-start flex-column">--}}
{{--                                        <p class="text-dark fw-bolder text-hover-primary fs-6" id="Numberorders">--}}
{{--                                            email--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </td>--}}

{{--                                <th>--}}
{{--                                    <div class="d-flex justify-content-start flex-column">--}}
{{--                                        <p class="text-dark fw-bolder text-hover-primary fs-6">--}}
{{--                                            {{ __('lang.country') }}--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </th>--}}
{{--                                <td>--}}
{{--                                    <div class="d-flex justify-content-start flex-column">--}}
{{--                                        <p class="text-dark fw-bolder text-hover-primary fs-6" id="Numberorders">--}}
{{--                                            country--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </td>--}}

{{--                                <th>--}}
{{--                                    <div class="d-flex justify-content-start flex-column">--}}
{{--                                        <p class="text-dark fw-bolder text-hover-primary fs-6">--}}
{{--                                            {{ __('lang.city') }}--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </th>--}}
{{--                                <td>--}}
{{--                                    <div class="d-flex justify-content-start flex-column">--}}
{{--                                        <p class="text-dark fw-bolder text-hover-primary fs-6" id="Numberorders">--}}
{{--                                            city--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </td>--}}

{{--                                <th>--}}
{{--                                    <div class="d-flex justify-content-start flex-column">--}}
{{--                                        <p class="text-dark fw-bolder text-hover-primary fs-6">--}}
{{--                                            {{ __('lang.street') }}--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </th>--}}
{{--                                <td>--}}
{{--                                    <div class="d-flex justify-content-start flex-column">--}}
{{--                                        <p class="text-dark fw-bolder text-hover-primary fs-6" id="Numberorders">--}}
{{--                                            street--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </td>--}}

{{--                                <th>--}}
{{--                                    <div class="d-flex justify-content-start flex-column">--}}
{{--                                        <p class="text-dark fw-bolder text-hover-primary fs-6">--}}
{{--                                            {{ __('lang.district') }}--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </th>--}}
{{--                                <td>--}}
{{--                                    <div class="d-flex justify-content-start flex-column">--}}
{{--                                        <p class="text-dark fw-bolder text-hover-primary fs-6" id="Numberorders">--}}
{{--                                            district--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </td>--}}

{{--                                <th>--}}
{{--                                    <div class="d-flex justify-content-start flex-column">--}}
{{--                                        <p class="text-dark fw-bolder text-hover-primary fs-6">--}}
{{--                                            {{ __('lang.district') }}--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </th>--}}
{{--                                <td>--}}
{{--                                    <div class="d-flex justify-content-start flex-column">--}}
{{--                                        <p class="text-dark fw-bolder text-hover-primary fs-6" id="Numberorders">--}}
{{--                                            district--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}

{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-light"--}}
{{--                            data-bs-dismiss="modal">{{ __('lang.but_cancel') }}</button>--}}
{{--                    <button class="btn btn-danger" id="save-delete">{{ __('lang.but_save') }}</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">{{ __('lang.titleusers') }}</span>
            </h3>
        </div>
        @if(Session::has('success'))
            <div class="alert alert-success" id="success" style="margin: 15px">
                {{Session::get('success')}}
            </div>
        @endif
        @if(Session::has('delete'))
            <div class="alert alert-danger" style="margin: 15px">
                {{Session::get('delete')}}
            </div>
        @endif
        @if(Session::has('warning'))
            <div class="alert alert-warning" style="margin: 15px">
                {{Session::get('warning')}}
            </div>
        @endif
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive" id="table-data">
                <!--begin::Table-->
                @include('dashboard.Users.table-data')
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $("#users").DataTable();
        $(document).on('click', '#status', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: '{{ url('admin/users/Stauts') }}/' + id,
                data: '',
                success: function (response) {
                    $.ajax({
                        url: "{{ route('users.index') }}"
                    }).done(function (data) {
                        $("#table-data").html(data);
                        $("#users").DataTable();
                    });
                }
            });
        });
        $(document).on('click', '#delete', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            delete_f(id);
        });

        function delete_f(id) {
            $(document).off("click", "#save-delete").on("click", "#save-delete", function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: '{{ url('admin/users/destroy') }}/' + id,
                    data: '',
                    success: function (response) {
                        Swal.fire({
                            title: '{{ __('lang.Good_job') }}',
                            text: '{{ __('lang.You_clicked_button') }}',
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: '{{ __('lang.Confirm_me') }}',
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                        $('#kt_modal_1').modal('hide');
                        $.ajax({
                            url: "{{ route('users.index') }}"
                        }).done(function (data) {
                            $("#table-data").html(data);
                            $("#users").DataTable();
                        });
                    }
                });
            });
        }

    </script>

@endsection

