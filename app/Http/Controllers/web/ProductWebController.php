<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Colors;
use App\Models\Favorite;
use App\Models\Images;
use App\Models\Products;
use App\Models\Reviews;
use App\Repositories\Cart\CartRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ProductWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $products_s = Products::with('favorite' , 'colors')->where('status', '1')->whereHas('categories', function ($query) {
            $query->where('status', '1');
        })
            ->when($request->category, function ($q) use ($request) {
                return $q->where('category_id', $request->category);
            })
            ->when($request->color, function ($q) use ($request) {
                $q->whereHas('colors' , function ($query) use ($request){
                    $query->where('id', $request->color);
                });
            })
            ->when($request->price, function ($q) use ($request) {
                $price = explode(' - ', $request->price);
                $q->whereBetween('price', [$price[0], $price[1]]);
            })
            ->when($request->sort_order, function ($q) use ($request) {
                if ($request->sort_order == 'desc') {
                    $q->orderBy('id', 'DESC');
                }
                if ($request->sort_order == 'name') {
                    $q->orderBy('name_' . App::getLocale());
                }
                if ($request->sort_order == 'price') {
                    $q->orderBy('price');
                }
            })
            ->get();
        $min = Products::first();
        $max = Products::orderBy('id', 'desc')->first();
        if ($min || $max) {
            $single_product = Products::where('id', rand($min->id, $max->id))->first();
        } else {
            $single_product = Products::first();
        }
        $cat = Categories::get();
        $colors = Colors::get();
//        return $colors;
        return view('web.product.index', compact('products_s', 'single_product', 'cat' , 'colors'));
    }

    public function product_type(Request $request)
    {
        $min = Products::first();
        $max = Products::orderBy('id', 'desc')->first();
        if ($min || $max) {
            $single_product = Products::where('id', rand($min->id, $max->id))->first();
        } else {
            $single_product = Products::first();
        }
        if ($request->type == 'new') {
            $products_s = Products::with('favorite' , 'colors')->where('status', '1')->where('appear', 'most_recent')->get();
        } elseif ($request->type == 'sold') {
            $products_s = Products::with('favorite' , 'colors')->where('status', '1')->where('appear', 'best_seller')->get();
        } else {
            $products_s = Products::with('favorite' , 'colors')->where('status', '1')->get();
        }

        return view('web.product.product_types', compact('products_s', 'single_product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $product = Products::withSum('reviews', 'rate')->withCount('reviews')->with('favorite' , 'colors' , 'specifications')->find($id);
        if ($product){
            $products_s = Products::where('status', '1')->with('favorite' , 'colors')
                ->whereHas('categories', function ($query) {
                    $query->where('status', '1');
                })->where('category_id', $product->category_id)->take(4)->get();

            $images = Images::where('imageable_id', $product->id)
                ->where('imageable_type', '\App\Models\Products')->get();

            return view('web.product.show', compact('product', 'products_s', 'images'));
        }else{
            return abort(403);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getData(Request $request, $id)
    {
        $product = Products::withSum('reviews', 'rate')->withCount('reviews')->with('colors' , 'favorite' , 'specifications')
            ->with(['imageable' => function ($q) {
                $q->where('imageable_type', '\App\Models\Products');
            }])->find($id);

        return response()->json([
            'product' => $product,
        ]);
    }

    public function add_fav(Request $request)
    {
        $checkFav = Favorite::where('user_id', $request->user_id)->where('product_id', $request->product_id)->first();
        if ($checkFav) {
            $checkFav->delete();
            return "delete Done";
        } else {
            $fav = new Favorite();
            $fav->user_id = $request->user_id;
            $fav->product_id = $request->product_id;
            $fav->save();
            return "add Done";
        }
    }

    public function show_products($id)
    {
        $min = Products::first();
        $max = Products::orderBy('id', 'desc')->first();
        if ($min || $max) {
            $single_product = Products::where('id', rand($min->id, $max->id))->first();
        } else {
            $single_product = Products::first();
        }
        $category = Categories::findOrFail($id);
        if ($category->status == 1) {
            $show_products = Products::with('favorite' , 'colors')->where('category_id', $id)->where('status', '1')->get();
        } else {
            return abort(404);
        }

        return view('web.product.show_products', compact('show_products', 'single_product'));
    }

    public function add_review(Request $request)
    {
        $reviews = Reviews::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->first();
        if ($reviews) {
            $reviews->update([
                'user_id' => Auth::user()->id,
                'product_id' => $request->product_id,
                'rate' => $request->rating
            ]);
            return "done1";
        } else {
            Reviews::create([
                'user_id' => Auth::user()->id,
                'product_id' => $request->product_id,
                'rate' => $request->rating
            ]);
            return "done2";
        }
    }


}
