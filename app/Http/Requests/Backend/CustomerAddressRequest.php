<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CustomerAddressRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'company_name' => 'nullable|string',
            'default_address' => 'in:,1',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'mobile' => 'required|numeric',
            'address' => 'required|string',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'post_code' => 'nullable|string',
        ];
    }
}
