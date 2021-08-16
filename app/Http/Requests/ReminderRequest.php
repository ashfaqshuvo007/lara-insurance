<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class ReminderRequest extends FormRequest
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
            'name'     => 'required|string|max:255',
            'mobile_number' => 'required|min:6|max:10|regex:/^([0-9\s\-\+\(\)]*)$/',
            'email'    =>['required', 'max:255', 'regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/'],
            'due_date' =>'required|date',
            'insurance_type' =>'nullable|required|string|max:255',
            'registration_number'=>'required|string|max:255'
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
            'name.required'                => trans('layout-errors.name'),
            'mobile_number.required'       => trans('layout-errors.mobile_number'),
            'email.required'               => trans('layout-errors.email'),
            'due_date.required'            => trans('layout-errors.due_date'),
            'insurance_type.required'      => trans('layout-errors.insurance_type'),
            'min'                          => trans('layout-errors.min'),
            'max'                          => trans('layout-errors.max'),
            'unique'                       => trans('layout-errors.unique'),
            'registration_number.required' => trans('layout-errors.reg_number'),
            'regex' => trans('layout-errors.regex'),
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