<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class PrazoStoreUpdateFormRequest extends FormRequest
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
            'dr_nome'=>'required|numeric|unique:tbl_dias_remanescentes',
        ];
    }

    public function messages(){
        return [
            'dr_nome.required'=>'O campo Dias é de preenchimento obrigatório!',
            'dr_nome.numeric'=>'Apenas valores numéricos são permitidos!',
            'dr_nome.unique'=>'Número já existente!',
        ];
    }
}
