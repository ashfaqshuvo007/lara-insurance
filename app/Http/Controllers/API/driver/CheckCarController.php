<?php

namespace App\Http\Controllers\API\driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use App\Models\PaypalTransaction;
use App\Models\TransactionDetails;
use App\Models\Car;
use App\Models\Policy;
use Validator;

class CheckCarController extends Controller
{
    /**
     * Check car policy Buy API
     * @return \Illuminate\Http\Response
     * 
     * @OA\Post(
     *      path="/api/check/car-policy",
     *      operationId="Check car Policy",
     *      tags={"Check car Policy"},
     *      summary="Check Car Policy",
     *      @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="multipart/form-data",
     *                      @OA\Schema(
     *                       type="object",
     *                        @OA\Property(
     *                          property="car_registration_no",
     *                            type="string"
     *                           ),
     *                          @OA\Property(
     *                          property="policy_type",
     *                            type="string"
     *                           ),
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
     *         security={
     *          {"bearerAuth": {}}
     *           },
     * )
     * 
     */

     public function checkCarPolicyValidity(Request $request)
     {
        $input = $request->all();
        $validator = Validator::make($input, [
            'car_registration_no' => 'required|string|max:255',
            'policy_type'=>'required|string|max:255',
            'language_type'=>'required'
        ]);
        if($validator->fails()){
            return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
        }

        $find_car = Car::where('car_registration_number',$input['car_registration_no'])->first();

        if(!empty($find_car))
        {
            if($find_car['policy_id'] != null)
            {
                $get_car_policy = $find_car['policy_id'];
                //dd($find_car['policy_id']);
                $data = explode(",",$get_car_policy);

               
                foreach($data as $deatils)
                {
                    $get_policy = Policy::where('policy_id',$deatils)->first();
                   
                    $get_payment_method = PaymentMethod::where('policy_id',$deatils)->first();
                    
                    if($get_payment_method['payment_method']=='BKT VPOS')
                    {
                        /**
                         * Check the policy of the bkt transactions
                         */
                        $transactionsOfPolicies = Transaction::where('policy_id',$deatils)->whereIn('payment_status',['Failed'])->first();
                        if(!empty($transactionsOfPolicies)){
                            // $get_policy->update(['status'=>0]);
                            return response()->json(['success' => true, 'message' => 'true.'], 200); 
                        }
                        $get_payment_status = Transaction::where('policy_id',$deatils)->whereIn('payment_status',['success'])->first();
                        
                        if(!empty($get_payment_status))
                        {
                            if($get_policy['policy_type'] == $input['policy_type'])
                            {
                                //check expiry date 
                                $expiry_date = date("Y-m-d", strtotime($get_policy['expiry_date']));
                                $today= date("Y-m-d");
                                if($expiry_date>=$today)
                                {
                                    if($input['language_type'] == 'en')
                                    {
                                        $message ='New policy can start after expiry date of current one.';
                                    }
                                    elseif($input['language_type'] == 'al' || $input['language_type'] == 'sq')
                                    {
                                        $message ='Polica e re mund të fillojë vetë pas datës së mbarimit te polices aktuale';
                                    }
                                    return response()->json(['success' => false, 'message' => $message], 400);
                                }
                            }
                        }
                        else
                        {
                            return response()->json(['success' => true, 'message' => 'true.'], 200);  
                        }
                    }
                    else if($get_payment_method['payment_method']=='Paypal')
                    {
                        $get_payment_status = PaypalTransaction::where('policy_id',$deatils)->whereIn('Paypal_status',['COMPLETED'])->first();

                        if(!empty($get_payment_status))
                        {
                            if($get_policy['policy_type'] == $input['policy_type'])
                            {
                                $expiry_date = date("Y-m-d", strtotime($get_policy['expiry_date']));
                                $today= date("Y-m-d");
                                if($expiry_date>=$today)
                                {
                                    if($input['language_type'] == 'en')
                                    {
                                        $message ='New policy can start after expiry date of current one.';
                                    }
                                    elseif($input['language_type'] == 'al' || $input['language_type'] == 'sq')
                                    {
                                        $message ='Polica e re mund të fillojë vetë pas datës së mbarimit te polices aktuale';
                                    }
                                    return response()->json(['success' => false, 'message' => $message], 400);
                                }
                            }
                        }
                        else{
                            return response()->json(['success' => true, 'message' => 'true.'], 200);
                        }
                    }
                    else if($get_payment_method['payment_method']=='Easypay')
                    {
                        $get_payment_status = TransactionDetails::where('policy_id',$deatils)->first();

                        if($get_payment_status['status']==1)
                        {
                            if($get_policy['policy_type'] == $input['policy_type'])
                            {
                                
                                //check expiry date 
                                $expiry_date = date("Y-m-d", strtotime($get_policy['expiry_date']));
                                $today= date("Y-m-d");
                                if($expiry_date>=$today)
                                {
                                    if($input['language_type'] == 'en')
                                    {
                                        $message ='New policy can start after expiry date of current one.';
                                    }
                                    elseif($input['language_type'] == 'al' || $input['language_type'] == 'sq')
                                    {
                                        $message ='Polica e re mund të fillojë vetë pas datës së mbarimit te polices aktuale';
                                    }
                                    return response()->json(['success' => false, 'message' => $message], 400);
                                }
                            }
                        }
                    }
                    else if($get_payment_method['payment_method']=='Cod')
                    {
                            if($get_policy['policy_type'] == $input['policy_type'])
                            {
                                //check expiry date 
                                $expiry_date = date("Y-m-d", strtotime($get_policy['expiry_date']));
                                $today= date("Y-m-d");
                                if($expiry_date>=$today)
                                {
                                    if($input['language_type'] == 'en')
                                    {
                                        $message ='New policy can start after expiry date of current one.';
                                    }
                                    elseif($input['language_type'] == 'al' || $input['language_type'] == 'sq')
                                    {
                                        $message ='Polica e re mund të fillojë vetë pas datës së mbarimit te polices aktuale';
                                    }
                                    return response()->json(['success' => false, 'message' => $message], 400);
                                }
                            }
                    }

                }
            }
            
            return response()->json(['success' => true, 'message' => 'true.'], 200);
        }
        else{
                return response()->json(['success' => false, 'message' => 'Invalid Car Data'], 400);
            }
    }


    public function checkHomePolicyValidity(Request $request)
     {
        $input = $request->all();
        $validator = Validator::make($input, [
            'policy_type'=>'required|string|max:255',
            'language_type'=>'required'
        ]);
        if($validator->fails()){
            return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
        }

        $find_car = Car::where('car_registration_number',$input['car_registration_no'])->first();

        if(!empty($find_car))
        {
            if($find_car['policy_id'] != null)
            {
                $get_car_policy = $find_car['policy_id'];

                $data = explode(",",$get_car_policy);

        
                foreach($data as $deatils)
                {
                    $get_policy = Policy::where('policy_id',$deatils)->first();
                
                    $get_payment_method = PaymentMethod::where('policy_id',$deatils)->first();

                    if($get_payment_method['payment_method']=='BKT VPOS')
                    {
                        //dd($get_payment_method['payment_method']);
                        $get_payment_status = Transaction::where('policy_id',$deatils)->whereIn('payment_status',['success'])->first();
                        if(!empty($get_payment_status))
                        {
                            if($get_policy['policy_type'] == $input['policy_type'])
                            {
                                
                                //check expiry date 
                                $expiry_date = date("Y-m-d", strtotime($get_policy['expiry_date']));
                                $today= date("Y-m-d");
                                if($expiry_date>=$today)
                                {
                                    if($input['language_type'] == 'en')
                                    {
                                        $message ='New policy can start after expiry date of current one.';
                                    }
                                    elseif($input['language_type'] == 'al' || $input['language_type'] == 'sq')
                                    {
                                        $message ='Polica e re mund të fillojë vetë pas datës së mbarimit te polices aktuale';
                                    }
                                    return response()->json(['success' => false, 'message' => $message], 400);
                                }
                            }
                        }
                    }
                    else if($get_payment_method['payment_method']=='Paypal')
                    {
                        $get_payment_status = PaypalTransaction::where('policy_id',$deatils)->whereIn('Paypal_status',['COMPLETED'])->first();

                        if(!empty($get_payment_status))
                        {
                            if($get_policy['policy_type'] == $input['policy_type'])
                            {
                                $expiry_date = date("Y-m-d", strtotime($get_policy['expiry_date']));
                                $today= date("Y-m-d");
                                if($expiry_date>=$today)
                                {
                                    if($input['language_type'] == 'en')
                                    {
                                        $message ='New policy can start after expiry date of current one.';
                                    }
                                    elseif($input['language_type'] == 'al' || $input['language_type'] == 'sq')
                                    {
                                        $message ='Polica e re mund të fillojë vetë pas datës së mbarimit te polices aktuale';
                                    }
                                    return response()->json(['success' => false, 'message' => $message], 400);
                                }
                            }
                        }
                    }
                    else if($get_payment_method['payment_method']=='Easypay')
                    {
                        $get_payment_status = TransactionDetails::where('policy_id',$deatils)->first();

                        if($get_payment_status['status']==1)
                        {
                            if($get_policy['policy_type'] == $input['policy_type'])
                            {
                                
                                //check expiry date 
                                $expiry_date = date("Y-m-d", strtotime($get_policy['expiry_date']));
                                $today= date("Y-m-d");
                                if($expiry_date>=$today)
                                {
                                    if($input['language_type'] == 'en')
                                    {
                                        $message ='New policy can start after expiry date of current one.';
                                    }
                                    elseif($input['language_type'] == 'al' || $input['language_type'] == 'sq')
                                    {
                                        $message ='Polica e re mund të fillojë vetë pas datës së mbarimit te polices aktuale';
                                    }
                                    return response()->json(['success' => false, 'message' => $message], 400);
                                }
                            }
                        }
                    }
                    else if($get_payment_method['payment_method']=='Cod')
                    {
                            if($get_policy['policy_type'] == $input['policy_type'])
                            {
                                //check expiry date 
                                $expiry_date = date("Y-m-d", strtotime($get_policy['expiry_date']));
                                $today= date("Y-m-d");
                                if($expiry_date>=$today)
                                {
                                    if($input['language_type'] == 'en')
                                    {
                                        $message ='New policy can start after expiry date of current one.';
                                    }
                                    elseif($input['language_type'] == 'al' || $input['language_type'] == 'sq')
                                    {
                                        $message ='Polica e re mund të fillojë vetë pas datës së mbarimit te polices aktuale';
                                    }
                                    return response()->json(['success' => false, 'message' => $message], 400);
                                }
                            }
                    }

                }
            }
            
            return response()->json(['success' => true, 'message' => 'true.'], 200);
        }
        else{
                return response()->json(['success' => false, 'message' => 'Invalid Car Data'], 400);
            }
    }
}
