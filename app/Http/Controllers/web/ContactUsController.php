<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Contactus;
use App\Models\Products;
use App\Repositories\Cart\CartRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:Contact-List|Contact-Delete', ['only' => ['fetch','destroy']]);
        $this->middleware('permission:City-Delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $min = Products::first();
        $max = Products::orderBy('id', 'desc')->first();
        if ($min || $max){
            $single_product = Products::where('id', rand($min->id, $max->id))->first();
        }else{
            $single_product = Products::first();
        }
        return view('web.contact_us.index', compact('single_product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'phone' => 'required|numeric',
                'email' => 'required|email',
                'message' => 'required|max:250',
            ],
            [
                'name.required' => __('lang.name_required'),
                'phone.required' => __('lang.phone_required'),
                'phone.numeric' => __('lang.phone_numeric'),
                'email.required' => __('lang.email_required'),
                'email.email' => __('lang.email_email'),
                'message.required' => __('lang.message_required'),
                'message.max' => __('lang.message_max'),
            ]
        );

        Contactus::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        toastr()->success(__('lang.contact_us_done'));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $contact = Contactus::find($id)->delete();

        return redirect()->back()->with('success', __('lang.message_deleted'));
    }

    /**
     * @return Application|Factory|View
     * ? Index Page In Dashboard
     */
    public function fetch()
    {
        $contacts = Contactus::query()->get();
        return view('dashboard.contact_us.index', compact('contacts'));
    }

}
