<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Model\Painel\PermissaoModel;
use App\Model\Painel\TipoUsuarioModel;
use Illuminate\Database\Query\Builder;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tbl_usuario_sistema';
    protected $primaryKey = 'us_codigo';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'us_apelido',
        'us_cargo',
        'us_tipo',
        'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tiposUsuario()
    {
        return $this->belongsTo('App\Model\Painel\TipoUsuarioModel', 'us_tipo');
    }

    public function hasAccess(PermissaoModel $permissao)
    {
        return $this->possuiTipoUsuario($permissao->tiposUsuario);

    }

    public function possuiTipoUsuario($tiposU)
    {
        if (is_array($tiposU) || is_object($tiposU)) {

            foreach ($tiposU as $tipoU) {

                return $this->tiposUsuario()->where('tpu_nome', $tipoU->tpu_nome)->first();
                //return $this->tiposUsuario->contains('tpu_nome', $tipoU->tpu_nome);
            }
        }
        /*return !! $tiposU->intersect($this->tiposUsuario())->count();  ==== Posso substituir toda instrucao if() acima apenas com esta instrucao*/


        //return $this->tiposUsuario->contains('tpu_nome', $tiposU->tpu_nome);
        return $this->tiposUsuario()->where('tpu_nome', $tiposU)->first(); // Caso seja uma string (o tipo de usuario a se consultar para o usuario logado)
    }
}
