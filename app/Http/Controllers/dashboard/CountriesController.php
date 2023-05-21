<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Countries;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:Country-List|Country-Create|Country-Edit|Country-Delete', ['only' => ['index','store']]);
        $this->middleware('permission:Country-Create', ['only' => ['create','store']]);
        $this->middleware('permission:Country-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Country-Delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $countries = Countries::get();
        if ($request->ajax())
        {
            return view('dashboard.Countries.table-data' , compact('countries'))->render();
        }
        return view('dashboard.Countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.Countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request->all();
        $validator = $request->validate(Countries::$rules);
//        $validator = Validator::make($request->all(), Countries::$rules);

        $Countries = new Countries();
        $Countries->name_ar = $request->name_ar;
        $Countries->name_en = $request->name_en;
        if ($request->status == 'on') {
            $Countries->status = 1;
        } else {
            $Countries->status = 0;
        }
        $Countries->save();
        return redirect()->route('countries.index')->with('success', __('lang.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Countries::find($id);
        return view('dashboard.Countries.edite', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $validator = $request->validate(Countries::$rules);
        $country = Countries::find($request->id);
        $country->name_ar = $request->name_ar;
        $country->name_en = $request->name_en;
        if ($request->status == 'on') {
            $country->status = 1;
        } else {
            $country->status = 0;
        }
        $country->update();
        return redirect()->route('countries.index')->with('success', __('lang.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Countries::find($id)->delete();
        return redirect()->route('countries.index')->with('success', __('lang.delete'));
    }

    public function updateStauts($id)
    {
        $country = Countries::find($id);
        if ($country->status == '1' ){
            $country->update(['status' => 0]);

        }else{
            $country->update(['status' => 1]);

        }
        return redirect()->route('countries.index');
    }

}
