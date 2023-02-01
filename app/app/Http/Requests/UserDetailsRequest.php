<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDetailsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id'       => ['required'],
            'first_name'    => ['required'],
            'last_name'     => ['required'],
            'email'         => ['required', 'email'],
            'phone_no'      => ['required', 'numeric', 'min:8'],
            'address1'      => ['required'],
            'address2'      => ['nullable'],
            'city'          => ['required'],
            'state'         => ['required'],
            'country'       => ['required'],
            'pincode'       => ['required', 'numeric'],
        ];
    }
}
