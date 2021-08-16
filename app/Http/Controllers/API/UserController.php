<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Validator;
use JWTAuth;
use Config;
use Illuminate\Support\Facades\Password;
use Tymon\JWTAuth\Exceptions\JWTException;
use Lcobucci\JWT\Parser;
use App\Models\Customer;
use Carbon\Carbon;
use Mail;
use Cookie;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Http\Response;
use Twilio\Rest\Client;
use App\Helpers\UserHelper as UserHelper;
use Brian2694\Toastr\Facades\Toastr;

class UserController extends Controller
{
    
    public $user_helper;
    

    /**
     * Login API
     * @return \Illuminate\Http\Response
     * 
     * @OA\Post(
     *      path="/api/user/login",
     *      operationId="authenticate",
     *      tags={"Auth"},
     *      summary=" Login",
     *      @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="application/json",
     *                      @OA\Schema(
     *                        @OA\Property(
     *                          property="email_phone",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="password",
     *                          type="string"
     *                            ),
     *                         @OA\Property(
     *                          property="language_type",
     *                            type="string"
     *                           ),
     *                 
     *                                 )
     *                           ),
     *                        ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     * 
     */
    public function userLogin(Request $request)
    {
        //check validation
        $input = $request->all();
        $validator = Validator::make($input, [
            'email_phone' => 'required', 
            'password' => 'required',
        ]);
        $data = $validator->errors()->toJson();
        if($validator->fails()){
            return response()->json(['success' => false, 'message' => $data], 400);
        }
        if($input['language_type'] == 'en')
        {
            $email = filter_var($input['email_phone'], FILTER_SANITIZE_EMAIL);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                 //find user 
                 $find_user = User::where('email',$input['email_phone'])->first();
                 if(!empty($find_user))
                 {
                     $credentials=[
                         'email'=>$find_user['email'],
                         'password'=>$input['password']
                     ];
                 }
                 else{
                    return response()->json(['success' => false, 'message' =>'You have entered wrong credentials. Please enter correct credentials to continue.'], 400);
                 }
              }
            elseif (preg_match('/^[0-9]*$/', $input['email_phone'])) {
                //find user 
                $find_user = User::where('phone',$input['email_phone'])->first();
                if(!empty($find_user))
                {
                    $credentials=[
                        'email'=>$find_user['email'],
                        'password'=>$input['password']
                    ];
                }
                else{
                    return response()->json(['success' => false, 'message' =>'You have entered wrong credentials. Please enter correct credentials to continue.'], 400);
                }
            }
            else{
                return response()->json(['success' => false, 'message' =>'You have entered wrong credentials. Please enter correct credentials to continue.'], 400);
            }
        }
        elseif($input['language_type'] == 'sq')
        {
            $email = filter_var($input['email_phone'], FILTER_SANITIZE_EMAIL);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                 //find user 
                 $find_user = User::where('email',$input['email_phone'])->first();
                 if(!empty($find_user))
                 {
                     $credentials=[
                         'email'=>$find_user['email'],
                         'password'=>$input['password']
                     ];
                 }
                 else{
                    return response()->json(['success' => false, 'message' =>'Email ose FjalëKalimi jo i saktë.'], 400);
                 }
              }
            elseif (preg_match('/^[0-9]*$/', $input['email_phone'])) {
                //find user 
                $find_user = User::where('phone',$input['email_phone'])->first();
                if(!empty($find_user))
                {
                    $credentials=[
                        'email'=>$find_user['email'],
                        'password'=>$input['password']
                    ];
                }
                else{
                    return response()->json(['success' => false, 'message' =>'Email ose FjalëKalimi jo i saktë.'], 400);
                }
            }
            else{
                return response()->json(['success' => false, 'message' =>'Email ose FjalëKalimi jo i saktë.'], 400);
            }
        }

        elseif($input['language_type'] == 'al')
        {
            $email = filter_var($input['email_phone'], FILTER_SANITIZE_EMAIL);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                 //find user 
                 $find_user = User::where('email',$input['email_phone'])->first();
                 if(!empty($find_user))
                 {
                     $credentials=[
                         'email'=>$find_user['email'],
                         'password'=>$input['password']
                     ];
                 }
                 else{
                    return response()->json(['success' => false, 'message' =>'Email ose FjalëKalimi jo i saktë.'], 400);
                 }
              }
            elseif (preg_match('/^[0-9]*$/', $input['email_phone'])) {
                //find user 
                $find_user = User::where('phone',$input['email_phone'])->first();
                if(!empty($find_user))
                {
                    $credentials=[
                        'email'=>$find_user['email'],
                        'password'=>$input['password']
                    ];
                }
                else{
                    return response()->json(['success' => false, 'message' =>'Email ose FjalëKalimi jo i saktë.'], 400);
                }
            }
            else{
                return response()->json(['success' => false, 'message' =>'Email ose FjalëKalimi jo i saktë.'], 400);
            }
        }
    //    return $credentials;
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                if($input['language_type'] == 'en')
                {
                    return response()->json(['success' => false, 'message' => 'You have entered wrong credentials. Please enter correct credentials to continue'],401);
                }
                elseif($input['language_type'] == 'al')
                {
                    return response()->json(['success' => false, 'message' => 'Email ose FjalëKalimi jo i saktë.'],401);
                }
                 elseif($input['language_type'] == 'sq')
                {
                    return response()->json(['success' => false, 'message' => 'Email ose FjalëKalimi jo i saktë.'],401);
                }
            }
        } catch (JWTException $e) {
            return response()->json(['success' => false, 'message' => 'Sorry the token could not be created.'],500);
            
        }
       
        $user = auth()->user();
        
        return response()->json(['success' => true, 'user' => $user, 'token' => $token], 200);
    }
    /**
     * @OA\Post(
     *     path="/api/user/register",
     *     operationId="register",
     *     tags={"Auth"},
     *     summary="Registration",
     *     description="Returns registration message",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     * 
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="first_name",
     *                     type="string"
     *                 ),
     *                    @OA\Property(
     *                     property="last_name",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="country_code",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="phone_number",
     *                     type="integer"
     *                 ),
     *                  @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="user_type",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                   @OA\Property(
     *                     property="password_confirmation",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="is_verified",
     *                     type="integer"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function userRegister(Request $request)
    {
        //check validation
        $input = $request->all();
        $validator = Validator::make($input, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'max:255', 'regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/', 'unique:users'],
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'password' => 'required|string|min:8|confirmed',
            'country_code'=>'required'
        ]);
        $find_user = User::where('phone',$input['phone_number'])->first();
        if($validator->fails()){
            return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
        }
        elseif(!empty($find_user))
        {
            return response()->json(['success' => false, 'message' =>'The phone number has already been taken'], 400);
        }

        $user_id = uniqid();
        //user create
        $user = User::create([
                    'name' => $input['first_name']." ".$input['last_name'],
                    'email' => $input['email'],
                    'user_type' => $input['user_type'],
                    'user_id' =>$user_id,
                    'country_code'=>$input['country_code'],
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
  /**
     * @OA\Post(
     *      path="/api/user/update-profile",
     *      operationId="UserUpdateProfile",
     *      tags={"UserDeatils"},
     *      summary="ProfileUpadteApi",
     *          @OA\RequestBody(
     *            @OA\MediaType(
     *                 mediaType="application/json",
     *          @OA\Schema(
     *                 @OA\Property(
     *                   property="first_name",
     *                   type="string"
     *                 ),
     *                 @OA\Property(
     *                   property="last_name",
     *                   type="string"
     *                 ),
     *                @OA\Property(
     *                   property="country_code",
     *                   type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="phone",
     *                     type="integer"
     *                 ),
     *                  @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="user_type",
     *                     type="string"
     *                 ),
     *                   @OA\Property(
     *                     property="language_type",
     *                     type="string"
     *                   ),
     *               )
     *             ),
     *         ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
	 *          {"bearerAuth": {}}
	 *      },
     *     )
     *
     * Returns Profile Update information message
     */

    public function updateUserProfile(Request $request){
        $data = $request->all(); 
        $user = Auth::user();
        if(isset($user)){
            $user_id = $user['user_id'];
            $user_name = $user['name'];
            $user_user_type = $user['user_type'];
            $user_email = $user['email'];
            $user_phone = $user['phone'];
            $user_country_code = $user['country_code'];
        }
        $validator = Validator::make($request->all(), [ 
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'country_code' => 'required|string|max:255',
            'email' => 'required', 
            'phone' => 'required|min:6|max:10' ,
            'language_type' =>'required'
          ]);
      
          if ($validator->fails()) { 
            return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
          }
          if($data['language_type'] == 'en')
          {
            $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return response()->json(['success' => false, 'message' =>'Invalid format of email address.'], 400);
              }
          }
          elseif($data['language_type'] == 'al')
          {
            $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return response()->json(['success' => false, 'message' =>'Email jo i saktë.'], 400);
              }
          }
          elseif($data['language_type'] == 'sq')
          {
            $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return response()->json(['success' => false, 'message' =>'Email jo i saktë.'], 400);
              }
          }
          $user_helper = new UserHelper;

          if($data['email'] != $user_email)
          {
            $find_user = $user_helper->_findSameEmail($data['email']);
            if($data['language_type'] == 'en')
            {
                if(!empty($find_user))
                {
                    return response()->json(['success' => false, 'message' =>'The email address has already been taken.'], 400);
                }
            }
            elseif($data['language_type'] == 'al')
            {
                if(!empty($find_user))
                {
                    return response()->json(['success' => false, 'message' =>'Kjo adresë email është regjistruar tashmë.'], 400);
                }
            }
             elseif($data['language_type'] == 'sq')
            {
                if(!empty($find_user))
                {
                    return response()->json(['success' => false, 'message' =>'Kjo adresë email është regjistruar tashmë.'], 400);
                }
            }
           
          }
          elseif($data['phone'] != $user_phone )
          {
            $find_user = $user_helper->_findPhoneNumber($data['phone']);
            if($data['language_type'] == 'en')
            {
                if(!empty($find_user))
                {
                    return response()->json(['success' => false, 'message' =>'The phone number has already been taken.'], 400);
                }
            }
            elseif($data['language_type'] == 'al')
            {
                if(!empty($find_user))
                {
                    return response()->json(['success' => false, 'message' =>'Ky numër është i regjistruar!.'], 400);
                }
            }

            elseif($data['language_type'] == 'sq')
            {
                if(!empty($find_user))
                {
                    return response()->json(['success' => false, 'message' =>'Ky numër është i regjistruar!.'], 400);
                }
            }
            
          }
        
            // try{
            //     $token = Config::get('app.TWILIO_AUTH_TOKEN');
            //     $twilio_sid = Config::get('app.TWILIO_SID');
            //     $twilio_verify_sid = Config::get('app.TWILIO_VERIFY_SID');
            //     $client = new Lookups_Services_Twilio($twilio_sid, $token);
            //     $phone_number = $data['country_code'].$data['phone_number'];
            //         // Perform a carrier Lookup using a  country code
            //     $number = $client->phone_numbers->get($phone_number, array("CountryCode" => $data['country_code'], "Type" => "carrier"));
            //     // Log the carrier type and name
            //     $number->carrier->type . "\r\n"; // => mobile
            // // return true;
            // }
            // catch (Exception $e) {
            //     // If a 404 exception was encountered return false.
            //     return response()->json(['success' => false, 'message' =>'Error!'], 400);
            // }
                
           
          
          $name =$data['first_name']." ".$data['last_name'];
          if(empty($name)){
            $name = $user_name;
          }
          if(empty($data['email'])){
            $data['email'] = $user_email;
          }
          if(empty($data['phone'])){
            $data['phone'] = $user_phone;
          }
          if(empty($data['country_code']))
          {
            $data['country_code']=$user_country_code;
          }
          if(empty($data['user_type'])){
            $data['user_type'] = $user_user_type;
          }
          if($user){
            $profile = User::where('user_id',$user_id)->update([
                                                            'name'=>$name,
                                                            'email'=>$data['email'],
                                                            'country_code'=>$data['country_code'],
                                                            'phone'=>$data['phone'],
                                                            'user_type'=>$data['user_type'],
                                                            ]);
          }else{
            return response()->json(['success' => false, 'msg' => 'User not exist!'],400);
          }
          if($profile) {
            if($data['language_type'] == 'en')
            {
                return response()->json(['success' => true, 'msg' => 'Profile Successfully Updated!'],200);
            }
            elseif($data['language_type'] == 'al')
            {
                return response()->json(['success' => true, 'msg' => 'Profili u përditësua me sukses!'],200);
            }
            
          } else {
            if($data['language_type'] == 'en')
            {
                return response()->json(['success' => false, 'msg' => 'Profile Updation Unsuccessful!'],400);
            }
            elseif($data['language_type'] == 'al')
            {
                return response()->json(['success' => false, 'msg' => ' Përditësimi i profilit dështoi!'],400);
            }
              
          }

    }
    /**
     * @OA\Post(
     *      path="/api/user/change-password",
     *      operationId="UserChangePassword",
     *      tags={"UserDeatils"},
     *      summary="change password",
     *          @OA\RequestBody(
     *            @OA\MediaType(
     *                 mediaType="application/json",
     *          @OA\Schema(
     *                 @OA\Property(
     *                   property="old_password",
     *                   type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="new_password",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="confirm_password",
     *                     type="string"
     *                 ),
     *                   @OA\Property(
     *                     property="language_type",
     *                     type="string"
     *                   ),
     *               )
     *             ),
     *         ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
	 *          {"bearerAuth": {}}
	 *      },
     *     )
     *
     * Returns Profile Update information message
     */
     public function changePassword(Request $request){
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'old_password'     => 'required',
            'new_password'     => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
            'language_type'     => 'required',
        ]);
        if($validator->fails()) 
        {
            return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()], 400);
        }
        $user = User::where('user_id',Auth::user()->user_id)->first();
        if (Hash::check($input['old_password'], $user->password))
        {
            User::where('user_id',Auth::user()->user_id)->update([
                'password'=> Hash::make($input['new_password'])
            ]);
            if($input['language_type'] == 'en')
            {
                return response()->json(['success' => true, 'msg' => 'Password Changed Sucessfully!'],200);
            }
            elseif($input['language_type'] == 'al')
            {
                return response()->json(['success' => true, 'msg' => 'Fjalëkalimi u ndryshua me sukses!'],200);
            }
             elseif($input['language_type'] == 'sq')
            {
                return response()->json(['success' => true, 'msg' => 'Fjalëkalimi u ndryshua me sukses!'],200);
            }
            // return response()->json(['success' => true, 'msg' => 'Password Changed Sucessfully!'],200);
        }
        else{
            if($input['language_type'] == 'en')
            {
                return response()->json(['success' => true, 'msg' => 'Password not matched!'],200);
            }
            elseif($input['language_type'] == 'al')
            {
                return response()->json(['success' => true, 'msg' => 'Fjalëkalimi nuk përputhet!'],200);
            }
            elseif($input['language_type'] == 'sq')
            {
                return response()->json(['success' => true, 'msg' => 'Fjalëkalimi nuk përputhet!'],200);
            }
            // return response()->json(['success' => false, 'msg' => 'Password not matched!'],400);
        }
     }
     /**
     * User Profile API
     * @return \Illuminate\Http\Response
     * @OA\Get(
     *      path="/api/user/details/{language_type}",
     *      operationId="UserDeatils",
     *      tags={"UserDeatils"},
     *      summary="UserDeatils",
     *      description="UserDeatails",
     *       @OA\Parameter(
     *          name="language_type",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     * 
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
	 *          {"bearerAuth": {}}
	 *      },
     *     )
     *
     * Returns profile information message
     */
    public function getUserProfileDeatils(Request $request,$language_type)
    {
        if(empty($language_type))
        {
            return response()->json(['success' => false, 'message' => 'Required Language type'],400);
        }
        $user = JWTAuth::parseToken()->authenticate();
        if(!empty($user))
        {
            $name = (explode(" ",$user['name']));
            $first_name = null;
            $last_name = null;
            if(count($name) == 3)
            {
                $first_name =$name[0]." ".$name[1];
                $last_name =$name[2];
            }
            else{
                $first_name = !empty($name[0])?$name[0]:null;
                $last_name =!empty($name[1])?$name[1]:null;
            }
            $user_deatils =[
                'first_name'=>$first_name,
                'last_name'=>$last_name,
                'email'=>$user['email'],
                'country_code'=>$user['country_code'],
                'phone'=>$user['phone'],
                'status'=>$user['status'],
                'user_id'=>$user['user_id'],
                'user_type'=>$user['user_type'],
                'profile_image'=>$user['profile_image'],
                'is_verified'=>$user['is_verified'],
                'id'=>$user['id']
            ];
            return response()->json(['success' => true, 'message' => $user_deatils], 201);
        }
        else{
            if($language_type == 'en')
            {
                return response()->json(['success' => false, 'message' => 'You are not Authenticated'],400);
            }
            elseif($language_type == 'al')
            {
                return response()->json(['success' => false, 'message' => 'Nuk jeni të kyçur.'],400);
            }
             elseif($language_type == 'sq')
            {
                return response()->json(['success' => false, 'message' => 'Nuk jeni të kyçur.'],400);
            }
            // return response()->json(['success' => false, 'message' => 'You are not Authenticated'],400);
        }
    }

     /**
     * Log out API
     * @return \Illuminate\Http\Response
     * 
     * @OA\Get(
     *      path="/api/user/logout/{language_type}",
     *      operationId="logoutUser",
     *      tags={"Auth"},
     *      summary="Logout",
     *      @OA\Parameter(
     *          name="language_type",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
	 *          {"bearerAuth": {}}
	 *      },
     * )
     * 
     */
    public function logout(Request $request,$language_type) {
        $token = $request->header("Authorization");

        if(empty($language_type))
        {
            return response()->json([
                'success' => false, 
                'message' => 'Language Type is required.'
                ], 400);
        }
        // Invalidate the token
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            if($language_type == 'en')
            {
                return response()->json([
                    'success' => true, 
                    'message'=> 'User successfully logged out.'
                ],200);
            }
            elseif($language_type == 'al')
            {
                return response()->json([
                    'success' => true, 
                    'message'=> 'Dalja me sukses.'
                ],200);
            }
            elseif($language_type == 'sq')
            {
                return response()->json([
                    'success' => true, 
                    'message'=> 'Dalja me sukses.'
                ],200);
            }
           
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            if($language_type == 'en')
            {
                return response()->json([
                    'success' => false, 
                    'message' => 'Failed to logout, please try again.'
                    ], 400);
            }
            elseif($language_type == 'al')
            {
                return response()->json([
                    'success' => false, 
                    'message' => 'Dalja dështoi, ju lutem provoni përsëri.'
                    ], 400);
            }
            elseif($language_type == 'sq')
            {
                return response()->json([
                    'success' => false, 
                    'message' => 'Dalja dështoi, ju lutem provoni përsëri.'
                ], 400);
            }
           
        }
    }
    /**
     * @OA\Post(
     *      path="/api/user/forgot-password",
     *      operationId="UserForgotPassword",
     *      tags={"UserDeatils"},
     *      summary="change password",
     *          @OA\RequestBody(
     *            @OA\MediaType(
     *                 mediaType="application/json",
     *          @OA\Schema(
     *                 @OA\Property(
     *                   property="email",
     *                   type="string"
     *                 ),
     *              @OA\Property(
     *                 property="language_type",
     *                 type="string"
     *                           ),
     *               )
     *             ),
     *         ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *     
     *     )
     *
     * Returns User Forgot Password information message
     */

    public function forgotPassword(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'email' => 'required', 
            'language_type' =>'required'
        ]);
        if($validator->fails()) 
        {
            return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()], 400);
        }
        if($input['language_type'] == 'en')
        {
            $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return response()->json(['success' => false, 'message' =>'Invalid format of email address.'], 400);
              }
        }
        elseif($input['language_type'] == 'al')
        {
            $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return response()->json(['success' => false, 'message' =>'Email jo i saktë.'], 400);
            }
        }
        elseif($input['language_type'] == 'sq')
        {
            $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return response()->json(['success' => false, 'message' =>'Email jo i saktë.'], 400);
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
                dd($e->getMessage());
                return response()->json(['success' => false, 'message' => 'Error!'], 400);

            }

            if($input['language_type'] == 'en')
            {
                Toastr::success("Please check your email. We have sent a link to reset your password in the email.!",'Success');
                // $message ='Please check your email. We have sent a link to reset your password in the email.';
            }
            elseif($input['language_type'] == 'al')
            {
                Toastr::success("Please check your email. We have sent a link to reset your password in the email.!",'Success');
                $message ='Ju lutem kontrolloni email,ju kemi dërguar link për të ndryshuar password.';
            }
            elseif($input['language_type'] == 'sq')
            {
                Toastr::success("Please check your email. We have sent a link to reset your password in the email.!",'Success');
                $message ='Ju lutem kontrolloni email,ju kemi dërguar link për të ndryshuar password.';
            }
             return response()->json(['success' => true, 'message' => $message], 200);
        }
        else{
            if($input['language_type'] == 'en')
            {
                return response()->json(['success' => false, 'message' => 'Your Email Address is not registered'], 400);
            }
            elseif($input['language_type'] == 'al')
            {
                return response()->json(['success' => false, 'message' => 'Adresa Email nuk është e rregjistruar'], 400);
            }
             elseif($input['language_type'] == 'sq')
            {
                return response()->json(['success' => false, 'message' => 'Adresa Email nuk është e rregjistruar'], 400);
            }
        }
    }

    /**
     * Otp Send API
     * @return \Illuminate\Http\Response
     * 
     * @OA\Post(
     *      path="/api/otp-send",
     *      operationId="OTP send",
     *      tags={"OTP"},
     *      summary=" Otp send",
     *      @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="application/json",
     *                      @OA\Schema(
     *                       @OA\Property(
     *                          property="country_code",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="phone_number",
     *                            type="integer"
     *                           ),
     *                       @OA\Property(
     *                          property="email",
     *                          type="string"
     *                        ),
     *                        @OA\Property(
     *                          property="language_type",
     *                            type="string"
     *                           ),
     *                 
     *                                 )
     *                           ),
     *                        ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     * 
     */

    public function sendOtp(Request $request)
    {
        //check validation
        $input = $request->all();
        $validator = Validator::make($input, [
            'country_code'=>'required',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'language_type' =>'required'
        ]);
        $user_helper = new UserHelper;

        $find_email = $user_helper->_findSameEmail($input['email']);

        $find_user = $user_helper->_findPhoneNumber($input['phone_number']);
       
        if($validator->fails()){
            return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
        }
        if($input['language_type'] == 'en')
        {
            $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return response()->json(['success' => false, 'message' =>'Invalid format of email address.'], 400);
              }

            if(!empty($find_email))
            {
                return response()->json(['success' => false, 'message' =>'The email has already been taken'], 400);
            }
            elseif(!empty($find_user))
            {
                return response()->json(['success' => false, 'message' =>'This phone number is already taken!'], 400);
            }

        }
        elseif($input['language_type'] == 'al')
        {
            $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return response()->json(['success' => false, 'message' =>'Email jo i saktë.'], 400);
              }

            if(!empty($find_email))
            {
                return response()->json(['success' => false, 'message' =>'Kjo adresë email është regjistruar tashmë.'], 400);
            }
            elseif(!empty($find_user))
            {
                return response()->json(['success' => false, 'message' =>'Ky numër është i regjistruar!'], 400);
            }
        }
        elseif($input['language_type'] == 'sq')
        {
            $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return response()->json(['success' => false, 'message' =>'Email jo i saktë.'], 400);
              }

            if(!empty($find_email))
            {
                return response()->json(['success' => false, 'message' =>'Kjo adresë email është regjistruar tashmë.'], 400);
            }
            elseif(!empty($find_user))
            {
                return response()->json(['success' => false, 'message' =>'Ky numër është i regjistruar!'], 400);
            }
        }

        /* Get credentials from .env */
        $token = Config::get('app.TWILIO_AUTH_TOKEN');
        $twilio_sid = Config::get('app.TWILIO_SID');
        $twilio_verify_sid = Config::get('app.TWILIO_VERIFY_SID');

        // $twilio = new Client($twilio_sid, $token);

        $phone_number = $input['country_code'].$input['phone_number'];
        $otp_number = rand(1000,9999);
        $minutes = 10;
        $twilio_number =  Config::get('app.TWILIO_NUMBER');
        //
        if($input['language_type'] == 'en')
        {
            $message ='Welcome to MySig! Your activation code is'." ".$otp_number." ".'Thank you!';
            $return_message = 'An OTP has been sent to your phone number.';
        }
        elseif($input['language_type'] == 'al')
        {
            $message ='Mirësevini në MySig! Kodi juaj i aktivizimit është'." ".$otp_number." ".'Ju Faleminderit!';
            $return_message = 'Një OTP është dërguar në numrin tuaj të telefonit.';
        }
        elseif($input['language_type'] == 'sq')
        {
            $message ='Mirësevini në MySig! Kodi juaj i aktivizimit është'." ".$otp_number." ".'Ju Faleminderit!';
            $return_message = 'Një OTP është dërguar në numrin tuaj të telefonit.';
        }
        try {
            $client = new Client($twilio_sid, $token);
            $client->messages->create(
                // Where to send a text message (your cell phone?)
                $phone_number,
                array(
                    'from' => $twilio_number,
                    'body' => $message
                )
            );
            return response()->json(['success' => true, 'message' => $return_message],200)->withCookie(cookie('name', $otp_number, $minutes));
        }
        catch(\Exception $e) {
            if($input['language_type'] == 'en')
            {
                return response()->json(['success' => false, 'message' => 'Sorry otp could not be sent as the phone number entered was invalid.'],400);
            }
            elseif($input['language_type'] == 'al')
            {
                return response()->json(['success' => false, 'message' => 'Numri që keni vendosur nuk është i saktë.'],400);
            }
            elseif($input['language_type'] == 'sq')
            {
                return response()->json(['success' => false, 'message' => 'Numri që keni vendosur nuk është i saktë.'],400);
            }
        //    return $e->getMessage();
          }
        
     
    }
   
    /**
     * Otp get API
     * @return \Illuminate\Http\Response
     * 
     * @OA\Post(
     *      path="/api/otp-verified",
     *      operationId="OtpVerification",
     *      tags={"OTP"},
     *      summary="Otp Verified",
     *      @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="application/json",
     *                      @OA\Schema(
     *                        @OA\Property(
     *                          property="otp_number",
     *                            type="integer"
     *                           ),
     *                         @OA\Property(
     *                          property="language_type",
     *                            type="string"
     *                           ),
     *                                 )
     *                           ),
     *                        ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     * 
     */

    public function otpVerification(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'otp_number' => ['required', 'min:4','max:4'],
            'language_type' =>'required'
        ]);

        if($validator->fails()){
            return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
        }
        $value = $request->cookie('name');
        if($input['otp_number'] == $value)
        {
            if($input['language_type'] == 'en')
            {
                return response()->json(['success' => true, 'message' => 'OTP verification Complete','is_verified'=>1],200);
            }
            elseif($input['language_type'] == 'al'){
                return response()->json(['success' => true, 'message' => 'Verifikimi OTP u krye me sukses!','is_verified'=>1],200);
            }
             elseif($input['language_type'] == 'sq'){
                return response()->json(['success' => true, 'message' => 'Verifikimi OTP u krye me sukses!','is_verified'=>1],200);
            }
            
        }
        else{
            if($input['language_type'] == 'en')
            {
                return response()->json(['success' => false, 'message' => 'OTP does not matched'],400);
            }
            elseif($input['language_type'] == 'al'){
                return response()->json(['success' => false, 'message' => 'Kodi OTP jo i saktë'],400);
            }
            elseif($input['language_type'] == 'sq'){
                return response()->json(['success' => false, 'message' => 'Kodi OTP jo i saktë'],400);
            }
        }
    }
}
