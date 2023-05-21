<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Images;
use App\Models\Products;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request, $model, $id)
    {
//        $object = DB::table($model)->where('id', $id)->first();
        $object = Products::where('id', $id)->first();

//        $images = Images::query()->with('imageable')
//            ->where('imageable_type', '\App\Models\\'.$model)
//            ->where('imageable_id', $id)->get();
        $images = Images::where('imageable_id', $object->id)
            ->where('imageable_type', '\App\Models\Products')->get();

        if( $request->ajax() ) {
            return view('dashboard.images.table-data', compact('object', 'images'))->render();
        }

        return view('dashboard.images.index', compact('object', 'images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($model)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $model)
    {
        $validator = \Validator::make($request->all(),
            [
                'image' => 'required',
            ],
            [
                'image.required' => __('lang.image_required'),
            ]
        );

        if( $validator->fails() ) {
            return response()->json([
                'errors' => $validator->errors()->all(),
            ]);
        }

        $data = $request->except('image');
        if ($request->file('image')) {
            $name = Str::random(12);
            $path = $request->file('image');
            $name = $name . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image'] = $name;
            $path->move('dashboard/images', $name);
        }

        Images::create([
            'image' => $data['image'],
            'imageable_id' => $request->imageable_id,
            'imageable_type' => '\App\Models\\'.$model,
        ]);

        return response()->json([
            'success' => 'Done',
        ]);

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
    public function edit($model, $id)
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
    public function update(Request $request, $model, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $model, $id)
    {
        $image = Images::find($request->id)->delete();

        return response()->json([
            'success' => 'Done',
        ]);
    }
}
