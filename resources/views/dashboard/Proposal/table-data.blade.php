<table class="table table-row-bordered gy-5" id="categories">
    <!--begin::Table head-->
    <thead>
        <tr class="fw-bold fs-6 text-muted text-center">
            <th>{{ __('lang.city') }}</th>
            <th>{{ __('lang.fill_name') }}</th>
            <th>{{ __('lang.phone') }}</th>
            <th>{{ __('lang.email') }}</th>
            <th>{{ __('lang.employer') }}</th>
            <th>{{ __('lang.salary') }}</th>
            <th>{{ __('lang.total_liabilities') }}</th>
            {{-- <th>{{ __('lang.agree_terms') }}</th> --}}
            <th>{{ __('lang.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($proposals as $key)
            <tr class="text-center">
                <td>
                    <div class="d-flex justify-content-start flex-column">
                        <p class="text-dark fw-bolder text-hover-primary fs-6">
                                {{ $key->city }}
                        </p>
                    </div>
                </td>

                <td>
                    <div class="d-flex justify-content-start flex-column">
                        <p class="text-dark fw-bolder text-hover-primary fs-6">
                                {{ $key->fill_name }}
                        </p>
                    </div>
                </td>

                <td>
                    <div class="d-flex justify-content-start flex-column">
                        <p class="text-dark fw-bolder text-hover-primary fs-6">
                                {{ $key->phone }}
                        </p>
                    </div>
                </td>

                <td>
                    <div class="d-flex justify-content-start flex-column">
                        <p class="text-dark fw-bolder text-hover-primary fs-6">
                                {{ $key->email }}
                        </p>
                    </div>
                </td>

                <td>
                    <div class="d-flex justify-content-start flex-column">
                        <p class="text-dark fw-bolder text-hover-primary fs-6">
                                {{ $key->employer }}
                        </p>
                    </div>
                </td>

                <td>
                    <div class="d-flex justify-content-start flex-column">
                        <p class="text-dark fw-bolder text-hover-primary fs-6">
                                {{ $key->salary }}
                        </p>
                    </div>
                </td>

                {{-- <td>
                    <div class="d-flex justify-content-start flex-column">
                        <p class="text-dark fw-bolder text-hover-primary fs-6">
                                {{ $key->job_duration }}
                        </p>
                    </div>
                </td> --}}

                <td>
                    <div class="d-flex justify-content-start flex-column">
                        <p class="text-dark fw-bolder text-hover-primary fs-6">
                                {{ $key->total_liabilities }}
                        </p>
                    </div>
                </td>

                {{-- <td>
                    <div class="d-flex justify-content-start flex-column">
                        <p class="text-dark fw-bolder text-hover-primary fs-6">
                                {{ $key->agree_terms }}
                        </p>
                    </div>
                </td> --}}

                <td>
                    <a class="btn btn-icon btn-light-danger btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_1"
                        id="delete" data-id="{{ $key->id }}">
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                        fill="#000000" fill-rule="nonzero" />
                                    <path
                                        d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                        fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                        </span>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
