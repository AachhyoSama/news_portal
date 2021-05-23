<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Subscribers;
use Illuminate\Http\Request;
use DataTables;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Subscribers::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('date', function ($row) {
                    $date = date('F j, Y', strtotime($row->created_at));
                    return $date;
                })
                ->addColumn('status', function($row) {
                    $status = '';
                    if ($row->is_verified == 0) {
                        $status =  '<span class="badge bg-yellow" style="font-size: 12px;">'.'Not verified' .'</span>';
                    }
                    else {
                        $status = '<span class="badge bg-green" style="font-size: 12px;">'.'Verified'.'</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {

                    // $editurl = route('admin.multimedia.edit', $row->id);
                    $deleteurl = route('admin.subscriber.destroy', $row->id);

                    $csrf_token = csrf_token();

                    $btn = "<form action='$deleteurl' method='POST' style='display:inline-block;'>
                                    <input type='hidden' name='_token' value='$csrf_token'>
                                    <input type='hidden' name='_method' value='DELETE' />
                                        <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                </form>";

                    return $btn;
                })
                ->rawColumns(['action', 'date', 'status'])
                ->make(true);
        }
        $setting = Setting::first();
        return view('backend.subscribers.index', compact('setting'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscriber = Subscribers::findorFail($id);
        $subscriber->delete();

        return redirect()->route('admin.subscriber.index')->with('success', 'Subscriber information deleted successfully.');
    }
}
