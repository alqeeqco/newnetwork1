<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ColorsController extends Controller
{
    public function index(Request $request)
    {
        $cities = Cities::with('countries')->get();

        if ($request->ajax())
        {
            return view('dashboard.Cities.table-data' , compact('cities'))->render();
        }
        return view('dashboard.Cities.index', compact('cities'));
    }
}
