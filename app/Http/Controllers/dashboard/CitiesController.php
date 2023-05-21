<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\Countries;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:City-List|City-Create|City-Edit|City-Delete', ['only' => ['index','store']]);
        $this->middleware('permission:City-Create', ['only' => ['create','store']]);
        $this->middleware('permission:City-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:City-Delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cities = Cities::with('countries')->get();

        if ($request->ajax())
        {
            return view('dashboard.Cities.table-data' , compact('cities'))->render();
        }
        return view('dashboard.Cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Countries::get();
        return view('dashboard.Cities.create' , compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate(Cities::$rules);
//        $validator = Validator::make($request->all(), Cities::$rules);


        $cities = new Cities();
        $cities->name_ar = $request->name_ar;
        $cities->name_en = $request->name_en;
        $cities->id_country = $request->id_country;
        if ($request->status == 'on') {
            $cities->status = 1;
        } else {
            $cities->status = 0;
        }
        $cities->save();
        return redirect()->route('cities.index')->with('success', __('lang.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request , $id)
    {
        $cities = Cities::with('countries')->where('id_country' , $id)->get();
        if ($request->ajax())
        {
            return view('dashboard.Cities.table-data' , compact('cities'))->render();
        }
        return view('dashboard.Cities.show', compact('cities' , 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Countries::get();
        $city = Cities::find($id);
        return view('dashboard.Cities.edite', compact('city' , 'country'));
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

        $validator = $request->validate(Cities::$rules);
        $city = Cities::find($request->id);
        $city->name_ar = $request->name_ar;
        $city->name_en = $request->name_en;
        $city->id_country = $request->id_country;
        if ($request->status == 'on') {
            $city->status = 1;
        } else {
            $city->status = 0;
        }
        $city->update();
        return redirect()->route('cities.index')->with('success', __('lang.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = Cities::find($id)->delete();
        return redirect()->route('cities.index')->with('success', __('lang.delete'));
    }

    public function updateStauts($id)
    {
        $city = Cities::find($id);
        if ($city->status == '1' ){
            $city->update(['status' => 0]);

        }else{
            $city->update(['status' => 1]);

        }
        return redirect()->route('cities.index');
    }

}
