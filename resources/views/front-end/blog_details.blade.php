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
                    <h2>{{$blogs->title}}</h2>
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
        <h4 class="breadcrumb"><a href="index.html">Home</a><a href="blog.html"><i class="fa-solid fa-angle-right">
        </i>Blog</a> <i class="fa-solid fa-angle-right"></i>{{$blogs->title}}
        </h4>
        <div class="row">
            <div class="col-lg-8">
                <div class="p_left1">
                    <div class="p_left1_img">
                        <img src="{{asset('upload/blog')}}/{{$blogs->image}}" class="w-100 img-fluid" alt="">
                    </div>
                    <h5><span>Hobbies,</span><span>Lifestyle</span></h5>
                    <span>Date -<a class="date-time" href="#">{{$blogs->created_at->format('d M Y')}}
                    </a></span>
                </div>
                <div class="p_left2">
                    <h2>{{$blogs->title}}</h2>
                    <p>{!! $blogs->long_desp !!}</p>
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
                            <h3>Category</h3>
                        </div>
                        <ul>
                            @foreach ($categories as $category)
                            @php
                               $blog_category = App\Models\Blog::where('category_id', $category->id)->get();
                            @endphp
                            <li><a href=""> {{$category->category_name}} <span>{{$blog_category->count()}}</span></a></li>
                            @endforeach
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
                            <a href="#"><img src="{{asset('upload/blog')}}/{{$blog->image}}" alt=""></a>
                        </div>
                        <div class="content">
                            <span class="date"><i class="far fa-calendar"></i>{{$blog->created_at->format('d M Y')}}</span>
                            <h2>
                                <a href="">{{$blog->rel_to_category->category_name}}</a>
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