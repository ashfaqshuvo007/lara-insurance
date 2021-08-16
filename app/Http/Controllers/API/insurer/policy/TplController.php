<?php

namespace App\Http\Controllers\API\insurer\policy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TplSubType;
use App\Models\TplType;
use App\Models\TplEntry;
use Validator;
use App\Models\Insurer;
use App\Models\InsurerPolicy;
use App\Models\Offers;
use App\Models\PolicySubType;
use App\Models\Car;
use App\Models\TplSubTypeApi;
use App\Models\TermsCondition;
use URL;
use Illuminate\Support\Facades\Auth;
use App\Models\Lead;
use App\Helpers\LeadHelper as LeadHelper;

class TplController extends Controller
{

    /**
     * Tpl Type API
     * @return \Illuminate\Http\Response
     * 
     * @OA\Get(
     *      path="/api/policy/tpl-type/{language_type}",
     *      operationId="TplDetails",
     *      tags={"Tpl"},
     *      summary="TplType",
     *      @OA\Parameter(
     *          name="language_type",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *          {"bearerAuth": {}}
     *      },
     * )
     * 
     */

    public function getTplType(Request $request,$language_type)
    {
        if($language_type == 'en')
        {
            $get_all_tpl_type = TplType::where('tpl_type_id', '!=', 'd88ed7fda1fa')->pluck('tpl_type_id','name');
            if($get_all_tpl_type)
            {
                return response()->json(['success' => true,'message'=>$get_all_tpl_type],200);
            }
            else{
                return response()->json(['success' => false, 'message' => 'Their is no Tpl Type'],400);
            }
        }
        elseif($language_type == 'al'){
            $get_all_tpl_type = TplType::where('tpl_type_id', '!=', 'd88ed7fda1fa')->pluck('tpl_type_id','tpl_type.albanian_name as name');
            if($get_all_tpl_type)
            {
                return response()->json(['success' => true,'message'=>$get_all_tpl_type],200);
            }
            else{
                return response()->json(['success' => false, 'message' => 'Their is no Tpl Type'],400);
            }
        }
        elseif($language_type == 'sq'){
            $get_all_tpl_type = TplType::where('tpl_type_id', '!=', 'd88ed7fda1fa')->pluck('tpl_type_id','tpl_type.albanian_name as name');
            if($get_all_tpl_type)
            {
                return response()->json(['success' => true,'message'=>$get_all_tpl_type],200);
            }
            else{
                return response()->json(['success' => false, 'message' => 'Their is no Tpl Type'],400);
            }
        }
        else{
            return response()->json(['success' => false, 'message' => 'Language Type is not correct'],400);
        }
        
    }

    /**
      * Tpl Sub Type API
     * @return \Illuminate\Http\Response
     * @OA\Post(
     *      path="/api/policy/tpl-sub-type",
     *      operationId="TplDetails",
     *      tags={"Tpl"},
     *      summary="TplSubtype",
     *          @OA\RequestBody(
     *            @OA\MediaType(
     *                 mediaType="application/json",
     *                       @OA\Schema(
     *                         @OA\Property(
     *                           property="tpl_type_id",
     *                             type="string"
     *                            ),
     *                          @OA\Property(
     *                           property="language_type",
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
     * Returns Tpl information message
     */

    public function getTplSubtype(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'tpl_type_id' => 'required|string|max:255',
            'language_type'=>'required|string|max:255'
        ]);
        if($validator->fails()){
            return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
        }
        try{
            if($input['tpl_type_id'] =='5387b8bf5632')
            {
                if($input['language_type'] == 'en')
                {
                    $get_tpl_sub_type_list = TplSubTypeApi::where('tpl_type_id',$input['tpl_type_id'])->pluck('tpl_sub_type_api_id','name');
                    if($get_tpl_sub_type_list)
                    {
                        return response()->json(['success' => true,'message'=>$get_tpl_sub_type_list],200);
                    }
                    else{
                        return response()->json(['success' => false, 'message' => 'Their is no Tpl Sub Type'],400);
                    }
                }
                elseif($input['language_type'] == 'al' || $input['language_type'] == 'sq')
                {
                    $get_tpl_sub_type_list = TplSubTypeApi::where('tpl_type_id',$input['tpl_type_id'])->pluck('tpl_sub_type_api_id','tpl_sub_type_api.albanian_name as name');
                    if($get_tpl_sub_type_list)
                    {
                        return response()->json(['success' => true,'message'=>$get_tpl_sub_type_list],200);
                    }
                    else{
                        return response()->json(['success' => false, 'message' => 'Their is no Tpl Sub Type'],400);
                    }
                }
                else{
                    return response()->json(['success' => false, 'message' => 'Language Type is not correct'],400);
                }
            }
            else{
                if($input['language_type'] == 'en')
                {
                    $get_tpl_sub_type_list = TplSubType::where('tpl_type_id',$input['tpl_type_id'])->pluck('tpl_sub_type_id','name');
                    if($get_tpl_sub_type_list->isNotEmpty())
                    {
                        return response()->json(['success' => true,'message'=>$get_tpl_sub_type_list],200);
                    }
                    else{
                        return response()->json(['success' => false, 'message' => 'Their is no Tpl Sub Type'],400);
                    }
                }
                elseif($input['language_type'] == 'al' || $input['language_type'] == 'sq')
                {
                    $get_tpl_sub_type_list = TplSubType::where('tpl_type_id',$input['tpl_type_id'])->pluck('tpl_sub_type_id','tpl_sub_type.albanian_name as name');
                    if($get_tpl_sub_type_list->isNotEmpty())
                    {
                        return response()->json(['success' => true,'message'=>$get_tpl_sub_type_list],200);
                    }
                    else{
                        return response()->json(['success' => false, 'message' => 'Their is no Tpl Sub Type'],400);
                    }
                }
                else{
                    return response()->json(['success' => false, 'message' => 'Language Type is not correct'],400);
                }
                
            }
        }
        catch (\Exception $e){
            return response()->json(['success' => false, 'message' => 'Their has no Sub Type'], 400);
        }  
    }

     /**
      * Tpl API
     * @return \Illuminate\Http\Response
     * @OA\Post(
     *      path="/api/policy/tpl",
     *      operationId="TplDetails",
     *      tags={"Tpl"},
     *      summary="TPLList",
     *          @OA\RequestBody(
     *            @OA\MediaType(
     *                 mediaType="application/json",
     *                       @OA\Schema(
     *                         @OA\Property(
     *                           property="registration_no",
     *                             type="string"
     *                            ),
     *                          @OA\Property(
     *                           property="tpl_type_id",
     *                             type="string"
     *                            ),
     *                          @OA\Property(
     *                           property="tpl_sub_type_id",
     *                             type="string"
     *                            ),
     *                         @OA\Property(
     *                           property="production_year",
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
     * Returns Tpl information message
     */
    public function getTplListandSubList(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'registration_no' => 'required|string|max:255',
            'tpl_type_id' => 'required|string|max:255',
            'tpl_sub_type_id'=>'required|string|max:255',
            'production_year'=>'required|string|max:255'
        ]);
        if($validator->fails()){
            return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
        }
        $get_tpl_type = TplType::where('tpl_type_id',$input['tpl_type_id'])->first();
        $get_register_car = Car::where('car_registration_number',$input['registration_no'])->where('user_id',Auth::user()->user_id)->first();

        if(!empty($get_tpl_type))
        {
            if(!empty($get_register_car))
            {
                //create lead 
                $lead = new LeadHelper;
                $find_lead = $lead->_findLead(Auth::user()->user_id);
                if(empty($find_lead))
                {
                    $lead_create=$lead->_leadCreate(Auth::user()->user_id);
                }
                $car =[
                    'registration_no'=>$input['registration_no']
                ];
                try{
                    if($input['tpl_type_id'] == '5387b8bf5632')
                    {
                        $get_tpl_sub_type = TplSubTypeApi::where('tpl_sub_type_api_id',$input['tpl_sub_type_id'])->first();
                        if(!empty($get_tpl_sub_type))
                        {
                            if($input['tpl_sub_type_id'] == '5ece4797eaf5e')
                            {
                                if((int)$input['production_year']>2009)
                                {
                                    $tpl_type_id = '5387b8bf5632';
                                    $tpl_sub_type_id = '063fe4e402f9';
                                    $get_list = $this->tplListShow($tpl_type_id,$tpl_sub_type_id);
                                    if(!empty($get_list))
                                    {
                                        $policy_type = PolicySubType::where('policy_sub_type_id','c1bc21cfdda9')->pluck('policy_sub_type_id','name');
                                        return response()->json(['success' => true, 'message' =>$get_list,'car'=>$car,'policy_type'=>$policy_type], 200);
                                    }
                                    else
                                    {
                                        return response()->json(['success' => false, 'message' =>'There are no policies.'], 400);
                                    }
                                }
                                elseif((int)$input['production_year']<=2009)
                                {
                                    $tpl_type_id = '5387b8bf5632';
                                    $tpl_sub_type_id = '4d51a9f925ca';
                                
                                    $get_list = $this->tplListShow($tpl_type_id,$tpl_sub_type_id);
                                    if(!empty($get_list))
                                    {
                                        $policy_type = PolicySubType::where('policy_sub_type_id','c1bc21cfdda9')->pluck('policy_sub_type_id','name');
                                        return response()->json(['success' => true, 'message' =>$get_list,'car'=>$car,'policy_type'=>$policy_type], 200);
                                    }
                                    else
                                    {
                                        return response()->json(['success' => false, 'message' =>'There are no policies.'], 400);
                                    }
                                }
                            }
                            elseif($input['tpl_sub_type_id'] == '5ef08d816e624')
                            {
                                if((int)$input['production_year']>2009)
                                {
                                    $tpl_type_id = '5387b8bf5632';
                                    $tpl_sub_type_id = 'd28c9d14d093';
                                    
                                    $get_list = $this->tplListShow($tpl_type_id,$tpl_sub_type_id);
                                    if(!empty($get_list))
                                    {
                                        $policy_type = PolicySubType::where('policy_sub_type_id','c1bc21cfdda9')->pluck('policy_sub_type_id','name');
                                        return response()->json(['success' => true, 'message' =>$get_list,'car'=>$car,'policy_type'=>$policy_type], 200);
                                    }
                                    else
                                    {
                                        return response()->json(['success' => false, 'message' =>'There are no policies.'], 400);
                                    }
                                }
                                elseif((int)$input['production_year']<=2009)
                                {
                                    $tpl_type_id = '5387b8bf5632';
                                    $tpl_sub_type_id = '8b500b52b07c';
                                
                                    $get_list = $this->tplListShow($tpl_type_id,$tpl_sub_type_id);
                                    if(!empty($get_list))
                                    {
                                        $policy_type = PolicySubType::where('policy_sub_type_id','c1bc21cfdda9')->pluck('policy_sub_type_id','name');
                                        return response()->json(['success' => true, 'message' =>$get_list,'car'=>$car,'policy_type'=>$policy_type], 200);
                                    }
                                    else
                                    {
                                        return response()->json(['success' => false, 'message' =>'There are no policies.'], 400);
                                    }
                                }
                            }
                            elseif($input['tpl_sub_type_id'] == '5ef08ddd34477')
                            {
                                if((int)$input['production_year']>2009)
                                {
                                    $tpl_type_id = '5387b8bf5632';
                                    $tpl_sub_type_id = 'dc2ea08df0cb';
                                    
                                    $get_list = $this->tplListShow($tpl_type_id,$tpl_sub_type_id);
                                    if(!empty($get_list))
                                    {
                                        $policy_type = PolicySubType::where('policy_sub_type_id','c1bc21cfdda9')->pluck('policy_sub_type_id','name');
                                        return response()->json(['success' => true, 'message' =>$get_list,'car'=>$car,'policy_type'=>$policy_type], 200);
                                    }
                                    else
                                    {
                                        return response()->json(['success' => false, 'message' =>'There are no policies.'], 400);
                                    }
                                }
                                elseif((int)$input['production_year']<=2009)
                                {
                                    $tpl_type_id = '5387b8bf5632';
                                    $tpl_sub_type_id = 'b2371e8041ba';
                                
                                    $get_list = $this->tplListShow($tpl_type_id,$tpl_sub_type_id);
                                    if(!empty($get_list))
                                    {
                                        $policy_type = PolicySubType::where('policy_sub_type_id','c1bc21cfdda9')->pluck('policy_sub_type_id','name');
                                        return response()->json(['success' => true, 'message' =>$get_list,'car'=>$car,'policy_type'=>$policy_type], 200);
                                    }
                                    else
                                    {
                                        return response()->json(['success' => false, 'message' =>'There are no policies.'], 400);
                                    }
                                }
                            }
                        }
                        else{
                            return response()->json(['success' => false, 'message' =>'Invalid TPL Sub Type'], 400);
                        }
                       
                    }
                    else{
                        $get_tpl_sub_type = TplSubType::where('tpl_sub_type_id',$input['tpl_sub_type_id'])->first();
                        if(!empty($get_tpl_sub_type))
                        {
                            $tpl_type_id = $input['tpl_type_id'];
                            $tpl_sub_type_id = $input['tpl_sub_type_id'];
                            $get_list = $this->tplListShow($tpl_type_id,$tpl_sub_type_id);
                            if(!empty($get_list))
                            {
                                $policy_type = PolicySubType::where('policy_sub_type_id','c1bc21cfdda9')->pluck('policy_sub_type_id','name');
                                return response()->json(['success' => true, 'message' =>$get_list,'car'=>$car,'policy_type'=>$policy_type], 200);
                            }
                            else
                            {
                                return response()->json(['success' => false, 'message' =>'There are no policies.'], 400);
                            }
                        }
                        else{
                            return response()->json(['success' => false, 'message' =>'Invalid TPL Sub Type'], 400);
                        }
                    }
                }
                catch (\Exception $e){
                    return response()->json(['success' => false, 'message' => 'There are no policies.'], 400);
                }  
            }
            else{
                return response()->json(['success' => false, 'message' =>'This is not a registered car'], 400);
            }
        }
        else{
            return response()->json(['success' => false, 'message' =>'Invalid TPL type'], 400);
        }
        
    }

    public function tplListShow($tpl_type_id,$tpl_sub_type_id)
    {
        $get_tpl_list = TplEntry::where('tpl_type_id',$tpl_type_id)
                                        ->where('tpl_sub_type_id',$tpl_sub_type_id)
                                        ->join('insurer','tpl_entry.insurer_id','=','insurer.insurer_id')
                                        ->join('insurer_policy','tpl_entry.insurer_policy_id','=','insurer_policy.insurer_policy_id')
                                        ->whereIN('tpl_entry.status',['1',1])->get();
                                        
        $offer=[];
        foreach($get_tpl_list as $deatils)
        {
            $company_offers = Offers::where('insurer_policy_id',$deatils->insurer_policy_id)
                            ->select('offer_name','offers_id','amount_of','percentage_of','extra_amount')
                            ->get();
            
            $get_terms_condition = TermsCondition::where('insurer_policy_id',$deatils->insurer_policy_id)->first();
            $terms_condition_path = '/storage/uploads/terms_condition/';
            $terms_condition_url = !empty($get_terms_condition)?URL::asset($terms_condition_path.$get_terms_condition['policy_file']):null;

            $logo_path = '/storage/uploads/insurer_logo/';
            $logo = !empty($deatils['logo'])?URL::asset($logo_path.$deatils['logo']):null;

            // $company_name = $company_details['name'];
            $tpl_policy_list[]=[
                'company_name'=>$deatils->name,
                'policy_name'=>$deatils->policy_name,
                'commision_percentage'=>$deatils['commission'],
                'price'=>$deatils->price,
                'offer' => $company_offers,
                'insurer_id'=>$deatils->insurer_id,
                'insurer_policy_id'=>$deatils->insurer_policy_id,
                'policy_details_id'=>$deatils->tpl_entry_id,
                'terms_and_condition'=>$terms_condition_url,
                'logo'=>$logo,
                'coverage'=>empty($deatils->comparision_values)?null:$deatils->comparision_values
            ];
        }
        return $tpl_policy_list;
    }
}
