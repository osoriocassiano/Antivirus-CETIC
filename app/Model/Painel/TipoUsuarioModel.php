<?php

namespace App\Model\Painel;

use Illuminate\Database\Eloquent\Model;

class TipoUsuarioModel extends Model
{
    //
    protected $table = 'tbl_tipo_usuario';
    protected $primaryKey = 'tpu_codigo';
    public $timestamps = false;
    protected $fillable = [
        'tpu_nome',
        'tpu_sigla',
        'tpu_descricao'
    ];

    public function permissoes(){
        return $this->belongsToMany('App\Model\Painel\PermissaoModel', 'tbl_tipo_usuario_permissao', 'tpu_codigo', 'per_codigo');
    }
}
