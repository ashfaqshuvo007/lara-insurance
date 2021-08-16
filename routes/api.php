<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//After Transaction
Route::post('/update-transaction-details','SuccessController@updateTransactionDetails');
Route::post('/send-mail','SuccessController@sendInvoiceEmail');
Route::post('/set-auth','SuccessController@LoginUser');
Route::post('/payment-create', 'SuccessController@paymentCreate');


Route::group(['namespace'=>'API'],function(){
    //Payment
    Route::post('/bkt/cardForm','Payment\PaymentController@generateCardForm');
    Route::get('/bkt/cardForm/{user_id}/{policy_id}','Payment\PaymentController@cardDetailsFormForBKTAPI');
    Route::get('/bkt/cardForm/tpl/{user_id}/{policy_id}','Payment\PaymentController@cardDetailsFormForBKTTPLForAPI');

    //user login&registration
    Route::post('/user/login','UserController@userLogin');
    Route::post('/user/register','UserController@userRegister');
    Route::post('/user/forgot-password','UserController@forgotPassword')->name('forgotPassword');
    //otp
    Route::post('/otp-send','UserController@sendOtp');
    Route::post('/otp-verified','UserController@otpVerification');

    //user deatials
    Route::group(['middleware' => ['jwt.verify']],function(){
        Route::get('/user/details/{language_type?}','UserController@getUserProfileDeatils');
        Route::post('/user/update-profile','UserController@updateUserProfile');
        Route::post('/user/change-password','UserController@changePassword');
        Route::get('/user/logout/{language_type?}','UserController@logout');
        Route::post('/buy-policy/home-policy-save','PolicyCreateController@createHomePolicy');
        Route::post('/buy-policy/travel-policy-save','PolicyCreateController@postSaveTravelPolicy');
        Route::post('/payment-method', 'Payment\PaymentController@codApi');
        Route::post('/paypal-details-save', 'Payment\PaymentController@paypalApi');
        Route::post('/cod-details-save', 'Payment\PaymentController@codDetailsSave');
        Route::group(['namespace' => 'PolicyList'],function(){
            Route::get('/user/policy-list','GetPolicyListController@getPolicyListOfUser');
            Route::get('/user/expire-policy-list','GetPolicyListController@getUserExiprePolicyList');
        });

        Route::group(['namespace'=>'Payment'],function(){
            Route::group(['prefix'=>'payment'],function(){
                Route::post('/easy-payment-gateway','PaymentGateway@postPaymentGateway');
                Route::post('/post-update-transaction-details','PaymentGateway@postUpdateTransactionDetails');
            });
        });

        //shipping
        Route::post('/user/shipping','User\UserShippingController@userShippingAddorUpdate');
        Route::get('/user/get/shippings','User\UserShippingController@getUserShippings');

        

    });
    //driver
    Route::group(['namespace'=>'driver','middleware' => ['jwt.verify']],function(){
        Route::post('/buy-policy/tpl-save','DriverController@postDriverDetailsSave');
        Route::post('/buy-policy/full-casco-save','FullCascoPolicyCreateController@postSaveFullCascoPolicy');
        Route::post('/buy-policy/green-card-save','GreenCardPolicyCreateController@postSaveGreenCardDetails');
        Route::post('/check/car-policy','CheckCarController@checkCarPolicyValidity');
        Route::post('/check/home-policy','CheckCarController@checkHomePolicyValidity');

    });

    //insurer
    Route::group(['namespace'=>'insurer','middleware' => ['jwt.verify']],function(){


    //insuer policy
        Route::group(['namespace'=>'policy'],function(){
            //Tpl
            //tpl type
            Route::get('/policy/tpl-type/{language_type}','TplController@getTplType');
            //tpl subtype
            Route::post('/policy/tpl-sub-type','TplController@getTplSubtype');
            //tpl
            Route::post('/policy/tpl','TplController@getTplListandSubList');
            //Green Card
            Route::post('/policy/green-card','GreenCardController@getListofGreenCard');
            Route::get('/policy/green-card-type/{language_type}','GreenCardController@getListofGreenCardType');
            Route::post('/policy/green-card-sub-type','GreenCardController@getGreenCardSubType');
            //Travel list
            Route::get('/policy/showTravelSubid/{language_type}','TravelController@showTravelsubId');

            Route::post('/policy/showTravelZone','TravelController@showTravelZone');

            Route::post('/policy/showTravelList','TravelController@showTravelHistory');
            //Home list
            Route::get('/policy/getHomeSubType/{language_type}','HomeController@showHomeSubType');
            Route::post('/policy/showHomeList','HomeController@showHomeList');
            //Full casco
            Route::get('/policy/get-full-casco-sub-type','FullcascoController@getFullCascoSubtype');
            Route::post('/policy/showFullCasco','FullcascoController@showFullCasco');
            // My Policy Document
            Route::Post('/policy/mypolicy-document','PolicyController@getDocument');

        });
        Route::group(['namespace'=>'car'],function(){
            //add car
            Route::get('/car/showCarlist','CarController@showAllCar');
            Route::post('/car/add-car','CarController@storeCar');
            Route::get('/car/{car_registration_number}','CarController@showCar');
            Route::put('/car/{car_registration_number}','CarController@updateCar');
            Route::delete('/car/{car_registration_number}','CarController@deleteCar');
        });
    });
    //claim
    Route::group(['namespace'=>'Claim','middleware'=>['jwt.verify']],function(){
        Route::post('/claim/car-policy','CarClaimController@postSavecarClaim');
        Route::post('/claim/home-policy','HomePolicyClaimController@postSaveHomeClaim');
        Route::get('/claim/get-claim-policy','GetClaimListController@getClaimPolicyList');
    });
    // General Conditions
    Route::group(['namespace'=>'Condition','middleware'=>['jwt.verify']],function(){
        Route::post('/general-condition','GeneralConditionController@getGeneralCondition');
    });

    // Language
    Route::group(['namespace'=>'Language','middleware'=>['jwt.verify']],function(){
        Route::get('/translate-language/{locale}','LanguageController@setLanguageLocale');
    });
    
});

