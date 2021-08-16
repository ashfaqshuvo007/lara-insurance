<?php

namespace App\Http\Controllers\Dashboard\insurer\policy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InsurerPolicy;
use App\Models\Travel;
use Illuminate\Support\Facades\Validator;
use Auth;
use Session;
class TravelPolicyController extends Controller
{
    public function getShowInsurerPolicyTravel($insurer_policy_id = null)
    {
        $data = [];
        if(isset($insurer_policy_id)){
            $data['insurer_sub_Policy'] = InsurerPolicy::where('insurer_policy_id',$insurer_policy_id)->first();
            $data['travel_list'] = Travel::where('insurer_policy_id',$insurer_policy_id)->distinct()->orderBy('id','desc')->get();
        }

        return view('dashboard.insurer.policy.insurer-travel', $data);

    }
    public function getShowInsurerPolicyStudentTravel($insurer_policy_id = null)
    {
        $data = [];
        if(isset($insurer_policy_id)){
            $data['insurer_sub_Policy'] = InsurerPolicy::where('insurer_policy_id',$insurer_policy_id)->first();
            $data['travel_list'] = Travel::where('insurer_policy_id',$insurer_policy_id)->distinct()->orderBy('id','desc')->get();
        }
        return view('dashboard.insurer.policy.insurer-travel-student', $data);

    }
    public function storeTravelSubPolicy(Request $request){
        $params = $request->all();



        if(isset($params)){
            $travel_policy_find = Travel::where([
                                                ['zone', '=', $params['zone']],
                                                ['age_group', '=', $params['age_group']],
                                                ['insurer_policy_id', '=', $params['insurer_policy_id']],
                                                ['validity','=', $params['validity']]
                                            ])->first();

            $travel_policy_find_check = Travel::where([
                ['zone', '=', $params['zone']],
                ['age_group', '=', $params['age_group']],
                ['insurer_policy_id', '=', $params['insurer_policy_id']]
            ])->get();





                                            $rules=[
                                                'zone' => 'required',
                                                'validity' => 'required',
                                                'price' => 'required',
                                                'insurer_id' => 'required',
                                                'insurer_policy_id' => 'required',
                                                'age_group' => 'required'
                                            ];
            $validator = Validator::make($params, $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()], 400);
            }
            foreach ($travel_policy_find_check as $key => $value) {
                if(($value->validity=='1-6 days' || $value->validity=='1-9 days') && ($request->validity=='1-6 days' || $request->validity=='1-9 days')){
                    if(!empty($value->validity) && $value->validity !=$request->validity){
                        return response()->json(['success' => false, 'error' => 'You will enter on price list either 1-6 or 1-9','error_match' => 1], 400);

                    }
                }
                elseif(($value->validity=='1-6 days' || $value->validity=='10-15 days') && ($request->validity=='10-15 days' || $request->validity=='1-6 days')){
                    if(!empty($value->validity) && $value->validity !=$request->validity){
                        return response()->json(['success' => false, 'error' => 'You will enter on price list either 1-6 or 10-15','error_match' => 1], 400);

                    }
                }
                elseif(($value->validity=='1-9 days' || $value->validity=='7-10 days') && ($request->validity=='7-10 days' || $request->validity=='1-9 days'))
                {
                    if(!empty($value->validity) && $value->validity !=$request->validity){
                        return response()->json(['success' => false, 'error' => 'You will enter on price list either 1-9 or 7-10','error_match' => 1], 400);

                    }
                }
                elseif(($value->validity=='181-270 days' || $value->validity=='181-365 days') && ($request->validity=='181-365 days' || $request->validity=='181-270 days'))
                {
                    if(!empty($value->validity) && $value->validity !=$request->validity){
                        return response()->json(['success' => false, 'error' => 'You will enter on price list either 181-270 or 181-365','error_match' => 1], 400);

                    }
                }
                elseif(($value->validity=='181-365 days' || $value->validity=='271-365 days') && ($request->validity=='271-365 days' || $request->validity=='181-365 days'))
                {
                    if(!empty($value->validity) && $value->validity !=$request->validity){
                        return response()->json(['success' => false, 'error' => 'You will enter on price list either 181-365 or 271-365','error_match' => 1], 400);

                    }
                }
            }

            if(isset($travel_policy_find)){
                $insure_travel_policy =[
                    'price' => $params['price']
                ];
                $saveTravelPolicy = Travel::where('travel_id',$travel_policy_find['travel_id'])->update($insure_travel_policy);
                if($saveTravelPolicy){
                    $travel_policy_list = Travel::where('insurer_policy_id',$params['insurer_policy_id'])->distinct()->orderBy('id','desc')->get();
                    return response()->json(['success' => true, 'travelpolicy' => $travel_policy_list,'update' => 1], 200);
                }
            }else{
                $insure_travel_policy =[
                    'travel_id' => uniqid(),
                    'insurer_policy_id' => $params['insurer_policy_id'],
                    'insurer_id' => $params['insurer_id'],
                    'travel_sub_type_id' => $params['policy_sub_type_id'],
                    'age_group' => $params['age_group'],
                    'zone' => $params['zone'],
                    'validity' => $params['validity'],
                    'price' => $params['price']
                ];
                $saveTravelPolicy = Travel::Create($insure_travel_policy);
                if($saveTravelPolicy){
                    $travel_policy_list = Travel::where('insurer_policy_id',$params['insurer_policy_id'])->distinct()->orderBy('id','desc')->get();
                    return response()->json(['success' => true, 'travelpolicy' => $travel_policy_list,'add' =>1], 200);
                }
            }
        }
    }
    public function changeInsurerTravelPolicyStatus(Request $request){
        $active = $request->active;
        Travel::where('travel_id', $request->id)
                ->update(['status' => $active]);


        return response()->json(['success' => true,'status' => 1],200);
    }
    public function storeStudentTravelSubPolicy(Request $request){
        $params = $request->all();
        if(isset($params)){
            $travel_policy_find = Travel::where([
                                                ['zone', '=', $params['zone']],
                                                ['age_group', '=', $params['age_group']],
                                                ['insurer_policy_id', '=', $params['insurer_policy_id']],
                                                ['validity','=', $params['validity']]
                                            ])->first();
            $validator = Validator::make($params, [
                'zone' => 'required',
				'validity' => 'required',
                'price' => 'required',
                'insurer_id' => 'required',
                'insurer_policy_id' => 'required',
                'age_group' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()], 400);
            }
            if(isset($travel_policy_find)){
                $insure_travel_policy =[
                    'price' => $params['price']
                ];
                $saveTravelPolicy = Travel::where('travel_id',$travel_policy_find['travel_id'])->update($insure_travel_policy);
                if($saveTravelPolicy){
                    $travel_policy_list = Travel::where('insurer_policy_id',$params['insurer_policy_id'])->distinct()->orderBy('id','desc')->get();
                    return response()->json(['success' => true, 'travelpolicy' => $travel_policy_list,'update' => 1], 200);
                }
            }else{
                $insure_travel_policy =[
                    'travel_id' => uniqid(),
                    'insurer_policy_id' => $params['insurer_policy_id'],
                    'insurer_id' => $params['insurer_id'],
                    'travel_sub_type_id' => $params['policy_sub_type_id'],
                    'age_group' => $params['age_group'],
                    'zone' => $params['zone'],
                    'validity' => $params['validity'],
                    'price' => $params['price']
                ];
                $saveTravelPolicy = Travel::Create($insure_travel_policy);
                if($saveTravelPolicy){
                    $travel_policy_list = Travel::where('insurer_policy_id',$params['insurer_policy_id'])->distinct()->orderBy('id','desc')->get();
                    return response()->json(['success' => true, 'travelpolicy' => $travel_policy_list,'add' =>1], 200);
                }
            }
        }
    }
    public function changeInsurerStudentTravelPolicyStatus(Request $request){
        $active = $request->active;
        Travel::where('travel_id', $request->id)
                ->update(['status' => $active]);


        return response()->json(['success' => true,'status' => 1],200);
    }
}
