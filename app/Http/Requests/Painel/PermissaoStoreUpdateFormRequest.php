<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class PermissaoStoreUpdateFormRequest extends FormRequest
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
            'per_nome'=>'required|min:3|unique:tbl_permissao',
        ];
    }

    public function messages(){
        return [
            'per_nome.required'=>'O campo Permissão é de preenchimento obrigatório!',
            'per_nome.min'=>'O campo Permissão deve conter no mínimo três caracteres!',
            'per_nome.unique'=>'Permissão já existente!',
        ];
    }
}
