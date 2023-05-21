<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Categories;
use App\Models\Favorite;
use App\Models\Products;
use App\Models\Reviews;
use App\Models\WhyChooseUs;
use App\Repositories\Cart\CartInterface;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index()
    {
        $products_first_home_page = Products::withSum('reviews' , 'rate')->withCount('reviews')
            ->with('reviews.user')->whereHas('categories' , function ($query){
            $query->where('status' , '1');
        })->where('appear' , 'first_home_page')->where('status' , '1')->orderByDesc('id')
            ->take(4)->get();
    //    return $products_first_home_page;
        $cart = new CartRepository();

        $categories = Categories::where('status' , '1')->orderByDesc('id')->get();

        $single_product = Products::where('appear' , 'only_product')->whereHas('categories' , function ($query){
            $query->where('status' , '1');
        })->where('status' , '1')->orderByDesc('id')->first();

        $products_s = Products::withSum('reviews' , 'rate')->withCount('reviews')->with('favorite')
            ->whereHas('categories' , function ($query){
                $query->where('status' , '1');
            })->where('appear' , '!=' , 'only_product')->where('appear' , '!=' , 'most_recent')->where('appear' , '!=' , 'best_seller')->where('status' , '1')->orderByDesc('id')->take(8)->get();
//        return $products_s;

        $products_most_recent = Products::withSum('reviews' , 'rate')->with('favorite' , 'colors')
            ->withCount('reviews')->where('appear' , 'most_recent')
            ->whereHas('categories' , function ($query){
                $query->where('status' , '1');
            })->where('status' , '1')->orderByDesc('id')->get();

        $products_best_seller = Products::withSum('reviews' , 'rate')->with('favorite')->withCount('reviews')->whereHas('categories' , function ($query){
            $query->where('status' , '1');
        })->where('appear' , 'best_seller')
            ->where('status' , '1')->orderByDesc('id')->get();

        $ads = Ads::where('status' , '1')->orderByDesc('id')->take(2)->get();

        $Why_People_Choose_Us = WhyChooseUs::where('status' , '1')->orderByDesc('id')->get();

        return view('web.home', compact('products_s', 'cart', 'categories'
            , 'products_first_home_page' , 'single_product' ,
            'products_most_recent' , 'products_best_seller' ,
            'Why_People_Choose_Us' , 'ads'));
    }
}
