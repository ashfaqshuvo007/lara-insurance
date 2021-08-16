<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;


class RegisterUserController extends Controller
{
    public function postSaveRegisterUser(Request $request)
    {
        $input=$request->all();
         $validator =  Validator::make($input, [
                            'name' => ['required', 'string', 'max:255'],
                            'email' => ['required', 'string', 'regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/', 'max:255', 'unique:users'],
                            'password' => ['required', 'string', 'min:8', 'confirmed'],
                        ]);
        if($validator->fails()) 
        {
            return back()
               ->withErrors($validator)
               ->withInput();
        }
        User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'user_id' => uniqid(),
            'user_type'=>'admin',
            'password' => Hash::make($input['password']),
        ]);
        return redirect('/admin-login');
        
    }
}
