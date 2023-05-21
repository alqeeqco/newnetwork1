<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'en' ? 'ltr' : 'rtl' }}" direction="{{ app()->getLocale() == 'en' ? 'ltr' : 'rtl' }}">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .user-card {
            border-bottom: 1px solid rgba(0, 0, 0, .125);
        }

        .invoice {
            border: 1px solid rgba(0, 0, 0, .125);
            font-size: 14px;
        }

        table {
            border-collapse: separate;
            border-spacing: 0 10px;
        }
    </style>
</head>

<body style="font-family: 'Cairo', sans-serif;margin: 0px;height: 100%">
    <div class="invoice container">
        <h1 class="fw-bold text-center text-capitalize py-4">{{ __('lang.invoice') }}</h1>
        <div class="user my-3">
            <h5 class="fw-bold mb-3 mt-4">{{__('lang.user_data')}}</h5>
            <div class="d-flex ">
                <div class="col-6 d-flex user-card py-2">
                    <span class="fw-bold">{{__('lang.user_number')}} :</span>
                    <span class="mx-3">{{ $orders->user_id }}</span>
                </div>
                <div class="col-6 d-flex user-card py-2">
                    <span class="fw-bold">{{__('lang.user_name')}} :</span>
                    <span class="mx-3">{{ $orders->user->user_name }}</span>
                </div>
            </div>
            <div class="d-flex">
                <div class="col-6 d-flex user-card py-2">
                    <span class="fw-bold"> {{__('lang.Email')}} :</span>
                    <span class="mx-3">{{ $orders->user->email }}</span>
                </div>
                <div class="col-6 d-flex user-card py-2">
                    <span class="fw-bold"> {{__('lang.payment_method')}} :</span>
                    <span class="mx-3">{{ $orders->payment_method }}</span>
                </div>
            </div>
              <div class="d-flex">
                 <div class="col-6 d-flex user-card py-2">
                <span class="fw-bold">{{__('lang.payment_status')}} :</span>
                <span class="mx-3">{{ $orders->payment_status }}
                    </span>
                 </div>
                <div class="col-6 d-flex user-card py-2">
                    <span class="fw-bold"> awbNo :</span>
                    <span class="mx-3">{{ $orders->awbNo }}</span>
                </div>
            </div>
           
            <div class="d-flex user-card py-2">
                <span class="fw-bold"> {{__('lang.date_the_order_was_created')}} :</span>
                <span class="mx-3">{{ $orders->created_at }}</span>
            </div>
        </div>
        <div class="product my-3">
            <h5 class="fw-bold mb-3 mt-4"> {{__('lang.products')}}</h5>
            <table class="w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('lang.product_name')}}</th>
                        <th>{{__('lang.price_before')}}</th>
                        <th>{{__('lang.tax')}}</th>
                        <th>{{__('lang.Colors')}}</th>
                        <th>{{__('lang.quantity')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders->products as $products)
                    <tr>
                        <td>{{ $products->id }}</td>
                        @if(app()->getLocale() == 'en')
                        <td>{{ $products->name_en }}</td>
                        @else
                        <td>{{ $products->name_ar }}</td>
                        @endif
                        <td>
                            {{ __('lang.sar') . ' ' . number_format( $products->price , 2) }}
                        </td>
                         <td>
                            {{ __('lang.sar') . ' ' . number_format($products->price + (($tax_tax/100) * $products->price) - $products->price , 2) }}
                        </td>
                        <td><p style="background-color:{{ $products->pivot->options  }}; width: 30px">.</p></td>
{{--                        <td></td>--}}
                        <td>{{ $products->pivot->quantity }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="fw-bold">{{__('lang.total1')}}</td>
                        <td>{{ __('lang.sar') . ' ' . number_format($orders->total , 2) }} <br> <span>{{__('lang.tax_pro')}}</span></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="alert alert-dark" role="alert">
            <p class="mb-0">{{__('lang.Notes')}}</p>
            <p style="padding: 10px;">{{ $orders->note ?? '--' }}</p>
        </div>
        <div class="address my-3">
            <h5 class="fw-bold mb-3 mt-4">{{__('lang.Address_details')}}</h5>
            <div class="d-flex">
                <div class="col-6 d-flex user-card py-2">
                    <span class="fw-bold">{{__('lang.country')}} :</span>
                    @if(app()->getLocale() == 'en')
                    <span class="mx-3">{{ $orders->addresses->cities->countries->name_en }}</span>
                    @else
                    <span class="mx-3">{{ $orders->addresses->cities->countries->name_ar }}</span>
                    @endif
                </div>
                <div class="col-6 d-flex user-card py-2">
                    <span class="fw-bold">{{__('lang.city')}} :</span>
                    @if(app()->getLocale() == 'en')
                    <span class="mx-3">{{ $orders->addresses->cities->name_en }}</span>
                    @else
                    <span class="mx-3">{{ $orders->addresses->cities->name_ar }}</span>
                    @endif
                </div>
            </div>
            <div class="d-flex">
                <div class="col-6 d-flex user-card py-2">
                    <span class="fw-bold"> {{__('lang.street')}} :</span>
                    <span class="mx-3">{{ $orders->addresses->street }}</span>
                </div>
                <div class="col-6 d-flex user-card py-2">
                    <span class="fw-bold"> {{__('lang.District')}} :</span>
                    <span class="mx-3">{{ $orders->addresses->district }}</span>
                </div>
            </div>
        </div>
        <div class="alert alert-dark" role="alert">
            <p class="mb-0">{{__('lang.Address_notes')}}</p>
            <p style="padding: 10px;">{{ $orders->addresses->note ?? '--' }}</p>
        </div>
        <div>
{{--            <p class="fw-bold">{{__('lang.website')}}:{{ ' '.Request::root() . ' '}}</p>--}}
            @if(app()->getLocale() == 'en')
            <p style="padding: 10px; text-align: center"> All rights reserved to New Network</p>
            @else
            <p style="padding: 10px; text-align: center"> جميع الحقوق محفوظة لدى نيو نت ورك</p>
            @endif
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
