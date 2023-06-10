@extends('layouts.front_layout')

@section('title', 'Checkout')

@section('content')
<!-- Start Checkout Area  -->
<div class="axil-checkout-area axil-section-gap">
    <!-- Modal -->
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
                        <div class="mb-3">
                            <label class="mb-3">
                                {{ __('lang.country') }}
                            </label>
                            <select class="form-select" name="country_id" aria-label="Default select example">
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
                            <select class="form-select" name="city_id" aria-label="Default select example">
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
                                <input type="text" name="street" class="form-control" value="">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-group">
                                <label>
                                    {{ __('lang.District') }}
                                </label>
                                <input type="text" name="district" class="form-control">
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
                                <textarea type="text" name="note" class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                        <button id="submit-address" type="submit" class="btn btn-primary py-3" style="font-size: 16px;">
                            {{ __('lang.save') }}
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <form action="{{ route('order.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-lg-6">
                    <div class="address-list d-flex flex-wrap">
                        @include('web.order.address-list')
                    </div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addAddress">
                        <i class="fas fa-plus mx-3"></i>
                        <span class="text-capitalize">
                            {{ __('lang.add_address') }}
                        </span>
                    </button>



                    <div class="axil-checkout-billing">

                        <div class="form-group">
                            <label>
                                {{ __('lang.note') }}
                            </label>
                            <textarea id="notes" rows="2" name="note" placeholder="Notes about your order, e.g. speacial notes for delivery."></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="axil-order-summery order-checkout-summery">
                        <h5 class="title mb--20">
                            {{ __('lang.order_summery') }}
                        </h5>
                        <div class="summery-table-wrap">
                            <table class="table summery-table">
                                <thead>
                                    <tr>
                                        <th>{{ __('lang.product') }}</th>
                                        <th>{{ __('lang.subtotal') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $cart->get() as $item )
                                    <tr class="order-product">
                                        <td>
                                            @if(app()->getLocale() == 'en')
                                            {{ $item->product->name_en }}
                                            @else
                                            {{ $item->product->name_ar }}
                                            @endif
                                            <span class="quantity">x{{ $item->quantity }}</span>
                                            <br>
                                            <span>{{ __('lang.Colors') }} : </span>
                                            <div class="color-variant-wrapper" style="display: inline-block;">
                                                <ul class="color-variant">
                                                    <li class="mx-2 color-extra-01">
                                                        <span style="background-color:{{ $item->color }}" class="color"></span>
                                                    </li>
                                                </ul>
                                            </div>
                                            {{-- <br>--}}
                                            {{-- <p>--}}
                                            {{-- <span>{{ __('lang.Colors') }} : </span>--}}
                                            {{-- <span style="background-color:{{ $item->color }}; ">.</span>--}}
                                            {{-- </p>--}}
                                        </td>
                                        <td>
                                            @if($item->product->discount > 0)
                                            {{ __('lang.sar').' '.number_format(($item->product->price * $item->quantity) - (($item->product->price * $item->quantity) * $item->product->discount/100) + (($tax_tax/100) * ($item->product->price * $item->quantity)) , 2)  }}
                                            @else
                                            {{ __('lang.sar').' '.number_format(($item->product->price * $item->quantity) + (($tax_tax/100) * ($item->product->price * $item->quantity)) , 2)  }}
                                            @endif
                                            {{-- {{ $item->quantity * $item->product->price }}--}}
                                            <br>
                                            <span class="text-tax">{{__('lang.tax_pro')}}</span>
                                        </td>
                                    </tr>
                                    @endforeach

                                    {{-- <tr class="order-shipping">--}}
                                    {{-- <td colspan="2">--}}
                                    {{-- <div class="shipping-amount">--}}
                                    {{-- <span class="title">{{ __('lang.shipping') }}</span>--}}
                                    {{-- <span class="amount">0.00{{ ' '.__('lang.sar') }}</span>--}}
                                    {{-- </div>--}}
                                    {{-- <div class="input-group">--}}
                                    {{-- <input type="radio" id="shipping-value-0" data-id="0" value="0" class="shipping_value" name="shipping" checked>--}}
                                    {{-- <label for="shipping-value-0">--}}
                                    {{-- {{ __('lang.free_shipping') }}--}}
                                    {{-- </label>--}}
                                    {{-- </div>--}}
                                    {{-- @foreach($shipping_options as $option)--}}
                                    {{-- <div class="input-group">--}}
                                    {{-- <input type="radio" id="shipping-value-{{ $option->id }}" data-id="{{ $option->id }}" value="{{ $option->price }}" class="shipping_value" name="shipping">--}}
                                    {{-- @if( app()->getLocale() == 'en' )--}}
                                    {{-- <label for="shipping-value-{{ $option->id }}">--}}
                                    {{-- {{ $option->name_en }}--}}
                                    {{-- </label>--}}
                                    {{-- @else--}}
                                    {{-- <label for="shipping-value-{{ $option->id }}">--}}
                                    {{-- {{ $option->name_ar }}--}}
                                    {{-- </label>--}}
                                    {{-- @endif--}}
                                    {{-- </div>--}}
                                    {{-- @endforeach--}}
                                    {{-- </td>--}}
                                    {{-- </tr>--}}
                                    {{-- <tr class="order-tax">--}}
                                    {{-- <td>--}}
                                    {{-- {{ __('lang.state_tax') }}--}}
                                    {{-- </td>--}}
                                    {{-- <td id="tax" data-value="{{ $tax->value }}">--}}
                                    {{-- {{ $tax->value.' %' }}--}}
                                    {{-- </td>--}}
                                    {{-- </tr>--}}
                                    <input type="hidden" id="total_amount" name="total" value="0">
                                    <tr class="order-total">
                                        <td>
                                            {{ __('lang.total') }}
                                            <br>
                                            <span class="text-tax">{{__('lang.tax_pro')}}</span>
                                        </td>
                                        <td class="order-total-amount">
                                            {{ $cart->total() }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="order-payment-method">
                            {{-- <div class="single-payment">
                                <div class="input-group">
                                    <input type="radio" id="radio4" value="emkan" name="payment_method">
                                    <label for="radio4">
                                        {{ __('lang.emkan_payment') }}
                                    </label>
                                </div>
                                <p>
                                    {{ __('lang.emkan_desc') }}
                                </p>
                            </div>
                            <div class="single-payment">
                                <div class="input-group">
                                    <input type="radio" id="radio5" checked value="tap" name="payment_method">
                                    <label for="radio5">
                                        {{ __('lang.tap_payment') }}
                                    </label>
                                </div>
                                <p>
                                    {{ __('lang.tap_desc') }}
                                </p>
                            </div> --}}
                            <div class="d-flex mb-3 mb-md-5 justify-content-between">
                                <div class="img-btn" style="width: 25%; height: 25%;">
                                    <img src="{{ asset('payments_kw.png') }}" alt="not found">
                                </div>
                                <button class="btn-bg-primary btn-content" id="but-tap">
                                    <input hidden type="radio" id="radio5" value="tap" name="payment_method">
                                    {{ __('lang.tap_payment') }}
                                </button>
                            </div>

                            <div class="d-flex mb-3 mb-md-5 justify-content-between">
                                <div class="img-btn" style="width: 20%; height: 20%;">
                                    <img src="{{ asset('AjFnjbps5KvZ1686217173.png') }}" alt="not found">
                                </div>
                                <button class="btn-bg-primary btn-content" id="but-emkan">
                                    <input hidden type="radio" id="radio4" value="emkan" name="payment_method">
                                    {{ __('lang.emkan_payment') }}
                                </button>
                            </div>
                        </div>
                        {{-- <button type="submit" class="axil-btn btn-bg-primary checkout-btn">
                            {{ __('lang.process_to_checkout') }}
                        </button> --}}
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Checkout Area  -->

@endsection

@section('js')
<script>
    $("#but-tap").on("click", function() {
        $("input[value='tap']").attr("checked", true);
    });
    $("#but-emkan").on("click", function() {
        $("input[value='emkan']").attr("checked", true);
    });
    var checkBox = Array.from(document.getElementsByClassName('card-adress'));
    $(document).on("change", "input[type='radio']", function() {
        if ($("input[type='radio']").is(':checked')) {
            checkBox.forEach(el => {
               return  el.classList.remove('checked')
            })
            $(this).parent().addClass("checked")

        }

    });

    $(document).ready(function(e) {
        let shipping_value = 0;
        $(document).on('change', '.shipping_value', function (e) {

            var id = $(this).data('id');
            var shipping_value1 = $('#shipping-value-'+id).val();
            console.log(shipping_value);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ url('cart/update_Shipping') }}',
                type: 'POST',
                data: "",
                success: function (data) {
                    var total = data.total;
                    // var tax = $('#tax').data('value');
                    {{--var val =  parseInt(shipping_value) + {{ $items->total() }} + (parseInt(tax) / 100) * {{ $items->total() }};--}}
                    // console.log('total' + total + ' tax ' + tax + ' shipping_value' + shipping_value1);
                    // total = Math.round(total);
                    total = total;
                    var val = parseInt(shipping_value1) + total;
                    // val = Math.round(val);
                    val = val;
                    $('.order-total-amount').text(val);
                    $('#total_amount').val(val);
                }
            });
        });
        {{--$(document).on('change', '.shipping_value', function(e) {--}}
        {{--    var id = $(this).data('id'),--}}
        {{--        price = $('#shipping-value-'+id).val(),--}}
        {{--        tax = $('#tax').data('value');--}}

        {{--    $('.amount').text(Math.round(price)+"{{ ' ' .__('lang.sar') }}");--}}
        {{--    last_total = parseInt(tax) + parseInt(price) + {{ $cart->total() }}--}}
        {{--    $('.order-total-amount').text(last_total);--}}

        {{--    $('#total_amount').val(last_total);--}}

        {{--});--}}


        {{--last_total = parseInt(tax) + {{ $cart->total() }}--}}
        {{--$('.order-total-amount').text(last_total)--}}

        {{--$('#total_amount').val(last_total);--}}

        // var tax = $('#tax').data('value');
        var total = {{ $cart->total() }};
        {{--var val =  parseInt(shipping_value) + {{ $items->total() }} + (parseInt(tax) / 100) * {{ $items->total() }};--}}

        // total = Math.round(total);
        total = total;
        // tax = ((tax / 100) * total);
        var last_total = parseInt(shipping_value) + total;

        // last_total = Math.round(last_total);
        last_total = last_total;

        $('#total_amount').val(last_total);

        $('.order-total-amount').text(last_total);
    });

    // Add Address
    $(document).on('click','#submit-address' ,function (e) {
        e.preventDefault();
        let formdata = new FormData($('#add_address')[0]);
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
                } else {
                    $('#addAddress').modal('hide');

                    $.ajax({
                        url: "{{ route('order.create') }}",
                    }).done(function (data) {
                        $("#address-list").html(data);
                    });
                    document.location.reload(true);
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
</script>
@endsection
