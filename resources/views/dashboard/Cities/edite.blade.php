@extends('layouts.master')

@section('main_title', 'Home Page')
@section('header_title', 'Home')
@section('subheader_title', '#XV2')

@section('content')
    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">{{ __('lang.updatecat') }}</span>
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
            <form action="{{ route('cities.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $city->id }}">
                <div class="mb-10">
                    <label class="form-label">{{ __('lang.namear') }}</label>
                    <input type="text" name="name_ar" class="form-control form-control-solid" value="{{ $city->name_ar }}">
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.nameen') }}</label>
                    <input type="text" name="name_en" class="form-control form-control-solid" value="{{ $city->name_en }}">
                </div>

                <div class="mb-10">
                    <label class="form-label">{{ __('lang.cat') }}</label>
                    <select class="mb-10 form-select form-select-solid" aria-label="Select example" name="id_country">
                        @foreach($country as $key)
                            @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                <option value="{{ $key->id }}" @if($key->id == $city->id_country) selected @else @endif>{{ $key->name_en }}</option>
                            @else
                                <option value="{{ $key->id }}" @if($key->id == $city->id_country) selected @else @endif>{{ $key->name_ar }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="row ">
                    <div class="form-check form-switch form-check-custom form-check-solid col-3">
                        <input class="form-check-input" type="checkbox" name="status" id="flexSwitchChecked"
                               @if( $city->status == '1') checked="checked" @else @endif />
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
