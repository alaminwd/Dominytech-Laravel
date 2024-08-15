<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class CatalogueController extends Controller
{
    function category(){
        $categories = Category::all();
        return view('back-end.catalogue manage.category',[
            'categories'=>$categories,
        ]);
    }

    function add_category(Request $request){
        $validator = Validator::make($request->all(), [
           'category' => 'required|string|max:255|unique:categories,category',
            'slug' => 'required|string|max:255',
            'short_description' => 'required|string|max:255',
            // 'long_description' => 'string',
            'image' => 'required|string|max:255', // Assuming image is a URL or a file path
        ]);

        $image = $request->file('image');
        $file_name = $request->slug. '.' . $image->getClientOriginalExtension();
        Image::make($image)->save(public_path('upload/category_images/'.$file_name));
    

            Category::create([
                'category_name' => $request->category,
                'slug' => $request->slug,
                'short_desp' => $request->short_description,
                'long_desp' => $request->long_description,
                'image'=>$file_name,
            ]);

            return response()->json(['status' => 'success', 'message' => 'Category added successfully!']);
        }


    function delete_category(Request $request){
            $category_id = $request->input('category_id');
            $present_img = Category::find($category_id);
            if ($present_img && $present_img->image != null) {
                $image_path = public_path('upload/category_images/' . $present_img->image);
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



        // ======== Category Edit ========//

        public function edit_category($slug, $id)
        {
            $category = Category::where('slug', $slug)->where('id', $id)->firstOrFail();
    
            return view('back-end.catalogue manage.category_edit',[
                'category'=>$category,
            ]);
        }


        function update_category(Request $request) {
            $validator = Validator::make($request->all(), [
                'category' => 'required|string|max:255',
                'slug' => 'required|string|max:255',
                'short_description' => 'required|string|max:255',
            ]);
        
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()]);
            }
        
            if (!$request->hasFile('image')) {
                Category::where('id', $request->id)->update([
                    'category_name' => $request->category,
                    'slug' => $request->slug,
                    'short_desp' => $request->short_description,
                    'long_desp' => $request->long_description,
                ]);
            } else {
                $image = $request->file('image');
                $file_name = $request->slug . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save(public_path('upload/category_images/' . $file_name));
        
                Category::where('id', $request->id)->update([
                    'category_name' => $request->category,
                    'slug' => $request->slug,
                    'short_desp' => $request->short_description,
                    'long_desp' => $request->long_description,
                    'image' => $file_name,
                ]);
            }
        
            return response()->json(['status' => 'success', 'message' => 'Category updated successfully!']);
        }

            
        

}


