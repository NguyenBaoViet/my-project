<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
            'name' => 'bail|required|unique:products|max:255',
            'price' => 'bail|required|numeric',
            'category_id' => 'required',
            'contents' => 'required',
            'tags' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống.',
            'name.unique' => 'Tên sản phẩm đã có, vui lòng nhập tên sản phẩm khác.',
            'name.max' => 'Tên sản phẩm không được quá 255 ký tự.',
            'price.required' => 'Giá sản phầm không được để trống.',
            'price.numeric' => 'Giá sản phẩm không đúng.',
            'category_id.required' => 'Danh mục không được để trống.',
            'contents.required' => 'Mô tả không được để trống.',
            'tags.required' => 'Tag không được để trống.'
        ];
    }
}
