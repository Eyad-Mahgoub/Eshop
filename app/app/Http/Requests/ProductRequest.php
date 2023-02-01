<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $data = [
            'id'                => ['sometimes', 'required'],
            'category_id'       => ['required'],
            'original_price'    => ['required', 'integer'],
            'image'             => ['required', 'image', ],
            'tax'               => ['required', 'integer'],
            'status'            => ['nullable'],
            'trending'          => ['nullable'],
        ];

        foreach (config('translatable.locales') as $lang)
        {
            $data[$lang . '*.name']             = ['required', 'string'];
            $data[$lang . '*.slug']             = ['required', 'string'];
            $data[$lang . '*.description']      = ['required', 'string'];
            $data[$lang . '*.content']          = ['required', 'string'];
            $data[$lang . '*.meta_title']       = ['required', 'string'];
            $data[$lang . '*.meta_description'] = ['required', 'string'];
            $data[$lang . '*.meta_keyword']     = ['required', 'string'];
        }

        return $data;
    }
}
