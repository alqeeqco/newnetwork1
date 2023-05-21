@extends('layouts.master')

@section('main_title', 'Home Page')
@section('header_title', 'Home')
@section('subheader_title', '#XV2')

@section('content')
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <div id="kt_content_container" class="container">
                        <!--begin::Row-->
                        <div class="row g-7 g-xl-10">
                            <div class="col-xl-4">
                                <!--begin::Statistics Widget 5-->
                                <a href="{{ route('users.index') }}" class="card bg-dark hoverable card-xl-stretch mb-xl-8">
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <!--begin::Svg Icon | path: icons/duotone/Home/Building.svg-->
                                        <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24px"
                                                    height="24px"
                                                    viewBox="0 0 24 24"
                                                    version="1.1">
														<path
                                                            d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                            fill="#000000" fill-rule="nonzero" opacity="0.3"/>
														<path
                                                            d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                            fill="#000000" fill-rule="nonzero"/>
													</svg>
                                            </span>
                                        <!--end::Svg Icon-->
                                        <div class="text-inverse-dark fw-bolder fs-2 mb-2 mt-5">
                                            +{{ \App\Models\User::count() }}</div>
                                        <div class="fw-bold text-inverse-dark fs-7">{{ __('lang.Customers') }}</div>
                                    </div>
                                    <!--end::Body-->
                                </a>
                                <!--end::Statistics Widget 5-->
                            </div>
                            <div class="col-xl-4">
                                <!--begin::Statistics Widget 5-->
                                <a href="{{ route('order.index') }}" class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <!--begin::Svg Icon | path: icons/duotone/Shopping/Chart-pie.svg-->
                                        <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
													<svg xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                         height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none"
                                                           fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24"/>
															<path
                                                                d="M4.00246329,12.2004927 L13,14 L13,4.06189375 C16.9463116,4.55399184 20,7.92038235 20,12 C20,16.418278 16.418278,20 12,20 C7.64874861,20 4.10886412,16.5261253 4.00246329,12.2004927 Z"
                                                                fill="#000000" opacity="0.3"/>
															<path
                                                                d="M3.0603968,10.0120794 C3.54712466,6.05992157 6.91622084,3 11,3 L11,11.6 L3.0603968,10.0120794 Z"
                                                                fill="#000000"/>
														</g>
													</svg>
												</span>
                                        <!--end::Svg Icon-->
                                        <div
                                            class="text-inverse-info fw-bolder fs-2 mb-2 mt-5">{{ \App\Models\Order::count() }}</div>
                                        <div class="fw-bold text-inverse-info fs-7">{{ __('lang.count_orders') }}</div>
                                    </div>
                                    <!--end::Body-->
                                </a>
                                <!--end::Statistics Widget 5-->
                            </div>
                            <div class="col-xl-4">
                                <!--begin::Statistics Widget 5-->
                                <a href="#" class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <!--begin::Svg Icon | path: icons/duotone/Communication/Group.svg-->
                                        <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        width="24px"
                                                        height="24px"
                                                        viewBox="0 0 24 24"
                                                        version="1.1">
														<g stroke="none" stroke-width="1" fill="none"
                                                           fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24"/>
															<path
                                                                d="M13.5,21 L13.5,18 C13.5,17.4477153 13.0522847,17 12.5,17 L11.5,17 C10.9477153,17 10.5,17.4477153 10.5,18 L10.5,21 L5,21 L5,4 C5,2.8954305 5.8954305,2 7,2 L17,2 C18.1045695,2 19,2.8954305 19,4 L19,21 L13.5,21 Z M9,4 C8.44771525,4 8,4.44771525 8,5 L8,6 C8,6.55228475 8.44771525,7 9,7 L10,7 C10.5522847,7 11,6.55228475 11,6 L11,5 C11,4.44771525 10.5522847,4 10,4 L9,4 Z M14,4 C13.4477153,4 13,4.44771525 13,5 L13,6 C13,6.55228475 13.4477153,7 14,7 L15,7 C15.5522847,7 16,6.55228475 16,6 L16,5 C16,4.44771525 15.5522847,4 15,4 L14,4 Z M9,8 C8.44771525,8 8,8.44771525 8,9 L8,10 C8,10.5522847 8.44771525,11 9,11 L10,11 C10.5522847,11 11,10.5522847 11,10 L11,9 C11,8.44771525 10.5522847,8 10,8 L9,8 Z M9,12 C8.44771525,12 8,12.4477153 8,13 L8,14 C8,14.5522847 8.44771525,15 9,15 L10,15 C10.5522847,15 11,14.5522847 11,14 L11,13 C11,12.4477153 10.5522847,12 10,12 L9,12 Z M14,12 C13.4477153,12 13,12.4477153 13,13 L13,14 C13,14.5522847 13.4477153,15 14,15 L15,15 C15.5522847,15 16,14.5522847 16,14 L16,13 C16,12.4477153 15.5522847,12 15,12 L14,12 Z"
                                                                fill="#000000"/>
															<rect fill="#FFFFFF" x="13" y="8" width="3" height="3"
                                                                  rx="1"/>
															<path
                                                                d="M4,21 L20,21 C20.5522847,21 21,21.4477153 21,22 L21,22.4 C21,22.7313708 20.7313708,23 20.4,23 L3.6,23 C3.26862915,23 3,22.7313708 3,22.4 L3,22 C3,21.4477153 3.44771525,21 4,21 Z"
                                                                fill="#000000" opacity="0.3"/>
														</g>
													</svg>
                                                </span>
                                        <!--end::Svg Icon-->
                                        <div
                                            class="text-inverse-warning fw-bolder fs-2 mb-2 mt-5">{{ __('lang.sar') . ' ' . \App\Models\OrderItem::sum('price') }}</div>
                                        <div
                                            class="fw-bold text-inverse-warning fs-7">{{ __('lang.Total_invoices') }}</div>
                                    </div>
                                    <!--end::Body-->
                                </a>
                                <!--end::Statistics Widget 5-->
                            </div>
                        </div>
                        <div class="row">
                            <!--begin::Charts Widget 4-->
                            <div class="card card-xl-stretch mb-5 mb-xl-8">
                                <!--begin::Header-->
                                <div class="card-header border-0 pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bolder fs-3 mb-1">{{ __('lang.Orders_and_products_chart') }}</span>
                                        <span class="text-muted fw-bold fs-7">{{ __('lang.Orders_and_products_chart2') }}</span>

                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div id="kt_charts_widget_4_chart" style="height: 350px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')

    <script src="{{ asset('dashboard/assets/js/custom/widgets.js') }}"></script>
    <script>
        var e = document.getElementById("kt_charts_widget_4_chart"),
            t = (parseInt(KTUtil.css(e, "height")), KTUtil.getCssVariableValue("--bs-gray-500")),
            a = KTUtil.getCssVariableValue("--bs-gray-200"), o = KTUtil.getCssVariableValue("--bs-success"),
            s = KTUtil.getCssVariableValue("--bs-light-success"), r = KTUtil.getCssVariableValue("--bs-warning"),
            i = KTUtil.getCssVariableValue("--bs-light-warning");
        e && new ApexCharts(e, {
            series: [{name: "{{ __('lang.titleproducts') }}",
                // data: [60, 50, 80, 40, 100, 60]
                data: @json($products_s),
            }, {
                name: "{{ __('lang.order') }}",
                // data: [70, 60, 110, 40, 50, 70]
                data: @json($orders),
            }],
            chart: {fontFamily: "inherit", type: "area", height: 350, toolbar: {show: !1}},
            plotOptions: {},
            legend: {show: !1},
            dataLabels: {enabled: !1},
            fill: {type: "solid", opacity: 1},
            stroke: {curve: "smooth"},
            xaxis: {
                // categories: ["Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                categories: @json($date),
                axisBorder: {show: !1},
                axisTicks: {show: !1},
                labels: {style: {colors: t, fontSize: "12px"}},
                crosshairs: {position: "front", stroke: {color: t, width: 1, dashArray: 3}},
                tooltip: {enabled: !0, formatter: void 0, offsetY: 0, style: {fontSize: "12px"}}
            },
            yaxis: {labels: {style: {colors: t, fontSize: "12px"}}},
            states: {
                normal: {filter: {type: "none", value: 0}},
                hover: {filter: {type: "none", value: 0}},
                active: {allowMultipleDataPointsSelection: !1, filter: {type: "none", value: 0}}
            },
            tooltip: {
                style: {fontSize: "12px"}, y: {
                    formatter: function (e) {
                        return "" + e + ""
                    }
                }
            },
            colors: [o, r],
            grid: {borderColor: a, strokeDashArray: 4, yaxis: {lines: {show: !0}}},
            markers: {colors: [s, i], strokeColor: [s, i], strokeWidth: 3}
        }).render()
    </script>
@endsection
