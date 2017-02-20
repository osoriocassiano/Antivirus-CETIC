<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class TipoUsuarioPcStoreUpdateFormRequest extends FormRequest
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
            'tpu_nome' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tpu_nome.required' => 'O campo Tipo de Usuario eh de preenchimento obrigatorio!',
        ];
    }
}
