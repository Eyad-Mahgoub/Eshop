<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'name'          => ['required', 'unique:coupons,name'],
            'code'          => ['required'],
            'value'         => ['required'],
            'type'          => ['required'],
            'max_amount'    => ['exclude_if:type,0', 'required'],
            'start_date'    => ['required', 'date'],
            'end_date'      => ['required', 'date'],
        ];
    }
}
