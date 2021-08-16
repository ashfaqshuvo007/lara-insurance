<?php

namespace App\Http\Controllers\Dashboard\insurer;
use App\Models\Insurer;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\InsurerPolicy;
use App\Models\PolicySubType;
use App\Models\PolicyType;
use Validator;
use Auth;
use Session;
use App\Models\TplEntry;
use App\Models\FullCasco;
use App\Models\GreenCard;
use App\Models\HomePolicy;
use App\Models\Travel;

class InsurerPolicyController extends Controller
{
    public function addHomePolicy(Request $request){
        $params = $request->all();
        if(isset($params)){
            $validator = Validator::make($params, [
                'policy_name' => 'required',
                'commission' => 'required',
                'insurer_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()], 400);
            }
            $policy_find = InsurerPolicy::where([
                ['insurer_id', '=', $params['insurer_id']],
                ['policy_type_id','=','f8b176e70195'],
                ['policy_sub_type_id','=','74273e1bc257'],
            ])->first();
            if($policy_find){
                $insure_policy =[
                    'policy_name' => $params['policy_name'],
                    'commission' => $params['commission'],
                    'status' => 1
                ];
                $saveHomePolicy = InsurerPolicy::where([
                    ['insurer_id', '=', $params['insurer_id']],
                    ['policy_type_id','=','f8b176e70195'],
                    ['policy_sub_type_id','=','74273e1bc257'],
                ])->update($insure_policy);
                if($saveHomePolicy){
                    $policy_list = InsurerPolicy::where('insurer_id',$params['insurer_id'])->distinct()->orderBy('id','desc')->get();
                    foreach($policy_list as $key => $policy){
                        $policy_list[$key]['policy_type'] = $policy->getPolicytype;
                        $policy_list[$key]['policy_sub_type'] = $policy->getPolicySubType;   
                    }
                    $policy_name = InsurerPolicy::where('insurer_id',$params['insurer_id'])->distinct()->orderBy('id','desc')->get();
                    return response()->json(['success' => true, 'policy' => $policy_list,'policy_selectbox_list'=>$policy_name,'update'=>1], 200);
                }
            }else{
                $insure_policy =[
                    'insurer_policy_id' => uniqid(),
                    'policy_type_id' => 'f8b176e70195',
                    'policy_sub_type_id' => '74273e1bc257',
                    'insurer_id' => $params['insurer_id'],
                    'policy_name' => $params['policy_name'],
                    'commission' => $params['commission'],
                    'status' => 1
                ];
                $saveHomePolicy = InsurerPolicy::Create($insure_policy);
                if($saveHomePolicy){
                    $policy_list = InsurerPolicy::where('insurer_id',$params['insurer_id'])->distinct()->orderBy('id','desc')->get();
                    foreach($policy_list as $key => $policy){
                        $policy_list[$key]['policy_type'] = $policy->getPolicytype;
                        $policy_list[$key]['policy_sub_type'] = $policy->getPolicySubType;   
                    }
                    $policy_name = InsurerPolicy::where('insurer_id',$params['insurer_id'])->distinct()->orderBy('id','desc')->get();
                    return response()->json(['success' => true, 'policy' => $policy_list,'policy_selectbox_list'=>$policy_name,'add'=>1], 200);
                }
            }
        }
    }
    public function addCarPolicy(Request $request){
        $params = $request->all();
        if(isset($params)){
            $validator = Validator::make($params, [
                'policy_name' => 'required',
                'commission' => 'required',
                'insurer_id' => 'required',
                'policy_sub_type' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()], 400);
            }
            $policy_find = InsurerPolicy::where([
                ['insurer_id', '=', $params['insurer_id']],
                ['policy_type_id','=','71de088c1a2d'],
                ['policy_sub_type_id','=',$params['policy_sub_type']],
            ])->first();
            if($policy_find){
                $insure_policy =[
                    'policy_name' => $params['policy_name'],
                    'commission' => $params['commission'],
                    'status' => 1
                ];
                $saveCarPolicy = InsurerPolicy::where([
                    ['insurer_id', '=', $params['insurer_id']],
                    ['policy_type_id','=','71de088c1a2d'],
                    ['policy_sub_type_id','=',$params['policy_sub_type']],
                ])->update($insure_policy);
                if($saveCarPolicy){
                    $policy_list = InsurerPolicy::where('insurer_id',$params['insurer_id'])->distinct()->orderBy('id','desc')->get();
                    foreach($policy_list as $key => $policy){
                         $policy_list[$key]['policy_type'] = $policy->getPolicytype;
                         $policy_list[$key]['policy_sub_type'] = $policy->getPolicySubType;   
                    }
                    $policy_name = InsurerPolicy::where('insurer_id',$params['insurer_id'])->distinct()->orderBy('id','desc')->get();
                    return response()->json(['success' => true, 'policy' => $policy_list,'policy_selectbox_list'=>$policy_name,'update'=>1], 200);
                }
            }else{
                $insure_policy =[
                    'insurer_policy_id' => uniqid(),
                    'policy_type_id' => '71de088c1a2d',
                    'policy_sub_type_id' => $params['policy_sub_type'],
                    'insurer_id' => $params['insurer_id'],
                    'policy_name' => $params['policy_name'],
                    'commission' => $params['commission'],
                    'status' => 1
                ];
                $saveCarPolicy = InsurerPolicy::Create($insure_policy);
                if($saveCarPolicy){
                    $policy_list = InsurerPolicy::where('insurer_id',$params['insurer_id'])->distinct()->orderBy('id','desc')->get();
                    foreach($policy_list as $key => $policy){
                         $policy_list[$key]['policy_type'] = $policy->getPolicytype;
                         $policy_list[$key]['policy_sub_type'] = $policy->getPolicySubType;   
                    }
                    $policy_name = InsurerPolicy::where('insurer_id',$params['insurer_id'])->distinct()->orderBy('id','desc')->get();
                    return response()->json(['success' => true, 'policy' => $policy_list,'policy_selectbox_list'=>$policy_name,'add'=>1], 200);
                }
            }
        }
    }
    public function addTravelPolicy(Request $request){
        $params = $request->all();
        if(isset($params)){
            $validator = Validator::make($params, [
                'policy_name' => 'required',
                'commission' => 'required',
                'country' => 'required',
                'insurer_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()], 400);
            }
            $policy_find = InsurerPolicy::where([
                ['insurer_id', '=', $params['insurer_id']],
                ['policy_type_id','=','807ce7e758dc'],
                ['policy_sub_type_id','=',$params['country']],
            ])->first();
            if($policy_find){
                $insure_policy =[
                    'policy_name' => $params['policy_name'],
                    'commission' => $params['commission'],
                    'status' => 1
                ];
                $saveTravelPolicy = InsurerPolicy::where([
                    ['insurer_id', '=', $params['insurer_id']],
                    ['policy_type_id','=','807ce7e758dc'],
                    ['policy_sub_type_id','=',$params['country']],
                ])->update($insure_policy);
                if($saveTravelPolicy){
                    $policy_list = InsurerPolicy::where('insurer_id',$params['insurer_id'])->distinct()->orderBy('id','desc')->get();
                    foreach($policy_list as $key => $policy){
                        $policy_list[$key]['policy_type'] = $policy->getPolicytype;
                        $policy_list[$key]['policy_sub_type'] = $policy->getPolicySubType;     
                    }
                    $policy_name = InsurerPolicy::where('insurer_id',$params['insurer_id'])->distinct()->orderBy('id','desc')->get();
                    return response()->json(['success' => true, 'policy' => $policy_list,'policy_selectbox_list'=>$policy_name,'update' =>1], 200);
                }
            }else{
                $insure_policy =[
                    'insurer_policy_id' => uniqid(),
                    'policy_type_id' => '807ce7e758dc',
                    'policy_sub_type_id' => $params['country'],
                    'insurer_id' => $params['insurer_id'],
                    'policy_name' => $params['policy_name'],
                    'commission' => $params['commission'],
                    'status' => 1
                ];
                $saveTravelPolicy = InsurerPolicy::Create($insure_policy);
                if($saveTravelPolicy){
                    $policy_list = InsurerPolicy::where('insurer_id',$params['insurer_id'])->distinct()->orderBy('id','desc')->get();
                    foreach($policy_list as $key => $policy){
                        $policy_list[$key]['policy_type'] = $policy->getPolicytype;
                        $policy_list[$key]['policy_sub_type'] = $policy->getPolicySubType;     
                    }
                    $policy_name = InsurerPolicy::where('insurer_id',$params['insurer_id'])->distinct()->orderBy('id','desc')->get();
                    return response()->json(['success' => true, 'policy' => $policy_list,'policy_selectbox_list'=>$policy_name,'add' =>1], 200);
                }
            }
        }
    }
    public function changeInsurerPolicyStatus(Request $request){
        $active = $request->active;  
        $get_policy_sub_type = InsurerPolicy::where('insurer_policy_id',$request->id)->first();
        // $get_insurer = Insurer::where('insurer_id',$get_policy_sub_type['insurer_id'])->first();
        try{
            //check it is empty or not
            if(!empty($get_policy_sub_type))
            {
                InsurerPolicy::where('insurer_policy_id', $request->id)
                    ->update(['status' => $active]);
                
                $_get_sub_type_name =$get_policy_sub_type['policy_sub_type_id'];
                //check for home
                if($_get_sub_type_name =='74273e1bc257')
                {
                    HomePolicy::where('insurer_policy_id',$request->id)
                                        ->update(['status' => $active]);
                }
                //check for tpl
                elseif($_get_sub_type_name == 'c1bc21cfdda9')
                {
                    TplEntry::where('insurer_policy_id',$request->id)
                        ->update(['status' => $active]);
                }
                //check for green card
                elseif($_get_sub_type_name == 'dfd3e39b733a')
                {
                    GreenCard::where('insurer_policy_id',$request->id)
                            ->update(['status' => $active]);
                }
                //check for full casco
                elseif($_get_sub_type_name == 'c7824ee08a59')
                {
                    FullCasco::where('insurer_policy_id',$request->id)
                            ->update(['status' => $active]);
                }
                //check for student outside country
                elseif($_get_sub_type_name == '69e21f9783bd')
                {
                    Travel::where('insurer_policy_id',$request->id)
                            ->where('travel_sub_type_id','69e21f9783bd')
                            ->update(['status' => $active]);
                }
                //travel outside country
                elseif($_get_sub_type_name == '0ac2b7cfc696')
                {
                    Travel::where('insurer_policy_id',$request->id)
                            ->where('travel_sub_type_id','0ac2b7cfc696')
                            ->update(['status' => $active]);
                }
                return response()->json(['success' => true,'status' => 1],200);
            }
            else{
                return response()->json(['success' => false,'status' => 'false'],400);
            } 
        }
        catch(\Exception $e) {
            return response()->json(['success' => false,'error' => $e->getMessage()],400);
           
          }
        // if(!empty($get_insurer['status']))
        // {
        //     try{
        //         //check it is empty or not
        //         if(!empty($get_policy_sub_type))
        //         {
        //             InsurerPolicy::where('insurer_policy_id', $request->id)
        //                 ->update(['status' => $active]);
                    
        //             $_get_sub_type_name =$get_policy_sub_type['policy_sub_type_id'];
        //             //check for home
        //             if($_get_sub_type_name =='74273e1bc257')
        //             {
        //                 HomePolicy::where('insurer_policy_id',$request->id)
        //                                     ->update(['status' => $active]);
        //             }
        //             //check for tpl
        //             elseif($_get_sub_type_name == 'c1bc21cfdda9')
        //             {
        //                 TplEntry::where('insurer_policy_id',$request->id)
        //                     ->update(['status' => $active]);
        //             }
        //             //check for green card
        //             elseif($_get_sub_type_name == 'dfd3e39b733a')
        //             {
        //                 GreenCard::where('insurer_policy_id',$request->id)
        //                         ->update(['status' => $active]);
        //             }
        //             //check for full casco
        //             elseif($_get_sub_type_name == 'c7824ee08a59')
        //             {
        //                 FullCasco::where('insurer_policy_id',$request->id)
        //                         ->update(['status' => $active]);
        //             }
        //             //check for student outside country
        //             elseif($_get_sub_type_name == '69e21f9783bd')
        //             {
        //                 Travel::where('insurer_policy_id',$request->id)
        //                         ->where('travel_sub_type_id','69e21f9783bd')
        //                         ->update(['status' => $active]);
        //             }
        //             //travel outside country
        //             elseif($_get_sub_type_name == '0ac2b7cfc696')
        //             {
        //                 Travel::where('insurer_policy_id',$request->id)
        //                         ->where('travel_sub_type_id','0ac2b7cfc696')
        //                         ->update(['status' => $active]);
        //             }
        //             return response()->json(['success' => true,'status' => 1],200);
        //         }
        //         else{
        //             return response()->json(['success' => false,'status' => 'false'],400);
        //         } 
        //     }
        //     catch(\Exception $e) {
        //         return response()->json(['success' => false,'error' => $e->getMessage()],400);
               
        //       }
        // }
        // else{
        //     // Toastr::error('Error!', 'Error');
        //     return response()->json(['success' => false,'error' => 'Error!'],400);
        // }
        
    }
}