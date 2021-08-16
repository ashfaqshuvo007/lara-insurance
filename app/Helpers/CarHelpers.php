<?php

namespace App\Helpers;

use App\Helpers\Contracts\CarHelperContracts;
use URL;
use App\Models\Car;


class CarHelpers implements CarHelperContracts
{
    public static function checkCarExistance($user_id,$registration_no)
    {
        //store registration no
        $check_car = Car::where([   ['car_registration_number' ,'=',$registration_no],
                                    ['user_id' ,'=',$user_id]
                                ])->first();
       
        if(!empty($check_car))
        {
            return $check_car;
        }
        else{
            return 0;
        }
    }
}
