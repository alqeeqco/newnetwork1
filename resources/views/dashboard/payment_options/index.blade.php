@extends('layouts.master')

@section('css')
    <link href="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
@endsection

@section('main_title', __('lang.payment-option'))
@section('header_title', __('lang.payment-option'))
@section('subheader_title', __('lang.index'))

@section('content')
    <div class="modal fade" tabindex="-1" id="createModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ __('lang.create_image_title') }}
                    </h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                         aria-label="Close">
                        <i class="bi bi-x fs-2"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form id="image-form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <p>
                            {{ __('lang.create_image_body') }}
                        </p>
                        <div class="image-input image-input-empty col-3" data-kt-image-input="true"
                             style="background-image: url({{ asset('dashboard/assets/media/avatars/blank.png') }}); margin: 15px; width: 30%; height: 10%;">
                            <!--begin::Image preview wrapper-->
                            <div class="image-input-wrapper w-125px h-125px"></div>
                            <!--end::Image preview wrapper-->

                            <!--begin::Edit button-->
                            <label
                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                data-kt-image-input-action="change"
                                data-bs-toggle="tooltip"
                                data-bs-dismiss="click"
                                title="Add Image">
                                <i class="bi bi-pencil-fill fs-7"></i>

                                <!--begin::Inputs-->
                                <input type="file" name="image" id="image-input" accept=".png, .jpg, .jpeg"/>
                                <input type="hidden" name="avatar_remove"/>
                                <!--end::Inputs-->
                            </label>
                            <!--end::Edit button-->

                            <!--begin::Cancel button-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                  data-kt-image-input-action="cancel"
                                  data-bs-toggle="tooltip"
                                  data-bs-dismiss="click"
                                  title="Cancel avatar">
                                 <i class="bi bi-x fs-2"></i>
                             </span>
                            <!--end::Cancel button-->

                            <!--begin::Remove button-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                  data-kt-image-input-action="remove"
                                  data-bs-toggle="tooltip"
                                  data-bs-dismiss="click"
                                  title="Remove avatar">
                                 <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Remove button-->
                        </div>
                        <div id="image-error" class="alert text-danger d-none">
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        {{ __('lang.close') }}
                    </button>
                    <button type="submit" id="add_payment" class="btn btn-success">
                        {{ __('lang.sure') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
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

    <div class="card mb-5 mb-xxl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Title-->
            <h3 class="card-title d-flex align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">
                    {{ __('lang.payment-option') }}
                </span>
            </h3>
            <div class="card-toolbar">

                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <a href="{{ route('image.create', ['model' => 'products']) }}" type="button"
                       class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                       data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end" data-bs-toggle="modal"
                       data-bs-target="#createModal">
                        <i class="fas fa-plus"></i>
                        {{ __('lang.image_create') }}
                    </a>
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Title-->

        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body" style="position: relative;">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div id="table-data">
                @include('dashboard.payment_options.table-data')
            </div>
        </div>
        <!--end::Body-->
    </div>
@endsection

@section('js')
    <script src="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        var tabel = $("#kt_datatable_example_1").DataTable();
        $('#re').click(function () {
            $(".table-data").html(data);
        });

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
                url: '{{ url('/admin/status') }}/' + id,
                data: '',
                success: function (response) {
                    $.ajax({
                        url: "{{ route('admin.index') }}"
                    }).done(function (data) {
                        $("#table-data").html(data);
                    });
                }
            });
        });

        $(document).on('click', '#add_payment', function (e) {
            e.preventDefault();
            let formdata = new FormData($('#image-form')[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                enctype: "multipart/form-data",
                url: "{{ route('PaymentOptions.store') }}",
                data: formdata,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#image-error').empty();
                        $('#image-error').removeClass('d-none');
                        $.each(data.errors, function (key, value) {
                            $('#image-error').append(`
                                <span>` + value + `</span>
                            `);
                        });
                    } else if (data.success) {
                        $('#image-error').empty();
                        $('#image-error').addClass('d-none');

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
                        $('#createModal').modal('hide');
                        $.ajax({
                            url: "{{ route('PaymentOptions.index') }}",
                        }).done(function (data) {
                            $("#table-data").html(data);
                        });
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            })
        });

        $(document).on('click', '#show-modal-delete', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#kt_modal_1').modal('show');
            delete_f(id);
        });

        function delete_f(id) {
            $(document).off("click", "#save-delete").on("click", "#save-delete", function (e) {
                console.log("dASDasdasdad");
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "{{ url('admin/payment-options/destroy') }}/" + id,
                    data: '',
                    success: function (data) {
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
                            url: "{{ route('PaymentOptions.index') }}",
                        }).done(function (data) {
                            $("#table-data").html(data);
                        });
                    },
                    error: function (data) {

                    }
                });
            });
        }

        $(document).on('click', '#delete-btn', function (e) {
            e.preventDefault();

            var id = $(this).data('id'),
                product_id = $(this).data('product');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: "{{ url('admin/images/Products') }}/" + id,
                data: {
                    id: id,
                },
                success: function (data) {
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
                    $('#deleteModal-' + id).modal('hide');
                    $.ajax({
                        url: "{{ url('admin/images/Products') }}/" + product_id,
                    }).done(function (data) {
                        $("#table-data").html(data);
                    });
                },
                error: function (data) {

                }

            });
        })

    </script>

@endsection
