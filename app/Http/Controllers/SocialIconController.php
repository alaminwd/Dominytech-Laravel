<?php

namespace App\Http\Controllers;

use App\Models\Social_Icon;
use App\Models\SocialIcon;
use Illuminate\Http\Request;

class SocialIconController extends Controller
{
    function social(){
        $icons = SocialIcon::all();
        return view('back-end.notification.social_icon',[
            'icons'=> $icons ,
        ]);
    }

    public function add_icon(Request $request)
    {
        // Validate the request data
        $request->validate([
            'icon' => 'required|string',
            'icon_link' => 'required|url',
        ]);

        // Create a new social icon
        SocialIcon::create([
            'icon' => $request->icon,
            'icon_link' => $request->icon_link,
        ]);

        // Return a JSON response indicating success
        return response()->json(['status' => 'success', 'message' => 'Social icon added successfully!']);
    }

    function delete_icon(Request $request){
         SocialIcon::find($request->icon_id)->delete();
         return response()->json(['status' => 'success', 'message' => 'Social icon deleted successfully!']);
    }

    // function update_status($id) {
    //     $get_icon = SocialIcon::find($id);
    //     if ($get_icon) { 
    //         if ($get_icon->status == 1) {
    //             SocialIcon::where('id', $id)->update(['status' => 0]);
    //         } else {
    //             SocialIcon::where('id', $id)->update(['status' => 1]);
    //             SocialIcon::where('id', '!=', $id)->update(['status' => 0]);
    //         }
    //     }
    // }
    
    function update_status($id) {
        $get_icon = SocialIcon::find($id);
        if ($get_icon) {
            $activeCount = SocialIcon::where('status', 1)->count();
    
            if ($get_icon->status == 1) {
                // Set the status to inactive
                SocialIcon::where('id', $id)->update(['status' => 0]);
                return redirect()->back()->with('success', 'Status updated to inactive.');
            } else {
                if ($activeCount <= 5) {
                    
                    SocialIcon::where('id', $id)->update(['status' => 1]);
                    return redirect()->back()->with('success', 'Status updated to active.');
                } else {
                    return redirect()->back()->with('limit', 'Maximum active status limit reached.');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Social icon not found.');
        }
    }
    
    
}
