<?php

namespace App\Http\Controllers\Dashboard\insurer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Insurer;
use App\Models\InsurerPolicy;
use Auth;
use Session;
use Validator;
use Brian2694\Toastr\Facades\Toastr;

class ComparisionController extends Controller
{
    public function postSaveComparision(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'policy_name'     => 'required',
            "comparision_values"    => "required|array|min:1",
            "comparision_values.*"  => "required|string|min:1"
        ]);

        if($validator->fails()){
            return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()],400);
        }

        $comaprision_data = $input['comparision_values'];

        $updated_data = ['comparision_values'=>implode(",",$comaprision_data)];


        //comparision create
        $comparision_create = InsurerPolicy::where('insurer_policy_id',$input['policy_name'])->update($updated_data);

        if($comparision_create)
        {
            $comparision_data = InsurerPolicy::where('insurer_id',$input['insurer_id'])->get();
            return response()->json(['success' => true,'data'=>$comparision_data]);
        }
    }

    public function deleteComparisionValues($comparision_unique_id)
    {
        $updated_data = ['comparision_values'=>null];
        //comparision delete
        $comparision_delete = InsurerPolicy::where('insurer_policy_id',$comparision_unique_id)->update($updated_data);
        Toastr::success('Delete success', 'Success');
        return back();

    }
}
