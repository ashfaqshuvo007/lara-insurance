<?php

namespace App\Http\Controllers\Password;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Password;



class ResetPasswordController extends Controller
{
    public function passwordReset(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'email' => ['required', 'max:255', 'regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/'],
            'password' => ['required', 'string', 'min:8', 'same:confirmed'],
        ]);
        if($input['password']!=$input['confirmed']){
            Toastr::error("Password and confirm password mismatch!",'Error');
        }
        if($validator->fails()) 
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $find_email = User::where('email',$input['email'])->first();
        if(!empty($find_email))
        {
            $password_update = User::where('email',$input['email'])->update(['password'=> Hash::make($input['password'])]);
            if($password_update)
            {
                Toastr::success('Password Updated Sucessfully', 'Success');
                // return redirect()->route('login');
                return back();
            }
            else{
                return back();
            }
        }
        else{
            Toastr::error('Email is not registerd', 'Error');
            return back();
        }
        
        
    }

    public function forgotPassword(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'email' => 'required', 
            'language_type' =>'required'
        ]);
        if($validator->fails()) 
        {
            Toastr::error($validator->getMessageBag().'!','Error');
            return back();
            // return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()], 400);
        }
        if($input['language_type'] == 'en')
        {
            $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Toastr::error('Invalid format of email address.','Error');
                return back();
                // return response()->json(['success' => false, 'message' =>'Invalid format of email address.'], 400);
              }
        }
        elseif($input['language_type'] == 'al' || $input['language_type'] == 'sq')
        {
            $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Toastr::error('Email jo i saktë.','Error');
                return back();
                // return response()->json(['success' => false, 'message' =>'Email jo i saktë.'], 400);
            }
        }
        $find_email = User::where('email',$input['email'])->first();       

        if(!empty($find_email))
        {
            $data=[
                'email'=>$find_email['email']
            ];
            //password reset token create 
           
            // return config('mail.from.address');
            
            try {
                $reset = Password::sendResetLink($data, function (Message $message) {
                    $message->subject('Password Reset');
                }); 
                // Mail::send('auth.passwords.mail-send', $data, function($message) use ($find_email) {
                //     $message->from(config('mail.from.address'), 'MYSIG')->subject
                //     ('Reset Password');
    
                //     $message->to($find_email['email']);
                //  });
            }
            catch (\Exception $e){
                Toastr::error($e->getMessage().'!','Error');
                return back();
            }

            if($input['language_type'] == 'en')
            {
                Toastr::success("Please check your email. We have sent a link to reset your password in the email.!",'Success');
                return back();
            }
            elseif($input['language_type'] == 'al' || $input['language_type'] == 'sq')
            {
                Toastr::success("Ju lutem kontrolloni email,ju kemi dërguar link për të ndryshuar password!",'Success');
                return back();
            }
        }
        else{
            if($input['language_type'] == 'en')
            {
                Toastr::error("Your Email Address is not registered!",'Error');
                return back();
            }
            elseif($input['language_type'] == 'al' || $input['language_type'] == 'sq')
            {
                Toastr::error("Adresa Email nuk është e rregjistruar!",'Error');
                return back();
            }
        }
    }

}
