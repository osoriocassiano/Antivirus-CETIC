<?php

namespace App\Model\Painel;

use Illuminate\Database\Eloquent\Model;

class UsuarioSistemaModel extends Model
{
    //
    protected $table = 'tbl_usuario_sistema';
    protected $primaryKey = 'us_codigo';
    public $timestamps = false;
    protected $fillable = [
        'us_nome',
        'us_apelido',
        'us_cargo',
        'us_tipo',
        'us_email',
        'us_usuario',
        'us_senha'
    ];
}
