<?php

namespace App\Http\Controllers\API\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Config;
use App\Models\TransactionDetails;
use Illuminate\Support\Facades\Auth;

require_once(app_path().'/easypay.lib');

class PaymentGateway extends Controller
{
  /**
     * Easy Payment Gateway API
     * @return \Illuminate\Http\Response
     * 
     * @OA\Post(
     *      path="/api/easy-payment-gateway",
     *      operationId="Payment",
     *      tags={"Payment"},
     *      summary="Payment",
     *      @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="multipart/form-data",
     *                      @OA\Schema(
     *                       type="object",
     *                       @OA\Property(
     *                          property="amount",
     *                            type="string"
     *                           ),
     *                                 )
     *                           ),
     *                        ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *         security={
     *          {"bearerAuth": {}}
     *           },
     * )
     * 
     */

    
    public function postPaymentGateway(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'amount' => 'required'
        ]);
        if($validator->fails()){
            return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
        }
        $orderId = uniqid();
        $value = $input['amount'];
        $code = Config::get('app.Easy_Pay');
        // return $code;
        // $code = "75c7a013c5ac48bcbc0798456e77de56";
        $button_id = 87;
        try{
            $response = startEasypay($orderId, $value, $code, $button_id);
            if(!empty($response->success))
            {
                //transaction create
                TransactionDetails::create([
                    'user_id'=>Auth::user()->user_id,
                    'amount'=>$input['amount'],
                    'order_id'=>$orderId,
                    'transaction_id'=>$response->transactionId
                ]);
                return response()->json(['success' => true, 'message' => $response,'orderId'=>$orderId],200);
            }
            else
            {
                return response()->json(['success' => false, 'message' => 'There was an error while generating the transaction'],400);
            //ERROR HANDLING
            } 
        }
        catch(\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()],400);
          }
    }

    // function startEasypay($orderId, $value, $code, $button_id )
    // {
    //     $url = "https://intern-apps.easypay.als-sandbox/apis/start";
    //     $data = "button_id=$button_id&order_id=$orderId&value=$value&code=$code";
       
    //     $ch = curl_init($url);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    //                         'Content-length: '.strlen($data),
    //                         'Referer: ' . $_SERVER['SERVER_NAME']
    //         ));
    //     $r = curl_exec($ch);
    //     curl_close($ch);
    //     // dd($r);
    //     return json_decode($r);
    // }


     /**
     * Easy Payment Gateway API
     * @return \Illuminate\Http\Response
     * 
     * @OA\Post(
     *      path="/api/post-update-transaction-details",
     *      operationId="Payment",
     *      tags={"Payment"},
     *      summary="Payment Transaction Save",
     *      @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="multipart/form-data",
     *                      @OA\Schema(
     *                       type="object",
     *                       @OA\Property(
     *                          property="order_id",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="status",
     *                            type="bool"
     *                           ),
     *                                 )
     *                           ),
     *                        ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *         security={
     *          {"bearerAuth": {}}
     *           },
     * )
     * 
     */

    public function postUpdateTransactionDetails(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'order_id' => 'required',
            'status' => 'required|bool'
        ]);
        if($validator->fails()){
            return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
        }
        //transaction update
        try{
        TransactionDetails::where('order_id',$input['order_id'])->update(['status'=>1]);

        return response()->json(['success' => true, 'message' =>'Transaction Updated Successfully'],200);
        }
        catch(\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()],400);
          }
    }
}
