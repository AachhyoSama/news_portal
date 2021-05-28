<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RolesPermission;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles_permission = RolesPermission::where('role_id', Auth::user()->role_id)->get();
        $rolespermission = [];
        foreach ($roles_permission as $rolepermission) {
            array_push($rolespermission, $rolepermission->permission_id);
        }
        if (in_array(1, $rolespermission)) {
            if ($request->ajax()) {
                $data = User::latest()->get();

                return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('role', function ($row) {
                        $role = $row->role_id;
                        if ($role == 1) {
                            $role = "Admin";
                        } else {
                            $role = "Editor";
                        }
                        return $role;
                    })
                    ->addColumn('action', function ($row) {

                        $editurl = route('user.edit', $row->id);
                        $deleteurl = route('user.destroy', $row->id);

                        $csrf_token = csrf_token();

                        $btn = "<a href='$editurl' class='edit btn btn-primary btn-sm'>Edit</a>
                                    <form action='$deleteurl' method='POST' style='display:inline-block;'>
                                        <input type='hidden' name='_token' value='$csrf_token'>
                                        <input type='hidden' name='_method' value='DELETE' />
                                            <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                    </form>";

                        return $btn;
                    })
                    ->rawColumns(['role', 'action'])
                    ->make(true);
            }

            $setting = Setting::first();
            return view('backend.users.index', compact('setting'));
        } else {
            return view('backend.permissions.permission');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles_permission = RolesPermission::where('role_id', Auth::user()->role_id)->get();
        $rolespermission = [];
        foreach ($roles_permission as $rolepermission) {
            array_push($rolespermission, $rolepermission->permission_id);
        }
        if (in_array(1, $rolespermission)) {
            $roles = Role::all();
            $setting = Setting::first();
            return view('backend.users.create', compact('roles', 'setting'));
        } else {
            return view('backend.permissions.permission');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'role' => 'required',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => $data['role'],
        ]);

        $user->save();

        return redirect()->route('user.index')->with('success', 'New User added successfully.');
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
    public function edit($id)
    {
        $roles_permission = RolesPermission::where('role_id', Auth::user()->role_id)->get();
        $rolespermission = [];
        foreach ($roles_permission as $rolepermission) {
            array_push($rolespermission, $rolepermission->permission_id);
        }
        if (in_array(1, $rolespermission)) {
            $user = User::findorFail($id);
            $roles = Role::all();
            $setting = Setting::first();
            return view('backend.users.edit', compact('user', 'roles', 'setting'));
        } else {
            return view('backend.permissions.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        if (isset($_POST['submitdetails'])) {
            $data = $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                'role' => 'required',
            ]);
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'role_id' => $data['role'],
            ]);

            return redirect()->route('user.index')->with('success', 'User information updated successfully.');
        } else if (isset($_POST['submitpassword'])) {
            $data = $this->validate($request, [
                'oldpassword' => 'required',
                'password' => 'required|min:8|confirmed|different:oldpassword',
            ]);

            if (Hash::check($data['oldpassword'], $user->password)) {
                if (!Hash::check($data['password'], $user->password)) {
                    $new_password = Hash::make($data['password']);

                    $user->update([
                        'password' => $new_password,
                    ]);

                    return redirect()->route('user.index')->with('success', 'User password updated successfully.');
                } else {
                    session()->flash('success', 'Password cannot be old password.');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roles_permission = RolesPermission::where('role_id', Auth::user()->role_id)->get();
        $rolespermission = [];
        foreach ($roles_permission as $rolepermission) {
            array_push($rolespermission, $rolepermission->permission_id);
        }
        if (in_array(1, $rolespermission)) {
            $user = User::findorFail($id);
            $user->delete();
            return redirect()->back()->with('success', 'User information deleted successfully.');
        } else {
            return view('backend.permissions.permission');
        }
    }
}
