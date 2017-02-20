<?php

namespace App\Model\Painel;

use Illuminate\Database\Eloquent\Model;

class UsuarioPcModel extends Model
{
    //
    protected $table = 'tbl_usuario_computador';
    protected $primaryKey = 'uc_codigo';
    public $timestamps = false;
    protected $fillable = [
        'uc_serial', 'uc_nome', 'uc_apelido', 'uc_data_registo'
    ];
}
