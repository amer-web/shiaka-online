<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductCouponRequest extends FormRequest
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
            'code' => ['required','string','unique:product_coupons,code,'.$this->id],
            'type' => ['required','string','in:fixed,percentage'],
            'value' => ['required','numeric'],
            'description' => ['nullable','string'],
            'use_times' => ['nullable','numeric'],
            'start_date' => ['nullable','date','date_format:Y-m-d'],
            'expire_date' => ['nullable','required_with:start_date','date','date_format:Y-m-d'],
            'greater_than' => ['nullable','numeric'],
            'status' => ['nullable','in:,1'],
        ];
    }
}
