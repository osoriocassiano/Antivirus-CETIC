<?php

namespace App\Http\Controllers\Testes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestePermissaoController extends Controller
{
    public function index(){

        $user = auth()->user()->name;
        echo $user;
        echo " => ";
        echo auth()->user()->tiposUsuario->tpu_nome;
        echo "<br>Permissoes:<br>";

        //dd($tipoU = auth()->user()->tiposUsuario->permissoes);
        $permissoes = $tipoU = auth()->user()->tiposUsuario->permissoes;
        foreach($permissoes as $permissao){
            echo $permissao->per_nome."<br>";
        }


    }
}
