<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
           'name' =>'required|string|max:70|unique:languages,name,' .$this->id,
           'abbr' =>'required|string|max:10|unique:languages,abbr,'. $this->id,
           'status' => 'nullable|in:0,1',
           'direction' =>'required|string|in:rtl,ltr'

        ];
    }
}
