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
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('lang.but_cancel') }}</button>
                    <button class="btn btn-danger" id="save-delete">{{ __('lang.but_save') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">{{ __('lang.titlecities') }}</span>
            </h3>
            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover"
                 title="Click to add a Country">
                <a href="{{ route('cities.create' , ['country' => $id ?? ""]) }}" class="btn btn-sm btn-light-primary">
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                             viewBox="0 0 24 24" version="1.1">
													<path
                                                        d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                        fill="#000000" fill-rule="nonzero" opacity="0.3"/>
													<path
                                                        d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                        fill="#000000" fill-rule="nonzero"/>
												</svg>
                    </span>{{ __('lang.newcity') }}</a>
            </div>
        </div>
        @if(Session::has('success'))
            <div class="alert alert-success" style="margin: 15px">
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
                @include('dashboard.Cities.table-data')
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $("#cities").DataTable();
        $(document).on('click', '#status' ,function (e){
            e.preventDefault();
            var id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: '{{ url('admin/cities/Stauts') }}/'+id,
                data: '',
                success: function (response) {
                    $.ajax({
                        url: "{{ route('cities.index') }}"
                    }).done(function(data) {
                        $("#table-data").html(data);
                        $("#cities").DataTable();
                    });
                }
            });
        });

        $(document).on('click', '#delete' ,function (e){
            e.preventDefault();
            var id = $(this).data('id');
            $(document).on('click', '#save-delete' ,function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: '{{ url('admin/cities/destroy') }}/' + id,
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
                            url: "{{ route('cities.index') }}",
                        }).done(function (data) {
                            $("#table-data").html(data);
                            $("#cities").DataTable();
                        });
                    }
                });
            });
        });
    </script>

@endsection


