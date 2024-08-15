<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Illuminate\Http\Request;

class QuickSupport extends Controller
{
    function support(){
        $supports = Support::all();
        return view('back-end.about.support',[
            'supports'=>$supports,
        ]);
    }

    function support_edit($id){
        $info = Support::find($id); // Find method returns a single record directly
        if (!$info) {
            // Handle the case where the record is not found, e.g., redirect or show an error
            return redirect()->route('support.index')->withErrors('Support record not found.');
        }
        return view('back-end.about.support_edit', [
            'info' => $info,
        ]);
    }
    

    function update_support(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'id' => 'required|exists:supports,id',
        'title' => 'required|string|max:100',
        'desp' => 'required|string|max:255',
    ]);

    // Find the record and update it
    $support = Support::find($request->id);
    
    if ($support) {
        $support->update([
            'title' => $request->title,
            'desp' => $request->desp,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('cart-update', 'Support record updated successfully.');
    } else {
        // Handle the case where the record is not found
        return redirect()->back()->with('cart-error', 'Support record not found.');
    }
}

}
