
        <!-- Header Start -->
       <div class="header-area">
            <div class="main-header ">
                <div class="header-top black-bg d-none d-md-block">
                   <div class="container">
                       <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left">
                                    <ul>
                                        <li><i class="fas fa-calendar-alt" aria-hidden="true"></i>  &nbsp;{{date("F j, Y")}}</li>
                                    </ul>
                                </div>
                                <div class="header-info-right">
                                    <ul class="header-social">
                                        <li><a href="{{$setting->facebook}}" target="_blank"><i class="fab fa-facebook"></i></a></li>
                                        <li><a href="{{$setting->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="{{$setting->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                        <!--<li><a href="{{$setting->linkedin}}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>-->
                                    </ul>
                                </div>
                            </div>
                       </div>
                   </div>
                </div>
                <div class="header-mid d-none d-md-block">
                   <div class="container">
                        <div class="row d-flex align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-3 col-lg-3 col-md-3">
                                <div class="logo">
                                    <a href="{{route('index')}}"><img src="{{Storage::disk('uploads')->url($setting->siteLogo)}}" alt="{{$setting->sitename}}" style="max-width: 120px; height:auto"></a>
                                </div>
                            </div>

                            <div class="col-xl-9 col-lg-9 col-md-9">
                                <div class="header-banner f-right owl-ad owl-carousel owl-theme">
                                    @foreach ($header_advertisement as $advertisement)
                                        <div class="item">
                                            <a href="{{$advertisement->link}}" target="_blank"><img src="{{Storage::disk('uploads')->url($advertisement->imagename)}}" class="img-fluid" alt="" style="max-height: 150px;"></a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-md-9">
                                <div class="header-banner f-right">
                                    <a href="{{$advertisement->homepage_header_url}}" target="_blank"><img src="{{Storage::disk('uploads')->url($advertisement->homepage_header_image)}}" class="img-fluid" alt="" style="max-height: 150px;"></a>
                                    <section class="hero-section">
                                        <div class="hero-items owl-carousel">
                                            @foreach ($header_advertisement as $advertisement)
                                                <div onclick="location.href={{$advertisement->link}}"
                                                    style="cursor: pointer; background-repeat: no-repeat; background-size:cover;max-height: 150px;"
                                                    class="single-hero-items set-bg img-fluid"
                                                    data-setbg="{{Storage::disk('uploads')->url($advertisement->imagename)}}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
               <div class="header-bottom header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-12 col-lg-12 col-md-12 header-flex">
                                <!-- sticky -->
                                    <div class="sticky-logo">
                                        <a href="{{route('index')}}"><img src="{{Storage::disk('uploads')->url($setting->siteLogo)}}" alt="{{$setting->sitename}}" style="max-width: 70px; padding-top: 1rem;"></a>
                                    </div>
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-md-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="{{route('index')}}">Home</a></li>
                                            @foreach ($menucategories as $category)
                                                <li><a href="{{route('page.category', $category['slug'])}}">{{$category['title']}}</a></li>
                                            @endforeach
                                            {{-- <li><a href="{{route('aboutus')}}">About</a></li>
                                            <li><a href="latest_news.html">Latest News</a></li>
                                            <li><a href="contact.html">Contact</a></li> --}}
                                            @if (count($leftcategory) == 0)
                                            @else
                                                <li><a href="#">More..</a>
                                                    <ul class="submenu">
                                                        @foreach ($leftcategory as $category)
                                                            <li><a href="{{route('page.category', $category['slug'])}}">{{$category['title']}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endif
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            {{-- <div class="col-xl-2 col-lg-2 col-md-4">
                                <div class="header-right-btn f-right d-none d-lg-block">
                                    <i class="fas fa-search special-tag"></i>
                                    <div class="search-box">
                                        <form action="#">
                                            <input type="text" placeholder="Search">
                                        </form>
                                    </div>
                                </div>
                            </div> --}}
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-md-none">

                                </div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
       </div>
        <!-- Header End -->
