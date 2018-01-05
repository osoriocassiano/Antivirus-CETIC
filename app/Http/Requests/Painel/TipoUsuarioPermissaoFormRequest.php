<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class TipoUsuarioPermissaoFormRequest extends FormRequest
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
        'tpu_codigo'=>'required|',
        ];
    }

    public function messages(){
        return [
        'tpu_codigo.required'=>'O tipo de usuário é obrigatório!',
        ];
    }
}
