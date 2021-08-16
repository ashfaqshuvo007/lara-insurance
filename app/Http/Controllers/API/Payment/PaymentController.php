<?php

namespace App\Http\Controllers\API\Payment;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\ShippingRequest;
use App\Models\UserShipping;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Facades\PayPal;
use App\Models\Policy;
use App\Models\Offers;
use App\Models\Car;
use App\Models\InsurerPolicy;
use App\Models\PaymentMethod;
use App\Models\PaypalTransaction;
use App\Models\CodTransaction;


class PaymentController extends Controller
{
    public function generateCardForm(Request $request){
        $MerchantPass="Aa123456";                                               //Language_MerchantPass
        $input = $request->all();

        $input['Rnd'] = microtime();
        $hashstr = $input['MbrId'] . $input['OrderId'] . $input['PurchAmount'] . $input['OkUrl'] . $input['FailUrl'] . $input['TxnType'] . $input['InstallmentCount'] . $input['Rnd'] . $MerchantPass;
        $input['Hash'] = base64_encode(pack('H*',sha1($hashstr)));

        $data1 = [
            'data1' => 'value_1',
            'data2' => 'value_2',
        ];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://payfortestbkt.cordisnetwork.com/Mpi/3DHost.aspx",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($input),
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);



        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return $response;

        }
    }

    public function cardDetailsForm(Request $request, $policy_id){
        $user=Auth::user();
        $data = UserShipping::select('name', 'surname', 'email', 'phone_number', 'address', 'city', 'zipcode', 'shipping_country')->where('user_id',Auth::user()->user_id)->first();
           
        $policy = Policy::where('policy_id',$policy_id)->first();
        dd($policy);
        if($policy['offer']){
            $data['offer']= Offers::where('offers_id',$policy['offer'])->value('offer_name');
        }
        $data['policy_name'] = InsurerPolicy::where('insurer_policy_id',$policy['insurer_policy_id'])->value('policy_name');
        $data['car_registration_number'] = Car::where('policy_id','LIKE',"%$policy->policy_id%")->value('car_registration_number'); 
        $data['i_frame'] = false;
        $data['policy_id'] = $policy_id;
        $data['amount'] = $policy['premium_paid']; 
        return view('payment.Payfor3DHostDetails',compact('data'));
    }

    public function cardDetailsFormAll(Request $request, $policy_id){
       $data = UserShipping::select('name', 'surname', 'email', 'phone_number', 'address', 'city', 'zipcode', 'shipping_country')->where('user_id',Auth::user()->user_id)->first();
        $policy = Policy::where('policy_id',$policy_id)->first();

        if($policy['offer']){

            $data['offer']= Offers::where('offers_id',$policy['offer'])->value('offer_name');

        }
        $data['policy_name'] = InsurerPolicy::where('insurer_policy_id',$policy['insurer_policy_id'])->value('policy_name');
        $data['car_registration_number'] = Car::where('policy_id','LIKE',"%$policy->policy_id%")->value('car_registration_number'); 
        $data['i_frame'] = false;
        $data['policy_id'] = $policy_id;
        $data['amount'] = $policy['premium_paid']; 

       return view('payment_all.Payfor3DHostDetails',compact('data'));
    }

    public function addPaypal($policy_id, $buy_policy_for,$policy_name){
        $user=Auth::user();
        $policy = Policy::where(['policy_id' =>$policy_id,'user_id'=>$user->user_id])->first();
        if($policy->policy_type=='c1bc21cfdda9' || $policy->policy_type=='c7824ee08a59' || $policy->policy_type=='dfd3e39b733a'){

            $data = [
                'registration_number' => $buy_policy_for,
                'prospect_name' => $policy->insured_name,
                'policy_type' => $policy->policy_type,
                'policy_name' => $policy_name,
                'amount' => $policy->premium_paid,
                'policy_id' => $policy->policy_id,
            ];
        }else{
             $data = [
                'policy_for' => $buy_policy_for,
                'policy_type' => $policy->policy_type,
                'prospect_name' => $policy->insured_name,
                'policy_name' => $policy_name,
                'amount' => $policy->premium_paid,
                'policy_id' => $policy->policy_id,
            ];
        }

        return view('paypal.paypal',compact('data'));
    }

      public function codThankYou($policy_id, $buy_policy_for,$policy_name){
        $user=Auth::user();
        $policy = Policy::where(['policy_id' =>$policy_id,'user_id'=>$user->user_id])->first();
        if($policy->policy_type=='c1bc21cfdda9' || $policy->policy_type=='c7824ee08a59' || $policy->policy_type=='dfd3e39b733a'){

            $data = [
                'registration_number' => $buy_policy_for,
                'prospect_name' => $policy->insured_name,
                'policy_type' => $policy->policy_type,
                'policy_name' => $policy_name,
                'amount' => $policy->premium_paid,
                'policy_id' => $policy->policy_id,
            ];
        }else{
             $data = [
                'policy_for' => $buy_policy_for,
                'policy_type' => $policy->policy_type,
                'prospect_name' => $policy->insured_name,
                'policy_name' => $policy_name,
                'amount' => $policy->premium_paid,
                'policy_id' => $policy->policy_id,
            ];
        }

        return view('fontend.dashboard.frontend-codThankYou',compact('data'));
        // return view('paypal.paypal',compact('data'));
    }

    public function codConfirmed(){

        return view('fontend.dashboard.frontend-confirmedCodThankYou');
        // return view('paypal.paypal',compact('data'));
    }


    /**
     * Store Payment Method API
     * @return \Illuminate\Http\Response
     * 
     * @OA\Post(
     *      path="/api/payment-method",
     *      operationId="paymentMethod",
     *      tags={"Payment"},
     *      summary="add payment method",
     *      @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="application/json",
     *                      @OA\Schema(
     *                        @OA\Property(
     *                          property="policy_id",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="payment_method",
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

    public function codApi(Request $request){
        $input=$request->all();

        $validator = Validator::make($request->all(), [
            'policy_id'     => 'required',
            'payment_method' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['error'=> $validator->errors()]);
        }

        $codApiDataSave = PaymentMethod::create([
            'policy_id'      => $input['policy_id'],
            'payment_method' => $input['payment_method'],
        ]);
        if($codApiDataSave)
        {
            return response()->json(['success' => true, 'data'=>$codApiDataSave, 'msg' => 'Successfully Saved!'],200);
        }
    }

    /**
     * Store Paypal Details API
     * @return \Illuminate\Http\Response
     * 
     * @OA\Post(
     *      path="/api/paypal-details-save",
     *      operationId="paypalDetails",
     *      tags={"Payment"},
     *      summary="save paypal details",
     *      @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="application/json",
     *                      @OA\Schema(
     *                        @OA\Property(
     *                          property="policy_id",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="payment_id",
     *                            type="string"
     *                           ),
     *                           @OA\Property(
     *                          property="paypal_intent",
     *                            type="string"
     *                           ),
     *                          @OA\Property(
     *                          property="paypal_status",
     *                            type="string"
     *                           ),
     *                           @OA\Property(
     *                          property="payer_id",
     *                            type="string"
     *                           ),
     *                           @OA\Property(
     *                          property="payer_email",
     *                            type="string"
     *                           ),
     *                           @OA\Property(
     *                          property="payer_name",
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
    
    public function paypalApi(Request $request)
    {
    
        $input=$request->all();

        $validator = Validator::make($request->all(), [
            'policy_id'     => 'required',
            'payment_id'    => 'required',
            'paypal_intent' => 'required',
            'paypal_status' => 'required',
            'payer_id'      => 'required',
            'payer_email'   => 'required',
            'payer_name'    => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['error'=> $validator->errors()]);
        }

        $codApiDataSave = PaypalTransaction::create([
            'policy_id'     => $input['policy_id'],
            'Payment_id'    => $input['payment_id'],
            'Paypal_intent' => $input['paypal_intent'],
            'Paypal_status' => $input['paypal_status'],
            'payer_id'      => $input['payer_id'],
            'payer_email'   => $input['payer_email'],
            'payer_name'    => $input['payer_name'],
        ]);
        if($codApiDataSave)
        {
            return response()->json(['success' => true, 'data'=>$codApiDataSave, 'msg' => 'Successfully Saved!'],200);
        }

    }

    /**
     * Store Cod Details Save
     * @return \Illuminate\Http\Response
     * 
     * @OA\Post(
     *      path="/api/cod-details-save",
     *      operationId="coddetailssave",
     *      tags={"Payment"},
     *      summary="COD details save",
     *      @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="application/json",
     *                      @OA\Schema(
     *                         @OA\Property(
     *                          property="policy_id",
     *                            type="string"
     *                           ),
     *                          @OA\Property(
     *                            property="amount",
     *                            type="string"
     *                           ),
     *                          @OA\Property(
    *                             property="notes",
     *                            type="string"
     *                           ),
    *                          @OA\Property(
        *                         property="date_range",
        *                         type="string"
    *                           ),
     *                          
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

    public function codDetailsSave(Request $request){
        $input=$request->all();
        $cod_validation = $this->codValidate($input);
        if ($cod_validation->fails()){
            return response()->json(['success' => false, 'errors' => $cod_validation->getMessageBag()->toArray()], 400);
        }

        $cod_save = CodTransaction::create([
            'transaction_id' => uniqid(),
            'policy_id'      => $input['policy_id'],
            'amount'         => $input['amount'],
            'notes'          => $input['notes'],
            'date'           => date('Y-m-d',strtotime($input['date_range'])),
        ]);

        if($cod_save){
            return response()->json(['success' => true, 'msg' => 'Successfully Saved!'],200);
        }else{
            return response()->json(['success' => false, 'msg' => 'Unsuccessful!'],200);
        }

    }

    protected function codValidate($request){
        if (isset($request)){
			return Validator::make($request,[
				'amount'     => 'required|numeric',
                'date_range' => 'required',
                'notes'      => 'required'
			]);
		}
    }

    /**
     * BKT Payment API Except TPL
     * @return \Illuminate\Http\Response
     * @OA\Post(
     *      path="/api/bkt/cardForm",
     *      operationId="cardDetailsFormForBKTAPI",
     *      tags={"Payment"},
     *      summary="BKT Card Form For Mobile APP Except TPL(For LEK currency)",
     *          @OA\RequestBody(
     *            @OA\MediaType(
     *                 mediaType="application/json",
     *                       @OA\Schema(
     *                        @OA\Property(
     *                           property="id",
     *                             type="integer"
     *                            ),
     *                                  )
     *                            ),
     *                         ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *     )
     *
     * ReturnsBKT Payment information message
     */
    public function cardDetailsFormForBKTAPI($user_id, $policy_id){
        Auth::loginUsingId($user_id, true);
        $user = Auth::user();
        if(isset($user)){
            $token = auth('api')->tokenById($user->id);           
             $data = UserShipping::select('name', 'surname', 'email', 'phone_number', 'address', 'city', 'zipcode', 'shipping_country')->where('user_id',Auth::user()->user_id)->first();
            $policy = Policy::where('policy_id',$policy_id)->first();
            if($policy['offer']){
                $data['offer']= Offers::where('offers_id',$policy['offer'])->value('offer_name');
            }
            $data['policy_name'] = InsurerPolicy::where('insurer_policy_id',$policy['insurer_policy_id'])->value('policy_name');
            $data['i_frame'] = true;
            $data['policy_id'] = $policy_id;
            $data['car_registration_number'] = Car::where('policy_id','LIKE',"%$policy->policy_id%")->value('car_registration_number'); 
            $data['amount'] = $policy['premium_paid']; 
            return view('payment.Payfor3DHostDetails',compact('data'));
        }else{
            return response()->json(['success' => false, 'message' => 'No such user exits in our records'], 200);
        }

       
    }

  /**
     * BKT Payment API For TPL
     * @return \Illuminate\Http\Response
     * @OA\Post(
     *      path="/api/bkt/cardForm/tpl",
     *      operationId="cardDetailsFormForBKTTPLForAPI",
     *      tags={"Payment"},
     *      summary="BKT Card Form For Mobile APP For TPL(For ALL currency)",
     *          @OA\RequestBody(
     *            @OA\MediaType(
     *                 mediaType="application/json",
     *                       @OA\Schema(
     *                        @OA\Property(
     *                           property="id",
     *                             type="integer"
     *                            ),
     *                                  )
     *                            ),
     *                         ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *     )
     *
     * ReturnsBKT Payment information message
     */
    public function cardDetailsFormForBKTTPLForAPI($user_id, $policy_id)
    {
        Auth::loginUsingId($user_id, true);
        $user = Auth::user();
        if(isset($user)){
            $token = auth('api')->tokenById($user->id);
            $data = UserShipping::select('name', 'surname', 'email', 'phone_number', 'address', 'city', 'zipcode', 'shipping_country')->where('user_id',Auth::user()->user_id)->first();
           
            $policy = Policy::where('policy_id',$policy_id)->first();
            if($policy['offer']){
                $data['offer']= Offers::where('offers_id',$policy['offer'])->value('offer_name');
            }
            $data['policy_name'] = InsurerPolicy::where('insurer_policy_id',$policy['insurer_policy_id'])->value('policy_name');
            $data['i_frame'] = true;
            $data['policy_id'] = $policy_id;
            $data['car_registration_number'] = Car::where('policy_id','LIKE',"%$policy->policy_id%")->value('car_registration_number');        
            $data['amount'] = $policy['premium_paid']; 
            return view('payment_all.Payfor3DHostDetails',compact('data'));
        }else{
            return response()->json(['success' => false, 'message' => 'No such user exits in our records'], 200);
        }
       
    }
}
