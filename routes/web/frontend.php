<?php

Route::any('/thank-you','SuccessController@paymentSuccess')->name('thank_you');
Route::any('/transaction-failed','SuccessController@paymentFailed')->name('frontend_paymentFailed');
Route::get('page-not-found','LocalizationController@pagenotfound');

Route::get('/invoice', function () {
        
    return view('fontend.dashboard.frontend-invoice'); 
})->name('frontend_invoice');

Route::get('/pay','API\Payment\PaymentController@cardDetailsForm')->name('card_form');
Route::post('/forgot-password','Password\ResetPasswordController@forgotPassword')->name('fortgot_password');



Route::group([],function(){
    
    Route::get('frontend-logout', function ()
    {
        auth()->logout();
        Session()->flush();

        return Redirect::to('/');
    })->name('frontend_logout');

   
   
    //after login
    Route::group(['middleware'=>'user-authenticate'],function(){
       
        Route::get('/policies', function () {
          
            return view('fontend.dashboard.frontend-policies'); 
        })->name('frontend_policies');
        Route::get('/user-home', function () {
       
            return view('fontend.dashboard.frontend-home'); 
        })->name('frontend_home');

        Route::get('/user-home/{locale}', function ($locale) {
            return view('fontend.dashboard.frontend-home'); 
        })->name('frontend_home_locale');

        Route::get('/claim', function () {
        
            return view('fontend.dashboard.frontend-claim'); 
        })->name('frontend_claim');

        Route::get('/buy-now', function () {
        
            return view('fontend.dashboard.frontend-buy'); 
        })->name('frontend_buy');

        Route::get('/selectcar-form1', function () {
        
            return view('fontend.dashboard.frontend-selectcarform1'); 
        })->name('frontend_selectcarform1');

        Route::get('/casco-form', function () {
        
            return view('fontend.dashboard.frontend-cascoform'); 
        })->name('frontend_cascoform');

        Route::get('/home-form', function () {
        
            return view('fontend.dashboard.frontend-homeform'); 
        })->name('frontend_homeform');

        Route::get('/travel-outside-form', function () {
        
            return view('fontend.dashboard.frontend-travelform'); 
        })->name('frontend_travelform');

        Route::get('/file-claim-car', function () {
        
            return view('fontend.dashboard.frontend-fileclaimform'); 
        })->name('frontend_fileclaim');

        Route::get('/choose-policy', function () {
        
            return view('fontend.dashboard.frontend-policytoclaimform'); 
        })->name('frontend_choosepolicy');

        Route::get('/file-claim-home', function () {
        
            return view('fontend.dashboard.frontend-fileclaimHomeform'); 
        })->name('frontend_fileclaimHome');

        Route::get('/account-setting', function () {
        
            return view('fontend.dashboard.frontend-accountsettingsform'); 
        })->name('frontend_accountsettingsHome');

        Route::get('/reset-password', function () {
        
            return view('fontend.dashboard.frontend-resetpasswordform'); 
        })->name('frontend_resetpassword');

        Route::get('/shipping-address', function () {
            return view('fontend.dashboard.frontend-shippingAddress');
        })->name('frontend_-shippingAddress');

        Route::get('/papalRedirection', function () {
            return view('fontend.dashboard.frontend-paypalThankYou');
        })->name('frontend_-shippingAddress');

        Route::get('/page-not-found', function () {
            return view('fontend.dashboard.page-not-found');
        })->name('frontend_-shippingAddress');

        Route::get('/terms-of-use', function () {
            return view('fontend.footer-pages.term-use');
        })->name('terms_of_use');

        Route::get('/privacy-policy', function () {
            return view('fontend.footer-pages.privacy-policy'); 
        })->name('privacy_policy');

        // Route::get('/payment', function () {
            
        //     return view('payment.Payfor3DHostDetails');
        // })->name('payment');

        Route::get('/payment/{policy_id}','API\Payment\PaymentController@cardDetailsForm')->name('card_form');
        Route::get('/payment_all/{policy_id}','API\Payment\PaymentController@cardDetailsFormAll')->name('card_form');
        Route::get('/pay-bypaypal/{policy_id}/{policy_for}/{policy_name}','API\Payment\PaymentController@addPaypal')->name('addPaypal');
        
        Route::get('/cod/{policy_id}/{policy_for}/{policy_name}', 'API\Payment\PaymentController@codThankYou')->name('cod');
        Route::get('/cod-thank-you', 'API\Payment\PaymentController@codConfirmed')->name('frontend_cod_thankyou');

    });
    //before login
    Route::group(['middleware'=>'user-logout-or-not'],function(){
        Route::group(['namespace'=>'Frontend'],function(){
            Route::get('/','IndexController@showIndex' )->name('frontend_index');
            Route::post('/show-insurance-product','IndexController@getInsuranceProduct')->name('get_insurance_product');
    
            Route::group(['namespace'=>'Authorization'],function(){
                // login 
            Route::get('/user-login','LoginController@showLoginForm' )->name('frontend_login');
            Route::post('/post_login','LoginController@login')->name('post_login');
                //register
            Route::get('/user-signup','RegisterController@showRegisterPage' )->name('frontend_signup');
            Route::post('/post-save-signup','RegisterController@postSaveRegister')->name('post_save_signin');
            });
            Route::group(['namespace'=>'Reminder'],function(){
               //reminder
                Route::post('/post-save-reminder','ReminderController@postSaveReminder')->name('post_save_reminder');
            });
        });
       
       
        Route::get('/contact-us', function () {
            
            return view('fontend.head-index.contact-us'); 
        })->name('frontend_contact_us');
        Route::get('/terms', function () {
           
            return view('fontend.head-index.terms'); 
        })->name('forntend_terms');
        Route::get('/why-choose-us', function () {
            
            return view('fontend.head-index.why-choose-us'); 
        })->name('why_choose_us');

      
    });
    
});

?>
 