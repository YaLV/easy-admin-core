<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Profile extends FormRequest
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
            'name'             => 'required',
            'last_name'        => 'required',
            'email'            => 'required|email',
            'phone'            => 'required',
            'legal_name'       => 'required_if:is_legal,1',
            'legal_address'    => 'required_if:is_legal,1',
            'legal_reg_nr'     => 'required_if:is_legal,1',
            'legal_vat_reg_nr' => 'required_if:is_legal,1',
            'address'          => 'required',
            'city'             => 'required',
            'postal_code'      => 'required',
        ];
    }
}
