<table id="kt_datatable_example_1" class="table table-row-bordered gy-5">
    <thead>
    <tr class="fw-bold fs-6 text-muted text-center">
        <th>
            #
        </th>
        <th>
            {{ __('lang.payment-option') }}
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
        @foreach( $payment_options as $i => $image )
            <tr class="text-center">
                <td>
                    {{ $i+=1 }}
                </td>
                <td>
                    {{ __('lang.payment-option') }}
                </td>
                <td>
                    <img class="rounded" src="{{ Request::root() . '/dashboard/images/' . $image->image }}" width="50" height="50" alt="avatar">
                </td>

                <td>
                    <button class="btn btn-icon btn-light-danger btn-sm me-1" id="show-modal-delete" data-id="{{ $image->id }}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>
