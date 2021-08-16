<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;
use App\Models\PaymentMethod;
use App\Models\CodTransaction;
use App\Models\PaypalTransaction;
// use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceEmail;
use Mail;
use Log;
use PDF;
use URL;
use Barryvdh\Snappy;


class SuccessController extends Controller
{
    public function paymentSuccess(Request $request, $policy_id){
        Log::channel('customlog')->debug($request);
        // dd($request);

        $input = $request->all();
        Auth::loginUsingId($input['id'], true);

        $user = Auth::user();
        if(isset($user)){
            $token = auth('api')->tokenById($user->id);
        }
        
        if(!empty($input)){
            $transaction_data = [
                'transaction_id'=>uniqid(),
                'invoice_number'=>'PL'.uniqid(),
                'MbrId'=>$input['MbrId']?$input['MbrId']:null,
                'MerchantID'=>$input['MerchantID'],
                'OrderId'=>$input['OrderId'],
                'PurchAmount'=>$input['PurchAmount'],
                'Currency'=>$input['Currency'],
                'PayerTxnId'=>$input['PayerTxnId'],
                'PayerAuthenticationCode'=>$input['PayerAuthenticationCode'],
                'Lang'=>$input['Lang'],
                'BonusAmount'=>$input['BonusAmount'],
                'AlphaCode'=>$input['AlphaCode'],
                'MrcName'=>$input['MrcName'],
                'CardHolderName'=>$input['CardHolderName'],
                'TxnResult'=>$input['TxnResult'],
                'AuthCode'=>$input['AuthCode'],
                'TxnType'=>$input['TxnType'],
                'CardMask'=>$input['CardMask'],
                'ShippingNameSurname'=>$input['ShippingNameSurname'],
                'ShippingEmail'=>$input['ShippingEmail'],
                'ShippingAddress'=>$input['ShippingAddress'],
                'ShippingCountry'=>$input['ShippingCountry'],
                'ShippingCity'=>$input['ShippingCity'],
                'ShippingZipCode'=>$input['ShippingZipCode'],
                'BillingNameSurname'=>$input['BillingNameSurname'],
                'BillingEmail'=>$input['BillingEmail'],
                'BillingAddress'=>$input['BillingAddress'],
                'BillingCountry'=>$input['BillingCountry'],
                'BillingCity'=>$input['BillingCity'],
                'BillingZipCode'=>$input['BillingZipCode'],
                'BillingPhone'=>$input['BillingPhone'],
                'TransactionDate'=>$input['TransactionDate'],
                'RequestMerchantDomain'=>$input['RequestMerchantDomain'],
                'policy_id' =>$input['policy_id'],
                'payment_status' => 'success',
            ];
    
            $data = Transaction::where('policy_id',$input['policy_id'] )->update($transaction_data);

        }else{
            $transaction_data = [
                'invoice_number'=>'PL'.uniqid(),
                'transaction_id'=>uniqid(),
                'ShippingNameSurname'=>'Test Test',
                'CardHolderName'=>'Rimpal Paul',
                'CardMask'=>"543723******1336",
                'TxnType' => 'Auth',
                'PurchAmount' => 1000,
                'BillingEmail'=> 'rimpalofficial97@gmail.com',
                'BillingAddress'=> 'Test Test Test',
                'BillingCountry'=> 'Albania',
                'BillingCity'=> 'Testing City',
                'BillingZipCode'=> 1000,
                'BillingPhone'=> 700078487,
                'TransactionDate'=> '08.02.2021 12:01:57',
                'OrderId'=> 'SYS_672103',
                'AuthCode'=>'PL00012',
                'payment_status' => 'success',
                'policy_id' =>$input['policy_id'],    
            ];
            $data = Transaction::where('policy_id',$input['policy_id'] )->update($transaction_data);


        }

        // dd($input);
        return view('fontend.dashboard.frontend-thankYou',compact('transaction_data'));
    }

    public function updateTransactionDetails(Request $request){
        $update_data = Transaction::where('transaction_id',$request->transaction_id)->update([
            'policy_id'=>$request['policy_id']
        ]);

    }

    public function paymentFailed(Request $request){


        Log::channel('customlog')->debug($request);
        $input = $request->all();
        Auth::loginUsingId($input['id'], true);

        $user = Auth::user();
        if(isset($user)){
            $token = auth('api')->tokenById($user->id);
        }

        if(!empty($input['MbrId'])){
            $transaction_data = [
                'transaction_id'=>uniqid(),
                'invoice_number'=>'PL'.uniqid(),
                'MbrId'=>$input['MbrId']?$input['MbrId']:null,
                'MerchantID'=>$input['MerchantID'],
                'OrderId'=>$input['OrderId'],
                'PurchAmount'=>$input['PurchAmount'],
                'Currency'=>$input['Currency'],
                'PayerTxnId'=>$input['PayerTxnId'],
                'PayerAuthenticationCode'=>$input['PayerAuthenticationCode'],
                'Lang'=>$input['Lang'],
                'BonusAmount'=>$input['BonusAmount'],
                'AlphaCode'=>$input['AlphaCode'],
                'MrcName'=>$input['MrcName'],
                'CardHolderName'=>$input['CardHolderName'],
                'TxnResult'=>$input['TxnResult'],
                'AuthCode'=>$input['AuthCode'],
                'TxnType'=>$input['TxnType'],
                'CardMask'=>$input['CardMask'],
                'ShippingNameSurname'=>$input['ShippingNameSurname'],
                'ShippingEmail'=>$input['ShippingEmail'],
                'ShippingAddress'=>$input['ShippingAddress'],
                'ShippingCountry'=>$input['ShippingCountry'],
                'ShippingCity'=>$input['ShippingCity'],
                'ShippingZipCode'=>$input['ShippingZipCode'],
                'BillingNameSurname'=>$input['BillingNameSurname'],
                'BillingEmail'=>$input['BillingEmail'],
                'BillingAddress'=>$input['BillingAddress'],
                'BillingCountry'=>$input['BillingCountry'],
                'BillingCity'=>$input['BillingCity'],
                'BillingZipCode'=>$input['BillingZipCode'],
                'BillingPhone'=>$input['BillingPhone'],
                'TransactionDate'=>$input['TransactionDate'],
                'RequestMerchantDomain'=>$input['RequestMerchantDomain'],
                'policy_id' =>$input['policy_id'],
                'payment_status' => 'Failed',
            ];
    
        }else{
            $transaction_data = [
                'transaction_id'=>uniqid(),
                'ShippingNameSurname'=>'Test Test',
                'CardMask'=>"543723******1336",
                'policy_id' =>$input['policy_id'],
                'payment_status' => 'Failed',
                'PurchAmount' => 1000,
            ];
        }
        $data = Transaction::where('policy_id',$input['policy_id'] )->update($transaction_data);
        return view('fontend.dashboard.frontend-paymentFailed',compact('input')); 
        

    }

    public function sendInvoiceEmail(Request $request){
        $input = $request->all();
        $input['TransactionDate'] =  date("m/d/Y", strtotime($input['TransactionDate']));  
        $input['start_date'] =  date("m/d/Y", strtotime($input['start_date']));  
        $input['expiry_date'] =  date("m/d/Y", strtotime($input['expiry_date']));  
        
        view()->share('invoice_pdf_data',$input);
        $pdf = PDF::loadView('fontend.dashboard.invoice-pdf');
        $path = storage_path('app/public/uploads/invoices_pdf');
        $file_name = "invoice_".$input['invoice_number']."."."pdf";
        $pdf->save($path . '/' . $file_name);

        $pdf_file = URL::asset($path."/".$file_name);
        $down = $pdf->download('invoice.pdf');
        $data=$input;
        $data['attachments'] =
            [
                "path" =>storage_path('app/public/uploads/invoices_pdf'.'/'.$file_name),
                "as" => $file_name,
                "mime" => "application/pdf",
            ];

        $mail=Mail::to($input['BillingEmail'])->send(new InvoiceEmail($data));
        return response()->json(['success' => true, 'message' => $pdf_file], 200);


    }
    public function LoginUser(Request $request){
        $input=$request->all();

        Auth::loginUsingId($input['id'], true);
        $user = Auth::user();
        $token = auth('api')->tokenById($user->id);
        // dd($token);
    }

    public function paymentCreate(Request $request){
        $input=$request->all();

        $payment_method_save = PaymentMethod::create([
            'policy_id' => $input['policy_id'],
            'payment_method' => $input['payment_method'],
        ]);

        if($payment_method_save) {
            return response()->json(['success' => true, 'msg' => 'Successfully Saved!'],200);
        }

    }

    public function codCreate(Request $request){
        $input=$request->all();
        $cod_validation = $this->codValidation($input);
        if ($cod_validation->fails()){
            return response()->json(['success' => false, 'errors' => $cod_validation->getMessageBag()->toArray()], 400);
        }

        $cod_save = CodTransaction::create([
            'transaction_id' => uniqid(),
            'policy_id'      => $input['policyId'],
            'amount'         => $input['amount'],
            'notes'          => $input['notes'],
            'date'           => date('Y-m-d',strtotime($input['date_range'])),
        ]);

        if($cod_save){
            return response()->json(['success' => true, 'msg' => 'Successfully Saved!'],200);
        }else{
            return response()->json(['success' => false, 'msg' => 'Unsuccessful!'],200);
        }

    }

    protected function codValidation($request){
        if (isset($request)){
			return Validator::make($request,[
				'amount'     => 'required|numeric',
                'date_range' => 'required',
                'notes'      => 'required'
			]);
		}
    }

    public function paypalDetailsSave(Request $request){
        $input=$request->all();
        $paypalSave = PaypalTransaction::create([
            'policy_id'     => $input['policy_id'],
            'Payment_id'    => $input['PaymentId'],
            'Paypal_intent' => $input['intent'],
            'Paypal_status' => $input['status'],
            'payer_id'      => $input['payerId'],
            'payer_email'   => $input['payerEmail'],
            'payer_name'    => $input['payerName']
        ]);
        if($paypalSave) {
            return response()->json(['success' => true, 'msg' => 'Successfully Saved!'],200);
        } else {
            return response()->json(['success' => false, 'msg' => 'Unsuccessful!'],200);
        }
    }

    public function codApi(Request $request){
        $input=$request->all();

        $validator = Validator::make($request->all(), [
            'policy_id'     => 'required',
            'payment_method' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['error'=> $validator->errors()]);
        }

        $codApiDataSave = PaymentMethod::create([
            'policy_id'      => $input['policy_id'],
            'payment_method' => $input['payment_method'],
        ]);
        if($codApiDataSave)
        {
            return response()->json(['success' => true, 'data'=>$codApiDataSave, 'msg' => 'Successfully Saved!'],200);
        }
    }

    public function paypalApi(Request $request)
    {
        $input=$request->all();

        $validator = Validator::make($request->all(), [
            'policy_id'     => 'required',
            'payment_id'    => 'required',
            'paypal_intent' => 'required',
            'paypal_status' => 'required',
            'payer_id'      => 'required',
            'payer_email'   => 'required',
            'payer_name'    => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['error'=> $validator->errors()]);
        }

        $codApiDataSave = PaypalTransaction::create([
            'policy_id'     => $input['policy_id'],
            'Payment_id'    => $input['payment_id'],
            'Paypal_intent' => $input['paypal_intent'],
            'Paypal_status' => $input['paypal_status'],
            'payer_id'      => $input['payer_id'],
            'payer_email'   => $input['payer_email'],
            'payer_name'    => $input['payer_name'],
        ]);
        if($codApiDataSave)
        {
            return response()->json(['success' => true, 'data'=>$codApiDataSave, 'msg' => 'Successfully Saved!'],200);
        }

    }
}

