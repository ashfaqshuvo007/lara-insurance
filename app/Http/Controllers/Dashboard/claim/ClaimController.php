<?php

namespace App\Http\Controllers\Dashboard\claim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Claim;
use App\Models\Policy;
use App\Models\Insurer;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\User;
use App\Models\Customer;
use App\Models\Status_tracking;
use App\Models\Task;
use App\Models\LossInfo;






class ClaimController extends Controller
{
    public function getShowViewClaim()
    {
        return view('dashboard.viewclaim.view-claim');
    }
    public function getShowViewClaimData($id)
    {

        $claim_data=Claim::where('claims_id',$id)
                            ->first();

        $documents_customer = Document::where('entity_id',$id)
                            ->where('entity_type','claim_documents_customer')
                            ->get();

        $claim_documents = Document::where('entity_id',$id)
                            ->where('entity_type','claim_documents')
                            ->get();

        $claim_policy_data = Claim::select('*')

                            ->leftJoin('policy', 'claims.policy_id', '=', 'policy.policy_id')
                            ->where('claims_id',$id)
                            ->first();

        $get_customer = Claim::select('*')
                            ->join('users', 'users.user_id', '=', 'claims.user_id')
                            ->whereIn('users.user_type', ['Individual', 'admin'])
                            ->where('users.status', 1)
                            ->where('claims_id',$id)
                            ->first();


        $get_all_user = User::where('user_type', 'admin')
                            ->where('status',1)
                            ->orderBy('name','ASC')
                            ->get();

        $get_task_detalis=Task::where('entity_id',$id)->get();

        $last_claim_status = Status_tracking::where('entity_id',$id)
                                        ->where('entity','claim')
                                        ->orderBy('id', 'DESC')
                                        ->first();

        $claim_status = Status_tracking::where('entity_id',$id)
                                        ->where('entity','claim')
                                        ->get();

        $data['loss']=LossInfo::where('entity_id',$id)
                            ->where('entity','claim')
                            ->first();




        $get_insurer=Claim::where('claims_id',$id)->with('getinsurer','getsubPolicy')->first();


        return view('dashboard.viewclaim.view-claim',compact('data','get_insurer','claim_status','last_claim_status','get_task_detalis','claim_data','claim_policy_data','documents_customer','claim_documents','get_customer','get_all_user'));
    }

    public function  CreateDocumentClaimCustomer(Request $request){
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
                $fileName = "claim-documents-customer".time().'.'.$request->file('browse')->extension();
                $request->file('browse')->move(public_path('storage/claim-documents-customer'), $fileName);

                $user = Document::create([
                    'document_id'=>uniqid(),
                    'entity_type'=>"claim_documents_customer",
                    'entity_id'=>$input['clamin_id'],
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
    public function editDocumentClaimCustomer(Request $request){
        $input = $request->all();
        $id = $input['data'];
        $data = Document::findOrFail($id);
        return $data;
    }


    public function updateDocumentClaimCustomer(Request $request){
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

                    if(file_exists(public_path('/storage/claim-documents-customer/'.$file_name_data)))
                    {
                        unlink(public_path('/storage/claim-documents-customer/'.$file_name_data));
                    }

                $fileName = "claim-documents-customer".time().'.'.$request->file('document-file')->extension();
                $request->file('document-file')->move(public_path('storage/claim-documents-customer'), $fileName);
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

    public function  CreateDocumentClaim(Request $request){
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
                $fileName = "claim-documents".time().'.'.$request->file('browse')->extension();
                $request->file('browse')->move(public_path('storage/claim-documents'), $fileName);

                $user = Document::create([
                    'document_id'=>uniqid(),
                    'entity_type'=>"claim_documents",
                    'entity_id'=>$input['clamin_id'],
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

    public function editDocumentClaim(Request $request){
        $input = $request->all();
        $id = $input['data'];
        $data = Document::findOrFail($id);
        return $data;
    }

    public function updateDocumentClaim(Request $request){
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

                    if(file_exists(public_path('/storage/claim-documents/'.$file_name_data)))
                    {
                        unlink(public_path('/storage/claim-documents/'.$file_name_data));
                    }

                $fileName = "claim-documents".time().'.'.$request->file('document-file')->extension();
                $request->file('document-file')->move(public_path('storage/claim-documents'), $fileName);
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



    public function CreateTaskClaim(Request $request){

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
                'entity_id'=>$input['clamim_id'],
                'entity_type'=>'claim_task',
                'customer_id'=>$input['customer_id'],
                'created_by'=>Auth::user()->id
            ]);
            Toastr::success('Task Added Sucessfully', 'Success');
            return back();
        }


    }



    public function updateClaimTask(Request $request){

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



    public function updateClaimStatus(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
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
                'entity'=>'claim',
                'entity_id'=>$input['claim'],
                'status'=>$input['status'],
                'loss_date'=>date('Y-m-d',strtotime($input['datepicker'])),
                'date_submitted_broker'=>date('Y-m-d',strtotime($input['broker'])),
                'settlement_date'=>date('Y-m-d',strtotime($input['settlement_date'])),
                'created_by'=>Auth::user()->user_id
            ]);


            $laststatus = Claim::where('claims_id',$data->entity_id)->update([
                'status'=>$data->status,
            ]);




            Toastr::success('Status Sucessfully Updated', 'Success');
            return back();
        }
    }

    public function updateClaimLoss(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
                        'loss_location' => 'required',
                        'description' => 'required'

                    ]);
        if($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        else{

            $checkloss=LossInfo::where('entity_id',$input['clamin_id'])->get();

            if($checkloss->isEmpty())
            {
                $data = LossInfo::create([
                    'loss_id'=>uniqid(),
                    'entity'=>'claim',
                    'entity_id'=>$input['clamin_id'],
                    'loss_location'=>$input['loss_location'],
                    'loss_description'=>$input['description']

                ]);
                Toastr::success('Status Sucessfully Updated', 'Success');
                return back();

            }else{

                $data = LossInfo::where('loss_id',$input['loss_id'])->update([
                    'entity'=>'claim',
                    'entity_id'=>$input['clamin_id'],
                    'loss_location'=>$input['loss_location'],
                    'loss_description'=>$input['description']

                ]);
                Toastr::success('Status Sucessfully Updated', 'Success');
                return back();
            }




        }
    }

    public function updatePolicyInfo(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
                        'policy_no' => 'required',
                        'end_date' => 'required',
                        'insured' => 'required'

                    ]);
        if($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        else{
            $user = Policy::where('policy_id',$input['policy_id'])->update([

                'policy_number'=>$input['policy_no'],
                'expiry_date'=>date('Y-m-d',strtotime($input['end_date'])),
                'prospect_name'=>$input['insured']

            ]);
            Toastr::success('Status Sucessfully Updated', 'Success');
            return back();
        }

    }

    public function updateAmount(Request $request){
        $input = $request->all();
        // dd($input);
        $validator = Validator::make($input, [
                        'amount' => 'required |numeric',
                        'reserve' => 'required |numeric',
                        'deduction' => 'required |numeric',
                        'final_amount' => 'required |numeric',
                        'part_amount' => 'required |numeric'

                    ]);
        if($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        else{

            $user = Claim::where('claims_id',$input['claim_id'])->update([

                'settled_amount'=>$input['amount'],
                'reserve'=>$input['reserve'],
                'deduction'=>$input['deduction'],
                'final_amount'=>$input['final_amount'],
                'our_part'=>$input['part_amount']

            ]);
            Toastr::success('Status Sucessfully Updated', 'Success');
            return back();
        }

    }












}
