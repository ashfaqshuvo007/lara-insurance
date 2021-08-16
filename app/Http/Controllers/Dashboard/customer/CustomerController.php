<?php

namespace App\Http\Controllers\Dashboard\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Policy;
use App\Models\Car;
use App\Models\TplSubType;
use App\Models\TplType;
use App\Models\Task;
use App\Models\Property;
use App\Models\Travel;
use App\Models\PolicySubType;
use App\Models\Status_tracking;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\Models\Claim;
use App\Models\LossInfo;
use Illuminate\Support\Facades\Validator;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function getShowCustomerView($id)
    {
        $data = Customer::select('users.*','customer.*','customer.id as cus_id','customer.user_id as get_user_id')
                        ->join('users', 'users.user_id', '=', 'customer.user_id')
                        ->whereIn('users.user_type', ['Individual', 'Business'])
                        ->where('users.status', 1)
                        ->where('customer.customer_id',$id)
                        ->first();
        // dd($data);
        $user_id = Policy::select('*','insurer.name as insurer_name','policy.id as _id')
                        ->join('insurer', 'policy.insurer_id', '=', 'insurer.insurer_id')
                        ->where('user_id',$data->get_user_id)->get();
        
        $show_details = [];
        foreach($user_id as $policy_details)
        {

            if($policy_details->policy_type == '74273e1bc257')
            {
                $object =Property::where('policy_id',$policy_details->policy_id)->select('square')->first();
                $show_details[]=[
                    'policy_number'=>!empty($policy_details->policy_number)?$policy_details->policy_number:"PL00".$policy_details->_id,
                    'insurer_name'=>$policy_details->insurer_name,
                    'object'=>!empty($object['square'])?$object['square']:"-",
                    'policy_type'=>"Home",
                    'premium'=>$policy_details->premium,
                    'status_tracking'=>$this->getStatusTracking($policy_details->policy_id)
                ];
            }
            elseif($policy_details->policy_type == 'c1bc21cfdda9')
            {
                $car_details = Car::where('policy_id','LIKE',"%$policy_details->policy_id%")->select('car_registration_number')->first();
                $show_details[]=[
                    'policy_number'=>!empty($policy_details->policy_number)?$policy_details->policy_number:"PL00".$policy_details->_id,
                    'insurer_name'=>$policy_details->insurer_name,
                    'object'=>!empty($car_details['car_registration_number'])?$car_details['car_registration_number']:"-",
                    'policy_type'=>"Tpl",
                    'premium'=>$policy_details->premium,
                    'status_tracking'=>$this->getStatusTracking($policy_details->policy_id)
                ];
            }
            elseif($policy_details->policy_type == 'dfd3e39b733a')
            {
                $car_details = Car::where('policy_id','LIKE',"%$policy_details->policy_id%")->select('car_registration_number')->first();
                $show_details[]=[
                    'policy_number'=>!empty($policy_details->policy_number)?$policy_details->policy_number:"PL00".$policy_details->_id,
                    'insurer_name'=>$policy_details->insurer_name,
                    'object'=>!empty($car_details['car_registration_number'])?$car_details['car_registration_number']:"-",
                    'policy_type'=>"Green Card",
                    'premium'=>$policy_details->premium,
                    'status_tracking'=>$this->getStatusTracking($policy_details->policy_id)
                ];
            }
            elseif($policy_details->policy_type == 'c7824ee08a59')
            {
                $car_details = Car::where('policy_id','LIKE',"%$policy_details->policy_id%")->select('car_registration_number')->first();
                $show_details[]=[
                    'policy_number'=>!empty($policy_details->policy_number)?$policy_details->policy_number:"PL00".$policy_details->_id,
                    'insurer_name'=>$policy_details->insurer_name,
                    'object'=>!empty($car_details['car_registration_number'])?$car_details['car_registration_number']:"-",
                    'policy_type'=>"Green Card",
                    'premium'=>$policy_details->premium,
                    'status_tracking'=>$this->getStatusTracking($policy_details->policy_id)
                ];
            }
            elseif($policy_details->policy_type == '69e21f9783bd')
            {
                $travel_data = Travel::where('travel_id',$policy_details['policy_name'])->select('zone')->first();
                $show_details[]=[
                    'policy_number'=>!empty($policy_details->policy_number)?$policy_details->policy_number:"PL00".$policy_details->_id,
                    'insurer_name'=>$policy_details->insurer_name,
                    'object'=>!empty($travel_data['zone'])?$travel_data['zone']:"-",
                    'policy_type'=>"Student outside Alabania",
                    'premium'=>$policy_details->premium,
                    'status_tracking'=>$this->getStatusTracking($policy_details->policy_id)
                ];
            }
            elseif($policy_details->policy_type == '0ac2b7cfc696')
            {
                $travel_data = Travel::where('travel_id',$policy_details['policy_name'])->select('zone')->first();
                $show_details[]=[
                    'policy_number'=>!empty($policy_details->policy_number)?$policy_details->policy_number:"PL00".$policy_details->_id,
                    'insurer_name'=>$policy_details->insurer_name,
                    'object'=>!empty($travel_data['zone'])?$travel_data['zone']:"-",
                    'policy_type'=>"Travel outside Alabania",
                    'premium'=>$policy_details->premium,
                    'status_tracking'=>$this->getStatusTracking($policy_details->policy_id)
                ];
                
            }
        }
        // dd($show_details);
        $data->policy_details = $show_details;
        // dd($data->policy_details);
        $get_documents = Document::where('entity_id',$id)->get();
        $get_all_user=User::where('user_type', 'admin')
                            ->where('status',1)
                            ->orderBy('name','ASC')
                            ->get();

        $get_task_detalis=Task::with('user')->where('customer_id',$id)->get();

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
        //tpl sub type and green card sub type table data
        $car_sub_type_array=[
            'Up to 150cc'=>'f07984758964',
            'Over 150cc'=>'57f41a80b45a',
            '5-8'=>'60afb64195d6',
            '9-15'=>'01d56e34f25c',
            'Over 15 seats'=>'87cefe0f3474',
            'loading weight up to 3.5 tons'=>'38aff07e0cbf',
            'loading weight More than 3.5 tons'=>'f9d4abd4e737',
            'All kinds'=>'a24ca6671d80',
            'All kinds'=>'31d97172b5d6',
            'All kinds'=>'44de5800795f',
            'All kinds'=>'dd53180f13eb',
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
            'upto 1600 cc'=>'5ece4797eaf5e',
            '1601cc-2500cc'=>'5ef08d816e624',
            'Over 2500cc'=>'5ef08ddd34477',
            'up to 1600cc '=>'063fe4e402f9',
            'up to 1600'=>'4d51a9f925ca',
            '1601 to 2500'=>'d28c9d14d093',
            '1601 to 2500'=>'8b500b52b07c',
            'Over 2501cc'=>'dc2ea08df0cb',
            'Over 2501cc'=>'b2371e8041ba'
        ];
        $find_car = Car::where('user_id',$data->get_user_id)->get();
        $car_details_show =[];
        if(!empty($find_car))
        {
            foreach($find_car as $details)
            {
                $car_type = array_search($details->car_tpye,$car_type_array);
                $car_sub_type ="";
                if(!empty($details->car_sub_type))
                {
                    $car_sub_type = array_search($details->car_sub_type,$car_sub_type_array);
                }
                else{
                    $car_sub_type ="";
                }
                $car_details_show[]=[
                    'car_registration_number'=>$details->car_registration_number,
                    'car_type'=>$car_type,
                    'car_sub_type'=>$car_sub_type,
                    'status'=>!empty($details->policy_id)?"Insured":"Uninsured"
                ];
            }
        }
        // dd($car_details);
        //claim data 
        $get_claims_of_user = Claim::where('user_id',$data->get_user_id)
                                    ->join('policy_sub_type','claims.policy_type','policy_sub_type.policy_sub_type_id')                                         
                                    ->join('insurer','claims.insurer_id','insurer.insurer_id')
                                    ->join('insurer_policy','claims.insurer_policy_id','insurer_policy.insurer_policy_id')
                                    ->select('policy_sub_type.name as type_name','insurer.name as insurer_name','claims.id','claims.policy_id','claims.status','claims.claims_id','claims.policy_type',
                                    'insurer_policy.policy_name','claims.policy_id')
                                    ->get();
        $claim_data =[];
        if(!empty($get_claims_of_user))
        {
            foreach($get_claims_of_user as $details)
            {
                if($details->policy_type == '74273e1bc257')
                {
                    $object =Property::where('policy_id',$details->policy_id)->select('square')->first();
                    $object_data = !empty($object['square'])?$object['square']:"-";
                    
                }
                elseif($details->policy_type == 'c1bc21cfdda9')
                {
                    $car_details = Car::where('policy_id','LIKE',"%$details->policy_id%")->select('car_registration_number')->first();
                    $object_data =!empty($car_details['car_registration_number'])?$car_details['car_registration_number']:"-";
                    
                }
                elseif($details->policy_type == 'dfd3e39b733a')
                {
                    $car_details = Car::where('policy_id','LIKE',"%$details->policy_id%")->select('car_registration_number')->first();
                    $object_data =!empty($car_details['car_registration_number'])?$car_details['car_registration_number']:"-";
                    
                }
                elseif($details->policy_type == 'c7824ee08a59')
                {
                    $car_details = Car::where('policy_id','LIKE',"%$details->policy_id%")->select('car_registration_number')->first();
                    $object_data =!empty($car_details['car_registration_number'])?$car_details['car_registration_number']:"-";
                }
                elseif($details->policy_type == '69e21f9783bd')
                {
                    $policy_details = Policy::where('policy_id',$details->policy_id)->first();
                    $travel_data = Travel::where('travel_id',$policy_details['policy_name'])->select('zone')->first();
                    $object_data =!empty($travel_data['zone'])?$travel_data['zone']:"-";
                   
                }
                elseif($details->policy_type == '0ac2b7cfc696')
                {
                    $policy_details = Policy::where('policy_id',$details->policy_id)->first();
                    $travel_data = Travel::where('travel_id',$policy_details['policy_name'])->select('zone')->first();
                    $object_data =!empty($travel_data['zone'])?$travel_data['zone']:"-";
                    
                }
                $loss_info = LossInfo::where('entity_id',$details->policy_id)->first();
                $claim_data[]=[
                    'claim_id'=>$details->id,
                    'policy_type'=>$details['type_name'],
                    'insurer'=>$details['insurer_name'],
                    'status'=>$details['status'],
                    'product'=>$details['policy_name'],
                    'object'=>$object_data,
                    'loss_date'=>!empty($loss_info['created_at'])?date("Y-m-d", strtotime($loss_info['created_at'])):"-"
                ];
            }
            
        }
        // dd($get_claims_of_user);

        return view('dashboard.customer.customer-view', compact('data','get_documents','get_all_user','get_task_detalis'),['car_details_show'=>$car_details_show,'claim_data'=>$claim_data]);
    }

    public function postCustomerDocuments(Request $request){

        $input = $request->all();
        $validator = Validator::make($input, [
                        'message' => 'required'
                    ]);
        if($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        if(isset($input['document_file']))
        {

            $validator = Validator::make($input, [
                'document_file' => 'required|mimes:jpeg,jpg,png,doc,csv,xlsx,xls,docx,ppt,odt,ods,odp,pdf'
            ]);
            if($validator->fails())
            {
                return back()
                ->withErrors($validator)
                ->withInput();
            }
            if($request->hasFile('document_file'))
            {
                $fileName = "document_file".time().'.'.$request->file('document_file')->extension();
                $request->file('document_file')->move(public_path('storage/documents'), $fileName);
                $user = Document::create([
                    'document_id'=>uniqid(),
                    'entity_type'=>"customer",
                    'entity_id'=>$input['customer_id'],
                    'document_name' =>  $request->file('document_file')->getClientOriginalName(),
                    'file_name'=>$fileName,
                    'comments'=>$input['message']
                ]);
                Toastr::success('Document Upload Sucessfully', 'Success');
                return back();
            }
            else{
                Toastr::error('Their is some error', 'Error');
                return back();
            }
        }

    }
    public function editCustomerDocuments(Request $request){
        $input = $request->all();
        $id = $input['data'];
        $data = Document::findOrFail($id);
        return $data;
    }



    public function updateCustomerDocuments(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
                        'message' => 'required'
                    ]);
        if($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        if(isset($input['document-file']))
        {
            $validator = Validator::make($input, [
                'document-file' => 'required|mimes:jpeg,jpg,png,doc,csv,xlsx,xls,docx,ppt,odt,ods,odp,pdf'
            ]);
            if($validator->fails())
            {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if($request->hasFile('document-file'))
            {

                $get_file_name = Document::where('id',$input['customer_id'])->first();

                $file_name_data = $get_file_name['file_name'];

                    if(file_exists(public_path('/storage/documents/'.$file_name_data)))
                    {
                        unlink(public_path('/storage/documents/'.$file_name_data));
                    }

                $fileName = "document-file".time().'.'.$request->file('document-file')->extension();
                $request->file('document-file')->move(public_path('storage/documents'), $fileName);
                $data_update = Document::where('id',$input['customer_id'])->update([
                    'document_name' =>  $request->file('document-file')->getClientOriginalName(),
                    'file_name'=>$fileName,
                    'comments'=>$input['message']
                ]);
                Toastr::success('Document Updated Sucessfully', 'Success');
                return back();
            }
            else{
                Toastr::error('Their is some error', 'Error');
                return back();
            }
        }
        else{
            $data_update = Document::where('id',$input['customer_id'])->update([
                'comments'=>$input['message']
            ]);
            Toastr::success('Document Updated Sucessfully', 'Success');
            return back();

        }

    }
    public function deleteCustomerDocuments($id){

        $data = Document::where('document_id',$id)->delete();
        Toastr::success('Document Successfully Deleted', 'Success');
        return back();

    }

    public function createCustomerTask(Request $request){

        $input = $request->all();

        $validator = Validator::make($input, [
                        'responsible' => 'required',
                        'datepicker' => 'required',
                        'subject' => 'required',
                        'task_message' => 'required'
                    ]);
        if($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        else{
            $user = Task::create([
                'assigned_to'=>$input['responsible'],
                'date'=>date('Y-m-d',strtotime($input['datepicker'])),
                'subject'=>$input['subject'],
                'description'=>$input['task_message'],
                'customer_id'=>$input['customer_id'],
                'created_by'=>Auth::user()->id
            ]);
            Toastr::success('Task Added Sucessfully', 'Success');
            return back();
        }


    }
    public function editCustomerTask(Request $request){
        $input = $request->all();
        $id = $input['data'];
        // Driver::with('online')->where('company', 1)->get();

        $data = Task::where('id', $id)->with('user')->first();
        return $data;
    }

    public function updateCustomerTask(Request $request){

        $input = $request->all();

        $validator = Validator::make($input, [
                        'edit_Responsible' => 'required',
                        'status'=> 'required',
                        'edit_datepicker' => 'required',
                        'edit_subject' => 'required',
                        'edit_task_message' => 'required'
                    ]);
        if($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        else{
            $data_update = Task::where('id',$input['task_id'])->update([
                'assigned_to'=>$input['edit_Responsible'],
                'is_complete'=>$input['status'],
                'date'=>date('Y-m-d',strtotime($input['edit_datepicker'])),
                'subject'=>$input['edit_subject'],
                'description'=>$input['edit_task_message']
            ]);
            Toastr::success('Task Updated Sucessfully', 'Success');
            return back();

        }


    }

    public function deleteTaskDocuments($id){


        $data = Task::where('id',$id)->delete();
        Toastr::success('Task Successfully Deleted', 'Success');
        return back();

    }

    public function editCustomerDetails(Request $request)
    {
        $input=$request->all();
        $validator = Validator::make($input, [
            'name'     => 'required',
            'email' => ['required', 'max:255', 'regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/'],
            'phone' => 'required|min:6|max:10',
            'country_code'=>'required',
            'user_id'=>'required',
            'user_type'=>'required'
        ]);
        if($validator->fails()){
            return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()], 400);
        }
        $find_user = User::where('user_id',$input['user_id'])->first();

        $email = $find_user['email'];
        $phone = $find_user['phone'];

        if($input['email'] != $email)
        {
            
            $validator = Validator::make($input, [
                'email' => ['required', 'max:255', 'regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/','unique:users']
            ]);
            if($validator->fails()) 
            {
               return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()], 400);
            }
        }
        elseif($input['phone'] != $phone )
        {
            $validator = Validator::make($input, [
                'phone' => 'required|min:6|max:10|unique:users'
            ]);
            if($validator->fails()) 
            {
                return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()], 400);
            }
        }


        $update_user_data=[
            'name'=>$input['name'],
            'email'=>$input['email'],
            'country_code'=>$input['country_code'],
            'phone'=>$input['phone'],
            'user_type'=>$input['user_type']
        ];

        try{
            $update_user = $find_user->update($update_user_data);

            $update_customer_data = Customer::where('user_id',$input['user_id'])->update([
                'nuis_id'=>!empty($input['nuis_id'])?$input['nuis_id']:null,
                'address'=>!empty($input['address'])?$input['address']:null,
                'can_purchase_channel'=>!empty($input['can_purchase_channel'])?$input['can_purchase_channel']:null,
                'commnication_channel'=>!empty($input['commnication_channel'])?$input['commnication_channel']:null,
            ]);
            return response()->json(['success' => true, 'message' => 'Sucess'], 200);
        }
        catch (\Exception $e)
        {
            return response()->json(['success' => false, 'errors' => 'Server Error!','status'=>'error'], 400);
        }
        
    }

    public function getStatusTracking($policy_id)
    {
        $get_status = Status_tracking::where('entity_id',$policy_id)->orderBy('created_at', 'desc')->first();
        // dd($get_status);
        $get_status_id = !empty($get_status)?$get_status['status']:null;
        return $get_status_id;
    }




}
