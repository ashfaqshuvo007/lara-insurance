<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\DateFormat;
use App\Models\Property;
use Validator;
use App\Models\PolicySubType;
use Illuminate\Support\Facades\Auth;
use App\Models\Policy;
use App\Models\HomePolicy;
use App\Models\TravelPolicyType;
use App\Models\Reporting;
use App\Helpers\LeadHelper as LeadHelper;
use App\Models\Lead;
use App\Models\Status_tracking;
use App\Models\Transaction;



class PolicyCreateController extends Controller
{
    /**
     * Home Policy Create API
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *      path="/api/buy-policy/home-policy-save",
     *      operationId="postSaveHomePolicy",
     *      tags={"PolicyCreate"},
     *      summary="HomePolicy",
     *      @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="multipart/form-data",
     *                      @OA\Schema(
     *                       type="object",
     *                       @OA\Property(
     *                          property="first_name",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                          property="last_name",
     *                            type="string"
     *                           ),
     *                      @OA\Property(
     *                          property="prospect_name",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                         property="square",
     *                         type="string",
     *                        ),
     *                       @OA\Property(
     *                          property="id_number",
     *                            type="string"
     *                           ),
     *                      @OA\Property(
     *                          property="property_number",
     *                            type="string"
     *                           ),
     *                      @OA\Property(
     *                          property="full_address",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                          property="kadastral_number",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                          property="policy_details_id",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                          property="policy_type",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                          property="policy_number",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                          property="policy_start_date",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                          property="date_of_birth",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                         property="inside_image_1",
     *                         type="string",
     *                         format="binary"
     *                        ),
     *                      @OA\Property(
     *                         property="inside_image_2",
     *                         type="string",
     *                         format="binary"
     *                        ),
     *                       @OA\Property(
     *                         property="inside_image_3",
     *                         type="string",
     *                         format="binary"
     *                        ),
     *                      @OA\Property(
     *                         property="image_4",
     *                         type="string",
     *                         format="binary"
     *                        ),
     *                      @OA\Property(
     *                         property="outside_image_1",
     *                         type="string",
     *                         format="binary"
     *                        ),
     *                      @OA\Property(
     *                         property="outside_image_2",
     *                         type="string",
     *                         format="binary"
     *                        ),
     *                      @OA\Property(
     *                         property="outside_image_3",
     *                         type="string",
     *                         format="binary"
     *                        ),
     *                       @OA\Property(
     *                         property="insuer_id",
     *                         type="string",
     *                        ),
     *                       @OA\Property(
     *                         property="insurer_policy_id",
     *                         type="string",
     *                        ),
     *                      @OA\Property(
     *                         property="payment_method",
     *                         type="string",
     *                        ),
     *                      @OA\Property(
     *                         property="insurer_part",
     *                         type="integer",
     *                        ),
     *                      @OA\Property(
     *                         property="our_part",
     *                         type="integer",
     *                        ),
     *                       @OA\Property(
     *                         property="offer",
     *                         type="string",
     *                        ),
     *                       @OA\Property(
     *                         property="premium",
     *                         type="string",
     *                        ),
     *                       @OA\Property(
     *                         property="premium_paid",
     *                         type="string",
     *                        ),
     *                      @OA\Property(
     *                         property="delivery_address",
     *                         type="string",
     *                        ),
     *                      @OA\Property(
     *                         property="delivery_date",
     *                         type="string",
     *                        ),
     *                      @OA\Property(
     *                         property="delivery_time",
     *                         type="string",
     *                        ),
     *                       @OA\Property(
     *                         property="delivery_city",
     *                         type="string",
     *                        ),
     *                       @OA\Property(
     *                         property="home_type",
     *                         type="string",
     *                        ),
     *                     @OA\Property(
     *                         property="building_value",
     *                         type="string",
     *                        ),
     *                       @OA\Property(
     *                         property="equipmennt_price",
     *                         type="string",
     *                        ),
     *                      @OA\Property(
     *                         property="policy_id",
     *                         type="string",
     *                        ),
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

    public function createHomePolicy(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'first_name' => 'nullable|string|max:255',
            'last_name'=>'nullable|string|max:255',
            'id_number'=>'nullable|string|max:255',
            'property_number'=>'nullable|string|max:255',
            'kadastral_number'=>'nullable|string|max:255',
            'full_address' => 'nullable|string|max:255',
            'policy_start_date'=>['nullable' , new DateFormat],
            'date_of_birth'=>['nullable' , new DateFormat],
            'insuer_id'=>'nullable',
            'policy_details_id'=>'nullable',
            'policy_type'=>'nullable',
            'policy_number'=>'nullable',
            'premium'=>'nullable',
            'insurer_policy_id'=>'nullable',
            'payment_method'=>'nullable',
            'insurer_part'=>['nullable', 'regex:^(?:[1-9]\d+|\d)(?:\,\d\d)?$^'],
            'inside_image_1' => 'nullable|mimes:jpeg,jpg,png',
            'inside_image_2'=>'nullable|mimes:jpeg,jpg,png',
            'inside_image_3'=>'nullable|mimes:jpeg,jpg,png',
            'outside_image_1'=>'nullable|mimes:jpeg,jpg,png',
            'outside_image_2'=>'nullable|mimes:jpeg,jpg,png',
            'outside_image_3'=>'nullable|mimes:jpeg,jpg,png',
            'image_4'=>'nullable|mimes:jpeg,jpg,png',
            'premium_paid'=>'nullable',
            'delivery_address'=>'nullable',
            'delivery_date'=>['nullable' , new DateFormat],
            'delivery_time'=>'nullable',
            'delivery_city'=>'nullable',
            'square'=>'nullable',
            'home_type'=>'nullable',
            'policy_id'     =>'nullable|exists:policy,policy_id'
        ]);
        if($validator->fails()){
            return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
        }
        if(!empty($input['policy_id'])){

            $policy = Policy::where(['policy_id' =>$input['policy_id'],'user_id'=>Auth::user()->user_id])->first();
            $deliveryData=[
                'delivery_address'  =>!empty($input['delivery_address'])?$input['delivery_address']:null,
                'delivery_date'     =>!empty($input['delivery_date'])?date("Y-m-d",strtotime($input['delivery_date'])):null,
                'delivery_time'     =>!empty($input['delivery_time'])?date("H:i:s",strtotime($input['delivery_time'])):null,
                'delivery_city'     =>!empty($input['delivery_city'])?$input['delivery_city']:null,
            ];
            $policy->update($deliveryData);
            return response()->json(['success' => true, 'message' => 'Policy has been updated successfully','policy_id'=>$input['policy_id']],200);

        }else{

            $policy_id = uniqid();
            //convert date
            $get_start_date = strtotime($input['policy_start_date']);
            //check policy sub type
            //validity
            $validity = "1 year";
            //renewal date
            $renewal_date = date('Y-m-d', strtotime('+1 year', strtotime($input['policy_start_date'])) );
            // return $renewal_date;
            //prospect name
            if(!empty($input['prospect_name']))
            {
                $prospect_name = $input['prospect_name'];
            }
            else{
                $prospect_name = null;
            }
            if($input['policy_type'] !='74273e1bc257')
            {
                return response()->json(['success' => false, 'message' =>'Policy Type is not same'], 200);
            }
            if($request->hasFile('inside_image_1') && $request->hasFile('inside_image_2') && $request->hasFile('inside_image_3') && $request->hasFile('outside_image_1') && $request->hasFile('outside_image_2') && $request->hasFile('outside_image_3') && $request->hasFile('image_4'))
            {
                $image_name_1 = md5(uniqid()).'.'.$request->file('inside_image_1')->extension();
                $image_name_2 = md5(uniqid()).'.'.$request->file('inside_image_2')->extension();
                $image_name_3 = md5(uniqid()).'.'.$request->file('inside_image_3')->extension();
                $image_name_4 = md5(uniqid()).'.'.$request->file('outside_image_1')->extension();
                $image_name_5 = md5(uniqid()).'.'.$request->file('outside_image_2')->extension();
                $image_name_6 = md5(uniqid()).'.'.$request->file('outside_image_3')->extension();
                $image_name_7 =  md5(uniqid()).'.'.$request->file('image_4')->extension();

                $request->file('inside_image_1')->move(public_path('storage/home'), $image_name_1);
                $request->file('inside_image_2')->move(public_path('storage/home'), $image_name_2);
                $request->file('inside_image_3')->move(public_path('storage/home'), $image_name_3);
                $request->file('outside_image_1')->move(public_path('storage/home'), $image_name_4);
                $request->file('outside_image_2')->move(public_path('storage/home'), $image_name_5);
                $request->file('outside_image_3')->move(public_path('storage/home'), $image_name_6);
                $request->file('image_4')->move(public_path('storage/home'), $image_name_7);


                //create property
                $property_create = [
                    'property_id' => uniqid(),
                    'policy_id' =>$policy_id,
                    'id_number'=>$input['id_number'],
                    'property_number'=>$input['property_number'],
                    'kadastral_number'=>$input['kadastral_number'],
                    'full_address'=>$input['full_address'],
                    'inside_image_1'=>$image_name_1,
                    'inside_image_2'=>$image_name_2,
                    'inside_image_3'=>$image_name_3,
                    'outside_image_1'=>$image_name_4,
                    'outside_image_2'=>$image_name_5,
                    'outside_image_3'=>$image_name_6,
                    'user_id'=>Auth::user()->user_id,
                    'square'=>$input['square'],
                    'date_of_birth'=>date("Y-m-d",strtotime($input['date_of_birth'])),
                    'image_4'=>$image_name_7,
                    'home_type'=>$input['home_type'],
                    'building_value'=>!empty($input['building_value'])?$input['building_value']:0,
                    'equipmennt_price'=>!empty($input['equipmennt_price'])?$input['equipmennt_price']:0
                ];
                $property_create = Property::create($property_create);

                //reporting part
                $our_part = !empty($input['our_part'])?(int)$input['our_part']:0;
                $total = (float)$input['insurer_part'] + $our_part;
                $reporting_data=[
                    'report_id'=>uniqid(),
                    'insurer_id'=>$input['insuer_id'],
                    'insurer_policy_id'=>$input['insurer_policy_id'],
                    'policy_id'=>$policy_id,
                    'method'=>$input['payment_method'],
                    'insurer_part'=>$input['insurer_part'],
                    'our_part'=>$our_part,
                    'total'=>$total
                ];
                //status tracking
                Status_tracking::create([
                    'entity'=>'policy',
                    'entity_id'=>$policy_id,
                    'status'=>'2',
                    'created_by'=>Auth::user()->user_id
                ]);
                //delete lead
                $lead = new LeadHelper;
                $find_lead = $lead->_findLead(Auth::user()->user_id);
                if(!empty($find_lead))
                {
                    if(empty($find_lead['deleted_at']))
                    {
                        $lead_delete=$lead->_leadDelete(Auth::user()->user_id);
                    }
                }
                //policy create
                $policy_create_data = [
                    'policy_id'=>$policy_id,
                    'premium'=>!empty($input['premium'])?$input['premium']:0,
                    'premium_paid'=>$input['premium_paid'],
                    'policy_type'=>$input['policy_type'],
                    'policy_name'=>$input['policy_details_id'],
                    'insurer_id'=>$input['insuer_id'],
                    'insurer_policy_id'=>$input['insurer_policy_id'],
                    'user_id'=>Auth::user()->user_id,
                    'offer'=>isset($input['offer'])?$input['offer']:null,
                    'start_date'=>date("Y-m-d",$get_start_date),
                    'insured_name'=>$input['first_name']." ".$input['last_name'],
                    'status'=>1,
                    'prospect_name'=>$prospect_name,
                    'validity_period'=>$validity,
                    'expiry_date'=>$renewal_date,
                    'delivery_address'  =>!empty($input['delivery_address'])?$input['delivery_address']:null,
                    'delivery_date'     =>!empty($input['delivery_date'])?date("Y-m-d",strtotime($input['delivery_date'])):null,
                    'delivery_time'     =>!empty($input['delivery_time'])?date("H:i:s",strtotime($input['delivery_time'])):null,
                    'delivery_city'     =>!empty($input['delivery_city'])?$input['delivery_city']:null,
                    'status_tracking'=>'2',
                ];
                try {

                    if(empty(Auth::user()->is_policy))
                    {
                        Auth::user()->update([
                            'is_policy' => 1
                        ]);
                    }
                    $reporting_create = Reporting::create($reporting_data);
                    $policy_create=Policy::create($policy_create_data);

                    if($input['payment_method'] == 'BKT VPOS'){
                        $transaction_data = [
                            'policy_id' => $policy_create['policy_id'],
                            'payment_status' => 'Failed',
                        ];
                        $bkt_payment_status_saved = Transaction::create($transaction_data);

                    }

                    
                    if(@($input['language']=='al' || $input['language']=='sq') && $input['payment_method']=='Cod')
                    {
                        return response()->json(['success' => true, 'message' => 'Polica u krijua me sukses, do ju kontaktojmë shumë shpejtë për dorëzimin e polices','policy_id'=>$policy_id,'policy_created_data'=>$policy_create_data],200);
                    }
                    else if(@($input['language']=='al' || $input['language']=='sq') && $input['payment_method']=='Paypal' && $input['payment_method']=='BKT VPOS')
                    {
                        return response()->json(['success' => true, 'message' => 'Polica u krijua me sukses, brenda pak minutave ju do të mund të shkarkoni kopjen dixhitale në seksionin "Policat e mia".','policy_id'=>$policy_id,'policy_created_data'=>$policy_create_data],200);
                    }
                    else
                    {
                        return response()->json(['success' => true, 'message' => 'Policy has been created successfully','policy_id'=>$policy_id,'policy_created_data'=>$policy_create_data],200);
                    }
                }
                //catch exception
                catch(\Exception $e) {
                    return response()->json(['success' => false, 'message' => $e->getMessage()],400);
                }
            }
            else{
                return response()->json(['success' => false, 'message' => 'Unsuccessfull'],400);
            }

        }


    }
    /**
     * Travel Policy Buy API
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *      path="/api/buy-policy/travel-policy-save",
     *      operationId="postSaveTravelPolicy",
     *      tags={"PolicyCreate"},
     *      summary="TravelPolicy",
     *      @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="multipart/form-data",
     *                      @OA\Schema(
     *                       type="object",
     *                       @OA\Property(
     *                          property="first_name",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                          property="last_name",
     *                            type="string"
     *                           ),
     *                      @OA\Property(
     *                          property="start_date",
     *                            type="string"
     *                           ),
     *                      @OA\Property(
     *                          property="end_date",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                          property="date_of_birth",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                          property="prospect_name",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                          property="father_name",
     *                            type="string"
     *                           ),
     *                      @OA\Property(
     *                          property="passport_number",
     *                            type="string"
     *                           ),
     *                      @OA\Property(
     *                          property="get_the_days",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                          property="policy_details_id",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                          property="policy_type",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                          property="policy_number",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                         property="insuer_id",
     *                         type="string",
     *                        ),
     *                      @OA\Property(
     *                         property="insurer_policy_id",
     *                         type="string",
     *                        ),
     *                      @OA\Property(
     *                         property="payment_method",
     *                         type="string",
     *                        ),
     *                      @OA\Property(
     *                         property="insurer_part",
     *                         type="integer",
     *                        ),
     *                      @OA\Property(
     *                         property="our_part",
     *                         type="integer",
     *                        ),
     *                       @OA\Property(
     *                         property="offer",
     *                         type="string",
     *                        ),
     *                       @OA\Property(
     *                         property="premium",
     *                         type="string",
     *                        ),
     *                       @OA\Property(
     *                         property="premium_paid",
     *                         type="string",
     *                        ),
     *                      @OA\Property(
     *                         property="delivery_address",
     *                         type="string",
     *                        ),
     *                      @OA\Property(
     *                         property="delivery_date",
     *                         type="string",
     *                        ),
     *                      @OA\Property(
     *                         property="delivery_time",
     *                         type="string",
     *                        ),
     *                      @OA\Property(
     *                         property="delivery_city",
     *                         type="string",
     *                        ),
     *                      @OA\Property(
     *                         property="policy_id",
     *                         type="string",
     *                        ),
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

    public function postSaveTravelPolicy(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'first_name'        => 'nullable|string|max:255',
            'last_name'         =>'nullable|string|max:255',
            'father_name'       =>'nullable|string|max:255',
            'passport_number'   =>'nullable|string|max:255',
            'get_the_days'      =>'nullable|string|max:255',
            'policy_details_id' =>'nullable|string|max:255',
            'policy_type'       =>'nullable|string|max:255',
            'insuer_id'         =>'nullable|string|max:255',
            'offer'             =>'nullable|string|max:255',
            'insurer_policy_id' =>'nullable',
            'payment_method'    =>'nullable',
            'insurer_part'      =>['nullable', 'regex:^(?:[1-9]\d+|\d)(?:\,\d\d)?$^'],
            'premium'           =>'nullable|string|max:255',
            'premium_paid'      =>'nullable|string|max:255',
            'start_date'        =>'nullable',
            'end_date'          =>'nullable',
            'delivery_address'  =>'nullable',
            'delivery_date'     =>['nullable' , new DateFormat],
            'date_of_birth'     =>['nullable' , new DateFormat],
            'delivery_time'     =>'nullable',
            'delivery_city'     =>'nullable',
            'policy_id'         =>'nullable|exists:policy,policy_id'
        ]);
        if($validator->fails()){
            return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
        }
        if(!empty($input['policy_id'])){

            $policy = Policy::where(['policy_id' =>$input['policy_id'],'user_id'=>Auth::user()->user_id])->first();
            $deliveryData=[
                'delivery_address'  =>!empty($input['delivery_address'])?$input['delivery_address']:null,
                'delivery_date'     =>!empty($input['delivery_date'])?date("Y-m-d",strtotime($input['delivery_date'])):null,
                'delivery_time'     =>!empty($input['delivery_time'])?date("H:i:s",strtotime($input['delivery_time'])):null,
                'delivery_city'     =>!empty($input['delivery_city'])?$input['delivery_city']:null,
            ];
            $policy->update($deliveryData);
            return response()->json(['success' => true, 'message' => 'Policy has been updated successfully','policy_id'=>$input['policy_id']],200);
        }else{
            //check it is travel policy or not
            $check_policy_type = PolicySubType::where('policy_sub_type_id',$input['policy_type'])->first();
            if(!empty($check_policy_type))
            {
                $poiicy_type=[
                    '69e21f9783bd',
                    '0ac2b7cfc696'
                ];
                if(in_array($input['policy_type'],$poiicy_type))
                {
                    //check it is exist
                }
                else{
                    return response()->json(['success' => false, 'message' =>'Invalid Travel Type'], 400);

                }
            }
            else{
                return response()->json(['success' => false, 'message' =>'Invalid Travel Type'], 400);
            }
            if(!empty($input['prospect_name']))
            {
                $prospect_name = $input['prospect_name'];
            }
            else{
                $prospect_name = null;
            }
            $validity = $input['get_the_days'];
            //policy id
            $policy_id = uniqid();
            //reporting part
            $our_part = !empty($input['our_part'])?(int)$input['our_part']:0;
            $total = (float)$input['insurer_part'] + $our_part;
            $reporting_data=[
                'report_id'=>uniqid(),
                'insurer_id'=>$input['insuer_id'],
                'insurer_policy_id'=>$input['insurer_policy_id'],
                'policy_id'=>$policy_id,
                'method'=>$input['payment_method'],
                'insurer_part'=>$input['insurer_part'],
                'our_part'=>$our_part,
                'total'=>$total
            ];
            //create travel policy data
            $create_travel_policy = [
                'travel_policy_id' =>uniqid(),
                'policy_id'=>$policy_id,
                'user_id'=>Auth::user()->user_id,
                'father_name'=>$input['father_name'],
                'passport_number'=>$input['passport_number'],
                'days'=>$input['get_the_days'],
                'date_of_birth'=>date("Y-m-d",strtotime($input['date_of_birth'])),
            ];
            $enter_data_into_travel_policy = TravelPolicyType::create($create_travel_policy);
            //delete lead
            $lead = new LeadHelper;
            $find_lead = $lead->_findLead(Auth::user()->user_id);
            if(!empty($find_lead))
            {
                if(empty($find_lead['deleted_at']))
                {
                    $lead_delete=$lead->_leadDelete(Auth::user()->user_id);
                }
            }
            //status tracking
            Status_tracking::create([
                'entity'=>'policy',
                'entity_id'=>$policy_id,
                'status'=>'2',
                'created_by'=>Auth::user()->user_id
            ]);
            //create policy
            $policy_create_data = [
                'policy_id'=>$policy_id,
                'premium'=>$input['premium'],
                'premium_paid'=>$input['premium_paid'],
                'policy_type'=>$input['policy_type'],
                'policy_name'=>$input['policy_details_id'],
                'insurer_id'=>$input['insuer_id'],
                'insurer_policy_id'=>$input['insurer_policy_id'],
                'user_id'=>Auth::user()->user_id,
                'offer'=>isset($input['offer'])?$input['offer']:null,
                'insured_name'=>$input['first_name']." ".$input['last_name'],
                'status'=>1,
                'start_date'=>$input['start_date'],
                'expiry_date'=>$input['end_date'],
                'prospect_name'=>$prospect_name,
                'validity_period'=>$validity,
                'delivery_address'  =>!empty($input['delivery_address'])?$input['delivery_address']:null,
                'delivery_date'     =>!empty($input['delivery_date'])?date("Y-m-d",strtotime($input['delivery_date'])):null,
                'delivery_time'     =>!empty($input['delivery_time'])?date("H:i:s",strtotime($input['delivery_time'])):null,
                'delivery_city'     =>!empty($input['delivery_city'])?$input['delivery_city']:null,
                'status_tracking'=>'2'
            ];
            try {

                if(empty(Auth::user()->is_policy))
                {
                    Auth::user()->update([
                        'is_policy' => 1
                    ]);
                }
                $reporting_create = Reporting::create($reporting_data);
                $policy_create=Policy::create($policy_create_data);

                  if($input['payment_method'] == 'BKT VPOS'){
                    $transaction_data = [
                        'policy_id' => $policy_create['policy_id'],
                        'payment_status' => 'Failed',
                    ];
                    $bkt_payment_status_saved = Transaction::create($transaction_data);

                }


                if(@($input['language']=='al' || $input['language']=='sq') && $input['payment_method']=='Cod')
                {
                    return response()->json(['success' => true, 'message' => 'Polica u krijua me sukses, do ju kontaktojmë shumë shpejtë për dorëzimin e polices','policy_id'=>$policy_id,'policy_created_data'=>$policy_create_data],200);
                }
                else if(@($input['language']=='al' || $input['language']=='sq') && $input['payment_method']=='Paypal' && $input['payment_method']=='BKT VPOS')
                {
                    return response()->json(['success' => true, 'message' => 'Polica u krijua me sukses, brenda pak minutave ju do të mund të shkarkoni kopjen dixhitale në seksionin "Policat e mia".','policy_id'=>$policy_id,'policy_created_data'=>$policy_create_data],200);
                }
                else
                {
                    return response()->json(['success' => true, 'message' => 'Policy has been created successfully','policy_id'=>$policy_id,'policy_created_data'=>$policy_create_data],200);
                }
            }
            //catch exception
            catch(\Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()],400);
            }
        }

    }
}
