@extends('front-end.master')


@section('content_master')
    
<!-- =======================================
            Single_Blog Banner 
===========================================-->
<section id="samiler_banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner_title_two">
                    <h2>{{$project_info->title}}</h2>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ============================== 
        Blog Details  start
==================================== -->
<section id="single_post">
    <div class="container">
        <h4 class="breadcrumb"><a href="{{route('index')}}">Home</a><a href="{{route('project.page')}}"><i class="fa-solid fa-angle-right">
        </i>Project</a> <i class="fa-solid fa-angle-right"></i>{{$project_info->title}}
        </h4>
        <div class="row">
            <div class="col-lg-8">
                <div class="p_left1">
                    <div class="p_left1_img">
                        <img src="{{asset('upload/project')}}/{{$project_info->image}}" class="w-100 img-fluid" alt="">
                    </div>
                    <span>Date -<a class="date-time" href="#">{{$project_info->created_at->format('d M Y')}}
                    </a></span>
                </div>
                <div class="p_left2">
                    <h2>{{$project_info->title}}</h2>
                    <p>{!! $project_info->short_desp !!}</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="search_bar">
                    <div class="form">
                        <input id="search_input" type="text" placeholder="Enter keyword">
                        <button class="search-btn " id="search_btn"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div class="blog_left_content">
                    <div class="category">
                        <div class="blog_title">
                            <h3>Project Information</h3>
                        </div>
                        <ul>
                            <li><strong>Client: </strong>{{$project_info->client}}</li>
                            <li><strong>Date: </strong> {{$project_info->created_at->format('d M Y')}}</li>
                            <li><strong>Author: </strong>DominyTech</li>
                            <li><strong>Location: </strong>{{$project_info->location}}</li>
                           {{-- <li class="social"><span>Share:</span>
                                <div class="share_icon">
                                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                    <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
                                </div>
                            </li> --}}
                        </ul>
                    </div>
                </div>
                <div class="recent_pst_section">
                    <div class="blog_title">
                        <h3>Recent Post</h3>
                    </div>
                    @foreach ($blog_info as $blog)
                    <div class="post_item">
                        <div class="thumb">
                            <a href="{{route('single.blog', $blog->slug)}}"><img src="{{asset('upload/blog')}}/{{$blog->image}}" alt=""></a>
                        </div>
                        <div class="content">
                            <span class="date"><i class="far fa-calendar"></i>{{$blog->created_at->format('d M Y')}}</span>
                            <h2>
                                <a href="{{route('single.blog', $blog->slug)}}">{{$blog->rel_to_category->category_name}}</a>
                            </h2>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection