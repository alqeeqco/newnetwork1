<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Paymentoptions;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentOptionsController extends Controller
{
    public function index(Request $request)
    {
        $payment_options = Paymentoptions::get();

        if ($request->ajax())
        {
            return view('dashboard.payment_options.table-data' , compact('payment_options'))->render();
        }
        return view('dashboard.payment_options.index', compact('payment_options'));
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),
            [
//                'image' => 'required|mimes:jpg,png.jpeg',
                'image' => 'required',
            ],
            [
                'image.required' => __('lang.image_required'),
                'image.mimes' => __('lang.image_mimes'),
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
        Paymentoptions::create([
            'image' => $data['image'],
        ]);
        return response()->json([
            'success' => 'Done',
        ]);
    }

    public function destroy($id)
    {
        $Paymentoptions = Paymentoptions::find($id)->delete();
        return response()->json([
            'success' => 'Done',
        ]);
    }

}
