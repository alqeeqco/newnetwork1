<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {

//        $products = Products::tableFilters()->get();

        $products = Products::query()->with('favorite' , 'colors');
        if (request()->input('name_en', false)) {
            $queryString = request()->input('name_en', false);
            $products->where('name_en', 'LIKE', "%$queryString%")->limit(2);
        }

        if ( $request->ajax() )
        {
            return view('components.search' , compact('products'))->render();
        }
    }
}
