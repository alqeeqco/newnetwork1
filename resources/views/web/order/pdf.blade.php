<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'en' ? 'ltr' : 'rtl' }}" direction="{{ app()->getLocale() == 'en' ? 'ltr' : 'rtl' }}">

<head>
    <meta charset="utf-8">
    <title>{{ \Illuminate\Support\Facades\Auth::user()->user_name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <div class="page-content container">
        <div class="page-header text-blue-d2">
            <h1 class="page-title text-secondary-d1">
                {{__('lang.invoice')}}
                <small class="page-info">
                    <i class="fa fa-angle-double-right text-80"></i>
                    {{__('lang.ID')}}: #{{ $order->number }}
                </small>
            </h1>
            <div class="page-tools">
                <div class="action-buttons">
                    <a class="btn bg-white btn-light mx-1px text-95" href="{{ url(app()->getLocale().'/') }}">
                        {{ 'new net work' }}
                    </a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center text-150">
                                {{-- <i class="fa fa-book fa-2x text-success-m2 mr-1"></i>--}}
                                <a href="{{ url(\Illuminate\Support\Facades\App::getLocale().'/') }}" class="logo logo-dark">
                                    <img src="{{ Request::root() . '/dashboard/images/' . \App\Models\Settings::where('key_id' , 'logo')->first()->value }}" alt="{{ env('APP_NAME') }}" style="width: 130px; height:80px;object-fit:cover; padding: 10px;">

                                </a>
                                <span class="text-default-d3">{{ 'New Net Work' }}</span>
                            </div>
                        </div>
                    </div>
                    <hr class="row brc-default-l1 mx-n1 mb-4" />


                    <div class="row font-16">
                        <div class="col-sm-6">
                            <div>
                                <span class="text-sm text-grey-m2 align-middle">{{__('lang.To')}}:</span>
                                <span class="text-600 text-110 text-blue align-middle">{{ $order->user->first_name ?? $order->user->user_name}}</span>
                            </div>
                            <div class="text-grey-m2">
                                <div class="my-1">
                                    @if(app()->getLocale() == 'en')
                                    {{ $order->addresses->cities->countries->name_en }}
                                    @else
                                    {{ $order->addresses->cities->countries->name_ar }}
                                    @endif,
                                    @if(app()->getLocale() == 'en')
                                    {{ $order->addresses->cities->name_en }}
                                    @else
                                    {{ $order->addresses->cities->name_ar }}
                                    @endif
                                </div>
                                <div class="my-1">
                                    {{ $order->addresses->street }}
                                    , {{ $order->addresses->district }}
                                </div>
                                <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600">
                                        {{ $order->user->email }}
                                    </b></div>
                            </div>
                        </div>

                        <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                            <hr class="d-sm-none" />
                            <div class="text-grey-m2">
                                <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                    {{__('lang.invoice')}}
                                </div>
                                <div class="my-1 my-lg-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">{{__('lang.ID')}}:</span> #{{ $order->number }}</div>
                                <div class="my-1 my-lg-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">{{ __('lang.created_at') }}:</span>{{ \Carbon\Carbon::parse($order->create_date, 'UTC')->isoFormat('MMMM Do YYYY') }}
                                </div>
                                <div class="my-1 my-lg-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">{{ __('lang.status') }}:</span>
                                    @if( $order->payment_status == 'pending' || $order->payment_status == 'failed')
                                    <span class="badge badge-warning badge-pill px-25">{{ __('lang.Unpaid') }}</span>
                                    @else
                                    <span class="badge badge-success badge-pill px-25">{{ __('lang.paid') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                    <table class="mt-4 w-100 mb-3">
                        <thead class="text-600 text-white bgc-default-tp1 py-25">
                            <td class="">#</td>
                            <td class="">{{ __('lang.Product') }}</td>
                            <td class="">{{ __('lang.Qty') }}</td>
                            <td class="">{{ __('lang.price') }}</td>
                            <td class="">{{ __('lang.tax') }}</td>
                            <td class="">{{ __('lang.total') }}</td>
                        </thead>
                        <tbody class="text-95 text-secondary-d3">
                            @foreach($order->products as $i => $products_x)
                            <tr class="mb-2 mb-sm-0 py-25 bgc-default-l4">
                                <td class=""> {{ $i+=1 }}</td>
                                <td class="">
                                    @if(app()->getLocale() == 'en')
                                    {{ $products_x->name_en }}
                                    @else
                                    {{ $products_x->name_ar }}
                                    @endif
                                </td>
                                <td class="">{{ $products_x->pivot->quantity }}</td>
                                <td class=" text-95">
                                    @if($products_x->discount > 0)
                                    {{ __('lang.sar') . ' ' . number_format(($products_x->price -($products_x->price * $products_x->discount/100))  + (($tax_tax/100) * $products_x->price) , 2) }}
                                    @else
                                    {{ __('lang.sar') . ' ' . number_format($products_x->price + (($tax_tax/100) * $products_x->price) , 2) }}
                                    @endif
                                </td>
                                 <td>
                                 {{ __('lang.sar') . ' ' .number_format((($tax_tax/100) * $products_x->price) , 2) }}
                                 </td>
                                <td class="text-secondary-d2">
                                    @if($products_x->discount > 0)
                                    {{ __('lang.sar').' '.number_format(($products_x->price * $products_x->pivot->quantity) - (($products_x->price * $products_x->pivot->quantity) * $products_x->discount/100) + (($tax_tax/100) * ($products_x->price * $products_x->pivot->quantity)) , 2)  }}
                                    @else
                                    {{ __('lang.sar').' '.number_format(($products_x->price * $products_x->pivot->quantity) + (($tax_tax/100) * ($products_x->price * $products_x->pivot->quantity)) , 2)  }}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row border-b-2 brc-default-l2"></div>


                    <div>
                        <p class="text-600 mb-0">{{ __('lang.contact_information') }}</p>
                        <div class="d-flex flex-column-reverse flex-sm-row mt-2 font-16">
                            <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                                <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600">
                                        {{ \App\Models\Settings::where('key_id' , 'email')->first()->value }}
                                    </b>
                                </div>
                                <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600">
                                        {{ \App\Models\Settings::where('key_id' , 'phone')->first()->value }}
                                    </b>
                                </div>
                                <div class="my-1"><i class="fa fa-whatsapp fa-flip-horizontal text-secondary"></i> <b class="text-600">
                                        <a href="{{ \App\Models\Settings::where('key_id' , 'whats')->first()->value }}">{{ \App\Models\Settings::where('key_id' , 'phone')->first()->value }}</a>

                                    </b>
                                </div>
                                <div>
                                    <span class="text-sm text-grey-m2 align-middle">Location:</span>
                                    <span class="text-600 text-110 text-blue align-middle">
                                        {{ \App\Models\Settings::where('key_id' , 'location_'.app()->getLocale())->first()->value }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                {{-- <div class="row my-2">--}}
                                {{-- <div class="col-7 text-right">--}}
                                {{-- SubTotal--}}
                                {{-- </div>--}}
                                {{-- <div class="col-5">--}}
                                {{-- <span class="text-120 text-secondary-d1">$2,250</span>--}}
                                {{-- </div>--}}
                                {{-- </div>--}}
                                {{-- <div class="row my-2">--}}
                                {{-- <div class="col-7 text-right">--}}
                                {{-- Tax (10%)--}}
                                {{-- </div>--}}
                                {{-- <div class="col-5">--}}
                                {{-- <span class="text-110 text-secondary-d1">$225</span>--}}
                                {{-- </div>--}}
                                {{-- </div>--}}
                                <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                    <div class="col-8 text-right p-0">
                                        {{ __('lang.Total_Amount') }}
                                    </div>
                                    <div class="col-4 d-flex justify-content-end">
                                        <span class="text-150 text-success-d3 opacity-2">{{ __('lang.sar').' '.$order->total }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="d-flex align-items-center justify-content-between pb-3 font-16">
                        <span class="text-secondary-d1 text-105">{{ __('lang.Thank_you_for_your_business') }}</span>
                        @if( $order->payment_status == 'pending' || $order->payment_status == 'failed')
                        @if ($order->payment_method == 'Emkan' && $order->payment_status == 'failed')
                        <a class="btn btn-info btn-bold px-4 float-right mt-lg-0" href="{{ route('emcan.create', ['id' => $order->id]) }}">
                            {{ __('lang.Pay_Now') }}
                        </a>
                        @elseif ($order->payment_method == 'Emkan' && $order->payment_status == 'pending')

                        @else
                        <a class="btn btn-info btn-bold px-4 float-right mt-lg-0" href="{{ route('tap.create', ['id' => $order->id]) }}">
                            {{ __('lang.Pay_Now') }}
                        </a>
                        @endif
                        @else
                            {{ 'Completed' }}
                        @endif
                        {{-- @if( $order->payment_status == 'pending' || $order->payment_status == 'failed')
                        <a href="{{ route('tap.create', ['id' => $order->id]) }}" class="btn btn-info btn-bold px-4 float-right mt-lg-0">{{ __('lang.Pay_Now') }}</a>
                        @else

                        @endif --}}
                    </div>

                </div>
            </div>
        </div>
    </div>

    @if(app()->getLocale() == 'ar')
    <style type="text/css">
        body {
            text-align: inherit;
        }

        .text-right {
            text-align: left !important;
        }
    </style>
    @endif
    <style>
        .text-secondary-d1 {
            color: #728299 !important;
        }

        .page-header {
            margin: 0 0 1rem;
            padding-bottom: 1rem;
            padding-top: .5rem;
            border-bottom: 1px dotted #e2e2e2;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -ms-flex-align: center;
            align-items: center;
        }

        .page-title {
            padding: 0;
            margin: 0;
            font-size: 1.75rem;
            font-weight: 300;
        }

        .brc-default-l1 {
            border-color: #dce9f0 !important;
        }

        .ml-n1,
        .mx-n1 {
            margin-left: -.25rem !important;
        }

        .mr-n1,
        .mx-n1 {
            margin-right: -.25rem !important;
        }

        .mb-4,
        .my-4 {
            margin-bottom: 1.5rem !important;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, .1);
        }

        .text-grey-m2 {
            color: #888a8d !important;
        }

        .text-success-m2 {
            color: #86bd68 !important;
        }

        .font-bolder,
        .text-600 {
            font-weight: 600 !important;
        }

        .text-110 {
            font-size: 110% !important;
        }

        .text-blue {
            color: #478fcc !important;
        }

        .pb-25,
        .py-25 {
            padding-bottom: .75rem !important;
        }

        .pt-25,
        .py-25 {
            padding-top: .75rem !important;
        }

        .bgc-default-tp1 {
            background-color: rgba(121, 169, 197, .92) !important;
        }

        .bgc-default-l4,
        .bgc-h-default-l4:hover {
            background-color: #f3f8fa !important;
        }

        .page-header .page-tools {
            -ms-flex-item-align: end;
            align-self: flex-end;
        }

        .btn-light {
            color: #757984;
            background-color: #f5f6f9;
            border-color: #dddfe4;
        }

        .w-2 {
            width: 1rem;
        }

        .text-120 {
            font-size: 120% !important;
        }

        .text-primary-m1 {
            color: #4087d4 !important;
        }

        .text-danger-m1 {
            color: #dd4949 !important;
        }

        .text-blue-m2 {
            color: #68a3d5 !important;
        }

        .text-150 {
            font-size: 150% !important;
        }

        .text-60 {
            font-size: 60% !important;
        }

        .text-grey-m1 {
            color: #7b7d81 !important;
        }

        .align-bottom {
            vertical-align: bottom !important;
        }

        td {
            padding: 1rem;
        }

        @media screen and (max-width: 991.98px) {
            img {
                height: 50px !important;
            }

            .page-title {
                font-size: 1.2rem;
            }

            .btn-light {
                font-size: 14px !important;
            }

            .text-default-d3 {
                font-size: 18px;
            }

            .font-16 {
                font-size: 14px;
            }

            td {
                padding: 0.5rem;
                font-size: 12px;
            }

            .text-150 {
                font-size: 16px !important;
                font-weight: bold;
            }

            .text-110 {
                font-size: 13px !important;
            }
        }
    </style>
    <script type="text/javascript">

    </script>
</body>

</html>
