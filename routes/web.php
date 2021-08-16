<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Frontend\IndexController@showIndex')->name('home');
Route::get('localization/{locale}','LocalizationController@index');



// Auth::routes();
Auth::routes([
    'login' => false,
    ]);
//reset password
// Route::get('/reset-password/{token}/{user_id}',function(){
//     return view('auth.passwords.reset');
// })->name('reset_password');
Route::get('/admin-login','Auth\LoginController@showLoginForm')->name('admin_login');
Route::post('/sign-in','Auth\LoginController@login')->name('login');
    


Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/admin-login');
})->name('logout');
Route::get('/home', 'HomeController@index')->name('home');
//dashboard table
Route::get('/dashboard-table-data','HomeController@showQuaterdata')->name('dashboard_table_data');

Route::group(['namespace'=>'Register'],function(){
    Route::post('register-user','RegisterUserController@postSaveRegisterUser')->name('register_user');
});
//password reset
Route::group(['namespace'=>'Password'],function(){
    Route::post('reset-user-password','ResetPasswordController@passwordReset')->name('user_password_reset');
});
// Route::get('/pdf-load/{data}','PolicyController@pdfLoad')->name('pdf');
Route::post('cod-create','SuccessController@codCreate')->name('cod-create');
Route::post('paypalDetailsSave', 'SuccessController@paypalDetailsSave')->name('paypalDetailsSave');

Route::group(['middleware'=>['auth','user-check']],function(){
    Route::group(['namespace'=>'User'],function(){
        Route::get('profile','UserController@getShowProfile')->name('user_profile');
        Route::get('view-policy','UserController@getShowViewPolicy')->name('view_policy');
        Route::post('save-updated-profile','UserController@postSaveuserUpdateDeatils')->name('save_updated_profile');
        Route::post('save-updated-password','UserController@postSavePassword')->name('save_updated_password');
    });
    Route::group(['namespace'=>'Dashboard'],function(){
        Route::group(['prefix' => 'dashboard'], function () {
            Route::get('user-upcoming-policy/{id?}','DashBoardController@getShowUpcomingPolicy')->name('user_upcoming_policy');
            Route::get('user-converted-policy','DashBoardController@getShowConvertedPolicy')->name('user_converted_policy');
            Route::get('failed-payment-policy','DashBoardController@getShowFailedPolicy')->name('failed-payment-policy');
            Route::get('user-customer/{id?}','DashBoardController@getShowCustomer')->name('user_customer_policy');
            Route::get('claims','DashBoardController@getShowClaims')->name('user_claimed');

            Route::get('claimed-record/{id?}','DashBoardController@getClamiedRecord')->name('claimed-record');

            Route::get('reporting/{id?}','DashBoardController@getReporting')->name('user_reporting');
            Route::get('insurer','DashBoardController@getInsurer')->name('user_insurer');
            Route::get('get-converted-data/{id?}','DashBoardController@getConvertedData')->name('get-converted-data');
            Route::get('get-failed-data/{id?}','DashBoardController@getFailedData')->name('get-failed-data');
             
        });
        Route::group(['namespace'=>'insurer'],function(){
            Route::group(['prefix'=>'insurer'],function(){
                Route::get('insurer-profile/{insurer_id?}','InsurerController@getShowInsurerProfile')->name('user_insurer_profile');
                Route::post('add-insurer','InsurerController@store')->name('add_insurer');
                Route::post('add-insurer-status','InsurerController@changeInsurerStatus')->name('change_insurer_status');
                Route::post('add-insurer-logo', 'InsurerController@addLogo')->name('add_insurer_logo');
                Route::post('add-insurer-home-policy', 'InsurerPolicyController@addHomePolicy')->name('add_home_policy');
                Route::post('add-insurer-car-policy', 'InsurerPolicyController@addCarPolicy')->name('add_car_policy');
                Route::post('add-insurer-travel-policy', 'InsurerPolicyController@addTravelPolicy')->name('add_travel_policy');
                Route::post('add-insurer-policy-status','InsurerPolicyController@changeInsurerPolicyStatus')->name('change_insurer_policy_status');
                Route::post('delete-insurer-logo','InsurerController@deleteInsurerLogo')->name('delete_insurer_logo');
                //Comparision
                Route::group(['prefix'=>'comparision'],function(){
                    Route::post('save-insurer-comparision','ComparisionController@postSaveComparision')->name('save_insurer_comparision');
                    Route::get('delete-comparision-values/{comparision_unique_id}','ComparisionController@deleteComparisionValues')->name('delete_comparision_values');
                });

                //offers
                Route::group(['prefix'=>'offers'],function(){
                    Route::post('post-save-offers','OffersController@postSaveOffers')->name('post_save_offers');
                    Route::get('delete-save-offers/{offers_id}','OffersController@deleteSaveOffers')->name('delete_save_offers');
                });
                //terms&condition
                Route::group(['prefix'=>'terms&condition'],function(){
                    Route::post('insurer-terms-condition-save','TermsAndConditionController@postSaveTermsCondition')->name('insurer_terms_condition_save');
                    Route::get('delete-insurer-terms-condition/{insurer_policy_id}','TermsAndConditionController@deleteTermsandCondition')->name('delete_insurer_terms_condition');
                });


                Route::group(['namespace'=>'policy'],function(){
                    Route::group(['prefix'=>'policy'],function(){
                        Route::get('policy-tpl/{insurer_policy_id?}','CarPolicyController@getShowInsurerTpl')->name('policy_tpl');
                        Route::post('policy-tpl/add-car-tpl-policy','CarPolicyController@storeCarTplPolicy')->name('car_tpl_policy_add');
                        Route::post('policy-tpl/add-car-tpl-dropdown','CarPolicyController@changeTplCatagory')->name('car_tpl_change_catagory');
                        Route::post('policy-tpl/add-car-tpl-policy-status','CarPolicyController@changeInsurerTplPolicyStatus')->name('car_tpl_policy_add_status');

                        Route::get('policy-green-card/{insurer_policy_id?}','CarPolicyController@getShowInsurerPolicyGreen')->name('policy_green_card');
                        Route::post('policy-green-card/add-green-card','CarPolicyController@storeInsurerPolicyGreen')->name('add_policy_green_card');
                        Route::post('policy-green-card/change-status-green-card-policy','CarPolicyController@changeInsurerPolicyGreenStatus')->name('change_policy_green_card_status');

                        Route::get('policy-full-casco/{insurer_policy_id?}','CarPolicyController@getShowInsurerPolicyFullCasco')->name('policy_full_casco');
                        Route::post('policy-full-casco/add-fullcasco','CarPolicyController@storeCarFullCascoPolicy')->name('add_policy_full_casco');
                        Route::post('policy-full-casco/change-casco-status','CarPolicyController@changeInsurerFullCascoPolicyStatus')->name('change_policy_full_casco_status');

                        Route::get('policy-home/{insurer_policy_id?}','HomePolicyController@getShowInsurerPolicyHome')->name('policy_home');
                        Route::post('policy-home/add-sub-home-policy','HomePolicyController@storeHomeSubPolicy')->name('home_sub_policy_add');
                        Route::post('policy-home/update-home-status','HomePolicyController@updateHomepolicy')->name('update_home_policy');

                        Route::get('policy-travel/{insurer_policy_id?}','TravelPolicyController@getShowInsurerPolicyTravel')->name('policy_travel');
                        Route::post('policy-travel/add-sub-travel-policy','TravelPolicyController@storeTravelSubPolicy')->name('travel_sub_policy_add');
                        Route::post('add-insurer-travel-policy-status','TravelPolicyController@changeInsurerTravelPolicyStatus')->name('change_insurer_travel_policy_status');

                        Route::get('policy-student-travel/{insurer_policy_id?}','TravelPolicyController@getShowInsurerPolicyStudentTravel')->name('policy_travel_student');
                        Route::post('policy-student-travel/add-sub-student-travel-policy','TravelPolicyController@storeStudentTravelSubPolicy')->name('student_travel_sub_policy_add');
                        Route::post('add-insurer-student-travel-policy-status','TravelPolicyController@changeInsurerStudentTravelPolicyStatus')->name('change_insurer_student_travel_policy_status');
                        Route::get('upcoming-policy-edit/{id?}','HomePolicyController@editUpcomeingPolicyNote')->name('upcoming-policy-edit');
                        Route::post('upcoming-policy-update','HomePolicyController@updateUpcomeingPolicyNote')->name('upcoming-policy-update');
                        Route::post('upcoming-policy-followup-update','HomePolicyController@updateUpcomeingPolicyFollwup')->name('upcoming-policy-followup-update');



                    });
                });
            });
        });
        Route::group(['namespace'=>'customer'],function(){
            Route::group(['prefix'=>'customer'],function(){
                Route::get('customer-view/{customer_id?}','CustomerController@getShowCustomerView')->name('customer_view');
                Route::post('edit-customer-details','CustomerController@editCustomerDetails')->name('edit_customer_details');
                Route::post('customer-douments-add','CustomerController@postCustomerDocuments')->name('customer_documnets_add');
                Route::get('customer-douments-edit/{id?}','CustomerController@editCustomerDocuments')->name('customer_documnets_edit');
                Route::post('customer_documnets_update','CustomerController@updateCustomerDocuments')->name('customer_documnets_update');
                Route::get('customer_documnets_delete/{id?}','CustomerController@deleteCustomerDocuments')->name('customer_documnets_delete');
                Route::post('create_task_customer','CustomerController@createCustomerTask')->name('create_task_customer');
                Route::get('customer-task-edit/{id?}','CustomerController@editCustomerTask')->name('customer_task_edit');
                Route::post('update_task_customer','CustomerController@updateCustomerTask')->name('update_task_customer');
                Route::get('customer_task_delete/{id?}','CustomerController@deleteTaskDocuments')->name('customer_task_delete');

            });
        });

        Route::group(['namespace'=>'contact'],function(){
            Route::group(['prefix'=>'contact'],function(){
                Route::get('contact','ContactController@getShowContact')->name('contact_view');
                Route::post('contact-create','ContactController@Contact')->name('contact_create');

            });
        });
        Route::group(['namespace'=>'claim'],function(){
            Route::group(['prefix'=>'claim'],function(){
                Route::get('view-claim','ClaimController@getShowViewClaim')->name('view_claim');
                Route::get('view-claim-data/{id?}','ClaimController@getShowViewClaimData')->name('view_claim-data');
                Route::post('create_document_claim_customer','ClaimController@CreateDocumentClaimCustomer')->name('create_document_claim_customer');
                Route::get('edit_document_claim_customer/{id?}','ClaimController@editDocumentClaimCustomer')->name('edit_document_claim_customer');
                Route::post('update_document_claim_customer','ClaimController@updateDocumentClaimCustomer')->name('update_document_claim_customer');
                Route::post('create_document_claim','ClaimController@CreateDocumentClaim')->name('create_document_claim');
                Route::get('edit_document_claim/{id?}','ClaimController@editDocumentClaim')->name('edit_document_claim');
                Route::post('updateDocumentClaim','ClaimController@updateDocumentClaim')->name('updateDocumentClaim');
                Route::post('create_task_claim','ClaimController@CreateTaskClaim')->name('create_task_claim');
                Route::post('update_task_claim','ClaimController@updateClaimTask')->name('update_task_claim');
                Route::post('add_claim_status','ClaimController@updateClaimStatus')->name('add_claim_status');
                Route::post('update_Claim_Loss','ClaimController@updateClaimLoss')->name('update_Claim_Loss');
                Route::post('update_policy_info','ClaimController@updatePolicyInfo')->name('update_policy_info');
                Route::post('update_amount','ClaimController@updateAmount')->name('update_amount');

            });
        });
        Route::group(['namespace'=>'policy'],function(){
            Route::group(['prefix'=>'policy'],function(){
                Route::get('add-policy','PolicyController@getShowAddPolicy')->name('add_policy');
                Route::get('add-policy-data/{policy_id}','PolicyController@getShowAddPolicyData')->name('add_policy_data');
                Route::post('add_policy_status','PolicyController@addPolicyStatus')->name('add_policy_status');
                Route::post('create_policy_document','PolicyController@create_policy_document')->name('create_policy_document');
                Route::get('edit_policy_document/{id?}','PolicyController@editPolicyDocument')->name('edit_policy_document');
                Route::post('update_policy_document','PolicyController@updatePolicyStatus')->name('update_policy_document');
                Route::get('policy_documnets_delete/{id?}','PolicyController@policy_documnets_delete')->name('policy_documnets_delete');
                Route::post('create_document_customer','PolicyController@createDocumentcustomer')->name('create_document_customer');
                Route::get('edit_customer_document/{id?}','PolicyController@editCustomerDocument')->name('edit_customer_document');
                Route::post('update_customer_document','PolicyController@updateCustomerDocument')->name('update_customer_document');
                Route::post('create_task_policy','PolicyController@createTaskPolicy')->name('create_task_policy');
                Route::post('update_task_policy','PolicyController@updatePolicyTask')->name('update_task_policy');
                Route::post('update_delivery_info','PolicyController@updateDelivery')->name('update_delivery_info');











            });
        });
    });
});
include_once('web/frontend.php');




