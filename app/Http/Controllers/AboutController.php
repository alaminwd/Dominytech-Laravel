<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Brand;
use App\Models\Solution;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
Use Image;

class AboutController extends Controller
{
    function edit_about(){
        $abouts = About::all();
        foreach($abouts as $about){
            $about_info = $about;
        };
        return view('back-end.about.update_about',[
            'about_info'=>$about_info,
        ]);
    }

    function about_content(Request $request){
        $request->validate([
            'title'=>'required',
            'desp'=>'required',
            'project'=>'required',
            'client'=>'required',
        ]);

        $about =About::where('id', 1)->first();

        $about->update([
            'title'=>$request->title,
            'desp'=>$request->desp,
            'project'=>$request->project,
            'client'=>$request->client,
        ]);

        return response()->json([
            'status' => 'success',
        ]);
    }


    function about_image(Request $request){
        $about =About::where('id', 1)->first();

        // Delete the old image if it exists
        if ($about->main_image != null) {
            unlink(public_path('upload/about/'.$about->main_image));
        }
        if ($about->side_image != null) {
            unlink(public_path('upload/about/'.$about->side_image));
        }

        // $main_image = $request->file('main_image');
        // $extension = $main_image->getClientOriginalExtension();
        // $file_name = $about->id.'.'.$extension;
        // Image::make($main_image)->save(public_path('upload/about/'.$file_name));
        
    
        $main_image = $request->file('main_image');
        $extension_one = $main_image->getClientOriginalExtension();
        $file_name_one ='01'.'.'.$extension_one;
        Image::make($main_image)->save(public_path('upload/about/'.$file_name_one));

        $side_image = $request->file('side_image');
        $extension_two = $side_image->getClientOriginalExtension();
        $file_name_two ='02'.'.'.$extension_two;
        Image::make($side_image)->save(public_path('upload/about/'.$file_name_two));
       
       
    
        // Update the user's image in the database
        $about->update([
            'main_image' =>$file_name_one,
            'side_image' =>$file_name_two,
        ]);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Your photo successfully updated',
        ]);
    }


    // ====== Brand Logo ======//

    function brand(){
        $brands = Brand::all();
        return view('back-end.about.brand_logo',[
            'brands'=>$brands,
        ]);
    }

    function add_brand(Request $request){
        $request->validate([
            'name' => 'required|string|max:30',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $image = $request->file('image');
        $file_name = $request->name . '.' . $image->getClientOriginalExtension();
        Image::make($image)->save(public_path('upload/brand/' . $file_name));
    
        Brand::create([
            'name' => $request->name,
            'image' => $file_name,
        ]);
    
        return response()->json(['status' => 'success', 'message' => 'Review added successfully!']);
    }

    function delete_brand(Request $request){
        $brand_id = $request->input('brand_id');
        $present_img = Brand::find($brand_id);
        if ($present_img && $present_img->image != null) {
            $image_path = public_path('upload/brand/' . $present_img->image);
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


    // ===== business solution ====//

    function solution(){
        $solution = Solution::where('id', 1)->first();
        return view('back-end.about.solution',[
            'solution'=>$solution,
        ]);
    }
    
    public function update_solution(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'desp' => 'required|string|max:255',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7168', // Updated validation for optional image
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }

        $solution = Solution::find($request->id);

        if (!$solution) {
            return response()->json(['status' => 'error', 'message' => ['Solution not found']]);
        }

        if ($solution->image != null) {
            // Remove the old image file
            if (file_exists(public_path('upload/solution/' . $solution->image))) {
                unlink(public_path('upload/solution/' . $solution->image));
            }
        }

        $solution->title = $request->title;
        $solution->desp = $request->desp;

        if ($request->hasFile('image')) {
            $main_image = $request->file('image');
            $extension = $main_image->getClientOriginalExtension();
            $file_name = '01' . '.' . $extension;
            Image::make($main_image)->save(public_path('upload/solution/' . $file_name));
            $solution->image = $file_name; // Save the file name to the database
        }

        $solution->save();

        return response()->json(['status' => 'success', 'message' => 'Solution updated successfully']);
    } catch (\Exception $e) {
        Log::error('Error updating solution: ' . $e->getMessage());
        return response()->json(['status' => 'error', 'message' => ['An error occurred while updating the solution. Please try again later.']]);
    }
}
}
