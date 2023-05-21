@extends('layouts.master')

@section('main_title', 'Home Page')
@section('header_title', 'Home')
@section('subheader_title', '#XV2')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>خطا</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">{{ __('lang.titleediteadmin') }}</span>
                    </h3>
                </div>

                <div class="card-body">
                    <form class="parsley-style-1" id="selectForm2" autocomplete="off" name="selectForm2"
                          action="{{route('admin.profile.update')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$admin->id}}">
                        <div style="margin: 20px">
                            <div class="row mg-b-20">

                                <div class="parsley-input col-md-6" id="fnWrapper">
                                    <label>{{trans('lang.users_name')}} : <span class="tx-danger">*</span></label>
                                    <input class="form-control form-control-md mg-b-20"
                                           data-parsley-class-handler="#lnWrapper" value="{{$admin->name}}" name="name"
                                           required="" type="text">
                                </div>

                                <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                    <label>{{trans('lang.email')}} : <span class="tx-danger">*</span></label>
                                    <input class="form-control form-control-md mg-b-20"
                                           data-parsley-class-handler="#lnWrapper" value="{{$admin->email}}"
                                           name="email" required="" type="email">
                                </div>
                            </div>
                        </div>
                        <div class="mg-t-30">
                            <button class="btn btn-primary float-end w-md-25"
                                    type="submit">{{trans('lang.save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
