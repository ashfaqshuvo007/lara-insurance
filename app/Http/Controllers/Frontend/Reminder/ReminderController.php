<?php

namespace App\Http\Controllers\Frontend\Reminder;
use App\Http\Requests\ReminderRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Reminder;

class ReminderController extends Controller
{
   
    public function postSaveReminder(ReminderRequest $request)
    {

        $input=$request->all();
        
       /* if($input['insurance_type']=="71de088c1a2d")
        {
            $validator = Validator::make($input, [
                'name'     => 'required|string|max:255',
                'mobile_number' => 'required|min:6|max:10|regex:/^([0-9\s\-\+\(\)]*)$/',
                'email'    =>['required', 'max:255', 'regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/'],
                'due_date' =>'required|date',
                'insurance_type' =>'required|string|max:255',
                'registration_number'=>'required|string|max:255'
            ]);
        }
        else
        {
            $validator = Validator::make($input, [
                'name'     => 'required|string|max:255',
                'mobile_number' => 'required|min:6|max:10|regex:/^([0-9\s\-\+\(\)]*)$/',
                'email'    =>['required', 'max:255', 'regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/'],
                'due_date' =>'required|date',
                'insurance_type' =>'required|string|max:255'
            ]);
        }*/
        $validated = $request->validated();
        //reminder create 
        if($input['insurance_type']=="71de088c1a2d")
        {
            $data =[
                'name'=>$input['name'],
                'email'=>$input['email'],
                'mobile'=>$input['mobile_number'],
                'due_date'=>date("Y-m-d",strtotime($input['due_date'])),
                'insurance_type'=>$input['insurance_type'],
                'insurance_product'=>$input['registration_number']
            ];
        }
        else
        {
            $data =[
                'name'=>$input['name'],
                'email'=>$input['email'],
                'mobile'=>$input['mobile_number'],
                'due_date'=>date("Y-m-d",strtotime($input['due_date'])),
                'insurance_type'=>$input['insurance_type'],
                'insurance_product'=>NULL
            ];
        }

        try{

            Reminder::create($data);
            return response()->json(['success' => true, 'data' => 'Reminder Added'], 200);  
        }
        //catch exception
        catch(Exception $e) {
            return response()->json(['success' => false, 'error' =>$e->getMessage()]);
            // echo 'Message: ' .$e->getMessage();
        }
    }
}
