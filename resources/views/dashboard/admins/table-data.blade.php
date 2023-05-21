<table id="kt_datatable_example_1" class="table table-row-bordered gy-5">
    <thead>
    <tr class="fw-bold fs-6 text-muted text-center">
        <th>
            #
        </th>
        <th>
            {{ __('lang.avatar') }}
        </th>
        <th>
            {{ __('lang.name') }}
        </th>
        <th>
            {{ __('lang.email') }}
        </th>
        <th>
            {{ __('lang.status') }}
        </th>

        <th>
            {{ __('lang.user_type') }}
        </th>

        <th>
            {{ __('lang.actions') }}
        </th>

    </tr>
    </thead>
    <tbody>
    @foreach( $admins as $i => $admin )
        <tr class="text-center">
            <td>
                {{ $i+=1 }}
            </td>
            <td>
                <img class="rounded" src="{{ $admin->image }}" width="50" height="50" alt="avatar">
            </td>
            <td>
                {{ $admin->name }}
            </td>
            <td>
                {{ $admin->email }}
            </td>
            <td>
                @if($admin->status == 1)
                    <button class="btn btn-success" id="status"
                            data-id="{{ $admin->id }}">{{ __('lang.active') }}</button>
                @else
                    <button class="btn btn-danger" id="status"
                            data-id="{{ $admin->id }}">{{ __('lang.notactive') }}</button>
                @endif

            </td>
            <td>
                {{ $admin->user_type }}
            </td>
            <td>
                @can('Admins-Edit')
                <a href="{{ route('admin.edit', ['id' => $admin->id]) }}" class="btn btn-icon btn-light-primary btn-sm me-1">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                @endcan
                @can('Admins-Delete')
                <button class="btn btn-icon btn-light-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $admin->id }}">
                    <i class="fas fa-trash-alt"></i>
                </button>
                @endcan
            </td>
        </tr>

        {{-- Delete Modal --}}
        <div class="modal fade" tabindex="-1" id="deleteModal-{{ $admin->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ __('lang.delete_admin_title') }}
                        </h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x fs-2"></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <p>
                            {{ __('lang.delete_admin_body') }}
                        </p>
                        <input class="form-control" value="{{ $admin->name }}" disabled>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            {{ __('lang.close') }}
                        </button>
                        </button>
                        <form action="{{ route('admin.delete', ['id' => $admin->id]) }}" method="POST">
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
