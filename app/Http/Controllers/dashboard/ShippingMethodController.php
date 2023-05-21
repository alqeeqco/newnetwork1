<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Countries;
use App\Models\Shippingoptions;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShippingMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $shippingoptions = Shippingoptions::with('Countries')->get();
        if ($request->ajax())
        {
            return view('dashboard.Shippingoptions.table-data' , compact('shippingoptions'))->render();
        }
        return view('dashboard.Shippingoptions.index', compact('shippingoptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Countries::get();
        return view('dashboard.Shippingoptions.create' , compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate(Shippingoptions::$rules);
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
//        return $request->all();
        Shippingoptions::create($data);
        return redirect()->route('shippingoptions.index')->with('success', __('lang.success'));
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
        $shippingoptions = Shippingoptions::find($id);
        $countries = Countries::get();
        return view('dashboard.Shippingoptions.edite', compact('shippingoptions' , 'countries'));
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

        $validator = $request->validate(Shippingoptions::$rules2);
        $country = Shippingoptions::find($request->id);
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
        $data['first_cleo'] = $request->first_cleo;
//        return $data;
        $country->update($data);
        return redirect()->route('shippingoptions.index')->with('success', __('lang.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Shippingoptions::find($id)->delete();
        return redirect()->route('shippingoptions.index')->with('success', __('lang.delete'));
    }

    public function updateStauts($id)
    {
        $country = Shippingoptions::find($id);
        if ($country->status == '1') {
            $country->update(['status' => 0]);

        } else {
            $country->update(['status' => 1]);

        }
        return redirect()->route('shippingoptions.index');
    }

}
