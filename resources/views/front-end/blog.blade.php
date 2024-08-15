@extends('front-end.master')

@section('content_master')
    <!-- =======================================
             Blog Banner page 
===========================================-->
<section id="samiler_banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner_title_two">
                    <h2>Blog</h2>
                </div>
            </div>
        </div>
    </div>
</section>

  <!-- =======================================
             Blog page Start 
===========================================-->

<section id="blog_page">
    <div class="container">
        <h4 class="breadcrumb">
            <a href="{{route('index')}}">Home</a><a href="{{route('blog.page')}}"><i class="fa-solid fa-angle-right">
        </i>Blog</a>
        </h4>
        <div class="row">
           <div class="col-lg-8 col-md-7">
                <div class="row">
                    @foreach ($blogs as $blog)
                    <div class="col-lg-6">
                        <div class="blog_item">
                            <div class="blog-post-thumb-two">
                                <a class="blog_img" href="{{route('single.blog', $blog->slug)}}">
                                    <img src="{{asset('upload/blog')}}/{{$blog->image}}" class="w-100 img-fluid" alt="">
                                </a>
                                <a href="#" class="tag">{{$blog->rel_to_category->category_name}} </a>
                            </div>
                            <div class="blog-post-content">
                                <h2><a href="{{route('single.blog', $blog->slug)}}">{{$blog->title}}</a></h2>
                                <p>{{$blog->short_desp}}</p>
                                <div class="blog_footer_content">
                                    <ul>
                                        <li><i class="fa-solid fa-calendar-days"></i>{{$blog->created_at->format('d-m-Y')}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
           </div>
           <div class="col-lg-4 col-md-5">
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
                             <li><a href="#">{{$category->category_name}} <span>{{$blog_category->count()}}</span></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="recent_pst_section">
                <div class="blog_title">
                    <h3>Recent Post</h3>
                </div>
                @foreach ($blogs as $blog)
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


@section('footer_master')
    
@endsection