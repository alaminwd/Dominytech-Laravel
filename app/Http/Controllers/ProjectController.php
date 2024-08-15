<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Image;

class ProjectController extends Controller
{
    function project(){
        $projects = Project::all();
        $categories = Category::all();
        return view('back-end.project.project',[
            'categories'=>$categories,
            'projects'=>$projects,

        ]);
    }


    public function add_project(Request $request){
        $validatedData = $request->validate([
            'class' => 'string|max:50',
            'category_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projects,slug',
            'client' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Handle file upload
        $image = $request->file('image');
        $file_name = $request->slug . '.' . $image->getClientOriginalExtension();
        Image::make($image)->save(public_path('upload/project/' . $file_name));
    
        // Create a new project
        $project = Project::create([
            'class' => $request->class,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => $request->slug,
            'client' => $request['client'],
            'location' => $request->location,
            'short_description' => $request->short_desp,
            'image' => $file_name,
        ]);
    
        if ($project) {
            return response()->json(['status' => 'success', 'message' => 'Project added successfully!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to add project.']);
        }
    }



    function delete_project(Request $request){
        $project_id = $request->input('project_id');
        $present_img = Project::find($project_id);
        if ($present_img && $present_img->image != null) {
            $image_path = public_path('upload/project/' . $present_img->image);
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
