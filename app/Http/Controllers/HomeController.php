<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Setting;
use App\Models\Subscribers;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role_id == 3) {
            return view('frontend.dashboard');
        } else {
            $setting = Setting::first();
            $news = News::latest()->take(10)->get();
            $totalnews = News::get();
            $totalsubscribers = Subscribers::get();
            $subscribers = Subscribers::latest()->take(10)->get();
            $total_views = 0;
            foreach ($totalnews as $singlenews) {
                $total_views = $total_views + $singlenews->view_count;
            }
            return view('backend.dashboard', compact('setting', 'news', 'totalnews', 'subscribers', 'totalsubscribers', 'total_views'));
        }
    }

    public function front()
    {
        return view('frontend.dashboard');
    }
}
