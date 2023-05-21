@extends('layouts.master')

@section('css')
    <link href="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('main_title', __('lang.admins'))
@section('header_title', __('lang.admins'))
@section('subheader_title', __('lang.index'))

@section('content')
    <div class="card mb-5 mb-xxl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Title-->
            <h3 class="card-title d-flex align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">
                    {{ __('lang.admins') }}
                </span>
                <span class="text-muted fw-bold fs-7">
                    {{ __('lang.sub_title_message', ['count' => $admins->count()]) }}
                </span>
            </h3>
            <div class="card-toolbar">
                @can('Admins-Create')
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <a href="{{ route('admin.create') }}" type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                        <i class="fas fa-plus"></i>
                        {{ __('lang.admin_create') }}
                    </a>
                </div>
                @endcan
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
                @include('dashboard.admins.table-data')
            </div>
        </div>
        <!--end::Body-->
    </div>
@endsection

@section('js')
    <script src="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        var tabel = $("#kt_datatable_example_1").DataTable();
        $('#re').click(function (){
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
    </script>

@endsection
