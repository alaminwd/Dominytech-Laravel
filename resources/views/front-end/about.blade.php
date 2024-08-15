@extends('front-end.master');

@section('content_master')
     <!-- =======================================
            About Banner page 
===========================================-->
<section id="samiler_banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner_title_two">
                    <h2>About Us</h2>
                </div>
            </div>
        </div>
    </div>
  </section>
  
  
    <!-- =======================================
               About Part Start 
  ===========================================-->
  <section id="about_part">
    <div class="container">
      <h4 class="breadcrumb">
        <a href="{{route('index')}}">Home</a><a href="{{route('about.page')}}"><i class="fa-solid fa-angle-right">
        </i>About</a>
      </h4>
      <div class="row">
        <div class="col-lg-6 order-lg-2 wow bounceInRight" data-wow-duration=".6s">
            <div class="about_content">
                <h3 class="sub_title">WHO WE ARE</h3>
                <h2 class="title">{{$about_info->title}}</h2>
                <p class="details">{{$about_info->desp}}</p>
            </div>
            <div class="row">
                <div class="col-md-5 col-6 col-md-6">
                    <div class="about_success">
                        <i class="fa-solid fa-trophy"></i>
                        <h2 class="count"><span class="data-count">{{$about_info->project}}</span>+</h2>
                        <p>Project</p>
                    </div>
                </div>
                <div class="col-md-5 col-6 col-md-6">
                    <div class="about_success">
                        <i class="far fa-smile"></i>
                        <h2 class="count"><span class="data-count">{{$about_info->client}}</span>+</h2>
                        <p>Happy Clients</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 wow bounceInLeft" data-wow-duration=".6s">
            <div class="fist_img">
                <img src="{{asset('upload/about')}}/{{$about_info->main_image}}" class="img-fluid" alt="">
                <div class="second_img">
                    <img src="{{asset('upload/about')}}/{{$about_info->side_image}}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </div>
    </div>
  </section>
  
  
  
  
  <!-- =======================================
              Chose Part  
  ===========================================-->
  <section id="chose_section">
    <div class="container">
          <span class="sub_title">Why Choose Us</span>
      <div class="row">
        <div class="col-lg-6">
          <div class="left-content">
            <h2 class="title">We Can Help You To Grow Your Business.</h2>
            <p>When you choose Potensial, you're not just hiring a consulting firm – you're partnering
              with a team of dedicated
              professionals who are invested in your success.
          </p>
          <div class="row border-ftr">
            <div class="chose">
              <ul style="list-style: none;">
                <li><i class="fa-solid fa-circle-check"></i><span>Strategic Approach</span></li>
                <li><i class="fa-solid fa-circle-check"></i><span>Strategic Approach</span></li>
                <li><i class="fa-solid fa-circle-check"></i><span>Strategic Approach</span></li>
                <li><i class="fa-solid fa-circle-check"></i><span>Strategic Approach</span></li>
              </ul>
            </div>
          </div>
          <div class="know-more">
            <a href="#" class="semiler_btn">Know-more</a>
          </div>
          </div>
        </div>
        <div class="col-lg-6">
            <div class="chose-img">
                <div class="box_shadow">
                    <img src="images/blog-03.jpg" class="img-fluid w-100" alt="">
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>
  
  
  <!-- =======================================
              Request Part  
  ===========================================-->
  
  <section id="request" style="background: url({{asset('upload/solution')}}/{{$solution->image}}); background-attachment: fixed;">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 col-md-8 m-auto">
            <div class="text-area">
                <h2 class="text-white">{{$solution->title}}</h2>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 m-auto">
          <p>{{$solution->desp}}</p>
          <div class="cnt-btn">
            <a href="#" class="semiler_btn">Know-more</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  
  <!-- =======================================
              testimonial Part  
  ===========================================-->
  <section id="testimonial" class="wow bounceInRight" data-wow-duration=".6s" data-wow-delay=".2s">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <span class="sub_title">Testimonials</span>
                <h2 class="title">Clients Review</h2>
            </div>
        </div>
        <div class="row">
            <div class="testimonial-slider">
                @foreach ($testimonial as $review)
                <div class="testimonial-item">
                    <div class="review-text">
                        <p>{{$review->comment}}</p>
                        <div class="test_ftn">
                            <img class="clint_img" src="{{asset('upload/client')}}/{{$review->image}}" width="50px" alt="">
                            <div class="client_info">
                                <h5>{{$review->name}}</h5>
                                <span>{{$review->profession}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
  
  
@endsection


@section('footer_master')
    
@endsection