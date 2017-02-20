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
            'dr_nome'=>'required|numeric',
        ];
    }

    public function messages(){
        return [
            'dr_nome.required'=>'O campo Dias eh de preenchimento obrigatorio!',
            'dr_nome.numeric'=>'Apenas valores numericos sao permitidos!',
        ];
    }
}
