<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolesPermission;
use App\Models\Setting;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RoleController extends Controller
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
        if (in_array(3, $rolespermission)) {
            if ($request->ajax()) {
                $data = Role::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('permissions', function ($row) {
                        $permissions = RolesPermission::where('role_id', $row->id)->get();
                        $perm = '';
                        foreach ($permissions as $permission) {
                            $permissi = Permission::where('id', $permission->permission_id)->first();
                            $perm .= '<span class="badge bg-green">' . $permissi->permission . '</span>' . ' ';
                        }
                        return $perm;
                    })
                    ->addColumn('action', function ($row) {
                        $editurl = route('roles.edit', $row->id);
                        $deleteurl = route('roles.destroy', $row->id);
                        $csrf_token = csrf_token();
                        $btn = "<a href='$editurl' class='edit btn btn-primary btn-sm mb-1'>Edit</a>
                        <form action='$deleteurl' method='POST' style='display:inline;'>
                        <input type='hidden' name='_token' value='$csrf_token'>
                        <input type='hidden' name='_method' value='DELETE' />
                            <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                        </form>
                        ";

                        return $btn;
                    })
                    ->rawColumns(['permissions', 'action'])
                    ->make(true);
            }
            $setting = Setting::first();
            return view('backend.roles.index', compact('setting'));
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
        if (in_array(3, $rolespermission)) {
            $permissions = Permission::latest()->get();
            $setting = Setting::first();
            return view('backend.roles.create', compact('permissions', 'setting'));
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
            'name' => 'required|string',
            'permissions' => 'required',
            'permissions.' => 'integer',
        ]);

        $slug = Str::slug($data['name']);
        $role = Role::create([
            'name' => $data['name'],
            'slug' => $slug,
        ]);
        $permissions = $data['permissions'];
        foreach ($permissions as $permission) {
            $role->permissions()->attach($permission);
        }
        $role->save();
        return redirect()->route('roles.index')->with('success', 'Role Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles_permission = RolesPermission::where('role_id', Auth::user()->role_id)->get();
        $rolespermission = [];
        foreach ($roles_permission as $rolepermission) {
            array_push($rolespermission, $rolepermission->permission_id);
        }
        if (in_array(3, $rolespermission)) {
            $role = Role::findorfail($id);
            $permissions = Permission::all();
            $roles_permissions = RolesPermission::where('role_id', $id)->get();
            $selectedperm = array();
            foreach ($roles_permissions as $rolepermission) {
                $selectedperm[] = $rolepermission->permission_id;
            }
            $setting = Setting::first();
            return view('backend.roles.edit', compact('role', 'permissions', 'selectedperm', 'setting'));
        } else {
            return view('backend.permissions.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findorfail($id);
        $data = $this->validate($request, [
            'name' => 'required|string',
            'permissions' => 'required',
            'permissions.' => 'integer',
        ]);

        $slug = Str::slug($data['name']);
        $role->update([
            'name' => $data['name'],
            'slug' => $slug,
        ]);
        $permissions = $data['permissions'];
        $perm = array();
        foreach ($permissions as $permission) {
            $perm[] = $permission;
            $role->permissions()->sync($perm);
        }
        $role->save();
        return redirect()->route('roles.index')->with('success', 'Role Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roles_permission = RolesPermission::where('role_id', Auth::user()->role_id)->get();
        $rolespermission = [];
        foreach ($roles_permission as $rolepermission) {
            array_push($rolespermission, $rolepermission->permission_id);
        }
        if (in_array(3, $rolespermission)) {
            $role = Role::findorFail($id);
            $role->delete();
            return redirect()->route('roles.index')->with('success', 'Role Deleted Successfully.');
        } else {
            return view('backend.permissions.permission');
        }
    }
}
