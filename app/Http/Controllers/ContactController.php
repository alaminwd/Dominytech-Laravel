<?php

namespace App\Http\Controllers;

use App\Mail\SendingMailForUser;
use App\Models\Contact;
use App\Models\ContactMessage;
use App\Models\UserMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class ContactController extends Controller
{
    function request_message(){
        $messages =  UserMessage::latest()->paginate(10);
        return view('back-end.notification.request_message',[
            'messages'=>$messages,
        ]);
    }

    function request_form(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string',
        ]);
      

        UserMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'desp' => $request->message, 
        ]);

        return response()->json([
        'status' => 'success', 
        'message' => 'Message sent successfully!']);
    }



    // ===== Pagination ======//
    // public function pagination(Request $request)
    // {
    //     $messages = UserMessage::latest()->paginate(10);
    //     return view('back-end.notification.message_paginate', [
    //         'messages' => $messages,
    //     ])->render();
    // }
        

    //======== Notification Clear ========//
    function clearAll(Request $request){
        UserMessage::where('status', 0)->update(['status' => 1]);
        return response()->json(['success' => true]);
    } 

     function notifications_view(Request $request){
        $message = UserMessage::find($request->message_id);
        if ($message && $message->status == 0) {
            $message->status = 1;
            $message->save();
        }
        return view('back-end.notification.notification_view', ['message' => $message]);
    }


    public function send_mail(Request $request){
        $data = $request->all();

        Mail::to($data['email'])->send(new SendingMailForUser($data));
        
        return response()->json(['message' => 'Email sent successfully!']);
    }

    function delete_notifications(Request $request){
        $message = UserMessage::find($request->notification_id);
        if ($message) {
            $message->delete(); 
            return response()->json([
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Message not found'
            ], 404);
        }
    }

    // ============ Contact Message Logic ===========//

    function send_message(Request $request){
        
        $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|string|email|max:50',
            'subject' => 'nullable|string|max:100',
            'phone' => 'required|numeric|digits_between:1,15',
            'desp' => 'required|string|max:255',
        ]);
    
        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'desp' => $request->desp,
        ]);
    
        return response()->json(['status' => 'success']);
    
    }

    function message_clear(Request $request){
        ContactMessage::where('status', 0)->update(['status' => 1]);
        return response()->json(['success' => true]);
    }

     function view_message(Request $request){
        $contact_message = ContactMessage::find($request->contact_id);
    
        if ($contact_message && $contact_message->status == 0) {
            $contact_message->status = 1;
            $contact_message->save();
        }
    
        return view('back-end.contact.view_message', compact('contact_message'));
    }
    
    function reply_message(Request $request){
        $data = $request->all();

        Mail::to($data['email'])->send(new SendingMailForUser($data));
        
       return response()->json(['message' => 'Email sent successfully!']);
    }

    function contact_message(){
        $message_info = ContactMessage::latest()->paginate(15);
        return view('back-end.contact.contact_message',[
            'message_info'=>$message_info,
        ]);
    }

     function delelte_message(Request $request){
        $message = ContactMessage::find($request->contact_id);
        if ($message) {
            $message->delete(); 
            return response()->json([
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Message not found'
            ], 404);
        }
    }



    // ==== Contact Text =====//

    function contact(){
        $contact = Contact::where('id', 1)->first();
        return view('back-end.contact.contact',[
            'contact'=>$contact,
        ]);
    }

    function update_content(Request $request){
        Contact::where('id',$request->id)->update([
            'sub_title'=>$request->sub_title,
            'title'=>$request->title,
            'desp'=>$request->description,
        ]);
        return redirect()->back()->with('success', "Footer information update successfully !");
    }
}

