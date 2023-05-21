

<!--begin::Header-->
<div class="card-header border-0 pt-6">
    <!--begin::Title-->
    <h3 class="card-title d-flex align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">
                    {{ __('lang.images') }}
                </span>
        <span class="text-muted fw-bold fs-7">
                    {{ __('lang.sub_title_message', ['count' => $images->count()]) }}
                </span>
    </h3>
    <div class="card-toolbar">

        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
            <a href="{{ route('image.create', ['model' => 'products']) }}" type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="fas fa-plus"></i>
                {{ __('lang.image_create') }}
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
                    {{ __('lang.model') }}
                </th>
                <th>
                    {{ __('lang.image') }}
                </th>

                <th>
                    {{ __('lang.actions') }}
                </th>

            </tr>
            </thead>
            <tbody>
            @foreach( $images as $i => $image )
                <tr class="text-center">
                    <td>
                        {{ $i+=1 }}
                    </td>
                    <td>
                        {{ $image->imageable->getTable() }}
                    </td>
                    <td>
                        <img class="rounded" src="{{ Request::root() . '/dashboard/images/' . $image->image }}" width="50" height="50" alt="avatar">
                    </td>

                    <td>

                        <button class="btn btn-icon btn-light-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $image->id }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>

                {{-- Delete Modal --}}
                <div class="modal fade" tabindex="-1" id="deleteModal-{{ $image->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    {{ __('lang.delete_image_title') }}
                                </h5>

                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="bi bi-x fs-2"></i>
                                </div>
                                <!--end::Close-->
                            </div>

                            <div class="modal-body">
                                <p>
                                    {{ __('lang.delete_image_body') }}
                                </p>
                                <img src="{{ Request::root() . '/dashboard/images/' . $image->image }}" width="50" height="50" alt="">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                    {{ __('lang.close') }}
                                </button>
                                <form action="{{ route('image.delete', ['model' => 'Products', 'id' => $image->id]) }}" data-product="{{ $object->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" id="delete-btn" data-id="{{ $image->id }}" data-product="{{ $object->id }}" class="btn btn-danger">
                                        {{ __('lang.sure') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Create Modal --}}
            <div class="modal fade" tabindex="-1" id="createModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                {{ __('lang.create_image_title') }}
                            </h5>

                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x fs-2"></i>
                            </div>
                            <!--end::Close-->
                        </div>

                        <form action="{{ route('image.store', ['model' => 'Products']) }}" method="POST" id="image-form" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <p>
                                    {{ __('lang.create_image_body') }}
                                </p>
                                <div class="image-input image-input-empty col-3" data-kt-image-input="true"
                                     style="background-image: url({{ asset('dashboard/assets/media/avatars/blank.png') }}); margin: 15px; width: 30%; height: 10%;">
                                    <!--begin::Image preview wrapper-->
                                    <div class="image-input-wrapper w-125px h-125px"></div>
                                    <!--end::Image preview wrapper-->

                                    <!--begin::Edit button-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                           data-kt-image-input-action="change"
                                           data-bs-toggle="tooltip"
                                           data-bs-dismiss="click"
                                           title="Add Image">
                                        <i class="bi bi-pencil-fill fs-7"></i>

                                        <!--begin::Inputs-->
                                        <input type="file" name="image" id="image-input" accept=".png, .jpg, .jpeg"/>
                                        <input type="hidden" name="avatar_remove"/>
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Edit button-->

                                    <!--begin::Cancel button-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                          data-kt-image-input-action="cancel"
                                          data-bs-toggle="tooltip"
                                          data-bs-dismiss="click"
                                          title="Cancel avatar">
                                 <i class="bi bi-x fs-2"></i>
                             </span>
                                    <!--end::Cancel button-->

                                    <!--begin::Remove button-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                          data-kt-image-input-action="remove"
                                          data-bs-toggle="tooltip"
                                          data-bs-dismiss="click"
                                          title="Remove avatar">
                                 <i class="bi bi-x fs-2"></i>
                            </span>
                                    <!--end::Remove button-->
                                </div>

                                <div id="image-error" class="alert text-danger d-none">

                                </div>

                                {{-- Type => Products --}}
                                <input type="hidden" class="form-control" name="imageable_id" value="{{ $object->id }}">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                    {{ __('lang.close') }}
                                </button>

                                <button type="submit" id="form-submit" data-product="{{ $object->id }}" class="btn btn-success">
                                    {{ __('lang.sure') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            </tbody>

        </table>
    </div>
</div>
<!--end::Body-->
