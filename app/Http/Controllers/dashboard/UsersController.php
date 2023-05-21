<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        $users = User::with('address.cities.countries')->where('id' , 1)->get();
//        return $users;
        $users = User::get();
        if ($request->ajax()) {
            return view('dashboard.Users.table-data', compact('users'))->render();
        }
        return view('dashboard.Users.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('address.cities.countries')->where('id' , $id)->first();

        return view('dashboard.Users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities = Cities::get();
        $users = User::find($id);
        return view('dashboard.Users.edite', compact('users' , 'cities'));
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
//        return $request->all();
        $user = User::find($request->id);
        if ($request->file('avatar')) {
            $name = Str::random(12);
            $path = $request->file('avatar');
            $name = $name . time() . '.' . $request->file('avatar')->getClientOriginalExtension();
            $data['avatar'] = $name;
            $path->move('dashboard/images', $name);
        }
        if ($request->status == 'on') {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        $data['first_name'] = $request->first_name;
        $user['last_name'] = $request->last_name;
        $user['user_name'] = $request->user_name;
        $user['email'] = $request->email;
        $user['id_city'] = $request->id_city;
        $user->update($data);
        return redirect()->route('users.index')->with('success', __('lang.success'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();
    }


    public function updateStauts($id)
    {
        $user = User::find($id);
        if ($user->status == '1') {
            $user->update(['status' => 0]);

        } else {
            $user->update(['status' => 1]);
        }
    }
}
