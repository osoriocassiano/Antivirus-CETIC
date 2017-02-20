<?php

namespace App\Model\Painel;

use Illuminate\Database\Eloquent\Model;

class LicencaModel extends Model
{
    //
    protected $table = 'tbl_antivirus_pc';
    protected $primaryKey = 'apc_codigo';
    public $timestamps = false;
    protected $fillable = [
        'apc_serial_antiv',
        'apc_serial_pc',
        'apc_data_registo',
        'apc_validade',
        'apc_marca_antiv',
        'apc_responsavel_registo'
    ];
}
