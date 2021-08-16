@extends('fontend.layouts.frontend-master')
@section('title','MySIg by Fidentia | Home')
@section('content')

<?php
    $user = Auth::user();
    $token = auth('api')->tokenById($user->id);
    // $locale = App::getLocale();
    //     dd($locale);
    $lang = config('app.locale');
    $files = glob(resource_path('lang/' . $lang . '/layout-my-policy.php'));
    foreach ($files as $file) {
        $strings = require $file;
    }
       
?>
<section class="mt- main-home">
    <policy-list :base_url="'{{ url('/') }}'" :Auth="{{json_encode($token)}}" :locale="{{json_encode($strings)}}"></policy-list>

    
</section>

<section class="reminder_section mt-5">

</section>
@endsection