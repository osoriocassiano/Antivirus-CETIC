<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioPcStoreUpdateFormRequest extends FormRequest
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
            'uc_nome' => 'required',
            'uc_apelido' => 'required',
            'uc_serial' => 'required',
            'uc_data_registo' => 'required',
        ];
    }
    public function messages(){
            return [
                'uc_nome.required' => 'O campo Nome e de preenchimento obrigatorio',
                'uc_apelido.required' => 'O campo Apelido e de preenchimento obrigatorio',
                'uc_serial.required' => 'O campo Serial do PC e de preenchimento obrigatorio',
                'uc_data_registo.required' => 'O campo Data de Registo e de preenchimento obrigatorio',
            ];

    }
}
