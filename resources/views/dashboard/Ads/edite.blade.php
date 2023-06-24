@extends('layouts.master')

@section('main_title', 'Home Page')
@section('header_title', 'Home')
@section('subheader_title', '#XV2')

@section('content')
    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">{{ __('lang.updateads') }}</span>
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
            <form action="{{ route('ads.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $Ads->id }}">
                <div class="mb-10">
                    <label class="form-label">{{ __('lang.titlear') }}</label>
                    <input type="text" name="title_ar" class="form-control form-control-solid" value="{{ $Ads->title_ar }}">
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.titleen') }}</label>
                    <input type="text" name="title_en" class="form-control form-control-solid" value="{{ $Ads->title_en }}">
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.url') }}</label>
                    <input type="text" name="url" class="form-control form-control-solid" value="{{ $Ads->url }}">
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.location') }}</label>
                    <select class="mb-10 form-select form-select-solid" aria-label="Select example" name="type">
                        <option value="general" @selected($Ads->type =='general')>{{ __('lang.general') }}</option>
                        <option value="order" @selected($Ads->type == 'order')>{{ __('lang.order_page') }}</option>
                    </select>
                </div>

{{--                <div class="mb-10">--}}
{{--                    <label class="form-label">{{ __('lang.location') }}</label>--}}
{{--                    <select class="mb-10 form-select form-select-solid" aria-label="Select example" name="location">--}}
{{--                        <option value="lastPage">Open this select menu</option>--}}
{{--                    </select>--}}
{{--                </div>--}}

                <div class="row ">
                    <div class="form-check form-switch form-check-custom form-check-solid col-3">
                        <input class="form-check-input" type="checkbox" name="status" id="flexSwitchChecked"
                               @if( $Ads->status == '1') checked="checked" @else @endif />
                        <label class="form-check-label" for="flexSwitchChecked">
                            {{ __('lang.status') }}
                        </label>
                    </div>
                    <div class="image-input image-input-empty col-3" data-kt-image-input="true"
                         style="margin: 15px; width: 10%; height: 10%; background-image:  @if( $Ads->image) url({{ Request::root() . '/dashboard/images/' . $Ads->image }});  @else url({{ asset('dashboard/assets/media/avatars/blank.png') }}); @endif">
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
                            <input type="file" name="image" value="{{ $Ads->image }}" accept=".png, .jpg, .jpeg"/>
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
