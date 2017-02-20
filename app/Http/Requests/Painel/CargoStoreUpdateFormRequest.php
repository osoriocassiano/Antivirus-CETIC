<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class CargoStoreUpdateFormRequest extends FormRequest
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
        'carg_nome'=>'required',
    ];
}

    public function messages(){
    return [
        'carg_nome.required'=>'O campo Cargo e de preenchimento obrigatorio!',
    ];
}
}
