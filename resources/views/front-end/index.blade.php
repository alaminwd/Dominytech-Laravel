@extends('front-end.master')


@section('content_master')
      <!-- =====================================
            Banner Part Start 
=========================================-->
<section id="banner">
    <div class="container ">
        <div class="row">
            
            <div class="col-lg-6 order-lg-2">
                <div class="banner_img">
                    <div class="shape">
                        <div class="over_head">
                            <div class="one"></div>
                            <div class="heart">
                                <img src="{{asset('upload/banner')}}/{{$banner_info->image}}" class="w-100 img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="banner_text">
                    <h3 class="wow fadeInDown " data-wow-duration=".6s" data-wow-delay=".2s">{{$banner_info->sub_title}}</h3>
                    <h1 class="wow fadeInDown " data-wow-duration=".6s" data-wow-delay=".5s">{{$banner_info->title}}</h1>
                    <p class="wow fadeInDown " data-wow-duration=".6s" data-wow-delay=".8s">{{$banner_info->desp}}</p>
                    <a href="https://wa.me/8801311932840?text=I'm%20interested%20in%20a%20free%20quote" 
                        class="semiler_btn wow fadeInDown" data-wow-duration=".6s" 
                        data-wow-delay="1.1s" 
                        target="_blank">
                            Free Quote
                        </a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- =======================================
         Banner Bottom Start 
===========================================-->
<section id="card" class="d-none d-lg-block">
    <div id="banner_bottom">
        <div class="container">
            <div class="row">
                @foreach ($supports as $support)
                <div class="col-lg-3">
                    <div class="itme wow bounceInUp" data-wow-duration=".6s" data-wow-delay=".2s">
                        <div class="service-img">
                            <img src="images/ser-icon9.png" alt="">
                        </div>
                        <div class="text">
                            <h3 class="title">{{$support->title}}</h3>
                            <p>{{$support->desp}}</p>
                        </div>
                        {{-- <a href="#" class="read-more"><i class="fa-solid fa-arrow-right"></i> <span>Read
                                More...</span></a> --}}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</section>

<!-- =======================================
         About Part Start 
===========================================-->
<section id="about_part">
    <div class="container">
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


<!-- =================================
Certification Part Start 
======================================-->
<section id="certification" >
    <div class="container">
        <div class="row">
            <div class="certification_slider">
                @foreach ($brands as $brand)
                <div class="certification_img">
                    <img src="{{asset('upload/brand')}}/{{$brand->image}}" class="img-fluid" width="150px" alt="">
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


<!-- ==================================
    Service Part Start 
======================================-->
<section id="service_part" class="wow bounceInLeft" data-wow-duration=".6s" data-wow-delay=".2s">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="cmn_title">
                    <h2>Our Services</h2>
                    <p>We Have Extensive Experience Building Enterprise-Grade Applications Using Modern
                        Technologies.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($services as $service)
                <div class="col-lg-4 col-md-6 col-sm-6 m-auto">
                    <div class="service_item">
                        <div class="contetn_header">
                            <div class="header_icon">
                                <i class="fa-solid fa-handshake"></i>
                            </div>
                            <h3>{{$service->category_name}}</h3>
                        </div>
                        <div class="service_gallery_img">
                            <img src="{{asset('upload/category_images')}}/{{$service->image}}" class="w-100 img-fluid" alt="">
                            <a href="{{route('single.service', $service->slug)}}">Veiw Details <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <div class="footer_content">
                            <p>{{$service->short_desp}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ====================================
 Project Part Start 
=======================================-->
<section id="project" class="wow bounceInRight" data-wow-duration=".6s" data-wow-delay=".2s">
    <div class="container">
        <div class="col-lg-5 m-auto">
            <div class="cmn_title">
                <h2>Our Project</h2>
                <p>We Have Extensive Experience Building Enterprise-Grade Applications Using Modern Technologies.
                </p>
            </div>
        </div>
        <div class="port_row">
            <div class="port_list text-center">
                <button type="button" class="control" data-filter="all">All</button>
                <button type="button" class="control" data-filter=".uidesign">UI/UX Design</button>
                <button type="button" class="control" data-filter=".wordpress">Wordpress</button>
                <button type="button" class="control" data-filter=".webdesign">Web Design</button>
                <button type="button" class="control" data-filter=".webdevelopment">Web Development</button>
            </div>
            <div class="row port_mix justify-content-between">
                @foreach ($projects as $project)
                <div class="col-lg-4 col-md-6 col-6 mix {{$project->class}}">
                    <div class="port_col">
                        <img src="{{asset('upload/project')}}/{{$project->image}}" class="w-100 img-fluid" alt="p">
                        <div class="port_overly">
                            <a class="my-image-links" data-gall="gallery01" href="{{asset('upload/project')}}/{{$project->image}}"><i
                                    class="fa-solid fa-link"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- ====================================
 Blog Part Start 
=======================================-->
<section id="blog_part" class="wow bounceInLeft" data-wow-duration=".6s" data-wow-delay=".2s">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="cmn_title">
                    <h2 class="title">Our Blog</h2>
                    <p>We Have Extensive Experience Building Enterprise-Grade Applications Using Modern
                        Technologies.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="blog_slider">
                @foreach ($blogs as $blog)
                    <div class="blog_item">
                        <div class="blog-post-thumb-two">
                            <a class="blog_img" href="{{route('single.blog', $blog->slug)}}"><img src="{{asset('upload/blog')}}/{{$blog->image}}"
                                    class="w-100 img-fluid" alt=""></a>
                            <a href="{{route('single.blog', $blog->slug)}}" class="tag">{{$blog->rel_to_category->category_name}} </a>
                        </div>
                        <div class="blog-post-content">
                            <h2><a href="{{route('single.blog', $blog->slug)}}">{{$blog->title}}</a></h2>
                            <p>{{$blog->short_desp}}</p>
                            <div class="blog_footer_content">
                                <ul>
                                    <li><i class="fa-solid fa-calendar-days"></i>{{$blog->created_at}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>



<!-- =======================================
        Request Part  
===========================================-->

<section id="request" style="background: url({{asset('upload/solution')}}/{{$solution->image}}) no-repeat center/cover fixed;">
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
                    <a href="{{route('contact.page')}}" class="semiler_btn">Know-more</a>
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



<!-- ============================== 
    Contact part start
==================================== -->
<section id="contact" class="request_message">
    <div class="container">
        <div class="col-lg-8 m-auto">
            <div class="cmn_title">
                <h2>CONTACT FORM</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                    the industry's standard dummy text.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-10 m-auto wow bounceInLeft" data-wow-duration=".6s" data-wow-delay=".2s">
                <div class="card">
                    <div class="card-header">
                        <div class="title">
                            <p>I am always open to discussing product</p>
                            <span> design work or partnerships.</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('request.form')}}" method="POST" id="requestForm">
                            @csrf
                            <div class="input_one">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name*">
                            </div>
                            <div class="two">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email*">
                            </div>
                            <div class="three">
                                <textarea class="form-control" name="message" id="message" placeholder="Message*"></textarea>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="w-100" id="requestMessage">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow bounceInRight" data-wow-duration=".6s" data-wow-delay=".2s">
                <div class="right-content">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d116729.21288075492!2d90.38865654841887!3d23.89713857954908!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1715007351822!5m2!1sen!2sbd"
                        style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('footer_master')

{!! Toastr::message() !!}

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).on('click', '#requestMessage', function(e) {
        e.preventDefault();

        let name = $('#name').val();
        let email = $('#email').val();
        let message = $('#message').val();
        let _token = $('input[name="_token"]').val();

        if (!name || !email || !message) {
            toastr.warning("Please fill all fields!", "Warning!", {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-bottom-left",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            });
            return false;
        }

        let formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('message', message);
        formData.append('_token', _token);

        $.ajax({
            url: "{{ route('request.form') }}",
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res.status === 'success') {
                    $('#requestForm')[0].reset();
                    toastr.success("Message sent successfully!", "Success!", {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-left",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });
                } else {
                    toastr.error(res.message, "Error!", {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-left",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });
                }
            },
            error: function(xhr, status, error) {
                toastr.error("An error occurred. Please try again.", "Error!", {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                });
            }
        });
    });
</script>

<script>
     @if(Session::has('message_error'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
        }
                toastr.error("{!! session('message_error') !!}");
        @endif
</script>

<script>
    @if(session('clear-cache'))
        toastr.success("{{ session('clear-cache') }}");
    @endif
</script>


@endsection