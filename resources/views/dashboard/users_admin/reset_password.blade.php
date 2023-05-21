@extends('layouts.master')

@section('main_title', 'Home Page')
@section('header_title', 'Home')
@section('subheader_title', '#XV2')

@section('content')
    <!-- row -->
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
                        <span class="card-label fw-bolder fs-3 mb-1">{{ __('lang.titlerestadmin') }}</span>
                    </h3>
                    <i class="bi bi-eye-slash fs-1" id="togglePassword"></i>

                </div>
                <div class="card-body">
                    <form action="{{route('admin.profile.resetPassword')}}" method="post">
                        {{csrf_field()}}
                        <div style="margin: 20px">
                            <div class="row mg-b-20" style="margin: 10px">
                                <div class="parsley-input col-md-6">
                                    <label>{{trans('lang.password_old')}} : <span class="tx-danger">*</span></label>
                                    <input class="form-control form-control-md mg-b-20" id="old_password"
                                           name="old_password" type="password">
                                </div>

                                <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0">
                                    <label>{{trans('lang.new_password')}} : <span class="tx-danger">*</span></label>
                                    <input class="form-control form-control-md mg-b-20" id="new_password"
                                           name="new_password" type="password">
                                </div>
                            </div>
                            <div class="row mg-b-20" style="margin: 10px">
                                <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                    <label>{{trans('lang.confirm_password')}} : <span class="tx-danger">*</span></label>
                                    <input class="form-control form-control-md mg-b-20" id="confirm_password"
                                           name="confirm_password" type="password">
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
@section('js')
    <script>
        const togglePassword = document
            .querySelector('#togglePassword');
        const password = document.querySelector('#old_password');
        togglePassword.addEventListener('click', () => {
            const type = password
                .getAttribute('type') === 'password' ?
                'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('bi-eye');
        });
        const password2 = document.querySelector('#new_password');
        togglePassword.addEventListener('click', () => {
            const type = password2
                .getAttribute('type') === 'password' ?
                'text' : 'password';
            password2.setAttribute('type', type);
            this.classList.toggle('bi-eye');
        });
        const password3 = document.querySelector('#confirm_password');
        togglePassword.addEventListener('click', () => {
            const type = password3
                .getAttribute('type') === 'password' ?
                'text' : 'password';
            password3.setAttribute('type', type);
            this.classList.toggle('bi-eye');
        });
    </script>
@endsection
