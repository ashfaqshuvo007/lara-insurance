<?php

namespace App\Http\Controllers\Dashboard\insurer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\TermsCondition;
use App\Models\InsurerPolicy;

class TermsAndConditionController extends Controller
{
    public function postSaveTermsCondition(Request $request)
    {
        $input=$request->all();
        $validator = Validator::make($input, [
            'policy_name'     => 'required',
            'browse' => 'required|mimes:pdf|max:10000'
        ]);
        if($validator->fails()){
            return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()], 400);
        }
        // return response()->json(['success' => false, 'errors' => 'Invalid Data','status'=>'error'],400);
        if($request->hasFile('browse'))
        {
            $storage_path = '/storage/uploads/terms_condition/';

            // mkdir($storage_path, 0777, true);

            $fileName = time().'.'.$request->file('browse')->getClientOriginalExtension(); 

            $get_policy = InsurerPolicy::where('insurer_policy_id',$input['policy_name'])->first();

            //get policy name
            $get_policy_name = $get_policy['policy_name'];
            //terms & condition exist 
            $get_terms_condition_exist = TermsCondition::where('insurer_policy_id',$input['policy_name'])->first();
             
            if(isset($get_terms_condition_exist))
            {
                if(isset($get_terms_condition_exist['policy_file']))
                {
                    if(file_exists(public_path($storage_path.$get_terms_condition_exist['policy_file'])))
                    {
                        unlink(public_path($storage_path.$get_terms_condition_exist['policy_file']));
                    }

                    $update_data = ['policy_file'=>$fileName];

                    try {
                    $update_terms = $get_terms_condition_exist->update($update_data);
                    }
                    catch(\Exception $e) {
                        // Toastr::error('Duplicate Entry','Error');
                        return response()->json(['success' => false, 'errors' => 'Duplicate Entry','status'=>'error'],400);
                    }
                    $request->file('browse')->move(public_path($storage_path), $fileName);
                    if($update_terms)
                    {
                        try {
                        $get_all_terms_condition = TermsCondition::where('insurer_id',$input['insurer_id'])->get();
                        return response()->json(['success' => true, 'insure' => $get_all_terms_condition], 200);
                        }
                        catch(\Exception $e) {
                            // Toastr::error('Invalid data','Error');
                            return response()->json(['success' => false, 'errors' => 'Duplicate Entry','status'=>'error'],400);
                        }
                    }
                }
            }
            else{
                //create terms and condition
                $create_data = [
                    'insurer_id' => $input['insurer_id'],
                    'policy_name' => $get_policy_name,
                    'insurer_policy_id' => $input['policy_name'],
                    'policy_file' => $fileName
                ];

                $request->file('browse')->move(public_path($storage_path), $fileName);
                try {
                $create_terms_condition = TermsCondition::create($create_data);
                }
                catch(\Exception $e) {
                    // Toastr::error('Duplicate Entry','Error');
                     return response()->json(['success' => false, 'errors' => 'Duplicate Entry','status'=>'error'],400);
                }
                if($create_terms_condition)
                {
                    try {
                    $get_all_terms_condition = TermsCondition::where('insurer_id',$input['insurer_id'])->get();
                    return response()->json(['success' => true, 'insure' => $get_all_terms_condition], 200);
                    }
                    catch(\Exception $e) {
                        // Toastr::error('Invalid Data','Error');
                        return response()->json(['success' => false, 'errors' => 'Duplicate Entry','status'=>'error'],400);
                    }
                }
            }

        }
    }
    public function deleteTermsandCondition($insurer_policy_id)
    {
        $delete_pdf = TermsCondition::where('insurer_policy_id',$insurer_policy_id)->first();
        $storage_path = '/storage/uploads/terms_condition/';

        if(file_exists(public_path($storage_path.$delete_pdf['policy_file'])))
        {
            unlink(public_path($storage_path.$delete_pdf['policy_file']));
        }
        $delete_terms_condition = TermsCondition::where('insurer_policy_id',$insurer_policy_id)->delete();
        
        Toastr::success('Delete success', 'Success');

        return back();
    }
}
