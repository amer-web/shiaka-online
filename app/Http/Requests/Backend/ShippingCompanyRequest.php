<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ShippingCompanyRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'code' => ['required','string','unique:shipping_companies,code,'.$this->id],
            'description' => ['required','string','max:255'],
            'cost' => 'required|numeric',
            'fast' => 'in:,1',
            'status' => 'in:,1',
            'country_id' => 'required|array'
        ];
    }
}
