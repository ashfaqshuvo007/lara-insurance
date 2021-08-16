<?php

namespace App\Http\Controllers\API\insurer\policy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\GreenCard;
use App\Models\GreenCardType;
use App\Models\Insurer;
use App\Models\InsurerPolicy;
use App\Models\Offers;
use App\Models\GreenCardSubType;
use App\Models\GreenCardDays;
use App\Models\Car;
use App\Models\PolicySubType;
use Illuminate\Support\Facades\Auth;
use App\Models\TermsCondition;
use URL;
use App\Helpers\CarHelpers;
use App\Helpers\LeadHelper as LeadHelper;

class GreenCardController extends Controller
{
    /**
     * Show Green Card list API
     * @return \Illuminate\Http\Response
     * 
     * @OA\Post(
     *      path="/api/policy/green-card",
     *      operationId="ShowGreenCardList",
     *      tags={"Green Card"},
     *      summary="shiwGreenCardList",
     *      @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="application/json",
     *                      @OA\Schema(
     *                        @OA\Property(
     *                          property="select_car",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="other_car",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="green_card_type",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="green_card_sub_type",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="for_how_many_days",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="car_registration_number",
     *                            type="string"
     *                           ),
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

     public function getListofGreenCard(Request $request)
     {
        $input = $request->all();
        //get policy name with id 
        $get_policy =  PolicySubType::where('policy_sub_type_id','dfd3e39b733a')->first();
        //send policy type
        $policy_type = [
            'green_card' =>$get_policy['policy_sub_type_id']
        ];
        if($input['other_car'] == 1)
        {
            $validator = Validator::make($input, [
                'car_registration_number' => ['required','string','max:255'],
                'green_card_type'=>'required|string|max:255',
                'green_card_sub_type'=>'required|string|max:255',
                'for_how_many_days'=>'required|string|max:255'
            ]);
            if($validator->fails()){
                return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
            }
            // $create_car = Car::create([
            //     'car_id'=>uniqid(),
            //     'user_id'=>Auth::user()->user_id,
            //     'car_registration_number'=> $input['car_registration_number'],
            //     'car_tpye'=>$input['green_card_sub_type']
            // ]);
            //create lead 
            $lead = new LeadHelper;
            $find_lead = $lead->_findLead(Auth::user()->user_id);
            if(empty($find_lead))
            {
                $lead_create=$lead->_leadCreate(Auth::user()->user_id);
            }
            $check_car = CarHelpers::checkCarExistance(Auth::user()->user_id,$input['car_registration_number']);
            if(!empty($check_car)){
                return response()->json(['success' => false, 'message' => 'registration number already taken!!'],400);
            }
            //car registration no
            $car = [
                'car_registration_number' => $input['car_registration_number'],
                'car_type'=>$input['green_card_sub_type']
            ];
            //get green card type 
            $get_green_card_type = GreenCardType::where('green_card_type_id',$input['green_card_type'])->first();
            //get green card type name 
            if(!empty($get_green_card_type))
            {
                $get_green_card_type_name = $get_green_card_type['name'];
            }
            //get green card sub type
            $get_green_card_sub_types = GreenCardSubType::where('green_card_type_id',$input['green_card_type'])
                                                        ->where('green_card_sub_type_id',$input['green_card_sub_type'])
                                                        ->first();
            //get green card sub type name 
            $green_card_sub_type = [$get_green_card_sub_types['name']];
            //green card data show
            $show_data = $this->greenCradDataShow($input['green_card_type'],$input['for_how_many_days'],$green_card_sub_type,$get_green_card_type_name);
            //condition for showing green card data
            if(!empty($show_data))
            {
                return response()->json(['success' => true, 'message' =>$show_data,'car'=>$car,'policy_type'=>$policy_type,'validity'=>$input['for_how_many_days']], 200);
            }
            else{
                return response()->json(['success' => false, 'message' =>'There are no green card policies.'], 400);
            }
        }
        else{
            $validator = Validator::make($input, [
                'select_car' => ['required','string','max:255'],
                'green_card_type'=>'required|string|max:255',
                'for_how_many_days'=>'required|string|max:255'
            ]);
            if($validator->fails()){
                return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
            }
            //get the user car 
            $get_user_car = Car::where('car_registration_number',$input['select_car'])->where('user_id',Auth::user()->user_id)->first();
            //check the car is exist or not 
            if(isset($get_user_car))
            {
                //car registration no 
                $car =[
                    'car_registration_number'=>$input['select_car']
                ];
                //check the condition if it is car
                if($get_user_car['car_tpye'] == '5387b8bf5632'){
                    //get green card details
                    $get_green_card_type = GreenCardType::where('green_card_type_id',$input['green_card_type'])->first();
                    if(!empty($get_green_card_type))
                    {
                        $get_green_card_type_name = $get_green_card_type['name'];
                    }
                    //check condition for all countries
                    if($get_green_card_type['name'] == 'Green card for all countries')
                    {
                        $green_card_sub_type = ['Cars'];
                        $show_data = $this->greenCradDataShow($input['green_card_type'],$input['for_how_many_days'],$green_card_sub_type,$get_green_card_type_name);
                        if(!empty($show_data))
                        {
                            return response()->json(['success' => true, 'message' =>$show_data,'car'=>$car,'policy_type'=>$policy_type,'validity'=>$input['for_how_many_days']], 200);
                        }
                        else{
                            return response()->json(['success' => false, 'message' =>'There are no green  card policies.'], 400);
                        }
                    }
                    //check condition for montenengro
                    elseif($get_green_card_type['name'] == 'Green card for Montenegro'){

                        $green_card_sub_type = ['Cars Up to 8 seats & 3.4 tons'];
                        $show_data = $this->greenCradDataShow($input['green_card_type'],$input['for_how_many_days'],$green_card_sub_type,$get_green_card_type_name);
                        if(!empty($show_data))
                        {
                            return response()->json(['success' => true, 'message' =>$show_data,'car'=>$car,'policy_type'=>$policy_type,'validity'=>$input['for_how_many_days']], 200);
                        }
                        else{
                            return response()->json(['success' => false, 'message' =>'There are no green card policies.'], 400);
                        }
                    }
                    else{
                        return response()->json(['success' => false, 'message' =>'Invalid Car Type'], 400);
                    }
                }
                //check if it is bike 
                elseif($get_user_car['car_tpye'] =='d931b542bcad')
                {
                    
                    $get_green_card_type = GreenCardType::where('green_card_type_id',$input['green_card_type'])->first();
                    $get_green_card_type_name = $get_green_card_type['name'];
                    //check for all countries
                    if($get_green_card_type['name'] == 'Green card for all countries')
                    {
                        $green_card_sub_type = ['Bikes up to 150cc','Bikes more than 150cc'];
                        $show_data = $this->greenCradDataShow($input['green_card_type'],$input['for_how_many_days'],$green_card_sub_type,$get_green_card_type_name);
                        if(!empty($show_data))
                        {
                            return response()->json(['success' => true, 'message' =>$show_data,'car'=>$car,'policy_type'=>$policy_type,'validity'=>$input['for_how_many_days']], 200);
                        }
                        else{
                            return response()->json(['success' => false, 'message' =>'There are no green  card policies.'], 400);
                        }
                    }
                    //check for montenegro
                    elseif($get_green_card_type['name'] == 'Green card for Montenegro'){

                        $green_card_sub_type = ['Bikes up to 150cc','Bikes more than 150cc'];
                        $show_data = $this->greenCradDataShow($input['green_card_type'],$input['for_how_many_days'],$green_card_sub_type,$get_green_card_type_name);
                        if(!empty($show_data))
                        {
                            return response()->json(['success' => true, 'message' =>$show_data,'car'=>$car,'policy_type'=>$policy_type,'validity'=>$input['for_how_many_days']], 200);
                        }
                        else{
                            return response()->json(['success' => false, 'message' =>'There are no green card policies.'], 400);
                        }
                    }
                    else{
                        return response()->json(['success' => false, 'message' =>'Invalid Car Type'], 400);
                    }
                }
                //check it is a van or microbus & if sub type is 5-9 steats
                elseif(($get_user_car['car_tpye'] =='0c0361f6647e') && $get_user_car['car_sub_type']=='60afb64195d6')
                {
                    $get_green_card_type = GreenCardType::where('green_card_type_id',$input['green_card_type'])->first();
                    $get_green_card_type_name = $get_green_card_type['name'];
                    if($get_green_card_type['name'] == 'Green card for all countries')
                    {
                        $green_card_sub_type = ['Bus 9+1 to 18+1'];
                        $show_data = $this->greenCradDataShow($input['green_card_type'],$input['for_how_many_days'],$green_card_sub_type,$get_green_card_type_name);
                        if(!empty($show_data))
                        {
                            return response()->json(['success' => true, 'message' =>$show_data,'car'=>$car,'policy_type'=>$policy_type,'validity'=>$input['for_how_many_days']], 200);
                        }
                        else{
                            return response()->json(['success' => false, 'message' =>'There are no green card policies.'], 400);
                        }
                    }
                    elseif($get_green_card_type['name'] == 'Green card for Montenegro'){
                        $green_card_sub_type = ['Bus 19+1 to 28+1'];
                        $show_data = $this->greenCradDataShow($input['green_card_type'],$input['for_how_many_days'],$green_card_sub_type,$get_green_card_type_name);
                        if(!empty($show_data))
                        {
                            return response()->json(['success' => true, 'message' =>$show_data,'car'=>$car,'policy_type'=>$policy_type,'validity'=>$input['for_how_many_days']], 200);
                        }
                        else{
                            return response()->json(['success' => false, 'message' =>'There are no green card policies.'], 400);
                        }
                    }
                }
                //check if it is other type
                else{
                    $validator = Validator::make($input, [
                        'green_card_sub_type' => 'required|string|max:255'
                    ]);
                    if($validator->fails()){
                        return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
                    }
                    try {
                        $get_green_card_type = GreenCardType::where('green_card_type_id',$input['green_card_type'])->first();
                        $get_green_card_type_name = $get_green_card_type['name'];
                        $get_green_card_sub_types = GreenCardSubType::where('green_card_type_id',$input['green_card_type'])
                                                                        ->where('green_card_sub_type_id',$input['green_card_sub_type'])
                                                                        ->first();
                        $green_card_sub_type = [$get_green_card_sub_types['name']];
                      }
                      //catch exception
                      catch(\Exception $e) {
                        return response()->json(['success' => false, 'message' =>$e->getMessage()], 400);
                      }
                   
                    $show_data = $this->greenCradDataShow($input['green_card_type'],$input['for_how_many_days'],$green_card_sub_type,$get_green_card_type_name);
                    if(!empty($show_data))
                    {
                        return response()->json(['success' => true, 'message' =>$show_data,'car'=>$car,'policy_type'=>$policy_type,'validity'=>$input['for_how_many_days']], 200);
                    }
                    else{
                        return response()->json(['success' => false, 'message' =>'There are no green card policies.'], 400);
                    }
                }
            }
            else{
                return response()->json(['success' => false, 'message' =>'This is not a registered car.'], 400);
            }
        }
        
     }
     
     public function greenCradDataShow($green_card_type,$for_how_many_days,$green_card_sub_type,$get_green_card_type_name)
     {
        $get_days = GreenCardDays::where('green_card_type_id',$green_card_type)
                                    ->where('days',$for_how_many_days)
                                    ->orWhere('albanian_days',$for_how_many_days)
                                    ->first();
        if($get_days)
        {
            $get_days_data = $get_days['day_price'];
            $store_data = GreenCard::where('green_card_type',$get_green_card_type_name)
                                    ->whereIN('name',$green_card_sub_type)
                                    ->whereIN('status',[1,'1'])
                                    ->whereNotNull($get_days_data)
                                    ->select('green_card_id','insurer_policy_id',$get_days_data,'insurer_id')
                                    ->get();
            $data = $this->showGreencard($store_data,$get_days_data);
            return $data;
        }
     }
     public function showGreencard($store_data,$days)
     {
        $show_green_card_list = [];
        $offer=[];
        foreach($store_data as $details)
        {
            $policy_details = InsurerPolicy::where('insurer_policy_id',$details->insurer_policy_id)->first();
            $policy_name = $policy_details['policy_name'];
            $show_offer = Offers::where('insurer_policy_id',$details->insurer_policy_id)
                                    ->select('offer_name','offers_id','amount_of','percentage_of','extra_amount')
                                    ->get();
           
            
            $amount = $details[$days];
            $company_details = Insurer::where('insurer_id',$details->insurer_id)->first();
            $company_name = $company_details['name'];
           
            $get_terms_condition = TermsCondition::where('insurer_policy_id',$details->insurer_policy_id)->first();
            $terms_condition_path = '/storage/uploads/terms_condition/';
            $terms_condition_url = !empty($get_terms_condition)?URL::asset($terms_condition_path.$get_terms_condition['policy_file']):null;
  
            $logo_path = '/storage/uploads/insurer_logo/';
            $logo = !empty($company_details['logo'])?URL::asset($logo_path.$company_details['logo']):null;

            $show_green_card_list[]=[
                'company_name'=>$company_name,
                'policy_name' => $policy_name,
                'commision_percentage'=>$policy_details['commission'],
                'price'=>$amount,
                'offer'=>$show_offer,
                'insurer_id'=>$details->insurer_id,
                'insurer_policy_id'=>$details->insurer_policy_id,
                'policy_details_id'=>$details->green_card_id,
                'insurer_policy_id'=>$details->insurer_policy_id,
                'terms_and_condition'=>$terms_condition_url,
                'logo'=>$logo,
                'coverage'=>empty($policy_details['comparision_values'])?null:$policy_details['comparision_values']
            ];
        }
        return $show_green_card_list;
     }
     /**
     * Green Card type list API
     * @return \Illuminate\Http\Response
     * @OA\Get(
     *      path="/api/policy/green-card-type/{language_type}",
     *      operationId="greenCardType",
     *      tags={"Green Card"},
     *      summary="Green Card type list",
     *     @OA\Parameter(
     *          name="language_type",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      description="Green Card Type List",
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
     * Returns profile information message
     */

     public function getListofGreenCardType(Request $request,$language_type){
        if($language_type == 'en')
        {
            $greencard_type = GreenCardType::select('green_card_type.eng_name as name','green_card_type_id')->get();
            if(isset($greencard_type)) {
                return response()->json(['success' => true, 'green_card_type_list' => $greencard_type], 200);
            } 
            else{
                return response()->json(['success' => false, 'message' => 'not found'],400);
            }
        }
        elseif($language_type == 'al')
        {
            $greencard_type = GreenCardType::select('green_card_type.albanian_name as name','green_card_type_id')->get();
            if(isset($greencard_type)) {
                return response()->json(['success' => true, 'green_card_type_list' => $greencard_type], 200);
            } 
            else{
                return response()->json(['success' => false, 'message' => 'not found'],400);
            }
        }
        elseif($language_type == 'sq')
        {
            $greencard_type = GreenCardType::select('green_card_type.albanian_name as name','green_card_type_id')->get();
            if(isset($greencard_type)) {
                return response()->json(['success' => true, 'green_card_type_list' => $greencard_type], 200);
            } 
            else{
                return response()->json(['success' => false, 'message' => 'not found'],400);
            }
        }
        else{
            return response()->json(['success' => false, 'message' => 'Language Type is not correct'],400);
        }
         
     }
    /**
     * Green Card Subtype list API
     * @return \Illuminate\Http\Response
     * @OA\Post(
     *      path="/api/policy/green-card-sub-type",
     *      operationId="greenSubCardType",
     *      tags={"Green Card"},
     *      summary="Green Card Sub type list",
     *     @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="application/json",
     *                      @OA\Schema(
     *                        @OA\Property(
     *                          property="green_card_type_id",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="language_type",
     *                            type="string"
     *                           ),
     *                                 )
     *                           ),
     *                        ),
     *      description="Green Card Sub Type List",
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
     * Returns profile information message
     */
    public function getGreenCardSubType(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'green_card_type_id' => 'required|string|max:255',
            'language_type'=>'required|string|max:255'
        ]);
        if($validator->fails()){
            return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
        }
        if($input['language_type'] =='en')
        {
            $get_sub_type_deatails = GreenCardSubType::where('green_card_type_id',$input['green_card_type_id'])
                                                    ->select('green_card_type_id','green_card_sub_type_id','name')
                                                    ->get();
            if(isset($get_sub_type_deatails)) {
                $green_card_days= GreenCardDays::where('green_card_type_id',$input['green_card_type_id'])
                                                ->select('days','day_price')
                                                ->get();
                if(isset($green_card_days))
                {
                    return response()->json(['success' => true, 
                                            'get_sub_type_deatails'=>$get_sub_type_deatails,
                                            'green_card_days' => $green_card_days], 200);
                }
                else{
                    return response()->json(['success' => false, 'message' => 'not found'],400);
                }
                
                } 
            else{
                return response()->json(['success' => false, 'message' => 'not found'],400);
            }
        }
        elseif($input['language_type'] == 'al' || $input['language_type'] == 'sq')
        {
            $get_sub_type_deatails = GreenCardSubType::where('green_card_type_id',$input['green_card_type_id'])
                                                    ->select('green_card_type_id','green_card_sub_type_id','green_card_sub_type.albanian_name as name')
                                                    ->get();
            if(isset($get_sub_type_deatails)) {
                $green_card_days= GreenCardDays::where('green_card_type_id',$input['green_card_type_id'])
                                                ->select('green_card_days.albanian_days as days','day_price')
                                                ->get();
                if(isset($green_card_days))
                {
                    return response()->json(['success' => true, 
                                            'get_sub_type_deatails'=>$get_sub_type_deatails,
                                            'green_card_days' => $green_card_days], 200);
                }
                else{
                    return response()->json(['success' => false, 'message' => 'not found'],400);
                }
                
                } 
            else{
                return response()->json(['success' => false, 'message' => 'not found'],400);
            }
        }
        else{
            return response()->json(['success' => false, 'message' => 'Language Type is not correct'],400);
        }
        
    }

}
