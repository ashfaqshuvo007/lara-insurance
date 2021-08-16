<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\ShippingRequest;
use App\Models\UserShipping;
use Illuminate\Support\Facades\Auth;

class UserShippingController extends Controller
{
    /**
     * Shipping add and update API
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *      path="/api/user/shipping",
     *      operationId="shipping add and update",
     *      tags={"users"},
     *      summary="shipping add and update",
     *      @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="multipart/form-data",
     *                      @OA\Schema(
     *                        @OA\Property(
     *                          property="name",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="shipping_id",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="surname",
     *                            type="string"
     *                           ),
     *                          @OA\Property(
     *                          property="email",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="phone_number",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="national_id",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="company_name",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="tax_office",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="tax_no",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="address",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="town",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="city",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="zipcode",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="shipping_country",
     *                            type="string"
     *                           ),
     *                      )
     *                 ),
     *               ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *         security={
     *          {"bearerAuth": {}}
     *           },
     * )
     *
     */

    public function userShippingAddorUpdate(ShippingRequest $request){
        try{
            $input = $request->all();
            $data=[
                'name'          =>$input['name'],
                'surname'       =>$input['surname'],
                'email'         =>$input['email'],
                'phone_number'  =>$input['phone_number'],
                'national_id'   =>$input['national_id'],
                'company_name'  =>$input['company_name'],
                'tax_office'    =>$input['tax_office'],
                'tax_no'        =>$input['tax_no'],
                'address'       =>$input['address'],
                'town'          =>$input['town'],
                'city'          =>$input['city'],
                'zipcode'       =>$input['zipcode'],
                'shipping_country'=>$input['shipping_country'],
                'amount'=>$input['amount'],
                'billing_name'     =>$input['billing_name'],
                'billing_surname'  =>$input['billing_surname'],
                'billing_email'    =>$input['billing_email'],
                'billing_phone_number'     =>$input['billing_phone_number'],
                'billing_national_id'      =>$input['billing_national_id'],
                'billing_company_name'     =>$input['billing_company_name'],
                'billing_tax_office'       =>$input['billing_tax_office'],
                'billing_tax_no'   =>$input['billing_tax_no'],
                'billing_address'  =>$input['billing_address'],
                'billing_town'     =>$input['billing_town'],
                'billing_city'     =>$input['billing_city'],
                'billing_zipcode'  =>$input['billing_zipcode'],
                'billing_country'  =>$input['billing_country'],
                'policy_name'  =>$input['policy_name'],
                'offer_name'  =>$input['offer_name'],
                'car_registration_number'  =>$input['car_registration_number'],
            ];

            $authUser = Auth::user();
            $shipping_id = !empty($input['shipping_id'])?$input['shipping_id']:uniqid();
            $billing_id = !empty($input['billing_id'])?$input['billing_id']:uniqid();
            $insurance_id = !empty($input['insurance_id'])?$input['insurance_id']:uniqid();


            // if(($input['email'] != $authUser->email) || ($input['phone_number'] != $authUser->phone)){
            //     return response()->json(['success' => false, 'errors' => 'please give the auth user data'],400);
            // }
            $auathUserShipping = UserShipping::where(['user_id'=>Auth::user()->user_id,'shipping_id'=>$shipping_id])->first();
            if(!empty($input['shipping_id'])){
                if(empty($auathUserShipping)){
                    return response()->json(['success' => false, 'errors' => 'Invalid shipping id'],400);
                }
            }
            $shipping = UserShipping::updateOrCreate(['user_id'=>Auth::user()->user_id,'shipping_id'=>$shipping_id],$data);
            if($shipping){
                return response()->json(['success' => true, 'message' => 'Shipping updated successfully'],200);
            }else{
                return response()->json(['success' => false, 'errors' => 'While adding shipping their is an error'],400);
            }
        }catch(\Exception $e){
            return response()->json(['success' => false, 'errors' => $e->getMessage()],400);
        }
    }

    /**
     * user shipping API
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/user/get/shippings",
     *      operationId="shippings",
     *      tags={"users"},
     *      summary="shippings",
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
	 *          {"bearerAuth": {}}
	 *      },
     * )
     *
     */

    public function getUserShippings(Request $request){
        try{

            $shippings = UserShipping::where('user_id',Auth::user()->user_id)->get();
            return response()->json(['success' => true, 'data' => $shippings],200);
        }catch(\Exception $e){
            return response()->json(['success' => false, 'errors' => $e->getMessage()],400);
        }
    }
}
