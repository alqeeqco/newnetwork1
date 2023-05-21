@extends('layouts.master')

@section('main_title', 'Home Page')

@section('header_title', 'Home')

@section('subheader_title', '#XV2')

@section('content')
    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">{{ __('lang.addproducts') }}</span>
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
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-10">
                    <label class="form-label">{{ __('lang.namear') }}</label>
                    <input type="text" name="name_ar" value="{{ old('name_ar' , '') }}"
                           class="form-control form-control-solid" required>
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.nameen') }}</label>
                    <input type="text" name="name_en" value="{{ old('name_en' , '') }}"
                           class="form-control form-control-solid" required>
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.price') }}</label>
                    <input type="number" name="price" value="{{ old('price' , '') }}" step="0.01"
                           class="form-control form-control-solid" required>
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.discount') }}</label>
                    <input type="number" name="discount" value="{{ old('discount' , '') }}" step="0.01"
                           class="form-control form-control-solid">
                </div>

{{--                <div class="mb-10">--}}
{{--                    <label class="form-label">{{ __('lang.tax') }}</label>--}}
{{--                    <input type="number" name="tax" value="{{ old('tax' , '') }}"--}}
{{--                           class="form-control form-control-solid" required>--}}
{{--                </div>--}}

{{--                <div class="mb-10">--}}
{{--                    <label class="form-label">{{ __('lang.quantity') }}</label>--}}
{{--                    <input type="number" name="quantity" value="{{ old('quantity' , '') }}"--}}
{{--                           class="form-control form-control-solid"  required>--}}
{{--                </div>--}}
                <div class="mb-10">
                    <label class="form-label">{{ __('lang.cat') }}</label>
                    <select class="mb-10 form-select form-select-solid" aria-label="Select example" name="category_id">
                        @foreach($cat as $key)
                            @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                <option value="{{ $key->id }}" @selected($key->id == old('category_id' , '') || $key->id == request()->category)>{{ $key->name_en }}</option>
                            @else
                                <option value="{{ $key->id }}" @selected($key->id == old('category_id' , '') || $key->id == request()->category)>{{ $key->name_ar }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-10">
                    <label class="form-label"> {{ __('lang.appear') }} :</label>
                    <select class="mb-10 form-select form-select-solid" aria-label="Select example" name="appear"
                            id="appear_input">
                        <option value="all" @if('all' == old('appear' , '')) selected @endif></option>
                        <option value="best_seller"
                                @if('best_seller' == old('appear' , '')) selected @endif> {{ __('lang.best_seller') }}</option>
                        <option value="first_home_page"
                                @if('first_home_page' == old('appear' , '')) selected @endif> {{ __('lang.first_home_page') }}</option>
                        <option value="most_recent"
                                @if('most_recent' == old('appear' , '')) selected @endif> {{ __('lang.most_recent') }}</option>
                        <option value="only_product"
                                @if('only_product' == old('appear' , '')) selected @endif> {{ __('lang.only_product') }}</option>
                    </select>
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.desar') }}</label>
                    <textarea name="des_ar" class="form-control form-control-solid"
                              rows="3" required>{{ old('des_ar' , '') }} </textarea>
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.desen') }}</label>
                    <textarea name="des_en" class="form-control form-control-solid"
                              rows="3" required> {{ old('des_en' , '') }} </textarea>
                </div>
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
                                    <input type="text" class="form-control form-control-solid" id="inputName" data-name="title_en" style="height: 45px">
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_title_in_Arabic') }}</label>
                                    <input type="text" class="form-control form-control-solid" id="inputName" data-name="title_ar" style="height: 45px">
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_option_in_English') }}</label>
                                    <input type="text" class="form-control form-control-solid" id="inputEmail" data-skip-name="fales" data-name="option_en" >
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_option_in_Arabic') }}</label>
                                    <input type="text" class="form-control form-control-solid" id="inputEmail" data-skip-name="fales" data-name="option_ar" >
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_option_in_English2') }}</label>
                                    <input type="text" class="form-control form-control-solid" id="inputEmail" data-skip-name="fales" data-name="other_option_en" >
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_option_in_Arabic2') }}</label>
                                    <input type="text" class="form-control form-control-solid" id="inputEmail" data-skip-name="fales" data-name="other_option_ar" >
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
                        @foreach(old('specifications' , []) as $index => $specifications)
                            <div class="items" data-group="specifications">
                        <!-- Repeater Content -->
                        <div class="item-content row">
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_title_in_English') }}</label>
                                <input type="text" class="form-control form-control-solid" id="inputName" data-name="title_en" style="height: 45px"
                                       name="specifications[{{ $index }}][title_en]" value="{{ old('specifications.'.$index.'.title_en', $specifications['title_en']) }}">
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_title_in_Arabic') }}</label>
                                <input type="text" class="form-control form-control-solid" id="inputName" data-name="title_ar" style="height: 45px"
                                       name="specifications[{{ $index }}][title_ar]" value="{{ old('specifications.'.$index.'.title_ar', $specifications['title_ar']) }}">
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_option_in_English') }}</label>
                                <input type="text" class="form-control form-control-solid" id="inputEmail" data-skip-name="fales" data-name="option_en"
                                       name="specifications[{{ $index }}][option_en]" value="{{ old('specifications.'.$index.'.option_en', $specifications['option_en']) }}">
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_option_in_Arabic') }}</label>
                                <input type="text" class="form-control form-control-solid" id="inputEmail" data-skip-name="fales" data-name="option_ar"
                                       name="specifications[{{ $index }}][option_ar]" value="{{ old('specifications.'.$index.'.option_ar', $specifications['option_ar']) }}">
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_option_in_English2') }}</label>
                                <input type="text" class="form-control form-control-solid" id="inputEmail" data-skip-name="fales" data-name="other_option_en"
                                       name="specifications[{{ $index }}][other_option_en]" value="{{ old('specifications.'.$index.'.other_option_en', $specifications['other_option_en']) }}">
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="col-lg-12 control-label">{{ __('lang.specific_option_in_Arabic2') }}</label>
                                <input type="text" class="form-control form-control-solid" id="inputEmail" data-skip-name="fales" data-name="other_option_ar"
                                       name="specifications[{{ $index }}][other_option_ar]" value="{{ old('specifications.'.$index.'.other_option_ar', $specifications['other_option_ar']) }}">
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
                                <label for="inputEmail" class="col-lg-2 control-label">Color</label>
                                <input type="color" class="form-control form-control-solid" id="inputName"

                                       data-name="colors" style="height: 45px">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail" class="col-lg-2 control-label">Quantity</label>
                                <input type="number" class="form-control form-control-solid" id="inputEmail"

                                       data-skip-name="fales" data-name="quantity" >
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
                    @foreach(old('test' , []) as $index => $test)
                        <div class="items" data-group="test">
                        <!-- Repeater Content -->
                        <div class="item-content row">

                            <div class="form-group col-md-6">
                                <label for="inputEmail" class="col-lg-2 control-label">Color</label>
                                <input type="color" class="form-control form-control-solid" id="inputName" data-name="colors"
                                       name="test[{{ $index }}][colors]" value="{{ old('test.'.$index.'.colors', $test['colors']) }}" style="height: 45px">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail" class="col-lg-2 control-label">Quantity</label>
                                <input type="number" class="form-control form-control-solid" id="inputEmail" data-skip-name="fales" data-name="quantity"
                                       name="test[{{ $index }}][quantity]" value="{{ old('test.'.$index.'.quantity', $test['quantity']) }}">
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
                               checked="checked"/>
                        <label class="form-check-label" for="flexSwitchChecked">
                            {{ __('lang.status') }}
                        </label>
                    </div>
                    <div class="image-input image-input-empty col-3" data-kt-image-input="true"
                         @if(Cookie::get('images'))
                            style="background-image: url({{ Request::root() . '/dashboard/images/' . Cookie::get('images') }}); margin: 15px; width: 10%; height: 10%;">
                        @else
                            style="background-image: url({{ asset('dashboard/assets/media/avatars/blank.png') }}); margin: 15px; width: 10%; height: 10%;">
                        @endif
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
                            <input type="file" name="image" accept=".png, .jpg, .jpeg" value="{{ Cookie::get('images') }}"/>
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
                <button type="submit" class="btn btn-primary float-end w-md-25"  id="save">Save</button>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('dashboard/assets/js/repeater.js')}}"></script>
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
    <script>
        {{--var fd = {{ old('test') }}--}}
        {{--$.ajax({--}}
        {{--    url: '{{ route('products.store') }}',--}}
        {{--    type: 'POST',--}}
        {{--    data: { title: fd },--}}
        {{--    success: function(response) {--}}
        {{--        console.log(response);--}}
        {{--        // // Update the container element with the new value returned from the Laravel controller--}}
        {{--        // $('#specifications-title-container').html(response);--}}
        {{--    }--}}
        {{--});--}}
    </script>
@endsection
