<?php

namespace App\Http\Controllers;

use App\Models\FooterInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FooterController extends Controller
{
    function footer(){
        $footer_info = FooterInfo::where('id', 1)->firstOrFail();
        return view('back-end.footer.update_footer',[
            'footer_info'=>$footer_info,
        ]);
    }

  public function update_footer(Request $request){
 

    $validator = Validator::make($request->all(), [
        'email' => 'required|string|max:255',
        'phone' => 'required|string|max:25',
        'description' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->with('error', $validator->errors()->first());
    }

    FooterInfo::where('id', $request->id)->update([
        'email'=>$request->email,
        'phone'=>$request->phone,
        'desp'=>$request->description,
    ]);

    return redirect()->back()->with('success', "Footer information update successfully !");


    // if ($update) {
    //     return response()->json(['status' => 'success', 'message' => 'Category updated successfully!']);
    // } else {
    //     return response()->json(['status' => 'error', 'message' => 'Failed to update the category.']);
    // }
}

}
