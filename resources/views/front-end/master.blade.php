
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dominy Tech Web Development</title>
    <link rel="stylesheet" href="{{asset('front-end/css/bootstrap.min.css ')}}">
    <link rel="stylesheet" href="{{asset('front-end/css/animate.css ')}}">
    <link rel="stylesheet" href="{{asset('front-end/css/slick.css ')}}">
    <link rel="stylesheet" href="{{asset('front-end/css/all.min.css ')}}">
    <link rel="stylesheet" href="{{ asset('node_modules/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{asset('front-end/css/venobox.min.css ')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{asset('front-end/css/style.css ')}}">
    <link rel="stylesheet" href="{{asset('front-end/css/responsive.css ')}}">
</head>

<body>

   @php
         $logos = App\Models\Logo::where('status', 1)->get();
         $menus = App\Models\Menu::all();
   @endphp
    <!-- =========================================
                Navber Part Start 
============================================-->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand wow bounceInLeft" href="{{route('index')}}">
               @foreach ($logos as $logo)
               <img src="{{asset('upload/logo')}}/{{$logo->logo}}" alt="">
               @endforeach
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fa-solid fa-bars nav-icon"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                    @foreach (App\Models\Menu::all(); as $menus)
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="{{route($menus->menu_link)}}">{{$menus->menu_name}}</a></li>
                    @endforeach
                   
                    {{-- <li class="nav-item wow bounceInDown" data-wow-duration=".6s" data-wow-delay=".2s"><a class="nav-link" href="about.html">About</a></li>
                    <li class="nav-item wow bounceInDown" data-wow-duration=".6s" data-wow-delay=".3s"><a class="nav-link" href="{{route('service.page')}}">Service</a></li>
                    <li class="nav-item wow bounceInDown" data-wow-duration=".6s" data-wow-delay=".4s"><a class="nav-link" href="{{route('project.page')}}">Project</a></li>
                    <li class="nav-item wow bounceInDown" data-wow-duration=".6s" data-wow-delay=".5s"><a class="nav-link" href="{{route('blog.page')}}">Blog</a></li>
                    <li class="nav-item wow bounceInDown" data-wow-duration=".6s" data-wow-delay=".6s"><a class="nav-link" href="contact.html">Contact</a></li> --}}
                </ul>
                <div class="nav_contact">
                    <a href="{{route('contact.page')}}" class="semiler_btn wow bounceInRight"> Free Contact</a>
                </div>
            </div>
        </div>
    </nav>


   <!-- ============================== 
        Content Body 
    ==================================== -->

    @yield('content_master')


    <!-- ============================== 
        footer part start
    ==================================== -->
    <footer id="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-sm-6 wow bounceInLeft" data-wow-duration="1s" data-wow-delay=".4s">
                        <div class="foot1">
                           
                            @foreach ($logos as $logo)
                                <img src="{{asset('upload/logo')}}/{{$logo->logo}}" width="130" alt="">
                            @endforeach
                            @php
                                $footer_info = (App\Models\FooterInfo::where('id', 1)->first())
                            @endphp
                            <p>{{$footer_info->desp}} </p>
                            @php
                                $social_icons = App\Models\SocialIcon::all();
                            @endphp
                            
                            @foreach ($social_icons as $icon)
                                <a href="{{ $icon->icon_link }}"><i class="{{ $icon->icon }}"></i></a>
                            @endforeach
                            {{-- <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            
                            <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a> --}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow bounceInLeft" data-wow-duration="1s" data-wow-delay=".4s">
                        <div class="foot2">
                            <h3>Contact us</h3>
                            <div class="foot21 text-left">
                                <a href="callto: +8801798328852"><i class="fas fa-phone-alt"></i> {{$footer_info->phone}}</a>
                                <a href="mailto: dominytech.bd@gmail.com"><i
                                        class="fas fa-envelope"></i>{{$footer_info->email}}</a>
                                <a href="#" target="_blank"><i class="fas fa-globe-asia"></i>
                                    www.dominytech.com</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 wow bounceInRight" data-wow-duration="1s" data-wow-delay=".4s">
                        <div class="foot3">
                            <h3>Important Links</h3>
                            <div class="foot_menu">
                                <ul>
                                    <li><a href="{{route('index')}}">Home</a></li>
                                    <li><a href="{{route('about.page')}}">About Us</a></li>
                                    <li><a href="{{route('blog.page')}}">Blog</a></li>
                                    <li><a href="{{route('blog.page')}}">Privacy Policy</a></li>
                                    <li><a href="{{route('contact.page')}}">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow bounceInRight" data-wow-duration="1s" data-wow-delay=".4s">
                        <div class="foot4">
                            <h3>Flicker Photos</h3>
                            <div class="foot4_row">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-4 col-4 fcol">
                                        <img class="w-100 img-fluid" src="#" alt="Dominy Tech web design agency">
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-4 fcol">
                                        <img class="w-100 img-fluid" src="#" alt="Dominy Tech web design agency">
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-4 fcol">
                                        <img class="w-100 img-fluid" src="#" alt="Dominy Tech web design agency">
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-4 fcol">
                                        <img class="w-100 img-fluid" src="#" alt="Dominy Tech web design agency">
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-4 fcol">
                                        <img class="w-100 img-fluid" src="#" alt="Dominy Tech web design agency">
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-4 fcol">
                                        <img class="w-100 img-fluid" src="#" alt="Dominy Tech web design agency">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_bottom text-center">
            <p>Copyright © 2023. All rights reserved by <a href="#">Dominy Tech</a></p>
        </div>
    </footer>
    <!-- ===============================
        footer area end
     ============================= -->
     <div class="row">
        <div class="col-lg-1">
          <div class="bt_top">
            <i class="fa-solid fa-angle-up"></i>
          </div>
        </div>
      </div>



    <script src="{{asset('front-end/js/bootstrap.bundle.min.js ')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{asset('front-end/js/jquery-1.12.4.min.js ')}}"></script>
    <script src="{{asset('front-end/js/wow.min.js ')}}"></script>
    <script src="{{asset('front-end/js/slick.min.js ')}}"></script>
    <script src="{{asset('front-end/js/mixitup.min.js ')}}"></script>
    <script src="{{asset('front-end/js/venobox.min.js ')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{asset('front-end/js/script.js ')}}"></script>


    @yield('footer_master')

</body>

</html>