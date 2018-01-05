<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class LicencaPcStoreUpdateFormRequest extends FormRequest
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
            'apc_serial_antiv'        => 'required',
            'apc_serial_pc'           => 'required',
            'apc_data_registo'        => 'required',
            'apc_validade'            => 'required|numeric',
            'apc_marca_antiv'         => 'required',
        ];
    }
    public function messages()
    {
        $required = "Campo de preenchimento obrigatorio!";
        return [
            'apc_serial_antiv.required'        => 'O serial � obrigat�rio!',
            'apc_serial_pc.required' => 'O serial do PC � obrigat�rio!',
            'apc_data_registo.required' => 'A data de registo � obrigat�ria. Dia/M�s/Ano!',
            'apc_validade.required' => 'A validade � obrigat�ria. (N�mero inteiro > 0)!',
            'apc_marca_antiv.required' => 'O antiv�rus � obrigat�rio!',
        ];
    }

}
