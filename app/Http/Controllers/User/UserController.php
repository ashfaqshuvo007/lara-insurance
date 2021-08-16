<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;

class UserController extends Controller
{
    public function getShowProfile()
    {
        $user = User::where('user_id',Auth::user()->user_id)->first();
        // dd($user);
        return view('profile.user-profile',['user'=>$user]);
    }
    public function getShowViewPolicy()
    {
        return view('viewpolicy.policy-view');
    }

    public function postSaveuserUpdateDeatils(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $validator = Validator::make($input, [
                        'name' => 'required|string|max:255',
                        'email' => ['required', 'max:255', 'regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/'],
                        'phone' => 'required|min:6|max:10'
                    ]);
        if($validator->fails()) 
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $email = Auth::user()->email;
        $phone = Auth::user()->phone;
        if($input['email'] != $email)
        {
            
            $validator = Validator::make($input, [
                'email' => ['required', 'max:255', 'regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/','unique:users']
            ]);
            if($validator->fails()) 
            {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        elseif($input['phone'] != $phone )
        {
            $validator = Validator::make($input, [
                'phone' => 'required|min:6|max:10|unique:users'
            ]);
            if($validator->fails()) 
            {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        if(isset($input['profile_image']))
        {
            $validator = Validator::make($input, [
                'profile_image' => 'mimes:jpeg,jpg,png'
            ]);
            if($validator->fails()) 
            {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
            if($request->hasFile('profile_image'))
            {
                $fileName = "profile_image".time().'.'.$request->file('profile_image')->extension(); 

                $user_deatils = User::where('user_id',Auth::user()->user_id)->first();

                $user_image = $user_deatils['profile_image'];
                
                if(isset($user_image))
                {
                    if(file_exists(public_path('/storage/uploads/'.$user_image)))
                    {
                        unlink(public_path('/storage/uploads/'.$user_image));
                    }
                }
                
                $request->file('profile_image')->move(public_path('storage/uploads'), $fileName);
           
                $user = User::where('user_id',Auth::user()->user_id)->update([
                    'name'=>$input['name'],
                    'email'=>$input['email'],
                    'phone'=>$input['phone'],
                    'profile_image'=>$fileName
                ]);
                Toastr::success('Profile Updated Sucessfully', 'Success');                
                return back();
            }
            else{
                Toastr::error('Their is some error', 'Error');
                return back();
            }
        }
        else{
            $user = User::where('user_id',Auth::user()->user_id)->update([
                'name'=>$input['name'],
                'email'=>$input['email'],
                'phone'=>$input['phone']
            ]);
            Toastr::success('Profile Updated Sucessfully', 'Success');                
            return back();
        }
        
    }
    public function postSavePassword(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'old_password'     => 'required',
            'new_password'     => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);
        if($validator->fails()) 
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::where('user_id',Auth::user()->user_id)->first();
        if (Hash::check($input['old_password'], $user->password))
        {
            User::where('user_id',Auth::user()->user_id)->update([
                'password'=> Hash::make($input['new_password'])
            ]);
            Toastr::success('Password Updated Sucessfully', 'Success');                
            return back();
        }
        else{
            Toastr::error('Password not matched', 'Error');                
            return back();
        }
       
    }
}
