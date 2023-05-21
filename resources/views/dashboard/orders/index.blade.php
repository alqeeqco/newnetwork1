@extends('layouts.master')

@section('css')
    <link href="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
@endsection

@section('main_title', __('lang.orders'))
@section('header_title', __('lang.orders'))
@section('subheader_title', __('lang.index'))

@section('content')
    <div class="modal fade " tabindex="-1" id="exampleModal2">
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
                    <div class="row">
                        <table class="table table-row-bordered gy-5">
                            <thead>
                            <tr class="fw-bold fs-6 text-muted text-center">
                                <th>العنوان</th>
                                <th>الوصف</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-center">
                                <th>{{ __('lang.Customer_Number') }}</th>
                                <td id="Customer_Number"></td>
                            </tr>
                            <tr class="text-center">
                                <th>{{ __('lang.order_number') }}</th>
                                <td id="order_number"></td>
                            </tr>
                            <tr class="text-center">
                                <th> {{ __('lang.user_name') }} </th>
                                <td id="user_name"></td>
                            </tr>
                            <tr class="text-center">
                                <th>{{ __('lang.payment_method') }}</th>
                                <td id="payment_method"></td>
                            </tr>
                            <tr class="text-center">
                                <th>{{ __('lang.total') }}</th>
                                <td id="total"></td>
                            </tr>
                            <tr class="text-center">
                                <th>{{ __('lang.created_at') }}</th>
                                <td id="created_at"></td>
                            </tr>
                            <tr class="text-center">
                                <th>{{ __('lang.note') }}</th>
                                <td id="note"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                            data-bs-dismiss="modal">{{ __('lang.but_cancel') }}</button>
                    <a id="pdf" class="btn btn-success">PDF</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade " tabindex="-1" id="exampleModal1212">
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
                    <div class="row">
                        <table class="table table-row-bordered gy-5">
                            <thead>
                            <tr class="fw-bold fs-6 text-muted text-center">
                                <th>العنوان</th>
                                <th>الوصف</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-center">
                                <th>voucher Code</th>
                                <td id="voucherCode"></td>
                            </tr>
                            <tr class="text-center">
                                <th>customer Id</th>
                                <td id="customerId"></td>
                            </tr>
                            <tr class="text-center">
                                <th>application Id</th>
                                <td id="applicationId"></td>
                            </tr>
                            <tr class="text-center">
                                <th>otpID preRedeem</th>
                                <td id="otpID_preRedeem"></td>
                            </tr>
                            <tr class="text-center">
                                <th>voucher Id</th>
                                <td id="voucher_id"></td>
                            </tr>
                            <tr class="text-center">
                                <th>voucher Amount</th>
                                <td id="voucher_amount"></td>
                            </tr>
                            <tr class="text-center">
                                <th>voucher Currency</th>
                                <td id="voucher_currency"></td>
                            </tr>
                            <tr class="text-center">
                                <th>voucher CreatedAt</th>
                                <td id="voucher_createdAt"></td>
                            </tr>
                            <tr class="text-center">
                                <th>voucher ExpiryDate</th>
                                <td id="voucher_expiryDate"></td>
                            </tr>
                            <tr class="text-center">
                                <th>voucher Status</th>
                                <td id="voucher_status"></td>
                            </tr>
                            <tr class="text-center">
                                <th>voucher Application Id</th>
                                <td id="voucher_applicationId"></td>
                            </tr>
                            <tr class="text-center">
                                <th>voucher Transaction Id</th>
                                <td id="voucher_transactionId"></td>
                            </tr>
                            <tr class="text-center">
                                <th>voucher Timestamp</th>
                                <td id="voucher_timestamp"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                    data-bs-dismiss="modal">{{ __('lang.but_cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade " tabindex="-1" id="exampleModal4">
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
                    <div class="row">
                        <table class="table table-row-bordered gy-5">
                            <thead>
                            <tr class="fw-bold fs-6 text-muted text-center">
                                <th>العنوان</th>
                                <th>الوصف</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-center">
                                <th>{{ __('lang.country') }}</th>
                                <td id="country"></td>
                            </tr>
                            <tr class="text-center">
                                <th>{{ __('lang.city') }}</th>
                                <td id="city"></td>
                            </tr>
                            <tr class="text-center">
                                <th> {{ __('lang.street') }} </th>
                                <td id="street"></td>
                            </tr>
                            <tr class="text-center">
                                <th>{{ __('lang.District') }}</th>
                                <td id="district"></td>
                            </tr>
                            <tr class="text-center">
                                <th>{{ __('lang.note') }}</th>
                                <td id="note1"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                            data-bs-dismiss="modal">{{ __('lang.but_cancel') }}</button>
                    {{--                    <button class="btn btn-danger" id="save-delete">{{ __('lang.but_save') }}</button>--}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade " tabindex="-1" id="exampleModal3">
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
                    <div class="row">
                        <table class="table table-row-bordered gy-5">
                            <thead>
                            <tr class="fw-bold fs-6 text-muted text-center">
                                <th>المنتج</th>
                                <th>السعر</th>
                                <th>اللون</th>
                            </tr>
                            </thead>
                            <tbody id="showprod">
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                            data-bs-dismiss="modal">{{ __('lang.but_cancel') }}</button>
                    {{--                    <button class="btn btn-danger" id="save-delete">{{ __('lang.but_save') }}</button>--}}
                </div>
            </div>
        </div>
    </div>

{{--    <div class="card mb-5 mb-xxl-8">--}}
{{--        <!--begin::Header-->--}}
{{--        <div class="card-header border-0 pt-6">--}}
{{--            <div class="px-7 py-5">--}}
{{--                <div class="fs-5 text-dark fw-bolder">{{__('lang.Filter_Options')}}</div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="card-body" style="position: relative;">--}}
{{--            <div>--}}
{{--                <div class="separator border-gray-200"></div>--}}
{{--                <div class="px-7 py-5">--}}
{{--                <form id="filter_order">--}}
{{--                    <div class="mb-10">--}}
{{--                        <div class="item-content row">--}}
{{--                            <div class="form-group col-md-4">--}}
{{--                                <label for="inputEmail"--}}
{{--                                       class="col-lg-12 control-label">{{ __('lang.user_name') }}</label>--}}
{{--                                <input type="text" name="user_name" id="user_name_input" class="form-control form-control-solid" style="height: 45px">--}}
{{--                            </div>--}}

{{--                            <div class="form-group col-md-4">--}}
{{--                                <label for="inputEmail"--}}
{{--                                       class="col-lg-12 control-label">{{ __('lang.payment_method') }}</label>--}}
{{--                                <select class="mb-10 form-select form-select-solid" aria-label="Select example" name="payment_method" id="payment_method_input">--}}
{{--                                    <option value="">all</option>--}}
{{--                                    <option value="tab">{{ __('lang.tap_payment') }}</option>--}}
{{--                                    <option value="emkan">{{ __('lang.emkan_payment') }}</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}

{{--                            <div class="form-group col-md-4">--}}
{{--                                <label for="inputEmail"--}}
{{--                                       class="col-lg-12 control-label">{{ __('lang.payment_status') }}</label>--}}
{{--                                <select class="mb-10 form-select form-select-solid" aria-label="Select example"--}}
{{--                                        name="payment_status" id="payment_status_input">--}}
{{--                                    <option value="">all</option>--}}
{{--                                    <option value="paid">{{ __('lang.paid_o') }}</option>--}}
{{--                                    <option value="failed">{{ __('lang.failed_o') }}</option>--}}
{{--                                    <option value="pending">{{ __('lang.pending_o') }}</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--                    <div class="d-flex justify-content-end">--}}
{{--                        <button type="reset" class="btn btn-white btn-active-light-primary me-2">{{ __('lang.Reset') }}</button>--}}
{{--                        <button type="submit" class="btn btn-primary" id="filter_order_but">{{__('lang.apply')}}</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="card mb-5 mb-xxl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Title-->
            <h3 class="card-title d-flex align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">
                    {{ __('lang.orders') }}
                </span>
                <span class="text-muted fw-bold fs-7 count">
                    {{ __('lang.sub_title_order', ['count' => $orders->count()]) }}
                </span>
            </h3>

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
                @include('dashboard.orders.table-data')
            </div>
        </div>
        <!--end::Body-->
    </div>
@endsection

@section('js')
    <script src="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
{{--    <script>--}}
{{--        $(document).on('click', '#filter_order_but', function (e) {--}}
{{--            e.preventDefault();--}}
{{--            // let formdata = new FormData($('#filter_order')[0]);--}}
{{--            var user_name = $('#user_name_input').val();--}}
{{--            var payment_method = $('#payment_method_input').val();--}}
{{--            var payment_status = $('#payment_status_input').val();--}}
{{--            // $.ajaxSetup({--}}
{{--            //     headers: {--}}
{{--            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--            //     }--}}
{{--            // });--}}
{{--            $.ajax({--}}
{{--                type: 'get',--}}
{{--                url: '{{ url('admin/orders/index') }}/?user_name=' + user_name +--}}
{{--                    '&payment_method=' + payment_method + '&payment_status=' + payment_status,--}}
{{--                data: '',--}}
{{--                success: function (response) {--}}
{{--                    $.ajax({--}}
{{--                        url: "{{ route('order.index') }}"--}}
{{--                    }).done(function (data) {--}}
{{--                        $("#table-data").html(data);--}}
{{--                    });--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
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

        // Delete Function
        $(document).on('click', '.deleteBtn', function (e) {
            e.preventDefault();

            var id = $(this).data('id');

            console.log(id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('orders') }}/" + id,
                type: "DELETE",
                data: {},
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

                    $('.count').text({{ $orders->count() }})

                    $.ajax({
                        url: "{{ route('order.index') }}",
                    }).done(function (data) {
                        $("#table-data").html(data);
                    });
                },
                error: function (data) {

                },
            });
        });
    </script>
    <script>
        $(document).on('click', '#emcan', function (e) {
            e.preventDefault();
            $('#exampleModal1212').modal('show');
            var voucherCode = $(this).data('vouchercode');
            var customerId = $(this).data('customerid');
            var applicationId = $(this).data('applicationid');
            var otpID_preRedeem = $(this).data('otpid_preredeem');
            var voucher_id = $(this).data('voucher_id');
            var voucher_amount = $(this).data('voucher_amount');
            var voucher_currency = $(this).data('voucher_currency');
            var voucher_createdAt = $(this).data('voucher_createdat');
            var voucher_expiryDate = $(this).data('voucher_expirydate');
            // var voucher_createdAt = $(this).data('voucher_createdAt');
            var voucher_status = $(this).data('voucher_status');
            var voucher_applicationId = $(this).data('voucher_applicationid');
            var voucher_transactionId = $(this).data('voucher_transactionid');
            var voucher_timestamp = $(this).data('voucher_timestamp');

            $('#voucherCode').text(voucherCode);
            $('#customerId').text(customerId);
            $('#applicationId').text(applicationId);
            $('#otpID_preRedeem').text(otpID_preRedeem);
            $('#voucher_id').text(voucher_id);
            $('#voucher_amount').text(voucher_amount);
            $('#voucher_currency').text(voucher_currency);
            $('#voucher_createdAt').text(voucher_createdAt);
            $('#voucher_expiryDate').text(voucher_expiryDate);
            $('#voucher_applicationId').text(voucher_applicationId);
            $('#voucher_status').text(voucher_status);
            $('#voucher_transactionId').text(voucher_transactionId);
            $('#voucher_timestamp').text(voucher_timestamp);

        });

        $(document).on('click', '#show_order', function (e) {
            e.preventDefault();
            $('#exampleModal2').modal('show');
            var id_order = $(this).data('id');
            var created = $(this).data('created');
            var payment_method = $(this).data('payment_method');
            var user_id = $(this).data('user_id');
            var user_name = $(this).data('user_name');
            var note = $(this).data('note');
            var total = $(this).data('total');
            $('#Customer_Number').text(user_id);
            $('#order_number').text(id_order);
            $('#user_name').text(user_name);
            $('#payment_method').text(payment_method);
            $('#total').text(total);
            $('#created_at').text(created);
            $('#note').text(note);
            url(id_order);
        });

        function url(id) {
            $(document).off("click", '#pdf').on("click", '#pdf', function (e) {
                window.open("{{ url('admin/orders/print') }}/" + id, '_blank');
            });
        }
    </script>
    <script>
        $(document).on('click', '#prodects', function (e) {
            console.log("sadasd");
            $('#exampleModal3').modal('show');
            const boxes = document.querySelectorAll('.box');
            boxes.forEach(box => {
                box.remove();
            });
            const h2 = document.getElementById("showprod");
            var beforprodect = $(this).data('prodects');
            var beforprice = $(this).data('price');
            var beforcolor = $(this).data('color');
            var beforcount = $(this).data('count');
            const afterprodects = beforprodect.split(',');
            const afterprice = beforprice.split(',');
            const aftercolor = beforcolor.split(',');
            for (var i = 0; i < afterprodects.length; i++) {
                if (i == afterprodects.length - 1) {

                } else {
                    let html = `<tr class="box text-center" style="font-weight: 20px"> <th>${afterprodects[i]}</th> <td>${afterprice[i]}</td> <td><p style="background-color:${aftercolor[i]};">.</p></td> </tr>`;
                    h2.insertAdjacentHTML("afterbegin", html);
                }
            }
        });
    </script>
    <script>
        $(document).on('click', '#address', function (e) {
            e.preventDefault();
            $('#exampleModal4').modal('show');
            var country = $(this).data('country');
            var city = $(this).data('city');
            var street = $(this).data('street');
            var district = $(this).data('district');
            var note = $(this).data('note');
            $('#country').text(country);
            $('#city').text(city);
            $('#street').text(street);
            $('#district').text(district);
            $('#note1').text(note);
        });
    </script>

@endsection
