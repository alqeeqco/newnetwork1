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
                    <div class="card-header pb-0">
                        <h4>{{trans('lang.global')}}</h4>
                        <hr>
                    </div>
                    <div class="card-body">
                        <form action="{{route('setting.update')}}" method="post" autocomplete="off"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @foreach ($settings as $key => $x)
                                <div class="form-group" style="padding: 20px;">
                                    {{--                                    <label class="form-label">{{ $x['title_'.\Illuminate\Support\Facades\App::getLocale()] }}: </label>--}}

                                    @if (\Illuminate\Support\Facades\App::getLocale() == 'en')
                                        @if($x->key_id == 'tax')
                                            @if(\Illuminate\Support\Facades\Auth::user()->user_type == 'super-admin')
                                                <label class="form-label">{{ $x->title_en }}: </label>
                                            @endif
                                        @else
                                            <label class="form-label">{{ $x->title_en }}: </label>
                                        @endif
                                    @else
                                        @if($x->key_id == 'tax')
                                            @if(\Illuminate\Support\Facades\Auth::user()->user_type == 'super-admin')
                                                <label class="form-label">{{ $x->title_ar }}: </label>
                                            @endif
                                        @else
                                            <label class="form-label">{{ $x->title_ar }}: </label>
                                        @endif

                                    @endif
                                    @if($x->key_id == 'about_ar' || $x->key_id == 'about_en' || $x->key_id == 'conditions_ar' || $x->key_id == 'conditions_en' || $x->key_id == 'privacy_ar' || $x->key_id == 'privacy_en' || $x->key_id == 'faq_ar' || $x->key_id == 'faq_en')
                                        <div class="col-md-10">
                                            <textarea class="form-control tinymce" name="{{ $x->key_id }}" id="about_ar">@if(isset($x->value)) {{$x->value}} @endif</textarea>
                                        </div>
                                    @elseif($x->key_id == 'logo')
                                        <div class="col-md-10">
                                            <input type="file" class="form-control" name="{{ $x->key_id }}" value="@if(isset($x->value)){{$x->value}}@endif">
                                        </div>
                                    @elseif($x->key_id == 'contact-us')
                                        <div class="col-md-10">
                                            <input type="file" class="form-control" name="{{ $x->key_id }}" value="@if(isset($x->value)){{$x->value}}@endif">
                                        </div>
                                    @elseif($x->key_id == 'tax')
                                        @if(\Illuminate\Support\Facades\Auth::user()->user_type == 'super-admin')
                                            <div class="col-md-10">
                                                <input type="number" class="form-control" name="{{ $x->key_id }}" value="@if(isset($x->value)){{$x->value}}@endif">
                                            </div>
                                        @endif
                                    @else
                                        <div class="col-md-10">
                                            <textarea name="{{ $x->key_id }}" class="form-control form-control-solid">@if(isset($x->value)) {{$x->value}} @endif</textarea>
                                        </div>
                                    @endif

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
            <!--/div-->
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('dashboard/assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script>

        tinymce.init({
            selector: ".tinymce", height: "480",
            menubar: false,
            toolbar: ["styleselect fontselect fontsizeselect",
                "undo redo | cut copy paste | bold italic | link image | forecolor backcolor | alignleft aligncenter alignright alignjustify",
                "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code"],
            plugins: "advlist autolink link image lists charmap print preview code"
        });
    </script>
@endsection
