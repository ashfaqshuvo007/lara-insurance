@extends('fontend.layouts.frontend-master')
@section('title','MySIg by Fidentia | Claim')
@section('content')
<?php
    $user = Auth::user();
    $token = auth('api')->tokenById($user->id);

    $lang = config('app.locale');
    $files = glob(resource_path('lang/' . $lang . '/layout-policy.php'));
    foreach ($files as $file) {
        $strings = require $file;
    }
?>
<section class="mt- main-home">
    <choose-policy :base_url="'{{ url('/') }}'":Auth="{{json_encode($token)}}" :locale="{{json_encode($strings)}}"></choose-policy>
</section>

<section class="reminder_section mt-5">

</section>
@endsection