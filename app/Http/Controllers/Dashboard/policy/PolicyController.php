<?php

namespace App\Http\Controllers\Dashboard\policy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\Status_tracking;
use App\Models\Policy;
use App\Models\Customer;
use App\Models\Task;
use App\Models\Document;
use App\Models\Insurer;
use App\User;
use App\Models\Offers;
use App\Models\Property;
use App\Models\HomeSubType;
use App\Models\HomePolicy;
use App\Models\Car;
use App\Models\FullCascoType;
use App\Models\GreenCard;
use App\Models\TplType;
use App\Models\TravelPolicyType;
use  App\Models\Travel;
use App\Models\CodTransaction;
use App\Models\PaypalTransaction;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use App\Models\DriverDetails;
use App\Helpers\PolicyTypeHelper;

class PolicyController extends Controller
{
    public function getShowAddPolicy()
    {
        return view('dashboard.policy.add-policy');
    }
    public function getShowAddPolicyData($id)
    {
        $policy_data=Policy::where('policy_id',$id)
                            ->first();
        $offer_details="";
        if(!empty($policy_data['offer']))
        {
            $offer_details = Offers::where('offers_id',$policy_data['offer'])->first();
        }
       
        //travel policy data 
        $get_dob = TravelPolicyType::where('policy_id',$policy_data->policy_id)->first();

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

        $object_data = Car::where('policy_id','LIKE',"%$policy_data->policy_id%")->first();
        
        $object_data_travel = Travel::where('travel_id',$policy_data['policy_name'])->first();
        $policyType = PolicyTypeHelper::policyTypes();
        $_sub_type = null;
        if(in_array($policy_data->policy_type, $policyType, true) && $policy_data->policy_type == $policyType['home'])
        {
            $_sub_type = Property::where('property.policy_id',$policy_data->policy_id)->join('home_sub_type','property.home_type','home_sub_type.price_type_id')->first();
            $home_documents = $_sub_type;

            $get_sub_type = !empty($_sub_type['name'])?$_sub_type['name']:"-";

            $_varient = HomePolicy::where('home_policy.home_policy_id',$policy_data->policy_name)
                                    ->join('home_policy_type','home_policy.home_sub_type_id','home_policy_type.home_sub_type_id')->first();
            $get_varient = !empty($_varient['name'])?$_varient['name']:"-";
            $get_policy_type = "Home";

            $car_vin_number = isset($object_data['car_vin_number'])?$object_data['car_vin_number']:"Not Avaliable";
            $_building_value = !empty($_sub_type['building_value'])?$_sub_type['building_value']:"-";
            $_equipmennt_price = !empty($_sub_type['equipmennt_price'])?$_sub_type['equipmennt_price']:"-";
            $second_object=$_building_value."/".$_equipmennt_price;
            $object = !empty($_sub_type['square'])?$_sub_type['square']:"-";
            $get_second_name = !empty($policy_data->prospect_name)?$policy_data->prospect_name:"-";

        }
        elseif(in_array($policy_data->policy_type, $policyType, true) && $policy_data->policy_type == $policyType['tpl_car'])
        {
            $get_policy_type = "Car";
            $get_sub_type = "Tpl";
            $get_varient = !empty($object_data['car_tpye'])?array_search($object_data['car_tpye'],$car_type_array):"-";
            $car_vin_number = isset($object_data['car_vin_number'])?$object_data['car_vin_number']:"Not Avaliable";
            $object = !empty($object_data['car_registration_number'])?$object_data['car_registration_number']:"-";
            $second_object=null;
            $get_second_name = !empty($policy_data->prospect_name)?$policy_data->prospect_name:"-";
        }
        elseif(in_array($policy_data->policy_type, $policyType, true) && $policy_data->policy_type == $policyType['greenCard_car'])
        {
            $get_policy_type = "Car";
            $get_sub_type = "GreenCard";
            $_varient = GreenCard::where('green_card_id',$policy_data['policy_name'])->first();

            $get_varient = !empty($_varient['green_card_type'])?$_varient['green_card_type']:"-";
            $car_vin_number = isset($object_data['car_vin_number'])?$object_data['car_vin_number']:"Not Avaliable";
            $car_type = !empty($object_data['car_tpye'])?array_search($object_data['car_tpye'],$car_type_array):"-";
            $_regitration_no = !empty($object_data['car_registration_number'])?$object_data['car_registration_number']:"-";
            $object = $_regitration_no."/".$car_type;

            $second_object=null;
            $get_second_name =!empty($policy_data->prospect_name)?$policy_data->prospect_name:"-";
        }
        elseif(in_array($policy_data->policy_type, $policyType, true) && $policy_data->policy_type == $policyType['casco_car'])
        {
            $get_policy_type = "Car";
            $get_sub_type = "Casco";

            $get_full_casco_varient = FullCascoType::where('casco_type_id',$policy_data['variant'])->first();

            $get_varient = !empty($get_full_casco_varient['varient_name'])?$get_full_casco_varient['varient_name']:"-";
            $car_vin_number = isset($object_data['car_vin_number'])?$object_data['car_vin_number']:"Not Avaliable";
            $_registration_no = !empty($object_data['car_registration_number'])?$object_data['car_registration_number']:"-";
            $_production_year =  !empty($object_data['production_year'])?$object_data['production_year']:"-";
            $_car_value = !empty($object_data['car_value'])?$object_data['car_value']:"-";
            $object = $_registration_no."/".$_production_year."/".$_car_value;

            $second_object=null;
            $get_second_name =!empty($policy_data->prospect_name)?$policy_data->prospect_name:"-";
        }
        elseif(in_array($policy_data->policy_type, $policyType, true)  && $policy_data->policy_type == $policyType['student_outside_country'])
        {
            $get_policy_type = "Travel";
            $get_sub_type = "Student outside Alabania";
            $get_varient = !empty($object_data_travel['age_group'])?$object_data_travel['age_group']:"-";
            $car_vin_number = isset($object_data['car_vin_number'])?$object_data['car_vin_number']:"Not Avaliable";
            $object = !empty($object_data_travel['zone'])?$object_data_travel['zone']:"-";
            $second_object = !empty($get_dob['date_of_birth'])?date("d-m-Y",strtotime($get_dob['date_of_birth'])):"-";
            $get_second_name = !empty($policy_data->prospect_name)?$policy_data->prospect_name:"-";
        }
        elseif(in_array($policy_data->policy_type, $policyType, true) && $policy_data->policy_type == $policyType['travel_outside_country'])
        {
            $get_policy_type = "Travel";
            $get_sub_type = "Travel outside Alabania";

            $get_varient =  !empty($object_data_travel['age_group'])?$object_data_travel['age_group']:"-";
            $car_vin_number = isset($object_data['car_vin_number'])?$object_data['car_vin_number']:"Not Avaliable";
            $object =  !empty($object_data_travel['zone'])?$object_data_travel['zone']:"-";
            $second_object = !empty($get_dob['date_of_birth'])?date("d-m-Y",strtotime($get_dob['date_of_birth'])):"-";
            $get_second_name = !empty($policy_data->prospect_name)?$policy_data->prospect_name:"-";
        }
        $policy_status=Status_tracking::where('entity_id',$id)
                                        ->get();

        $last_policy_status = Status_tracking::where('entity_id',$id)
                                        ->orderBy('id', 'DESC')
                                        ->first();

        $get_documents = Document::where('entity_id',$id)
                                    ->where('entity_type','policy_document')
                                    ->get();


        $documents_customer = Document::where('entity_id',$id)
                                        ->where('entity_type','documents_customer')
                                        ->get();
                                        


        $get_all_user = User::where('user_type', 'admin')
                            ->where('status',1)
                            ->orderBy('name','ASC')
                            ->get();

        $get_task_detalis=Task::where('entity_id',$id)->get();

        $data['getInsurer'] = Policy::select('*','insurer.name as insurer_name')

                                ->leftJoin('insurer', 'policy.insurer_id', '=', 'insurer.insurer_id')
                                ->where('policy_id',$id)
                                ->first();

    //    $driver_details=DriverDetails::where('policy_id',$id)->pluck('driver_name');
        $driver_details=DriverDetails::where('policy_id',$id)->get();
        $get_customer = User::select('*')
                            ->leftJoin('customer', 'users.user_id', '=', 'customer.user_id')

                            ->where('users.status', 1)
                            ->where('users.user_id',$policy_data['user_id'])
                            ->first();

        $get_cod_detalis=CodTransaction::where('policy_id',$id)->first();
        $getPaypalDetails=PaypalTransaction::where('policy_id',$id)->first();
        $getPaymentMethod=PaymentMethod::where('policy_id',$id)->first();
        if($getPaymentMethod && ($getPaymentMethod['payment_method']=='BKT VPOS' || $getPaymentMethod['payment_method']=='Paguaj me kartë')){
            $getBKTPaymentStatus = Transaction::where('policy_id', $id)->latest()->first();
        }else{
            $getBKTPaymentStatus = null;
        }
        $home_documents = $_sub_type;
        
        return view('dashboard.policy.add-policy',compact('data','policy_data','policy_status','last_policy_status','get_documents',
        'get_task_detalis','documents_customer','get_all_user','get_customer','get_policy_type','get_sub_type','get_varient','object','offer_details','get_second_name','second_object','car_vin_number','get_cod_detalis','getPaypalDetails',
        'getPaymentMethod','getBKTPaymentStatus','object_data','driver_details','home_documents'));
    }

    public function addPolicyStatus(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
                        'policy_no' => 'required',
                        'status' => 'required'
                    ]);
        if($validator->fails())  
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        else{
            $data = Status_tracking::create([
                'entity'=>'policy',
                'entity_id'=>$input['policy_id'],
                'status'=>$input['status'],
                'created_by'=>Auth::user()->user_id
            ]);

            $laststatus = Policy::where('policy_id',$data->entity_id)->update([
                'status_tracking'=>$data->status,
                'policy_number'=>$input['policy_no']
            ]);

            Toastr::success('Status Sucessfully Updated', 'Success');
            return back();
        }
    }

    public function create_policy_document(Request $request){
        $input = $request->all();
        // dd($input);
        $validator = Validator::make($input, [
                        'browse' => 'required',
                        'message'=> 'required'
                    ]);
        if($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        if(isset($input['browse']))
        {

            $validator = Validator::make($input, [
                'browse' => 'required|mimes:jpeg,jpg,png,doc,csv,xlsx,xls,docx,ppt,odt,ods,odp,pdf'
            ]);
            if($validator->fails())
            {
                return back()
                ->withErrors($validator)
                ->withInput();
            }
            if($request->hasFile('browse'))
            {
                $find_policy_document = Document::where('entity_id',$input['policy_id'])->first();
                if(!empty($find_policy_document))
                {
                    if(file_exists(public_path('/storage/policy-documents/'.$find_policy_document->file_name)))
                    {
                        unlink(public_path('/storage/policy-documents/'.$find_policy_document->file_name));
                    }
                    $fileName = "policy_document".time().'.'.$request->file('browse')->extension();
                    $request->file('browse')->move(public_path('storage/policy-documents'), $fileName);
                    $update_file =[
                        'document_name' =>  $request->file('browse')->getClientOriginalName(),
                        'file_name'=>$fileName,
                        'comments'=>$input['message']
                    ];
                    //update
                    $find_policy_document->update($update_file);
                }
                else{
                    $fileName = "policy_document".time().'.'.$request->file('browse')->extension();
                    $request->file('browse')->move(public_path('storage/policy-documents'), $fileName);
                    $user = Document::create([
                        'document_id'=>uniqid(),
                        'entity_type'=>"policy_document",
                        'entity_id'=>$input['policy_id'],
                        'document_name' =>  $request->file('browse')->getClientOriginalName(),
                        'file_name'=>$fileName,
                        'comments'=>$input['message']
                    ]);
                    $policy_number = Policy::where('policy_id',$input['policy_id'])->update([
                        'policy_number'=>$input['policy_no']
                    ]);
                }
               
                Toastr::success('Document Upload Sucessfully', 'Success');
                return back();
            }
            else{
                Toastr::error('Their is some error', 'Error');
                return back();
            }
        }
    }


    public function editPolicyDocument(Request $request){
        $input = $request->all();
        $id = $input['data'];
        $data = Document::findOrFail($id);
        return $data;
    }

    public function updatePolicyStatus(Request $request){
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

                $get_file_name = Document::where('id',$input['documents_id'])->first();

                $file_name_data = $get_file_name['file_name'];

                    if(file_exists(public_path('/storage/policy-documents/'.$file_name_data)))
                    {
                        unlink(public_path('/storage/policy-documents/'.$file_name_data));
                    }

                $fileName = "document-file".time().'.'.$request->file('document-file')->extension();
                $request->file('document-file')->move(public_path('storage/policy-documents'), $fileName);
                $data_update = Document::where('id',$input['documents_id'])->update([
                    'document_name' =>  $request->file('document-file')->getClientOriginalName(),
                    'file_name'=>$fileName,
                    'comments'=>$input['message']
                ]);
                $policy_number = Policy::where('policy_id',$input['policy_id'])->update([
                    'policy_number'=>$input['policy_no']
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
            $data_update = Document::where('id',$input['documents_id'])->update([
                'comments'=>$input['message']
            ]);
            $policy_number = Policy::where('policy_id',$input['policy_id'])->update([
                'policy_number'=>$input['policy_no']
            ]);
            Toastr::success('Document Updated Sucessfully', 'Success');
            return back();

        }

    }

    public function policy_documnets_delete($id){

        $data = Document::where('document_id',$id)->delete();
        Toastr::success('Document Successfully Deleted', 'Success');
        return back();

    }

    public function createDocumentcustomer(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
                        'message'=> 'required',
                        'status'=> 'required'

                    ]);
        if($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        if(isset($input['browse']))
        {

            $validator = Validator::make($input, [
                'browse' => 'required|mimes:jpeg,jpg,png,doc,csv,xlsx,xls,docx,ppt,odt,ods,odp,pdf'
            ]);
            if($validator->fails())
            {
                return back()
                ->withErrors($validator)
                ->withInput();
            }
            if($request->hasFile('browse'))
            {
                $fileName = "documents-customer".time().'.'.$request->file('browse')->extension();
                $request->file('browse')->move(public_path('storage/documents-customer'), $fileName);

                $user = Document::create([
                    'document_id'=>uniqid(),
                    'entity_type'=>"documents_customer",
                    'entity_id'=>$input['policy_id'],
                    'document_name' =>  $request->file('browse')->getClientOriginalName(),
                    'file_name'=>$fileName,
                    'status'=>$input['status'],
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

    public function editCustomerDocument(Request $request){
        $input = $request->all();
        $id = $input['data'];
        $data = Document::findOrFail($id);
        return $data;
    }

    public function updateCustomerDocument(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
                        'message' => 'required',
                        'status' => 'required'
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

                $get_file_name = Document::where('id',$input['documents_id'])->first();

                $file_name_data = $get_file_name['file_name'];

                    if(file_exists(public_path('/storage/documents-customer/'.$file_name_data)))
                    {
                        unlink(public_path('/storage/documents-customer/'.$file_name_data));
                    }

                $fileName = "document-file".time().'.'.$request->file('document-file')->extension();
                $request->file('document-file')->move(public_path('storage/documents-customer'), $fileName);
                $data_update = Document::where('id',$input['documents_id'])->update([
                    'document_name' =>  $request->file('document-file')->getClientOriginalName(),
                    'file_name'=>$fileName,
                    'comments'=>$input['message'],
                    'status'=>$input['status']
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
            $data_update = Document::where('id',$input['documents_id'])->update([
                'comments'=>$input['message'],
                'status'=>$input['status']
            ]);
            Toastr::success('Document Updated Sucessfully', 'Success');
            return back();

        }

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

     public function createTaskPolicy(Request $request){

        $input = $request->all();



        $validator = Validator::make($input, [
                        'responsible' => 'required',
                        'datepicker' => 'required',
                        'subject' => 'required',
                        'message' => 'required'
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
                'description'=>$input['message'],
                'entity_id'=>$input['policy_id'],
                'entity_type'=>'policy_task',
                'customer_id'=>$input['customer_id'],
                'created_by'=>Auth::user()->id
            ]);
            Toastr::success('Task Added Sucessfully', 'Success');
            return back();
        }


    }

    public function updatePolicyTask(Request $request){

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

    public function updateDelivery(Request $request){

        $input = $request->all();
        // dd(date('Y-m-d H:i:s',strtotime($input['date_time'])));
        // dd($input);
        $validator = Validator::make($input, [
                        'delivery_address' => 'required',
                        'delivery_city'=> 'required',
                        'delivery_time'=> 'required',
                        'delivery_date'=> 'required'

                    ]);
        if($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        else{
            $delivary_update = Policy::where('policy_id',$input['policy_id'])->update([
                'delivery_address'=>$input['delivery_address'],
                'delivery_city'=>$input['delivery_city'],
                'delivery_date'=>date("Y-m-d",strtotime($input['delivery_date'])),
                'delivery_time'=>date("H:i:s",strtotime($input['delivery_time']))
            ]);
            Toastr::success('Delivery Updated Sucessfully', 'Success');
            return back();

        }
    }

    public function getCarVariant($policy_id)
    {
        $car_details = Car::where('policy_id','LIKE',"%$policy_id%")->first();
        if(!empty($car_details['car_tpye']))
        {
            $id = $car_details['car_tpye'];
        }
        else{
            $id = "5387b8bf5632";
        }
        $car_type = TplType::where('tpl_type_id',$id)->first();

        return $car_type;
    }
}
