<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class LocalizationController extends Controller
{
    public function index(Request $request,$locale) {
        //set’s application’s locale
        session(['my_locale' => $locale]);
        
        return back();
     }

    public function pagenotfound() {
        return view('fontend.dashboard.page-not-found');
    } 
     
}
