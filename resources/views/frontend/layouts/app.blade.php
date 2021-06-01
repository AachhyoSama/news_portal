<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        {!! SEO::generate(true) !!}
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        {{-- <title>{{$setting->sitename}} </title> --}}
        {{-- <meta name="description" content=""> --}}
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <link rel="manifest" href="site.webmanifest"> --}}
		<link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/assets/img/lf.png')}}">

		<!-- CSS here -->
            <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
            <link rel="stylesheet" href="{{asset('frontend/assets/css/owl.carousel.min.css')}}">
            <link rel="stylesheet" href="{{asset('frontend/assets/css/ticker-style.css')}}">
            <link rel="stylesheet" href="{{asset('frontend/assets/css/flaticon.css')}}">
            <link rel="stylesheet" href="{{asset('frontend/assets/css/slicknav.css')}}">
            <link rel="stylesheet" href="{{asset('frontend/assets/css/animate.min.css')}}">
            <link rel="stylesheet" href="{{asset('frontend/assets/css/magnific-popup.css')}}">
            <link rel="stylesheet" href="{{asset('frontend/assets/css/fontawesome-all.min.css')}}">
            <link rel="stylesheet" href="{{asset('frontend/assets/css/themify-icons.css')}}">
            <link rel="stylesheet" href="{{asset('frontend/assets/css/slick.css')}}">
            <link rel="stylesheet" href="{{asset('frontend/assets/css/nice-select.css')}}">
            <link rel="stylesheet" href="{{asset('frontend/assets/css/style.css')}}">
   </head>

   <body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0&appId=886389288784222&autoLogAppEvents=1"
        nonce="lPsgZzTb">
    </script>

<script>
    window.twttr = (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0],
      t = window.twttr || {};
    if (d.getElementById(id)) return t;
    js = d.createElement(s);
    js.id = id;
    js.src = "https://platform.twitter.com/widgets.js";
    fjs.parentNode.insertBefore(js, fjs);

    t._e = [];
    t.ready = function(f) {
      t._e.push(f);
    };

    return t;
  }(document, "script", "twitter-wjs"));
</script>
<header>
    @include('frontend.layouts.includes.header')
</header>

    @yield('content')


<footer>
    @include('frontend.layouts.includes.footer')
</footer>

 <!-- JS here -->

     <!-- All JS Custom Plugins Link Here here -->
     <script src="{{asset('frontendassets/js/vendor/modernizr-3.5.0.min.js')}}"></script>
     <!-- Jquery, Popper, Bootstrap -->
     <script src="{{asset('frontend/assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
     <script src="{{asset('frontend/assets/js/popper.min.js')}}"></script>
     <script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
     <!-- Jquery Mobile Menu -->
     <script src="{{asset('frontend/assets/js/jquery.slicknav.min.js')}}"></script>

     <!-- Jquery Slick , Owl-Carousel Plugins -->
     <script src="{{asset('frontend/assets/js/owl.carousel.min.js')}}"></script>
     <script src="{{asset('frontend/assets/js/slick.min.js')}}"></script>
     <!-- Date Picker -->
     <script src="{{asset('frontend/assets/js/gijgo.min.js')}}"></script>
     <!-- One Page, Animated-HeadLin -->
     <script src="{{asset('frontend/assets/js/wow.min.js')}}"></script>
     <script src="{{asset('frontend/assets/js/animated.headline.js')}}"></script>
     <script src="{{asset('frontend/assets/js/jquery.magnific-popup.js')}}"></script>

     <!-- Breaking New Pluging -->
     <script src="{{asset('frontend/assets/js/jquery.ticker.js')}}"></script>
     <script src="{{asset('frontend/assets/js/site.js')}}"></script>

     <!-- Scrollup, nice-select, sticky -->
     <script src="{{asset('frontend/assets/js/jquery.scrollUp.min.js')}}"></script>
     <script src="{{asset('frontend/assets/js/jquery.nice-select.min.js')}}"></script>
     <script src="{{asset('frontend/assets/js/jquery.sticky.js')}}"></script>

     <!-- contact js -->
     <script src="{{asset('frontend/assets/js/contact.js')}}"></script>
     <script src="{{asset('frontend/assets/js/jquery.form.js')}}"></script>
     <script src="{{asset('frontend/assets/js/jquery.validate.min.js')}}"></script>
     <script src="{{asset('frontend/assets/js/mail-script.js')}}"></script>
     <script src="{{asset('frontend/assets/js/jquery.ajaxchimp.min.js')}}"></script>

     <!-- Jquery Plugins, main Jquery -->
     <script src="{{asset('frontend/assets/js/plugins.js')}}"></script>
     <script src="{{asset('frontend/assets/js/main.js')}}"></script>
     <script type="text/javascript">
        setTimeout(function(){
            $('.alert').fadeOut('slow');
        }, 5000 ); // 5 secs
    </script>

 </body>
</html>

