<?php

use App\Http\Controllers\dashboard\AdminsController;
use App\Http\Controllers\dashboard\AppointmentsController as DashboardAppointmentsController;
use App\Http\Controllers\dashboard\ImagesController;
use App\Http\Controllers\dashboard\RolesController;
use App\Http\Controllers\web\CartController;
use App\Http\Controllers\web\ContactUsController;
use App\Http\Controllers\web\FavoriteController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\MyAccountController;

use App\Http\Controllers\dashboard\CategoriesController;
use App\Http\Controllers\dashboard\ProductsController;
use App\Http\Controllers\dashboard\ProposalsController as DashboardProposalsController;
use App\Http\Controllers\web\AppointmentsController;
use App\Http\Controllers\web\EmcanPaymentController;
use App\Http\Controllers\web\OrderController;
use App\Http\Controllers\web\ProductWebController;
use App\Http\Controllers\web\ProposalsController;
use App\Http\Controllers\web\SearchController;
use App\Http\Controllers\web\SubscribeController;

use App\Http\Controllers\web\TapPaymentController;
use App\Models\Carts;
use App\Models\Categories;
use App\Models\Order;
use App\Models\Settings;
use Illuminate\Support\Facades\Route;
use  Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/auth.php';
// Clear application cache:
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return 'Application cache has been cleared';
});

//Clear route cache:
Route::get('/route-cache', function() {
    Artisan::call('route:clear');
    return 'Routes cache has been cleared';
});
//Clear config cache:
Route::get('/config-cache', function() {
    Artisan::call('config:cache');
    return 'Config cache has been cleared';
});

// Clear view cache:
Route::get('/view-clear', function() {
    Artisan::call('view:clear');
    return 'View cache has been cleared';
});


Route::get('/admin/dashboard', [\App\Http\Controllers\dashboard\HomeController::class , 'index'])->prefix(LaravelLocalization::setLocale())->middleware(['auth:admin'])->name('dashboard.index');

//Route::get('/testtest', function (){
//    $order = Order::where('number' , '20230006')->first();
//    $order->update([
//        'payment_status' => 'paid'
//    ]);
//});

Route::get('/', [HomeController::class, 'index'])->prefix(LaravelLocalization::setLocale())->name('home');

// Web Routes
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['auth:web'],
], function () {

    Route::get('installment', [EmcanPaymentController::class, 'services_emkan'])->withoutMiddleware(['auth:web']);
    Route::get('services/proposal', [ProposalsController::class, 'create'])->withoutMiddleware(['auth:web']);
    Route::post('services/proposal', [ProposalsController::class, 'store'])->withoutMiddleware(['auth:web'])->name('proposal.store');
    Route::get('export/proposal', [DashboardProposalsController::class, 'export'])->withoutMiddleware(['auth:web'])->name('proposal.export');
    Route::post('services/appointment', [AppointmentsController::class, 'store'])->withoutMiddleware(['auth:web'])->name('appointment.store');
    Route::get('export/appointment', [DashboardAppointmentsController::class, 'export'])->withoutMiddleware(['auth:web'])->name('appointment.export');

    // My Account
    Route::controller(MyAccountController::class)
        ->prefix('account')
        ->as('account.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('edite_address/{id}', 'edite_address')->name('edite_address');
            Route::post('update_address/{id}', 'update_address')->name('update_address');
            Route::post('delete_address/{id}', 'delete_address')->name('delete_address');
            Route::put('/{id}', 'update')->name('update');
            Route::post('add-address', 'add_address')->name('add_address');
            Route::get('getTracking/{id}', 'getTracking')->name('getTracking');
        });

    // Contact Us
    Route::controller(ContactUsController::class)
        ->prefix('contact-us')
        ->as('contact-us.')
        ->withoutMiddleware(['auth:web'])
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
        });

    // Subscribe Route
    Route::controller(SubscribeController::class)
        ->prefix('subscribe')
        ->as('subscribe.')
        ->group(function () {
            Route::post('/', 'store')->name('store')->withoutMiddleware(['auth:web']);
        });

    Route::controller(CartController::class)
        ->prefix('cart')
        ->as('cart.')
        ->withoutMiddleware(['auth:web'])
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::delete('/{id}', 'destroy')->name('delete');
            Route::post('/coupon', 'coupon')->name('coupon');
            Route::post('/update/{id}', 'update_cart')->name('update_cart');
            Route::post('/update_Shipping', 'update_Shipping')->name('update_Shipping');
            Route::post('/empty', 'empty')->name('empty');
        });

    Route::controller(ProductWebController::class)
        ->prefix('products')
        ->as('product.')
        ->withoutMiddleware(['auth:web'])
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/single/{id}', 'show')->name('show');
            Route::get('/getData/{id}', 'getData')->name('getData');
            Route::post('/add_fav', 'add_fav')->name('add_fav');
            Route::get('/show/{id}', 'show_products')->name('show_products');
            Route::post('/search', 'search')->name('search');
            Route::get('/new-arrivals', 'product_type')->name('new-arrivals');
            Route::get('/most-sold', 'product_type')->name('most-sold');
            Route::post('/add-review', 'add_review')->name('add-review');
        });

    Route::controller(\App\Http\Controllers\web\QuickLinkController::class)
        ->prefix('')
        ->as('link.')
        ->withoutMiddleware(['auth:web'])
        ->group(function () {
            Route::get('/About-Us', 'about')->name('about');
            Route::get('/Terms-Of-Use', 'terms_use')->name('terms_use');
            Route::get('/Privacy-Policy', 'privacy_policy')->name('privacy_policy');
            Route::get('/FAQ', 'faq')->name('faq');
        });
    // Start Favorite Route
    Route::controller(FavoriteController::class)
        ->prefix('favorite')
        ->as('favorite.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::delete('/delete', 'destroy')->name('delete');
        });
    // End Favorite Route

    // Start Favorite Route
    Route::controller(SearchController::class)
        ->prefix('search')
        ->as('search.')
        ->withoutMiddleware(['auth:web'])
        ->group(function () {
            Route::get('/', 'search')->name('modelSearch');
        });
    // End Favorite Route

    // Start Order Route
    Route::controller(OrderController::class)
        ->prefix('orders')
        ->as('order.')
        ->group(function () {
//            Route::get('/list', 'index')->name('index')->withoutMiddleware(['auth:web'])->middleware(['auth:admin']);
            Route::get('/', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/yourOrder/{user_name}/{id}', 'show')->name('show');
            Route::delete('/{id}', 'destroy')->name('delete')->withoutMiddleware(['auth:web'])->middleware(['auth:admin']);
        });
    // End Order Route

    // Start Payment Route
    Route::controller(TapPaymentController::class)
        ->prefix('tap_payment')
        ->as('tap.')
        ->withoutMiddleware(['auth:web'])
        ->group(function () {
            Route::get('/v2/orders/{id}', 'create')->name('create');
            Route::get('/{id}', 'getPayment')->name('paymentStatus');
        });
    // End Payment Route

    Route::controller(EmcanPaymentController::class)
    ->prefix('emcan_payment')
    ->as('emcan.')
    ->withoutMiddleware(['auth:web'])
    ->group(function () {
        Route::get('/{id}', 'create')->name('create');
        Route::post('/{id}', 'store')->name('store');
        Route::get('/otp/{id}', 'otp_show')->name('otp_show');
        Route::post('/otp/{id}', 'otp')->name('otp');
    });

});


// Admin Routes
Route::group([
    'middleware' => ['auth:admin', 'localeViewPath'],
    'prefix' => LaravelLocalization::setLocale() . '/admin',
], function () {
    Route::controller(CategoriesController::class)
        ->prefix('categories')
        ->as('cat.')
        ->group(function () {
            Route::get('/index', 'index')->name('index');

            Route::get('/create', 'create')->name('create');

            Route::post('/store', 'store')->name('store');

            Route::get('/show/{id}', 'show')->name('show');

            Route::get('/edit/{id}', 'edit')->name('edit');

            Route::post('/update', 'update')->name('update');

            Route::post('/destroy/{id}', 'destroy')->name('destroy');

            Route::post('/Stauts/{id}', 'updateStauts')->name('updateStauts');
        });

    // Ads
    Route::controller(\App\Http\Controllers\dashboard\AdsController::class)
        ->prefix('ads')
        ->as('ads.')
        ->group(function () {
            Route::get('/index', 'index')->name('index');

            Route::get('/create', 'create')->name('create');

            Route::post('/store', 'store')->name('store');

            Route::get('/show/{id}', 'show')->name('show');

            Route::get('/edit/{id}', 'edit')->name('edit');

            Route::post('/update', 'update')->name('update');

            Route::post('/destroy/{id}', 'destroy')->name('destroy');

            Route::post('/Stauts/{id}', 'updateStauts')->name('updateStauts');
        });


    // Products
    Route::controller(\App\Http\Controllers\dashboard\ProductsController::class)
        ->prefix('products')
        ->as('products.')
        ->group(function () {
            Route::get('/index', 'index')->name('index');

            Route::get('/create', 'create')->name('create');

            Route::post('/store', 'store')->name('store');

            Route::get('/show/{id}', 'show')->name('show');

            Route::get('/edit/{id}', 'edit')->name('edit');

            Route::post('/update', 'update')->name('update');

            Route::post('/destroy/{id}', 'destroy')->name('destroy');

            Route::post('/Stauts/{id}', 'updateStauts')->name('updateStauts');

            Route::post('/appearUpdate/{id}', 'appearUpdate')->name('appearUpdate');

            Route::get('/reStore/{id}' , 'reStore')->name('reStore');;
        });

    // Countries
    Route::controller(\App\Http\Controllers\dashboard\CountriesController::class)
        ->prefix('countries')
        ->as('countries.')
        ->group(function () {
            Route::get('/index', 'index')->name('index');

            Route::get('/create', 'create')->name('create');

            Route::post('/store', 'store')->name('store');

            Route::get('/show/{id}', 'show')->name('show');

            Route::get('/edit/{id}', 'edit')->name('edit');

            Route::post('/update', 'update')->name('update');

            Route::post('/destroy/{id}', 'destroy')->name('destroy');

            Route::post('/Stauts/{id}', 'updateStauts')->name('updateStauts');
        });

    // Cities
    Route::controller(\App\Http\Controllers\dashboard\CitiesController::class)
        ->prefix('cities')
        ->as('cities.')
        ->group(function () {
            Route::get('/index', 'index')->name('index');

            Route::get('/create', 'create')->name('create');

            Route::post('/store', 'store')->name('store');

            Route::get('/show/{id}', 'show')->name('show');

            Route::get('/edit/{id}', 'edit')->name('edit');

            Route::post('/update', 'update')->name('update');

            Route::post('/destroy/{id}', 'destroy')->name('destroy');

            Route::post('/Stauts/{id}', 'updateStauts')->name('updateStauts');
        });

    // Coupons
    Route::controller(\App\Http\Controllers\dashboard\CouponsController::class)
        ->prefix('coupons')
        ->as('coupons.')
        ->group(function () {
            Route::get('/index', 'index')->name('index');

            Route::get('/create', 'create')->name('create');

            Route::post('/store', 'store')->name('store');

            Route::get('/show/{id}', 'show')->name('show');

            Route::get('/edit/{id}', 'edit')->name('edit');

            Route::post('/update', 'update')->name('update');

            Route::post('/destroy/{id}', 'destroy')->name('destroy');

            Route::post('/Stauts/{id}', 'updateStauts')->name('updateStauts');
        });


    // Proposal
    Route::controller(\App\Http\Controllers\dashboard\ProposalsController::class)
    ->prefix('proposals')
    ->as('proposals.')
    ->group(function () {
        Route::get('/index', 'index')->name('index');

        Route::post('/destroy/{id}', 'destroy')->name('destroy');
    });

    // Appointments
    Route::controller(\App\Http\Controllers\dashboard\AppointmentsController::class)
    ->prefix('appointments')
    ->as('appointments.')
    ->group(function () {
        Route::get('/index', 'index')->name('index');

        Route::post('/destroy/{id}', 'destroy')->name('destroy');
    });


    // Shipping options
    Route::controller(\App\Http\Controllers\dashboard\ShippingMethodController::class)
        ->prefix('shippingoptions')
        ->as('shippingoptions.')
        ->group(function () {
            Route::get('/index', 'index')->name('index');

            Route::get('/create', 'create')->name('create');

            Route::post('/store', 'store')->name('store');

            Route::get('/show/{id}', 'show')->name('show');

            Route::get('/edit/{id}', 'edit')->name('edit');

            Route::post('/update', 'update')->name('update');

            Route::post('/destroy/{id}', 'destroy')->name('destroy');

            Route::post('/Stauts/{id}', 'updateStauts')->name('updateStauts');
        });


    // Start Admins Controller
    Route::controller(AdminsController::class)
        ->as('admin.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('delete');
            Route::post('/status/{id}', 'changeStatus')->name('changeStatus');

            Route::get('/profile-edit', 'edit_admin')->name('profile.edit');

            Route::post('/profile-update', 'update_admin')->name('profile.update');

            Route::get('/profile-resetPassword',  'reset_Password')->name('profile.reset_Password');

            Route::post('/profile-reset-Password',  'resetPassword')->name('profile.resetPassword');
        });
    // End Admins Controller

    Route::controller(RolesController::class)
        ->prefix('roles')
        ->as('role.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('delete');
            Route::post('/status/{id}', 'changeStatus')->name('changeStatus');
        });
    // End Admins Controller

    // Start Contact Us Route ( Dashboard )
    Route::controller(ContactUsController::class)
        ->prefix('contact-us')
        ->as('contact-us.')
        ->group(function () {
            Route::get('/', 'fetch')->name('fetch');
            Route::post('/{id}', 'destroy')->name('delete');
        });
    // End Contact Us Route ( Dashboard )

    // Start Subscribe Route ( Dashboard )
    Route::controller(SubscribeController::class)
        ->prefix('subscribe')
        ->as('subscribe.')
        ->group(function () {
            Route::get('/', 'fetch')->name('fetch');
            Route::get('/sendMail', 'sendMail')->name('sendMail');
            Route::post('/sendMail', 'create_mail')->name('create_mail');
//            Route::delete('/{id}', 'destroy')->name('delete');
        });
    // Start Subscribe Route ( Dashboard )

    // Start Subscribe Route ( Dashboard )
    Route::controller(SubscribeController::class)
        ->prefix('subscribe')
        ->as('subscribe.')
        ->group(function () {
//            Route::get('/', 'fetch')->name('fetch');
            Route::post('/{id}', 'destroy')->name('delete');
        });
    // Start Subscribe Route ( Dashboard )

    // Why choose us
    Route::controller(\App\Http\Controllers\dashboard\WhyChooseUsController::class)
        ->prefix('whychooseus')
        ->as('whychooseus.')
        ->group(function () {
            Route::get('/index', 'index')->name('index');

            Route::get('/create', 'create')->name('create');

            Route::post('/store', 'store')->name('store');

            Route::get('/show/{id}', 'show')->name('show');

            Route::get('/edit/{id}', 'edit')->name('edit');

            Route::post('/update', 'update')->name('update');

            Route::post('/destroy/{id}', 'destroy')->name('destroy');

            Route::post('/Stauts/{id}', 'updateStauts')->name('updateStauts');
        });


    // Users
    Route::controller(\App\Http\Controllers\dashboard\UsersController::class)
        ->prefix('users')
        ->as('users.')
        ->group(function () {
            Route::get('/index', 'index')->name('index');

            Route::get('/create', 'create')->name('create');

            Route::post('/store', 'store')->name('store');

            Route::get('/show/{id}', 'show')->name('show');

            Route::get('/edit/{id}', 'edit')->name('edit');

            Route::post('/update', 'update')->name('update');

            Route::post('/destroy/{id}', 'destroy')->name('destroy');

            Route::post('/Stauts/{id}', 'updateStauts')->name('updateStauts');
        });

    Route::controller(ImagesController::class)
        ->prefix('images')
        ->as('image.')
        ->group(function () {
            Route::get('/{model}/{id}', 'index')->name('index');
            Route::get('/{model}/create', 'create')->name('create');
            Route::post('/{model}', 'store')->name('store');
            Route::get('/{model}/{id}/edit', 'edit')->name('edit');
            Route::put('/{model}/{id}', 'update')->name('update');
            Route::delete('/{model}/{id}', 'destroy')->name('delete');
        });

    Route::controller(\App\Http\Controllers\dashboard\SettingController::class)
        ->prefix('setting')
        ->as('setting.')
        ->group(function () {
            Route::get('/global', 'index')->name('global');
            Route::get('/social', 'social')->name('social');
            Route::post('/update', 'update')->name('update');
        });

    Route::controller(\App\Http\Controllers\dashboard\PaymentOptionsController::class)
        ->prefix('payment-options')
        ->as('PaymentOptions.')
        ->group(function () {
            Route::get('/index', 'index')->name('index');

            Route::post('/store', 'store')->name('store');

            Route::post('/destroy/{id}', 'destroy')->name('destroy');
        });

    Route::controller(\App\Http\Controllers\dashboard\OrdersController::class)
        ->prefix('orders')
        ->as('order.')
        ->group(function () {
            Route::get('/index', 'index')->name('index');

            Route::get('/print/{id}', 'print')->name('print');

            Route::post('/destroy/{id}', 'destroy')->name('destroy');
        });
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
], function () {
    Route::get('/forgotPassword' , [\App\Http\Controllers\web\UserController::class , 'forgot_password'])->name('GETforgotPassword');
    Route::post('/forgotPassword' , [\App\Http\Controllers\web\UserController::class , 'forgot_password_email'])->name('forgotPassword');
    Route::get('/resetPassword/{email}' , [\App\Http\Controllers\web\UserController::class , 'reset_password'])->name('GETresetPassword');;
    Route::post('/resetPassword/{user_name}' , [\App\Http\Controllers\web\UserController::class , 'reset_password_user'])->name('resetPassword');
});


