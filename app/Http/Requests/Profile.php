<?php

namespace App\Http\Requests;

use App\Rules\MyEmailOrUnregistered;
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
            'name'             => 'required|min:3|regex:/^[^0-9]+/i',
            'last_name'        => 'required|min:3|regex:/^[^0-9]+/i',
            'phone'            => 'required|numeric',
            'legal_name'       => 'required_if:is_legal,1',
            'legal_address'    => 'required_if:is_legal,1',
            'legal_reg_nr'     => 'required_if:is_legal,1',
            'legal_vat_reg_nr' => 'required_if:is_legal,1',
            'address'          => 'required',
            'city'             => 'required|min:3|regex:/^[^0-9]+/i',
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
                $rules['email'] = ['required','email', new MyEmailOrUnregistered()];
                break;

            case "profile":
                $rules['password'] = 'confirmed';
                $rules['email'] = ['required', 'email', new MyEmailOrUnregistered()];
                break;
        }

        return $rules;
    }
}
