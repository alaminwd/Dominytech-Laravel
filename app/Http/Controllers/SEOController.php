<?php

namespace App\Http\Controllers;

use App\Models\SEO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class SEOController extends Controller
{

    function seo(){
        return view('back-end.seo.add_seo');
    }

    function add_seo(Request $request){
        $validator = Validator::make($request->all(),[
        'type' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'keywords' => 'required|string|max:255',
        'canonical' => 'required|url',
        'og_locale' => 'required|string|max:30',
        'og_url' => 'required|url',
        'og_type' => 'required|string|max:30',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'description' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            // return redirect()->with(['status' => 'error', 'message' => $validator->errors()]);
            // return redirect()->with('invalid', $validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $image = $request->file('image');
                $file_name = $request->slug . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save(public_path('upload/seo/' . $file_name));

        SEO::create([
            'type'=>$request->type,
            'title'=>$request->title,
            'slug'=>$request->slug,
            'author'=>$request->author,
            'keywords'=>$request->keywords,
            'canonical'=>$request->canonical,
            'og_locale'=>$request->og_locale,
            'og_url'=>$request->og_url,
            'og_type'=>$request->og_type,
            'image'=>$request->og_type,
            'desp'=>$request->description,
        ]);

    }
}
