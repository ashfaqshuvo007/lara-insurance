<?php

namespace App\Http\Controllers\Frontend\Authorization;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class LoginController extends Controller
{
    public function login(LoginRequest $request){
    
        $input = $request->all();
        $validated = $request->validated();
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password])
        ){
        }
        else{
            return response()->json(['success' => false, 'errors' => 'Something Went Wrong!','status'=>1],400);

        }
        // return back();
        
    }

    public function showLoginForm()
    {
        return view('fontend.head-index.login-signup'); 
    }
}
