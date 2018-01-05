<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Model\Painel\PermissaoModel;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    /*protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];*/

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::before(function(User $user, $ability){
            if($user->possuiTipoUsuario('Administrador')) // Um caso em q o "possuiTipo... do user recebe uma string e nao array ou objecto"
                return true;
        });

        $permissoes = PermissaoModel::with('tiposUsuario')->get();

        foreach($permissoes as $permissao){

            Gate::define($permissao->per_nome, function(User $user) use ($permissao){
                return $user->hasAccess($permissao);
            });
        }



    }

}
