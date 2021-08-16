<?php

namespace App\Http\Controllers\API\insurer\policy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Rules\DateFormat;

use App\Models\Policy;
use PDF;
use URL;

class PolicyController extends Controller
{
    /**
     * User Document API
     * @return \Illuminate\Http\Response
     * @OA\Post(
     *      path="/api/policy/mypolicy-document",
     *      operationId="policydocument",
     *      tags={"Policy Document"},
     *      summary="my policy document link",
     *      @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="multipart/form-data",
     *                      @OA\Schema(
     *                       type="object",
     *                       @OA\Property(
     *                          property="company_details",
     *                            type="string"
     *                           ),
     *                      @OA\Property(
     *                          property="policy_name",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                          property="policy_type_name",
     *                            type="string"
     *                           ),
     *                      @OA\Property(
     *                          property="policy_number",
     *                            type="string"
     *                           ),
     *                      @OA\Property(
     *                          property="start_date",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                          property="end_date",
     *                            type="string"
     *                           ),
     *                       @OA\Property(
     *                         property="payment_method",
     *                         type="string",
     *                        ),
     *                       
     *                                 )
     *                           ),
     *                        ),
     *      description="my policy document link",
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
	 *          {"bearerAuth": {}}
	 *      },
     *     )
     *
     * Returns Document information message
     */
    public function getDocument(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'company_details'=>'required|string|max:255',
            'policy_name'=>'required|string|max:255',
            'policy_type_name'=>'required|string|max:255',
            'policy_number'=>'required|string|max:255',
            'start_date' => ['required',new DateFormat],
            'end_date'=>['required' ,new DateFormat],
            'payment_method'=>'required',
        ]);
        if($validator->fails()){
            return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
        }
        
        view()->share('pdf_data',$input);
        $pdf = PDF::loadView('policy-pdf-document');
        $path = 'storage/pdf';
        $file_name = "policy_pdf".uniqid()."."."pdf";
        $pdf->save($path . '/' . $file_name);

        $pdf_file = URL::asset($path."/".$file_name);
        
        return response()->json(['success' => true, 'message' => $pdf_file], 200);
       
    }

    public function pdfLoad($pdf_data)
    {
        view()->share('pdf_data',$pdf_data);
        $pdf = PDF::loadView('policy-pdf-document');
         return $pdf->stream();
    }
}