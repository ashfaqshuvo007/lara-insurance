<?php

namespace App\Services\ContactDetailsService;

use App\Models\Contact;


class ContactServices
{
    public static function getContactInfo() {
        
        $address_details = Contact::select('address','primary_number','alternate_number','email')->first();
		return $address_details;
    }

}