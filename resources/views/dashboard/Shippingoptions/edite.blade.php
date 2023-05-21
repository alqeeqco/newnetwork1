@extends('layouts.master')

@section('main_title', 'Home Page')
@section('header_title', 'Home')
@section('subheader_title', '#XV2')

@section('content')
    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">{{ __('lang.updateshippingoptions') }}</span>
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
            <form action="{{ route('shippingoptions.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $shippingoptions->id }}">
                <div class="mb-10">
                    <label class="form-label">{{ __('lang.namear') }}</label>
                    <input type="text" name="name_ar" class="form-control form-control-solid"  value="{{ $shippingoptions->name_ar }}">
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.nameen') }}</label>
                    <input type="text" name="name_en" class="form-control form-control-solid"  value="{{ $shippingoptions->name_en }}">
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.country') }}</label>
                    <select class="mb-10 form-select form-select-solid" aria-label="Select example" name="id_countries">
                        @foreach($countries as $key)
                            @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                <option value="{{ $key->id }}" @if($key->id == $shippingoptions->id_countries) selected @else @endif>{{ $key->name_en }}</option>
                            @else
                                <option value="{{ $key->id }}" @if($key->id == $shippingoptions->id_countries) selected @else @endif>{{ $key->name_ar }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.price') }}</label>
                    <input type="number" name="price" class="form-control form-control-solid" value="{{ $shippingoptions->price }}">
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.first_kilo') }}</label>
                    <input type="number" name="first_cleo" class="form-control form-control-solid" value="{{ $shippingoptions->first_cleo }}" >
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.Price_kilo_after_first') }}</label>
                    <input type="number" name="Price_kilo_after_first" class="form-control form-control-solid" value="{{ $shippingoptions->Price_kilo_after_first }}">
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.desar') }}</label>
                    <textarea name="des_ar" class="form-control form-control-solid" rows="3"  required>{{ $shippingoptions->des_ar }} </textarea>
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.desen') }}</label>
                    <textarea name="des_en" class="form-control form-control-solid" rows="3" required>{{ $shippingoptions->des_en }} </textarea>
                </div>

                <div class="row ">
                    <div class="form-check form-switch form-check-custom form-check-solid col-3">
                        <input class="form-check-input" type="checkbox" name="status" id="flexSwitchChecked"
                               @if( $shippingoptions->status == '1') checked="checked" @else @endif />
                        <label class="form-check-label" for="flexSwitchChecked">
                            {{ __('lang.status') }}
                        </label>
                    </div>
                    <div class="image-input image-input-empty col-3" data-kt-image-input="true"
                         style="margin: 15px; width: 10%; height: 10%; background-image:  @if( $shippingoptions->image) url({{ Request::root() . '/dashboard/images/' . $shippingoptions->image }});  @else url({{ asset('dashboard/assets/media/avatars/blank.png') }}); @endif">
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
                            <input type="file" name="image" value="{{ $shippingoptions->image }}" accept=".png, .jpg, .jpeg"/>
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
                <button type="submit" class="btn btn-primary float-end w-md-25">Save</button>
            </form>
        </div>
    </div>

@endsection
