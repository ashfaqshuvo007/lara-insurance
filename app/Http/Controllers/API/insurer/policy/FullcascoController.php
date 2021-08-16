<?php

namespace App\Http\Controllers\API\insurer\policy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\FullCasco;
use App\Models\Insurer;
use App\Models\InsurerPolicy;
use App\Models\Offers;
use App\Models\Car;
use App\Models\FullCascoType;
use App\Models\PolicySubType;
use App\Models\TermsCondition;
use URL;
use App\Helpers\LeadHelper as LeadHelper;
use App\Models\Lead;
use Illuminate\Support\Facades\Auth;

class FullcascoController extends Controller
{
    /**
     * Full casco API
     * @return \Illuminate\Http\Response
     * @OA\Post(
     *      path="/api/policy/showFullCasco",
     *      operationId="showFullCasco",
     *      tags={"FullCasco"},
     *      summary="showFullCasco",
     *          @OA\RequestBody(
     *            @OA\MediaType(
     *                 mediaType="application/json",
     *                       @OA\Schema(
     *                        @OA\Property(
     *                           property="car_registration_no",
     *                             type="string"
     *                            ),
     *                         @OA\Property(
     *                           property="car_value",
     *                             type="string"
     *                            ),
     *                         @OA\Property(
     *                           property="production_year",
     *                             type="string"
     *                            ),
     *                         @OA\Property(
     *                           property="varient_type",
     *                             type="string"
     *                            ),
     *                                  )
     *                            ),
     *                         ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
	 *          {"bearerAuth": {}}
	 *      },
     *     )
     *
     * Returns FullCasco information message
     */
    public function showFullCasco(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'car_registration_no' => 'required|string|max:255',
            'car_value' => 'required|string|max:255',
            'varient_type' => 'required|string|max:255'
        ]);
        if($validator->fails()){
            return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
        }
        $car_registration_no = [
            'car_registration_no' =>$input['car_registration_no']
        ];
        $get_varients = FullCascoType::where('casco_type_id',$input['varient_type'])->first();
        if(!empty($get_varients))
        {
            $varient_type = $get_varients['varient_name'];
        }
        $get_policy_type = PolicySubType::where('policy_sub_type_id','c7824ee08a59')->first();
        $policy_type = [
            'full_casco'=>$get_policy_type['policy_sub_type_id']
        ];
        $get_register_car = Car::where('car_registration_number',$input['car_registration_no'])->where('user_id',Auth::user()->user_id)->first();
        if(isset($get_register_car))
        {
            //get register car production year 
            $get_production_year = !empty($get_register_car['production_year'])?$get_register_car['production_year']:0;
            //value update 
            $car_value_update =[
                'car_value'=>$input['car_value'],
                'production_year'=>!empty($input['production_year'])?$input['production_year']:$get_production_year
            ];
            $get_register_car->update($car_value_update);
             //create lead 
             $lead = new LeadHelper;
             $find_lead = $lead->_findLead(Auth::user()->user_id);
             if(empty($find_lead))
             {
                 $lead_create=$lead->_leadCreate(Auth::user()->user_id);
             }
            if($get_register_car['car_tpye'] == '5387b8bf5632')
            {
                $get_data = $this->getShowFullCasco($varient_type);
                $car = [
                    'car_registration_number'=>$get_register_car['car_registration_number'],
                    'car_type' =>$get_register_car['car_tpye'],
                    'car_subtype'=>$get_register_car['car_sub_type'],
                    'varient_type'=>$get_varients['casco_type_id']
                ];
                if(!empty($get_data))
                {
                    return response()->json(['success' => true, 'message' =>$get_data,'car'=>$car,'policy_type'=>$policy_type], 200);
                }
                else{
                    return response()->json(['success' => false, 'message' =>'There are no Full Casco policies'], 400);
                }
            }
            else{
                $validator = Validator::make($input, [
                    'car_value' => 'required|string|max:255'
                ]);
                if($validator->fails()){
                    return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
                }
                switch ($varient_type) {
                    case "varient I":
                        $get_data = $this->getShowFullCasco($varient_type);
                        $car = [
                            'car_registration_number'=>$get_register_car['car_registration_number'],
                            'car_type' =>$get_register_car['car_tpye'],
                            'car_subtype'=>$get_register_car['car_sub_type'],
                            'varient_type'=>$get_varients['casco_type_id'],
                            'production_year'=>$input['production_year']
                        ];
                        if(!empty($get_data))
                        {
            
                            return response()->json(['success' => true, 'message' =>$get_data,'car'=>$car,'policy_type'=>$policy_type], 200);
                        }
                        else{
                            return response()->json(['success' => false, 'message' =>'There are no Full Casco policies'], 400);
                        }
                        break;
                    case "varient II":
                        $get_data = $this->getShowFullCasco($varient_type);
                        $car = [
                            'car_registration_number'=>$get_register_car['car_registration_number'],
                            'car_type' =>$get_register_car['car_tpye'],
                            'car_subtype'=>$get_register_car['car_sub_type'],
                            'varient_type'=>$get_varients['casco_type_id'],
                            'production_year'=>$input['production_year']
                        ];
                        if(!empty($get_data))
                        {
                           
                            return response()->json(['success' => true, 'message' =>$get_data,'car'=>$car,'policy_type'=>$policy_type], 200);
                        }
                        else{
                            return response()->json(['success' => false, 'message' =>'There are no Full Casco policies'], 400);
                        }
                        break;
                    case "varient III":
                        $get_data = $this->getShowFullCasco($varient_type);
                        $car = [
                            'car_registration_number'=>$get_register_car['car_registration_number'],
                            'car_type' =>$get_register_car['car_tpye'],
                            'car_subtype'=>$get_register_car['car_sub_type'],
                            'varient_type'=>$get_varients['casco_type_id'],
                            'production_year'=>$input['production_year']
                        ];
                        if(!empty($get_data))
                        {
                           
                            return response()->json(['success' => true, 'message' =>$get_data,'car'=>$car,'policy_type'=>$policy_type], 200);
                        }
                        else{
                            return response()->json(['success' => false, 'message' =>'There are no Full Casco policies'], 400);
                        }
                        break;
                    case "varient IV":
                        $get_data = $this->getShowFullCasco($varient_type);
                        $car = [
                            'car_registration_number'=>$get_register_car['car_registration_number'],
                            'car_type' =>$get_register_car['car_tpye'],
                            'car_subtype'=>$get_register_car['car_sub_type'],
                            'varient_type'=>$get_varients['casco_type_id'],
                            'production_year'=>$input['production_year']
                        ];
                        if(!empty($get_data))
                        {
                           
                            return response()->json(['success' => true, 'message' =>$get_data,'car'=>$car,'policy_type'=>$policy_type], 200);
                        }
                        else{
                            return response()->json(['success' => false, 'message' =>'Their has no Full Casco policy'], 400);
                        }
                        break;
                    case "varient V":
                        $get_data = $this->getShowFullCasco($varient_type);
                        $car = [
                            'car_registration_number'=>$get_register_car['car_registration_number'],
                            'car_type' =>$get_register_car['car_tpye'],
                            'car_subtype'=>$get_register_car['car_sub_type'],
                            'varient_type'=>$get_varients['casco_type_id'],
                            'production_year'=>$input['production_year']
                        ];
                        if(!empty($get_data))
                        {
                            
                            return response()->json(['success' => true, 'message' =>$get_data,'car'=>$car,'policy_type'=>$policy_type], 200);
                        }
                        else{
                            return response()->json(['success' => false, 'message' =>'There are no Full Casco policies'], 400);
                        }
                        break;
                    default:
                        return response()->json(['success' => false, 'message' =>'There are no Full Casco policies'], 400);
                  }
            }
        }
        else{
            return response()->json(['success' => false, 'message' =>'Car is not registered.'], 400);
        }
    }
    public function getShowFullCasco($varient_type)
    {
        $show_data = [];
        $offer = [];
        $get_all_casco = FullCasco::whereIn('full_casco.status',['1',1])
                                    ->join('insurer','full_casco.insurer_id','=','insurer.insurer_id')
                                    ->join('insurer_policy','full_casco.insurer_policy_id','=','insurer_policy.insurer_policy_id')
                                    ->get();
        foreach($get_all_casco as $casco_deatils)
        {
            if($varient_type == $casco_deatils->variant)
            {
                // $policy_details = InsurerPolicy::where('insurer_policy_id',$casco_deatils->insurer_policy_id)->first();

                // $policy_name = $policy_details['policy_name'];

                $show_offer = Offers::where('insurer_policy_id',$casco_deatils->insurer_policy_id)
                                    ->select('offer_name','offers_id','amount_of','percentage_of','extra_amount')
                                    ->get();
                
                // $company_details = Insurer::where('insurer_id',$casco_deatils->insurer_id)->first();

                $get_terms_condition = TermsCondition::where('insurer_policy_id',$casco_deatils->insurer_policy_id)->first();
                $terms_condition_path = '/storage/uploads/terms_condition/';
                $terms_condition_url = !empty($get_terms_condition)?URL::asset($terms_condition_path.$get_terms_condition['policy_file']):null;
    
                $logo_path = '/storage/uploads/insurer_logo/';
                $logo = !empty($casco_deatils['logo'])?URL::asset($logo_path.$casco_deatils['logo']):null;
                // dd($casco_deatils->price);
                $show_data[]=[
                    'company_name'=>$casco_deatils['name'],
                    'policy_name' => $casco_deatils->policy_name,
                    'commision_percentage'=>$casco_deatils['commission'],
                    'coverage_percentage'=>$casco_deatils->price,
                    'percentage'=>$casco_deatils->percentage,
                    'offer' => $show_offer,
                    'policy_details_id'=>$casco_deatils->full_casco_id,
                    'insurer_id'=>$casco_deatils->insurer_id,
                    'insurer_policy_id'=>$casco_deatils->insurer_policy_id,
                    'terms_and_condition'=>$terms_condition_url,
                    'logo'=>$logo,
                    'coverage'=>empty($casco_deatils->comparision_values)?null:$casco_deatils->comparision_values
                ];
            }
        }
        return $show_data;
    }
    /**
     * FullCasco type list API
     * @return \Illuminate\Http\Response
     * @OA\Get(
     *      path="/api/policy/get-full-casco-sub-type",
     *      operationId="fullcascosubType",
     *      tags={"FullCasco"},
     *      summary="Full casco type list",
     *      description="Full Casco Type List",
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
     * Returns fullcasco information message
     */
    
    public function getFullCascoSubtype(Request $request)
    {
        $get_all_sub_type = FullCascoType::limit(3)->get();
        if(!empty($get_all_sub_type))
        {
            return response()->json(['success' => true, 'message' =>$get_all_sub_type], 200);
        }
        else{
            return response()->json(['success' => false, 'message' =>'Invalid Casco Sub Type'], 400);
        }
    }
}
