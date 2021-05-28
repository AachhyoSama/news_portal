<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\RolesPermission;
use App\Models\Setting;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PermissionController extends Controller
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
        if (in_array(2, $rolespermission)) {
            if ($request->ajax()) {
                $data = Permission::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {

                        $editurl = route('permission.edit', $row->id);
                        $deleteurl = route('permission.destroy', $row->id);

                        $csrf_token = csrf_token();

                        $btn = "<a href='$editurl' class='edit btn btn-primary btn-sm'>Edit</a>
                            <form action='$deleteurl' method='POST' style='display:inline-block;'>
                                <input type='hidden' name='_token' value='$csrf_token'>
                                <input type='hidden' name='_method' value='DELETE' />
                                    <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                            </form>";

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            $setting = Setting::first();
            return view('backend.permissions.index', compact('setting'));
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
        if (in_array(2, $rolespermission)) {
            $setting = Setting::first();
            return view('backend.permissions.create', compact('setting'));
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
            'permission' => 'required'
        ]);

        $new_permission = Permission::create([
            'permission' => $data['permission'],
            'slug' => Str::slug($data['permission'])
        ]);

        $new_permission->save();
        return redirect()->route('permission.index')->with('success', 'Permission is saved successfully.');
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
        if (in_array(2, $rolespermission)) {
            $permission = Permission::findorFail($id);
            $setting = Setting::first();
            return view('backend.permissions.edit', compact('permission', 'setting'));
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
    public function update(Request $request, $id)
    {
        $existing_permission = Permission::findorFail($id);
        $data = $this->validate($request, ['permission' => 'required']);

        $existing_permission->update([
            'permission' => $data['permission'],
            'slug' => Str::slug($data['permission'])
        ]);

        return redirect()->route('permission.index')->with('success', 'Permission information updated successfully.');
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
        if (in_array(2, $rolespermission)) {
            $permission = Permission::findorFail($id);
            $permission->delete();
            return redirect()->route('permission.index')->with('success', 'Permission information deleted successfully.');
        } else {
            return view('backend.permissions.permission');
        }
    }
}
