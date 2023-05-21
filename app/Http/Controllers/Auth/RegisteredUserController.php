<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repositories\Cart\CartRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, CartRepository $cart)
    {
        $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        $carts = Carts::query()->with('product')
            ->where('cookie_id', $cart->getCookieId())->whereNull('user_id')->get();

        $coupon_exists = Carts::query()->with('product', 'coupon')
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

        if ($carts->count() > 0) {
            foreach ($carts as $cart) {
                if ($coupon_exists) {
                    $cart->update([
                        'user_id' => Auth::user()->id,
                        'coupon_id' => $coupon_exists->coupon_id,
                        'total' => $total
                    ]);
                } else {
                    $cart->update([
                        'user_id' => Auth::user()->id,
                    ]);
                }

            }
        }

        Cookie::forget('cart_id');

        return redirect(RouteServiceProvider::HOME);
    }
}
