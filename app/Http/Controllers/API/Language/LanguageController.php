<?php

namespace App\Http\Controllers\API\Language;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function setLanguageLocale(Request $request, $locale)
    {
        
        App::setLocale($locale);
        $l = App::getLocale();
        $lang = config('app.locale');
        $files = glob(resource_path('lang/' . $lang . '/text.php'));
        foreach ($files as $file) {
            $strings = require $file;
        }
        return $l;
    }
}
