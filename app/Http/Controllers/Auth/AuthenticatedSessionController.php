<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Carts;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function createAdmin()
    {
        return view('auth.login_admin');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request, CartRepository $cart)
    {
//        return $request->all()
        $user= User::where('email',$request->email)->first();
        if($user){
            if(!$user->isActive()){
                return redirect()->back();
            }
        }
        $request->authenticate();

        $carts = Carts::query()->with('product')
            ->where('cookie_id', $cart->getCookieId())->whereNull('user_id')->get();

        $coupon_exists = Carts::query()->with('product' , 'coupon')
            ->where('cookie_id', $cart->getCookieId())->whereNull('user_id')->first();

        $total = (float)Carts::where('user_id', Auth::id())
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->selectRaw('SUM(products.price * carts.quantity) as total')
            ->value('total');


        if ($coupon_exists) {
            if ($coupon_exists->coupon) {
                $discount = $total * ($coupon_exists->coupon->discount / 100);
            } else {
                $discount = 0;
            }
        } else {
            $discount = 0;
        }

        $total = $total - $discount;

        if( $carts->count() > 0 ) {
            foreach ( $carts as $cart ){
                if( $coupon_exists ) {
                    $cart->update([
                        'user_id' => Auth::user()->id,
                        'coupon_id' => $coupon_exists->coupon_id,
                        'total' => $total
                    ]);
                }else {
                    $cart->update([
                        'user_id' => Auth::user()->id,
                    ]);
                }

            }
        }

        Cookie::queue(Cookie::forget('cart_id'));


        $request->session()->regenerate();


        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAdmin(LoginRequest $request)
    {
        $request->authenticateAdmin();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::ADMIN);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Cookie::queue(Cookie::forget('cart_id'));

        return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyAdmin(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
