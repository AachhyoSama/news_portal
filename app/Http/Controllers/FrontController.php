<?php

namespace App\Http\Controllers;

use App\Mail\RegisterSubscriber;
use App\Mail\SubscriberMail;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\News;
use App\Models\Seo;
use App\Models\Setting;
use App\Models\Subscribers;
use App\Models\Tags;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class FrontController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $leftcategory = [];
        $categories = Category::all()->toArray();
        $menucategories = Category::take(7)->get()->toArray();
        $downmenucategories = Category::take(4)->get()->toArray();
        foreach ($categories as $category) {
            if (in_array($category, $menucategories)) {
            } else {
                array_push($leftcategory, $category);
            }
        }
        $advertisement = Advertisement::first();
        $categoryallnews = News::latest()->take(4)->get();
        $allthenews = News::latest()->where('featured', '1')->get();
        $popularnews = News::orderby('view_count', 'DESC')->take(5)->get();
        $trendingone = News::latest()->where('is_trending', 1)->first();
        $trendingthree = News::where('is_trending', 1)->take(3)->get();
        $trendingfive = News::latest()->where('is_trending', 1)->take(5)->get();
        $recentnews = News::latest()->take(5)->get();
        return view('frontend.index', compact('setting', 'leftcategory', 'trendingone', 'trendingthree', 'trendingfive', 'downmenucategories', 'menucategories', 'popularnews', 'advertisement', 'allthenews', 'recentnews', 'categoryallnews'));
    }

    public function aboutus()
    {
        $setting = Setting::first();
        $advertisement = Advertisement::first();
        $leftcategory = [];
        $categories = Category::all()->toArray();
        $menucategories = Category::take(7)->get()->toArray();;
        foreach ($categories as $category) {
            if (in_array($category, $menucategories)) {
            } else {
                array_push($leftcategory, $category);
            }
        }
        $requiredcategories = Category::take(6)->get();
        $allnews = News::latest()->get();
        $popularnews = News::orderby('view_count', 'DESC')->take(4)->get();
        $latestnews = News::latest()->take(4)->get();
        return view('frontend.aboutus', compact('setting', 'leftcategory', 'menucategories', 'advertisement', 'requiredcategories', 'allnews', 'popularnews', 'latestnews'));
    }

    public function pageCategory($slug)
    {
        $setting = Setting::first();
        $advertisement = Advertisement::first();
        $leftcategory = [];
        $categories = Category::all()->toArray();
        $menucategories = Category::take(7)->get()->toArray();;
        foreach ($categories as $category) {
            if (in_array($category, $menucategories)) {
            } else {
                array_push($leftcategory, $category);
            }
        }
        $category = Category::where('slug', $slug)->first();
        $requiredcategories = Category::take(6)->get();
        SEOMeta::setTitle($category->title);
        $allnews = News::latest()->get();
        $popularnews = News::orderby('view_count', 'DESC')->take(4)->get();
        $latestnews = News::latest()->take(4)->get();
        $news = [];
        $onenews = '';
        foreach ($allnews as $newsitem) {
            if (in_array($category->id, $newsitem->category_id)) {
                $onenews = $newsitem;
                array_push($news, $newsitem);
            }
        }
        return view('frontend.category', compact('setting', 'allnews', 'onenews', 'requiredcategories', 'latestnews', 'advertisement', 'popularnews', 'leftcategory', 'menucategories', 'category', 'news'));
    }

    public function pageNews($categoryslug, $slug)
    {
        $setting = Setting::first();
        $advertisement = Advertisement::first();
        $leftcategory = [];
        $categories = Category::all()->toArray();
        $menucategories = Category::take(7)->get()->toArray();;
        foreach ($categories as $category) {
            if (in_array($category, $menucategories)) {
            } else {
                array_push($leftcategory, $category);
            }
        }
        $requiredcategories = Category::take(6)->get();
        $latestnews = News::latest()->take(4)->get();
        $news = News::where('slug', $slug)->first();
        $popularnews = News::orderby('view_count', 'DESC')->take(4)->get();
        $allnews = News::all();

        $relatednewsitem = [];
        for ($i = 0; $i < count($news->category_id); $i++) {
            $categoryname = Category::where('id', $news->category_id[$i])->first();
            foreach ($allnews as $relatednews) {
                if (in_array($categoryname->id, $relatednews->category_id)) {
                    array_push($relatednewsitem, $relatednews);
                }
            }
        }

        $seo_info = Seo::where('news_id', $news->id)->first();
        $tags = Tags::where('news_id', $news->id)->get();
        $keywords = [];
        foreach ($tags as $tag) {
            array_push($keywords, $tag->tags);
        }

        $url = Storage::disk('uploads')->url($news->image);

        SEOMeta::setTitle($seo_info->seotitle);
        SEOMeta::setDescription($seo_info->seodescription);
        SEOMeta::addKeyword($keywords);
        SEOMeta::setCanonical('http://127.0.0.1:8000' . '/' . $categoryslug . '/' . $slug);
        OpenGraph::setTitle($seo_info->seotitle);
        OpenGraph::setDescription($seo_info->seodescription);
        OpenGraph::setUrl('http://127.0.0.1:8000' . '/' . $categoryslug . '/' . $slug);
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addImage($url);

        TwitterCard::setTitle($seo_info->seotitle);
        TwitterCard::setSite('@AnishGu70482739');
        TwitterCard::setImage($url);

        $news->update([
            'view_count' => $news->view_count + 1,
        ]);
        return view('frontend.news', compact('setting', 'advertisement', 'leftcategory', 'popularnews', 'news', 'tags', 'menucategories', 'relatednewsitem', 'latestnews', 'allnews', 'requiredcategories'));
    }

    public function pageAuthor($name)
    {

        SEOMeta::setTitle($name);
        $leftcategory = [];
        $categories = Category::all()->toArray();
        $menucategories = Category::take(7)->get()->toArray();;
        foreach ($categories as $category) {
            if (in_array($category, $menucategories)) {
            } else {
                array_push($leftcategory, $category);
            }
        }
        $setting = Setting::first();
        $advertisement = Advertisement::first();
        $authornews = News::latest()->where('author', $name)->get();
        $requiredcategories = Category::take(6)->get();
        $latestnews = News::latest()->take(4)->get();
        $popularnews = News::orderby('view_count', 'DESC')->take(4)->get();
        $allnews = News::all();
        return view('frontend.authorarticles', compact('authornews', 'name', 'leftcategory', 'menucategories', 'requiredcategories', 'latestnews', 'popularnews', 'allnews', 'setting', 'advertisement'));
    }

    public function pageTag($tag)
    {
        SEOMeta::setTitle('#' . $tag);
        $leftcategory = [];
        $categories = Category::all()->toArray();
        $menucategories = Category::take(7)->get()->toArray();;
        foreach ($categories as $category) {
            if (in_array($category, $menucategories)) {
            } else {
                array_push($leftcategory, $category);
            }
        }
        $setting = Setting::first();
        $advertisement = Advertisement::first();
        $requiredcategories = Category::take(6)->get();
        $latestnews = News::latest()->take(4)->get();
        $popularnews = News::orderby('view_count', 'DESC')->take(4)->get();
        $allnews = News::all();
        $tagnews = [];
        $tagslug = Str::slug($tag);
        $tags = Tags::where('slug', $tagslug)->get();
        foreach ($tags as $tagitem) {
            $tagnewsitem = News::where('id', $tagitem->news_id)->first();
            array_push($tagnews, $tagnewsitem);
        }
        return view('frontend.tagsnews', compact('tag', 'leftcategory', 'tagnews', 'menucategories', 'requiredcategories', 'latestnews', 'popularnews', 'allnews', 'setting', 'advertisement'));
    }

    public function pageSearch(Request $request)
    {
        $searchword = $request['word'];
        $searchednews = News::where('title', 'LIKE', '%' . $searchword . '%')->orWhere('details', 'LIKE', '%' . $searchword . '%')->orWhere('slug', 'LIKE', '%' . $searchword . '%')->get();
        SEOMeta::setTitle($searchword);
        $leftcategory = [];
        $categories = Category::all()->toArray();
        $menucategories = Category::take(7)->get()->toArray();;
        foreach ($categories as $category) {
            if (in_array($category, $menucategories)) {
            } else {
                array_push($leftcategory, $category);
            }
        }
        $setting = Setting::first();
        $advertisement = Advertisement::first();
        $requiredcategories = Category::take(6)->get();
        $latestnews = News::latest()->take(4)->get();
        $popularnews = News::orderby('view_count', 'DESC')->take(4)->get();
        $allnews = News::all();
        return view('frontend.searchednews', compact('searchword', 'leftcategory', 'searchednews', 'menucategories', 'requiredcategories', 'latestnews', 'popularnews', 'allnews', 'setting', 'advertisement'));
    }

    public function registerSubscriber(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $existing_subscriber = Subscribers::where('email', $request['email'])->where('is_verified', 1)->first();

        if ($existing_subscriber != null) {
            return redirect()->route('index')->with('success', 'You have already subscribed. Thank you!!');
        } else {
            $subscriber = Subscribers::create([
                'email' => $request['email'],
                'verification_code' => sha1(time())
            ]);
            $subscriber->save();
            $mailData = [
                'verification_code' => $subscriber->verification_code,
            ];

            Mail::to($request['email'])->send(new RegisterSubscriber($mailData));
            return redirect()->route('index')->with('success', 'We have sent a confirmation code to your gmail account for subscription. Please Check your email.');
        }
    }

    public function confirmSubscribtion()
    {
        $verification_code = \Illuminate\Support\Facades\Request::get('code');
        $subscriber = Subscribers::where('verification_code', $verification_code)->first();
        if ($subscriber != null) {
            $subscriber->is_verified = 1;
            $subscriber->save();
            return redirect()->route('index')->with('success', 'Thank you for subscribing.');
        }
        return redirect()->route('index')->with('error', 'Sorry, Your subscribtion is not confirmed. Please try again!');
    }

    public static function sendNews($news, $category)
    {
        $setting = Setting::first();
        $url = 'http://127.0.0.1:8000/' . $category->slug . '/' . $news->slug;
        $mailData = [
            'news' => $news,
            'url' => $url,
            'setting' => $setting
        ];

        $subscribers = Subscribers::where('is_verified', 1)->get();
        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new SubscriberMail($mailData));
        }
    }
}
