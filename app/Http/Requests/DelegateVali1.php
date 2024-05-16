<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DelegateVali1 extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sector' => 'required|string|max:100',
            'organisation_type' => 'required|string|max:255',
            'delegates' => 'required|integer',
            'category' => 'required|string|max:255',
            'org_name' => 'required|string|max:255',
            'country' => 'required|string|max:150',
            'mobile' => 'required|string|max:15',
            'state' => 'required|string|max:150',
            'city' => 'required|string|max:150',
            'zipcode' => 'required|string|max:10',
            //'email' => 'required|email|max:255',
            'tie_global_membership_id' => 'string|max:150',
            'captcha' => 'required|captcha|max:25',
        ];
    }
}
