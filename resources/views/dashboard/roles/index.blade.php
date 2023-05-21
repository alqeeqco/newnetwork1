@extends('layouts.master')

@section('css')
    <link href="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('main_title', __('lang.roles'))
@section('header_title', __('lang.roles'))
@section('subheader_title', __('lang.index'))

@section('content')
    <div class="card mb-5 mb-xxl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Title-->
            <h3 class="card-title d-flex align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">
                    {{ __('lang.roles') }}
                </span>
                <span class="text-muted fw-bold fs-7">
                    {{ __('lang.sub_title_message', ['count' => $roles->count()]) }}
                </span>
            </h3>
            <div class="card-toolbar">

                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <a href="{{ route('role.create') }}" type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                        <i class="fas fa-plus"></i>
                        {{ __('lang.role_create') }}
                    </a>
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Title-->

        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body" style="position: relative;">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div id="table-data">
                <table id="kt_datatable_example_1" class="table table-row-bordered gy-5">
                    <thead>
                    <tr class="fw-bold fs-6 text-muted text-center">
                        <th>
                            #
                        </th>
                        <th>
                            {{ __('lang.role_name') }}
                        </th>
                        <th>
                            {{ __('lang.actions') }}
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $roles as $i => $role )
                        <tr class="text-center">
                            <td>
                                {{ $i+=1 }}
                            </td>
                            <td>
                                {{ $role->name }}
                            </td>
                            <td>
                                @can('Roles-Edit')
                                <a href="{{ route('role.edit', ['id' => $role->id]) }}" class="btn btn-icon btn-light-primary btn-sm me-1">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                @endcan
                                @can('Roles-Delete')
                                <button class="btn btn-icon btn-light-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $role->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                @endcan
                            </td>
                        </tr>

                        {{-- Delete Modal --}}

                        <div class="modal fade" tabindex="-1" id="deleteModal-{{ $role->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            {{ __('lang.delete_role') }}
                                        </h5>

                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="bi bi-x fs-2"></i>
                                        </div>
                                        <!--end::Close-->
                                    </div>

                                    <div class="modal-body">
                                        <p>
                                            {{ __('lang.delete_role_body') }}
                                        </p>
                                        <input class="form-control" value="{{ $role->name }}" disabled>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                            {{ __('lang.close') }}
                                        </button>
                                        </button>
                                        <form action="{{ route('role.delete', ['id' => $role->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">
                                                {{ __('lang.sure') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                    </tbody>

                </table>

            </div>
        </div>
        <!--end::Body-->
    </div>
@endsection

@section('js')
    <script src="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
{{--    <script>--}}
{{--        var tabel = $("#kt_datatable_example_1").DataTable();--}}
{{--        $('#re').click(function (){--}}
{{--            $(".table-data").html(data);--}}
{{--        });--}}

{{--        $(document).on('click', '#status', function (e) {--}}
{{--            e.preventDefault();--}}
{{--            var id = $(this).data('id');--}}
{{--            $.ajaxSetup({--}}
{{--                headers: {--}}
{{--                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                }--}}
{{--            });--}}
{{--            $.ajax({--}}
{{--                type: 'post',--}}
{{--                url: '{{ url('/admin/status') }}/' + id,--}}
{{--                data: '',--}}
{{--                success: function (response) {--}}
{{--                    $.ajax({--}}
{{--                        url: "{{ route('admin.index') }}"--}}
{{--                    }).done(function (data) {--}}
{{--                        $("#table-data").html(data);--}}
{{--                    });--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}

@endsection
