<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'branch' => 'required|max:250',
                'call_date' => 'required|max:250',
                'phone_nmuber' => 'required|numeric',
            ],[
                'branch.required' => __('lang.branch_required'),
                'branch.max' => __('lang.branch_max'),
                'phone_nmuber.required' => __('lang.phone_required'),
                'phone_nmuber.numeric' => __('lang.phone_numeric'),
                'call_date.required' => __('lang.call_date_required'),
                'call_date.max   ' => __('lang.call_date_max'),
            ]
        );
        Appointment::create($request->all());
        toastr()->success(__('lang.appointment_done'));
        return redirect()->back();
    }
}
