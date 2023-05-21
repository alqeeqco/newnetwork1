<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:Ads-List|Ads-Create|Ads-Edit|Ads-Delete', ['only' => ['index','store']]);
        $this->middleware('permission:Ads-Create', ['only' => ['create','store']]);
        $this->middleware('permission:Ads-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Ads-Delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Ads = Ads::get();
        if ($request->ajax()) {
            return view('dashboard.Ads.table-data', compact('Ads'))->render();
        }
        return view('dashboard.Ads.index', compact('Ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.Ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate(Ads::$rules);
        $data = $request->except('image');
        if ($request->file('image')) {
            $name = Str::random(12);
            $path = $request->file('image');
            $name = $name . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image'] = $name;
            $path->move('dashboard/images', $name);
        }
        if ($request->status == 'on') {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        Ads::create($data);
        return redirect()->route('ads.index')->with('success', __('lang.success'));
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

        $Ads = Ads::find($id);

        return view('dashboard.Ads.edite', compact('Ads'));

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
        $validator = $request->validate(Ads::$rules2);
        $Ads = Ads::find($request->id);
        $data = $request->except('image');
        if ($request->file('image')) {
            $name = Str::random(12);
            $path = $request->file('image');
            $name = $name . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image'] = $name;
            $path->move('dashboard/images', $name);
        }
        if ($request->status == 'on') {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        $Ads->update($data);
        return redirect()->route('ads.index')->with('success', __('lang.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Ads = Ads::find($id);
        if ($Ads) {
            $Ads->delete();
            return response()->json([
                'message' => __('lang.delete'),
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function updateStauts($id)
    {
        $Ads = Ads::find($id);
        if ($Ads->status == '1') {
            $Ads->update(['status' => 0]);

        } else {
            $Ads->update(['status' => 1]);

        }
        return redirect()->route('ads.index');
    }
}
