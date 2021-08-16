<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Insurer;
use App\Models\Customer;
use App\Models\Policy;
use App\Models\Claim;
use App\Models\FullCasco;
use App\Models\InsurerPolicy;
use App\Models\TplEntry;
use App\Models\Travel;
use App\Models\HomePolicy;
use App\Models\HomePolicyType;
use App\Models\GreenCard;
use App\Models\Status_tracking;
use App\Models\DriverDetails;
use App\Models\PolicySubType;
use App\Models\Car;
use App\Models\Property;
use App\Models\TplType;
use App\Models\TravelPolicyType;
use App\Models\Offers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\FullCascoType;
use App\Models\PaypalTransaction;

use PhpParser\Node\Stmt\Foreach_;
use App\Models\Reporting;
use App\Http\Controllers\Dashboard\policy\PolicyController as PolicyController;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class DashBoardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function getShowUpcomingPolicy(Request $request,$id='')
    {

        $datanewa='';

        if($id!=''){
            $datanewa=json_decode(base64_decode($id));
        }

        $Insurerdata=Insurer::all();
        $policySubType=PolicySubType::all();
        $insurer_policy=InsurerPolicy::all();

        $input=$request->input();




        $monday = strtotime("last monday");
        $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;

        $sunday = strtotime(date("Y-m-d",$monday)." +6 days");

        $this_week_sd = date("Y-m-d 00:00:00",$monday);
        $this_week_ed = date("Y-m-d 23:59:59",$sunday);




        $data = Policy::select('*','policy_sub_type.name as type_name','policy.expiry_date as renewal_date','insurer.name as insurer_name')
                    ->leftJoin('insurer', 'policy.insurer_id', '=', 'insurer.insurer_id')
                    ->leftJoin('policy_sub_type', 'policy.policy_type', '=', 'policy_sub_type.policy_sub_type_id')
                    ->leftJoin('users', 'policy.user_id', '=', 'users.user_id');

                    if(isset($datanewa->insurance_company) && !empty($datanewa->insurance_company)) {
                        $data = $data->where('policy.insurer_id',$datanewa->insurance_company);
                    }

                    if(isset($datanewa->filter_type) && !empty($datanewa->filter_type)) {
                        $data = $data->where('policy.policy_type',$datanewa->filter_type);
                    }
                    if(isset($datanewa->insurance_catagory) && !empty($datanewa->insurance_catagory)) {
                        $data = $data->where('policy.policy_type',$datanewa->insurance_catagory);
                    }

                    if(isset($datanewa->upcomeing_status) && !empty($datanewa->upcomeing_status)) {

                        if($datanewa->upcomeing_status==1){
                            // dd("1due");
                            $data = $data->where('policy.expiry_date',date('Y-m-d',strtotime(' +1 day')));
                        }
                        if($datanewa->upcomeing_status==3){
                            // dd("3 exp");
                            $data = $data->where('policy.expiry_date','<=',date('Y-m-d'));
                        }

                    }
                    if(isset($datanewa->next_followup_date) && !empty($datanewa->next_followup_date)) {
                        $getdate = date('Y-m-d',strtotime($datanewa->next_followup_date));
                        $data = $data->whereBetween('next_followup_date',[$getdate,date(''.$getdate.' 23:59:59')]);
                    }

                    if(isset($datanewa->date1) && !empty($datanewa->date2)) {
                        $data = $data->whereBetween('policy.expiry_date',[date('Y-m-d',strtotime($datanewa->date1)),date('Y-m-d',strtotime($datanewa->date2))]);
                    }
                    $data = $data->get();


            foreach ($data as $key => $value) {
                if($value['policy_sub_type_id']=='c7824ee08a59'){
                    $value->policy_details=FullCasco::where('full_casco_id',$value['policy_name'])->first();
                    if(isset($value->policy_details) && !empty($value->policy_details)) {
                        $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                        ->first();
                        if(!empty($temp)){
                            $value->policy_name_dtl=$temp->toArray();
                        }
                    }
                }
                elseif ($value['policy_sub_type_id']=='c1bc21cfdda9'){
                    $value->policy_details=TplEntry::where('tpl_entry_id',$value['policy_name'])->first();
                    if(isset($value->policy_details) && !empty($value->policy_details)) {
                        $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                        ->first();
                        if(!empty($temp)){
                            $value->policy_name_dtl=$temp->toArray();
                        }
                    }
                }
                elseif ($value['policy_sub_type_id']=='0ac2b7cfc696'){
                    $value->policy_details=Travel::where('travel_id',$value['policy_name'])->first();
                    if(isset($value->policy_details) && !empty($value->policy_details)) {
                        $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                        ->first();
                        if(!empty($temp)){
                            $value->policy_name_dtl=$temp->toArray();
                        }
                    }
                }
                elseif ($value['policy_sub_type_id']=='74273e1bc257'){

                    $value->policy_details=HomePolicy::where('home_policy_id',$value['policy_name'])->first();
                    if(isset($value->policy_details) && !empty($value->policy_details)) {
                        $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                        ->first();
                        if(!empty($temp)){
                            $value->policy_name_dtl=$temp->toArray();
                        }
                    }
                }
                elseif ($value['policy_sub_type_id']=='dfd3e39b733a'){
                    $value->policy_details=GreenCard::where('green_card_id',$value['policy_name'])->first();
                        if(isset($value->policy_details) && !empty($value->policy_details)) {
                            $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                            ->first();
                            if(!empty($temp)){
                                $value->policy_name_dtl=$temp->toArray();
                            }
                        }
                }
            }

            $data['tab1']=$data->toArray();






        //Today

        $dataToday = Policy::select('*','policy_sub_type.name as type_name','policy.expiry_date as renewal_date','insurer.name as insurer_name')
                    ->leftJoin('insurer', 'policy.insurer_id', '=', 'insurer.insurer_id')
                    ->leftJoin('policy_sub_type', 'policy.policy_type', '=', 'policy_sub_type.policy_sub_type_id')
                    ->leftJoin('users', 'policy.user_id', '=', 'users.user_id')
                    ->whereBetween('policy.expiry_date',[date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59')]);


                    if(isset($datanewa->insurance_company) && !empty($datanewa->insurance_company)) {
                        $dataToday = $dataToday->where('policy.insurer_id',$datanewa->insurance_company);
                    }

                    if(isset($datanewa->filter_type) && !empty($datanewa->filter_type)) {
                        $dataToday = $dataToday->where('policy.policy_type',$datanewa->filter_type);
                    }
                    if(isset($datanewa->insurance_catagory) && !empty($datanewa->insurance_catagory)) {
                        $dataToday = $dataToday->where('policy.policy_type',$datanewa->insurance_catagory);
                    }

                    if(isset($datanewa->upcomeing_status) && !empty($datanewa->upcomeing_status)) {

                        if($datanewa->upcomeing_status==1){
                            // dd("1due");
                            $dataToday = $dataToday->where('policy.expiry_date',date('Y-m-d',strtotime(' +1 day')));
                        }
                        if($datanewa->upcomeing_status==3){
                            // dd("3 exp");
                            $dataToday = $dataToday->where('policy.expiry_date','<=',date('Y-m-d'));
                        }

                    }
                    if(isset($datanewa->next_followup_date) && !empty($datanewa->next_followup_date)) {
                        $getdate = date('Y-m-d',strtotime($datanewa->next_followup_date));
                        $dataToday = $dataToday->whereBetween('next_followup_date',[$getdate,date(''.$getdate.' 23:59:59')]);
                    }

                    if(isset($datanewa->date1) && !empty($datanewa->date2)) {
                        $dataToday = $dataToday->whereBetween('policy.expiry_date',[date('Y-m-d',strtotime($datanewa->date1)),date('Y-m-d',strtotime($datanewa->date2))]);
                    }




                    $dataToday = $dataToday->get();


            foreach ($dataToday as $key => $value) {

                if($value['policy_sub_type_id']=='c7824ee08a59'){
                    $value->policy_details=FullCasco::where('full_casco_id',$value['policy_name'])->first();
                    if(isset($value->policy_details) && !empty($value->policy_details)) {
                        $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                        ->first();
                        if(!empty($temp)){
                            $value->policy_name_dtl=$temp->toArray();
                        }
                    }
                }
                elseif ($value['policy_sub_type_id']=='c1bc21cfdda9'){
                    $value->policy_details=TplEntry::where('tpl_entry_id',$value['policy_name'])->first();
                    if(isset($value->policy_details) && !empty($value->policy_details)) {
                        $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                        ->first();
                        if(!empty($temp)){
                            $value->policy_name_dtl=$temp->toArray();
                        }
                    }
                }
                elseif ($value['policy_sub_type_id']=='0ac2b7cfc696'){
                    $value->policy_details=Travel::where('travel_id',$value['policy_name'])->first();
                    if(isset($value->policy_details) && !empty($value->policy_details)) {
                        $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                        ->first();
                        if(!empty($temp)){
                            $value->policy_name_dtl=$temp->toArray();
                        }
                    }
                }
                elseif ($value['policy_sub_type_id']=='74273e1bc257'){

                    $value->policy_details=HomePolicy::where('home_policy_id',$value['policy_name'])->first();
                    if(isset($value->policy_details) && !empty($value->policy_details)) {
                        $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                        ->first();
                        if(!empty($temp)){
                            $value->policy_name_dtl=$temp->toArray();
                        }
                    }
                }
                elseif ($value['policy_sub_type_id']=='dfd3e39b733a'){
                    $value->policy_details=GreenCard::where('green_card_id',$value['policy_name'])->first();
                        if(isset($value->policy_details) && !empty($value->policy_details)) {
                            $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                            ->first();
                            if(!empty($temp)){
                                $value->policy_name_dtl=$temp->toArray();
                            }
                        }
                }
            }

        $data['tab2']=$dataToday->toArray();

        // Due Tommorow Data

        $dataTommorow = Policy::select('*','policy_sub_type.name as type_name','policy.expiry_date as renewal_date','insurer.name as insurer_name')
                    ->leftJoin('insurer', 'policy.insurer_id', '=', 'insurer.insurer_id')
                    ->leftJoin('policy_sub_type', 'policy.policy_type', '=', 'policy_sub_type.policy_sub_type_id')
                    ->leftJoin('users', 'policy.user_id', '=', 'users.user_id')
                    ->whereBetween('policy.expiry_date',[date('Y-m-d 00:00:00',strtotime(' +1 day')),date('Y-m-d 23:59:59',strtotime(' +1 day'))]);

                    if(isset($datanewa->insurance_company) && !empty($datanewa->insurance_company)) {
                        $dataTommorow = $dataTommorow->where('policy.insurer_id',$datanewa->insurance_company);
                    }

                    if(isset($datanewa->filter_type) && !empty($datanewa->filter_type)) {
                        $dataTommorow = $dataTommorow->where('policy.policy_type',$datanewa->filter_type);
                    }
                    if(isset($datanewa->insurance_catagory) && !empty($datanewa->insurance_catagory)) {
                        $dataTommorow = $dataTommorow->where('policy.policy_type',$datanewa->insurance_catagory);
                    }

                    if(isset($datanewa->upcomeing_status) && !empty($datanewa->upcomeing_status)) {

                        if($datanewa->upcomeing_status==1){
                            // dd("1due");
                            $dataTommorow = $dataTommorow->where('policy.expiry_date',date('Y-m-d',strtotime(' +1 day')));
                        }
                        if($datanewa->upcomeing_status==3){
                            // dd("3 exp");
                            $dataTommorow = $dataTommorow->where('policy.expiry_date','<=',date('Y-m-d'));
                        }

                    }
                    if(isset($datanewa->next_followup_date) && !empty($datanewa->next_followup_date)) {
                        $getdate = date('Y-m-d',strtotime($datanewa->next_followup_date));
                        $dataTommorow = $dataTommorow->whereBetween('next_followup_date',[$getdate,date(''.$getdate.' 23:59:59')]);
                    }

                    if(isset($datanewa->date1) && !empty($datanewa->date2)) {
                        $dataTommorow = $dataTommorow->whereBetween('policy.expiry_date',[date('Y-m-d',strtotime($datanewa->date1)),date('Y-m-d',strtotime($datanewa->date2))]);
                    }




                    $dataTommorow = $dataTommorow->get();

            foreach ($dataTommorow as $key => $value) {

                if($value['policy_sub_type_id']=='c7824ee08a59'){
                    $value->policy_details=FullCasco::where('full_casco_id',$value['policy_name'])->first();
                    if(isset($value->policy_details) && !empty($value->policy_details)) {
                        $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                        ->first();
                        if(!empty($temp)){
                            $value->policy_name_dtl=$temp->toArray();
                        }
                    }
                }
                elseif ($value['policy_sub_type_id']=='c1bc21cfdda9'){
                    $value->policy_details=TplEntry::where('tpl_entry_id',$value['policy_name'])->first();
                    if(isset($value->policy_details) && !empty($value->policy_details)) {
                        $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                        ->first();
                        if(!empty($temp)){
                            $value->policy_name_dtl=$temp->toArray();
                        }
                    }
                }
                elseif ($value['policy_sub_type_id']=='0ac2b7cfc696'){
                    $value->policy_details=Travel::where('travel_id',$value['policy_name'])->first();
                    if(isset($value->policy_details) && !empty($value->policy_details)) {
                        $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                        ->first();
                        if(!empty($temp)){
                            $value->policy_name_dtl=$temp->toArray();
                        }
                    }
                }
                elseif ($value['policy_sub_type_id']=='74273e1bc257'){

                    $value->policy_details=HomePolicy::where('home_policy_id',$value['policy_name'])->first();
                    if(isset($value->policy_details) && !empty($value->policy_details)) {
                        $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                        ->first();
                        if(!empty($temp)){
                            $value->policy_name_dtl=$temp->toArray();
                        }
                    }
                }
                elseif ($value['policy_sub_type_id']=='dfd3e39b733a'){
                    $value->policy_details=GreenCard::where('green_card_id',$value['policy_name'])->first();
                        if(isset($value->policy_details) && !empty($value->policy_details)) {
                            $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                            ->first();
                            if(!empty($temp)){
                                $value->policy_name_dtl=$temp->toArray();
                            }
                        }
                }
            }

        $data['tab3']=$dataTommorow->toArray();

        //Week

        $dataWeek = Policy::select('*','policy_sub_type.name as type_name','policy.expiry_date as renewal_date','insurer.name as insurer_name')
                            ->leftJoin('insurer', 'policy.insurer_id', '=', 'insurer.insurer_id')
                            ->leftJoin('policy_sub_type', 'policy.policy_type', '=', 'policy_sub_type.policy_sub_type_id')
                            ->leftJoin('users', 'policy.user_id', '=', 'users.user_id')
                            ->whereBetween('policy.expiry_date',[$this_week_sd,$this_week_ed]);

                            if(isset($datanewa->insurance_company) && !empty($datanewa->insurance_company)) {
                                $dataWeek = $dataWeek->where('policy.insurer_id',$datanewa->insurance_company);
                            }

                            if(isset($datanewa->filter_type) && !empty($datanewa->filter_type)) {
                                $dataWeek = $dataWeek->where('policy.policy_type',$datanewa->filter_type);
                            }
                            if(isset($datanewa->insurance_catagory) && !empty($datanewa->insurance_catagory)) {
                                $dataWeek = $dataWeek->where('policy.policy_type',$datanewa->insurance_catagory);
                            }

                            if(isset($datanewa->upcomeing_status) && !empty($datanewa->upcomeing_status)) {

                                if($datanewa->upcomeing_status==1){
                                    // dd("1due");
                                    $dataWeek = $dataWeek->where('policy.expiry_date',date('Y-m-d',strtotime(' +1 day')));
                                }
                                if($datanewa->upcomeing_status==3){
                                    // dd("3 exp");
                                    $dataWeek = $dataWeek->where('policy.expiry_date','<=',date('Y-m-d'));
                                }

                            }
                            if(isset($datanewa->next_followup_date) && !empty($datanewa->next_followup_date)) {
                                $getdate = date('Y-m-d',strtotime($datanewa->next_followup_date));
                                $dataWeek = $dataWeek->whereBetween('next_followup_date',[$getdate,date(''.$getdate.' 23:59:59')]);
                            }

                            if(isset($datanewa->date1) && !empty($datanewa->date2)) {
                                $dataWeek = $dataWeek->whereBetween('policy.expiry_date',[date('Y-m-d',strtotime($datanewa->date1)),date('Y-m-d',strtotime($datanewa->date2))]);
                            }




                            $dataWeek = $dataWeek->get();
                    foreach ($dataWeek as $key => $value) {


                        if($value['policy_sub_type_id']=='c7824ee08a59'){
                            $value->policy_details=FullCasco::where('full_casco_id',$value['policy_name'])->first();
                            if(isset($value->policy_details) && !empty($value->policy_details)) {
                                $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                ->first();
                                if(!empty($temp)){
                                    $value->policy_name_dtl=$temp->toArray();
                                }
                            }
                        }
                        elseif ($value['policy_sub_type_id']=='c1bc21cfdda9'){
                            $value->policy_details=TplEntry::where('tpl_entry_id',$value['policy_name'])->first();
                            if(isset($value->policy_details) && !empty($value->policy_details)) {
                                $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                ->first();
                                if(!empty($temp)){
                                    $value->policy_name_dtl=$temp->toArray();
                                }
                            }
                        }
                        elseif ($value['policy_sub_type_id']=='0ac2b7cfc696'){
                            $value->policy_details=Travel::where('travel_id',$value['policy_name'])->first();
                            if(isset($value->policy_details) && !empty($value->policy_details)) {
                                $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                ->first();
                                if(!empty($temp)){
                                    $value->policy_name_dtl=$temp->toArray();
                                }
                            }
                        }
                        elseif ($value['policy_sub_type_id']=='74273e1bc257'){

                            $value->policy_details=HomePolicy::where('home_policy_id',$value['policy_name'])->first();
                            if(isset($value->policy_details) && !empty($value->policy_details)) {
                                $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                ->first();
                                if(!empty($temp)){
                                    $value->policy_name_dtl=$temp->toArray();
                                }
                            }
                        }
                        elseif ($value['policy_sub_type_id']=='dfd3e39b733a'){
                            $value->policy_details=GreenCard::where('green_card_id',$value['policy_name'])->first();
                                if(isset($value->policy_details) && !empty($value->policy_details)) {
                                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                    ->first();
                                    if(!empty($temp)){
                                        $value->policy_name_dtl=$temp->toArray();
                                    }
                                }
                        }


                    }

        $data['tab4']=$dataWeek->toArray();

        // Due month wise

        $dataMonth = Policy::select('*','policy_sub_type.name as type_name','policy.expiry_date as renewal_date','insurer.name as insurer_name')
                            ->leftJoin('insurer', 'policy.insurer_id', '=', 'insurer.insurer_id')
                            ->leftJoin('policy_sub_type', 'policy.policy_type', '=', 'policy_sub_type.policy_sub_type_id')
                            ->leftJoin('users', 'policy.user_id', '=', 'users.user_id')
                            ->whereYear('policy.expiry_date', date('yy'))
                            ->whereMonth('policy.expiry_date', date('m'));

                            if(isset($datanewa->insurance_company) && !empty($datanewa->insurance_company)) {
                                $dataMonth = $dataMonth->where('policy.insurer_id',$datanewa->insurance_company);
                            }

                            if(isset($datanewa->filter_type) && !empty($datanewa->filter_type)) {
                                $dataMonth = $dataMonth->where('policy.policy_type',$datanewa->filter_type);
                            }
                            if(isset($datanewa->insurance_catagory) && !empty($datanewa->insurance_catagory)) {
                                $dataMonth = $dataMonth->where('policy.policy_type',$datanewa->insurance_catagory);
                            }

                            if(isset($datanewa->upcomeing_status) && !empty($datanewa->upcomeing_status)) {

                                if($datanewa->upcomeing_status==1){
                                    // dd("1due");
                                    $dataMonth = $dataMonth->where('policy.expiry_date',date('Y-m-d',strtotime(' +1 day')));
                                }
                                if($datanewa->upcomeing_status==3){
                                    // dd("3 exp");
                                    $dataMonth = $dataMonth->where('policy.expiry_date','<=',date('Y-m-d'));
                                }

                            }
                            if(isset($datanewa->next_followup_date) && !empty($datanewa->next_followup_date)) {
                                $getdate = date('Y-m-d',strtotime($datanewa->next_followup_date));
                                $dataMonth = $dataMonth->whereBetween('next_followup_date',[$getdate,date(''.$getdate.' 23:59:59')]);
                            }

                            if(isset($datanewa->date1) && !empty($datanewa->date2)) {
                                $dataMonth = $dataMonth->whereBetween('policy.expiry_date',[date('Y-m-d',strtotime($datanewa->date1)),date('Y-m-d',strtotime($datanewa->date2))]);
                            }


                            $dataMonth = $dataMonth->get();
                    foreach ($dataMonth as $key => $value) {
                        if($value['policy_sub_type_id']=='c7824ee08a59'){
                            $value->policy_details=FullCasco::where('full_casco_id',$value['policy_name'])->first();
                            if(isset($value->policy_details) && !empty($value->policy_details)) {
                                $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                ->first();
                                if(!empty($temp)){
                                    $value->policy_name_dtl=$temp->toArray();
                                }
                            }
                        }
                        elseif ($value['policy_sub_type_id']=='c1bc21cfdda9'){
                            $value->policy_details=TplEntry::where('tpl_entry_id',$value['policy_name'])->first();
                            if(isset($value->policy_details) && !empty($value->policy_details)) {
                                $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                ->first();
                                if(!empty($temp)){
                                    $value->policy_name_dtl=$temp->toArray();
                                }
                            }
                        }
                        elseif ($value['policy_sub_type_id']=='0ac2b7cfc696'){
                            $value->policy_details=Travel::where('travel_id',$value['policy_name'])->first();
                            if(isset($value->policy_details) && !empty($value->policy_details)) {
                                $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                ->first();
                                if(!empty($temp)){
                                    $value->policy_name_dtl=$temp->toArray();
                                }
                            }
                        }
                        elseif ($value['policy_sub_type_id']=='74273e1bc257'){

                            $value->policy_details=HomePolicy::where('home_policy_id',$value['policy_name'])->first();
                            if(isset($value->policy_details) && !empty($value->policy_details)) {
                                $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                ->first();
                                if(!empty($temp)){
                                    $value->policy_name_dtl=$temp->toArray();
                                }
                            }
                        }
                        elseif ($value['policy_sub_type_id']=='dfd3e39b733a'){
                            $value->policy_details=GreenCard::where('green_card_id',$value['policy_name'])->first();
                                if(isset($value->policy_details) && !empty($value->policy_details)) {
                                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                    ->first();
                                    if(!empty($temp)){
                                        $value->policy_name_dtl=$temp->toArray();
                                    }
                                }
                        }
                    }

                    // dd($dataMonth);

        $data['tab5']=$dataMonth->toArray();



        // overdue date

        $dataOverdue = Policy::select('*','policy_sub_type.name as type_name','policy.expiry_date as renewal_date','insurer.name as insurer_name')
                            ->leftJoin('insurer', 'policy.insurer_id', '=', 'insurer.insurer_id')
                            ->leftJoin('policy_sub_type', 'policy.policy_type', '=', 'policy_sub_type.policy_sub_type_id')
                            ->leftJoin('users', 'policy.user_id', '=', 'users.user_id')
                            ->whereDate('policy.expiry_date', '<', date('Y-m-d 00:00:00'));

                            if(isset($datanewa->insurance_company) && !empty($datanewa->insurance_company)) {
                                $dataOverdue = $dataOverdue->where('policy.insurer_id',$datanewa->insurance_company);
                            }

                            if(isset($datanewa->filter_type) && !empty($datanewa->filter_type)) {
                                $dataOverdue = $dataOverdue->where('policy.policy_type',$datanewa->filter_type);
                            }
                            if(isset($datanewa->insurance_catagory) && !empty($datanewa->insurance_catagory)) {
                                $dataOverdue = $dataOverdue->where('policy.policy_type',$datanewa->insurance_catagory);
                            }

                            if(isset($datanewa->upcomeing_status) && !empty($datanewa->upcomeing_status)) {

                                if($datanewa->upcomeing_status==1){
                                    // dd("1due");
                                    $dataOverdue = $dataOverdue->where('policy.expiry_date',date('Y-m-d',strtotime(' +1 day')));
                                }
                                if($datanewa->upcomeing_status==3){
                                    // dd("3 exp");
                                    $dataOverdue = $dataOverdue->where('policy.expiry_date','<=',date('Y-m-d'));
                                }

                            }
                            if(isset($datanewa->next_followup_date) && !empty($datanewa->next_followup_date)) {
                                $getdate = date('Y-m-d',strtotime($datanewa->next_followup_date));
                                $dataOverdue = $dataOverdue->whereBetween('next_followup_date',[$getdate,date(''.$getdate.' 23:59:59')]);
                            }

                            if(isset($datanewa->date1) && !empty($datanewa->date2)) {
                                $dataOverdue = $dataOverdue->whereBetween('policy.expiry_date',[date('Y-m-d',strtotime($datanewa->date1)),date('Y-m-d',strtotime($datanewa->date2))]);
                            }


                            $dataOverdue = $dataOverdue->get();

                    foreach ($dataOverdue as $key => $value) {
                        if($value['policy_sub_type_id']=='c7824ee08a59'){
                            $value->policy_details=FullCasco::where('full_casco_id',$value['policy_name'])->first();
                            if(isset($value->policy_details) && !empty($value->policy_details)) {
                                $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                ->first();
                                if(!empty($temp)){
                                    $value->policy_name_dtl=$temp->toArray();
                                }
                            }
                        }
                        elseif ($value['policy_sub_type_id']=='c1bc21cfdda9'){
                            $value->policy_details=TplEntry::where('tpl_entry_id',$value['policy_name'])->first();
                            if(isset($value->policy_details) && !empty($value->policy_details)) {
                                $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                ->first();
                                if(!empty($temp)){
                                    $value->policy_name_dtl=$temp->toArray();
                                }
                            }
                        }
                        elseif ($value['policy_sub_type_id']=='0ac2b7cfc696'){
                            $value->policy_details=Travel::where('travel_id',$value['policy_name'])->first();
                            if(isset($value->policy_details) && !empty($value->policy_details)) {
                                $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                ->first();
                                if(!empty($temp)){
                                    $value->policy_name_dtl=$temp->toArray();
                                }
                            }
                        }
                        elseif ($value['policy_sub_type_id']=='74273e1bc257'){

                            $value->policy_details=HomePolicy::where('home_policy_id',$value['policy_name'])->first();
                            if(isset($value->policy_details) && !empty($value->policy_details)) {
                                $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                ->first();
                                if(!empty($temp)){
                                    $value->policy_name_dtl=$temp->toArray();
                                }
                            }
                        }
                        elseif ($value['policy_sub_type_id']=='dfd3e39b733a'){
                            $value->policy_details=GreenCard::where('green_card_id',$value['policy_name'])->first();
                                if(isset($value->policy_details) && !empty($value->policy_details)) {
                                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                    ->first();
                                    if(!empty($temp)){
                                        $value->policy_name_dtl=$temp->toArray();
                                    }
                                }
                        }
                    }

                    // dd($dataMonth);

        $data['tab6']=$dataOverdue->toArray();


        // Today FollowUp Data

        $dataFollowup = Policy::select('*','policy_sub_type.name as type_name','policy.expiry_date as renewal_date','insurer.name as insurer_name')
                            ->leftJoin('insurer', 'policy.insurer_id', '=', 'insurer.insurer_id')
                            ->leftJoin('policy_sub_type', 'policy.policy_type', '=', 'policy_sub_type.policy_sub_type_id')
                            ->leftJoin('users', 'policy.user_id', '=', 'users.user_id')
                            ->whereBetween('next_followup_date',[date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59')]);

                            if(isset($datanewa->insurance_company) && !empty($datanewa->insurance_company)) {
                                $dataFollowup = $dataFollowup->where('policy.insurer_id',$datanewa->insurance_company);
                            }

                            if(isset($datanewa->filter_type) && !empty($datanewa->filter_type)) {
                                $dataFollowup = $dataFollowup->where('policy.policy_type',$datanewa->filter_type);
                            }
                            if(isset($datanewa->insurance_catagory) && !empty($datanewa->insurance_catagory)) {
                                $dataFollowup = $dataFollowup->where('policy.policy_type',$datanewa->insurance_catagory);
                            }

                            if(isset($datanewa->upcomeing_status) && !empty($datanewa->upcomeing_status)) {

                                if($datanewa->upcomeing_status==1){
                                    // dd("1due");
                                    $dataFollowup = $dataFollowup->where('policy.expiry_date',date('Y-m-d',strtotime(' +1 day')));
                                }
                                if($datanewa->upcomeing_status==3){
                                    // dd("3 exp");
                                    $dataFollowup = $dataFollowup->where('policy.expiry_date','<=',date('Y-m-d'));
                                }

                            }
                            if(isset($datanewa->next_followup_date) && !empty($datanewa->next_followup_date)) {
                                $getdate = date('Y-m-d',strtotime($datanewa->next_followup_date));
                                $dataFollowup = $dataFollowup->whereBetween('next_followup_date',[$getdate,date(''.$getdate.' 23:59:59')]);
                            }

                            if(isset($datanewa->date1) && !empty($datanewa->date2)) {
                                $dataFollowup = $dataFollowup->whereBetween('policy.expiry_date',[date('Y-m-d',strtotime($datanewa->date1)),date('Y-m-d',strtotime($datanewa->date2))]);
                            }


                            $dataFollowup = $dataFollowup->get();
                    foreach ($dataFollowup as $key => $value) {
                        if($value['policy_sub_type_id']=='c7824ee08a59'){
                            $value->policy_details=FullCasco::where('full_casco_id',$value['policy_name'])->first();
                            if(isset($value->policy_details) && !empty($value->policy_details)) {
                                $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                ->first();
                                if(!empty($temp)){
                                    $value->policy_name_dtl=$temp->toArray();
                                }
                            }
                        }
                        elseif ($value['policy_sub_type_id']=='c1bc21cfdda9'){
                            $value->policy_details=TplEntry::where('tpl_entry_id',$value['policy_name'])->first();
                            if(isset($value->policy_details) && !empty($value->policy_details)) {
                                $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                ->first();
                                if(!empty($temp)){
                                    $value->policy_name_dtl=$temp->toArray();
                                }
                            }
                        }
                        elseif ($value['policy_sub_type_id']=='0ac2b7cfc696'){
                            $value->policy_details=Travel::where('travel_id',$value['policy_name'])->first();
                            if(isset($value->policy_details) && !empty($value->policy_details)) {
                                $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                ->first();
                                if(!empty($temp)){
                                    $value->policy_name_dtl=$temp->toArray();
                                }
                            }
                        }
                        elseif ($value['policy_sub_type_id']=='74273e1bc257'){

                            $value->policy_details=HomePolicy::where('home_policy_id',$value['policy_name'])->first();
                            if(isset($value->policy_details) && !empty($value->policy_details)) {
                                $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                ->first();
                                if(!empty($temp)){
                                    $value->policy_name_dtl=$temp->toArray();
                                }
                            }
                        }
                        elseif ($value['policy_sub_type_id']=='dfd3e39b733a'){
                            $value->policy_details=GreenCard::where('green_card_id',$value['policy_name'])->first();
                                if(isset($value->policy_details) && !empty($value->policy_details)) {
                                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                    ->first();
                                    if(!empty($temp)){
                                        $value->policy_name_dtl=$temp->toArray();
                                    }
                                }
                        }
                    }

                    // dd($dataMonth);

        $data['tab7']=$dataFollowup->toArray();



        return view('dashboard.upcoming-policy',compact('data','Insurerdata','policySubType','insurer_policy'));
    }
    public function getShowConvertedPolicy()
    {

        $Insurerdata=Insurer::all();
        $policySubType=PolicySubType::all();

        $policyIdPluck=Policy::select('*','policy.policy_id as policy_id')
        ->leftJoin('transaction', 'policy.policy_id', '=', 'transaction.policy_id')
        ->leftJoin('paypal_transaction', 'policy.policy_id', '=', 'paypal_transaction.policy_id')
        ->where('transaction.payment_status','success')
        ->orWhere('paypal_transaction.Paypal_status','COMPLETED');
        $dataPluck = $policyIdPluck->get()->pluck('policy_id');

        $data=Policy::select('*','policy_sub_type.name as type_name','insurer.name as insurer_name','policy.start_date as policy_date','policy.id as main_id')

        ->leftJoin('policy_sub_type', 'policy.policy_type', '=', 'policy_sub_type.policy_sub_type_id')
        ->leftJoin('insurer', 'policy.insurer_id', '=', 'insurer.insurer_id')
        ->leftJoin('users', 'policy.user_id', '=', 'users.user_id')
        ->where('policy_id',[$dataPluck])
        ->get();
        return view('dashboard.converted-policy',compact('data','Insurerdata','policySubType'));
    }

    public function getShowFailedPolicy()
    {
        
        $Insurerdata=Insurer::all();
        $policySubType=PolicySubType::all();
        return view('dashboard.failed-policy',compact('Insurerdata','policySubType'));
    }


    public function getConvertedData(Request $request,$id='')
    {
        $bktFailedPolicy = Policy::select('policy.policy_id')->join('transaction','transaction.policy_id','policy.policy_id')
        ->where(function ($query) {
            $query->whereIN('payment_status',['Failed'])
            ->orWhereNull('payment_status');
        });
        $allFailedPolicyId = Policy::select('policy.policy_id')->join('paypal_transaction','paypal_transaction.policy_id','policy.policy_id')
                            ->whereNotIN('Paypal_status',['COMPLETED'])->union($bktFailedPolicy)->pluck('policy_id');
        $dataPluckConverted = $allFailedPolicyId;

        if($id!=''){
            $datanewa=json_decode(base64_decode($id));
        }

        $input = $request->input();
        
        $policy=Policy::select('*','policy.policy_id','policy_sub_type.name as type_name','insurer.name as insurer_name','policy.created_at as policy_date','policy.id as main_id')

        ->leftJoin('policy_sub_type', 'policy.policy_type', '=', 'policy_sub_type.policy_sub_type_id')
        ->leftJoin('insurer', 'policy.insurer_id', '=', 'insurer.insurer_id')
        ->leftJoin('users', 'policy.user_id', '=', 'users.user_id');
        // ->whereNotIn('policy.policy_id',$dataPluckConverted);
            
        if(isset($datanewa->insurance_company) && !empty($datanewa->insurance_company)) {
            $policy = $policy->where('policy.insurer_id',$datanewa->insurance_company);
        }
        if(isset($datanewa->filter_type) && !empty($datanewa->filter_type)) {
            $policy = $policy->where('policy.policy_type',$datanewa->filter_type);
        }
        if(isset($datanewa->policy_status) && !empty($datanewa->policy_status)) {
            $policy = $policy->where('policy.status_tracking',$datanewa->policy_status);
        }
        if(isset($datanewa->date1) && !empty($datanewa->date2)) {
            $policy = $policy->whereBetween('policy.expiry_date',[date('Y-m-d',strtotime($datanewa->date1)),date('Y-m-d',strtotime($datanewa->date2))]);
        }
        $policy = $policy->whereNotIn('policy.policy_id',$dataPluckConverted);
        $data = $policy->get();
       
        foreach ($data as $key => $value) {
            $value->dd_status=Status_tracking::where('entity_id',$value->policy_id)->where('entity','policy')->orderBy('id','DESC')->first();
            $value->dd_all_status=Status_tracking::where('entity_id',$value->policy_id)->where('entity','policy')->get();
            $value->driver_all_data=DriverDetails::where('policy_id',$value->policy_id)->first();

            if($value['policy_sub_type_id']=='c7824ee08a59'){
                $value->policy_details=FullCasco::where('full_casco_id',$value['policy_name'])->first();

                $car_details = Car::where('policy_id','LIKE',"%$value->policy_id%")->select('car_registration_number as object_1','car_tpye')->first();

                if(!empty($car_details['car_tpye']))
                {
                    $id = $car_details['car_tpye'];
                }
                else{
                    $id = "5387b8bf5632";
                }

                $car_type = TplType::where('tpl_type_id',$id)->first();
                // dd($car_type);
                $offer = Offers::where('offers_id',$value['offer'])->first();

                $value->offer_details = !empty($offer)?$offer['offer_name']:"-";

                $value->object_details_one = $car_details;

                $get_full_casco_varient = FullCascoType::where('casco_type_id',$value['variant'])->first();

                $value->varient_type = !empty($get_full_casco_varient['varient_name'])?$get_full_casco_varient['varient_name']:"-";
                // $value->object_details_two = $car_type;
                $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                ->first();
                if(!empty($temp)){
                    $value->policy_name_dtl=$temp->toArray();
                }
            }
            elseif ($value['policy_sub_type_id']=='c1bc21cfdda9'){
                $value->policy_details=TplEntry::where('tpl_entry_id',$value['policy_name'])->first();

                $car_details = Car::where('policy_id','LIKE',"%$value->policy_id%")->select('car_registration_number as object_1','car_tpye')->first();
                if(!empty($car_details['car_tpye']))
                {
                    $id = $car_details['car_tpye'];
                }
                else{
                    $id = "5387b8bf5632";
                }
                $offer = Offers::where('offers_id',$value['offer'])->first();
                $value->offer_details = !empty($offer)?$offer['offer_name']:"-";
                $car_type = TplType::where('tpl_type_id',$id)->select('name as object_2')->first();
                $value->object_details_one = $car_details;
                $value->varient_type = !empty($car_type['name'])?$car_type['name']:"-";
                $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                ->first();
                if(!empty($temp)){
                    $value->policy_name_dtl=$temp->toArray();
                }
            }
            elseif ($value['policy_sub_type_id']=='0ac2b7cfc696'){

                $value->policy_details=Travel::where('travel_id',$value['policy_name'])->first();
                $value->varient_type = !empty( $value->policy_details['age_group'])? $value->policy_details['age_group']:"-";
                $value->object_details_one = Travel::where('travel_id',$value['policy_name'])->select('zone as object_1')->first();
                $value->object_details_two = TravelPolicyType::where('policy_id',$value->policy_id)->select('date_of_birth as object_2')->first();
                $offer = Offers::where('offers_id',$value['offer'])->first();
                $value->offer_details = !empty($offer)?$offer['offer_name']:"-";
                if(isset($value->policy_details) && !empty($value->policy_details)) {
                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                       
        
                    }
                    // dd($value->policy_details);
                   
                }
               
            }
            elseif ($value['policy_sub_type_id']=='69e21f9783bd'){

                $value->policy_details=Travel::where('travel_id',$value['policy_name'])->first();
                $value->varient_type = !empty( $value->policy_details['age_group'])? $value->policy_details['age_group']:"-";
                $value->object_details_one = Travel::where('travel_id',$value['policy_name'])->select('zone as object_1')->first();
                $value->object_details_two = TravelPolicyType::where('policy_id',$value->policy_id)->select('date_of_birth as object_2')->first();
                $offer = Offers::where('offers_id',$value['offer'])->first();
                $value->offer_details = !empty($offer)?$offer['offer_name']:"-";
                if(isset($value->policy_details) && !empty($value->policy_details)) {
                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                       
        
                    }
                    // dd($value->policy_details);
                   
                }
               
            }
            elseif ($value['policy_sub_type_id']=='74273e1bc257'){

                $value->policy_details=HomePolicy::where('home_policy_id',$value['policy_name'])->first();

                if(!empty($value->policy_details))
                {
                    $home_sub_type = HomePolicyType::where('home_sub_type_id', $value->policy_details['home_sub_type_id'])->first();
                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                }
               
                $value->varient_type = !empty($home_sub_type['name'])?$home_sub_type['name']:"-";

                $offer = Offers::where('offers_id',$value['offer'])->first();

                $value->offer_details = !empty($offer['offer_name'])?$offer['offer_name']:"-";

                // dd($value->varient_type);
               

                $value->object_details = Property::where('policy_id',$value->policy_id)->select('square as object')->first();
                if(!empty($temp)){
                    $value->policy_name_dtl=$temp->toArray();
                }

               $home=Property::where('policy_id',$value->policy_id)->select('square as object_1')->first();

                $value->object_details_one =!empty($home)?$home:"-";

                $value->object_details_two = Property::where('policy_id',$value->policy_id)->select('date_of_birth as object_2')->first();
            }
            elseif ($value['policy_sub_type_id']=='dfd3e39b733a'){

                $value->policy_details=GreenCard::where('green_card_id',$value['policy_name'])->first();

                $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])->first();

                $car_details = Car::where('policy_id','LIKE',"%$value->policy_id%")->select('car_registration_number as object_1','car_tpye')->first();
                $offer = Offers::where('offers_id',$value['offer'])->first();
                $value->offer_details = !empty($offer)?$offer['offer_name']:"-";

                //vechile type 
                $car_type_array =[
                    'Cars'=>'c21ff7205d80',
                    'Bikes up to 150cc'=>'a997fda1e2b4',
                    'Bikes more than 150cc'=>'ab2a4c146fa1',
                    'Loading Vehicle 15kv to 34.99kv'=>'491755a78240',
                    'Loading Vehicle more than 34.99kv'=>'75499efa929f',
                    'Ambulances,Funeral,cars'=>'c238d6dbf991',
                    'Cyclomotor'=>'981cc8a302d9',
                    'Bus 9+1 to 18+1'=>'40635dbf8dd5',
                    'Bus 19+1 to 28+1'=>'639a891bafd3',
                    'Bus 29+1 and up'=>'852fc65713dd',
                    'Truck Trailer'=>'c95c1b249a5a',
                    'Bus Trailer'=>'caef4d83c891',
                    'Other trailers'=>'601902a5633f',
                    'Cars Up to 8 seats & 3.4 tons'=>'f6f672b44ca4',
                    'Bikes up to 150cc'=>'e7b38f7c61f1',
                    'Bikes more than 150cc'=>'0c1c1846a382',
                    'Loading Vehicle more than 34.99kv'=>'da1462ce1285',
                    'Ambulances,Funeral cars'=>'ab2010d41bbc',
                    'Bus 19+1 to 28+1'=>'396ab962b76a',
                    'Truck Trailer'=>'9f43393b29cd',
                    'Other trailers'=>'055cdfc9c9cc',
                    'Car'=>'5387b8bf5632',
                    'Bike'=>'d931b542bcad',
                    'Car engine'=>'d88ed7fda1fa',
                    'Vans/Microbus Seats'=>'0c0361f6647e',
                    'Bus'=>'22b8a3a60595',
                    'Trucks'=>'bacb3f1ffff6',
                    'Trailer'=>'c32b0536df2f',
                    'Agricultural Vehicle'=>'497a41074388',
                    'Firefighter'=>'a51933d621cb'
                ];
                $car_type = !empty($car_details['car_tpye'])?array_search($car_details['car_tpye'],$car_type_array):"-";

                $_regitration_no = !empty($car_details['object_1'])?$car_details['object_1']:"-";
                $_details_of_object =[
                    'object_1'=>$_regitration_no."/".$car_type
                ];
                
                $value->object_details_one = $_details_of_object;
                $value->varient_type = !empty($value->policy_details['green_card_type'])?$value->policy_details['green_card_type']:"-";
                if(!empty($temp)){
                    $value->policy_name_dtl=$temp->toArray();
                }
            }
        }
        // dd($data[7]);

        return response()->json(array('data'=>$data));

    }


    public function getFailedData(Request $request,$id='')
    {
       
        if($id!=''){
            $datanewa=json_decode(base64_decode($id));
        }

        $input = $request->input();
        $bktFailedPolicy = Policy::select('policy.policy_id')->join('transaction','transaction.policy_id','policy.policy_id')
        ->where(function ($query) {
            $query->whereIN('payment_status',['Failed'])
            ->orWhereNull('payment_status');
        });
        $allFailedPolicyId = Policy::select('policy.policy_id')->join('paypal_transaction','paypal_transaction.policy_id','policy.policy_id')
                            ->whereNotIN('Paypal_status',['COMPLETED'])->union($bktFailedPolicy)->pluck('policy_id');

        $dataPluck = $allFailedPolicyId;
        
        $dataPluck = $allFailedPolicyId;


        $policy=Policy::select('*','policy.policy_id as policy_id','policy_sub_type.name as type_name','insurer.name as insurer_name','policy.created_at as policy_date','policy.id as main_id')

        ->leftJoin('policy_sub_type', 'policy.policy_type', '=', 'policy_sub_type.policy_sub_type_id')
        ->leftJoin('insurer', 'policy.insurer_id', '=', 'insurer.insurer_id')
        ->leftJoin('users', 'policy.user_id', '=', 'users.user_id')
        ->leftJoin('transaction', 'policy.policy_id', '=', 'transaction.policy_id')
        ->leftJoin('paypal_transaction', 'policy.policy_id', '=', 'paypal_transaction.policy_id')
        ->whereIn('policy.policy_id',$dataPluck);
            
        if(isset($datanewa->insurance_company) && !empty($datanewa->insurance_company)) {
            $policy = $policy->where('policy.insurer_id',$datanewa->insurance_company);
        }
        if(isset($datanewa->filter_type) && !empty($datanewa->filter_type)) {
            $policy = $policy->where('policy.policy_type',$datanewa->filter_type);
        }
        if(isset($datanewa->policy_status) && !empty($datanewa->policy_status)) {
            $policy = $policy->where('policy.status_tracking',$datanewa->policy_status);
        }
        if(isset($datanewa->date1) && !empty($datanewa->date2)) {
            $policy = $policy->whereBetween('policy.expiry_date',[date('Y-m-d',strtotime($datanewa->date1)),date('Y-m-d',strtotime($datanewa->date2))]);
        }
        $data = null;
        if(count($dataPluck)>0){
            // $policy->whereNotIn('policy.policy
            $policesdata = $policy->get();
            
             $uniqueHotels=[];
            if(!empty($policesdata)){

                $uniqueHotels = array();

                foreach($policesdata as $hotel) {
                    $niddle = $hotel['main_id'];
                    if(array_key_exists($niddle, $uniqueHotels)) continue;
                    $uniqueHotels[$niddle] = $hotel;
                }
                
                $data = $uniqueHotels;
            }
            foreach ($data as $key => $value) {
                $value->dd_status=Status_tracking::where('entity_id',$value->policy_id)->where('entity','policy')->orderBy('id','DESC')->first();
                $value->dd_all_status=Status_tracking::where('entity_id',$value->policy_id)->where('entity','policy')->get();
                $value->driver_all_data=DriverDetails::where('policy_id',$value->policy_id)->first();
    
                if($value['policy_sub_type_id']=='c7824ee08a59'){
                    $value->policy_details=FullCasco::where('full_casco_id',$value['policy_name'])->first();
    
                    $car_details = Car::where('policy_id','LIKE',"%$value->policy_id%")->select('car_registration_number as object_1','car_tpye')->first();
    
                    if(!empty($car_details['car_tpye']))
                    {
                        $id = $car_details['car_tpye'];
                    }
                    else{
                        $id = "5387b8bf5632";
                    }
    
                    $car_type = TplType::where('tpl_type_id',$id)->first();
                    // dd($car_type);
                    $offer = Offers::where('offers_id',$value['offer'])->first();
    
                    $value->offer_details = !empty($offer)?$offer['offer_name']:"-";
    
                    $value->object_details_one = $car_details;
    
                    $get_full_casco_varient = FullCascoType::where('casco_type_id',$value['variant'])->first();
    
                    $value->varient_type = !empty($get_full_casco_varient['varient_name'])?$get_full_casco_varient['varient_name']:"-";
                    // $value->object_details_two = $car_type;
                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                }
                elseif ($value['policy_sub_type_id']=='c1bc21cfdda9'){
                    $value->policy_details=TplEntry::where('tpl_entry_id',$value['policy_name'])->first();
    
                    $car_details = Car::where('policy_id','LIKE',"%$value->policy_id%")->select('car_registration_number as object_1','car_tpye')->first();
                    if(!empty($car_details['car_tpye']))
                    {
                        $id = $car_details['car_tpye'];
                    }
                    else{
                        $id = "5387b8bf5632";
                    }
                    $offer = Offers::where('offers_id',$value['offer'])->first();
                    $value->offer_details = !empty($offer)?$offer['offer_name']:"-";
                    $car_type = TplType::where('tpl_type_id',$id)->select('name as object_2')->first();
                    $value->object_details_one = $car_details;
                    $value->varient_type = !empty($car_type['name'])?$car_type['name']:"-";
                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                }
                elseif ($value['policy_sub_type_id']=='0ac2b7cfc696'){
    
                    $value->policy_details=Travel::where('travel_id',$value['policy_name'])->first();
                    $value->varient_type = !empty( $value->policy_details['age_group'])? $value->policy_details['age_group']:"-";
                    $value->object_details_one = Travel::where('travel_id',$value['policy_name'])->select('zone as object_1')->first();
                    $value->object_details_two = TravelPolicyType::where('policy_id',$value->policy_id)->select('date_of_birth as object_2')->first();
                    $offer = Offers::where('offers_id',$value['offer'])->first();
                    $value->offer_details = !empty($offer)?$offer['offer_name']:"-";
                    if(isset($value->policy_details) && !empty($value->policy_details)) {
                        $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                        ->first();
                        if(!empty($temp)){
                            $value->policy_name_dtl=$temp->toArray();
                           
            
                        }
                        // dd($value->policy_details);
                       
                    }
                   
                }
                elseif ($value['policy_sub_type_id']=='69e21f9783bd'){
    
                    $value->policy_details=Travel::where('travel_id',$value['policy_name'])->first();
                    $value->varient_type = !empty( $value->policy_details['age_group'])? $value->policy_details['age_group']:"-";
                    $value->object_details_one = Travel::where('travel_id',$value['policy_name'])->select('zone as object_1')->first();
                    $value->object_details_two = TravelPolicyType::where('policy_id',$value->policy_id)->select('date_of_birth as object_2')->first();
                    $offer = Offers::where('offers_id',$value['offer'])->first();
                    $value->offer_details = !empty($offer)?$offer['offer_name']:"-";
                    if(isset($value->policy_details) && !empty($value->policy_details)) {
                        $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                        ->first();
                        if(!empty($temp)){
                            $value->policy_name_dtl=$temp->toArray();
                           
            
                        }
                        // dd($value->policy_details);
                       
                    }
                   
                }
                elseif ($value['policy_sub_type_id']=='74273e1bc257'){
    
                    $value->policy_details=HomePolicy::where('home_policy_id',$value['policy_name'])->first();
    
                    if(!empty($value->policy_details))
                    {
                        $home_sub_type = HomePolicyType::where('home_sub_type_id', $value->policy_details['home_sub_type_id'])->first();
                        $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                        ->first();
                    }
                   
                    $value->varient_type = !empty($home_sub_type['name'])?$home_sub_type['name']:"-";
    
                    $offer = Offers::where('offers_id',$value['offer'])->first();
    
                    $value->offer_details = !empty($offer['offer_name'])?$offer['offer_name']:"-";
    
                    // dd($value->varient_type);
                   
    
                    $value->object_details = Property::where('policy_id',$value->policy_id)->select('square as object')->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
    
                   $home=Property::where('policy_id',$value->policy_id)->select('square as object_1')->first();
    
                    $value->object_details_one =!empty($home)?$home:"-";
    
                    $value->object_details_two = Property::where('policy_id',$value->policy_id)->select('date_of_birth as object_2')->first();
                }
                elseif ($value['policy_sub_type_id']=='dfd3e39b733a'){
    
                    $value->policy_details=GreenCard::where('green_card_id',$value['policy_name'])->first();
    
                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])->first();
    
                    $car_details = Car::where('policy_id','LIKE',"%$value->policy_id%")->select('car_registration_number as object_1','car_tpye')->first();
                    $offer = Offers::where('offers_id',$value['offer'])->first();
                    $value->offer_details = !empty($offer)?$offer['offer_name']:"-";
    
                    //vechile type 
                    $car_type_array =[
                        'Cars'=>'c21ff7205d80',
                        'Bikes up to 150cc'=>'a997fda1e2b4',
                        'Bikes more than 150cc'=>'ab2a4c146fa1',
                        'Loading Vehicle 15kv to 34.99kv'=>'491755a78240',
                        'Loading Vehicle more than 34.99kv'=>'75499efa929f',
                        'Ambulances,Funeral,cars'=>'c238d6dbf991',
                        'Cyclomotor'=>'981cc8a302d9',
                        'Bus 9+1 to 18+1'=>'40635dbf8dd5',
                        'Bus 19+1 to 28+1'=>'639a891bafd3',
                        'Bus 29+1 and up'=>'852fc65713dd',
                        'Truck Trailer'=>'c95c1b249a5a',
                        'Bus Trailer'=>'caef4d83c891',
                        'Other trailers'=>'601902a5633f',
                        'Cars Up to 8 seats & 3.4 tons'=>'f6f672b44ca4',
                        'Bikes up to 150cc'=>'e7b38f7c61f1',
                        'Bikes more than 150cc'=>'0c1c1846a382',
                        'Loading Vehicle more than 34.99kv'=>'da1462ce1285',
                        'Ambulances,Funeral cars'=>'ab2010d41bbc',
                        'Bus 19+1 to 28+1'=>'396ab962b76a',
                        'Truck Trailer'=>'9f43393b29cd',
                        'Other trailers'=>'055cdfc9c9cc',
                        'Car'=>'5387b8bf5632',
                        'Bike'=>'d931b542bcad',
                        'Car engine'=>'d88ed7fda1fa',
                        'Vans/Microbus Seats'=>'0c0361f6647e',
                        'Bus'=>'22b8a3a60595',
                        'Trucks'=>'bacb3f1ffff6',
                        'Trailer'=>'c32b0536df2f',
                        'Agricultural Vehicle'=>'497a41074388',
                        'Firefighter'=>'a51933d621cb'
                    ];
                    $car_type = !empty($car_details['car_tpye'])?array_search($car_details['car_tpye'],$car_type_array):"-";
    
                    $_regitration_no = !empty($car_details['object_1'])?$car_details['object_1']:"-";
                    $_details_of_object =[
                        'object_1'=>$_regitration_no."/".$car_type
                    ];
                    
                    $value->object_details_one = $_details_of_object;
                    $value->varient_type = !empty($value->policy_details['green_card_type'])?$value->policy_details['green_card_type']:"-";
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                }
            }

        }
        $policyData=[];
        
        $policyData = array_map("unserialize", array_unique(array_map("serialize", $data)));
        // dd($data[7]);

        return response()->json(array('data'=>array_values($policyData)));

    }

    public function getShowCustomer(Request $request,$id='')
    {
        $datanewa='';

        if($id!=''){
            $datanewa=json_decode(base64_decode($id));
        }

        $input = $request->input();
        $customers = User::whereIn('user_type', ['Individual', 'Business'])
                                    ->where('status', 1);

        if(isset($datanewa->filter_type) && !empty($datanewa->filter_type)) {
            $customers = $customers->where('users.user_type',$datanewa->filter_type);
        }
        if($datanewa!=''){
            if($datanewa->status!='') {
                $customers = $customers->where('users.is_policy',$datanewa->status);

            }
        }


        if(isset($datanewa->filter_city) && !empty($datanewa->filter_city)){
            $customers= $customers
                        ->leftJoin('customer', 'users.user_id', '=', 'customer.user_id')
                        ->where('customer.city',$datanewa->filter_city);
        }
        if(isset($datanewa->date1) && !empty($datanewa->date2)) {
            $customers = $customers->whereBetween('users.created_at',[date('Y-m-d',strtotime($datanewa->date1)),date('Y-m-d',strtotime($datanewa->date2))]);
        }

        $customers = $customers->get();

        foreach ($customers as $key => $value) {
            $value->policy_user = Policy::where('user_id',$value->user_id)->get();
        }




        return view('dashboard.customer',compact('customers','datanewa'));
    }
    public function getShowClaims(Request $request)
    {
        $Insurerdata=Insurer::all();
        $policySubType=PolicySubType::all();


        $claims = Claim::select('*','claims.created_at as claim_date','insurer.name as insurer_name','insurer_policy.policy_name as policyName','claims.status as claimsStatus')
                        ->leftJoin('insurer_policy', 'claims.insurer_policy_id', '=', 'insurer_policy.insurer_policy_id')
                        ->leftJoin('policy', 'claims.policy_id', '=', 'policy.policy_id')
                        ->leftJoin('insurer', 'claims.insurer_id', '=', 'insurer.insurer_id');



        $data = $claims->get();

        foreach ($data as $key => $value) {
            # code...
            $value->dd_status=Status_tracking::where('entity_id',$value->claims_id)->where('entity','claim')->orderBy('id','DESC')->first();
            $value->dd_all_status=Status_tracking::where('entity_id',$value->claims_id)->where('entity','claim')->orderBy('id','DESC')->get();

        }



        return view('dashboard.clamied',compact('Insurerdata','policySubType'));
    }

    public function getClamiedRecord(Request $request,$id='')
    {
        if($id!=''){
            $datanewa=json_decode(base64_decode($id));
        }
        $input = $request->input();

        $claims = Claim::select('*','claims.created_at as claim_date','claims.id as claim_main_id','insurer.name as insurer_name','insurer_policy.policy_name as policyName','claims.status as claimsStatus','claims.policy_type as claim_policy_type')
                        ->leftJoin('insurer_policy', 'claims.insurer_policy_id', '=', 'insurer_policy.insurer_policy_id')
                        ->leftJoin('policy', 'claims.policy_id', '=', 'policy.policy_id')
                        ->leftJoin('insurer', 'claims.insurer_id', '=', 'insurer.insurer_id');

        if(isset($datanewa->insurance_company) && !empty($datanewa->insurance_company)) {
            $claims = $claims->where('claims.insurer_id',$datanewa->insurance_company);
        }
        if(isset($datanewa->policy_type) && !empty($datanewa->policy_type)) {
            $claims = $claims->where('claims.policy_type',$datanewa->policy_type);
        }
        if(isset($datanewa->filter_type) && !empty($datanewa->filter_type)) {
            $claims = $claims->where('claims.claming_type',$datanewa->filter_type);
        }
        if(isset($datanewa->claim_status) && !empty($datanewa->claim_status)) {
            $claims = $claims->where('claims.status',$datanewa->claim_status);
        }
        if(isset($datanewa->date1) && !empty($datanewa->date2)) {
            $claims = $claims->whereBetween('claims.created_at',[date('Y-m-d',strtotime($datanewa->date1)),date('Y-m-d',strtotime($datanewa->date2))]);
        }

        $data = $claims->get();

        foreach ($data as $key => $value) {
            $value->dd_status=Status_tracking::where('entity_id',$value->claims_id)->where('entity','claim')->orderBy('id','DESC')->first();
            $value->dd_all_status=Status_tracking::where('entity_id',$value->claims_id)->where('entity','claim')->get();
            $value->policy_type_name=PolicySubType::where('policy_sub_type_id',$value->claim_policy_type)->first();
        }

        // dd($data);
        return response()->json(array('data'=>$data));
    }

    public function getReporting($id='')
    {
        if($id!=''){
            $datanewa=json_decode(base64_decode($id));
        }


        $Insurerdata=Insurer::all();
        $InsurerPolicy=InsurerPolicy::all();
        $get_report_data = Reporting::select('*')->join('policy','reporting.policy_id','=','policy.policy_id');

        if(isset($datanewa->insurance_company) && !empty($datanewa->insurance_company)) {
            $get_report_data = $get_report_data->where('reporting.insurer_id',$datanewa->insurance_company);
        }
        if(isset($datanewa->claiming) && !empty($datanewa->claiming)) {
            if($datanewa->claiming=='1'){
                $get_report_data = $get_report_data->whereNotNull('reporting.claimed_paid');
            }
            if($datanewa->claiming=='2'){
                $get_report_data = $get_report_data->whereNull('reporting.claimed_paid');
            }
        }
        if(isset($datanewa->payment_mode) && !empty($datanewa->payment_mode)) {
            if($datanewa->payment_mode=='1'){
                $get_report_data = $get_report_data->where('reporting.method','PayPal');
            }
            if($datanewa->payment_mode=='2'){
                $get_report_data = $get_report_data->where('reporting.method','BKT');
            }
        }
        if(isset($datanewa->date1) && !empty($datanewa->date2)) {
            $get_report_data = $get_report_data->whereBetween('reporting.created_at',[date('Y-m-d',strtotime($datanewa->date1)),date('Y-m-d',strtotime($datanewa->date2))]);
        }
        if(isset($datanewa->policy_name_filter) && !empty($datanewa->policy_name_filter)) {
            $get_report_data = $get_report_data->where('reporting.insurer_policy_id',$datanewa->policy_name_filter);
        }

        $get_report_data=$get_report_data->get();

        $data=[];
        $insuer_amount=0;
        $our_part_amount = 0;
        $total =0;
        $amount =[];
        foreach ($get_report_data as $key => $value) {
            # code...
            $policy_name = InsurerPolicy::where('insurer_policy_id',$value->insurer_policy_id)->first();
            $insuer = Insurer::where('insurer_id',$value->insurer_id)->first();
            $data[] =[
                'policy_name' =>!empty($policy_name->policy_name)?$policy_name->policy_name:'-',
                'client_name'=>!empty($value->insured_name)?$value->insured_name:'-',
                'start_date'=>$value->start_date,
                'method'=>$value->method,
                'claimed_paid'=>!empty($value->claimed_paid)?"Yes":"No",
                'insuer'=>!empty($insuer->name)?$insuer->name:'-',
                'policy_number'=>$value->policy_number,
                'insurer_part'=>$value->insurer_part,
                'our_part'=>$value->our_part,
                'total'=>$value->total,
            ];
            $insuer_amount +=(float)$value->insurer_part;
            $our_part_amount +=(float)$value->our_part;
            $total +=(float)$value->total;

            $amount =[
                'insuer_amount'=>$insuer_amount,
                'our_part_amount'=>$our_part_amount,
                'total'=>$total
            ];
            // dd($policy_name->policy_name);
        }



        return view('dashboard.reporting',[
            'report_data'=>$data,
            'amount'=>$amount,
            'Insurerdata'=>$Insurerdata,
            'InsurerPolicy'=>$InsurerPolicy
        ]);
    }
    public function getInsurer()
    {
        $data =[];
        $data['all_insure'] = Insurer::orderBy('id','desc')->get();
        return view('dashboard.insurer',$data);
    }
}
