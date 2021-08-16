<?php

namespace App\Http\Controllers\API\Claim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ClaimIncidentForHome;
use App\Models\Claim;
use App\Rules\DateFormat;
use Illuminate\Support\Facades\Auth;
use App\Models\Policy;
use App\Models\Reporting;

class HomePolicyClaimController extends Controller
{
     /**
     * Show Home Claim API
     * @return \Illuminate\Http\Response
     * 
     * @OA\Post(
     *      path="/api/claim/home-policy",
     *      operationId="ClaimsForHome",
     *      tags={"Claim"},
     *      summary="ClaimForHome",
     *      @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="multipart/form-data",
     *                      @OA\Schema(
     *                       type="object",
     *                         @OA\Property(
     *                          property="incident_date",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="incident_time",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="policy_id",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="claim_event_that_cause_the_damage",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="object_destroyed",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="place_where_the_damage_occured",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="name_address",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="insured_objects_altered",
     *                            type="bool"
     *                           ),
     *                         @OA\Property(
     *                          property="describe_shortly",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="did_the_alarm_work",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="measure_taken_to_minimize_damage",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="insurer_id",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="insurer_policy_id",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="policy_type",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                         property="description_of_claim_event",
     *                         type="string",
     *                        ),
     *                      @OA\Property(
     *                         property="repair_cost_building",
     *                         type="integer",
     *                        ),
     *                       @OA\Property(
     *                         property="repair_cost_equipments",
     *                         type="integer",
     *                        ),
     *                      @OA\Property(
     *                         property="total_indemnification_pretended",
     *                         type="integer",
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

    public function postSaveHomeClaim(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'incident_date' => ['required',new DateFormat],
            'incident_time'=>'required|regex:/(\d+\:\d+)/',
            'policy_id'=>'required|string|max:255',
            'claim_event_that_cause_the_damage'=>'required|string|max:255',
            'object_destroyed'=>'required|string|max:255',
            'place_where_the_damage_occured' =>'required|string|max:255',
            'measure_taken_to_minimize_damage'=>'required|string|max:255',
            'insured_objects_altered'=>'required|bool',
            'insurer_id'=>'required|string|max:255',
            'policy_type'=>'required|string|max:255',
            'insurer_policy_id'=>'required|string|max:255',
            'description_of_claim_event'=>'required',
            'repair_cost_building'=>'required|numeric',
            'repair_cost_equipments'=>'required|numeric',
            'total_indemnification_pretended'=>'required|numeric',
        ]);
        if($validator->fails()){
            return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
        }
        //get the policy 
        $policy = Policy::where('policy_id',$input['policy_id'])->first();
        if(!empty($policy))
        {
            if(($policy['claiming_paid'] != null))
            {
                return response()->json(['success' => false, 'message' => 'Policy has already been claimed'], 400);
            }
        }
        else{
            return response()->json(['success' => false, 'message' => 'You have no policy regrading you id'], 400);
        }
        //home claim incident
        $date_time = $input['incident_date']." ".$input['incident_time'];
        // return date('Y-m-d H:i:s', strtotime($date_time));
        $claim_add_in_policy =[
            'claiming_paid' =>1
        ];
        $policy->update($claim_add_in_policy);
        //reporting
        $get_reporting = Reporting::where('policy_id',$input['policy_id'])->first();
        if(!empty($get_reporting))
        {   $claim_add_in_policy =[
                'claimed_paid' =>1
            ];
            $get_reporting->update($claim_add_in_policy);
        }
        $claim_id = uniqid();
        $for_home_claim_incident = [
            'claim_incident_id'=>$claim_id,
            'incident_datetime'=>date('Y-m-d H:i:s', strtotime($date_time)),
            'user_id'=>Auth::user()->user_id,
            'policy_id'=>$input['policy_id'],
            'object_destroyed'=>$input['object_destroyed'],
            'object_damages_can_checked'=>$input['place_where_the_damage_occured'],
            'name_address'=>isset($input['name_address'])?$input['name_address']:null,
            'insured_objects_altered'=>empty($input['insured_objects_altered'])?0:1,
            'short_description'=>!empty($input['insured_objects_altered'])?$input['describe_shortly']:null,
            'did_alarm_worked'=>empty($input['did_the_alarm_work'])?0:1,
            'meassure_to_minimise_damage'=>$input['measure_taken_to_minimize_damage'],
            'claim_event_history_description'=>$input['description_of_claim_event'],
            'repair_cost_building'=>$input['repair_cost_building'],
            'repair_cost_equipments'=>$input['repair_cost_equipments'],
            'total_indemnification_pretended'=>$input['total_indemnification_pretended']
        ];

        $add_claim_incident = ClaimIncidentForHome::create($for_home_claim_incident);

        //home claim policy
        //claim
        $for_claim =[
            'claims_id'=>$claim_id,
            'user_id'=>Auth::user()->user_id,
            'insurer_policy_id'=>$input['insurer_policy_id'],
            'policy_type'=>$input['policy_type'],
            'policy_id'=>$input['policy_id'],
            'insurer_id'=>$input['insurer_id']
        ];

        $add_claim = Claim::create($for_claim);
        return response()->json(['success' => true, 'message' => 'Claim Added Successfully'], 200);


    }
}
