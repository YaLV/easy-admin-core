<?php

namespace App\Http\Requests;

use App\Rules\UniqueNotRegistered;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

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
        $rules = [
            'name'             => 'required',
            'last_name'        => 'required',
            'phone'            => 'required',
            'legal_name'       => 'required_if:legal_person,1',
            'legal_address'    => 'required_if:legal_person,1',
            'legal_reg_nr'     => 'required_if:legal_person,1',
            'legal_vat_reg_nr' => 'required_if:legal_person,1',
            'address'          => 'required',
            'city'             => 'required',
            'postal_code'      => 'required',

        ];

        $rn = explode(".", Route::currentRouteName());

        switch ($rn[0]) {
            case "register":
                $rules['password'] = 'required|confirmed';
                $rules['rules'] = 'accepted';
                $rules['email'] = ['required','email', new UniqueNotRegistered()];
                break;

            case "checkout":
                $rules['rules'] = 'accepted';
                break;
        }

        return $rules;
    }
}
