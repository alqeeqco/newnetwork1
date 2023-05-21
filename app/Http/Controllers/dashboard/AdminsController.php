<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admins;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
//        $this->middleware('permission:Admins-List|Admins-Create|Admins-Edit|Admins-Delete', ['only' => ['index','store']]);
//        $this->middleware('permission:Admins-Create', ['only' => ['create','store']]);
//        $this->middleware('permission:Admins-Edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:Admins-Delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(Request $request)
    {
        $admins = Admins::where('id', '!=', Auth::user()->id)->where('id', '!=', 1)->get();

        if ($request->ajax()) {
            return view('dashboard.admins.table-data', compact('admins'))->render();
        }

        return view('dashboard.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $roles = Role::all();
        return view('dashboard.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:admins,email',
                'password' => 'required|min:8',
                'avatar' => 'nullable|mimes:jpeg,png,jpg',
            ],
            [
                'name.required' => __('lang.name_required'),
                'email.required' => __('lang.email_required'),
                'email.email' => __('lang.email_email'),
                'password.required' => __('lang.password_required'),
                'password.min' => __('lang.password_min'),
                'avatar.mimes' => __('lang.avatar_mimes'),
            ]);

        $data = $request->except('avatar');
        if ($request->file('avatar')) {
            $name = Str::random(12);
            $path = $request->file('avatar');
            $name = $name . time() . '.' . $request->file('avatar')->getClientOriginalExtension();
            $data['avatar'] = $name;
            $path->move('dashboard/images', $name);
        }

        if ($request->status) {
            $data['status'] = '1';
        } elseif (!$request->status) {
            $data['status'] = '0';
        }

        if ($request->password) {
            $password = Hash::make($request->password);
            $data['password'] = $password;
        }

        $admin = Admins::create($data);

        $admin->assignRole($request->input('role'));

        return redirect()->route('admin.index')->with('success', __('lang.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $admin = Admins::find($id);
        $roles = Role::all();
        $userRole = $admin->roles->pluck('name', 'name')->all();
        return view('dashboard.admins.edit', compact('admin', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = Admins::find($id);

        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'nullable|min:8',
                'avatar' => 'nullable|mimes:jpeg,png,jpg',
            ],
            [
                'name.required' => __('lang.name_required'),
                'email.required' => __('lang.email_required'),
                'email.email' => __('lang.email_email'),
                'password.min' => __('lang.password_min'),
                'avatar.mimes' => __('lang.avatar_mimes'),
            ]);

        $data = $request->except('avatar');
        if ($request->file('avatar')) {
            $name = Str::random(12);
            $path = $request->file('avatar');
            $name = $name . time() . '.' . $request->file('avatar')->getClientOriginalExtension();
            $data['avatar'] = $name;
            $path->move('dashboard/images', $name);
        }

        if ($request->password) {
            $password = Hash::make($request->password);
            $data['password'] = $password;
        } else {
            $data = $request->except('password');
        }

        if ($request->status) {
            $data['status'] = '1';
        } elseif (!$request->status) {
            $data['status'] = '0';
        }

        $admin->update($data);

        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $admin->assignRole($request->input('role'));

        return redirect()->route('admin.index')->with('success', __('lang.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $admin = Admins::find($id);

        if( $admin->id == 1 ) {
            return redirect()->route('admin.index')->with('error', 'This Admin Can Not Deleted');
        }

        $admin->delete();

        return redirect()->route('admin.index')->with('success', __('lang.success'));
    }

    public function changeStatus($id)
    {
        $admin = Admins::find($id);
        if ($admin->status == 1) {
            $admin->update(['status' => '0']);
        } elseif ($admin->status == '0') {
            $admin->update(['status' => '1']);
        }
    }


    public function edit_admin()
    {
        $id = auth()->user()->id;
        $admin = Admins::find($id);

        return view('dashboard.users_admin.edit', compact('admin'));
    }

    public function update_admin(Request $request)
    {
        $id = $request->id;

        $rules = [
            'email' => 'required|email|unique:users,email,' . $id,
        ];
        $validation = $request->validate($rules);
        $admin = Admins::find($id);
        $admin->update($request->all());
        session()->flash('success', __('lang.success'));
        return redirect(App::getLocale().'/admin/dashboard');
    }

    public function reset_Password()
    {
        $id = auth()->user()->id;
        $admin = Admins::find($id);
        return view('dashboard.users_admin.reset_password', compact('admin'));
    }

    public function resetPassword(Request $request)
    {
        $rules = [
            'old_password' => 'required|min:3',
            'new_password' => 'required|min:3',
            'confirm_password' => 'required|min:3|same:new_password',
        ];

        $validated = $request->validate($rules);

        $admin = auth()->user();
        if (!Hash::check($request->get('old_password'), $admin->password)) {
            $message = __('api.old_password'); //wrong old
            session()->flash('error', __('lang.error'));
            return redirect()->back();
        }
        $admin->password = bcrypt($request->get('new_password'));
        $data = $admin->save();
        session()->flash('success', __('lang.success'));
        return redirect(App::getLocale().'/admin/dashboard');
    }
}
