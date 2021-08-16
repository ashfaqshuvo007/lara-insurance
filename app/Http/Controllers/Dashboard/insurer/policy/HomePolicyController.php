<?php

namespace App\Http\Controllers\Dashboard\insurer\policy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InsurerPolicy;
use App\Models\HomePolicy;
use App\Models\Policy;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Insurer;

use App\Models\HomePolicyType;
use Auth;
use Session;
class HomePolicyController extends Controller
{
    public function getShowInsurerPolicyHome($insurer_policy_id = null)
    {
        $data = [];
        if(isset($insurer_policy_id)){
            $data['insurer_sub_Policy'] = InsurerPolicy::where('insurer_policy_id',$insurer_policy_id)->first();
            $data['policy_type'] = HomePolicyType::all()->pluck('name','home_sub_type_id');
            $get_all_home_policy = HomePolicy::where('insurer_policy_id',$insurer_policy_id)->get();
            // dd($data);
            $store_home_policy =[];
            // dd($get_all_home_policy);
            if(!empty( $get_all_home_policy ))
            {
               foreach($get_all_home_policy as $deatils)
               {
                   $type_name = HomePolicyType::where('home_sub_type_id',$deatils->home_sub_type_id)->first();
                   if(!empty($type_name))
                   {
                    $store_home_policy[]=[
                        'home_sub_type_id'=>$type_name['name'],
                        'all'=>$deatils->all,
                        'home_value'=>$deatils->home_value,
                        'price_of_villa'=>$deatils->price_of_villa,
                        'price_of_aparment'=>$deatils->price_of_aparment,
                        'home_policy_id'=>$deatils->home_policy_id,
                        'status'=>$deatils->status
                    ];
                   }
                    
               }
            }

        }
        return view('dashboard.insurer.policy.insurer-home',$data,['store_home_policy'=>$store_home_policy]);
    }
    public function storeHomeSubPolicy(Request $request){
        $input = $request->all();
        // dd($input);
        $find_insurer = Insurer::where('insurer_id',$input['insurer_id'])->first();

        if(!empty($find_insurer['status']))
        {
            $find_policy = InsurerPolicy::where('insurer_policy_id',$input['insurer_policy_id'])->first();

            if(!empty($find_policy['status']))
            {
                
            }
            else{
                Toastr::error('Policy status is off!','Error');
                return back();
            }
        }
        else{
            Toastr::error('Company Status is off!','Error');
            return back();
        }
        $validator = Validator::make($input, [
                    'home_sub_type_id' => 'required',
                    'price_of_villa'=>'required',
                    'price_of_aparment'=>'required'
                ]);
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();

            // return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()], 400);
        }
        if((int)$input['price_of_villa'] >=0 && (int)$input['price_of_villa']<=100)
        {
            //valid price
            $get_price_of_villa = $input['price_of_villa'];
        }
        else{
            $error_message =[
                'price_of_villa'=>'Please Give a valid percentage'
            ];
            return back()->withErrors($error_message)->withInput();
        }
        if((int)$input['price_of_aparment'] >=0 && (int)$input['price_of_aparment']<=100)
        {
            $get_price_of_aparment = $input['price_of_aparment'];
        }
        else{
            $error_message =[
                'price_of_aparment'=>'Please Give a valid percentage'
            ];
            return back()->withErrors($error_message)->withInput();
        }
        if(isset($input['all']) && isset($input['home_value']))
        {
            
            if(($input['all'] != null) && ($input['home_value'] != null))
            {
                $error_data = [
                    'message'=>'Please provide any of them'
                ];
                return back()->withErrors($error_data)->withInput();
            }
        }
        elseif(isset($input['all']) || isset($input['home_value']))
        {
            //check any one exist
        }
        else{
            $error_data = [
                'message'=>'Please provide any of them'
            ];
            return back()->withErrors($error_data)->withInput();
        }


        // $insure_home_policy =[
        //     'home_policy_id' => uniqid(),
        //     'insurer_id' => $input['insurer_id'],
        //     'insurer_policy_id' => $input['insurer_policy_id'],
        //     'home_type_id' => 'Home',
        //     'home_sub_type_id' => $input['home_sub_type_id'],
        //     'price_of_villa'=>$get_price_of_villa,
        //     'price_of_aparment'=>$get_price_of_aparment,
        //     'all'=>!empty($input['all'])?1:0,
        //     'home_value'=>!empty($input['home_value'])?1:0
        // ];

        // $savehomePolicy = HomePolicy::Create($insure_home_policy);

        // Toastr::success('Policy Added Successfully','Success');
        // return back();

        //check already a policy exist or not 
        $find_policy = HomePolicy::where('insurer_policy_id',$input['insurer_policy_id'])
                                ->where('home_sub_type_id',$input['home_sub_type_id'])
                                ->first();

        if(!empty($find_policy))
        {
            $update_data =[
                'price_of_villa'=>$get_price_of_villa,
                'price_of_aparment'=>$get_price_of_aparment,
                'all'=>!empty($input['all'])?1:0,
                'home_value'=>!empty($input['home_value'])?1:0
            ];

            $find_policy->update($update_data);
            Toastr::success('Policy Updated Successfully','Success');
            return back();
        }
        else{
            $insure_home_policy =[
                'home_policy_id' => uniqid(),
                'insurer_id' => $input['insurer_id'],
                'insurer_policy_id' => $input['insurer_policy_id'],
                'home_type_id' => 'Home',
                'home_sub_type_id' => $input['home_sub_type_id'],
                'price_of_villa'=>$get_price_of_villa,
                'price_of_aparment'=>$get_price_of_aparment,
                'all'=>!empty($input['all'])?1:0,
                'home_value'=>!empty($input['home_value'])?1:0
            ];

            $savehomePolicy = HomePolicy::Create($insure_home_policy);

            Toastr::success('Policy Added Successfully','Success');
            return back();
        }
            

                // previous code


        // if(isset($params)){
        //     $validator = Validator::make($params, [
        //         'square' => 'required',
        //     ]);
            // if ($validator->fails()) {
            //     return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()], 400);
            // }
            // $insure_home_policy =[
            //     'home_policy_id' => uniqid(),
            //     'insurer_id' => $params['insurer_id'],
            //     'insurer_policy_id' => $params['insurer_policy_id'],
            //     'home_type_id' => 'Home',
            //     'home_sub_type_id' => $params['home_sub_type_id'],
            //     'square' => $params['square'],
            //     'address' => $params['address'],
            //     'unit' => $params['unit'],
            // ];
            // $savehomePolicy = HomePolicy::Create($insure_home_policy);
            // if($savehomePolicy){
            //     $home_policy_list = HomePolicy::where('insurer_id',$params['insurer_id'])->distinct()->orderBy('id','desc')->get();
            //     return response()->json(['success' => true, 'homepolicy' => $home_policy_list], 200);
            // }
        // }
    }

    public function editUpcomeingPolicyNote(Request $request){
        $input = $request->all();
        $id = $input['data'];
        $data = Policy::where('policy_id',$id)
                        ->first();
        return $data;
    }
    public function updateUpcomeingPolicyNote(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
                        'notes' => 'required'

                    ]);
        if($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        else{
            $data_update = Policy::where('policy_id',$input['policy_id'])->update([
                'note'=>$input['notes']
            ]);
            Toastr::success('Task Updated Sucessfully', 'Success');
            return back();

        }
    }

    public function updateUpcomeingPolicyFollwup(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
                        'followup_date' => 'required'

                    ]);
        if($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        else{
            $date_format=date('Y-m-d H:i:s',strtotime($input['followup_date']));

            $data_update = Policy::where('policy_id',$input['policy_id'])->update([
                'next_followup_date'=>$date_format
            ]);
            Toastr::success('Task Updated Sucessfully', 'Success');
            return back();

        }
    }

    public function updateHomepolicy(Request $request)
    {
        $active = $request->active;
        HomePolicy::where('home_policy_id', $request->id)
        ->update(['status' => $active]);
        return response()->json(['success' => true,'status' => 1],200);
    }



}
