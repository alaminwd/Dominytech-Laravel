<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Image;


class BlogController extends Controller
{
    function blog(){
        $categories = Category::all();
        $blogs = Blog::with('rel_to_category')->get();

        return view('back-end.blog.blog',[
        'categories' => $categories,
            'blogs' => $blogs,
        ]);
    }

    public function add_blog(Request $request) {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'short_description' => 'required',
            'image' => 'required',
        ]);
    
        $image = $request->file('image');
        $file_name = $request->slug.'.'.$image->getClientOriginalExtension();
        Image::make($image)->save(public_path('upload/blog/' . $file_name));
    
        Blog::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => $request->slug,
            'short_desp' => $request->short_description,
            'long_desp' => $request->long_description,
            'image' => $file_name,
        ]);
    
        return response()->json(['status' => 'success', 'message' => 'Blog added successfully!']);
    }


    function blog_edit($slug, $id){
        $blog = Blog::where('slug', $slug)->where('id', $id)->firstOrFail();
        return view('back-end.blog.blog_edit',[
            'blog'=>$blog,
        ]);
    }


    // public function blog_edit($slug)
    //     {
    //         $blog = Blog::where('slug', $slug)->first();
            
    //         if (!$blog) {
    //             // Handle the case where the blog is not found
    //             return redirect()->back()->with('error', 'Blog not found');
    //         }

    //         return view('back-end.blog.blog_edit', [
    //             'blog' => $blog,
    //         ]);
    //     }



    public function update_blog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'slug' => 'required|string|max:100',
            'short_desp' => 'required|string|max:255',
            'long_desp' => 'required|string', // added validation for long_desp
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
    
        $blog = Blog::find($request->id);
        
        if(!$blog) {
            return response()->json(['status' => 'error', 'message' => 'Blog not found']);
        }
    
        $blog->title = $request->title;
        $blog->slug = $request->slug;
        $blog->short_desp = $request->short_desp; // corrected input name
        $blog->long_desp = $request->long_desp; // corrected input name
    
        if($request->hasFile('image')){
            if($blog->image != ''){
                $image_path = public_path('upload/blog/' . $blog->image);
                unlink($image_path);
            } 
            $image = $request->file('image');
            $file_name = $request->slug.'.'.$image->getClientOriginalExtension();
            Image::make($image)->save(public_path('upload/blog/' . $file_name));
            $blog->image = $file_name;
        }
    
        $blog->save();
    
        return response()->json(['status' => 'success', 'message' => 'Blog updated successfully']);
    }


    function delete_blog(Request $request){
        $blog_id = $request->input('blog_id');
        $present_img = Blog::find($blog_id);
        if ($present_img && $present_img->image != null) {
            $image_path = public_path('upload/blog/' . $present_img->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
    
        if ($present_img) {
            $present_img->delete();
            return response()->json([
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
            ]);
        }
    }
    

}
