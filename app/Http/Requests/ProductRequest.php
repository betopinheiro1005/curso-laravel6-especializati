<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->segment(2);

        return [
            'name' => "required|min:3|max:255|unique:products,name,{$id},id",
           'description' => 'required|min:3|max:10000',
           'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
           'image' => 'nullable|image'
        ];
    }

/*     public function messages(){
        return[
            'name.required' => 'Nome é obrigatório!',
            'name.min' => 'Nome deve conter pelo menos 3 caracteres!',
            'photo.required' => 'Ops! Uma imagem deve ser informada!'
        ];
    }
 */
}
