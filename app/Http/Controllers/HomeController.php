<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Insurer;
use App\Models\Customer;
use App\Models\Policy;
use App\Models\Claim;
use App\Models\FullCasco;
use App\Models\InsurerPolicy;
use App\Models\TplEntry;
use App\Models\Travel;
use App\Models\HomePolicy;
use App\Models\GreenCard;
use App\Http\Controllers\Controller;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user-check');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $monday = strtotime("last monday");
        $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;

        $sunday = strtotime(date("Y-m-d",$monday)." +6 days");

        $this_week_sd = date("Y-m-d 00:00:00",$monday);
        $this_week_ed = date("Y-m-d 23:59:59",$sunday);



        $data = Policy::select('*','policy_sub_type.name as type_name','policy.created_at as renewal_date','insurer.name as insurer_name')
                    ->leftJoin('insurer', 'policy.insurer_id', '=', 'insurer.insurer_id')
                    ->leftJoin('policy_sub_type', 'policy.policy_type', '=', 'policy_sub_type.policy_sub_type_id')
                    ->leftJoin('users', 'policy.user_id', '=', 'users.user_id')
                        ->get();

            foreach ($data as $key => $value) {
                if($value['policy_sub_type_id']=='c7824ee08a59'){
                    $value->policy_details=FullCasco::where('full_casco_id',$value['policy_name'])->first()->toArray();
                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                }
                elseif ($value['policy_sub_type_id']=='c1bc21cfdda9'){
                    $value->policy_details=TplEntry::where('tpl_entry_id',$value['policy_name'])->first()->toArray();
                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                }
                elseif ($value['policy_sub_type_id']=='69e21f9783bd'){
                    $value->policy_details=Travel::where('travel_id',$value['policy_name'])->first()->toArray();

                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                }
                elseif ($value['policy_sub_type_id']=='74273e1bc257'){

                    $home_data = HomePolicy::where('home_policy_id',$value['policy_name'])->first();
                    if(!empty($home_data))
                    {
                        $value->policy_details=$home_data->toArray();
                        $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                        ->first();
                        if(!empty($temp)){
                            $value->policy_name_dtl=$temp->toArray();
                        }
                    }
                    else{
                        $value->policy_details=[];
                        $value->policy_name_dtl =[];
                    }
                    

                    // $temp1=HomePolicy::where('home_policy_id',$value['policy_name'])->first();
                    // if(!empty($temp)){
                    //     $value->policy_details->toArray();
                    // }


                    
                }
                elseif ($value['policy_sub_type_id']=='dfd3e39b733a'){
                    $value->policy_details=GreenCard::where('green_card_id',$value['policy_name'])->first()->toArray();
                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                }
            }

            $data['tab1']=$data->toArray();


        //Today

        $dataToday = Policy::select('*','policy_sub_type.name as type_name','policy.created_at as renewal_date','insurer.name as insurer_name')
                    ->leftJoin('insurer', 'policy.insurer_id', '=', 'insurer.insurer_id')
                    ->leftJoin('policy_sub_type', 'policy.policy_type', '=', 'policy_sub_type.policy_sub_type_id')
                    ->leftJoin('users', 'policy.user_id', '=', 'users.user_id')
                    ->whereBetween('policy.created_at',[date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59')])
                    ->get();

            foreach ($dataToday as $key => $value) {

                if($value['policy_sub_type_id']=='c7824ee08a59'){
                    $value->policy_details=FullCasco::where('full_casco_id',$value['policy_name'])->first()->toArray();
                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                }
                elseif ($value['policy_sub_type_id']=='c1bc21cfdda9'){
                    $value->policy_details=TplEntry::where('tpl_entry_id',$value['policy_name'])->first()->toArray();
                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                }
                elseif ($value['policy_sub_type_id']=='69e21f9783bd'){
                    $value->policy_details=Travel::where('travel_id',$value['policy_name'])->first()->toArray();
                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                }
                elseif ($value['policy_sub_type_id']=='74273e1bc257'){
                    $value->policy_details=HomePolicy::where('home_policy_id',$value['policy_name'])->first()->toArray();
                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                }
                elseif ($value['policy_sub_type_id']=='dfd3e39b733a'){
                    $value->policy_details=GreenCard::where('green_card_id',$value['policy_name'])->first()->toArray();
                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                }
            }

        $data['tab2']=$dataToday->toArray();

        // Due Tommorow Data

        $dataTommorow = Policy::select('*','policy_sub_type.name as type_name','policy.created_at as renewal_date','insurer.name as insurer_name')
                    ->leftJoin('insurer', 'policy.insurer_id', '=', 'insurer.insurer_id')
                    ->leftJoin('policy_sub_type', 'policy.policy_type', '=', 'policy_sub_type.policy_sub_type_id')
                    ->leftJoin('users', 'policy.user_id', '=', 'users.user_id')
                    ->whereBetween('policy.created_at',[date('Y-m-d 00:00:00',strtotime(' +1 day')),date('Y-m-d 23:59:59',strtotime(' +1 day'))])

                    ->get();

            foreach ($dataTommorow as $key => $value) {

                if($value['policy_sub_type_id']=='c7824ee08a59'){
                    $value->policy_details=FullCasco::where('full_casco_id',$value['policy_name'])->first()->toArray();
                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                }
                elseif ($value['policy_sub_type_id']=='c1bc21cfdda9'){
                    $value->policy_details=TplEntry::where('tpl_entry_id',$value['policy_name'])->first()->toArray();
                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                }
                elseif ($value['policy_sub_type_id']=='69e21f9783bd'){
                    $value->policy_details=Travel::where('travel_id',$value['policy_name'])->first()->toArray();
                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                }
                elseif ($value['policy_sub_type_id']=='74273e1bc257'){
                    $value->policy_details=HomePolicy::where('home_policy_id',$value['policy_name'])->first()->toArray();
                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                }
                elseif ($value['policy_sub_type_id']=='dfd3e39b733a'){
                    $value->policy_details=GreenCard::where('green_card_id',$value['policy_name'])->first()->toArray();
                    $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                }
            }

        $data['tab3']=$dataTommorow->toArray();

        //Week

        $dataWeek = Policy::select('*','policy_sub_type.name as type_name','policy.created_at as renewal_date','insurer.name as insurer_name')
                            ->leftJoin('insurer', 'policy.insurer_id', '=', 'insurer.insurer_id')
                            ->leftJoin('policy_sub_type', 'policy.policy_type', '=', 'policy_sub_type.policy_sub_type_id')
                            ->leftJoin('users', 'policy.user_id', '=', 'users.user_id')
                            ->whereBetween('policy.created_at',[$this_week_sd,$this_week_ed])
                                ->get();
                    foreach ($dataWeek as $key => $value) {
                        if($value['policy_sub_type_id']=='c7824ee08a59'){
                            $value->policy_details=FullCasco::where('full_casco_id',$value['policy_name'])->first()->toArray();
                            $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                ->first();
                                if(!empty($temp)){
                                    $value->policy_name_dtl=$temp->toArray();
                                }
                        }
                        elseif ($value['policy_sub_type_id']=='c1bc21cfdda9'){
                            $value->policy_details=TplEntry::where('tpl_entry_id',$value['policy_name'])->first()->toArray();
                            $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                            ->first();
                            if(!empty($temp)){
                                $value->policy_name_dtl=$temp->toArray();
                            }
                        }
                        elseif ($value['policy_sub_type_id']=='69e21f9783bd'){
                            $value->policy_details=Travel::where('travel_id',$value['policy_name'])->first()->toArray();
                            $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                        }
                        elseif ($value['policy_sub_type_id']=='74273e1bc257'){
                            $value->policy_details=HomePolicy::where('home_policy_id',$value['policy_name'])->first()->toArray();
                            $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                        }
                        elseif ($value['policy_sub_type_id']=='dfd3e39b733a'){
                            $value->policy_details=GreenCard::where('green_card_id',$value['policy_name'])->first()->toArray();
                            $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                        }
                    }

        $data['tab4']=$dataWeek->toArray();

        // Due month wise

        $dataMonth = Policy::select('*','policy_sub_type.name as type_name','policy.created_at as renewal_date','insurer.name as insurer_name')
                            ->leftJoin('insurer', 'policy.insurer_id', '=', 'insurer.insurer_id')
                            ->leftJoin('policy_sub_type', 'policy.policy_type', '=', 'policy_sub_type.policy_sub_type_id')
                            ->leftJoin('users', 'policy.user_id', '=', 'users.user_id')
                            ->whereMonth('policy.created_at', date('m'))
                            ->get();
                    foreach ($dataMonth as $key => $value) {
                        if($value['policy_sub_type_id']=='c7824ee08a59'){
                            $value->policy_details=FullCasco::where('full_casco_id',$value['policy_name'])->first()->toArray();
                            $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                        }
                        elseif ($value['policy_sub_type_id']=='c1bc21cfdda9'){
                            $value->policy_details=TplEntry::where('tpl_entry_id',$value['policy_name'])->first()->toArray();
                            $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                        }
                        elseif ($value['policy_sub_type_id']=='69e21f9783bd'){
                            $value->policy_details=Travel::where('travel_id',$value['policy_name'])->first()->toArray();
                            $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                        }
                        elseif ($value['policy_sub_type_id']=='74273e1bc257'){
                            $home_data = HomePolicy::where('home_policy_id',$value['policy_name'])->first();
                            if(!empty($home_data))
                            {
                                $value->policy_details=$home_data->toArray();
                                $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                ->first();
                                if(!empty($temp)){
                                    $value->policy_name_dtl=$temp->toArray();
                                }
                            }
                            else{
                                $value->policy_details=[];
                                $value->policy_name_dtl=[];
                            }
                       
                        }
                        elseif ($value['policy_sub_type_id']=='dfd3e39b733a'){
                            $value->policy_details=GreenCard::where('green_card_id',$value['policy_name'])->first()->toArray();
                            $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                        }
                    }

                    // dd($dataMonth);

        $data['tab5']=$dataMonth->toArray();



        // overdue date

        $dataOverdue = Policy::select('*','policy_sub_type.name as type_name','policy.created_at as renewal_date','insurer.name as insurer_name')
                            ->leftJoin('insurer', 'policy.insurer_id', '=', 'insurer.insurer_id')
                            ->leftJoin('policy_sub_type', 'policy.policy_type', '=', 'policy_sub_type.policy_sub_type_id')
                            ->leftJoin('users', 'policy.user_id', '=', 'users.user_id')
                            ->whereDate('policy.created_at', '<', date('Y-m-d 00:00:00'))
                            ->get();
                    foreach ($dataOverdue as $key => $value) {
                        if($value['policy_sub_type_id']=='c7824ee08a59'){
                            $value->policy_details=FullCasco::where('full_casco_id',$value['policy_name'])->first()->toArray();
                            $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                        }
                        elseif ($value['policy_sub_type_id']=='c1bc21cfdda9'){
                            $value->policy_details=TplEntry::where('tpl_entry_id',$value['policy_name'])->first()->toArray();
                            $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                        }
                        elseif ($value['policy_sub_type_id']=='69e21f9783bd'){
                            $value->policy_details=Travel::where('travel_id',$value['policy_name'])->first()->toArray();
                            $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                        }
                        elseif ($value['policy_sub_type_id']=='74273e1bc257'){
                            $home_data = HomePolicy::where('home_policy_id',$value['policy_name'])->first();
                            if(!empty($home_data))
                            {
                                $value->policy_details=$home_data->toArray();
                                $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                                ->first();
                                if(!empty($temp)){
                                    $value->policy_name_dtl=$temp->toArray();
                                }
                            }
                            else{
                                $value->policy_details=[];
                                $value->policy_name_dtl=[];
                            }
                        }
                        elseif ($value['policy_sub_type_id']=='dfd3e39b733a'){
                            $value->policy_details=GreenCard::where('green_card_id',$value['policy_name'])->first()->toArray();
                            $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                        }
                    }

                    // dd($dataMonth);

        $data['tab6']=$dataOverdue->toArray();


        // Today FollowUp Data

        $dataFollowup = Policy::select('*','policy_sub_type.name as type_name','policy.created_at as renewal_date','insurer.name as insurer_name')
                            ->leftJoin('insurer', 'policy.insurer_id', '=', 'insurer.insurer_id')
                            ->leftJoin('policy_sub_type', 'policy.policy_type', '=', 'policy_sub_type.policy_sub_type_id')
                            ->leftJoin('users', 'policy.user_id', '=', 'users.user_id')
                            ->whereBetween('next_followup_date',[date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59')])
                            ->get();
                    foreach ($dataFollowup as $key => $value) {
                        if($value['policy_sub_type_id']=='c7824ee08a59'){
                            $value->policy_details=FullCasco::where('full_casco_id',$value['policy_name'])->first()->toArray();
                            $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                        }
                        elseif ($value['policy_sub_type_id']=='c1bc21cfdda9'){
                            $value->policy_details=TplEntry::where('tpl_entry_id',$value['policy_name'])->first()->toArray();
                            $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                        }
                        elseif ($value['policy_sub_type_id']=='69e21f9783bd'){
                            $value->policy_details=Travel::where('travel_id',$value['policy_name'])->first()->toArray();
                            $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                        }
                        elseif ($value['policy_sub_type_id']=='74273e1bc257'){
                            $value->policy_details=HomePolicy::where('home_policy_id',$value['policy_name'])->first()->toArray();
                            $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                        }
                        elseif ($value['policy_sub_type_id']=='dfd3e39b733a'){
                            $value->policy_details=GreenCard::where('green_card_id',$value['policy_name'])->first()->toArray();
                            $temp=InsurerPolicy::where('insurer_policy_id',$value->policy_details['insurer_policy_id'])
                    ->first();
                    if(!empty($temp)){
                        $value->policy_name_dtl=$temp->toArray();
                    }
                        }
                    }

                    // dd($dataMonth);

        $data['tab7']=$dataFollowup->toArray();



        return view('home',compact('data'));
    }

    public function showQuaterdata(Request $request)
    {
        $start_date = date("Y-m-d", strtotime("first day of january"));
        $end_date = date("Y-m-d", strtotime($start_date."+ 12 months - 1 day"));
        $j=0;
        for($i = strtotime($start_date); $i <= strtotime($end_date); ) {

            $j++;

            $premium_start_date = date("Y-m-d", $i);
            $premium_end_date = date("Y-m-d", strtotime('+3 month', strtotime($premium_start_date)));

            $get_policies=Policy::whereBetween('start_date',[$premium_start_date,$premium_end_date])->get();

            $premium_amount = 0;
            $gross =0;
            $net_premium = 0;

            if($j==1)
            {
                $quater_name = "01st Quarter";
            }
            elseif($j==2)
            {
                $quater_name = "02nd Quarter";
            }
            elseif($j == 3)
            {
                $quater_name = "03rd Quarter";
            }
            elseif($j == 4)
            {
                $quater_name = "04th Quarter";
            }
            foreach($get_policies as $policy_details)
            {
                $premium = str_replace(",", "", $policy_details->premium);
                $premium_amount += (float)$premium;
                $net_premium_value = str_replace(",", "", $policy_details->premium_paid);
                $net_premium += (float)$net_premium_value;
                $gross += (float)$premium + (float)$net_premium_value;
            }
            $premium_data[] = [
                "id"=> $j,
                'business_summary'=>$quater_name,
                'premium'=>$premium_amount,
                "gross"=>$gross,
                "net_premium"=> $net_premium,
                "brokerage"=> "22,545,443"
            ];
            $i = strtotime(date( 'Y-m-d', $i) . ' +3 month');
        }
        return response()->json(array('data'=>$premium_data));
        // return json_encode($salary);
        // return [$salary,$j];
    }
}
