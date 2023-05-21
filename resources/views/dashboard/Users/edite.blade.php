@extends('layouts.master')

@section('main_title', 'Home Page')
@section('header_title', 'Home')
@section('subheader_title', '#XV2')

@section('content')
    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">{{ __('lang.updateusers') }}</span>
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
            <form action="{{ route('users.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $users->id }}">

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.user_name') }}</label>
                    <input type="text" name="user_name" class="form-control form-control-solid" value="{{ $users->user_name }}">
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.first_name') }}</label>
                    <input type="text" name="first_name" class="form-control form-control-solid" value="{{ $users->first_name }}">
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.last_name') }}</label>
                    <input type="text" name="last_name" class="form-control form-control-solid" value="{{ $users->last_name }}">
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.email') }}</label>
                    <input type="email" name="email" class="form-control form-control-solid" value="{{ $users->email }}">
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.city') }}</label>
                    <select class="mb-10 form-select form-select-solid" aria-label="Select example" name="id_city">
                        <option></option>
                    @foreach($cities as $key)
                            @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                <option value="{{ $key->id }}" @if($key->id == $users->id_city) selected @else @endif>{{ $key->name_en }}</option>
                            @else
                                <option value="{{ $key->id }}" @if($key->id == $users->id_city) selected @else @endif>{{ $key->name_ar }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="row ">
                    <div class="form-check form-switch form-check-custom form-check-solid col-3">
                        <input class="form-check-input" type="checkbox" name="status" id="flexSwitchChecked"
                               @if( $users->status == '1') checked="checked" @else @endif />
                        <label class="form-check-label" for="flexSwitchChecked">
                            {{ __('lang.status') }}
                        </label>
                    </div>
                    <div class="image-input image-input-empty col-3" data-kt-image-input="true"
                         style="margin: 15px; width: 10%; height: 10%; background-image:  @if( $users->avatar) url({{ Request::root() . '/dashboard/images/' . $users->avatar }});  @else url({{ asset('dashboard/assets/media/avatars/blank.png') }}); @endif">
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
                            <input type="file" name="avatar" value="{{ $users->avatar }}" accept=".png, .jpg, .jpeg"/>
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
