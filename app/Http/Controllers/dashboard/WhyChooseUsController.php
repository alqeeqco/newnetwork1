<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WhyChooseUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $whychooseus = WhyChooseUs::get();
        if ($request->ajax()) {
            return view('dashboard.WhyChooseUs.table-data', compact('whychooseus'))->render();
        }
        return view('dashboard.WhyChooseUs.index', compact('whychooseus'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.WhyChooseUs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate(WhyChooseUs::$rules);
//        $validator = Validator::make($request->all(), WhyChooseUs::$rules);


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
        WhyChooseUs::create($data);
        return redirect()->route('whychooseus.index')->with('success', __('lang.success'));
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
        $whychooseus = WhyChooseUs::find($id);
        return view('dashboard.WhyChooseUs.edite', compact('whychooseus'));
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
        $validator = $request->validate(WhyChooseUs::$rules2);
        $whychooseus = WhyChooseUs::find($request->id);
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
        $whychooseus->update($data);
        return redirect()->route('whychooseus.index')->with('success', __('lang.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $whychooseus = WhyChooseUs::find($id)->delete();
        return redirect()->route('whychooseus.index')->with('success', __('lang.delete'));
    }

    public function updateStauts($id)
    {
        $whychooseus = WhyChooseUs::find($id);
        if ($whychooseus->status == '1') {
            $whychooseus->update(['status' => 0]);

        } else {
            $whychooseus->update(['status' => 1]);

        }
        return redirect()->route('whychooseus.index');
    }

}
