<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class MarcaStoreUpdateFormRequest extends FormRequest
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
            //
            'mar_ant_nome' => 'required',
        ];
    }

    public function messages(){
        return[
          'mar_ant_nome.required' => 'O campo marca e de preenchimento obrigatorio',
        ];
    }
}
