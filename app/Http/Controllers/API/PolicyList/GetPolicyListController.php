<?php

namespace App\Http\Controllers\API\PolicyList;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\HomePolicy;
use App\Models\InsurerPolicy;
use App\Models\Insurer;
use App\Models\DriverDetails;
use App\Models\PolicySubType;
use App\Models\TplEntry;
use App\Models\Car;
use App\Models\GreenCard;
use App\Models\FullCasco;
use App\Models\TravelPolicyType;
use  App\Models\Travel;
use App\Models\TermsCondition;
use App\Models\Offers;
use App\Models\Policy;
use URL;
use App\Models\Reporting;
use App\Models\Document;

class GetPolicyListController extends Controller
{
     /**
     * Get Policy List Of User
     * @return \Illuminate\Http\Response
     * @OA\Get(
     *      path="/api/user/policy-list",
     *      operationId="UserPolicyDeatils",
     *      tags={"UserDeatils"},
     *      summary="UserPolicyDeatils",
     *      description="UserDeatails",
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
    public function getPolicyListOfUser(Request $request)
    {
        $bktFailedPolicy = Policy::select('policy.policy_id','policy.user_id')
                                ->where('policy.user_id',Auth::user()->user_id)
                                ->join('transaction','transaction.policy_id','policy.policy_id')
                                ->where(function ($query) {
                                    $query->whereIN('payment_status',['Failed'])
                                    ->orWhereNull('payment_status');
                                });
        $allFailedPolicyId = Policy::select('policy.policy_id','policy.user_id')
                                ->where('policy.user_id',Auth::user()->user_id)
                                ->join('paypal_transaction','paypal_transaction.policy_id','policy.policy_id')
                                ->whereNotIN('Paypal_status',['COMPLETED'])
                                ->union($bktFailedPolicy)->pluck('policy_id');

        $get_user_policy = Policy::select('*','policy.id as policy_data_id')
                            ->whereNotIn('policy_id',$allFailedPolicyId)
                            ->where('user_id',Auth::user()->user_id)
                            ->WhereIN('claiming_paid',[0,'0'])
                            ->where('expiry_date', '>' , date("Y-m-d"))
                            ->join('insurer','policy.insurer_id','=','insurer.insurer_id')
                            ->orderBy('policy.created_at', 'DESC')
                            ->get();
        try{
            $show_details = $this->policyList($get_user_policy);
        
        return response()->json(['success' => true, 'message' => $show_details], 200);
        }
        // catch exception
        catch(\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()],400);
        }
        // if(!empty($show_details))
        // {
        //     return response()->json(['success' => true, 'message' => $show_details], 200);
        // }
        // else{
        //     return response()->json(['success' => false, 'message' =>'There are no policies' ], 400);
        // }
        
    }

    public function getPolicySubType($policy_type)
    {
        $get_policy_sub_type = PolicySubType::where('policy_sub_type_id',$policy_type)->select('name','policy_sub_type_id')->first();
        return $get_policy_sub_type;
    }
    public function getDriverDeatils($user_id,$policy_id)
    {
       $driver_details = DriverDetails::where('user_id',$user_id)
                                        ->where('policy_id',$policy_id)
                                        ->select('driver_name','driver_second_name','dob','id_card_number')
                                        ->first();
        return $driver_details;
    }
    public function getCarData($policy_id)
    {
        $car_details = Car::where('policy_id','LIKE',"%$policy_id%")->first();
        $car_data=[];
        if(!empty($car_details))
        {
            $path = '/storage/car/car-image/';
            $car_data =[
                'car_registration_number'=>$car_details->car_registration_number,
                'image_1'=>!empty($car_details->document_image_1)?URL::asset($path.$car_details['document_image_1']):null,
                'image_2'=>!empty($car_details->document_image_2)?URL::asset($path.$car_details['document_image_2']):null,
                'image_3'=>!empty($car_details->document_image_3)?URL::asset($path.$car_details['document_image_3']):null,
                'image_4'=>!empty($car_details->document_image_4)?URL::asset($path.$car_details['document_image_4']):null,
            ];
        }
        return $car_data;
    }

    //reporting
    public function getReporting($policy_id)
    {
        $reporting_data = Reporting::where('policy_id',$policy_id)->select('method')->first();
        return $reporting_data;
    }

    public function getLogo($logo_name)
    {
        $logo_path = '/storage/uploads/insurer_logo/';
        $logo = !empty($logo_name)?URL::asset($logo_path.$logo_name):null;
        return $logo;
    }
    public function getTermsandCondition($insurer_policy_id)
    {
        $get_terms_condition = TermsCondition::where('insurer_policy_id',$insurer_policy_id)->first();
        $terms_condition_path = '/storage/uploads/terms_condition/';
        $terms_condition_url = !empty($get_terms_condition)?URL::asset($terms_condition_path.$get_terms_condition['policy_file']):null;
        return $terms_condition_url;
    }
    public function getOffername($offer_id)
    {
        $get_offer = Offers::where('offers_id',$offer_id)->withTrashed()->select('offer_name')->first();
        return $get_offer;
    }

    public function getAdminPolicyDocument($policy_id)
    {
        $find_policy_document = Document::where('entity_id',$policy_id)->first();
        // dd($find_policy_document);
        $_path = '/storage/policy-documents/';
        $_url = !empty($find_policy_document)?URL::asset($_path.$find_policy_document['file_name']):null;
        return $_url;
        
    }
    public function getInsurerPolicy($insurer_policy_id)
    {
        $insurer_policy_details = InsurerPolicy::where('insurer_policy_id',$insurer_policy_id)->select('policy_name','comparision_values')->first();
        return $insurer_policy_details;
    }
    public function getstatus($next_following_update,$policy_id)
    {
        if(!empty($next_following_update))
        {
            if(date("Y-m-d")> date("Y-m-d",strtotime($next_following_update)))
            {
                $update_policy = Policy::where('policy_id',$policy_id)->update(['status'=>0]);
                $status = 0;
            }else if(date("Y-m-d") == date("Y-m-d",strtotime($next_following_update))){
                $update_policy = Policy::where('policy_id',$policy_id)->update(['status'=>0]);
                $status = 0;
            }
            else{
                $status = 1;
            }
        }
        else{
            $status = 0;
        }
        return $status;
        
    }

    

     /**
     * Get Expire Policy List Of User
     * @return \Illuminate\Http\Response
     * @OA\Get(
     *      path="/api/user/expire-policy-list",
     *      operationId="UserExpirePolicyList",
     *      tags={"UserDeatils"},
     *      summary="UserExpirePolicyList",
     *      description="UserExpirePolicyList",
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

    public function getUserExiprePolicyList(Request $request)
    {
        $bktFailedPolicy = Policy::select('policy.policy_id','policy.user_id')
                                ->where('policy.user_id',Auth::user()->user_id)
                                ->join('transaction','transaction.policy_id','policy.policy_id')
                                ->where(function ($query) {
                                    $query->whereIN('payment_status',['Failed'])
                                    ->orWhereNull('payment_status');
                                });
        $allFailedPolicyId = Policy::select('policy.policy_id','policy.user_id')
                                ->where('policy.user_id',Auth::user()->user_id)
                                ->join('paypal_transaction','paypal_transaction.policy_id','policy.policy_id')
                                ->whereNotIN('Paypal_status',['COMPLETED'])
                                ->union($bktFailedPolicy)->pluck('policy_id');

        $get_user_policy = Policy::where('user_id',Auth::user()->user_id)
                            ->whereNotIn('policy_id',$allFailedPolicyId)
                            ->where('expiry_date', '<=' , date("Y-m-d"))
                            ->join('insurer','policy.insurer_id','=','insurer.insurer_id')
                            ->orderBy('policy.created_at', 'DESC')
                            ->get();
        try {
            foreach($get_user_policy as $polices){
                $polices->update(['status'=>0]);
            }
            $show_details = $this->policyList($get_user_policy);
        
            return response()->json(['success' => true, 'message' => $show_details], 200);
          }
          //catch exception
          catch(\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()],400);
          }
        // if(!empty($show_details))
        // {
        //     return response()->json(['success' => true, 'message' => $show_details], 200);
        // }
        // else{
        //     return response()->json(['success' => false, 'message' =>'There are no policies' ], 400);
        // }
        
    }

    public function policyList($get_user_policy)
    {
        $show_details = [];
        foreach($get_user_policy as $policy_details)
        {

            if($policy_details->policy_type == '74273e1bc257')
            {
                $get_property = Property::where('user_id',$policy_details->user_id)
                                        ->where('policy_id',$policy_details->policy_id)
                                        ->select('id_number','property_number','kadastral_number','inside_image_1','inside_image_2','inside_image_3','outside_image_1',
                                        'outside_image_2','outside_image_3','full_address','square')
                                        ->first();
                                        //storage/home  date("Y-m-d", strtotime($policy_details->expiry_date))

                $details_of_policy = HomePolicy::where('home_policy_id',$policy_details->policy_name)->select('insurer_policy_id','home_sub_type_id')->first();
                
                $insurer_policy_details = $this->getInsurerPolicy($details_of_policy['insurer_policy_id']);
                // $policy_name = InsurerPolicy::where('insurer_policy_id',$details_of_policy['insurer_policy_id'])->select('policy_name')->first();
        
                $logo = $this->getLogo($policy_details->logo);
                $terms_and_condition = $this->getTermsandCondition($details_of_policy['insurer_policy_id']);

                $get_offer = $this->getOffername($policy_details->offer);
                $status = $this->getstatus($policy_details->expiry_date,$policy_details->policy_id);
                
                $report = $this->getReporting($policy_details->policy_id);
                
                $get_document = $this->getAdminPolicyDocument($policy_details->policy_id);
                $show_details[]=[
                    'property_details' => $get_property,
                    'type'=>$this->getPolicySubType($policy_details->policy_type),
                    'policy_details'=>$details_of_policy,
                    'policy_name'=>$insurer_policy_details['policy_name'],
                    'comparision_values'=>$insurer_policy_details['comparision_values'],
                    'company_details'=>$policy_details->name,
                    'offer'=>$get_offer,
                    'status'=>$status,
                    'policy_number'=>!empty($policy_details->policy_number)?$policy_details->policy_number:"PL100".$policy_details->policy_data_id,
                    'start_date'=>date("Y-m-d", strtotime($policy_details->start_date)),
                    'end_date'=>date("Y-m-d", strtotime($policy_details->expiry_date)),
                    'policy_id'=>$policy_details->policy_id,
                    'insurer_id'=>$policy_details->insurer_id,
                    'premium'=>$policy_details->premium,
                    'terms_and_condition'=>$terms_and_condition,
                    'logo'=>$logo,
                    'name'=>$policy_details->insured_name,
                    'report'=>$report,
                    'get_document'=>$get_document
                ];
            }
            elseif($policy_details->policy_type == 'c1bc21cfdda9')
            {
                $get_driver = $this->getDriverDeatils($policy_details->user_id,$policy_details->policy_id);

                $details_of_policy = TplEntry::where('tpl_entry_id',$policy_details->policy_name)->select('insurer_policy_id')->first();
               
                // $policy_name = InsurerPolicy::where('insurer_policy_id',$details_of_policy['insurer_policy_id'])->select('policy_name')->first();
                $insurer_policy_details = $this->getInsurerPolicy($details_of_policy['insurer_policy_id']);
        
                
                $car_details = $this->getCarData($policy_details->policy_id);
                $get_offer = $this->getOffername($policy_details->offer);
                
                $status = $this->getstatus($policy_details->expiry_date,$policy_details->policy_id);
                $logo = $this->getLogo($policy_details->logo);
                $terms_and_condition = $this->getTermsandCondition($details_of_policy['insurer_policy_id']);
                $report = $this->getReporting($policy_details->policy_id);
                $get_document = $this->getAdminPolicyDocument($policy_details->policy_id);
                $show_details[]=[
                    'driver_deatils' => $get_driver,
                    'type'=>$this->getPolicySubType($policy_details->policy_type),
                    'policy_details'=>$details_of_policy,
                    'policy_name'=>$insurer_policy_details['policy_name'],
                    'comparision_values'=>$insurer_policy_details['comparision_values'],
                    'company_details'=>$policy_details->name,
                    'car_details'=>$car_details,
                    'offer'=>$get_offer,
                    'status'=>$status,
                    'policy_number'=>!empty($policy_details->policy_number)?$policy_details->policy_number:"PL100".$policy_details->policy_data_id,
                    'start_date'=>date("Y-m-d", strtotime($policy_details->start_date)),
                    'end_date'=>date("Y-m-d", strtotime($policy_details->expiry_date)),
                    'policy_id'=>$policy_details->policy_id,
                    'insurer_id'=>$policy_details->insurer_id,
                    'premium'=>$policy_details->premium,
                    'terms_and_condition'=>$terms_and_condition,
                    'logo'=>$logo,
                    'name'=>$policy_details->insured_name,
                    'report'=>$report,
                    'get_document'=>$get_document
                ];

            }
            elseif($policy_details->policy_type == 'dfd3e39b733a')
            {
                $get_driver = $this->getDriverDeatils($policy_details->user_id,$policy_details->policy_id);
               
                $details_of_policy = GreenCard::where('green_card_id',$policy_details->policy_name)->select('insurer_policy_id','name')->first();

                // $policy_name = InsurerPolicy::where('insurer_policy_id',$details_of_policy['insurer_policy_id'])->select('policy_name')->first();
                $insurer_policy_details = $this->getInsurerPolicy($details_of_policy['insurer_policy_id']);

                $logo = $this->getLogo($policy_details->logo);
                $terms_and_condition = $this->getTermsandCondition($details_of_policy['insurer_policy_id']);
                
                $car_details = $this->getCarData($policy_details->policy_id);
                $get_offer = $this->getOffername($policy_details->offer);
                $status = $this->getstatus($policy_details->expiry_date,$policy_details->policy_id);
                
                $report = $this->getReporting($policy_details->policy_id);
                $get_document = $this->getAdminPolicyDocument($policy_details->policy_id);
                $show_details[]=[
                    'driver_deatils' => $get_driver,
                    'type'=>$this->getPolicySubType($policy_details->policy_type),
                    'policy_details'=>$details_of_policy,
                    'policy_name'=>$insurer_policy_details['policy_name'],
                    'comparision_values'=>$insurer_policy_details['comparision_values'],
                    'company_details'=>$policy_details->name,
                    'car_details'=>$car_details,
                    'offer'=>$get_offer,
                    'status'=>$status,
                    'policy_number'=>!empty($policy_details->policy_number)?$policy_details->policy_number:"PL100".$policy_details->policy_data_id,
                    'start_date'=>date("Y-m-d", strtotime($policy_details->start_date)),
                    'end_date'=>date("Y-m-d", strtotime($policy_details->expiry_date)),
                    'policy_id'=>$policy_details->policy_id,
                    'insurer_id'=>$policy_details->insurer_id,
                    'premium'=>$policy_details->premium,
                    'terms_and_condition'=>$terms_and_condition,
                    'logo'=>$logo,
                    'name'=>$policy_details->insured_name,
                    'report'=>$report,
                    'get_document'=>$get_document
                ];
            }
            elseif($policy_details->policy_type == 'c7824ee08a59')
            {
                $get_driver = $this->getDriverDeatils($policy_details->user_id,$policy_details->policy_id);
                $details_of_policy = FullCasco::where('full_casco_id',$policy_details->policy_name)->select('insurer_policy_id')->first();

                // $policy_name = InsurerPolicy::where('insurer_policy_id',$details_of_policy['insurer_policy_id'])->select('policy_name')->first();
                $insurer_policy_details = $this->getInsurerPolicy($details_of_policy['insurer_policy_id']);
        
                $logo = $this->getLogo($policy_details->logo);
                $terms_and_condition = $this->getTermsandCondition($details_of_policy['insurer_policy_id']);
                $car_details = $this->getCarData($policy_details->policy_id);
                
                $get_offer = $this->getOffername($policy_details->offer);
                $status = $this->getstatus($policy_details->expiry_date,$policy_details->policy_id);
                $get_document = $this->getAdminPolicyDocument($policy_details->policy_id);
                $report = $this->getReporting($policy_details->policy_id);
                $show_details[]=[
                    'driver_deatils' => $get_driver,
                    'type'=>$this->getPolicySubType($policy_details->policy_type),
                    'policy_details'=>$details_of_policy,
                    'policy_name'=>$insurer_policy_details['policy_name'],
                    'comparision_values'=>$insurer_policy_details['comparision_values'],
                    'company_details'=>$policy_details->name,
                    'car_details'=>$car_details,
                    'offer'=>$get_offer,
                    'status'=>$status,
                    'policy_number'=>!empty($policy_details->policy_number)?$policy_details->policy_number:"PL100".$policy_details->policy_data_id,
                    'start_date'=>date("Y-m-d", strtotime($policy_details->start_date)),
                    'end_date'=>date("Y-m-d", strtotime($policy_details->expiry_date)),
                    'policy_id'=>$policy_details->policy_id,
                    'insurer_id'=>$policy_details->insurer_id,
                    'premium'=>$policy_details->premium,
                    'terms_and_condition'=>$terms_and_condition,
                    'logo'=>$logo,
                    'name'=>$policy_details->insured_name,
                    'report'=>$report,
                    'get_document'=>$get_document
                ];
            }
            elseif($policy_details->policy_type == '69e21f9783bd')
            {
                $get_travel_data = TravelPolicyType::where('user_id',$policy_details->user_id)
                                                    ->select('father_name','passport_number','days')
                                                    ->where('policy_id',$policy_details->policy_id)
                                                    ->first();

                $details_of_policy = Travel::where('travel_id',$policy_details->policy_name)->select('insurer_policy_id')->first();

                $insurer_policy_details = $this->getInsurerPolicy($details_of_policy['insurer_policy_id']);
                // $company_details = Insurer::where('insurer_id',$policy_details->insurer_id)->pluck('name');
                $logo = $this->getLogo($policy_details->logo);
                $terms_and_condition = $this->getTermsandCondition($details_of_policy['insurer_policy_id']);
                $get_offer = $this->getOffername($policy_details->offer);
                $status = $this->getstatus($policy_details->expiry_date,$policy_details->policy_id);
                //reoprting 
                $report = $this->getReporting($policy_details->policy_id);
                $get_document = $this->getAdminPolicyDocument($policy_details->policy_id);
                $show_details[]=[
                    'travel_details' => $get_travel_data,
                    'type'=>$this->getPolicySubType($policy_details->policy_type),
                    'policy_details'=>$details_of_policy,
                    'policy_name'=>$insurer_policy_details['policy_name'],
                    'comparision_values'=>$insurer_policy_details['comparision_values'],
                    'company_details'=>$policy_details->name,
                    'offer'=>$get_offer,
                    'status'=>$status,
                    'policy_number'=>!empty($policy_details->policy_number)?$policy_details->policy_number:"PL100".$policy_details->policy_data_id,
                    'start_date'=>date("Y-m-d", strtotime($policy_details->start_date)),
                    'end_date'=>date("Y-m-d", strtotime($policy_details->expiry_date)),
                    'policy_id'=>$policy_details->policy_id,
                    'insurer_id'=>$policy_details->insurer_id,
                    'premium'=>$policy_details->premium,
                    'terms_and_condition'=>$terms_and_condition,
                    'logo'=>$logo,
                    'name'=>$policy_details->insured_name,
                    'report'=>$report,
                    'get_document'=>$get_document
                ];

            }
            elseif($policy_details->policy_type == '0ac2b7cfc696')
            {
               
                $get_travel_data = TravelPolicyType::where('user_id',$policy_details->user_id)
                                                    ->where('policy_id',$policy_details->policy_id)
                                                    ->select('father_name','passport_number','days')
                                                    ->first();
                
                $details_of_policy = Travel::where('travel_id',$policy_details->policy_name)->select('insurer_policy_id')->first();
        
                if(!empty($details_of_policy))
                {
                    $inuser_policy_id = $details_of_policy['insurer_policy_id'];
                }
                else{
                    $inuser_policy_id = !empty($policy_details['insurer_policy_id'])?$policy_details['insurer_policy_id']:0;
                }
                $insurer_policy_details = $this->getInsurerPolicy(!empty($inuser_policy_id)?$inuser_policy_id:0);

                $logo = $this->getLogo($policy_details->logo);
                $terms_and_condition = $this->getTermsandCondition(!empty($inuser_policy_id)?$inuser_policy_id:0);
                // $company_details = Insurer::where('insurer_id',$policy_details->insurer_id)->pluck('name');
               
                $get_offer = $this->getOffername($policy_details->offer);
                $status = $this->getstatus($policy_details->expiry_date,$policy_details->policy_id);
                
                //reoprting 
                $report = $this->getReporting($policy_details->policy_id);
                $get_document = $this->getAdminPolicyDocument($policy_details->policy_id);
                $show_details[]=[
                    'travel_details' => $get_travel_data,
                    'type'=>$this->getPolicySubType($policy_details->policy_type),
                    'policy_details'=>$details_of_policy,
                    'policy_name'=>!empty($insurer_policy_details)?$insurer_policy_details['policy_name']:"-",
                    'coverage'=>!empty($insurer_policy_details)?$insurer_policy_details['comparision_values']:"-",
                    'company_details'=>$policy_details->name,
                    'offer'=>$get_offer,
                    'status'=>$status,
                    'policy_number'=>!empty($policy_details->policy_number)?$policy_details->policy_number:"PL100".$policy_details->policy_data_id,
                    'start_date'=>date("Y-m-d", strtotime($policy_details->start_date)),
                    'end_date'=>date("Y-m-d", strtotime($policy_details->expiry_date)),
                    'policy_id'=>$policy_details->policy_id,
                    'insurer_id'=>$policy_details->insurer_id,
                    'premium'=>$policy_details->premium,
                    'terms_and_condition'=>$terms_and_condition,
                    'logo'=>$logo,
                    'name'=>$policy_details->insured_name,
                    'report'=>$report,
                    'get_document'=>$get_document
                ];
            }
        }
        return $show_details;
    }
}
