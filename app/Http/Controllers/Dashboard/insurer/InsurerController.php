<?php

namespace App\Http\Controllers\Dashboard\insurer;
use App\Models\Insurer;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\InsurerPolicy;
use Illuminate\Support\Facades\Validator;
use App\Models\TplEntry;
use App\Models\FullCasco;
use App\Models\GreenCard;
use App\Models\HomePolicy;
use App\Models\Travel;

use Auth;
use Session;
use App\Models\Offers;
use App\Models\TermsCondition;

class InsurerController extends Controller
{
    public function getShowInsurerProfile($insurer_id = null)
    {
        $data =[];

        if(isset($insurer_id )){
            $data['insurer_details'] = Insurer::where('insurer_id',$insurer_id)->first();
            $insurerPolicy = InsurerPolicy::where('insurer_id',$insurer_id)->get();
            foreach($insurerPolicy as $key => $policy){
                if($policy->getPolicytype){
                    $insurerPolicy[$key]['policy_type'] = $policy->getPolicytype;
                    $insurerPolicy[$key]['policy_sub_type'] = $policy->getPolicySubType;
                }
            }
            $data['insurer_policy'] = $insurerPolicy;
            $insurer_policy_name =[];
            foreach($data['insurer_policy'] as $insurer_policy_details)
            {
            $insurer_policy_name[$insurer_policy_details->insurer_policy_id] = $insurer_policy_details->policy_name;
            }

            $data['insuer_terms_condition'] = TermsCondition::where('insurer_id',$insurer_id)->get();
            $data['insurer_policy_name'] = $insurer_policy_name;
            $data['insuer_policy_item'] = $data['insurer_policy'];
            $data['insuer_offer_get'] = Offers::where('insurer_id',$insurer_id)->get();

        }
        return view('dashboard.insurer.insurer-profile',$data);

    }
    public function store(Request $request){
        $input = $request->all();
        $insurer_validation = $this->InsurerValidation($input);
        if ($insurer_validation->fails()) {
            return response()->json(['success' => false, 'errors' => $insurer_validation->getMessageBag()->toArray()], 400);
		}
        if(isset($input)){
            $insurer_arr = [
                'insurer_id' => uniqid(),
                'name' => $input['name'],
                'status' => $input['status']
            ];
            $insurer = Insurer::Create($insurer_arr);
            if($insurer){
                $insure_list = Insurer::orderBy('id','desc')->get();
            }
            return response()->json(['success' => true, 'insurer' => $insure_list], 200);
        }

    }
    protected function InsurerValidation($request){
        if (isset($request)) {
			return Validator::make($request, [
				'name' => 'required',
			]);
		}
    }

    public function addLogo(Request $request){
        $input = $request->all();
        if(isset($input)){
            $validator = Validator::make($input, [
                'browse' => 'required|mimes:jpeg,jpg,png'
            ]);
            if($validator->fails()){
                return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()], 400);
            }
            $logo = $input['browse'];
            $file_name = md5(uniqid()) . '.' . $logo->getClientOriginalExtension();
            $storage_path = public_path('/storage/uploads/insurer_logo');
            $logo->move($storage_path, $file_name);
            $insurer_check = Insurer::where('insurer_id',$input['insurer_id'])->first();
            $insurer_logo_exist=$insurer_check['logo'];

            if(isset($insurer_logo_exist))
            {
                if(file_exists(public_path('/storage/uploads/insurer_logo/'.$insurer_logo_exist)))
                {
                    unlink(public_path('/storage/uploads/insurer_logo/'.$insurer_logo_exist));
                }
            }

            $upload_logo = [
                'logo' => $file_name
            ];
            $save = Insurer::where('insurer_id', $input['insurer_id'])->update($upload_logo);
            if($save){
                $insure_list = Insurer::where('insurer_id',$input['insurer_id'])->first();
                return response()->json(['success' => true, 'insure' => $insure_list], 200);
            }
        }
    }
    public function changeInsurerStatus(Request $request){
        $active = $request->active;
        try {
        Insurer::where('insurer_id', $request->id)
                ->update(['status' => $active]);

        InsurerPolicy::where('insurer_id',$request->id)
                        ->update(['status' => $active]);

        TplEntry::where('insurer_id',$request->id)
                    ->update(['status' => $active]);

        FullCasco::where('insurer_id',$request->id)
                    ->update(['status' => $active]);

        GreenCard::where('insurer_id',$request->id)
                        ->update(['status' => $active]);
          
        HomePolicy::where('insurer_id',$request->id)
                ->update(['status' => $active]);
                
        Travel::where('insurer_id',$request->id)
                ->update(['status' => $active]);

        return response()->json(['success' => true,'status' => 1],200);
        }
        catch(\Exception $e) {
            return response()->json(['success' => false,'status' => $e->getMessage()],400);
           
          }
    }

    public function deleteInsurerLogo(Request $request)
    {
        $input = $request->all();
        $get_insurer_data = Insurer::where('insurer_id',$input['insurer_id'])->first();

        if(isset($get_insurer_data['logo']))
        {
            if(file_exists(public_path('/storage/uploads/insurer_logo/'.$get_insurer_data['logo'])))
            {
                unlink(public_path('/storage/uploads/insurer_logo/'.$get_insurer_data['logo']));
            }
            $logo_delete = $get_insurer_data->update(['logo'=>null]);
            return response()->json(['success' => true],200);
        }
    }
}
