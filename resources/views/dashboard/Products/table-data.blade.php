<table class="table table-row-bordered gy-5" id="products">
    <!--begin::Table head-->
    <thead>
    <tr class="fw-bold fs-6 text-muted text-center">
        <th>#</th>
        <th>{{ __('lang.name') }}</th>
        <th>{{ __('lang.image') }}</th>
        <th>{{ __('lang.cat') }}</th>
        <th>{{ __('lang.price_before') }}</th>
        <th>{{ __('lang.price_after') }}</th>
{{--        <th>{{ __('lang.tax') }}</th>--}}
        <th>{{ __('lang.quantity') }}</th>
{{--        <th>{{ __('lang.discount') }}</th>--}}
        <th>{{ __('lang.status') }}</th>
        <th>{{ __('lang.actions') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($Products_s as $i =>  $key)
        <tr class="text-center">
            <td>
                <div class="d-flex justify-content-start flex-column">
                    <p class="text-dark fw-bolder text-hover-primary fs-6">
                        {{ $i+=1 }}
                    </p>
                </div>
            </td>
            <td style="width: 250px;">
                <div class="d-flex justify-content-start flex-column">
                    <p class="text-dark fw-bolder text-hover-primary fs-6">
                        @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                            {{--                            {{ mb_substr($key->name_en , 0 , 10 , 'utf-8').' ...' }}--}}
                            {{ $key->name_en }}
                        @else
                            {{--                            {{ mb_substr($key->name_ar , 0 , 10 , 'utf-8').' ...' }}--}}
                            {{ $key->name_ar }}
                        @endif
                    </p>
                </div>
            </td>
            <td>
                <div class="symbol symbol-45px me-5">
                    <img src="{{ Request::root() . '/dashboard/images/' . $key->image }}"
                         alt="@if(\Illuminate\Support\Facades\App::getLocale() == 'en') {{ $key->name_ar }} @else {{ $key->name_en }} @endif"/>
                </div>

            </td>
            <td>
                <div class="d-flex justify-content-start flex-column">
                    <p class="text-dark fw-bolder text-hover-primary fs-6">
                        @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                            {{ $key->categories->name_en }}
                        @else
                            {{ $key->categories->name_ar }}
                        @endif
                    </p>
                </div>
            </td>
            <td>
                <div class="d-flex justify-content-start flex-column">
                    <p class="text-dark fw-bolder text-hover-primary fs-6">
                        {{ str_replace(',', '', number_format($key->price, 2)) }}
                    </p>
                </div>
            </td>
            <td>
                <div class="d-flex justify-content-start flex-column">
                    <p class="text-dark fw-bolder text-hover-primary fs-6">
                       {{ str_replace(',', '', number_format( $key->price  + (($tax_tax/100) * $key->price) , 2)) }}
                    </p>
                </div>
            </td>
{{--            <td>--}}
{{--                <div class="d-flex justify-content-start flex-column">--}}
{{--                    <p class="text-dark fw-bolder text-hover-primary fs-6">--}}
{{--                        {{ $key->tax.' %' }}--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </td>--}}
            <td>
                <div class="d-flex justify-content-start flex-column">
                    <p class="text-dark fw-bolder text-hover-primary fs-6">
                        {{ $key->quantity }}
                    </p>
                </div>
            </td>
{{--            <td>--}}
{{--                <div class="d-flex justify-content-start flex-column">--}}
{{--                    <p class="text-dark fw-bolder text-hover-primary fs-6">--}}
{{--                        {{ $key->discount ?? 0.00 }}--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </td>--}}
            <td>
                @if($key->status == '1')
                    <button class="btn btn-success" id="status"
                            data-id="{{ $key->id }}">{{ __('lang.active') }}</button>
                @else
                    <button class="btn btn-danger" id="status"
                            data-id="{{ $key->id }}">{{ __('lang.notactive') }}</button>
                @endif
            </td>
            <td>
                {{--<<<<<<< HEAD--}}
                {{--                <a href="{{ url('admin/products/edit') }}/{{ $key->id }}"--}}
                {{--                   class="btn btn-icon  btn-light-warning btn-active-color-primary btn-sm me-1">--}}
                {{--=======--}}
                @can('Product-Edit')
                <button id="appear_but" class="btn btn-icon  btn-light-info btn-sm me-1" data-appear="{{ $key->appear }}" data-id="{{ $key->id }}">
                    <i class="fa fa-bars"></i>
                </button>
                <a href="{{ url(\Illuminate\Support\Facades\App::getLocale().'/admin/products/edit') }}/{{ $key->id }}"
                   class="btn btn-icon  btn-light-warning btn-sm me-1">

                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="24px" height="24px"
                                             viewBox="0 0 24 24" version="1.1">
                                            <path
                                                d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"/>
                                            <path
                                                d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                opacity="0.3"/>
                                        </svg>
                                    </span>
                </a>
                @endcan
                @can('Product-Delete')
                <a class="btn btn-icon btn-light-danger btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_1"
                   id="delete" data-id="{{ $key->id }}">
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                             width="24px" height="24px"
                                             viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1"
                                           fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24"
                                                  height="24"/>
                                            <path
                                                d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                fill="#000000" fill-rule="nonzero"/>
                                            <path
                                                d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                fill="#000000" opacity="0.3"/>
                                        </g>
                                    </svg>
                                    </span>
                </a>
                @endcan
                @can('Product-Create')
                <a href="{{ route('image.index', ['model' => 'products', 'id' => $key->id]) }}"
                   class="btn btn-icon btn-light-success btn-sm"
                   data-id="{{ $key->id }}">
                    <span class="svg-icon svg-icon-3">
                        <i class="fas fa-images"></i>
                    </span>
                </a>
                @endcan
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
