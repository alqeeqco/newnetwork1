@extends('layouts.master')

@section('main_title', 'Home Page')
@section('header_title', 'Home')
@section('subheader_title', '#XV2')

@section('content')
    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">{{ __('lang.sendmail') }}</span>
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
            <form action="{{ route('subscribe.create_mail') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-10">
                    <label class="form-label">{{ __('lang.title') }}</label>
                    <input type="text" name="title" value="{{ old('title' , '') }}"
                           class="form-control form-control-solid">
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.mag') }}</label>
                    <textarea type="text" name="mag" rows="5"
                              class="form-control form-control-solid">{{ old('mag' , '') }}</textarea>
                </div>

                <div class="mb-10">
                    <div class="image-input image-input-empty col-3" data-kt-image-input="true"
                         style="background-image: url({{ asset('dashboard/assets/media/avatars/blank.png') }}); margin: 15px; width: 10%; height: 10%;">
                        <div class="image-input-wrapper w-125px h-125px"></div>
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                               data-kt-image-input-action="change"
                               data-bs-toggle="tooltip"
                               data-bs-dismiss="click"
                               title="Change avatar">
                            <i class="bi bi-pencil-fill fs-7"></i>

                            <!--begin::Inputs-->
                            <input type="file" name="image" accept=".png, .jpg, .jpeg"/>
                            <input type="hidden" name="avatar_remove"/>
                            <!--end::Inputs-->
                        </label>
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                              data-kt-image-input-action="cancel"
                              data-bs-toggle="tooltip"
                              data-bs-dismiss="click"
                              title="Cancel avatar">
             <i class="bi bi-x fs-2"></i>
         </span>
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                              data-kt-image-input-action="remove"
                              data-bs-toggle="tooltip"
                              data-bs-dismiss="click"
                              title="Remove avatar">
             <i class="bi bi-x fs-2"></i>
         </span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary float-end w-md-25">Save</button>
            </form>
        </div>
    </div>

@endsection
