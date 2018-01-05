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
            'uc_nome' => 'required|min:3',
            'uc_apelido' => 'required|min:3',
            'uc_serial' => 'required',
            'uc_data_registo' => 'required',
        ];
    }
    public function messages(){
            return [
                'uc_nome.required' => 'Nome obrigatório. (Carateres alfanúmericos)!',
                'uc_nome.min' => 'Nome deve conter pelo menos três caracteres!',
                'uc_apelido.required' => 'Apelido obrigatório. (Carateres alfanúmericos)!',
                'uc_apelido.min' => 'Nome deve conter pelo menos três caracteres!',
                'uc_serial.required' => 'O Serial do PC é obrigatório!',
                'uc_data_registo.required' => 'O campo Data do Registo é obrigatória!',
            ];

    }
}
