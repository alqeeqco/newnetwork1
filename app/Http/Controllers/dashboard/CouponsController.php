<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Coupons;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:Coupons-List|Coupons-Create|Coupons-Edit|Coupons-Delete', ['only' => ['index','store']]);
        $this->middleware('permission:Coupons-Create', ['only' => ['create','store']]);
        $this->middleware('permission:Coupons-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Coupons-Delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        return \Illuminate\Support\Carbon::now()->addYears()->format('Y-m-d\TH:i');
        $coupons = Coupons::get();
        if ($request->ajax())
        {
            return view('dashboard.Coupons.table-data' , compact('coupons'))->render();
        }
        return view('dashboard.Coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.Coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate(Coupons::$rules);
        $coupons = new Coupons();
        $coupons->code = $request->code;
        $coupons->discount = $request->discount;
        $coupons->minimum = $request->minimum;
        $coupons->maximum = $request->maximum;
        $coupons->end_at = $request->end_at;
        if ($request->status == 'on') {
            $coupons->status = 1;
        } else {
            $coupons->status = 0;
        }
        $coupons->save();
        return redirect()->route('coupons.index')->with('success', __('lang.success'));
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
        $coupons = Coupons::find($id);
        return view('dashboard.Coupons.edite', compact('coupons'));
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

        $validator = $request->validate(Coupons::$rules);
        $coupons = Coupons::find($request->id);
        $coupons->code = $request->code;
        $coupons->discount = $request->discount;
        $coupons->minimum = $request->minimum;
        $coupons->maximum = $request->maximum;
        $coupons->end_at = $request->end_at;
        if ($request->status == 'on') {
            $coupons->status = 1;
        } else {
            $coupons->status = 0;
        }
        $coupons->update();
        return redirect()->route('coupons.index')->with('success', __('lang.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupons = Coupons::find($id)->delete();
        return redirect()->route('coupons.index')->with('success', __('lang.delete'));
    }

    public function updateStauts($id)
    {
        $coupons = Coupons::find($id);
        if ($coupons->status == '1' ){
            $coupons->update(['status' => 0]);

        }else{
            $coupons->update(['status' => 1]);

        }
        return redirect()->route('coupons.index');
    }

}
