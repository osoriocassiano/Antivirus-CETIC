<?php

namespace App\Model\Painel;

use Illuminate\Database\Eloquent\Model;

class PrazoModel extends Model
{
    protected $table = 'tbl_dias_remanescentes';
    protected $primaryKey = 'dr_codigo';
    public $timestamps = false;
    protected $fillable = [
        'dr_nome'
    ];
}
