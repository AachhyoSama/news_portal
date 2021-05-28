<?php

namespace App\Http\Controllers;

use App\Models\RolesPermission;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles_permission = RolesPermission::where('role_id', Auth::user()->role_id)->get();
        $rolespermission = [];
        foreach ($roles_permission as $rolepermission) {
            array_push($rolespermission, $rolepermission->permission_id);
        }
        if (in_array(8, $rolespermission)) {
            $setting = Setting::first();
            return view('backend.settings.index', compact('setting'));
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $data = $this->validate($request, [
            'sitename' => 'required',
            'siteImage' => 'mimes:jpg,png,jpeg',
            'siteLogo' => 'mimes:jpeg,png,jpg',
            'facebook' => 'nullable',
            'linkedin' => 'nullable',
            'youtube' => 'nullable',
            'instagram' => 'nullable',
            'aboutus' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);

        $siteimage = '';
        if ($request->hasFile('siteImage')) {
            Storage::disk('uploads')->delete($setting->siteImage);
            $siteimage = $request->file('siteImage')->store('setting_images', 'uploads');
        } else {
            $siteimage = $setting->siteImage;
        }

        $sitelogo = '';
        if ($request->hasFile('siteLogo')) {
            Storage::disk('uploads')->delete($setting->siteLogo);
            $sitelogo = $request->file('siteLogo')->store('setting_logo', 'uploads');
        } else {
            $sitelogo = $setting->siteLogo;
        }

        $setting->update([
            'sitename' => $data['sitename'],
            'siteImage' => $siteimage,
            'siteLogo' => $sitelogo,
            'facebook' => $data['facebook'],
            'linkedin' => $data['linkedin'],
            'youtube' => $data['youtube'],
            'instagram' => $data['instagram'],
            'aboutus' => $data['aboutus'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email'],
        ]);

        return redirect()->route('settings.index')->with('success', 'Settings information updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
