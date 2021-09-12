<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'username' => ['required','max:150','unique:users,username,'.$this->id],
            'email' => ['required','unique:users,email,'.$this->id],
            'password' => 'required_without:id|min:8',
            'mobile' => ['required','unique:users,mobile,'.$this->id],
            'status' => 'in:,1',
        ];
    }
}
