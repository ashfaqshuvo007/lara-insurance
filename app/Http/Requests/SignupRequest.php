<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class SignupRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'max:255', 'regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/', 'unique:users'],
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:6|max:10',
            'password' => 'required|string|min:8|confirmed',
            'country_code'=>'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required'     => trans('layout-errors.first_name'),
            'last_name.required'     => trans('layout-errors.last_name'),
            'email.required' =>        trans('layout-errors.email'),
            'phone_number.required' => trans('layout-errors.phone_no'),
            'password.required' => trans('layout-errors.password'),
            'min' => trans('layout-errors.min'),
            'max' => trans('layout-errors.max'),
            'unique' => trans('layout-errors.unique'),
            'confirmed' => trans('layout-errors.confirmed'),
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
            response()->json(['success' => false, 'errors' => $errors], 400)
        );
    }
}