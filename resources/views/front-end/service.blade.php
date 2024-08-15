@extends('front-end.master')



@section('content_master')
     <!-- =======================================
            Service Banner page 
===========================================-->
<section id="samiler_banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner_title_two">
                    <h2>Service</h2>
                </div>
            </div>
        </div>
    </div>
  </section>
  
<!-- ==================================
        Service Part Start 
======================================-->
<section id="service_part"> 
    <div class="container">
        <div class="row">
            <div class="col-lg-5 m-auto">
                <div class="cmn_title">
                    <h2>Our Services</h2>
                    <p>We Have Extensive Experience Building Enterprise-Grade Applications Using Modern
                        Technologies.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($services as $category )
                <div class="col-lg-4 col-md-6 col-sm-10 m-auto">
                    <div class="service_item">
                        <div class="contetn_header">
                            <div class="header_icon">
                                <i class="fa-solid fa-handshake"></i>
                            </div>
                            <h3>{{$category->category_name}}</h3>
                        </div>
                        <div class="service_gallery_img">
                            <img src="{{asset('upload/category_images')}}/{{$category->image}}" class="w-100 img-fluid"
                                alt="">
                            <a href="{{route('single.service', $category->slug)}}">Veiw Details <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <div class="footer_content">
                            <p>{{$category->short_desp}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>



<!-- =======================================
            Chose Part  
===========================================-->

<section id="request" style="background: url(images/request.jpg); background-attachment: fixed;">
    <div class="container">
      <div class="row">
        <div class="col-md-8 m-auto">
            <div class="text-area">
                <h2 class="text-white">Request a Customized Solution for Your Business!</h2>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 m-auto">
          <p>Every business is unique. Request a tailored solution crafted specifically for your organization's challenges and goals.</p>
          <div class="cnt-btn">
            <a href="#" class="semiler_btn">Know-more</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  
@endsection

@section('footer_master')
    
@endsection