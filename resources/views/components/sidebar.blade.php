<!--begin::Aside menu-->
<div class="aside-menu flex-column-fluid">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
         data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
         data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
         data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
        <!--begin::Menu-->
        <div
            class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
            id="#kt_aside_menu" data-kt-menu="true">
            <div class="menu-item">
                <a class="menu-link active" href="{{ route('dashboard.index') }}">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotone/Design/PenAndRuller.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                 viewBox="0 0 24 24" version="1.1">
                                <path
                                    d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                                    fill="#000000" opacity="0.3"/>
                                <path
                                    d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                                    fill="#000000"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </div>

            @can(['Admins-List', 'Roles-List'])
                <div class="menu-item">
                    <div class="menu-content pt-8 pb-2">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">Admins & Roles</span>
                    </div>
                </div>
            @endcan

            @can('Admins-List')
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('admin.index') }}">
                        <span class="menu-icon">
                            <i class="fas fa-user-lock fs-3"></i>
                        </span>
                        <span class="menu-title">
                            {{ __('lang.admins') }}
                        </span>
                    </a>
                </div>
            @endcan

            @can('Roles-List')
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('role.index') }}">
                        <span class="menu-icon">
                            <i class="fas fa-user-cog fs-3"></i>
                        </span>
                        <span class="menu-title">
                            {{ __('lang.roles') }}
                        </span>
                    </a>
                </div>
             @endcan

            <div class="menu-item">
                <div class="menu-content pt-8 pb-2">
                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">Pages</span>
                </div>
            </div>

            @can('Category-List')
                <div class="menu-item my-1">
                    <a class="menu-link" href="{{ route('cat.index') }}">
                        <span class="menu-icon">
                            <i class="fas fa-boxes fs-3"></i>
                        </span>
                        <span class="menu-title">{{ __('lang.menu_cat') }}</span>
                    </a>
                </div>
            @endcan

            @can('Ads-List')
                <div class="menu-item my-1">
                    <a class="menu-link" href="{{ route('ads.index') }}">
                        <span class="menu-icon">
                            <i class="fas fa-ad fs-3"></i>
                        </span>
                        <span class="menu-title">{{ __('lang.menu_ads') }}</span>
                    </a>
                </div>
            @endcan

            @can('Product-List')
                <div class="menu-item my-1">
                    <a class="menu-link" href="{{ route('products.index') }}">
                        <span class="menu-icon">
                            <i class="fab fa-product-hunt fs-3"></i>
                        </span>
                        <span class="menu-title">{{ __('lang.menu_products') }}</span>
                    </a>
                </div>
            @endcan

            @can('Product-List')
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                    <span class="menu-icon">
                        <i class="fab fa-product-hunt fs-3"></i>
                    </span>
                    <span class="menu-title">{{ __('lang.Product_listings') }}</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg" kt-hidden-height="156"
                     style="display: none; overflow: hidden;">
                    <span class="menu-link">
                         <a class="menu-link" href="{{ route('products.index') }}?type=most_recent">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('lang.products_most_recent') }}</span>
                         </a>
                    </span>
                    <span class="menu-link">
                     <a class="menu-link" href="{{ route('products.index') }}?type=best_seller">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('lang.products_best_seller') }}</span>
                         </a>
                    </span>
                    <span class="menu-link">
                     <a class="menu-link" href="{{ route('products.index') }}?type=first_home_page">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('lang.products_first_home_page') }}</span>
                         </a>
                    </span>
                    <span class="menu-link">
                     <a class="menu-link" href="{{ route('products.index') }}?type=only_product">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('lang.products_only_product') }}</span>
                         </a>
                    </span>
                </div>
            </div>
            @endcan

            @can('User-List')
                <div class="menu-item my-1">
                    <a class="menu-link" href="{{ route('users.index') }}">
                        <span class="menu-icon">
                         <i class="fa fa-users fs-3"></i>
                        </span>
                        <span class="menu-title"> {{ __('lang.titleusers') }}</span>
                    </a>
                </div>
            @endcan

            @can('Country-List')
                <div class="menu-item my-1">
                    <a class="menu-link" href="{{ route('countries.index') }}">
                        <span class="menu-icon">
                            <i class="fas fa-globe fs-3"></i>
                        </span>
                        <span class="menu-title">{{ __('lang.menu_countries') }}</span>
                    </a>
                </div>
            @endcan

            @can('City-List')
                <div class="menu-item my-1">
                    <a class="menu-link" href="{{ route('cities.index') }}">
                        <span class="menu-icon">
                            <i class="fas fa-city fs-3"></i>
                        </span>
                        <span class="menu-title">{{ __('lang.menu_cities') }}</span>
                    </a>
                </div>
            @endcan

            @can('Coupons-List')
                <div class="menu-item my-1">
                    <a class="menu-link" href="{{ route('coupons.index') }}">
                        <span class="menu-icon">
                            <i class="fas fa-tags fs-3"></i>
                        </span>
                        <span class="menu-title">{{ __('lang.menu_coupons') }}</span>
                    </a>
                </div>
            @endcan


            @can('Order-List')
                <div class="menu-item my-1">
                    <a class="menu-link" href="{{ route('order.index') }}">
                        <span class="menu-icon">
                            <i class="fas fa-truck fs-3"></i>
                        </span>
                        <span class="menu-title">{{ __('lang.orders') }}</span>
                    </a>
                </div>
            @endcan

            @can('Proposals-List')
            <div class="menu-item my-1">
            <a class="menu-link" href="{{ route('proposals.index') }}">
            <span class="menu-icon">
            <i class="fas fa-truck fs-3"></i>
            </span>
            <span class="menu-title">{{ __('lang.proposals') }}</span>
            </a>
            </div>
            @endcan

            @can('Appointments-List')
            <div class="menu-item my-1">
            <a class="menu-link" href="{{ route('appointments.index') }}">
            <span class="menu-icon">
            <i class="fas fa-truck fs-3"></i>
            </span>
            <span class="menu-title">{{ __('lang.appointments') }}</span>
            </a>
            </div>
            @endcan

            @can('Coupons-List')
            <div class="menu-item my-1">
                <a class="menu-link" href="{{ route('PaymentOptions.index') }}">
                    <span class="menu-icon">
                        <i class="fas fa-shipping-fast fs-3"></i>
                    </span>
                    <span class="menu-title">{{ __('lang.PaymentOptions') }}</span>
                </a>
            </div>

            <div class="menu-item my-1">
                <a class="menu-link" href="{{ route('shippingoptions.index') }}">
                    <span class="menu-icon">
                        <i class="fas fa-shipping-fast fs-3"></i>
                    </span>
                    <span class="menu-title">{{ __('lang.menu_shippingoptions') }}</span>
                </a>
            </div>
            @endcan
            @can('Contact-List')
                <div class="menu-item my-1">
                    <a class="menu-link" href="{{ route('contact-us.fetch') }}">
                        <span class="menu-icon">
                            <i class="fas fa-mail-bulk fs-3"></i>
                        </span>
                        <span class="menu-title">{{ __('lang.menu_Connectus') }}</span>
                    </a>
                </div>
            @endcan

            @can('Why-Choose-us-List')
                <div class="menu-item my-1">
                    <a class="menu-link" href="{{ route('whychooseus.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-check2-square fs-3"></i>
                        </span>
                        <span class="menu-title">{{ __('lang.titlewhychooseus') }}</span>
                    </a>
                </div>
            @endcan

            @can('Subscribe-List')
                <div class="menu-item my-1">
                    <a class="menu-link" href="{{ route('subscribe.fetch') }}">
                        <span class="menu-icon">
                            <i class="fas fa-user-check fs-3"></i>
                        </span>
                        <span class="menu-title">
                            {{ __('lang.subscribes') }}
                        </span>
                    </a>
                </div>
            @endcan

            @can('Settings-List')
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion my-1">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="fas fa-cogs fs-2"></i>
                    </span>
                    <span class="menu-title">{{ __('lang.settings') }}</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg" kt-hidden-height="156"
                        style="display: none; overflow: hidden;">
                    <span class="menu-link">
                         <a class="menu-link" href="{{ route('setting.global') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('lang.global') }}</span>
                         </a>
                    </span>
                    <span class="menu-link">
                         <a class="menu-link" href="{{ route('setting.social') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('lang.social') }}</span>
                         </a>
                    </span>
                </div>
            </div>
            @endcan

        </div>
        <!--end::Menu-->
    </div>
</div>
<!--end::Aside menu-->
