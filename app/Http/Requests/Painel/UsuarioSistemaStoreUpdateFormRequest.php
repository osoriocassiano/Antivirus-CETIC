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
            'name'    => 'required|alpha|min:3',
            'us_apelido' => 'required|alpha|min:3',
            'us_cargo'   => 'required',
            'us_tipo'    => 'required',
            'email'   => 'required',
            'us_usuario' => 'required',
            'password'   => 'required|min:6',
        ];
    }
    public function messages(){
        $required = "Campo de preenchimento obrigatorio!";
        return [
            'name.required'    => 'O Nome é obrigatório!',
            'name.alpha'    => 'Caracteres alfabéticos permitidos!',
            'name.min'    => 'Permitidos pelo menos três caracteres!',
            'us_apelido.required' => 'O Apelido é obrigatório!',
            'us_apelido.alpha' => 'Caracteres alfabéticos permitidos!',
            'us_apelido.min' => 'Permitidos pelo menos três caracteres!',
            'us_cargo.required'   => 'O Cargo é obrigatório!',
            'us_tipo.required'    => 'O Tipo de Usuario é obrigatório!',
            'email.required'   => 'O Email é obrigatório!',
            'us_usuario.required' => 'O Nome de Usuario de Login é obrigatório!',
            'password.required'   => 'A Senha é obrigatória!',
            'password.min'   => 'A Senha deve ser de pelo menos 6 caracteres!',
        ];
    }
}
//Todo este codigo nao esta em uso. O register controller faz o registo