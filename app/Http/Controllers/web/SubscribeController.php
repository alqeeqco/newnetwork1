<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use App\Mail\messageMail;
use App\Models\Mail;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail as sendmail;

class SubscribeController extends Controller
{
//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    function __construct()
//    {
//        $this->middleware('permission:Subscribe-List|Subscribe-Delete', ['only' => ['index','store']]);
//        $this->middleware('permission:Subscribe-Delete', ['only' => ['destroy']]);
//    }

    /**
     * @return Application|Factory|View
     */
    public function fetch(Request $request)
    {
        $subscribes = Subscribe::query()->get();
        if ($request->ajax()) {
            return view('dashboard.subscribe.table-data', compact('subscribes'))->render();
        }
        return view('dashboard.subscribe.index', compact('subscribes'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        Subscribe::create([
            'email' => $request->email,
        ]);

        toastr()->success(__('lang.subscribe_done'));

        return redirect()->back();
    }

    public function destroy($id)
    {
        $subscribe = Subscribe::find($id)->delete();

        return redirect()->back()->with('success', __('lang.subscribe_deleted'));
    }

    public function sendMail(Request $request)
    {
        return view('dashboard.subscribe.create');
    }

    public function create_mail(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'mag' => 'required|min:3',
            'image' => 'nullable|image',
        ]);
        $data = $request->except('image');
        if ($request->file('image')) {
            $name = Str::random(12);
            $path = $request->file('image');
            $name = $name . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image'] = $name;
            $path->move('dashboard/images', $name);
        }
        $mail = Mail::create($data);
        if ($mail){
            $subscribes = Subscribe::get();
            foreach ($subscribes as $key){
                sendmail::to($key->email)->send(new messageMail($mail));
            }
            return redirect()->back()->with('success', __('lang.success'));
        }
        
    }




}
