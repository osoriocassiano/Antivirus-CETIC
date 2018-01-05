<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;
use App\Model\Painel\TipoUsuarioModel;

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
        $tpu_codigo = $this->get('tipo_usuario_codigo');
        return [
            'tpu_nome' => 'required|min:3',
            'tpu_sigla' => 'required|unique:tbl_tipo_usuario,tpu_sigla,'.$tpu_codigo.',tpu_codigo|max:5',
            'tpu_descricao' => 'required|max:200',
        ];
    }

    public function messages()
    {
        return [
            'tpu_nome.required' => 'O nome é obrigatório!',
            'tpu_nome.min' => 'O nome deve conter no mínimo três caracteres!',
            'tpu_sigla.required' => 'A sigla é obrigatório!',
            'tpu_sigla.unique' => 'Sigla já existente!',
            'tpu_sigla.max' => 'A sigla deve conter no máximo cinco caracteres!',
            'tpu_descricao.max' => 'A sigla deve conter no máximo duzentos caracteres!',
        ];
    }
}
