@extends('layouts.master')

@section('main_title', __('lang.admin_create'))
@section('header_title', __('lang.admin_create'))
@section('subheader_title', __('lang.create'))

@section('content')
    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">
                    {{ __('lang.admin_create') }}
                </span>
            </h3>
        </div>
{{--        @if ($errors->any())--}}
{{--            <div class="alert alert-danger" style="margin: 15px">--}}
{{--                <ul>--}}
{{--                    @foreach ($errors->all() as $error)--}}
{{--                        <li>{{ $error }}</li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        @endif--}}
        <div class="card-body py-3">
            <form action="{{ route('admin.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="mb-10">
                            <label class="form-label">{{ __('lang.name') }}</label>
                            <input type="text" name="name" class="form-control form-control-solid @error('name') is-invalid @enderror" value="{{ old('name' , '') }}" placeholder="{{ __('lang.name') }}">
                            @error('name')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-10">
                            <label class="form-label">{{ __('lang.email') }}</label>
                            <input type="email" name="email" class="form-control form-control-solid @error('email') is-invalid @enderror" value="{{ old('email' , '') }}" placeholder="{{ __('lang.email') }}">
                            @error('email')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-10">
                            <label class="form-label">{{ __('lang.password') }}</label>
                            <input type="password" name="password" class="form-control form-control-solid @error('password') is-invalid @enderror" placeholder="{{ __('lang.password') }}">
                            @error('password')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <label class="form-label">{{ __('lang.roles') }}</label>
                        <select class="form-select form-select-solid" name="role" aria-label="Select example">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="row">
                    <div class="form-check form-switch form-check-custom form-check-solid col-3">
                        <input class="form-check-input" type="checkbox" name="status" id="flexSwitchChecked" checked="checked"/>
                        <label class="form-check-label" for="flexSwitchChecked">
                            {{ __('lang.status') }}
                        </label>
                    </div>
                    <div class="image-input image-input-empty col-3" data-kt-image-input="true"
                         style="background-image: url({{ asset('dashboard/assets/media/avatars/blank.png') }}); margin: 15px; width: 10%; height: 10%;">
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
                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg"/>
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
