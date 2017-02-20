<?php

namespace App\Model\Painel;

use Illuminate\Database\Eloquent\Model;

class AntivirusModel extends Model
{
    //
    protected $table = 'tbl_marca_antiv';
    protected $primaryKey = 'mar_ant_codigo';
    public $timestamps = false;

    protected $fillable = [
        'mar_ant_nome'
    ];
}
