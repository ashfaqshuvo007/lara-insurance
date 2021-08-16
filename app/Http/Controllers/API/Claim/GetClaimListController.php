<?php

namespace App\Http\Controllers\API\Claim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Claim;
use Illuminate\Support\Facades\Auth;
use App\Models\ClaimIncident;
use App\Models\ClaimIncidentForHome;
use App\Models\Policy;
use App\Models\InsurerPolicy;
use App\Models\Insurer;
use App\Models\Property;
use URL;
use App\Http\Controllers\API\PolicyList\GetPolicyListController as GetPolicyListController;
class GetClaimListController extends Controller
{
    /**
     * Get Claim Policy List Of User
     * @return \Illuminate\Http\Response
     * @OA\Get(
     *      path="/api/claim/get-claim-policy",
     *      operationId="UserClaimPolicyList",
     *      tags={"Claim"},
     *      summary="UserClaimPolicyList",
     *      description="UserClaimPolicyList",
     * 
     * 
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
	 *          {"bearerAuth": {}}
	 *      },
     *     )
     *
     * Returns userPolicy information message
     */

    public function getClaimPolicyList(Request $request)
    {
        $get_user_claim_list = Claim::where('user_id',Auth::user()->user_id)
                                    ->get();

        $policy_list_object = new  GetPolicyListController;
        try{
            $show_claim_details =[];
            foreach($get_user_claim_list as $claim_details)
            {
                if($claim_details->policy_type == '74273e1bc257')
                {
                $get_claim_details = ClaimIncidentForHome::where('claim_incident_id',$claim_details->claims_id)->where('user_id',Auth::user()->user_id)->first();
                $policy_details = Policy::where('policy_id',$claim_details->policy_id)->first();
                
               
                $company_name = Insurer::where('insurer_id',$policy_details->insurer_id)->first();
                $logo = $policy_list_object->getLogo($company_name->logo);
                $policy_name = InsurerPolicy::where('insurer_policy_id',$claim_details->insurer_policy_id)->first();

                $get_offer = $policy_list_object->getOffername($policy_details->offer);
                $status = $policy_list_object->getstatus($policy_details->expiry_date,$policy_details->policy_id);
                $company_terms_condition = $policy_list_object->getTermsandCondition($claim_details->insurer_policy_id);
                $report = $policy_list_object->getReporting($claim_details->policy_id);

               
                $object_details = Property::where('property.policy_id',$claim_details->policy_id)->join('home_sub_type','property.home_type','home_sub_type.price_type_id')->first();
                $show_claim_details[]=[
                    'get_claim_details'=>$get_claim_details,
                    'policy_details'=>$policy_details,
                    'company_name'=>!empty($company_name['name'])?$company_name['name']:null,
                    'policy_name'=>!empty($policy_name['policy_name'])?$policy_name['policy_name']:null,
                    'object_details'=>$object_details,
                    'company_terms_condition'=>!empty($company_terms_condition)?$company_terms_condition:null,
                    'start_date'=>date("Y-m-d", strtotime($policy_details->start_date)),
                    'end_date'=>date("Y-m-d", strtotime($policy_details->expiry_date)),
                    'offer'=>$get_offer,
                    'status'=>$status,
                    'report'=>$report,
                    'logo'=>$logo,
                    'policy_type'=>"Home"
                ];
                }
                elseif($claim_details->policy_type == 'c1bc21cfdda9'){
                    $get_claim_details = ClaimIncident::where('claim_incident_id',$claim_details->claims_id)->where('user_id',Auth::user()->user_id)->first();
                    
                    $policy_details = Policy::where('policy_id',$claim_details->policy_id)->first();
                
                    $company_name = Insurer::where('insurer_id',$policy_details->insurer_id)->first();
                    $policy_name = InsurerPolicy::where('insurer_policy_id',$claim_details->insurer_policy_id)->first();
    
                     $get_driver = $policy_list_object->getDriverDeatils($claim_details->user_id,$claim_details->policy_id);
                     $logo = $policy_list_object->getLogo($company_name->logo);
                    $get_offer = $policy_list_object->getOffername($policy_details->offer);
                    $status = $policy_list_object->getstatus($policy_details->expiry_date,$policy_details->policy_id);
                    $company_terms_condition = $policy_list_object->getTermsandCondition($claim_details->insurer_policy_id);
                    $object_details = $policy_list_object ->getCarData($claim_details->policy_id);
                    $report = $policy_list_object->getReporting($claim_details->policy_id);

                    $show_claim_details[]=[
                        'get_claim_details'=>$get_claim_details,
                        'policy_details'=>$policy_details,
                        'company_name'=>!empty($company_name['name'])?$company_name['name']:null,
                        'policy_name'=>!empty($policy_name['policy_name'])?$policy_name['policy_name']:null,
                        'object_details'=>!empty($object_details)?$object_details:null,
                        'company_terms_condition'=>!empty($company_terms_condition)?$company_terms_condition:null,
                        'start_date'=>date("Y-m-d", strtotime($policy_details->start_date)),
                        'end_date'=>date("Y-m-d", strtotime($policy_details->expiry_date)),
                        'offer'=>$get_offer,
                        'status'=>$status,
                        'report'=>$report,
                        'logo'=>$logo,
                        'driver_deatils' => $get_driver,
                        'policy_type'=>"TPL"
                    ];
                }
                elseif($claim_details->policy_type == 'dfd3e39b733a'){

                    $get_claim_details = ClaimIncident::where('claim_incident_id',$claim_details->claims_id)->where('user_id',Auth::user()->user_id)->first();
                    $policy_details = Policy::where('policy_id',$claim_details->policy_id)->first();
                
                    $company_name = Insurer::where('insurer_id',$policy_details->insurer_id)->first();
                    $policy_name = InsurerPolicy::where('insurer_policy_id',$claim_details->insurer_policy_id)->first();
                    $logo = $policy_list_object->getLogo($company_name->logo);
                    $get_offer = $policy_list_object->getOffername($policy_details->offer);
                    $status = $policy_list_object->getstatus($policy_details->expiry_date,$policy_details->policy_id);
                    $company_terms_condition = $policy_list_object->getTermsandCondition($claim_details->insurer_policy_id);
                    $object_details = $policy_list_object ->getCarData($claim_details->policy_id);
                    $report = $policy_list_object->getReporting($claim_details->policy_id);

                     $get_driver = $policy_list_object->getDriverDeatils($claim_details->user_id,$claim_details->policy_id);
                    $show_claim_details[]=[
                        'get_claim_details'=>$get_claim_details,
                        'policy_details'=>$policy_details,
                        'company_name'=>!empty($company_name['name'])?$company_name['name']:null,
                        'policy_name'=>!empty($policy_name['policy_name'])?$policy_name['policy_name']:null,
                        'object_details'=>!empty($object_details)?$object_details:null,
                        'company_terms_condition'=>!empty($company_terms_condition)?$company_terms_condition:null,
                        'start_date'=>date("Y-m-d", strtotime($policy_details->start_date)),
                        'end_date'=>date("Y-m-d", strtotime($policy_details->expiry_date)),
                        'offer'=>$get_offer,
                        'status'=>$status,
                        'report'=>$report,
                        'logo'=>$logo,
                        'driver_deatils' => $get_driver,
                        'policy_type'=>"Green Card"
                    ];
                }
                elseif($claim_details->policy_type == 'c7824ee08a59'){

                    $get_claim_details = ClaimIncident::where('claim_incident_id',$claim_details->claims_id)->where('user_id',Auth::user()->user_id)->first();
                    $policy_details = Policy::where('policy_id',$claim_details->policy_id)->first();
                
                    $company_name = Insurer::where('insurer_id',$policy_details->insurer_id)->first();
                    $policy_name = InsurerPolicy::where('insurer_policy_id',$claim_details->insurer_policy_id)->first();
    
                     $get_driver = $policy_list_object->getDriverDeatils($claim_details->user_id,$claim_details->policy_id);
                     $logo = $policy_list_object->getLogo($company_name->logo);
                    $get_offer = $policy_list_object->getOffername($policy_details->offer);
                    $status = $policy_list_object->getstatus($policy_details->expiry_date,$policy_details->policy_id);
                    $company_terms_condition = $policy_list_object->getTermsandCondition($claim_details->insurer_policy_id);
                    $object_details = $policy_list_object ->getCarData($claim_details->policy_id);
                    $report = $policy_list_object->getReporting($claim_details->policy_id);
                    $show_claim_details[]=[
                        'get_claim_details'=>$get_claim_details,
                        'policy_details'=>$policy_details,
                        'company_name'=>!empty($company_name['name'])?$company_name['name']:null,
                        'policy_name'=>!empty($policy_name['policy_name'])?$policy_name['policy_name']:null,
                        'object_details'=>!empty($object_details)?$object_details:null,
                        'company_terms_condition'=>!empty($company_terms_condition)?$company_terms_condition:null,
                        'start_date'=>date("Y-m-d", strtotime($policy_details->start_date)),
                        'end_date'=>date("Y-m-d", strtotime($policy_details->expiry_date)),
                        'offer'=>$get_offer,
                        'status'=>$status,
                        'report'=>$report,
                        'logo'=>$logo,
                        'driver_deatils' => $get_driver,
                        'policy_type'=>"Full Casco"
                    ];
                }
            }
            return response()->json(['success' => true, 'message' => $show_claim_details], 200);
        }
        catch(\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()],400);
            }
        // if(!empty($show_claim_details))
        // {
        //     return response()->json(['success' => true, 'message' => $show_claim_details], 200);
        // }
        // else{
        //     return response()->json(['success' => false, 'message' =>'There are no claim lists.' ], 400);
        // }
        // return $show_claim_details;
    }
}
