<?php

namespace App\Http\Controllers\API\driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DriverDetails;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Models\Policy;
use Validator;
use App\Rules\DateFormat;
use App\Models\FullCasco;
use App\Models\Reporting;
use App\Helpers\LeadHelper as LeadHelper;
use App\Models\Lead;
use App\Models\Status_tracking;
use App\Models\Transaction;


class FullCascoPolicyCreateController extends Controller
{
    /**
     * Show Full Casco Policy Buy API
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *      path="/api/buy-policy/full-casco-save",
     *      operationId="PostSaveCascopolicy",
     *      tags={"PolicyCreate"},
     *      summary="CascoPolicy",
     *      @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="multipart/form-data",
     *                      @OA\Schema(
     *                       type="object",
     *                         @OA\Property(
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
     *                         @OA\Property(
     *                          property="add_second_driver",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="secoond_driver_first_name",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="secoond_driver_last_name",
     *                            type="string"
     *                           ),
     *                          @OA\Property(
     *                          property="date_of_birth",
     *                            type="string"
     *                           ),
     *                          @OA\Property(
     *                          property="id_card_number",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="policy_start_date",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="policy_number",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                          property="policy_type",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="policy_details_id",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                          property="car_registration_number",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                          property="variant",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                         property="document_image_1",
     *                         type="string",
     *                         format="binary"
     *                        ),
     *                      @OA\Property(
     *                         property="document_image_2",
     *                         type="string",
     *                         format="binary"
     *                        ),
     *                       @OA\Property(
     *                         property="document_image_3",
     *                         type="string",
     *                         format="binary"
     *                        ),
     *                      @OA\Property(
     *                         property="document_image_4",
     *                         type="string",
     *                         format="binary"
     *                        ),
     *                      @OA\Property(
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
     *                     @OA\Property(
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
     *                    @OA\Property(
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
     *                     @OA\Property(
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

    public function postSaveFullCascoPolicy(Request $request)
    {
        $input = $request->all();
        // return $input;
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
            'document_image_1' => 'nullable|mimes:jpeg,jpg,png',
            'document_image_2'=>'nullable|mimes:jpeg,jpg,png',
            'document_image_3'=>'nullable|mimes:jpeg,jpg,png',
            'document_image_4'=>'nullable|mimes:jpeg,jpg,png',
            'variant'=>'nullable',
            'delivery_address'=>'nullable',
            'delivery_date'=>['nullable' , new DateFormat],
            'delivery_time'=>'nullable',
            'delivery_city'=>'nullable',
            'policy_id'     =>'nullable|exists:policy,policy_id'
        ]);
        $policy_id = uniqid();

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

            $find_car = Car::where('car_registration_number',$input['car_registration_number'])->where('user_id',Auth::user()->user_id)->first();
            $car_policy_ids =[];
            if($find_car['policy_id'] != null)
            {
                $car_policy_ids = explode(",",$find_car['policy_id']);
                // return response()->json(['success' => false, 'message' => 'Car already has a runninng policy'], 400);
            }

            if('c7824ee08a59' != $input['policy_type'])
            {
                return response()->json(['success' => false, 'message' => 'Policy type is not Casco Type'], 400);
            }
            $check_it_is_full_casco = FullCasco::where('full_casco_id',$input['policy_details_id'])->first();
            if(empty($check_it_is_full_casco))
            {
                return response()->json(['success' => false, 'message' => 'It is not a Casco policy'], 400);
            }
            $get_start_date = strtotime($input['policy_start_date']);
            //validity
            $validity = "1 year";
            //renewal date
            $renewal_date = date('Y-m-d', strtotime('+1 year', strtotime($input['policy_start_date'])) );
            //prospect name
            if(!empty($input['prospect_name']))
            {
                $prospect_name = $input['prospect_name'];
            }
            else{
                $prospect_name = null;
            }
            if($request->hasFile('document_image_1') && $request->hasFile('document_image_2') && $request->hasFile('document_image_3') && $request->hasFile('document_image_4'))
            {
                $image_name_1 = md5(uniqid()).'.'.$request->file('document_image_1')->extension();
                $image_name_2 = md5(uniqid()).'.'.$request->file('document_image_2')->extension();
                $image_name_3 = md5(uniqid()).'.'.$request->file('document_image_3')->extension();
                $image_name_4 = md5(uniqid()).'.'.$request->file('document_image_4')->extension();

                $request->file('document_image_1')->move(public_path('storage/car/car-image'), $image_name_1);
                $request->file('document_image_2')->move(public_path('storage/car/car-image'), $image_name_2);
                $request->file('document_image_3')->move(public_path('storage/car/car-image'), $image_name_3);
                $request->file('document_image_4')->move(public_path('storage/car/car-image'), $image_name_4);

                $car_policy = array($policy_id);

                $car_data = array_merge($car_policy,$car_policy_ids);
                $update_data = [
                    'document_image_1'=>$image_name_1,
                    'document_image_2'=>$image_name_2,
                    'document_image_3'=>$image_name_3,
                    'document_image_4'=>$image_name_4,
                    'policy_id'=>implode(",",$car_data)
                ];
                $update_car = $find_car->update($update_data);
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
            if(isset($input['add_second_driver']))
            {
                if($input['add_second_driver'] == 'checked')
                {
                    $validator = Validator::make($input, [
                        'secoond_driver_first_name' => 'required|string|max:255',
                        'secoond_driver_last_name'=>'required|string|max:255',
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
                        'driver_second_name'=>$input['secoond_driver_first_name']." ".$input['secoond_driver_last_name'],
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
                'insured_name'=>$input['driver_first_name']." ".$input['driver_last_name'],
                'status'=>1,
                'variant' =>$input['variant'],
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
            //catch exception
            catch(\Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()],400);
            }
        }

    }
}
