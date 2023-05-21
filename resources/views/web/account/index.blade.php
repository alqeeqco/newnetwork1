@extends('layouts.front_layout')

@section('title', 'Account')

@section('content')
    <div class="modal fade" id="addAddress" tabindex="-1" aria-labelledby="addAddress" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-5">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ __('lang.add_address') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" id="div-error" hidden>
                        <ul id="error">
                        </ul>
                    </div>
                    <form id="add_address">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label class="mb-3">
                                {{ __('lang.country') }}
                            </label>
                            <select class="selDiv1 form-select" name="country_id" id="country_id" aria-label="Default select example">
                                @foreach( $countries as $country )
                                    <option value="{{ $country->id }}">
                                        @if( app()->getLocale() == 'en' )
                                            {{ $country->name_en }}
                                        @else
                                            {{ $country->name_ar }}
                                        @endif
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="mb-3">
                                {{ __('lang.city') }}
                            </label>
                            <select class="selDiv2 form-select" name="city_id" id="city_id" aria-label="Default select example">
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">
                                        @if( app()->getLocale() == 'en' )
                                            {{ $city->name_en }}
                                        @else
                                            {{ $city->name_ar }}
                                        @endif

                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="mb-3">
                            <div class="form-group">
                                <label>
                                    {{ __('lang.street') }}
                                </label>
                                <input type="text" name="street" id="street" class="form-control" value="">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-group">
                                <label>
                                    {{ __('lang.District') }}
                                </label>
                                <input type="text" name="district" id="district" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label>
                                    {{ __('lang.czip') }}
                                </label>
                                <input type="number" name="czip" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-group">
                                <label>
                                    {{ __('lang.cpobox') }}
                                </label>
                                <input type="text" name="cpobox" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-group">
                                <label>
                                    {{ __('lang.cmobile') }}
                                </label>
                                <input type="text" name="cmobile" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-group">
                                <label>
                                    {{ __('lang.note') }}
                                </label>
                                <textarea type="text" name="note" id="note" class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                        <button  type="submit" class="btn btn-primary py-3 submit-address" style="font-size: 16px;">
                            {{ __('lang.save') }}
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade " tabindex="-1" id="exampleModal1212" aria-hidden="true">
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
                    <div class="table-responsive">
                        <table class="table table-row-bordered gy-5">
                            <thead>
                            <tr class="fw-bold fs-6 text-muted text-center">
                                <th>العنوان</th>
                                <th>الوصف</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-center" style="margin: 5px;">
                                <th>voucher Code</th>
                                <th id="voucherCode"></th>
                            </tr>
                            <tr class="text-center">
                                <th>customer Id</th>
                                <th id="customerId"></th>
                            </tr>
                            <tr class="text-center">
                                <th>application Id</th>
                                <th id="applicationId"></th>
                            </tr>
                            {{-- <tr class="text-center">
                                <th>otpID preRedeem</th>
                                <th id="otpID_preRedeem"></th>
                            </tr> --}}
                            <tr class="text-center">
                                <th>voucher Id</th>
                                <th id="voucher_id"></th>
                            </tr>
                            <tr class="text-center">
                                <th>voucher Amount</th>
                                <th id="voucher_amount"></th>
                            </tr>
                            <tr class="text-center">
                                <th>voucher Currency</th>
                                <th id="voucher_currency"></th>
                            </tr>
                            <tr class="text-center">
                                <th>voucher CreatedAt</th>
                                <th id="voucher_createdAt"></th>
                            </tr>
                            <tr class="text-center">
                                <th>voucher ExpiryDate</th>
                                <th id="voucher_expiryDate"></th>
                            </tr>
                            <tr class="text-center">
                                <th>voucher Status</th>
                                <th id="voucher_status"></th>
                            </tr>
                            {{-- <tr class="text-center">
                                <th>voucher Application Id</th>
                                <th id="voucher_applicationId"></th>
                            </tr>
                            <tr class="text-center">
                                <th>voucher Transaction Id</th>
                                <th id="voucher_transactionId"></th>
                            </tr>
                            <tr class="text-center">
                                <th>voucher Timestamp</th>
                                <th id="voucher_timestamp"></th>
                            </tr> --}}
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

    @if($single_product)
        <!-- Start Breadcrumb Area  -->
        <div class="axil-breadcrumb-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="inner">
                            <ul class="axil-breadcrumb">
                                <li class="axil-breadcrumb-item"><a href="{{ url('/') }}">{{ __('lang.Home') }}</a></li>
                                <li class="separator"></li>
                                <li class="axil-breadcrumb-item active" aria-current="page">{{ __('lang.Products1') }}</li>
                            </ul>
                            <h1 class="title">{{ __('lang.explore-product') }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4">
                        <div class="inner d-flex justify-content-end">
                            <div class="bradcrumb-thumb">
                                <div class="content-img">
                                    <img data-sal-delay="200" data-sal-duration="500" src="{{ Request::root() . '/dashboard/images/' . $single_product->image }}" alt="Image" style="height: 90%; width: 90%">
                                </div>
                                <!-- <br> -->
                                <a style="font-size: 14px;" href="{{ route('product.show' , $single_product->id ) }}">
                                    @if( app()->getLocale() == 'en' )
                                        {{ $single_product->name_en }}
                                    @elseif( app()->getLocale() == 'ar' )
                                        {{ $single_product->name_ar }}
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- End Breadcrumb Area  -->
    @endif
    <!-- Start My Account Area  -->
    <div class="axil-dashboard-area axil-section-gap">
        <div class="container">
            <div class="axil-dashboard-warp">
                <div class="axil-dashboard-author">
                    <div class="media">
                        <div class="thumbnail">
                            @if(Auth::user()->avatar)
                                <img src="{{ Request::root() . '/dashboard/images/' . Auth::user()->avatar }}"
                                     alt="{{ \Illuminate\Support\Facades\Auth::user()->first_name }}"
                                     style="width: 100px; height:100px;object-fit:cover;">
                            @else
                                <img src="{{  asset('web/assets/images/product/author1.png')}}"
                                     alt="{{ \Illuminate\Support\Facades\Auth::user()->first_name }}">
                            @endif
                        </div>
                        <div class="media-body">
                            <h5 class="title mb-0">{{ __('lang.Hello') }} {{ \Illuminate\Support\Facades\Auth::user()->first_name }}</h5>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-4">
                        <aside class="axil-dashboard-aside">
                            <nav class="axil-dashboard-nav">
                                <div class="nav nav-tabs" role="tablist">
                                    <a class="nav-item nav-link active" data-bs-toggle="tab" href="#nav-account"
                                       role="tab" aria-selected="false"><i class="fas fa-user"></i>{{ __('lang.AD') }}
                                    </a>
                                    <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-address" role="tab"
                                       aria-selected="false"><i class="fas fa-home"></i>{{ __('lang.Addresses') }}</a>
                                    <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-orders" role="tab"
                                       aria-selected="false"><i
                                            class="fas fa-shopping-basket"></i>{{ __('lang.Orders') }}</a>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button class="nav-item nav-link">
                                            <i class="fal fa-sign-out"></i>
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </nav>
                        </aside>
                    </div>
                    <div class="col-xl-9 col-md-8">
                        <div class="tab-content">
                            <div class="tab-pane fade" id="nav-orders" role="tabpanel">
                                <div class="axil-dashboard-order">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">{{ __('lang.Order') }}</th>
                                                    {{-- <th scope="col">{{ __('lang.Date') }}</th> --}}
                                                    <th scope="col">{{ __('lang.Status') }}</th>
                                                    <th scope="col">{{ __('lang.payment_method') }}</th>
                                                    <th scope="col">{{ __('lang.Total') }}</th>
                                                    <th scope="col">{{ __('lang.paid') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach( $orders as $order )
                                                <tr>
                                                    <th scope="row">#{{ $order->number }}</th>
                                                    {{-- <td>
                                                        {{ \Carbon\Carbon::parse($order->create_date, 'UTC')->isoFormat('MMMM Do YYYY') }}
                                                    </td> --}}
                                                    <td>
                                                        {{ $order->payment_status }}
                                                    </td>
                                                    <td>
                                                        {{ $order->payment_method }}
                                                    </td>
                                                    @foreach($order->products as $price_c)
                                                        @if($loop->first)
                                                            <td>{{ __('lang.sar').' '.$order->total }}</td>
                                                        @endif
                                                    @endforeach
                                                    <td>
                                                        <a class="btn btn-secondary" href="{{ route('order.show' , ['user_name' => \Illuminate\Support\Facades\Auth::user()->user_name ,'id' => $order->id]) }}">
                                                            {{ __('lang.order_invoice') }}
                                                        </a>
                                                        @if ($order->awbNo)
                                                        <a class="btn btn-success" href="{{ route('account.getTracking' , $order->awbNo) }}">
                                                            {{ __('lang.order_tracking') }}
                                                        </a>
                                                        @endif
                                                        @if ($order->payment_method == 'Emkan' && $order->payment_status == 'pending' && $order->voucher_id != NULL)
                                                        <a class="btn btn-info" id="show_emkan"
                                                        data-voucherCode="{{ $order->voucherCode  ?? ''}}"
                                                        data-customerId="{{ $order->customerId ?? ''}}"
                                                        data-applicationId="{{ $order->applicationId ?? ''}}"
                                                        data-otpID_preRedeem="{{ $order->otpID_preRedeem ?? ''}}"
                                                        data-voucher_id="{{ $order->voucher_id ?? ''}}"
                                                        data-voucher_amount="{{ $order->voucher_amount ?? ''}}"
                                                        data-voucher_currency="{{ $order->voucher_currency ?? ''}}"
                                                        data-voucher_createdAt="{{ $order->voucher_createdAt ?? ''}}"
                                                        data-voucher_expiryDate="{{ $order->voucher_expiryDate ?? ''}}"
                                                        data-voucher_createdAt="{{ $order->voucher_createdAt ?? ''}}"
                                                        data-voucher_status="{{ $order->voucher_status ?? ''}}"
                                                        data-voucher_applicationId="{{ $order->voucher_applicationId ?? ''}}"
                                                        data-voucher_transactionId="{{ $order->voucher_transactionId ?? ''}}"
                                                        data-voucher_timestamp="{{ $order->voucher_timestamp ?? ''}}">
                                                            {{ 'Emkan details' }}
                                                        </a>
                                                        @endif
                                                        @if( $order->payment_status == 'pending' || $order->payment_status == 'failed')
                                                            @if ($order->payment_method == 'Emkan' && $order->payment_status == 'failed')
                                                            <a class="btn btn-primary" href="{{ route('emcan.create', ['id' => $order->id]) }}">
                                                                {{ __('lang.paid') }}
                                                            </a>
                                                            @elseif ($order->payment_method == 'Emkan' && $order->payment_status == 'pending')

                                                            @else
                                                            <a class="btn btn-primary" href="{{ route('tap.create', ['id' => $order->id]) }}">
                                                                {{ __('lang.paid') }}
                                                            </a>
                                                            @endif
                                                        @else
                                                            {{ 'Completed' }}
                                                        @endif

                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-address" role="tabpanel">
                                <div class="axil-dashboard-address">
                                    <div class="row row--30">
                                        <div class="col-lg-12">
                                            <div class="address-info">
                                                <div
                                                    class="addrss-header d-flex align-items-center justify-content-between">
                                                    <h4 class="title mb-0">{{ __('lang.delivery') }}</h4>
                                                    <a class="address-edit" id="address-add">
                                                        <i class="fas fa-plus mx-3"></i>
                                                    </a>
                                                </div>
                                                <div id="account_address">
                                                @include('web.account.address')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="nav-account" role="tabpanel">
                                <div class="col-lg-9">
                                    <div class="axil-dashboard-account">
                                        <form
                                            action="{{ route('account.update', ['id' => \Illuminate\Support\Facades\Auth::user()->id]) }}"
                                            method="POST" class="account-details-form" enctype="multipart/form-data" >
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input type="text" name="first_name" class="form-control"
                                                               value="{{ Auth::user()->first_name}}" placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input type="text" name="last_name" class="form-control"
                                                               value="{{ Auth::user()->last_name}}" placeholder="Last Name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Avatar</label>
                                                        <input type="file" name="avatar" class="form-control"
                                                               value="{{ Auth::user()->avatar }}">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group mb--40">
                                                        <label>Country/ Region</label>
                                                        <select class="select2" name="id_city">
                                                            @foreach( $cities as $city )
                                                                <option value="{{ $city->id }}"
                                                                        @if($city->id == \Illuminate\Support\Facades\Auth::user()->id_city) selected @else @endif>
                                                                    {{ app()->getLocale() == 'en' ? $city->name_en : $city->name_ar }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <h5 class="title">Password Change</h5>
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" name="old_password" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>New Password</label>
                                                        <input type="password" name="new_password" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Confirm New Password</label>
                                                        <input type="password" name="confirm_password"
                                                               class="form-control">
                                                    </div>
                                                    <div class="form-group mb--0">
                                                        <button type="submit" class="axil-btn account-update"
                                                                value="Save Changes">
                                                            Save Changes
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End My Account Area  -->

    <!-- Start Axil Newsletter Area  -->
    <div class="axil-newsletter-area axil-section-gap pt--0" id='subscribe'>
        <div class="container">
            <div class="etrade-newsletter-wrapper bg_image bg_image--5" style="background-image: url({{ asset('web/assets/images/istockphoto.jpg') }})">
                <div class="newsletter-content">
                        <span class="title-highlighter highlighter-primary2">
                            <i class="fas fa-envelope-open"></i>{{ __('lang.Newsletter') }}</span>
                    <h2 class="title mb--40 mb_sm--30">{{ __('lang.Get_weekly_update') }}</h2>
                    <form action="{{ route('subscribe.store') }}" method="POST">
                        @csrf

                        <div class="input-group newsletter-form">
                            <div class="position-relative newsletter-inner mb--15">
                                <input placeholder="example@gmail.com" type="text" name="email"
                                       class="@error('email') is-invalid @enderror">
                            </div>
                            <button type="submit" class="axil-btn mb--15">
                                {{ __('lang.subscribe') }}
                            </button>
                        </div>
                        @error('email')
                        <div class="alert text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
        <!-- End .container -->
    </div>
    <!-- End Axil Newsletter Area  -->
@endsection
@section('js')
    <script src="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>

        var lang = '{{ \Illuminate\Support\Facades\App::getLocale() }}';

        $(document).on('click','#address-add' ,function (e) {
            e.preventDefault();
            $('#addAddress').modal('show');
            $('.submit-address').attr('id' , 'submit-address');
        });

        $(document).on('click','#submit-address' ,function (e) {
            e.preventDefault();
            let formdata = new FormData($('#add_address')[0]);
            document.getElementById("add_address").reset();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{ route("account.add_address") }}',
                data: formdata,
                contentType: false,
                processData: false,
                success: function(response){
                    if( response.error ) {
                        $('#div-error').removeAttr('hidden');
                        $.each(response.error, function(key, value) {
                            console.log(value)
                            $('#error').append(`
                                <li>`+ value +`</li>
                            `);
                        });
                    }else{
                    $('#addAddress').modal('hide');
                    document.getElementById("add_address").reset();
                        $.ajax({
                        url: "{{ route('account.index') }}"
                    }).done(function(data) {
                        $("#account_address").html(data);
                    });
                    }
                },
                error: function(response){
                    $('#div-error').removeAttr('hidden');
                    $.each(response.responseJSON.errors, function(key, value) {
                        $('#error').append(`
                                <li>`+ value +`</li>
                            `);
                    });
                }
            });
        });

        $(document).on('click','#edite_address' ,function (e) {
            e.preventDefault();
            document.getElementById("add_address").reset();
            var id = $(this).data('id');
            $.ajax({
                type: 'get',
                url: '{{ url('account/edite_address') }}/' + id,
                data: '',
                success: function(response){
                    $('.submit-address').attr('id' , 'update-address');
                    $('#country_id').val(response.country_id);
                    $('.selDiv1 option[value="'+response.country_id+'"]').prop('selected', true)
                    $('.selDiv2 option[value="'+response.city_id+'"]').prop('selected', true)
                    $('#id').val(response.id);
                    $('#street').val(response.street);
                    $('#district').val(response.district);
                    $('#note').val(response.note);
                    $('#addAddress').modal('show');

                },
            });
        });

        $(document).on('click','#update-address' ,function (e) {
            e.preventDefault();
            let formdata = new FormData($('#add_address')[0]);
            var id =  $('#id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{ url('account/update_address') }}/' + id,
                data: formdata,
                contentType: false,
                processData: false,
                success: function(response){
                    $('#addAddress').modal('hide');
                    $.ajax({
                        url: "{{ route('account.index') }}"
                    }).done(function(data) {
                        $("#account_address").html(data);
                    });
                },
                error: function(response){
                    $('#div-error').removeAttr('hidden');
                    $.each(response.responseJSON.errors, function(key, value) {
                        $('#error').append(`
                                <li>`+ value +`</li>
                            `);
                    });
                }
            });
        });

        $(document).on('click','#delete_address' ,function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: '{{ url('account/delete_address') }}/' + id,
                data: '',
                success: function (response) {
                    $.ajax({
                        url: "{{ route('account.index') }}"
                    }).done(function(data) {
                        $("#account_address").html(data);
                    });
                }
            });

        });

        $(document).on('click', '#show_emkan', function (e) {
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
    </script>
@endsection

