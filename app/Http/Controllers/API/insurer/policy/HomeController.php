<?php

namespace App\Http\Controllers\API\insurer\policy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\HomePolicy;
use App\Models\Insurer;
use App\Models\InsurerPolicy;
use App\Models\Offers;
use App\Models\HomePolicyType;
use App\Models\HomeSubType;
use App\Models\PolicySubType;
use App\Models\TermsCondition;
use Illuminate\Support\Facades\Auth;
use URL;
use App\Helpers\LeadHelper as LeadHelper;

class HomeController extends Controller
{
    /**
     * Show Home list API
     * @return \Illuminate\Http\Response
     * 
     * @OA\Post(
     *      path="/api/policy/showHomeList",
     *      operationId="showHomeList",
     *      tags={"Policy"},
     *      summary=" showHomeList",
     *      @OA\RequestBody(
     *            @OA\MediaType(
     *                 mediaType="application/json",
     *                       @OA\Schema(
     *                         @OA\Property(
     *                           property="property_type",
     *                             type="string"
     *                            ),
     *                          @OA\Property(
     *                           property="building_value",
     *                             type="string"
     *                            ),
     *                         @OA\Property(
     *                           property="equipmennt_price",
     *                             type="string"
     *                            ),
     *                          @OA\Property(
     *                           property="home_sub_type_id",
     *                             type="string"
     *                            ),
     *                                  )
     *                            ),
     *                         ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *         security={
     *          {"bearerAuth": {}}
     *           },
     * )
     * 
     */
    public function showHomeList(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'property_type' => 'required|string|max:255',
            'home_sub_type_id'=>'required',
            'building_value'=>'required',
            'equipmennt_price'=>'required'
        ]);
        if($validator->fails()){
            return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
        }
        //get property_type 
        $get_property_type = HomeSubType::where('price_type_id',$input['property_type'])->first();
        //get property name 
        if(!empty($get_property_type))
        {
            $get_property_name = $get_property_type['name'];
        }
        else{
            return response()->json(['success' => false, 'message' =>'Invalid Proprety Type'], 400);
        }

        $offer=[];
        $show_home_list = [];

        if($input['property_type'] =='5ece4797eaf5e')
        {
            $get_all_home_list = HomePolicy::where('home_sub_type_id',$input['home_sub_type_id'])
                                                ->join('insurer','home_policy.insurer_id','=','insurer.insurer_id')
                                                ->join('insurer_policy','home_policy.insurer_policy_id','=','insurer_policy.insurer_policy_id')
                                                ->whereIn('home_policy.status',['1',1])->get();
                
            $show_home_list = $this->postShowVilla($get_all_home_list);

            // if(isset($input['equipmennt_price']))
            // {
            //     $get_all_home_list = HomePolicy::where('home_sub_type_id',$input['home_sub_type_id'])
            //                                     ->whereIn('all',['1',1])
            //                                     ->join('insurer','home_policy.insurer_id','=','insurer.insurer_id')
            //                                     ->join('insurer_policy','home_policy.insurer_policy_id','=','insurer_policy.insurer_policy_id')
            //                                     ->whereIn('home_policy.status',['1',1])->get();
                
            //     $show_home_list = $this->postShowVilla($get_all_home_list);
            // }
            // else{
            //     $get_all_home_list = HomePolicy::where('home_sub_type_id',$input['home_sub_type_id'])
            //                                     ->whereIn('home_value',['1',1])
            //                                     ->join('insurer','home_policy.insurer_id','=','insurer.insurer_id')
            //                                     ->join('insurer_policy','home_policy.insurer_policy_id','=','insurer_policy.insurer_policy_id')
            //                                     ->whereIn('home_policy.status',['1',1])->get();

            //     $show_home_list = $this->postShowVilla($get_all_home_list);
            // }
        }
        elseif($input['property_type'] == '5ee7656135459')
        {
            $get_all_home_list = HomePolicy::where('home_sub_type_id',$input['home_sub_type_id'])
                                                ->join('insurer','home_policy.insurer_id','=','insurer.insurer_id')
                                                ->join('insurer_policy','home_policy.insurer_policy_id','=','insurer_policy.insurer_policy_id')
                                                ->whereIn('home_policy.status',['1',1])->get();
                
            $show_home_list = $this->postShowApartment($get_all_home_list);
            // if(isset($input['equipmennt_price']))
            // {
            //     $get_all_home_list = HomePolicy::where('home_sub_type_id',$input['home_sub_type_id'])
            //                                     ->whereIn('all',['1',1])
            //                                     ->join('insurer','home_policy.insurer_id','=','insurer.insurer_id')
            //                                     ->join('insurer_policy','home_policy.insurer_policy_id','=','insurer_policy.insurer_policy_id')
            //                                     ->whereIn('home_policy.status',['1',1])->get();
                
            //     $show_home_list = $this->postShowApartment($get_all_home_list);
            // }
            // else{
            //     $get_all_home_list = HomePolicy::where('home_sub_type_id',$input['home_sub_type_id'])
            //                                     ->whereIn('home_value',['1',1])
            //                                     ->join('insurer','home_policy.insurer_id','=','insurer.insurer_id')
            //                                     ->join('insurer_policy','home_policy.insurer_policy_id','=','insurer_policy.insurer_policy_id')
            //                                     ->whereIn('home_policy.status',['1',1])->get();

            //     $show_home_list = $this->postShowApartment($get_all_home_list);
            // }
        }

        //create lead 
        $lead = new LeadHelper;
        $find_lead = $lead->_findLead(Auth::user()->user_id);
        if(empty($find_lead))
        {
            $lead_create=$lead->_leadCreate(Auth::user()->user_id);
        }
        $get_policy_type = PolicySubType::where('policy_sub_type_id','74273e1bc257')->pluck('policy_sub_type_id','name');

        if(!empty($show_home_list))
        {
            
            return response()->json(['success' => true, 'message' =>$show_home_list,'policy_type'=>$get_policy_type], 200);
        }
        else{
            return response()->json(['success' => false, 'message' =>'There are no home policies.'], 400);
        }
    }

    /**
     * Show Home Sub Type  list API
     * @return \Illuminate\Http\Response
     * 
     * @OA\Get(
     *      path="/api/policy/getHomeSubType/{language_type}",
     *      operationId="Home",
     *      tags={"Policy"},
     *      summary=" showHomeList",
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
     *         security={
     *          {"bearerAuth": {}}
     *           },
     * )
     * 
     */

     public function showHomeSubType(Request $request,$language_type)
     {
         if(empty($language_type))
         {
            return response()->json(['success' => false, 'message' =>'Language Type is required'], 400);
         }
         if($language_type == 'en')
         {
            $home_sub_type = HomeSubType::pluck('price_type_id as home_sub_type_id','name');
            $policy_type = HomePolicyType::pluck('name','home_sub_type_id as policy_type_id');
            if($home_sub_type->isNotEmpty())
            {
               return response()->json(['success' => true, 'message' =>$home_sub_type,'policy_type'=>$policy_type], 200);
            }
            else{
               return response()->json(['success' => false, 'message' =>'Their has no Home sub type list'], 400);
           }
         }
         elseif($language_type == 'al')
         {
            $home_sub_type = HomeSubType::pluck('price_type_id as home_sub_type_id','albanian_name');
            $policy_type = HomePolicyType::pluck('name','home_sub_type_id as policy_type_id');
            if($home_sub_type->isNotEmpty())
            {
               return response()->json(['success' => true, 'message' =>$home_sub_type,'policy_type'=>$policy_type], 200);
            }
            else{
               return response()->json(['success' => false, 'message' =>'Their has no Home sub type list'], 400);
           }
         }
         elseif($language_type == 'sq')
         {
            $home_sub_type = HomeSubType::pluck('price_type_id as home_sub_type_id','albanian_name');
            $policy_type = HomePolicyType::pluck('name','home_sub_type_id as policy_type_id');
            if($home_sub_type->isNotEmpty())
            {
               return response()->json(['success' => true, 'message' =>$home_sub_type,'policy_type'=>$policy_type], 200);
            }
            else{
               return response()->json(['success' => false, 'message' =>'Their has no Home sub type list'], 400);
           }
         }
         else{
            return response()->json(['success' => false, 'message' =>'language type will be en or sq'], 400);
         }
        
     }

     public function postShowVilla($get_all_home_list)
     {
        $offer=[];
        $show_home_list = [];
    
        foreach($get_all_home_list as $get_all_details)
        {
            // $policy_details = InsurerPolicy::where('insurer_policy_id',$get_all_details->insurer_policy_id)->first();
            $policy_name = $get_all_details['policy_name'];
            $show_offer = Offers::where('insurer_policy_id',$get_all_details->insurer_policy_id)
                                ->select('offer_name','offers_id','amount_of','percentage_of','extra_amount')
                                ->get();
            
            // $company_details = Insurer::where('insurer_id',$get_all_details->insurer_id)->first();

            $get_terms_condition = TermsCondition::where('insurer_policy_id',$get_all_details->insurer_policy_id)->first();
            $terms_condition_path = '/storage/uploads/terms_condition/';
            $terms_condition_url = !empty($get_terms_condition)?URL::asset($terms_condition_path.$get_terms_condition['policy_file']):null;
    
            $logo_path = '/storage/uploads/insurer_logo/';
            $logo = !empty($get_all_details['logo'])?URL::asset($logo_path.$get_all_details['logo']):null;

            $company_name = $get_all_details['name'];
            $show_home_list[]=[
                'company_name'=>$company_name,
                'policy_name' => $policy_name,
                'commision_percentage'=>$get_all_details['commission'],
                'percentage'=>$get_all_details['price_of_villa'],
                'home_type'=>"Villa",
                'type'=>!empty($get_all_details['all'])?"all":"home_value",
                'offer' => $show_offer,
                'insurer_id'=>$get_all_details->insurer_id,
                'insurer_policy_id'=>$get_all_details->insurer_policy_id,
                'policy_details_id'=>$get_all_details->home_policy_id,
                'terms_and_condition'=>$terms_condition_url,
                'logo'=>$logo,
                'coverage'=>empty($get_all_details->comparision_values)?null:$get_all_details->comparision_values
            ];
        }
        return $show_home_list;
     }

     public function postShowApartment($get_all_home_list)
     {
        $offer=[];
        $show_home_list = [];
       
        foreach($get_all_home_list as $get_all_details)
        {
            // $policy_details = InsurerPolicy::where('insurer_policy_id',$get_all_details->insurer_policy_id)->first();
            $policy_name = $get_all_details['policy_name'];
            $show_offer = Offers::where('insurer_policy_id',$get_all_details->insurer_policy_id)
                                ->select('offer_name','offers_id','amount_of','percentage_of','extra_amount')
                                ->get();
            
            // $company_details = Insurer::where('insurer_id',$get_all_details->insurer_id)->first();

            $get_terms_condition = TermsCondition::where('insurer_policy_id',$get_all_details->insurer_policy_id)->first();
            $terms_condition_path = '/storage/uploads/terms_condition/';
            $terms_condition_url = !empty($get_terms_condition)?URL::asset($terms_condition_path.$get_terms_condition['policy_file']):null;
    
            $logo_path = '/storage/uploads/insurer_logo/';
            $logo = !empty($get_all_details['logo'])?URL::asset($logo_path.$get_all_details['logo']):null;

            $company_name = $get_all_details['name'];
            $show_home_list[]=[
                'company_name'=>$company_name,
                'policy_name' => $policy_name,
                'commision_percentage'=>$get_all_details['commission'],
                'percentage'=>$get_all_details['price_of_aparment'],
                'home_type'=>"Aparment",
                'type'=>!empty($get_all_details['all'])?"all":"home_value",
                'offer' => $show_offer,
                'insurer_id'=>$get_all_details->insurer_id,
                'insurer_policy_id'=>$get_all_details->insurer_policy_id,
                'policy_details_id'=>$get_all_details->home_policy_id,
                'terms_and_condition'=>$terms_condition_url,
                'logo'=>$logo,
                'coverage'=>empty($get_all_details->comparision_values)?null:$get_all_details->comparision_values
            ];
        }
        return $show_home_list;
     }
}
