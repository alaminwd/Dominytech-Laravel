<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Logo;
use App\Models\Project;
use App\Models\Solution;
use App\Models\Support;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function index(){
        
        $banners = Banner::all();
        $abouts = About::all();
        $services = Category::all();
        $blogs = Blog::all();
        $projects = Project::all();
        $testimonial = Testimonial::all();
        $brands = Brand::all();
        $supports  = Support::all();
        $solution = Solution::where('id', 1)->first();

        foreach($banners as $banner){
            $banner_info = $banner;
        }
        foreach($abouts as $about){
            $about_info = $about;
        }
        return view('front-end.index',[
            'banner_info'=>$banner_info,
            'about_info'=>$about_info,
            'services'=>$services,
            'blogs'=>$blogs,
            'projects'=>$projects,
            'testimonial'=>$testimonial,
            'brands'=>$brands,
            'supports'=>$supports,
            'solution'=>$solution,
            
           
        ]);
    }

    // ========== Blog Page =========//

    function blog_page(){
        $categories = Category::all();
        $blogs = Blog::all();
        return view('front-end.blog',[
            'blogs'=>$blogs,
            'categories'=>$categories,
        ]);
    }

    function single_blog($slug){
        $categories = Category::all();
        $blogs = Blog::where('slug', $slug)->first();
        $blog_info = Blog::all();
        return view('front-end.blog_details',[
            'blogs'=>$blogs,
            'categories'=>$categories,
            'blog_info'=>$blog_info,
        ]);
    }




    // ======= Service Page =======//

    function service_page(){
        $services = Category::all();
        return view('front-end.service',[
            'services'=>$services,
        ]);
    }

    function single_service($slug){
        $category = Category::where('slug', $slug)->first();
        $categories = Category::all();
        $blog_info = Blog::all();
        return view('front-end.single_service',[
            'category'=>$category,
            'categories'=>$categories,
            'blog_info'=>$blog_info,
        ]);
    }

    // ========== Project ===========//
    function all_project(){
        $projects = Project::all();
        return view('front-end.project',[
            'projects'=>$projects
        ]);
    }
    

    function project_info($slug){
        $project_info = Project::where('slug', $slug)->first();
        $blog_info = Blog::all();
        return view('front-end.single_project',[
            'project_info'=>$project_info,
            'blog_info'=>$blog_info,
        ]);
    }


    // ========= Contact Page =======//
    function contact_page(){
        $contact_info = Contact::where('id', 1)->first();
        return view('front-end.contact',[
            'contact_info'=>$contact_info,
        ]);
    }


    // ========== About Page =========//
    function about_page(){
        $solution = Solution::where('id', 1)->first();
        $abouts = About::all();
        $testimonial = Testimonial::latest()->take(4)->get();
        foreach($abouts as $about){
            $about_info = $about;
        }
        return view('front-end.about',[
            'about_info'=>$about_info,
            'solution'=>$solution,
            'testimonial'=>$testimonial,
        ]);
    }
}
