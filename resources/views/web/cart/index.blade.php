@extends('layouts.front_layout')

@section('title', __('lang.cart'))

@section('content')
    <!-- Start Cart Area  -->
    <div class="axil-product-cart-area axil-section-gap">
        <div class="container">
            <div class="axil-product-cart-wrap">

                <div class="data-render">

                    @include('web.cart.table-data')
                </div>
            </div>
        </div>
    </div>

    <!-- End Cart Area  -->
@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#input_cancel_coupon').attr('disabled', 'disabled');
        $(document).on('click', '.remove-wishlist', function (e) {
            e.preventDefault();

            var id = $(this).data('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('cart') }}/" + id,
                type: "DELETE",
                data: {},
                success: function (data) {
                    var total = data.total;
                    var count = data.count;
                    console.log(total);
                    $.ajax({
                        url: "{{ url(app()->getLocale().'/cart') }}",
                        type: "GET",
                    }).done(function (data) {

                        $(".data-render").html(data);
                        let shipping_value = 0;

                        // var tax = $('#tax').data('value');
                        // var val =  parseInt(shipping_value) + parseInt(total) + (parseInt(tax) / 100) * parseInt(total);

                        // total = Math.round(total);
                        total = total;
                        var val = parseInt(shipping_value) + total;
                        // val = Math.round(val);
                        val = val;

                        // var val = (parseInt(tax) / 100) + parseInt(shipping_value) + parseInt(total);

                        if (total == 0) {
                            $('.cart-update-btn-area, .orderDetails').addClass('d-none');
                        } else {
                            $('#total_amount').val(val);
                            $('.order-total-amount').text(val);
                        }

                        $('.cart-count').text(count)
                    });

                },
                error: function (data) {
                    console.log(data);
                },
            })

        });
        $(document).on('click', '.cart-clear', function (e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('cart.empty') }}",
                type: "POST",
                data: {},
                success: function (data) {
                    var total = data.total;
                    $.ajax({
                        url: "{{ url('/cart') }}",
                        type: "GET",
                    }).done(function (data) {
                        $(".data-render").html(data);
                        let shipping_value = 0;

                        var tax = $('#tax').data('value');

                        // var val =  parseInt(shipping_value) + parseInt(total) + (parseInt(tax) / 100) * parseInt(total);

                        // total = Math.round(total);
                        total = total;
                        var val = parseInt(shipping_value) + total + ((tax / 100) * total);
                        val = val;
                        // var val = (parseInt(tax) / 100) + parseInt(shipping_value) + parseInt(total);

                        if (total == 0) {
                            $('.cart-update-btn-area, .orderDetails').addClass('d-none');
                        } else {
                            $('#total_amount').val(val);
                            $('.order-total-amount').text(val);
                        }

                        $('.cart-count').text(total)

                    });

                },
                error: function (data) {
                    console.log(data);
                },
            })

        });
        // Get Total
        $(document).ready(function (e) {
            let shipping_value = 0;

            // After Shipping Change
            $(document).on('change', '.shipping_value', function (e) {

                var id = $(this).data('id');
                shipping_value = $('#shipping_value-' + id).val();
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

                        // total = Math.round(total);
                        total = total;
                        var val = parseInt(shipping_value) + total;
                        // val = Math.round(val);
                        val = val;
                        $('.order-total-amount').text(val);
                        $('#total_amount').val(val);
                    }
                });
            });

            // var tax = $('#tax').data('value');
            var total = {{ $items->total() }};
            {{--var val =  parseInt(shipping_value) + {{ $items->total() }} + (parseInt(tax) / 100) * {{ $items->total() }};--}}
            console.log(total);
            // total = Math.round(total);
            total = total;
            var val = parseInt(shipping_value) + total;
            // val = Math.round(val);
            val = val;
            $('#total_amount').val(val);

            $('.order-total-amount').text(val);
        });
    </script>
    <script>
        $(document).on('click', '.couponBtn', function (e) {
            e.preventDefault();
            var coupon = $('#coupon').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: $('#coupon_form').attr('action'),
                type: 'POST',
                data: {
                    coupon: coupon,
                },
                success: function (data) {
                    var total = data.total;
                    var total_ca = data.total_ca;
                    var cart = data.cart;
                    $.ajax({
                        url: "{{ url(app()->getLocale().'/cart') }}",
                        type: "GET",
                    }).done(function (data) {
                        if (cart == 'coupon_end') {
                            Swal.fire({
                                position: 'top-end',
                                title: '{{ __('lang.coupon_end') }}',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else if (cart == 'cart_range') {
                            Swal.fire({
                                position: 'top-end',
                                title: '{{ __('lang.not_range') }}',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else if (cart == 'coupon_empty') {
                            $('#coupon').val('');
                            Swal.fire({
                                position: 'top-end',
                                title: '{{ __('lang.Code_not_found') }}',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            $('#coupon').val('');
                            Swal.fire({
                                position: 'top-end',
                                title: '{{ __('lang.Discount_done') }}',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $(".data-render").empty().html(data);
                            let shipping_value = 0;
                            // var tax = $('#tax').data('value');
                            // console.log(total + "t" + discount + "d" + tax);

                            // var value =  (parseInt(shipping_value) + parseInt(total));
                            // value = value - (value * (parseInt(discount) / 100));
                            // value = value + (parseInt(tax) / 100) * value;
                            // total = Math.round(total);
                            total = total;
                            var value = parseInt(shipping_value) + total;
                            value = value;
                            // value = Math.round(value);
                            // var value = (parseInt(tax) / 100) + parseInt(shipping_value) + parseInt(total);
                            if (total == 0) {
                                $('#total_amount').val(0);
                                $('.order-total-amount').text(0);
                                $('#coupons_des').text(0);
                            } else {
                                $('#total_amount').val(value);
                                $('.order-total-amount').text(value);
                                // $('#coupons_des').text(Math.round(total_ca));
                                $('#coupons_des').text(total_ca.toFixed(2));
                            }
                        }
                    });

                },
                error: function (data) {

                }
            })
        });
    </script>
    <script>
        $(document).on('click', '#coupon_cancel', function (e) {
            e.preventDefault();
            var coupon = $('#coupon').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('cart.coupon') }}',
                type: 'POST',
                data: {
                    coupon: coupon,
                },

                success: function (data) {
                    var total = data.total;
                    var cart = data.cart;
                    $.ajax({
                        url: "{{ url(app()->getLocale().'/cart') }}",
                    }).done(function (data) {
                        $(".data-render").empty().html(data);
                        let shipping_value = 0;
                        // var tax = $('#tax').data('value');
                        // var value =  parseInt(shipping_value) + parseInt(total) + ((parseInt(tax) / 100) * parseInt(total));

                        // total = Math.round(total);
                        total = total;
                        var value = parseInt(shipping_value) + total;
                        // value = Math.round(value);
                        value = value;

                        // var value = (parseInt(tax) / 100) + parseInt(shipping_value) + parseInt(total);
                        if (total == 0) {
                            // $('#subtotal').text(0);
                            $('#total_amount').val(0);
                            $('.order-total-amount').text(0);
                        } else {
                            // $('#subtotal').text(value);
                            $('#total_amount').val(value);
                            $('.order-total-amount').text(value);
                        }
                        if (cart == 'emptyCoupon') {
                            Swal.fire({
                                position: 'top-end',
                                title: '{{ __('lang.emptyCoupon') }}',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    });

                },
                error: function (data) {

                }
            })
        });
    </script>
    // error
    <script>
        $(document).on('click', '.qtybtn', function () {
            // $(".qtybtn").on("click", function () {
                var $button = $(this);
                var oldValue = $button.parent().find("input").val();
                if ($button.hasClass("inc")) {
                    var newVal = parseFloat(oldValue) + 1;
                    var type = '+';
                } else {
                    // Don't allow decrementing below zero
                    if (oldValue > 0) {
                        var newVal = parseFloat(oldValue) - 1;
                        var type = '-';
                    } else {
                        newVal = 0;
                        var type = '-';
                    }
                }
                $button.parent().find("input").val(newVal);
                console.log(newVal);
                var id = $(this).data('id');
                var qty = newVal;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ url("cart/update") }}/' + id,
                    type: 'POST',
                    data: {
                        quantity: qty,
                        type: type,
                    },
                    success: function (data) {
                        var total = data.total;
                        if(data.status == 404){
                            Swal.fire({
                                position: 'top-end',
                                title: '{{ __('lang.quantity_end') }}',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            $button.parent().find("input").val(data.quantity);
                        }else if(data.status == 1000){
                            Swal.fire({
                                position: 'top-end',
                                title: '{{ __('lang.cannot_order_one') }}',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            $button.parent().find("input").val(1);
                        }
                        else {
                            var data_render = $.ajax({
                                url: "{{ url(app()->getLocale().'/cart') }}",
                                type: "GET",
                            }).done(function (data) {
                                $(".data-render").html(data);
                                let shipping_value = 0;
                                // var tax = $('#tax').data('value');

                                // var value = parseInt(shipping_value) + parseInt(total) + (parseInt(tax) / 100) * parseInt(total);
                                // total = Math.round(total);
                                total = total;
                                var value = parseInt(shipping_value) + total;
                                // value = Math.round(value);
                                value = value;
                                // var value = (parseInt(tax) / 100) + parseInt(shipping_value) + parseInt(total);
                                if (total == 0) {
                                    // $('#subtotal').text(0);
                                    $('#total_amount').val(0);
                                    $('.order-total-amount').text(0);
                                } else {
                                    // $('#subtotal').text(value);
                                    $('#total_amount').val(value);
                                    $('.order-total-amount').text(value);
                                }
                            });
                        }

                    },
                    error: function (data) {

                    },
                    // complete: function (data){
                    //     location.reload();
                    // }
                });
            });
    </script>
@endsection
