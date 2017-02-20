<?php

namespace App\Model\Painel;

use Illuminate\Database\Eloquent\Model;

class CargoModel extends Model
{
    //
    protected $table = 'tbl_cargo';
    protected $primaryKey = 'carg_codigo';
    public $timestamps = false;
    protected $fillable = [
        'carg_nome'
    ];
}
