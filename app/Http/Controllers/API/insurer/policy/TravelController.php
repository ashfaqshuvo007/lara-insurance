<?php

namespace App\Http\Controllers\API\insurer\policy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Validator;
use Illuminate\Support\Facades\Validator;
use App\Models\Travel;
use App\Models\Insurer;
use App\Models\InsurerPolicy;
use App\Models\Offers;
use App\Models\PolicySubType;
use App\Models\zone;
use App\Models\TravelZone;
use App\Rules\DateFormat;
use App\Models\TermsCondition;
use URL;
use Illuminate\Support\Facades\Auth;
use App\Models\Lead;
use App\Helpers\LeadHelper as LeadHelper;

class TravelController extends Controller
{

    /**
     * Show Home list API
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/policy/showTravelSubid/{language_type}",
     *      operationId="showTravelSubid",
     *      tags={"Travel"},
     *      summary=" showTravelSubid",
     *     @OA\Parameter(
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
    public function showTravelsubId(Request $request,$language_type)
    {
      if($language_type == 'en')
      {
        $show_policy_travel_sub_type = PolicySubType::where('policy_type_id','807ce7e758dc')->select('policy_sub_type.eng_name as name','policy_sub_type_id')->get();
        if($show_policy_travel_sub_type)
        {
            return response()->json(['success' => true,'message'=>$show_policy_travel_sub_type],200);
        }
        else{
            return response()->json(['success' => false, 'message' => 'Invalid Travel Type'],400);
        }
      }
      elseif($language_type == 'al' ||  $language_type == 'sq')
      {
        $show_policy_travel_sub_type = PolicySubType::where('policy_type_id','807ce7e758dc')->select('policy_sub_type.albanian_name as name','policy_sub_type_id')->get();
        if($show_policy_travel_sub_type)
        {
            return response()->json(['success' => true,'message'=>$show_policy_travel_sub_type],200);
        }
        else{
            return response()->json(['success' => false, 'message' => 'Invalid Travel Type'],400);
        }
      }
      elseif($language_type == 'sq')
      {
        $show_policy_travel_sub_type = PolicySubType::where('policy_type_id','807ce7e758dc')->select('policy_sub_type.albanian_name as name','policy_sub_type_id')->get();
        if($show_policy_travel_sub_type)
        {
            return response()->json(['success' => true,'message'=>$show_policy_travel_sub_type],200);
        }
        else{
            return response()->json(['success' => false, 'message' => 'Invalid Travel Type'],400);
        }
      }
      else{
        return response()->json(['success' => false, 'message' => 'Invalid Language Type'],400);
      }
      
    }

    /**
     * Show travel list API
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *      path="/api/policy/showTravelZone",
     *      operationId="showTravelZone",
     *      tags={"Travel"},
     *      summary=" showTravelZone",
     *      @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="application/json",
     *                      @OA\Schema(
     *                        @OA\Property(
     *                          property="country_type_id",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="language_type",
     *                            type="string"
     *                           ),
     *
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
    public function showTravelZone(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'country_type_id' => 'required',
            'language_type'=>'required'
        ]);

        if($validator->fails()){
          return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
        }
        if($input['language_type'] == 'en')
        {
          //get travel zone 
          $get_travel_zone = TravelZone::where('country_type_id',$input['country_type_id'])->pluck('zones_name','zones_id');
          //check data is empty or not
          if(!empty($get_travel_zone))
          {
            return response()->json(['success' => true, 'message' =>$get_travel_zone], 200);
          }
          else{
            return response()->json(['success' => false, 'message' =>'Invalid data'], 400);
          }
        }
        elseif($input['language_type'] == 'al' || $input['language_type'] == 'sq')
        {
          //get travel zone 
          $get_travel_zone = TravelZone::where('country_type_id',$input['country_type_id'])->pluck('travel_zone.albanian_zones_name as zones_name','zones_id');
          //check data is empty or not
          if(!empty($get_travel_zone))
          {
            return response()->json(['success' => true, 'message' =>$get_travel_zone], 200);
          }
          else{
            return response()->json(['success' => false, 'message' =>'Invalid data'], 400);
          }
        }
        else{
          return response()->json(['success' => false, 'message' =>'Invalid Language Type'], 400);
        }
        
    }


    /**
     * Show travel list API
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *      path="/api/policy/showTravelList",
     *      operationId="ShowTravelList",
     *      tags={"Travel"},
     *      summary=" ShowTravelList",
     *      @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="application/json",
     *                      @OA\Schema(
     *                        @OA\Property(
     *                          property="choose_contury_type",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="for_age",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="for_zone",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="for_validity",
     *                            type="string"
     *                           ),
     *                        @OA\Property(
     *                          property="start_date",
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
    public function showTravelHistory(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'choose_contury_type' => 'required|string|max:255',
            'for_age' => 'required|string|max:255',
            'for_zone' => 'required|string|max:255',
            'for_validity' => 'required|string|max:255',
            'start_date'=>['required',new DateFormat]
        ]);

        if($validator->fails()){
            return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
        }
        $get_start_days = date('Y-m-d',strtotime($input['start_date']));
        $validity_of_journey = "+".$input['for_validity']."days";
        $get_end_date = date('Y-m-d', strtotime($validity_of_journey, strtotime($input['start_date'])) );
        // return $get_end_date;
        $days =[
          'get_start_days'=>$get_start_days,
          'get_end_date'=>$get_end_date
        ];
        if($input['choose_contury_type'] == '0ac2b7cfc696')
        {
          $get_policy_sub_type = PolicySubType::where('policy_sub_type_id','0ac2b7cfc696')->first();
          if(!empty($get_policy_sub_type))
          {
            $policy_type =[
              'travel_out_side_country'=>$get_policy_sub_type['policy_sub_type_id']
            ];
          }
          $get_age = (int)$input['for_age'];
          $get_validity_days =(int)$input['for_validity'];
          //zone check 
          $zone_details = TravelZone::where('zones_id',$input['for_zone'])->first();
          // return $zone_details;
          //check zone exist
          if(!empty($zone_details))
          {
            $get_zone_name = $zone_details['zones_name'];
          }
          else{
            return response()->json(['success' => false, 'message' =>'There has no matching correct zone'], 400);
          }
          //create lead 
          $lead = new LeadHelper;
          $find_lead = $lead->_findLead(Auth::user()->user_id);
          if(empty($find_lead))
          {
              $lead_create=$lead->_leadCreate(Auth::user()->user_id);
          }
          if(in_array($get_age,range(0,69)))
          {
            // return $get_age;
            $age_limit = "0-69";
            $show_data = $this->checkDaysFortravelOutsideCountry($get_validity_days,$get_zone_name,$age_limit,$input['choose_contury_type']);
            if(!empty($show_data))
            {
                return response()->json(['success' => true, 'message' =>$show_data,'policy_type'=>$policy_type,'validity_days'=>$get_validity_days,'days'=>$days], 200);
            }
            else{
                return response()->json(['success' => false, 'message' =>'There are no policies'], 400);
            }
          }
          elseif(in_array($get_age,range(70,79)))
          {
            if($input['for_zone'] == '5ee87d041a88f')
            {
              $zone_name = 'Zone C europe';
            }
            else{
              return response()->json(['success' => false, 'message' =>'UpTo 70 select only Zone c'], 400);
            }
            $age_limit = "70-79";
            $show_data = $this->checkDaysFortravelOutsideCountry($get_validity_days,$zone_name,$age_limit,$input['choose_contury_type']);
            if(!empty($show_data))
            {
                return response()->json(['success' => true, 'message' =>$show_data,'policy_type'=>$policy_type,'validity_days'=>$get_validity_days,'days'=>$days], 200);
            }
            else{
                return response()->json(['success' => false, 'message' =>'There are no policies'], 400);
            }
          }
          else{
            return response()->json(['success' => false, 'message' =>'Give Your DOB properly'], 400);
          }
        }
        elseif($input['choose_contury_type'] == '69e21f9783bd')
        {
            $get_policy_sub_type = PolicySubType::where('policy_sub_type_id','69e21f9783bd')->first();
            if(!empty($get_policy_sub_type))
            {
              $policy_type =[
                'student_out_side_country'=>$get_policy_sub_type['policy_sub_type_id']
              ];
            }
            $get_validity_days =(int)$input['for_validity'];
            //zone check 
            $zone_details = TravelZone::where('zones_id',$input['for_zone'])->first();
            //check zone exist
            if(!empty($zone_details))
            {
              $get_zone_name = $zone_details['zones_name'];
              // return [$input['for_zone'],$zone_details];
            }
            else{
              return response()->json(['success' => false, 'message' =>'Please Select Correct Zone'], 400);
            }
            if(in_array($get_validity_days,range(1,90)))
            {
              $set_days = "1-90 days";
              $get_travel_data = Travel::where('travel_sub_type_id',$input['choose_contury_type'])
                                                ->where('zone',$get_zone_name)
                                                ->where('validity',$set_days)
                                                ->whereIN('status',['1',1])
                                                ->get();
              $data_to_show = $this->showTrvelList($get_travel_data);
              if(!empty($data_to_show))
              {
                  return response()->json(['success' => true, 'message' =>$data_to_show,'policy_type'=>$policy_type,'validity_days'=>$get_validity_days,'days'=>$days], 200);
              }
              else{
                  return response()->json(['success' => false, 'message' =>'There are no policies'], 400);
              }
            }
            elseif(in_array($get_validity_days,range(91,180)))
            {
              $set_days = "91-180 days";
              $get_travel_data = Travel::where('travel_sub_type_id',$input['choose_contury_type'])
                                                ->where('zone',$get_zone_name)
                                                ->where('validity',$set_days)
                                                ->whereIN('status',['1',1])
                                                ->get();
              $data_to_show = $this->showTrvelList($get_travel_data);
              if(!empty($data_to_show))
              {
                  return response()->json(['success' => true, 'message' =>$data_to_show,'policy_type'=>$policy_type,'validity_days'=>$get_validity_days,'days'=>$days], 200);
              }
              else{
                  return response()->json(['success' => false, 'message' =>'There are no policies'], 400);
              }

            }
            elseif(in_array($get_validity_days,range(181,365)))
            {
              $set_days = "181-365 days";
              $get_travel_data = Travel::where('travel_sub_type_id',$input['choose_contury_type'])
                                                ->where('zone',$get_zone_name)
                                                ->where('validity',$set_days)
                                                ->whereIN('status',['1',1])
                                                ->get();
              $data_to_show = $this->showTrvelList($get_travel_data);
              if(!empty($data_to_show))
              {
                  return response()->json(['success' => true, 'message' =>$data_to_show,'policy_type'=>$policy_type,'validity_days'=>$get_validity_days,'days'=>$days], 200);
              }
              else{
                  return response()->json(['success' => false, 'message' =>'There are no policies'], 400);
              }
            }
            else{
              return response()->json(['success' => false, 'message' =>'There are no policies'], 400);
            }
        }
        else{
          return response()->json(['success' => false, 'message' =>'Invalid Travel Type'], 400);
        }
    }
    public function checkDaysFortravelOutsideCountry($get_validity_days,$zone,$valid_age,$country_type)
    {
          if(in_array($get_validity_days,range(1,10)))
          {
            if(in_array($get_validity_days,range(1,6)))
            {
              $set_days =["1-6 days","1-9 days"];

              $get_travel_data = $this->chekTravelQuery($country_type,$valid_age,$zone,$set_days);

              $data_to_show = $this->showTrvelList($get_travel_data);
              return $data_to_show;

            }
            elseif(in_array($get_validity_days,range(7,10)))
            {
                $set_days =["1-9 days","7-10 days","10-15 days"];

                $get_travel_data = $this->chekTravelQuery($country_type,$valid_age,$zone,$set_days);
                
                $data_to_show = $this->showTrvelList($get_travel_data);
                return $data_to_show;
            }
          }
          elseif(in_array($get_validity_days,range(11,15)))
          {
              $set_days =["10-15 days","11-15 days"];
              $get_travel_data = $this->chekTravelQuery($country_type,$valid_age,$zone,$set_days);

              $data_to_show = $this->showTrvelList($get_travel_data);
              return $data_to_show;
          }
          elseif(in_array($get_validity_days,range(16,20))){
            $set_days = ["16-20 days"];
            $get_travel_data = $this->chekTravelQuery($country_type,$valid_age,$zone,$set_days);
            
            
            $data_to_show = $this->showTrvelList($get_travel_data);
            return $data_to_show;
          }
          elseif(in_array($get_validity_days,range(21,30))){
            $set_days = ["21-30 days"];
            $get_travel_data = $this->chekTravelQuery($country_type,$valid_age,$zone,$set_days);

            
            $data_to_show = $this->showTrvelList($get_travel_data);
            return $data_to_show;
          }
          elseif(in_array($get_validity_days,range(31,45))){
            $set_days = ["31-45 days"];
            $get_travel_data = $this->chekTravelQuery($country_type,$valid_age,$zone,$set_days);

            
            $data_to_show = $this->showTrvelList($get_travel_data);
            return $data_to_show;
          }
          elseif(in_array($get_validity_days,range(46,60))){
            $set_days = ["46-60 days"];
            $get_travel_data = $this->chekTravelQuery($country_type,$valid_age,$zone,$set_days);

            
            $data_to_show = $this->showTrvelList($get_travel_data);
            return $data_to_show;
          }
          elseif(in_array($get_validity_days,range(61,90))){
            $set_days = ["61-90 days"];
            $get_travel_data = $this->chekTravelQuery($country_type,$valid_age,$zone,$set_days);

            
            $data_to_show = $this->showTrvelList($get_travel_data);
            return $data_to_show;
          }
          elseif(in_array($get_validity_days,range(91,120))){

            $set_days = ["91-120 days"];
            $get_travel_data = $this->chekTravelQuery($country_type,$valid_age,$zone,$set_days);

            $data_to_show = $this->showTrvelList($get_travel_data);
            return $data_to_show;
          }
          elseif(in_array($get_validity_days,range(121,150))){

            $set_days = ["121-150 days"];

            
            $data_to_show = $this->showTrvelList($get_travel_data);
            return $data_to_show;
          }
          elseif(in_array($get_validity_days,range(151,180))){

            $set_days = ["151-180 days"];
            $get_travel_data = $this->chekTravelQuery($country_type,$valid_age,$zone,$set_days);
            
            $data_to_show = $this->showTrvelList($get_travel_data);
            return $data_to_show;
          }
          elseif(in_array($get_validity_days,range(181,365))){

            if(in_array($get_validity_days,range(181,270)))
            {
              $set_days = ["181-270 days","181-365 days"];
              $get_travel_data = $this->chekTravelQuery($country_type,$valid_age,$zone,$set_days);

              
              $data_to_show = $this->showTrvelList($get_travel_data);
              return $data_to_show;
            }
            elseif(in_array($get_validity_days,range(271,365)))
            {
              $set_days = ["181-365 days","271-365 days"];
              $get_travel_data = $this->chekTravelQuery($country_type,$valid_age,$zone,$set_days);
              
              $data_to_show = $this->showTrvelList($get_travel_data);
              return $data_to_show;
            }
          }
          else{
            return response()->json(['success' => false, 'message' =>'Invalid data'], 400);
          }
    }

    //public function for query
    public function chekTravelQuery($country_type,$valid_age,$zone,$set_days)
    {
      $get_show_travel_data = Travel::where('travel_sub_type_id',$country_type)
                                          ->where('age_group',$valid_age)
                                          ->where('zone',$zone)
                                          ->whereIN('validity',$set_days)
                                          ->whereIN('status',['1',1])
                                          ->get();

      //return travel data
      return $get_show_travel_data;
    }

    public function showTrvelList($get_travel_data)
    {
      $show_travle_data=[];
      foreach($get_travel_data as $details)
      {
          $policy_details = InsurerPolicy::where('insurer_policy_id',$details->insurer_policy_id)->first();
          $policy_name = $policy_details['policy_name'];
          $show_offer = Offers::where('insurer_policy_id',$details->insurer_policy_id)
                                ->select('offer_name','offers_id','amount_of','percentage_of','extra_amount')
                                ->get();

          $company_details = Insurer::where('insurer_id',$details->insurer_id)->first();
          $company_name = $company_details['name'];

          $get_terms_condition = TermsCondition::where('insurer_policy_id',$details->insurer_policy_id)->first();
          $terms_condition_path = '/storage/uploads/terms_condition/';
          $terms_condition_url = !empty($get_terms_condition)?URL::asset($terms_condition_path.$get_terms_condition['policy_file']):null;

          $logo_path = '/storage/uploads/insurer_logo/';
          $logo = !empty($company_details['logo'])?URL::asset($logo_path.$company_details['logo']):null;

          $show_travle_data[]=[
              'company_name'=>$company_name,
              'policy_name'=>$policy_name,
              'commision_percentage'=>$policy_details['commission'],
              'price'=>$details->price,
              'offer'=>$show_offer,
              'insurer_id'=>$details->insurer_id,
              'insurer_policy_id'=>$details->insurer_policy_id,
              'policy_details_id'=>$details->travel_id,
              'terms_and_condition'=>$terms_condition_url,
              'logo'=>$logo,
              'coverage'=>empty($policy_details['comparision_values'])?null:$policy_details['comparision_values']
          ];
      }
      return $show_travle_data;
    }
}

