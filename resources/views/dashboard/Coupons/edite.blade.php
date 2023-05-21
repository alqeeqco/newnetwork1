@extends('layouts.master')

@section('main_title', 'Home Page')
@section('header_title', 'Home')
@section('subheader_title', '#XV2')

@section('content')
    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">{{ __('lang.updatecoupons') }}</span>
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
            <form action="{{ route('coupons.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $coupons->id }}">
                <div class="mb-10">
                    <label class="form-label">{{ __('lang.code') }}</label>
                    <input type="text" name="code" class="form-control form-control-solid" value="{{ $coupons->code }}">
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.discount') }}</label>
                    <input type="number" name="discount" class="form-control form-control-solid" value="{{ $coupons->discount }}">
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.minimum') }}</label>
                    <input type="number" name="minimum" class="form-control form-control-solid" value="{{ $coupons->minimum }}">
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.maximum') }}</label>
                    <input type="number" name="maximum" class="form-control form-control-solid" value="{{ $coupons->maximum }}">
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.endat') }}</label>
                    <input type="datetime-local" name="end_at"
                           min="{{ \Illuminate\Support\Carbon::now()->format('Y-m-d\TH:i') }}"
                           max="{{ \Illuminate\Support\Carbon::now()->addYears(2)->format('Y-m-d\TH:i') }}"
                           value="{{ $coupons->end_at }}"
                           class="form-control form-control-solid">
                </div>

                <div class="row ">
                    <div class="form-check form-switch form-check-custom form-check-solid col-3">
                        <input class="form-check-input" type="checkbox" name="status" id="flexSwitchChecked" checked="checked"/>
                        <label class="form-check-label" for="flexSwitchChecked">
                            {{ __('lang.status') }}
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary float-end w-md-25">Save</button>
            </form>
        </div>
    </div>

@endsection
