<?php

namespace App\Http\Controllers\API\Condition;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use URL;
use App\Models\TermsCondition;

class GeneralConditionController extends Controller
{
      /**
     * show one Car API
     * @return \Illuminate\Http\Response
     * 
     * @OA\Post(
     *      path="/api/general-condition",
     *      operationId="GeneralCondition",
     *      tags={"Condition"},
     *      summary=" get general condition",
     *      @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="application/json",
     *                      @OA\Schema(
     *                        @OA\Property(
     *                          property="insurer_policy_id",
     *                            type="string"
     *                           ),
     *                 
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

    public function getGeneralCondition(Request $request)
    {
        $input = $request->all();
        $get_general_condition =TermsCondition::where('insurer_policy_id',$input['insurer_policy_id'])->select('policy_file')->first();
        if(!empty($get_general_condition))
        {
            $storage_path = '/storage/uploads/terms_condition/';
            $url = $storage_path.$get_general_condition['policy_file'];
            $pdf_file = URL::asset($url);

            //$storage_path = storage_path('app/public/uploads/terms_condition/Mysig_terms_of_use');
            //$url = $storage_path.'.' . 'pdf';
            //$pdf_file = URL::asset($url);

            if(!empty($pdf_file))
            {
                return response()->json(['success' => true, 'message' => $pdf_file], 200);
            }
            else{
                return response()->json(['success' => false, 'message' => 'URL not found'], 400);
            }
        }
        else{
            return response()->json(['success' => false, 'message' => 'URL not found'], 400);
        }
    }
}
