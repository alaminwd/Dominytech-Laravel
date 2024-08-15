<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Logo;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class NavbarController extends Controller
{
    function navbar_menu(){
      $menus = Menu::all();
        return view('back-end.navbar&banner.menu',[
          'menus'=>$menus,
        ]);
    }

    function add_menu(Request $request){
      $request->validate([
            'menu_name'=>'required',
            'menu_link'=>'required',
      ]);

      Menu::insert([
        'menu_name'=>$request->menu_name,
        'menu_link'=>$request->menu_link,
        'created_at'=>Carbon::now(),
      ]);
      return response()->json(['status' => 'success', 'message' => 'Category added successfully!']);

    }


    // ========== Delete Menu ==========//
    public function delete_menu(Request $request) {
      $menu_id = $request->input('menu_id');
      $menu = Menu::find($menu_id);
  
          $menu->delete();
          return response()->json([
              'status' => 'success',
          ]);

      }

      // ======== Navbar Menu Update ===========//

      function update_menu(Request $request){
        $request->validate([
          'menu_name'=>'required',
          'menu_link'=>'required',
        ]);

        Menu::where('id', $request->menu_id)->update([
          'menu_name'=>$request->menu_name,
          'menu_link'=>$request->menu_link,
        ]);

          return response()->json([
            'status'=>'success',
        ]);

      }


      // ============= Logo =============//

      function menu_logo(){
        $logos = Logo::all();
        return  view('back-end.navbar&banner.logo',[
          'logos'=>$logos,
        ]);
      }

      public function add_logo(Request $request) {
        $request->validate([
            'logo_name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $image = $request->file('logo');
        $logo_name = $request->logo_name;
        $extension = $image->getClientOriginalExtension();
        $file_name = $logo_name . '.' . $extension;
    
        Image::make($image)->save(public_path('upload/logo/' . $file_name));
    
        Logo::insert([
            'logo_name' => $request->logo_name,
            'logo' => $file_name,
            'created_at'=>Carbon::now(),
        ]);
    
        return response()->json([
            'status' => 'success',
            // 'message' => 'Your Logo successfully updated',
        ]);
    }



    function logo_delete(Request $request){
      $logo_id = $request->input('logo_id');
      $present_img = Logo::find($logo_id);
      if ($present_img && $present_img->logo != null) {
          $image_path = public_path('upload/logo/' . $present_img->logo);
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



    // =========== Banner ========//

    function banner(){
      $banners = Banner::all();
      foreach($banners as $banner){
        $banner_info = $banner;
      }
      return view('back-end.navbar&banner.banner',[
        'banner_info'=>$banner_info,
      ]);
    }


    function update_banner(Request $request){
      $request->validate([
          'sub_title' => 'required',
          'title' => 'required',
          'desp' => 'required',
          'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Optional image validation
      ]);
  
      // Find the banner by ID
      $banner = Banner::where('id', 1)->first();
  
      // Check if an image was uploaded and process it
        if ($request->hasFile('image')) {
            // Delete existing image if it exists
            if ($banner->image != null) {
                $image_path = public_path('upload/banner/'.$banner->image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
    
            // Upload new image
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $file_name ='banner-01'.'.'.$extension;
            Image::make($image)->save(public_path('upload/banner/'.$file_name));
          
    
            // Update banner with new image
            $banner->update([
                'sub_title' => $request->sub_title,
                'title' => $request->title,
                'desp' => $request->desp,
                'image' => $file_name,
            ]);
            return back();
        } else {
            // Update banner without changing the image
            $banner->update([
                'sub_title' => $request->sub_title,
                'title' => $request->title,
                'desp' => $request->desp,
            ]);

            return back();
        }
  
    }
}
