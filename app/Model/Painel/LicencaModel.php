<?php

namespace App\Model\Painel;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class LicencaModel extends Model
{
    //
    protected $table = 'tbl_antivirus_pc';
    protected $primaryKey = 'apc_codigo';
    public $timestamps = false;
    protected $dates = ['apc_data_registo',];
    protected $fillable = [
        'apc_serial_antiv',
        'apc_serial_pc',
        'apc_data_registo',
        'apc_validade',
        'apc_marca_antiv',
        'apc_responsavel_registo'
    ];

    public function setApcDataRegistoAttribute($value)
    {
        //dd($value);
        $this->attributes['apc_data_registo'] = Carbon::parse($value);
    }

    public function getApcDataRegistoAttribute()
    {
        //dd($value);
        return $this->attributes['apc_data_registo'];
    }

}
