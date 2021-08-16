<?php

namespace App\Http\Controllers\API\driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PolicySubType;
use Validator;
use App\Models\GreenCard;
use App\Models\Policy;
use App\Models\Car;
use App\Models\DriverDetails;
use Illuminate\Support\Facades\Auth;
use App\Rules\DateFormat;
use App\Models\Reporting;
use App\Models\Status_tracking;
use App\Helpers\CarHelpers;
use App\Helpers\LeadHelper as LeadHelper;
use App\Models\Transaction;


class GreenCardPolicyCreateController extends Controller
{
    /**
     * Show Green Card Policy Buy API
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *      path="/api/buy-policy/green-card-save",
     *      operationId="PostSaveGreenCardpolicy",
     *      tags={"PolicyCreate"},
     *      summary="GreenCardPolicy",
     *      @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="multipart/form-data",
     *                      @OA\Schema(
     *                       type="object",
     *                        @OA\Property(
     *                          property="driver_first_name",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="driver_last_name",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="prospect_name",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                          property="validity_days",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="add_second_driver",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="second_driver_first_name",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="second_driver_last_name",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="date_of_birth",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="id_card_number",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="policy_start_date",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="policy_number",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="policy_details_id",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="policy_type",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="car_registration_number",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                          property="car_type",
     *                            type="string"
     *                           ),
     *                      @OA\Property(
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
     *                      @OA\Property(
     *                         property="offer",
     *                         type="string",
     *                        ),
     *                      @OA\Property(
     *                         property="premium",
     *                         type="string",
     *                        ),
     *                      @OA\Property(
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

     public function postSaveGreenCardDetails(Request $request)
     {
        $input = $request->all();
        $validator = Validator::make($input, [
            'driver_first_name' => 'nullable|string|max:255',
            'driver_last_name'=>'nullable|string|max:255',
            'policy_start_date'=>['nullable' , new DateFormat],
            'car_registration_number' => 'nullable',
            'insuer_id'=>'nullable',
            'policy_details_id'=>'nullable',
            'policy_type'=>'nullable',
            'policy_number'=>'nullable',
            'insurer_policy_id'=>'nullable',
            'payment_method'=>'nullable',
            'insurer_part'=>['nullable', 'regex:^(?:[1-9]\d+|\d)(?:\,\d\d)?$^'],
            'premium'=>'nullable',
            'premium_paid'=>'nullable',
            'validity_days'=>'nullable',
            'delivery_address'=>'nullable',
            'delivery_date'=>['nullable' , new DateFormat],
            'delivery_time'=>'nullable',
            'delivery_city'=>'nullable',
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
            $bool_check = 0;
            // $check_car = CarHelpers::checkCarExistance(Auth::user()->user_id,$input['car_registration_number']);
            // if(!empty($check_car)){
            //     return response()->json(['success' => false, 'message' => 'registration number already taken!!'],400);
            // }
            $find_car = Car::where('car_registration_number',$input['car_registration_number'])->where('user_id',Auth::user()->user_id)->first();
            // return $find_car;
            $car_policy_ids =[];
            if(!empty($find_car))
            {
                if($find_car['policy_id'] != null)
                {
                    $car_policy_ids = explode(",",$find_car['policy_id']);
                    // return response()->json(['success' => false, 'message' => 'Car already has a runninng policy'], 400);
                }
            }

            // if(!empty($find_car))
            // {
            //     // if($find_car['policy_id'] != null)
            //     // {
            //     //     return response()->json(['success' => false, 'message' => 'This car already has a runninng policy'], 400);
            //     // }
            // }

            if('dfd3e39b733a' != $input['policy_type'])
            {
                return response()->json(['success' => false, 'message' => 'Invalid Policy Type'], 400);
            }
            $check_it_is_green_card = GreenCard::where('green_card_id',$input['policy_details_id'])->first();
            if(empty($check_it_is_green_card))
            {
                return response()->json(['success' => false, 'message' => 'Invalid Policy'], 400);
            }
            $get_start_date = strtotime($input['policy_start_date']);
            //validity

            switch ($input['validity_days']) {
                case "15 Ditë":
                    $validity = "+15 days";
                break;
                case "30 Ditë":
                    $validity = "+30 days";
                break;
                case "45 Ditë":
                    $validity = "+45 days";
                break;
                case "1 Muaj":
                    $validity = "+1 month";
                break;
                case "3 Muaj":
                    $validity = "+3 month";
                break;
                case "6 Muaj":
                    $validity = "+6 month";
                break;
                case "12 Muaj":
                    $validity = "+12 month";
                break;
                default:
                $validity = "+".$input['validity_days'];
            }
            //renewal date
            $renewal_date = date('Y-m-d', strtotime($validity, strtotime($input['policy_start_date'])) );
            // return $renewal_date;
            if(!empty($input['prospect_name']))
            {
                $prospect_name = $input['prospect_name'];
            }
            else{
                $prospect_name = null;
            }
            if(isset($input['add_second_driver']))
            {
                if($input['add_second_driver'] == 'checked')
                {
                    $validator = Validator::make($input, [
                        'second_driver_first_name' => 'required|string|max:255',
                        'second_driver_last_name'=>'required|string|max:255',
                        'date_of_birth'=>['required' , new DateFormat],
                        'id_card_number'=>'required|string|max:255'
                    ]);
                    if($validator->fails()){
                        return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
                    }
                    $date_of_birth = strtotime($input['date_of_birth']);
                    $driver_data = [
                        'user_id' => Auth::user()->user_id,
                        'driver_id'=>uniqid(),
                        'driver_name'=>$input['driver_first_name']." ".$input['driver_last_name'],
                        'driver_second_name'=>$input['second_driver_first_name']." ".$input['second_driver_last_name'],
                        'dob'=>date("Y-m-d",$date_of_birth),
                        'id_card_number'=>$input['id_card_number'],
                        'policy_id'=>$policy_id
                    ];
                    $driver_create = DriverDetails::create($driver_data);
                }
            }
            else{
                $driver_data = [
                    'user_id' => Auth::user()->user_id,
                    'driver_id'=>uniqid(),
                    'driver_name'=>$input['driver_first_name']." ".$input['driver_last_name'],
                    'policy_id'=>$policy_id
                ];
                $driver_create = DriverDetails::create($driver_data);
            }

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

            if(empty($find_car))
            {
                $validator = Validator::make($input, [
                    'car_type' => 'required|string|max:255'
                ]);
                if($validator->fails()){
                    return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
                }
                if(($input['car_type'] == 'c21ff7205d80') || ($input['car_type'] == 'f6f672b44ca4'))
                {
                    $car_type ="5387b8bf5632";
                    $car_sub_type =$input['car_type'];
                    $create_car = Car::create([
                        'car_id'=>uniqid(),
                        'user_id'=>Auth::user()->user_id,
                        'car_registration_number'=> $input['car_registration_number'],
                        'car_tpye'=>$car_type,
                        'car_sub_type'=>$car_sub_type,
                        'policy_id'=>$policy_id
                    ]);
                    $bool_check =1;
                }
                elseif(($input['car_type'] == 'a997fda1e2b4') || ($input['car_type'] == 'ab2a4c146fa1') || ($input['car_type'] == 'e7b38f7c61f1') || ($input['car_type'] == '0c1c1846a382'))
                {
                    $car_type ="d931b542bcad";
                    $car_sub_type =$input['car_type'];
                    $create_car = Car::create([
                        'car_id'=>uniqid(),
                        'user_id'=>Auth::user()->user_id,
                        'car_registration_number'=> $input['car_registration_number'],
                        'car_tpye'=>$car_type,
                        'car_sub_type'=>$car_sub_type,
                        'policy_id'=>$policy_id
                    ]);
                    $bool_check =1;
                }
                elseif(($input['car_type'] == '491755a78240') || ($input['car_type'] == '75499efa929f') || ($input['car_type'] =='da1462ce1285'))
                {

                    $car_type ="bacb3f1ffff6";
                    $car_sub_type =$input['car_type'];
                    $create_car = Car::create([
                        'car_id'=>uniqid(),
                        'user_id'=>Auth::user()->user_id,
                        'car_registration_number'=> $input['car_registration_number'],
                        'car_tpye'=>$car_type,
                        'car_sub_type'=>$car_sub_type,
                        'policy_id'=>$policy_id
                    ]);
                    $bool_check =1;
                }
                elseif(($input['car_type'] == 'c238d6dbf991') || ($input['car_type'] =='ab2010d41bbc'))
                {
                    $car_type ="a51933d621cb";
                    $car_sub_type =$input['car_type'];
                    $create_car = Car::create([
                        'car_id'=>uniqid(),
                        'user_id'=>Auth::user()->user_id,
                        'car_registration_number'=> $input['car_registration_number'],
                        'car_tpye'=>$car_type,
                        'car_sub_type'=>$car_sub_type,
                        'policy_id'=>$policy_id
                    ]);
                    $bool_check =1;
                }
                elseif(($input['car_type'] =='981cc8a302d9'))
                {
                    $car_type ="497a41074388";
                    $car_sub_type =$input['car_type'];
                    $create_car = Car::create([
                        'car_id'=>uniqid(),
                        'user_id'=>Auth::user()->user_id,
                        'car_registration_number'=> $input['car_registration_number'],
                        'car_tpye'=>$car_type,
                        'car_sub_type'=>$car_sub_type,
                        'policy_id'=>$policy_id
                    ]);
                    $bool_check =1;
                }
                elseif(($input['car_type'] =='40635dbf8dd5'))
                {
                    $car_type ="0c0361f6647e";
                    $car_sub_type =$input['car_type'];
                    $create_car = Car::create([
                        'car_id'=>uniqid(),
                        'user_id'=>Auth::user()->user_id,
                        'car_registration_number'=> $input['car_registration_number'],
                        'car_tpye'=>$car_type,
                        'car_sub_type'=>$car_sub_type,
                        'policy_id'=>$policy_id
                    ]);
                    $bool_check =1;
                }
                elseif(($input['car_type'] == '639a891bafd3') || ($input['car_type'] == '852fc65713dd') || ($input['car_type'] == '396ab962b76a'))
                {
                    $car_type ="22b8a3a60595";
                    $car_sub_type =$input['car_type'];
                    $create_car = Car::create([
                        'car_id'=>uniqid(),
                        'user_id'=>Auth::user()->user_id,
                        'car_registration_number'=> $input['car_registration_number'],
                        'car_tpye'=>$car_type,
                        'car_sub_type'=>$car_sub_type,
                        'policy_id'=>$policy_id
                    ]);
                    $bool_check =1;
                }
                elseif(($input['car_type'] == 'c95c1b249a5a') || ($input['car_type'] == 'caef4d83c891') || ($input['car_type'] == '601902a5633f') ||($input['car_type'] == '9f43393b29cd') ||($input['car_type'] =='055cdfc9c9cc'))
                {
                    $car_type ="c32b0536df2f";
                    $car_sub_type =$input['car_type'];
                    $create_car = Car::create([
                        'car_id'=>uniqid(),
                        'user_id'=>Auth::user()->user_id,
                        'car_registration_number'=> $input['car_registration_number'],
                        'car_tpye'=>$car_type,
                        'car_sub_type'=>$car_sub_type,
                        'policy_id'=>$policy_id
                    ]);
                    $bool_check =1;
                }
                else{
                    return response()->json(['success' => false, 'message' => 'You send an Undefined id'], 400);
                }
            }
            if(empty($bool_check))
            {
                $car_policy = array($policy_id);

                $car_data = array_merge($car_policy,$car_policy_ids);

                $update_data = ['policy_id'=>implode(",",$car_data)];
                $find_car->update($update_data);
            }
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
                'start_date'=>date("Y-m-d",$get_start_date),
                'status'=>1,
                'insured_name'=>$input['driver_first_name']." ".$input['driver_last_name'],
                'prospect_name'=>$prospect_name,
                'validity_period'=>$validity,
                'expiry_date'=>$renewal_date,
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
            catch(\Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()],400);
            }
        }



     }
}
