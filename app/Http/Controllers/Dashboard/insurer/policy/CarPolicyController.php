<?php

namespace App\Http\Controllers\Dashboard\insurer\policy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InsurerPolicy;
use App\Models\TplEntry;
use App\Models\FullCasco;
use App\Models\TplSubType;
use App\Models\TplType;
use App\Models\GreenCard;
use Validator;
use Auth;
use Session;
class CarPolicyController extends Controller
{
    public function getShowInsurerTpl($insurer_policy_id = null)
    {
        $data = [];
        if(isset($insurer_policy_id)){
            $data['insurer_sub_Policy'] = InsurerPolicy::where('insurer_policy_id',$insurer_policy_id)->first();
            $data['tpl_sub_type_list'] = TplSubType::where('tpl_type_id','5387b8bf5632')->pluck('name', 'tpl_sub_type_id');
            $data['tpl_type_list'] = TplType::where('tpl_type_id', '!=', 'd88ed7fda1fa')->pluck('name', 'tpl_type_id');
            $tpl_list = TplEntry::where('insurer_policy_id',$insurer_policy_id)->distinct()->orderBy('id','desc')->get();
            foreach($tpl_list as $key => $tpl){
                $tpl_list[$key]['tpl_type'] = $tpl->getTpltype;
                $tpl_list[$key]['tpl_sub_type'] = $tpl->getTplSubType;
            }
            $data['tpl_list_details'] = $tpl_list;

        }
        return view('dashboard.insurer.policy.insurer-tpl',$data);
    }
    public function storeCarTplPolicy(Request $request){
        $params = $request->all();
        if(isset($params)){
            $validator = Validator::make($params, [
                'tpl_type_id' => 'required',
				'tpl_sub_type_id' => 'required',
				'price' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()], 400);
            }
            $tpl_policy_find = TplEntry::where([
                                            ['tpl_type_id', '=', $params['tpl_type_id']],
                                            ['tpl_sub_type_id', '=', $params['tpl_sub_type_id']],
                                            ['insurer_policy_id', '=', $params['insurer_policy_id']],
                                        ])->first();
            if(isset($tpl_policy_find)){
                $insure_tpl_policy =[
                    'price' => $params['price']
                ];
                $savetplPolicy = TplEntry::where('tpl_entry_id',$tpl_policy_find['tpl_entry_id'])->update($insure_tpl_policy);
                if($savetplPolicy){
                    return response()->json(['success' => true, 'update' => 1], 200);
                }
            }else{
                $insure_tpl_policy =[
                    'tpl_entry_id' => uniqid(),
                    'insurer_policy_id' => $params['insurer_policy_id'],
                    'tpl_type_id' => $params['tpl_type_id'],
                    'insurer_id' => $params['insurer_id'],
                    'tpl_sub_type_id' => $params['tpl_sub_type_id'],
                    'price' => $params['price'],
                    'status' => 1
                ];
                $savetplPolicy = TplEntry::Create($insure_tpl_policy);
                if($savetplPolicy){
                    return response()->json(['success' => true, 'add' =>1], 200);
                }
            }
        }
    }
    public function changeInsurerTplPolicyStatus(Request $request){
        $active = $request->active;
        TplEntry::where('tpl_entry_id', $request->id)
                ->update(['status' => $active]);


        return response()->json(['success' => true,'status' => 1],200);
    }
    public function changeTplCatagory(Request $request){
        $value = $request->get('value');
        $sub_catagory = TplSubType::where('tpl_type_id', $value)
                                ->get();
       return response()->json(['success' => true, 'subcatagory' => $sub_catagory], 200);
    }
    public function getShowInsurerPolicyGreen($insurer_policy_id = null)
    {
        $data = [];
        if(isset($insurer_policy_id)){
            $data['insurer_sub_Policy'] = InsurerPolicy::where('insurer_policy_id',$insurer_policy_id)->first();
            $data['green_list_details'] = GreenCard::where('insurer_policy_id',$insurer_policy_id)->distinct()->orderBy('id','desc')->get();
        }
        return view('dashboard.insurer.policy.insurer-green-card',$data);
    }
    public function storeInsurerPolicyGreen(Request $request){
        $params = $request->all();
        $p45_days_price = 0;
        $p3_months_price = 0;
        $validator = Validator::make($params, [
            '15_days_price' => 'required',
            '30_days_price' => 'required',
            '6_months_price' => 'required',
            '12_months_price' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' =>"Please Fill up Fileds"], 400);
        }
        if(isset($params['3_months_price'])){
            $p3_months_price = $params['3_months_price'];
        }
        if(isset($params['45_days_price'])){
            $p45_days_price = $params['45_days_price'];
        }
            $greenCard_policy_find = GreenCard::where([
                                            ['name', '=', $params['name']],
                                            ['green_card_type', '=', $params['green_card_type']],
                                            ['insurer_policy_id', '=', $params['insurer_policy_id']],
                                        ])->first();
            if(isset($greenCard_policy_find)){
                $insure_greenCard_policy =[
                    '15_days_price' => $params['15_days_price'],
                    '30_days_price' => $params['30_days_price'],
                    '45_days_price' => $p45_days_price,
                    '6_months_price' => $params['6_months_price'],
                    '12_months_price' => $params['12_months_price'],
                    '3_months_price' => $p3_months_price,
                ];
                $savegreenCardPolicy = GreenCard::where('green_card_id',$greenCard_policy_find['green_card_id'])->update($insure_greenCard_policy);
                if($savegreenCardPolicy){
                    return response()->json(['success' => true, 'update' => 1], 200);
                }
            }else{
                $insure_greenCard_policy =[
                    'green_card_id' => uniqid(),
                    'green_card_type' => $params['green_card_type'],
                    'insurer_id' => $params['insurer_id'],
                    'insurer_policy_id' => $params['insurer_policy_id'],
                    'name' => $params['name'],
                    '15_days_price' => $params['15_days_price'],
                    '30_days_price' => $params['30_days_price'],
                    '45_days_price' => $p45_days_price,
                    '6_months_price' => $params['6_months_price'],
                    '12_months_price' => $params['12_months_price'],
                    '3_months_price' => $p3_months_price,
                ];
                $savegreenCardPolicy = GreenCard::Create($insure_greenCard_policy);
                if($savegreenCardPolicy){
                    return response()->json(['success' => true, 'add' =>1], 200);
                }
            }

    }
    public function changeInsurerPolicyGreenStatus(Request $request){
        $active = $request->active;
        GreenCard::where('green_card_id', $request->id)
                ->update(['status' => $active]);


        return response()->json(['success' => true,'status' => 1],200);
    }
    public function getShowInsurerPolicyFullCasco($insurer_policy_id = null)
    {
        $data = [];
        if(isset($insurer_policy_id)){
            $data['insurer_sub_Policy'] = InsurerPolicy::where('insurer_policy_id',$insurer_policy_id)->first();
            $data['fullCasco_list_details'] = FullCasco::where('insurer_policy_id',$insurer_policy_id)->distinct()->orderBy('id','desc')->get();
        }
        return view('dashboard.insurer.policy.insurer-full-casco',$data);
    }
    public function storeCarFullCascoPolicy(Request $request){
        $params = $request->all();
        if(isset($params)){
            $varient_coverage1 = null;
            $varient_coverage2 = null;
            $varient_coverage3= null;
            $varient_coverage4 = null;
            $varient_coverage5 = null;
            $name = array(0=>'varient I',1=>'varient II',2=>'varient III',3=>'varient IV',4=>'varient V');
            if(isset($params['varient_coverage1'])){
                $varient_coverage1 = implode(',',$params['varient_coverage1']);
            }
            if(isset($params['varient_coverage2'])){
                $varient_coverage2 = implode(',',$params['varient_coverage2']);
            }
            if(isset($params['varient_coverage3'])){
                $varient_coverage3 = implode(',',$params['varient_coverage3']);
            }
            if(isset($params['varient_coverage4'])){
                $varient_coverage4 = implode(',',$params['varient_coverage4']);
            }
            if(isset($params['varient_coverage5'])){
                $varient_coverage5 = implode(',',$params['varient_coverage5']);
            }
            $percentage = $params['percentage'];
            $price = $params['price'];
            $insure_tpl_policy = [];

            $varient_coverage = array($varient_coverage1,$varient_coverage2,$varient_coverage3,$varient_coverage4,$varient_coverage5);
            for ($i = 0; $i <count($percentage); $i++) {
                $insure_fullCasco_policy =[
                    'full_casco_id' => uniqid(),
                    'insurer_policy_id' => $params['insurer_policy_id'],
                    'insurer_id' => $params['insurer_id'],
                    'variant' => $name[$i],
                    'variant_coverage' => $varient_coverage[$i],
                    'percentage' => $percentage[$i],
                    'price' => $price[$i]
                ];
                if($percentage[$i] != null && $varient_coverage[$i] != null && $price[$i] !=null){
                    $find_name = FullCasco::where([
                        ['variant', '=', $name[$i]],
                        ['insurer_policy_id', '=', $params['insurer_policy_id']],
                        ['insurer_id', '=' ,$params['insurer_id']],
                    ])->first();
                    if(isset($find_name)){
                        $insure_fullCasco_policy =[
                            'variant' => $name[$i],
                            'variant_coverage' => $varient_coverage[$i],
                            'percentage' => $percentage[$i],
                            'price' => $price[$i]
                        ];
                        $savefullCascoPolicy = FullCasco::where('full_casco_id',$find_name['full_casco_id'])->update($insure_fullCasco_policy);
                    }else{
                        $savefullCascoPolicy = FullCasco::Create($insure_fullCasco_policy);
                    }
                }
            }
            if($savefullCascoPolicy){
                $fullCasco_policy_list = FullCasco::where('insurer_id',$params['insurer_id'])->distinct()->orderBy('id','desc')->get();
                return response()->json(['success' => true, 'fullCascopolicy' => $fullCasco_policy_list], 200);
            }
        }
    }
    public function changeInsurerFullCascoPolicyStatus(Request $request){
        $active = $request->active;
        FullCasco::where('full_casco_id', $request->id)
                ->update(['status' => $active]);


        return response()->json(['success' => true,'status' => 1],200);
    }
}
