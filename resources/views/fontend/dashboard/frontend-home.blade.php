@extends('fontend.layouts.frontend-master')
@section('title','MySIg by Fidentia | Home')
@section('content')
<?php
        $user = Auth::user();
        $token = auth('api')->tokenById($user->id);

        $user = Auth::user();
        $id = $user->id;

        // dd($id);

        
        // Auth::loginUsingId($id, true);
        // $base_url=url('/') ;

        $lang = config('app.locale');
        $files = glob(resource_path('lang/' . $lang . '/layout-home.php'));
        foreach ($files as $file) {
            $strings = require $file;
        }
       
    ?>

    <quotes-component :insaurance_logo="{{json_encode(URL::asset('frontend/images/insurance-logo.png'))}}"
        :base_url="'{{ url('/') }}'" :Auth="{{json_encode($token)}}" :user="{{json_encode($user)}}" :locale="{{json_encode($strings)}}" 
        :id="{{$id}}"
        :lang={{json_encode($lang)}}>
    </quotes-component>


<section class="curve_section mt-5">

</section>



@endsection

@section('add-js')
<script>
$(function() {
    $('.main-tab-item').click(function() {
        let items = $('.main-tab-item');

        for(let i = 0; i < items.length; i++) {
            items.eq(i).removeClass('none-selected');
        }
    });
})
</script>
@endsection

