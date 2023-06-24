<?php

namespace App\Http\Controllers\dashboard;

use App\Exports\AppointmentsExport;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $appointments = Appointment::get();
        if ($request->ajax()) {
            return view('dashboard.Appointment.table-data', compact('appointments'))->render();
        }
        return view('dashboard.Appointment.index', compact('appointments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proposal = Appointment::find($id);
        if($proposal) {
            $proposal->delete();
        }
        return redirect()->route('admin.index')->with('success', __('lang.success'));
    }

    public function export()
    {
        return Excel::download(new AppointmentsExport, 'Appointments.xlsx');
    }
}
