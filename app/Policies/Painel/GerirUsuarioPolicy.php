<?php

namespace App\Policies\Painel;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GerirUsuarioPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
