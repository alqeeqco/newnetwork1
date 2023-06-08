<table id="kt_datatable_example_1" class="table table-row-bordered gy-5">
    <thead>
        <tr class="fw-bold fs-6 text-muted text-center">
            <th>
                #
            </th>
            <th>
                {{ __('lang.user') }}
            </th>
            <th>
                {{ __('lang.payment_method') }}
            </th>
            <th>
                {{ __('lang.cost') }}
            </th>
            <th>
                {{ __('lang.actions') }}
            </th>
        </tr>
    </thead>
    <tbody>
    @foreach( $orders as $i => $order )
        <tr class="text-center">
            <td>
                {{ $i+=1 }}
            </td>
            <td>
                {{ $order->user->user_name }}
            </td>
            <td>
                <p>{{ $order->payment_method }}</p>
                <hr>
                <button class="btn btn-secondary btn-sm me-1">
                    <div style="color:@if($order->payment_status == 'failed') red; @else blue; @endif">{{ __('lang.'.$order->payment_status.'_o') }}</div>
                </button>

            </td>
            <td>
                {{ str_replace(',', '', number_format( $order->total , 2) )  }}
            </td>
            <td>
                @can('Order-List')
                <button class="btn btn-icon btn-light-info btn-sm me-1" id="show_order" data-id="{{ $order->number }}" data-created="{{ $order->created_at }}"
                        data-payment_method="{{ $order->payment_method }}" data-user_id="{{ $order->user->id }}" data-user_name="{{ $order->user->user_name}}"
                        data-note="{{ $order->note ?? '-' }}" data-total="{{ $order->total }}">
                    <i class="fas fa-eye"></i>
                </button>

                <button class="btn btn-info btn-sm me-1" id="prodects"
                        data-prodects="@foreach($order->products as $products)@if(app()->getLocale() == 'en'){{ $products->name_en.',' }}@else {{ $products->name_ar.',' }} @endif @endforeach" data-price="@foreach($order->products as $products){{ $products->price.',' }}@endforeach" data-color="@foreach($order->products as $products){{ $products->pivot->options .',' }}@endforeach">
                    <i class="las la-clipboard">المنتج</i>
                </button>

                <button class="btn btn-secondary btn-sm me-1" id="address"
                        data-country="@if(app()->getLocale() == 'en'){{ $order->addresses->cities->countries->name_en }}@else {{ $order->addresses->cities->countries->name_ar }} @endif"
                        data-city="@if(app()->getLocale() == 'en'){{ $order->addresses->cities->name_en }}@else {{ $order->addresses->cities->name_ar }} @endif"
                        data-street="{{ $order->addresses->street }}"
                        data-district="{{ $order->addresses->district }}"
                        data-note="{{ $order->addresses->note }}">
                    <i class="fas fa-city"></i>
                </button>

                @if ($order->payment_method == 'Emkan' && $order->payment_status == 'paid')
                <button class="btn btn-success btn-sm me-1" id="emcan"
                data-voucherCode="{{ $order->voucherCode  ?? ''}}"
                data-customerId="{{ $order->customerId ?? ''}}"
                data-applicationId="{{ $order->applicationId ?? ''}}"
                data-otpID_preRedeem="{{ $order->otpID_preRedeem ?? ''}}"
                data-voucher_id="{{ $order->voucher_id ?? ''}}"
                data-voucher_amount="{{ $order->voucher_amount ?? ''}}"
                data-voucher_currency="{{ $order->voucher_currency ?? ''}}"
                data-voucher_createdAt="{{ $order->voucher_createdAt ?? ''}}"
                data-voucher_expiryDate="{{ $order->voucher_expiryDate ?? ''}}"
                data-voucher_createdAt="{{ $order->voucher_createdAt ?? ''}}"
                data-voucher_status="{{ $order->voucher_status ?? ''}}"
                data-voucher_applicationId="{{ $order->voucher_applicationId ?? ''}}"
                data-voucher_transactionId="{{ $order->voucher_transactionId ?? ''}}"
                data-voucher_timestamp="{{ $order->voucher_timestamp ?? ''}}">
                <i class="fab fa-cc-mastercard"></i>
                </button>
                @endif
                @endcan
                @can('Order-Delete')
                <button class="btn btn-icon btn-light-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $order->id }}">
                    <i class="fas fa-trash-alt"></i>
                </button>
                @endcan
            </td>
        </tr>

        {{-- Delete Modal --}}
        <div class="modal fade" tabindex="-1" id="deleteModal-{{ $order->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ __('lang.delete_order_title') }}
                        </h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x fs-2"></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <p>
                            {{ __('lang.delete_Order_body') }}
                        </p>
                        <input class="form-control" value="{{ $order->number }}" disabled>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            {{ __('lang.close') }}
                        </button>
                        </button>
                        <form action="#" method="POST" class="deleteOrder">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger deleteBtn"  data-id="{{ $order->id }}">
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
