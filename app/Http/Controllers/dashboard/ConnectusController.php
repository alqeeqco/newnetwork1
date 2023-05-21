<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contactus;
use Illuminate\Http\Request;

class ConnectusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
//        $this->middleware('permission:Contact-List|Contact-Delete', ['only' => ['index','store']]);
//        $this->middleware('permission:City-Delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contacts = Contactus::get();
        if ($request->ajax())
        {
            return view('dashboard.contact_us.table-data' , compact('contacts'))->render();
        }
        return view('dashboard.contact_us.index' , compact('contacts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contactus::find($id)->delete();
        return redirect()->route('contact.index')->with('success', __('lang.delete'));
    }
}
