<?php

namespace App\Http\Controllers\API\insurer\car;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\Models\Car;
use App\User;
use App\Helpers\CarHelpers;

class CarController extends Controller
{


    /**
     * Store Car API
     * @return \Illuminate\Http\Response
     * 
     * @OA\Post(
     *      path="/api/car/add-car",
     *      operationId="addcar",
     *      tags={"Car"},
     *      summary=" add car",
     *      @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="application/json",
     *                      @OA\Schema(
     *                        @OA\Property(
     *                          property="car_registration_number",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="car_tpye",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="car_sub_type",
     *                            type="string"
     *                           ), 
     *                         @OA\Property(
     *                          property="car_vin_number",
     *                            type="string"
     *                           ),  
     *                          @OA\Property(
     *                          property="production_year",
     *                            type="string"
     *                           ),
     *                      )
     *                 ),
     *               ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *         security={
     *          {"bearerAuth": {}}
     *           },
     * )
     * 
     */
    public function storeCar(Request $request)
    {
        $input = $request->all();

        $user = Auth::user();
        if($user){
            $production_year = null;
            $user_id=$user['user_id'];
            if(isset($input['production_year'])){
                $production_year = $input['production_year'];
                $validator = Validator::make($input, [
                    'production_year' => 'required'  
                ]);
            
                if($validator->fails()){
                    return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
                }
            }
           $validator = Validator::make($input, [
                'car_registration_number' => 'required|string|max:255',
                'car_vin_number' => 'required|string|max:255',
                'car_tpye' => 'required|string|max:255',
                'car_sub_type' => 'required|string|max:255',    
            ]);
           $custom_error = trans('layout-errors.all_field');
            if($validator->fails()){
                return response()->json(['success' => false, 'message' =>$custom_error], 400);
            }

            if(isset($input['car_registration_number'])){

                $check_car = CarHelpers::checkCarExistance(Auth::user()->user_id,$input['car_registration_number']);
                // $find_car = Car::where('car_registration_number',$input['car_registration_number'])->first();
                if(!empty($check_car)){
                    return response()->json(['success' => false, 'message' => 'registration number already taken!!'],400);
                }
                $user_car = Car::create([
                    'car_id' => uniqid(),
                    'user_id' => $user['user_id'],
                    'car_registration_number' => $input['car_registration_number'],
                    'car_vin_number' => $input['car_vin_number'],
                    'car_tpye' => $input['car_tpye'],
                    'car_sub_type' => $input['car_sub_type'],
                    'production_year' => $production_year,
                        ]);
                if($user_car) {
                    $car_list = Car::orderBy('id','desc')->get();
                    return response()->json(['success' => true, 'message' => 'Car Added successfully !','car_list' => $car_list],200);
                } else {
                    return response()->json(['success' => false, 'message' => 'Car Added Unsuccessfully !'],400);
                }
            }
        }else{
            return response()->json(['success'=>false,'message' => 'User not found !'],400);
        }
    }
     /**
     * Car list API
     * @return \Illuminate\Http\Response
     * @OA\Get(
     *      path="/api/car/showCarlist",
     *      operationId="allcarlist",
     *      tags={"Car"},
     *      summary="car list",
     *      description="all car show",
     * 
     * 
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
	 *          {"bearerAuth": {}}
	 *      },
     *     )
     *
     * Returns profile information message
     */
    public function showAllCar()
    {
        $user = Auth::user();
        if($user){
            $car_list = Car::where('user_id',$user['user_id'])->orderBy('id','desc')->get();
            if(!empty($car_list))
            {
                return response()->json(['success' => true, 'car_list' => $car_list], 200);
            }
            else{
                return response()->json(['success' => false, 'car_list' => 'not found'],400);
            }
        }
    }
     /**
     * show one Car API
     * @return \Illuminate\Http\Response
     * 
     * @OA\Get(
     *      path="/api/car/{car_registration_number}",
     *      operationId="editcar",
     *      tags={"Car"},
     *      summary=" get  one car Information",
     *      @OA\Parameter(
     *          name="car_registration_number",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *         security={
     *          {"bearerAuth": {}}
     *           },
     * )
     * 
     */
    public function showCar($car_registration_number)
    {
        $user = Auth::user();
        if($user){
            if(isset($car_registration_number)) {
                $car_list = Car::where([
                    ['car_registration_number' ,'=',$car_registration_number],
                    ['user_id' ,'=',$user['user_id']]
                ])->first();
                if(isset($car_list)){
                    return response()->json(['success' => true, 'message' => 'Car  found !','car_list' => $car_list],200);
                }else {
                    return response()->json(['success' => false, 'message' => 'Car not found !'],400);
                }
                
            }
        } 
    }
     /**
     * @OA\Put(
     *      path="/api/car/{car_registration_number}",
     *      operationId="updateCar",
     *      tags={"Car"},
     *      summary="Update existing Car",
     *      @OA\Parameter(
     *          name="car_registration_number",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\RequestBody(
     *           @OA\MediaType(
     *                mediaType="application/json",
     *                      @OA\Schema(
     *                        @OA\Property(
     *                          property="car_registration_number",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="car_tpye",
     *                            type="string"
     *                           ),
     *                         @OA\Property(
     *                          property="car_sub_type",
     *                            type="string"
     *                           ),  
     *                          @OA\Property(
     *                          property="production_year",
     *                            type="string"
     *                           ),
     *                      )
     *                 ),
     *               ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *         security={
     *          {"bearerAuth": {}}
     *           },
     * )
     * 
     */
    public function updateCar(Request $request ,$car_registration_number)
    {
        $user =  Auth::user();
        if($user){
            if(isset($car_registration_number)) {
                $car_list = Car::where([
                    ['car_registration_number' ,'=',$car_registration_number],
                    ['user_id' ,'=',$user['user_id']]
                ])->first();
                if(isset($car_list)){
                    Car::where('car_id', $car_list['car_id'])->update(['car_registration_number' => '']);
                    $input = $request->all();
                    $production_year = null;
                    if(isset($input['production_year'])){
                        $production_year = $input['production_year'];
                        $validator = Validator::make($input, [
                            'production_year' => 'required'  
                        ]);
                    
                        if($validator->fails()){
                            return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
                        }
                    }
                    $validator = Validator::make($input, [
                        'car_registration_number' => 'required|string|max:255',
                        'car_vin_number' => 'required|string|max:255',
                        'car_tpye' => 'required|string|max:255',
                        'car_sub_type' => 'required|string|max:255',    
                    ]);
    
                    if($validator->fails()){
                        return response()->json(['success' => false, 'message' =>$validator->errors()->toJson()], 400);
                    }
                    if(isset($input['car_registration_number'])){
                    
                        $check_car = CarHelpers::checkCarExistance(Auth::user()->user_id,$input['car_registration_number']);

                        // $find_car = Car::where('car_registration_number',$input['car_registration_number'])->first();
                        if(!empty($check_car)){
                            return response()->json(['success' => false, 'message' => 'registration number already taken!!'],400);
                        }
                        $user_car = Car::where([
                            ['car_id','=',$car_list['car_id']],
                            ['user_id','=',$user['user_id']]
                            ])->update([
                                        'car_registration_number' => $input['car_registration_number'],
                                        'car_vin_number' => $input['car_vin_number'],
                                        'car_tpye' => $input['car_tpye'],
                                        'car_sub_type' => $input['car_sub_type'],
                                        'production_year' => $production_year,
                                        ]);
                        if($user_car) {
                            $car_list = Car::where([
                                ['car_registration_number' ,'=',$input['car_registration_number']],
                                ['user_id' ,'=',$user['user_id']],
                                ['car_id','=',$car_list['car_id']]
                            ])->first();
        
                            return response()->json(['success' => true, 'message' => 'Car Updated successfully !','car_list' => $car_list],200);
                        } else {
                            return response()->json(['success' => false, 'message' => 'Car Updated Unsuccessfully !'],400);
                        }
                    }
                }else {
                    return response()->json(['success' => false, 'message' => 'Car not found !'],400);
                }
                
            } 
        }
       
    }
     /**
     * Delete one Car API
     * @return \Illuminate\Http\Response
     * 
     * @OA\Delete(
     *      path="/api/car/{car_registration_number}",
     *      operationId="deletecar",
     *      tags={"Car"},
     *      summary=" Delete existing Car",
     *      @OA\Parameter(
     *          name="car_registration_number",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *         security={
     *          {"bearerAuth": {}}
     *           },
     * )
     * 
     */
    public function deleteCar($car_registration_number){
        $user = Auth::user();
        if($user){
            if(isset($car_registration_number)){
                $car_list = Car::where([
                    ['car_registration_number','=',$car_registration_number],
                    ['user_id','=',$user['user_id']]
                    ])->first();
                if(isset($car_list)){
                    $car_delete = Car::where([
                        ['car_id','=',$car_list['car_id']],
                        ['user_id','=',$user['user_id']],
                        ])->delete();
                    if($car_delete){
                        return response()->json(['success' => true, 'message' => 'Car Deleted successfully !'],200);
                    } else {
                        return response()->json(['success' => false, 'message' => 'Car Deleted Unsuccessfully !'],400);
                    }
                }else{
                    return response()->json(['success' => false, 'message' => 'Car not found !'],400);
                }
            }
        }
    }
}
