@extends('layouts.master')

@section('main_title', __('lang.role_create'))
@section('header_title', __('lang.role_create'))
@section('subheader_title', __('lang.create'))

@section('content')
    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">
                    {{ __('lang.role_create') }}
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
            <form action="{{ route('role.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-lg-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="name" required placeholder="الاسم">
                            <label for="name">الاسم</label>
                        </div>
                        @error('name')
                            <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-12">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title mb-0 flex-grow-1">الصلاحيات: </h5>
                        </div>
                        <br>
                        <div class = "row">
                            @foreach($permissions as $value)
                                <div class = "col-sm-3 mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name = "permission[]" value="{{ $value->id }}" id = "{{ $value->id }}">
                                        <label class="form-check-label" for="{{ $value->id }}">
                                            @if( app()->getLocale() == 'en' )
                                                {{ $value->name }}
                                            @else
                                                {{ $value->name_ar }}
                                            @endif
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="hstack gap-2 justify-content-between">
                            <button type="submit" class="btn btn-primary">إنشاء</button>
                            <a class="btn btn-primary" href="{{ url()->previous() }}">عودة</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

