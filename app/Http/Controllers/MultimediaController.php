<?php

namespace App\Http\Controllers;

use App\Models\Multimedia;
use App\Models\Setting;
use Illuminate\Http\Request;
use DataTables;

class MultimediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Multimedia::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $editurl = route('admin.multimedia.edit', $row->id);
                    $deleteurl = route('admin.multimedia.destroy', $row->id);

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
        return view('backend.multimedia.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setting = Setting::first();
        return view('backend.multimedia.create', compact('setting'));
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
            'title' => 'required',
            'link' => 'required',
        ]);

        $multimedia = Multimedia::create([
            'title' => $data['title'],
            'link' => $data['link'],
        ]);

        $multimedia->save();
        return redirect()->route('admin.multimedia.index')->with('success', 'Multimedia has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function show(Multimedia $multimedia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $multimedia = Multimedia::findorFail($id);
        $setting = Setting::first();
        return view('backend.multimedia.edit', compact('multimedia', 'setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Multimedia $multimedia)
    {
        $data = $this->validate($request, [
            'title' => 'required',
            'link' => 'required',
        ]);

        $multimedia->update([
            'title' => $data['title'],
            'link' => $data['link'],
        ]);

        return redirect()->route('admin.multimedia.index')->with('success', 'Multimedia information updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $multimedia = Multimedia::findorFail($id);
        $multimedia->delete();
        return redirect()->back()->with('success', 'Multimedia information deleted successfully.');
    }
}
