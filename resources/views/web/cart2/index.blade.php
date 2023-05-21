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

                    $.ajax({
                        url: "{{ url('/cart') }}",
                        type: "GET",
                    }).done(function (data) {

                        $(".data-render").html(data);
                        let shipping_value = 0;

                        tax = $('#tax').data('value');
                        val = (parseInt(tax) / 100) + parseInt(shipping_value) + parseInt(total);

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

                        tax = $('#tax').data('value');
                        val = (parseInt(tax) / 100)  + parseInt(shipping_value) + parseInt(total);

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


                tax = $('#tax').data('value');
                val = (parseInt(tax) / 100)  + parseInt(shipping_value) + {{ $items->total() }};

                $('.order-total-amount').text(val);
                $('#total_amount').val(val);
            });

            tax = $('#tax').data('value');
            val = (parseInt(tax) / 100)  + parseInt(shipping_value) + +{{ $items->total() }};

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
                    var cart = data.cart;
                    console.log(data);
                    $.ajax({
                        url: "{{ url('/cart') }}",
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
                            var tax = $('#tax').data('value');
                            var value = (parseInt(tax) / 100)  + parseInt(shipping_value) + parseInt(total);
                            console.log(value);
                            if (total == 0) {
                                $('#total_amount').val(0);
                                $('.order-total-amount').text(0);
                            } else {
                                $('#total_amount').val(value);
                                $('.order-total-amount').text(value);
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
                    console.log(cart);
                    $.ajax({
                        url: "{{ url('/cart') }}",
                        type: "GET",
                    }).done(function (data) {
                        $(".data-render").empty().html(data);
                        let shipping_value = 0;
                        var tax = $('#tax').data('value');
                        var value = (parseInt(tax) / 100)  + parseInt(shipping_value) + parseInt(total);
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
    <script>
<<<<<<< Updated upstream
=======
<<<<<<< Updated upstream
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
                    console.log(cart);
                    $.ajax({
                        url: "{{ url('/cart') }}",
                        type: "GET",
                    }).done(function (data) {
                        $(".data-render").empty().html(data);
                        let shipping_value = 0;
                        var tax = $('#tax').data('value');
                        var value = parseInt(tax) + parseInt(shipping_value) + parseInt(total);
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
    <script>
        $('.pro-qty').click(function (e) {
            e.preventDefault();
            var id = $(this).children('span').data('id');
            var qty = $(this).children('#qty_input').val();
            console.log(id, ' , ', qty);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ url('cart/update') }}/' + id,
                type: 'POST',
                data: {
                    quantity: qty,
                },
                success: function (data) {
                    var total = data.total;
                    $(document).ready(function () {
                        $.ajax({
                            url: "{{ url('/cart') }}",
                            success: function (data) {
                                $(".data-render").html(data);
                                let shipping_value = 0;
                                var tax = $('#tax').data('value');
                                var value = (parseInt(tax) / 100)  + parseInt(shipping_value) + parseInt(total);
                                if (total == 0) {
                                    // $('#subtotal').text(0);
                                    $('#total_amount').val(0);
                                    $('.order-total-amount').text(0);
                                } else {
                                    // $('#subtotal').text(value);
                                    $('#total_amount').val(value);
                                    $('.order-total-amount').text(value);
                                }
                            },
                            error: function (data) {

                            }
                        });
                    });


                },
                error: function (data) {

                }
            });
        });

        // function gg() {
        //
        // }
    </script>
@endsection
