@extends('layouts.master')

@section('main_title', 'Home Page')
@section('header_title', 'Home')
@section('subheader_title', '#XV2')

@section('content')
    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">{{ __('lang.updateproducts') }}</span>
            </h3>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger" style="margin: 15px">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-body py-3">
            <form action="{{ route('products.update') }}" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $products_s->id }}">

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.namear') }}</label>
                    <input type="text" name="name_ar" class="form-control form-control-solid"
                           value="{{ $products_s->name_ar }}"  required>
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.nameen') }}</label>
                    <input type="text" name="name_en" class="form-control form-control-solid"
                           value="{{ $products_s->name_en }}" required>
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.price') }}</label>
                    <input type="number" name="price" step="0.01" class="form-control form-control-solid"
                           value="{{ $products_s->price }}"  required>
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.discount') }}</label>
                    <input type="number" name="discount" step="0.01" class="form-control form-control-solid"
                           value="{{ $products_s->discount }}">
                </div>

{{--                <div class="mb-10">--}}
{{--                    <label class="form-label">{{ __('lang.tax') }}</label>--}}
{{--                    <input type="number" name="tax" value="{{ $products_s->tax }}"--}}
{{--                           class="form-control form-control-solid" required>--}}
{{--                </div>--}}

                {{--                <div class="mb-10">--}}
                {{--                    <label class="form-label">{{ __('lang.quantity') }}</label>--}}
                {{--                    <input type="number" name="quantity" class="form-control form-control-solid" value="{{ $products_s->quantity }}"  required>--}}
                {{--                </div>--}}

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.cat') }}</label>
                    <select class="mb-10 form-select form-select-solid" aria-label="Select example" name="category_id">
                        @foreach($cat as $key)
                            @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                <option value="{{ $key->id }}"
                                        @if($key->id == $products_s->category_id) selected @else @endif>{{ $key->name_en }}</option>
                            @else
                                <option value="{{ $key->id }}"
                                        @if($key->id == $products_s->category_id) selected @else @endif>{{ $key->name_ar }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-10">
                    <label class="form-label"> {{ __('lang.appear') }} :</label>
                    <select class="mb-10 form-select form-select-solid" aria-label="Select example" name="appear"
                            id="appear_input">
                        <option value="all" @if('all' == $products_s->appear) selected @endif></option>
                        <option value="best_seller"
                                @if('best_seller' == $products_s->appear) selected @endif> {{ __('lang.best_seller') }}</option>
                        <option value="first_home_page"
                                @if('first_home_page' == $products_s->appear) selected @endif> {{ __('lang.first_home_page') }}</option>
                        <option value="most_recent"
                                @if('most_recent' == $products_s->appear) selected @endif> {{ __('lang.most_recent') }}</option>
                        <option value="only_product"
                                @if('only_product' == $products_s->appear) selected @endif> {{ __('lang.only_product') }}</option>
                    </select>
                </div>

{{--                <div class="mb-10">--}}
{{--                    <label class="form-label">{{ __('lang.desar') }}</label>--}}
{{--                    <textarea  name="des_ar" class="form-control form-control-solid"--}}
{{--                                rows="3" required>{{ $products_s->des_ar }}</textarea>--}}
{{--                </div>--}}

{{--                <div class="mb-10">--}}
{{--                    <label class="form-label">{{ __('lang.desen') }}</label>--}}
{{--                    <textarea name="des_en" class="form-control form-control-solid"--}}
{{--                                rows="3" required>{{ $products_s->des_en }}</textarea>--}}
{{--                </div>--}}

                <div id="repeater2">
                    <!-- Repeater Heading -->
                    <div class="repeater-heading">
                        <h5 class="pull-left">{{ __('lang.specifications') }}</h5>
                        <a class="btn btn-primary pt-5 pull-right repeater-add-btn">
                            {{ __('lang.Add') }}
                        </a>
                    </div>
                    <div class="clearfix"></div>
                    <!-- Repeater Items -->
                    <div class="items" data-group="specifications">
                        <!-- Repeater Content -->
                        <div class="item-content row">

                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_title_in_English') }}</label>
                                <input type="text" class="form-control form-control-solid" id="inputName" data-name="title_en" value="" style="height: 45px">
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_title_in_Arabic') }}</label>
                                <input type="text" class="form-control form-control-solid" id="inputName" data-name="title_ar" value="" style="height: 45px">
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_option_in_English') }}</label>
                                <input type="text" class="form-control form-control-solid" id="inputEmail" data-skip-name="fales" data-name="option_en" value="" >
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_option_in_Arabic') }}</label>
                                <input type="text" class="form-control form-control-solid" id="inputEmail" data-skip-name="fales" data-name="option_ar" value="" >
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_option_in_English2') }}</label>
                                <input type="text" class="form-control form-control-solid" id="inputEmail" data-skip-name="fales" data-name="other_option_en" value="" >
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_option_in_Arabic2') }}</label>
                                <input type="text" class="form-control form-control-solid" id="inputEmail" data-skip-name="fales" data-name="other_option_ar" value="" >
                            </div>

                        </div>
                        <!-- Repeater Remove Btn -->
                        <div class="pull-right repeater-remove-btn">
                            <button class="btn btn-danger remove-btn">
                                Remove
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    @foreach($products_s->specifications as $i => $key)
                    <div class="items" data-group="specifications">
                        <!-- Repeater Content -->
                        <div class="item-content row">

                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_title_in_English') }}</label>
                                <input type="text" class="form-control form-control-solid" id="inputName" data-name="title_en" value="{{ $key->title_en }}" style="height: 45px">
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_title_in_Arabic') }}</label>
                                <input type="text" class="form-control form-control-solid" id="inputName" data-name="title_ar" value="{{ $key->title_ar }}" style="height: 45px">
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_option_in_English') }}</label>
                                <input type="text" class="form-control form-control-solid" id="inputEmail" data-skip-name="fales" data-name="option_en" value="{{ $key->option_en }}" >
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_option_in_Arabic') }}</label>
                                <input type="text" class="form-control form-control-solid" id="inputEmail" data-skip-name="fales" data-name="option_ar" value="{{ $key->option_ar }}" >
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_option_in_English2') }}</label>
                                <input type="text" class="form-control form-control-solid" id="inputEmail" data-skip-name="fales" data-name="other_option_en" value="{{ $key->other_option_en }}" >
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_option_in_Arabic2') }}</label>
                                <input type="text" class="form-control form-control-solid" id="inputEmail" data-skip-name="fales" data-name="other_option_ar" value="{{ $key->other_option_ar }}" >
                            </div>

                        </div>
                        <!-- Repeater Remove Btn -->
                        <div class="pull-right repeater-remove-btn">
                            <button class="btn btn-danger remove-btn">
                                Remove
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    @endforeach

                </div>

                <br>

                <br>

                <div id="repeater">
                    <!-- Repeater Heading -->
                    <div class="repeater-heading">
                        <h5 class="pull-left">Colors</h5>
                        <a class="btn btn-primary pt-5 pull-right repeater-add-btn">
                            Add
                        </a>
                    </div>
                    <div class="clearfix"></div>
                    <!-- Repeater Items -->
                    <div class="items" data-group="test">
                        <!-- Repeater Content -->
                        <div class="item-content row">
                            <div class="form-group col-md-6">
                                <label for="inputName" class="col-lg-2 control-label">Color</label>
                                <input type="color" class="form-control form-control-solid" id="inputName"
                                       data-name="colors" style="height: 45px"  value="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail" class="col-lg-2 control-label">Quantity</label>
                                <input type="number" class="form-control form-control-solid" id="inputEmail"
                                       data-name="quantity" value="">
                            </div>
                        </div>
                        <!-- Repeater Remove Btn -->
                        <div class="pull-right repeater-remove-btn">
                            <button class="btn btn-danger remove-btn">
                                Remove
                            </button>
                        </div>

                        <div class="clearfix"></div>

                    </div>
                    @foreach($products_s->colors as $i => $key)
                    <div class="items" data-group="test">
                        <!-- Repeater Content -->
                            <div class="item-content row">
                                <div class="form-group col-md-6">
                                    <label for="inputName" class="col-lg-2 control-label">Color</label>
                                    <input type="color" class="form-control form-control-solid" id="inputName"
                                        data-name="colors" style="height: 45px"  value="{{ $key->color }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail" class="col-lg-2 control-label">Quantity</label>
                                    <input type="number" class="form-control form-control-solid" id="inputEmail"
                                            data-name="quantity" value="{{ $key->quantity }}">
                                </div>
                            </div>
                            <!-- Repeater Remove Btn -->
                            <div class="pull-right repeater-remove-btn">
                                <button class="btn btn-danger remove-btn">
                                    Remove
                                </button>
                            </div>

                        <div class="clearfix"></div>

                    </div>
                    @endforeach
                </div>

                <div class="row ">
                    <div class="form-check form-switch form-check-custom form-check-solid col-3">
                        <input class="form-check-input" type="checkbox" name="status" id="flexSwitchChecked"
                               @if( $products_s->status == '1') checked="checked" @else @endif />
                        <label class="form-check-label" for="flexSwitchChecked">
                            {{ __('lang.status') }}
                        </label>
                    </div>
                    <div class="image-input image-input-empty col-3" data-kt-image-input="true"
                         style="margin: 15px; width: 10%; height: 10%; background-image:  @if( $products_s->image) url({{ Request::root() . '/dashboard/images/' . $products_s->image }});  @else url({{ asset('dashboard/assets/media/avatars/blank.png') }}); @endif">
                        <!--begin::Image preview wrapper-->
                        <div class="image-input-wrapper w-125px h-125px"></div>
                        <!--end::Image preview wrapper-->

                        <!--begin::Edit button-->
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                               data-kt-image-input-action="change"
                               data-bs-toggle="tooltip"
                               data-bs-dismiss="click"
                               title="Change avatar">
                            <i class="bi bi-pencil-fill fs-7"></i>

                            <!--begin::Inputs-->
                            <input type="file" name="image" value="{{ $products_s->image }}"
                                   accept=".png, .jpg, .jpeg"/>
                            <input type="hidden" name="avatar_remove"/>
                            <!--end::Inputs-->
                        </label>
                        <!--end::Edit button-->

                        <!--begin::Cancel button-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                              data-kt-image-input-action="cancel"
                              data-bs-toggle="tooltip"
                              data-bs-dismiss="click"
                              title="Cancel avatar">
         <i class="bi bi-x fs-2"></i>
     </span>
                        <!--end::Cancel button-->

                        <!--begin::Remove button-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                              data-kt-image-input-action="remove"
                              data-bs-toggle="tooltip"
                              data-bs-dismiss="click"
                              title="Remove avatar">
         <i class="bi bi-x fs-2"></i>
     </span>
                        <!--end::Remove button-->
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-end w-md-25" id="save">Save</button>
            </form>
        </div>
    </div>

@endsection
@section('js')
{{--    <script src="{{asset('dashboard/assets/js/repeater.js')}}"></script> --}}
    <script src="{{asset('dashboard/rtl_assets/js/repeater2.js')}}"></script>
    <script>
        $("#repeater").createRepeater({
            showFirstItemToDefault: true,
        });
        $("#repeater2").createRepeater({
            showFirstItemToDefault: true,
        });
    </script>
    <script>
        $(document).ready(function (){
            var index = $('.items').data('index');
            if (index == 0){
                // $('.items').css('display' , 'none');
                $('div').find("[data-index='" + 0 + "']").css('display' , 'none');
            }
        });
    </script>
<script>
    $(document).on('click' , '#save' , function (){
        console.log("dsadasd");
        var index = $('.items').data('index');
        if (index == 0){
            $('div').find("[data-index='" + 0 + "']").remove();
        }
    });
</script>
@endsection
