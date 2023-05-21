@extends('layouts.master')

@section('css')
    <link href="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('main_title', __('lang.images'))
@section('header_title', __('lang.images'))
@section('subheader_title', __('lang.index'))

@section('content')
    <div class="card mb-5 mb-xxl-8">
        @include('dashboard.images.table-data')
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

        $(document).on('click', '#form-submit', function (e) {
            e.preventDefault();

            let formdata = new FormData($('#image-form')[0]);

            var product_id = $(this).data('product');

            console.log(product_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var image = $('#image-input').val(),
                imageable_type = $('#imageable_type').val();


            $.ajax({
                type: "POST",
                enctype: "multipart/form-data",
                url: "{{ route('image.store', ['model' => 'products']) }}",
                data: formdata,
                cache:false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(data) {
                    if( data.errors ) {
                        $('#image-error').empty();
                        $('#image-error').removeClass('d-none');
                        $.each(data.errors, function(key, value) {
                            $('#image-error').append(`
                                <span>`+ value +`</span>
                            `);
                        });
                    }else if( data.success ){
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
                            url: "{{ url('admin/images/Products') }}/"+product_id,
                        }).done(function (data) {
                            $(".card").html(data);
                        });
                    }

                    setInterval('location.reload()', 1000);
                },
                error: function(data){
                    console.log(data);
                }
            })
        });


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
                url: "{{ url('admin/images/Products') }}/"+id,
                data: {
                    id: id,
                },
                success: function(data) {
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
                    $('#deleteModal-'+id).modal('hide');
                    $.ajax({
                        url: "{{ url('admin/images/Products') }}/"+product_id,
                    }).done(function (data) {
                        $("#table-data").html(data);
                    });
                },
                error: function(data) {

                }

            });
        })



    </script>

@endsection
