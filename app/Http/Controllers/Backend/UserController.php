<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;


class UserController extends Controller
{
    function userInfo(){
        $users = User::where('id', '!=', Auth::id())->get();
        return view('back-end.users.users',[
            'users'=>$users,
        ]);
    }

    function edit_profile(){
        return view('back-end.users.edit_profile');
    }

    // ======== Update Name and Email ========//

    function update_profile(Request $request){

        $request->validate([
            'name'=>'required',
            'email'=>'required',
        ]);

      
        User::find(Auth::id())->update([
            'name'=>$request->name,
            'email'=>$request->email,
        ]);
        // return response()->json([
        //     'status'=>'sucess',
        // ]);
        return back();
    }

// ================ Update Password ===============//

    function update_password(Request $request){
        $request->validate([
            'old_password'=>'required',
            'password'=>'required',
            'password'=>'confirmed',
            'password_confirmation'=>'required',
         
        ]);

        if (Hash::check($request->old_password, Auth::user()->password)) {
            User::find(Auth::id())->update([
                'password' => bcrypt($request->password),
            ]);
            // return response()->json(['status' => 'success', 'message' => 'Password successfully updated']);
            return response()->json([
                'status'=>'success',
                'message' => 'Password successfully updated',
            ]);                                
        } 
        else {
            return response()->json(['message' => 'Your old password is incorrect'], 422);
        }
    }


     // ======== upload Image ========//

    function update_image(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:8048', // max 2MB
        ]);
    
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        $file_name = Auth::id().'.'.$extension;
    
        // Delete the old image if it exists
        if (Auth::user()->photo != null) {
            unlink(public_path('upload/user/'.Auth::user()->photo));
        }
    
        // Save the new image
        Image::make($image)->save(public_path('upload/user/'.$file_name));
    
        // Update the user's image in the database
        User::find(Auth::id())->update([
            'photo'=>$file_name,
        ]);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Your photo successfully updated',
        ]);
    }


// =========== Delete User =============//

    public function user_delete(Request $request) {
        $user_id = $request->input('user_id');
        $present_img = User::find($user_id);
        if ($present_img && $present_img->photo != null) {
            $image_path = public_path('upload/user/' . $present_img->photo);
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
