@extends('layouts.front_layout')

@section('title', 'Favorite')



@section('content')
    <!-- Start Wishlist Area  -->
    <div class="axil-wishlist-area axil-section-gap">
        <div class="container">
            <div class="product-table-heading">
                <h4 class="title">{{ __('lang.wish') }}</h4>
            </div>
            <div class="table-responsive">
                @include('web.favorite.table-data')
            </div>
        </div>
    </div>
    <!-- End Wishlist Area  -->
    <!-- Start Why Choose Area  -->
    <div class="axil-why-choose-area pb--50 pb_sm--30" id='why-us'>
        <div class="container">
            <div class="section-title-wrapper section-title-center">
                <span class="title-highlighter highlighter-secondary"><i class="fal fa-thumbs-up"></i>{{ __('lang.why-us') }}</span>
                <h2 class="title">{{ __('lang.why-us-p') }}</h2>
            </div>
            <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 row--20">
                @foreach($Why_People_Choose_Us as $key2)
                    <div class="col">
                        <div class="service-box">
                            <div class="icon">
                                <img src="{{ Request::root() . '/dashboard/images/' . $key2->image }}" alt="Service">
                            </div>
                            <h6 class="title">
                                @if( app()->getLocale() == 'en' )
                                    {{ $key2->title_en }}
                                @elseif( app()->getLocale() == 'ar' )
                                    {{ $key2->title_ar }}
                                @endif
                            </h6>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Why Choose Area  -->

@endsection

@section('js')
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('dashboard/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->

    <script>
        $(document).on('click', '.remove-wishlist', function(e) {
            e.preventDefault();

            var id = $(this).data('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('favorite/delete') }}",
                type: 'DELETE',
                data: {
                    id: id
                },
                success: function(data) {
                    $.ajax({
                        url: "{{ route('favorite.index') }}",
                    }).done(function (data) {
                        $(".table-responsive").html(data);
                    });
                },
                error: function(data){

                }
            })
        });

        $(document).on('click', '.add-product', function (e) {
            var id = $(this).data('id');

            var quantity = 1;

            $('#in_quantity_'+id).attr('value', quantity);

            // var x = $('#color-'+id).data('color');
            // console.log(x);
        });

        $('.color').change(function(e) {
            var id = $(this).data('id');
            color = $(this).data('color');
            $('#colorForm'+id).val(color);
        });

    </script>
@endsection

