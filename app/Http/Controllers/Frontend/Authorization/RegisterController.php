<?php

namespace App\Http\Controllers\Frontend\Authorization;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use Illuminate\Http\Request;
use Validator;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

class RegisterController extends Controller
{
    public function showRegisterPage()
    {
        $register =1;
        return view('fontend.head-index.login-signup',['register'=>$register]); 
    }

    public function postSaveRegister(SignupRequest $request)
    {
         //check validation
        $input = $request->all();

        $validated = $request->validated();

        $find_user = User::where('phone',$input['phone_number'])->first();
           
        if(!empty($find_user))
        {
            $error_phone_number=trans('layout-errors.phone_number_taken');
            return response()->json(['success' => false, 'errors' =>['phone_number'=>$error_phone_number]], 400);
        }
        try{
            $user_id = uniqid();
            //user create
            $user = User::create([
                        'name' => $input['first_name']." ".$input['last_name'],
                        'email' => $input['email'],
                        'user_type' => $input['user_type'],
                        'user_id' =>$user_id,
                        'country_code'=>"+".$input['country_code'],
                        'phone' => $input['phone_number'],
                        'password' => Hash::make($input['password']),
                        'is_verified'=>empty($input['is_verified'])?0:1
                    ]);
            //customer create
            $customer = Customer::create([
                'user_id' => $user_id,
                'customer_id' => uniqid()
            ]);
            if($user) {
                return response()->json(['success' => true, 'message' => 'Registration successfully completed!'],201);
            } else {
                return response()->json(['success' => false, 'message' => 'Registration could not be completed!'],400);
            }
        }
        //catch exception
        catch(Exception $e) {
            return response()->json(['success' => false, 'error' =>$e->getMessage()],400);
            // echo 'Message: ' .$e->getMessage();
        }
    }
}
