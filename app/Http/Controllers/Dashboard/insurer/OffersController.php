<?php

namespace App\Http\Controllers\Dashboard\insurer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offers;
use App\Models\InsurerPolicy;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use Session;
use Validator;

class OffersController extends Controller
{
    public function postSaveOffers(Request $request)
    {
        $input=$request->all();
        $validator = Validator::make($input, [
            'offer_name'     => 'required',
            'policy_name'     => 'required'
        ]);
        if($validator->fails()){
            
            return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()], 400);
        }
        // if(empty($input['amount_of'])  && empty($input['percentage_of']))
        // {
        //     $data = [
        //         'amount_of' => 'The amount off  field is required',
        //         'percentage_of' => 'The  Percentage Off field is required',
        //         'meassage' => '*Please Provide any of them'
        //         ];
        //         return response()->json(['success' => false, 'errors' => $data],400);
        // }
        // elseif(!empty($input['amount_of']) && !empty($input['percentage_of']))
        // {
        //     $data = [
        //         'meassage' => '*Please Provide any of them'
        //         ];
        //         return response()->json(['success' => false, 'errors' => $data],400);
        // }
        // $validator = Validator::make($input,[
        //     'extra_amount' =>'required'
        // ]);
        // if($validator->fails()){
        //     return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()], 400);
        // }

        if(($input['amount_of']=="0") && ($input['percentage_of'] == "0") && ($input['extra_amount'] == "0"))
        {
            $data = [
                        'meassage' => '*Please Provide any of them'
                        ];
            return response()->json(['success' => false, 'errors' => $data],400);
        }
        elseif(($input['amount_of'] =="0") && ($input['percentage_of'] =="0"))
        {
            $data = [
                'meassage' => '*Please Provide any of them'
                ];
            return response()->json(['success' => false, 'errors' => $data],400);
        }
        elseif(($input['extra_amount'] =="0") && ($input['percentage_of'] =="0"))
        {
            $data = [
                'meassage' => '*Please Provide any of them'
                ];
            return response()->json(['success' => false, 'errors' => $data],400);
        }
        elseif(($input['extra_amount'] =="0") && ($input['amount_of'] =="0"))
        {
            $data = [
                'meassage' => '*Please Provide any of them'
                ];
            return response()->json(['success' => false, 'errors' => $data],400);
        }
        else
        {
            $get_policy_name = InsurerPolicy::where('insurer_policy_id',$input['policy_name'])->first();

            $insert_data = ['insurer_id'=>$input['insurer_id'],
                            'policy_name'=>$get_policy_name['policy_name'],
                            'offer_name'=>$input['offer_name'],
                            'offers_id'=>uniqid(),
                            'amount_of'=>isset($input['amount_of'])?$input['amount_of']:'0',
                            'extra_amount'=>isset($input['extra_amount']) ? $input['extra_amount'] : '0',
                            'percentage_of'=>isset($input['percentage_of'])?$input['percentage_of']:'0',
                            'insurer_policy_id'=>$input['policy_name']];
            
            $create_offers = Offers::create($insert_data);
            return response()->json(['success' => true, 'offers' => 'Offers Added'], 200);  
        }
        
    }

    public function deleteSaveOffers($offers_id)
    {
        $delete_terms_condition = Offers::where('offers_id',$offers_id)->delete();
        
        Toastr::success('Offers Delete successfully', 'Success');

        return back();

    }
}
