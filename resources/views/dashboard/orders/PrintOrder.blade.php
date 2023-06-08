{{-- <!DOCTYPE html>
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
                    @foreach ($orders->products as $products)
                    <tr>
                        <td>{{ $products->id }}</td>
                        @if (app()->getLocale() == 'en')
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
                    @if (app()->getLocale() == 'en')
                    <span class="mx-3">{{ $orders->addresses->cities->countries->name_en }}</span>
                    @else
                    <span class="mx-3">{{ $orders->addresses->cities->countries->name_ar }}</span>
                    @endif
                </div>
                <div class="col-6 d-flex user-card py-2">
                    <span class="fw-bold">{{__('lang.city')}} :</span>
                    @if (app()->getLocale() == 'en')
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
            @if (app()->getLocale() == 'en')
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

</html> --}}

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'en' ? 'ltr' : 'rtl' }}"
    direction="{{ app()->getLocale() == 'en' ? 'ltr' : 'rtl' }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Cairo', sans-serif;
        }

        main {
            width: 991px;
            border: 1px solid #ddd;
            margin: auto;
            color: gray;
        }

        .container-img {
            height: 120px;
            width: 120px;
        }

        .container-img img {
            object-fit: contain;
            width: 100%;
            height: 100%;
        }

        tr,
        td,
        th {
            border: 1px solid #ddd;
            font-weight: 600;
        }

        th {
            background: #c9c9c9;
            color: #4f4f4f;
        }

        td {
            color: #000;
        }

        .max-width-900 {
            min-width: 880px;
        }

        .max-width-700 {
            min-width: 700px;
        }

        .overflow-y {
            overflow-y: auto;
        }

        .max-width-900 tr:nth-child(odd) {
            background-color: #f7f7f7;
        }

        .mt-7 {
            margin-top: 7rem;
            margin-bottom: 4rem;
        }

        .borderTB {
            border-top: 2px solid;
            border-bottom: 2px solid;
        }

        @media screen and (max-width: 991.98px) {
            .mt-7 {
                margin-top: 5rem;
                margin-bottom: 3rem;
            }

            main {
                width: 90%;
            }
        }

        @media screen and (max-width: 576.98px) {
            .container-img {
                margin: auto !important;
            }

            h4 {
                font-size: 18px;
            }

            h2 {
                font-size: 22px;
            }

            .mt-7 {
                margin-top: 3rem;
                margin-bottom: 2rem;
            }

            .info {
                width: 100%;
            }

            th,
            span,
            p,
            bdo {
                font-size: 14px;
            }

            td {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <main>
        <article class="pt-4 pt-md-5 px-3">
            <h4 class="text-center">فاتورة <h4>
                    <h2 class="fw-bold text-center text-capitalize">Invoice</h2>
        </article>
        <hr>
        <p class="text-center fw-bold">شركة الشبكة الجديدة</p>
        <hr>
        <div class="d-flex px-3 px-md-5 flex-wrap">
            <div class="container-img ms-3">
                {!! QrCode::size(100)->generate(url('/ar/admin/orders/print/'. $orders->number)) !!}
            </div>
            <div class="col-12 col-md mb-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <p class="col-12 col-md-4">رقم الفاتورة</p>
                    <p>{{ $orders->number }}</p>
                    <p class="fw-bold text-capitalize">invoice number</p>
                </div>
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <p class="col-12 col-md-4">تاريخ اصدار الفاتورة</p>
                    <p>{{ $orders->created_at }}</p>
                    <p class="fw-bold text-capitalize">invoice issue date</p>
                </div>
                {{-- <div class="d-flex justify-content-between align-items-center flex-wrap">
          <p class="col-12 col-md-4">رقم تسجيل ضريبة القيمة المضافة</p>
          <p>24863163</p>
          <p class="fw-bold text-capitalize">VAT number</p>
        </div> --}}
            </div>
            <div class="col-12 mb-4 mb-md-5 overflow-y">
                <table class="w-100 max-width-900">
                    <thead>
                        <tr>
                            <th class="text-center p-2">
                                <span>تفاصيل السلع والخدمات</span><br />
                                <span class="text-capitalize">nature of goods or services</span>
                            </th>
                            <th class="text-center p-2">
                                <span>سعر الوحدة</span><br />
                                <span class="text-capitalize">unit price</span>
                            </th>
                            <th class="text-center p-2">
                                <span>الكمية</span><br />
                                <span class="text-capitalize">quantity</span>
                            </th>
                            <th class="text-center p-2">
                                <span>الخصومات</span><br />
                                <span class="text-capitalize">discount</span>
                            </th>
                            <th class="text-center p-2">
                                <span>المجموع (شامل قيمة الضريبة المضافة)</span><br />
                                <span class="text-capitalize">subtotal (including VAT)</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders->products as $products)
                            <tr>
                                <td class="text-center p-2">
                                    {{ app()->getLocale() == 'en' ? $products->name_en : $products->name_ar }}</td>
                                <td class="text-center p-2">
                                    {{ str_replace(',', '', number_format($products->price, 2)) }}</td>
                                <td class="text-center p-2">{{ $products->pivot->quantity }}</td>
                                <td class="text-center p-2">{{ $products->discount }}</td>
                                <td class="text-center p-2">
                                    {{ __('lang.sar') . ' ' . str_replace(',', '', number_format($products->price * $products->pivot->quantity + ($tax_tax / 100) * ($products->price * $products->pivot->quantity))) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12 mb-4 overflow-y">
                <table class="w-100 max-width-700">
                    <thead>
                        <tr>
                            <th class="p-2">إجمالي المبالغ</th>
                            <th></th>
                            <th class="text-capitalize text-start p-2">tolal ammounts</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr>
              <td class="text-capitalize p-2">total excluding VAT</td>
              <td class="p-2">الاجمالي (غير شامل الضريبة المضافة)</td>
              <td class="text-start p-2">81.12</td>
            </tr> --}}
                        <tr>
                            <td class="text-capitalize p-2">discount</td>
                            <td class="p-2">الخصومات</td>
                            <td class="text-start p-2">0.0</td>
                        </tr>
                        <tr>
                            <td class="text-capitalize p-2">total VAT</td>
                            <td class="p-2">مجموع ضريبة القيمة المضافة</td>
                            <td class="text-start p-2">{{ str_replace(',', '', number_format($orders->total, 2)) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-capitalize p-2">total ammount due</td>
                            <td class="p-2">اجمالي المبلغ المستحق</td>
                            <td class="text-start p-2">
                                {{ __('lang.sar') . ' ' . str_replace(',', '', number_format($orders->total, 2)) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-7 col">
                <div class="d-flex flex-wrap justify-content-center borderTB">
                    <div class="mx-3 py-2 info">
                        <i class="ms-2 ms-md-3 fa-solid fa-phone"></i>
                        <span>{{ \App\Models\Settings::where('key_id', 'whats')->first()->value }}</span>
                    </div>
                    <div class="mx-3 py-2 info">
                        <i class="ms-2 ms-md-3 fa-solid fa-envelope"></i>
                        <span>{{ \App\Models\Settings::where('key_id', 'email')->first()->value }}</span>
                    </div>
                    {{-- <div class="mx-3 py-2 info">
            <i class="ms-2 ms-md-3 fa-regular fa-building"></i>
            <span>784653</span>
          </div>
          <div class="mx-3 py-2 info">
            <span class="ms-2 ms-md-3">4464</span>
            <bdo dir="ltr" class="text-capitalize">Tax id:</bdo>
          </div> --}}
                </div>
            </div>
        </div>
    </main>
</body>
<script>
    window.print();
</script>
</html>
