@foreach($addresses as $address)
    <div class="px-2 col-12 col-md-6">
        <div class="card-adress position-relative" id="card-adress">
            <i class="fas fa-check-circle position-absolute end-0 pe-3"></i>
              <input class="d-none" type="radio" @if($loop->first) @endif id="address-{{ $address->id }}" name="address_id" value="{{ $address->id }}">
              <label class="d-block w-100" for="address-{{ $address->id }}">
                <div class="d-flex mb-3">
                    <span>{{ __('lang.country') }} :</span>
                    <span class="mx-3" style="color: #000;">
                    @if( app()->getLocale() == 'en' )
                            {{ $address->country->name_en }}
                        @else
                            {{ $address->country->name_ar }}
                        @endif
                </span>
                </div>
                <div class="d-flex mb-3">
                    <span>{{ __('lang.city') }} :</span>
                    <span class="mx-3" style="color: #000;">
                    @if( app()->getLocale() == 'en' )
                            {{ $address->cities->name_en }}
                        @else
                            {{ $address->cities->name_ar }}
                        @endif
                </span>
                </div>
                <div class="d-flex mb-3">
                    <span>{{ __('lang.street') }} :</span>
                    <span class="mx-3" style="color: #000;">{{ $address->street }}</span>
                </div>
                <div class="d-flex mb-3">
                    <span>{{ __('lang.District') }} :</span>
                    <span class="mx-3" style="color: #000;">
                   {{ $address->district }}
                </span>
                </div>

            </label>
        </div>
    </div>
@endforeach
