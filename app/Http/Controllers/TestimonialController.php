<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Image;

class TestimonialController extends Controller
{
    function testimonial(){
        $reviews = Testimonial::all();
        return view('back-end.testimonial.testimonial',[
            'reviews'=>$reviews,
        ]);
    }

    function add_review(Request $request){
        $request->validate([
            'name' => 'required|string|max:30',
            'profession' => 'required|string|max:30',
            'comment' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $image = $request->file('image');
        $file_name = $request->name . '.' . $image->getClientOriginalExtension();
        Image::make($image)->save(public_path('upload/client/' . $file_name));
    
        Testimonial::create([
            'name' => $request->name,
            'profession' => $request->profession,
            'comment' => $request->comment,
            'image' => $file_name,
        ]);
    
        return response()->json(['status' => 'success', 'message' => 'Review added successfully!']);
    }

    function delete_review(Request $request){
        $review_id = $request->input('review_id');
        $present_img = Testimonial::find($review_id);
        if ($present_img && $present_img->image != null) {
            $image_path = public_path('upload/client/' . $present_img->image);
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
