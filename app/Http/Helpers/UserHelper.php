<?php
namespace App\Helpers;
use App\User;

class UserHelper{

    public static function _findSameEmail($email_id)
    {
        $find_email = User::where('email',$email_id)->first();
        return $find_email;
    }

    public static function _findPhoneNumber($phone)
    {
        $find_user = User::where('phone',$phone)->first();
        return $find_user;
    }
}

?>