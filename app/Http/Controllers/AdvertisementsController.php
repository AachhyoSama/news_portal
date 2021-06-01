<?php

namespace App\Http\Controllers;

use App\Models\BottomAdvertisements;
use App\Models\HeaderAdvertisements;
use App\Models\Setting;
use App\Models\SidebarAdvertisements;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;

class AdvertisementsController extends Controller
{
    public function headerindex(Request $request)
    {
        if ($request->ajax()) {
            $data = HeaderAdvertisements::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $imagename = Storage::disk('uploads')->url($row->imagename);

                    $image = "<img src='$imagename' style='max-height: 100px; max-width: 500px;'>";
                    return $image;
                })
                ->addColumn('featured', function ($row) {
                    if ($row->status == 1) {
                        $featured = '<span class="badge bg-green">' . 'Featured' . '</span>';
                    } else {
                        $featured = '<span class="badge bg-warning">' . 'Not Featured' . '</span>';
                    }
                    return $featured;
                })
                ->addColumn('action', function ($row) {
                    $editurl = route('editheader', $row->id);
                    $deleteurl = route('deleteheader', $row->id);

                    $csrf_token = csrf_token();

                    $btn = "<a href='$editurl' class='edit btn btn-primary btn-sm mb-1'>Edit</a>
                            <form action='$deleteurl' method='POST' style='display:inline-block;'>
                                <input type='hidden' name='_token' value='$csrf_token'>
                                <input type='hidden' name='_method' value='DELETE' />
                                    <button type='submit' class='btn btn-danger btn-sm mb-1'>Delete</button>
                            </form>";
                    return $btn;
                })
                ->rawColumns(['image', 'featured', 'action'])
                ->make(true);
        }
        $setting = Setting::first();
        return view('backend.advertisements.headeradvertisement.index', compact('setting'));
    }

    public function createheader()
    {
        $setting = Setting::first();
        return view('backend.advertisements.headeradvertisement.create', compact('setting'));
    }

    public function saveheader(Request $request)
    {
        // dd($request['status']);
        $this->validate($request, [
            'link' => 'required',
            'imagename' => 'required|mimes:jpg,png,jpeg',
        ]);

        if ($request['status'] == null) {
            $status = 0;
        } else {
            $status = 1;
        }

        if ($request->hasfile('imagename')) {
            $image = $request->file('imagename');
            $imagename = $image->store('advertisement_images', 'uploads');
            $header_advertisement = HeaderAdvertisements::create([
                'link' => $request['link'],
                'imagename' => $imagename,
                'status' => $status,
            ]);
            $header_advertisement->save();
        }
        return redirect()->route('headerindex')->with('success', 'Advertisement is saved successfully.');
    }

    public function editheader($id)
    {
        $header_advertisement = HeaderAdvertisements::findorFail($id);
        $setting = Setting::first();
        return view('backend.advertisements.headeradvertisement.edit', compact('setting', 'header_advertisement'));
    }

    public function updateheader(Request $request, $id)
    {
        $header_advertisement = HeaderAdvertisements::findorFail($id);
        $this->validate($request, [
            'link' => 'required',
            'imagename' => 'mimes:jpg,png,jpeg',
        ]);

        if ($request['status'] == null) {
            $status = 0;
        } else {
            $status = 1;
        }

        if ($request->hasfile('imagename')) {
            Storage::disk('uploads')->delete($header_advertisement->imagename);
            $image = $request->file('imagename');
            $imagename = $image->store('advertisement_images', 'uploads');
            $header_advertisement->update([
                'link' => $request['link'],
                'imagename' => $imagename,
                'status' => $status,
            ]);
        } else {
            $header_advertisement->update([
                'link' => $request['link'],
                'status' => $status,
            ]);
        }
        return redirect()->route('headerindex')->with('success', 'Advertisement info updated successfully.');
    }

    public function deleteheader($id)
    {
        $header_advertisement = HeaderAdvertisements::findorFail($id);
        Storage::disk('uploads')->delete($header_advertisement->imagename);
        $header_advertisement->delete();

        return redirect()->route('headerindex')->with('success', 'Advertisement info deleted successfully.');
    }

    public function sidebarindex(Request $request)
    {
        if ($request->ajax()) {
            $data = SidebarAdvertisements::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $imagename = Storage::disk('uploads')->url($row->imagename);

                    $image = "<img src='$imagename' style='max-height: 200px;'>";
                    return $image;
                })
                ->addColumn('featured', function ($row) {
                    if ($row->status == 1) {
                        $featured = '<span class="badge bg-green">' . 'Featured' . '</span>';
                    } else {
                        $featured = '<span class="badge bg-warning">' . 'Not Featured' . '</span>';
                    }
                    return $featured;
                })
                ->addColumn('action', function ($row) {
                    $editurl = route('editsidebar', $row->id);
                    $deleteurl = route('deletesidebar', $row->id);

                    $csrf_token = csrf_token();

                    $btn = "<a href='$editurl' class='edit btn btn-primary btn-sm mb-1'>Edit</a>
                            <form action='$deleteurl' method='POST' style='display:inline-block;'>
                                <input type='hidden' name='_token' value='$csrf_token'>
                                <input type='hidden' name='_method' value='DELETE' />
                                    <button type='submit' class='btn btn-danger btn-sm mb-1'>Delete</button>
                            </form>";
                    return $btn;
                })
                ->rawColumns(['image', 'featured', 'action'])
                ->make(true);
        }
        $setting = Setting::first();
        return view('backend.advertisements.sidebaradvertisement.index', compact('setting'));
    }

    public function createsidebar()
    {
        $setting = Setting::first();
        return view('backend.advertisements.sidebaradvertisement.create', compact('setting'));
    }

    public function savesidebar(Request $request)
    {
        // dd($request['status']);
        $this->validate($request, [
            'link' => 'required',
            'imagename' => 'required|mimes:jpg,png,jpeg',
        ]);

        if ($request['status'] == null) {
            $status = 0;
        } else {
            $status = 1;
        }

        if ($request->hasfile('imagename')) {
            $image = $request->file('imagename');
            $imagename = $image->store('advertisement_images', 'uploads');
            $sidebar_advertisement = SidebarAdvertisements::create([
                'link' => $request['link'],
                'imagename' => $imagename,
                'status' => $status,
            ]);
            $sidebar_advertisement->save();
        }
        return redirect()->route('sidebarindex')->with('success', 'Advertisement is saved successfully.');
    }

    public function editsidebar($id)
    {
        $sidebar_advertisement = SidebarAdvertisements::findorFail($id);
        $setting = Setting::first();
        return view('backend.advertisements.sidebaradvertisement.edit', compact('setting', 'sidebar_advertisement'));
    }

    public function updatesidebar(Request $request, $id)
    {
        // dd($request['status']);
        $sidebar_advertisement = SidebarAdvertisements::findorFail($id);
        $this->validate($request, [
            'link' => 'required',
            'imagename' => 'mimes:jpg,png,jpeg',
        ]);

        if ($request['status'] == null) {
            $status = 0;
        } else {
            $status = 1;
        }

        if ($request->hasfile('imagename')) {
            Storage::disk('uploads')->delete($sidebar_advertisement->imagename);
            $image = $request->file('imagename');
            $imagename = $image->store('advertisement_images', 'uploads');
            $sidebar_advertisement->update([
                'link' => $request['link'],
                'imagename' => $imagename,
                'status' => $status,
            ]);
        } else {
            $sidebar_advertisement->update([
                'link' => $request['link'],
                'status' => $status,
            ]);
        }
        return redirect()->route('sidebarindex')->with('success', 'Advertisement info updated successfully.');
    }

    public function deletesidebar($id)
    {
        $sidebar_advertisement = SidebarAdvertisements::findorFail($id);
        Storage::disk('uploads')->delete($sidebar_advertisement->imagename);
        $sidebar_advertisement->delete();

        return redirect()->route('sidebarindex')->with('success', 'Advertisement info deleted successfully.');
    }

    public function bottomindex(Request $request)
    {
        if ($request->ajax()) {
            $data = BottomAdvertisements::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $imagename = Storage::disk('uploads')->url($row->imagename);

                    $image = "<img src='$imagename' style='max-height: 100px; max-width: 600px;'>";
                    return $image;
                })
                ->addColumn('featured', function ($row) {
                    if ($row->status == 1) {
                        $featured = '<span class="badge bg-green">' . 'Featured' . '</span>';
                    } else {
                        $featured = '<span class="badge bg-warning">' . 'Not Featured' . '</span>';
                    }
                    return $featured;
                })
                ->addColumn('action', function ($row) {
                    $editurl = route('editbottom', $row->id);
                    $deleteurl = route('deletebottom', $row->id);

                    $csrf_token = csrf_token();

                    $btn = "<a href='$editurl' class='edit btn btn-primary btn-sm mb-1'>Edit</a>
                            <form action='$deleteurl' method='POST' style='display:inline-block;'>
                                <input type='hidden' name='_token' value='$csrf_token'>
                                <input type='hidden' name='_method' value='DELETE' />
                                    <button type='submit' class='btn btn-danger btn-sm mb-1'>Delete</button>
                            </form>";
                    return $btn;
                })
                ->rawColumns(['image', 'featured', 'action'])
                ->make(true);
        }
        $setting = Setting::first();
        return view('backend.advertisements.bottomadvertisement.index', compact('setting'));
    }

    public function createbottom()
    {
        $setting = Setting::first();
        return view('backend.advertisements.bottomadvertisement.create', compact('setting'));
    }

    public function savebottom(Request $request)
    {
        // dd($request['status']);
        $this->validate($request, [
            'link' => 'required',
            'imagename' => 'required|mimes:jpg,png,jpeg',
        ]);

        if ($request['status'] == null) {
            $status = 0;
        } else {
            $status = 1;
        }

        if ($request->hasfile('imagename')) {
            $image = $request->file('imagename');
            $imagename = $image->store('advertisement_images', 'uploads');
            $bottom_advertisement = BottomAdvertisements::create([
                'link' => $request['link'],
                'imagename' => $imagename,
                'status' => $status,
            ]);
            $bottom_advertisement->save();
        }
        return redirect()->route('bottomindex')->with('success', 'Advertisement is saved successfully.');
    }

    public function editbottom($id)
    {
        $bottom_advertisement = bottomAdvertisements::findorFail($id);
        $setting = Setting::first();
        return view('backend.advertisements.bottomadvertisement.edit', compact('setting', 'bottom_advertisement'));
    }

    public function updatebottom(Request $request, $id)
    {
        $bottom_advertisement = bottomAdvertisements::findorFail($id);
        $this->validate($request, [
            'link' => 'required',
            'imagename' => 'mimes:jpg,png,jpeg',
        ]);

        if ($request['status'] == null) {
            $status = 0;
        } else {
            $status = 1;
        }

        if ($request->hasfile('imagename')) {
            Storage::disk('uploads')->delete($bottom_advertisement->imagename);
            $image = $request->file('imagename');
            $imagename = $image->store('advertisement_images', 'uploads');
            $bottom_advertisement->update([
                'link' => $request['link'],
                'imagename' => $imagename,
                'status' => $status,
            ]);
        } else {
            $bottom_advertisement->update([
                'link' => $request['link'],
                'status' => $status,
            ]);
        }
        return redirect()->route('bottomindex')->with('success', 'Advertisement info updated successfully.');
    }

    public function deletebottom($id)
    {
        $bottom_advertisement = bottomAdvertisements::findorFail($id);
        Storage::disk('uploads')->delete($bottom_advertisement->imagename);
        $bottom_advertisement->delete();

        return redirect()->route('bottomindex')->with('success', 'Advertisement info deleted successfully.');
    }
}
