<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioSistemaStoreUpdateFormRequest extends FormRequest
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
            'name'    => 'required',
            'us_apelido' => 'required',
            'us_cargo'   => 'required',
            'us_tipo'    => 'required',
            'email'   => 'required',
            'us_usuario' => 'required',
            'password'   => 'required',
        ];
    }
    public function messages(){
        $required = "Campo de preenchimento obrigatorio!";
        return [
            'name.required'    => $required,
            'us_apelido.required' => $required,
            'us_cargo.required'   => $required,
            'us_tipo.required'    => $required,
            'email.required'   => $required,
            'us_usuario.required' => $required,
            'password.required'   => $required,
        ];
    }
}
