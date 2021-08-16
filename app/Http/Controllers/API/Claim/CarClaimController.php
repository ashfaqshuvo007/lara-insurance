<?php

namespace App\Http\Controllers\API\Claim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClaimIncident;
use App\Models\Claim;
use App\Rules\DateFormat;
use Illuminate\Support\Facades\Auth;
use App\Models\Policy;
use Illuminate\Support\Facades\Validator;
use App\Models\Reporting;

class CarClaimController extends Controller
{
     /**
     * Show Car Claim API
     * @return \Illuminate\Http\Response
     * 
     * @OA\Post(
     *      path="/api/claim/car-policy",
     *      operationId="ClaimsForCar",
     *      tags={"Claim"},
     *      summary="ClaimForCar",
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
     *                          property="incident_location",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="policy_id",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="incident_description",
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
     *                         property="image_1",
     *                         type="string",
     *                         format="binary"
     *                        ),
     *                      @OA\Property(
     *                         property="image_2",
     *                         type="string",
     *                         format="binary"
     *                        ),
     *                       @OA\Property(
     *                         property="image_3",
     *                         type="string",
     *                         format="binary"
     *                        ),
     *                      @OA\Property(
     *                         property="image_4",
     *                         type="string",
     *                         format="binary"
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

     public function postSavecarClaim(Request $request)
     {
        $input = $request->all();
        $validator = Validator::make($input, [
            'incident_date' => ['required',new DateFormat],
            'incident_location'=>'required|string|max:255',
            'policy_id'=>'required|string|max:255',
            'incident_description'=>'required|string|max:255',
            'insurer_id'=>'required|string|max:255',
            'policy_type'=>'required|string|max:255',
            'insurer_policy_id'=>'required|string|max:255',
            'image_1'=>'required|mimes:jpeg,jpg,png',
            'image_2'=>'required|mimes:jpeg,jpg,png',
            'image_3'=>'required|mimes:jpeg,jpg,png',
            'image_4'=>'required|mimes:jpeg,jpg,png',
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
        //claim add 
        if($request->hasFile('image_1') && $request->hasFile('image_2') && $request->hasFile('image_3') && $request->hasFile('image_4'))
        {
            //claim part
            $claim_id = uniqid();
            $image_name_1 = md5(uniqid()).'.'.$request->file('image_1')->extension(); 
            $image_name_2 = md5(uniqid()).'.'.$request->file('image_2')->extension(); 
            $image_name_3 = md5(uniqid()).'.'.$request->file('image_3')->extension(); 
            $image_name_4 = md5(uniqid()).'.'.$request->file('image_4')->extension(); 

            $request->file('image_1')->move(public_path('storage/claim/car'), $image_name_1);
            $request->file('image_2')->move(public_path('storage/claim/car'), $image_name_2);
            $request->file('image_3')->move(public_path('storage/claim/car'), $image_name_3);
            $request->file('image_4')->move(public_path('storage/claim/car'), $image_name_4);
            //claim incident
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
            $for_claim_incident_data = [
                'claim_incident_id'=>$claim_id,
                'user_id'=>Auth::user()->user_id,
                'incident_datetime'=>date('Y-m-d', strtotime($input['incident_date'])),
                'incident_location'=>$input['incident_location'],
                'image_1'=>$image_name_1,
                'image_2'=>$image_name_2,
                'image_3'=>$image_name_3,
                'image_4'=>$image_name_4,
                'policy_id'=>$input['policy_id'],
                'incident_description'=>$input['incident_description']
            ];

            $add_claim_incident = ClaimIncident::create($for_claim_incident_data);

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
}
