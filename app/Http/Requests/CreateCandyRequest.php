<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCandyRequest extends FormRequest
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
        $rules = [
            'title' => 'required|unique:tb_candy,title',
            'description' => 'required|unique:tb_candy,description',
            'hashtags' => 'required:tb_candy,hashtags',
            'website' => 'required:tb_candy,website',
            'explicit' => 'required:tb_candy,explicit',
            'public_chat' => 'required:tb_candy,public_chat',
            'community' => 'required:tb_candy,community',
            'category_id' => 'required:tb_candy,category_id'
        ];

        return $rules;
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.unique' => 'Title already exists!',
        ];
    }
}
