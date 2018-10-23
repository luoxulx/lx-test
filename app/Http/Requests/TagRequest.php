<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/19
 * Time: 下午11:00
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
	public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3',
        ];
    }
}
