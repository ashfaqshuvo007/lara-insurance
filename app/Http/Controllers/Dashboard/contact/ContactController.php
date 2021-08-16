<?php

namespace App\Http\Controllers\Dashboard\contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function getShowContact()
    {
        $address_details = Contact::first();
        if(empty($address_details)){
            return view('dashboard.contact.contact');
       
        }else if(!empty($address_details)){

            $data['address_details'] = $address_details;
            return view('dashboard.contact.contact', $data);

        }

    }

    public function Contact(Request $request)
    {
        $user = Auth::user();
        $input= $request->all();
        $input['user_id'] = $user['user_id'];
        $address_details = Contact::first();
        if(!empty($address_details)){

            $update = Contact::where('id', $address_details['id'])->update([
                'address'=>$input['address'],
                'primary_number'=>$input['primary_number'],
                'alternate_number'=>$input['alternate_number'],
                'email' =>  $input['email'],
                'created_by'=> $input['user_id']
            ]);  
            if($update){
                Toastr::success('Contact Information Updated Successfully', 'Success');
                return back();

            }else{
                Toastr::error('Contact Information Updated Not Successfully', 'Error');
            }

        }else {
            // dd($input);
            $create = Contact::create([
                'address'=>$input['address'],
                'primary_number'=>$input['primary_number'],
                'alternate_number'=>$input['alternate_number'],
                'email' =>  $input['email'],
                'created_by'=> $input['user_id']
            ]);
            if($create){
                Toastr::success('Contact Information Updated Successfully', 'Success');
                return back();

            }else{
                Toastr::error('Contact Information Updated Not Successfully', 'Error');

            }
        }
        $data['address_details'] = $input;
        return view('dashboard.contact.contact', $data);
        
        // return view('dashboard.contact.contact');

    }
    
}
