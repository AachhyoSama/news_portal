<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\RolesPermission;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends Controller
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
        if (in_array(7, $rolespermission)) {
            $advertisement = Advertisement::first();
            $setting = Setting::first();
            return view('backend.advertisements.index', compact('advertisement', 'setting'));
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
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show(Advertisement $advertisement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertisement $advertisement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertisement $advertisement)
    {
        $data = $this->validate($request, [
            'homepage_header_image' => 'mimes:jpg,jpeg,png',
            'homepage_header_url' => 'required',
            'homepage_sidebar_image' => 'mimes:jpg,jpeg,png',
            'homepage_sidebar_url' => 'required',
            'homepage_bottom_image' => 'mimes:jpg,jpeg,png',
            'homepage_bottom_url' => 'required',

            'singlepage_header_image' => 'mimes:jpg,jpeg,png',
            'singlepage_header_url' => 'required',
            'singlepage_sidebar_image' => 'mimes:jpg,jpeg,png',
            'singlepage_sidebar_url' => 'required',
            'singlepage_bottom_image' => 'mimes:jpg,jpeg,png',
            'singlepage_bottom_url' => 'required',
        ]);

        $homepage_header_image = '';
        if ($request->hasFile('homepage_header_image')) {
            Storage::disk('uploads')->delete($advertisement->homepage_header_image);
            $homepage_header_image = $request->file('homepage_header_image')->store('advertisement_images', 'uploads');
        } else {
            $homepage_header_image = $advertisement->homepage_header_image;
        }

        $homepage_sidebar_image = '';
        if ($request->hasFile('homepage_sidebar_image')) {
            Storage::disk('uploads')->delete($advertisement->homepage_sidebar_image);
            $homepage_sidebar_image = $request->file('homepage_sidebar_image')->store('advertisement_images', 'uploads');
        } else {
            $homepage_sidebar_image = $advertisement->homepage_sidebar_image;
        }

        $homepage_bottom_image = '';
        if ($request->hasFile('homepage_bottom_image')) {
            Storage::disk('uploads')->delete($advertisement->homepage_bottom_image);
            $homepage_bottom_image = $request->file('homepage_bottom_image')->store('advertisement_images', 'uploads');
        } else {
            $homepage_bottom_image = $advertisement->homepage_bottom_image;
        }

        $singlepage_header_image = '';
        if ($request->hasFile('singlepage_header_image')) {
            Storage::disk('uploads')->delete($advertisement->singlepage_header_image);
            $singlepage_header_image = $request->file('singlepage_header_image')->store('advertisement_images', 'uploads');
        } else {
            $singlepage_header_image = $advertisement->singlepage_header_image;
        }

        $singlepage_sidebar_image = '';
        if ($request->hasFile('singlepage_sidebar_image')) {
            Storage::disk('uploads')->delete($advertisement->singlepage_sidebar_image);
            $singlepage_sidebar_image = $request->file('singlepage_sidebar_image')->store('advertisement_images', 'uploads');
        } else {
            $singlepage_sidebar_image = $advertisement->singlepage_sidebar_image;
        }

        $singlepage_bottom_image = '';
        if ($request->hasFile('singlepage_bottom_image')) {
            Storage::disk('uploads')->delete($advertisement->singlepage_bottom_image);
            $singlepage_bottom_image = $request->file('singlepage_bottom_image')->store('advertisement_images', 'uploads');
        } else {
            $singlepage_bottom_image = $advertisement->singlepage_bottom_image;
        }

        $advertisement->update([
            'homepage_header_image' => $homepage_header_image,
            'homepage_header_url' => $data['homepage_header_url'],
            'homepage_sidebar_image' => $homepage_sidebar_image,
            'homepage_sidebar_url' => $data['homepage_sidebar_url'],
            'homepage_bottom_image' => $homepage_bottom_image,
            'homepage_bottom_url' => $data['homepage_bottom_url'],

            'singlepage_header_image' => $singlepage_header_image,
            'singlepage_header_url' => $data['singlepage_header_url'],
            'singlepage_sidebar_image' => $singlepage_sidebar_image,
            'singlepage_sidebar_url' => $data['singlepage_sidebar_url'],
            'singlepage_bottom_image' => $singlepage_bottom_image,
            'singlepage_bottom_url' => $data['singlepage_bottom_url'],
        ]);

        return redirect()->route('advertisements.index')->with('success', 'Advertisement Information updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        //
    }
}
