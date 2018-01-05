<?php

namespace App\Model\Painel;

use Illuminate\Database\Eloquent\Model;

class PermissaoModel extends Model
{
    //
    protected $table = 'tbl_permissao';
    protected $primaryKey = 'per_codigo';
    public $timestamps = false;
    protected $fillable = [
        'per_nome',
        'per_descricao'
    ];

    public function tiposUsuario(){

        return $this->belongsToMany('\App\Model\Painel\TipoUsuarioModel', 'tbl_tipo_usuario_permissao', 'per_codigo', 'tpu_codigo');
    }
}
