<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
    // unique:category_translations,name,'. $am
    public function rules()
    {
        $category_id = $this->category_id;
        return [
           'data' => 'array|min:1',
           'photo' => 'required_without:category_id|mimes:png,jpg',
           'data.*.name' => ['required','string','max:100',Rule::unique('category_translations','name')->where(function($q) use($category_id){
                $q->where('category_id','<>',$category_id);
           })],
           'parent_id' =>'required|exists:categories,id',
           'status' => 'in:,1'
        ];
    }
}
