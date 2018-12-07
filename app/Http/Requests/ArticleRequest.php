<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ArticleRequest extends FormRequest
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
            'title' => 'required|min:3|max:255',
            'category_id' => 'required|integer',
            'user_id' => 'required|integer',
            'source' => 'nullable|string|url',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|string',
            'tags' => 'nullable|array',
        ];
    }

//    public function messages()
//    {
//        return [
//            'name.required' => 'name miss'
//        ];
//    }

}
