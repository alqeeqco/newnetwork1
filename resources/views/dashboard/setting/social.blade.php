@extends('layouts.master')

@section('main_title', 'Home Page')
@section('header_title', 'Home')
@section('subheader_title', '#XV2')

@section('content')
    <div class="main-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif( session('delete') )
            <div class="alert alert-danger ">
                {{ session('delete') }}
            </div>
        @endif

        <!-- row opened -->
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4> {{trans('lang.social')}}</h4>
                    </div>
                    <div class="card-body">
                            <form action="{{route('setting.update')}}" method="post" autocomplete="off"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @foreach ($settings as $key => $x)
                                    <div class="form-group" style="padding: 20px;">
                                        @if (\Illuminate\Support\Facades\App::getLocale() == 'en')
                                            <label class="form-label">{{ $x->title_en }}
                                                : </label>
                                        @else
                                            <label class="form-label">{{ $x->title_ar }}
                                                : </label>
                                        @endif
                                        <div class="col-md-10"> <textarea id="site_title" name=" {{ $x->key_id }}"  class="form-control form-control-solid">@if(isset($x->value)) {{$x->value}} @endif</textarea>
                                        </div>
                                    </div>
                                @endforeach
                                <hr>
                                @can('Settings-Edit')
                                    <button type="submit" class="btn btn-primary float-end w-md-25">
                                        {{trans('lang.edit')}}
                                    </button>
                                @endcan
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
