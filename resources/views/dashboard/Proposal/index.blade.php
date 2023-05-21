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
                <span class="card-label fw-bolder fs-3 mb-1">{{ __('lang.title_proposal') }}</span>
            </h3>
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
                @include('dashboard.Proposal.table-data')
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
            $("#categories").DataTable();
        $(document).on('click', '#delete' ,function (e){
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
                    url: '{{ url('admin/proposals/destroy') }}/' + id,
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
                            url: "{{ route('proposals.index') }}",
                        }).done(function (data) {
                            $("#table-data").html(data);
                            $("#categories").DataTable();
                        });
                    }
                });
            });
        }

    </script>

@endsection

