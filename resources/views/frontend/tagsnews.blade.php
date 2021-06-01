@extends('frontend.layouts.app')

@section('content')
<main>
    <!-- Whats New Start -->
     <section class="whats-news-area pt-50 pb-20">
         <div class="container">
             <div class="row">
             <div class="col-lg-8">
                 <h1 class="text-center mb-3" style="color: #002e5b">Search Results for "#{{$tag}}"</h1>
                 <hr>
                 <div class="row">
                     <div class="col-12">
                         <!-- Nav Card -->
                         <div class="tab-content" id="nav-tabContent">
                             <!-- card one -->
                             <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                 <div class="whats-news-caption">
                                     <div class="row">
                                        @if (count($tagnews) == 0)
                                            <h3 class="text-center">No Results found..</h3>
                                        @else
                                            @foreach ($tagnews as $newsitem)
                                                <div class="col-lg-6 col-md-6 mt-5">
                                                    <div class="single-what-news mb-100">
                                                        <div class="what-img">
                                                            @php
                                                                $category = DB::table('categories')->where('id', $newsitem->category_id[0])->first();
                                                            @endphp
                                                            <a href="{{route('page.news', ['categoryslug' => $category->slug, 'slug' => $newsitem->slug])}}"><img src="{{Storage::disk('uploads')->url($newsitem->image)}}" alt="{{$newsitem->title}}"></a>
                                                        </div>
                                                        <div class="what-cap">
                                                            @foreach ($newsitem->category_id as $category)
                                                                @php
                                                                    $categories_name = DB::table('categories')->where('id', $category)->first();
                                                                @endphp

                                                                <span class="color1">{{$categories_name->title}}</span>
                                                            @endforeach
                                                            <h4><a href="{{route('page.news', ['categoryslug' => $categories_name->slug, 'slug' => $newsitem->slug])}}">{{$newsitem->title}}</a></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                     </div>
                                 </div>
                             </div>
                         </div>
                     <!-- End Nav Card -->
                     </div>
                 </div>
             </div>
             <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget search_widget">
                        <form action="{{route('page.search')}}" method="GET">
                            @csrf
                            @method("GET")
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="word" placeholder='Search Keyword'
                                        onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Search Keyword'">
                                    <div class="input-group-append">
                                        <button class="btns" type="submit" class="form-control"><i class="ti-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            {{-- <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="submit">
                                Search
                            </button> --}}
                        </form>
                    </aside>

                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">News Category</h4>
                        <ul class="list cat-list">
                            @foreach ($requiredcategories as $category)
                                <li>
                                    <a href="{{route('page.category', $category->slug)}}" class="d-flex">
                                        <p>{{$category->title}}</p>
                                        <p>
                                            @php
                                                $count = 0;
                                                foreach ($allnews as $newsitem) {
                                                    if (in_array( $category->id, $newsitem->category_id)) {
                                                        $count = $count+1;
                                                    }
                                                }
                                            @endphp
                                            ({{$count}})
                                        </p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </aside>

                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">Latest News</h3>
                        @foreach ($latestnews as $latestnewsitem)
                            <div class="media post_item">
                                @php
                                    $category = DB::table('categories')->where('id', $latestnewsitem->category_id[0])->first();
                                @endphp
                                <a href="{{route('page.news', ['categoryslug' => $category->slug, 'slug' => $latestnewsitem->slug])}}"><img src="{{Storage::disk('uploads')->url($latestnewsitem->image)}}" alt="{{$latestnewsitem->title}}" style="max-height: 80px;"></a>
                                <div class="media-body">
                                    <a href="{{route('page.news', ['categoryslug' => $category->slug, 'slug' => $latestnewsitem->slug])}}">
                                        <h3>{{$latestnewsitem->title}}</h3>
                                    </a>
                                    <p>{{$latestnewsitem->created_at->diffForHumans()}}</p>
                                </div>
                            </div>
                        @endforeach
                    </aside>

                    <!-- Section Tittle -->
                 <!-- Section Tittle -->
                 <div class="section-tittle mb-2 text-center">
                    <h3>Follow Us</h3>
                    <div class="fb-page"
                            data-href="https://www.facebook.com/LuminaryFacts-100972155460173/"
                            data-tabs=""
                            data-width="300"
                            data-height=""
                            data-small-header="true"
                            data-adapt-container-width="false"
                            data-hide-cover="true"
                            data-show-facepile="false">
                                <blockquote cite="https://www.facebook.com/LuminaryFacts-100972155460173/"
                                    class="fb-xfbml-parse-ignore">
                                </blockquote>
                        </div>
                </div>
                <!-- Flow Socail -->
                {{-- <div class="single-follow mb-45">
                    <div class="single-box">
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="{{asset('frontend/assets/img/news/icon-fb')}}.png" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div>
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="{{asset('frontend/assets/img/news/icon-tw')}}.png" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div>
                            <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="{{asset('frontend/assets/img/news/icon-ins')}}.png" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div>
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="{{asset('frontend/assets/img/news/icon-yo')}}.png" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- New Poster -->
                <div class="news-poster d-lg-block mt-5 owl-ad owl-carousel owl-theme">
                    @foreach ($sidebar_advertisement as $advertisement)
                        <div class="item">
                            <a href="{{$advertisement->link}}" target="_blank"><img src="{{Storage::disk('uploads')->url($advertisement->imagename)}}" alt="" style="max-height: 670px;"></a>
                        </div>
                    @endforeach
                </div>

                <aside class="single_sidebar_widget popular_post_widget">
                    <h3 class="widget_title">Popular News</h3>
                    @foreach ($popularnews as $latestnewsitem)
                        <div class="media post_item">
                            @php
                                $category = DB::table('categories')->where('id', $latestnewsitem->category_id[0])->first();
                            @endphp
                            <a href="{{route('page.news', ['categoryslug' => $category->slug, 'slug' => $latestnewsitem->slug])}}"><img src="{{Storage::disk('uploads')->url($latestnewsitem->image)}}" alt="{{$latestnewsitem->title}}" style="max-height: 80px;"></a>
                            <div class="media-body">
                                <a href="{{route('page.news', ['categoryslug' => $category->slug, 'slug' => $latestnewsitem->slug])}}">
                                    <h3>{{$latestnewsitem->title}}</h3>
                                </a>
                                <p>{{$latestnewsitem->created_at->diffForHumans()}}</p>
                            </div>
                        </div>
                    @endforeach
                </aside>
                </div>
             </div>
             </div>
         </div>
     </section>
     <!-- Whats New End -->

     <hr>
     <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center owl-ad owl-carousel owl-theme">
                @foreach ($bottom_advertisement as $advertisement)
                    <div class="item">
                        <a href="{{$advertisement->link}}" target="_blank"><img src="{{Storage::disk('uploads')->url($advertisement->imagename)}}" alt="" class="img-fluid" style="max-height: 550px;"></a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <hr>
     </main>
@endsection




