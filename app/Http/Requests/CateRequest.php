<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CateRequest extends FormRequest
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
        $postId = $this->route()->parameter('id');
        return [
            'txtNameCate' => 'required|min:3|max:191|unique:categories,name,' . $postId
        ];
    }

    /**
     * message validation form
     *
     * @return array
     */

     public function messages() {
         return [
            'txtNameCate.required' => 'Tên danh mục không thể trống',
            'txtNameCate.min' => 'Tên danh mục quá ngắn',
            'txtNameCate.max' => 'Tên danh mục quá dài',
            'txtNameCate.unique' => 'Tên danh mục đã tồn tại'
         ];
     }
}
