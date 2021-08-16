<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class ShippingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'              =>'required',
            'surname'           =>'required',
            // 'user_id'   =>'nullable|exists:users,user_id',
            // 'email'             =>['required','max:255','email:rfc,dns,filter', 'regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/','exists:users,email'],
            // 'phone_number'      =>'required|exists:users,phone',
            'national_id'       =>'',
            'company_name'      =>'',
            'tax_office'        =>'',
            'tax_no'            =>'',
            'address'           =>'required',
            'town'              =>'',
            'city'              =>'required',
            'zipcode'           =>'required',
            'shipping_country'  =>'required',
            'shipping_id'       =>'nullable|exists:user_shipping_details,shipping_id',
            'billing_id'       =>'nullable|exists:user_shipping_details,billing_id',
            'billing_name'    =>'required',
            'billing_surname'  =>'required',
            'billing_email'   =>'required',
            'billing_phone_number'     =>'required',
            'billing_national_id'      =>'',
            'billing_company_name'     =>'',
            'billing_tax_office'      =>'',
            'billing_tax_no'   =>'',
            'billing_address'  =>'required',
            'billing_town'     =>'',
            'billing_city'     =>'required',
            'billing_zipcode'  =>'required',
            'billing_country'  =>'required',
        ];
    }

     /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()->json(['success'=>false,'errors' => $errors], 400)
        );
    }


}
