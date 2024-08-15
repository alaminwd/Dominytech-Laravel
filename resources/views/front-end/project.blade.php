@extends('front-end.master')


@section('content_master')
    <!-- =======================================
            Single Service Banner 
===========================================-->
<section id="samiler_banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner_title_two">
                    <h2>Our Project</h2>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ============================== 
        footer part start
==================================== -->
<section id="Project">
    <div class="container">
        <h4 class="breadcrumb">
            <a href="{{route('index')}}">Home</a><a href="blog.html"><i class="fa-solid fa-angle-right">
        </i>Project</a>
        </h4>
        <div class="cmn_title">
            <h2 class="title">Our completed projects list</h2>
            <p>We Have Extensive Experience Building Enterprise-Grade Applications Using Modern Technologies.
            </p>
        </div>
        <div class="row">
            @foreach ($projects as $project)
            <div class="col-lg-4 col-sm-6">
                <div class="project-item">
                    <div class="project-img">
                        <img src="{{asset('upload/project')}}/{{$project->image}}" class="w-100 img-fluid" alt="">
                    </div>
                    <div class="project-title">
                        <h4>{{$project->title}}</h4>
                        <a href="{{route('project.info', $project->slug)}}">Read More<i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection


@section('footer_master')
    
@endsection