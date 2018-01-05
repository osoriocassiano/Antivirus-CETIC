<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Painel\TipoUsuarioModel;
use App\Model\Painel\PermissaoModel;
use App\Model\Painel\AntivirusModel;
use App\Http\Requests\Painel\TipoUsuarioPermissaoFormRequest;
use Illuminate\Support\Facades\DB;

class TipoUsuarioPermissaoController extends Controller
{
    //
    private $tipo_usuario;
    private $permissoes;
    private $marca;

    public function __construct(TipoUsuarioModel $tipoUsuarioModel, PermissaoModel $permissaoModel){
        $this->tipo_usuario = $tipoUsuarioModel;
        $this->permissoes = $permissaoModel;
    }

    public function index(){

    	//$permissoes = TipoUsuarioModel::with('')
    	//return view('painel.tipo_usuario_permissao.index_tipo_usuario_permissao');
    }

    public function create(){
    	$tipo_usuario = $this->tipo_usuario->all();
    	$permissoes = $this->permissoes->all();
    	/*$tipo_usuario = DB::table('tbl_tipo_usuario')->pluck('tpu_nome', 'tpu_codigo')->all();*/

        $tipo_usuario = DB::table('tbl_tipo_usuario')->whereNotIn('tpu_codigo', function($q){
            $q->select('tpu_codigo')->from('tbl_tipo_usuario_permissao');
        })->pluck('tpu_nome', 'tpu_codigo')->all();
        //dd($tipo_usuario);

    	return view('painel.tipo_usuario_permissao.create_tipo_usuario_permissao', compact('tipo_usuario', 'permissoes', 'tipo_usuario'));
    }

    public function store(TipoUsuarioPermissaoFormRequest $request)
    {
        //
        $tpu_codigo = $request->get('tpu_codigo'); // tipo_usuario
        $permissoes = $request->input('check');
        
        $tipo_usuario = $this->tipo_usuario->find($tpu_codigo);


     
        $cadastro = $tipo_usuario->permissoes()->attach($permissoes); 
        $sucesso = "Registo inserido com sucesso!";
        return redirect()->route('tipo_usuario_permissao.create')->withErrors($sucesso);
           


    }
}
