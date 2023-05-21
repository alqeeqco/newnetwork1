<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\WhyChooseUs;
use App\Repositories\Cart\CartRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(Request $request)
    {
        $favorites = Favorite::query()->with(['user', 'product.colors'])->where('user_id', Auth::user()->id)->get();
        $Why_People_Choose_Us = WhyChooseUs::where('status' , '1')->orderByDesc('id')->get();
        if( $request->ajax() ) {
            return view('web.favorite.table-data', compact('favorites'))->render();
        }

        return view('web.favorite.index', compact('favorites' , 'Why_People_Choose_Us'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return Application|Factory|View
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'product_id' => 'required|exists:products,id',
            ],
        );

        // Check If Product Already Found
        if( Favorite::where('product_id', $request->product_id)->exists() ) {
            toastr()->error('Product Already In Favorite');

            return redirect()->back();
        }

        Favorite::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
        ]);

        toastr()->success('Done');

        return view('web.favorite.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $favorite = Favorite::find($request->id)->delete();
    }
}
