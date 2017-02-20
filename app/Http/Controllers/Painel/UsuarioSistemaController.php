<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use App\Model\Painel\UsuarioSistemaModel;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Painel\UsuarioSistemaStoreUpdateFormRequest;

class UsuarioSistemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $usuario_sis;

    public function __construct(UsuarioSistemaModel $usuario_sis){
        $this->usuario_sis = $usuario_sis;
    }
    public function index()
    {
        //
        $usuarios_sistema = DB::table('tbl_usuario_sistema')
                                    ->join('tbl_cargo', 'tbl_usuario_sistema.us_cargo', '=', 'tbl_cargo.carg_codigo')
                                    ->join('tbl_tipo_usuario', 'tbl_usuario_sistema.us_tipo', '=', 'tbl_tipo_usuario.tpu_codigo')
                                    ->select('tbl_usuario_sistema.*', 'tbl_cargo.*', 'tbl_tipo_usuario.*')
                                    ->get();
        return view('painel.usuario_sistema.index_usuario_sistema', compact('usuarios_sistema'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cargo = DB::table('tbl_cargo')->pluck('carg_nome', 'carg_codigo')->all();
        $tipo_usuario =DB::table('tbl_tipo_usuario')->pluck('tpu_nome', 'tpu_codigo')->all();
        return view('painel.usuario_sistema.create_edit_usuario_sistema', compact('cargo', 'tipo_usuario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioSistemaStoreUpdateFormRequest $request)
    {
        //
        $dataForm = $request->all();
        $cadastro = $this->usuario_sis->create($dataForm);
        if($cadastro){
            $sucesso = "Registo inserido com sucesso!";
            return redirect()->route('usuario_sistema.index')->withErrors($sucesso);
        }
        else{
            $erro = "N�o foi poss�vel inserir o registo!";
            return redirect()->route('usuario_sistema.create')->withErrors($erro);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        //$show = $this->usuario_sis->find($id);
        $show = DB::table('tbl_usuario_sistema')
            ->join('tbl_cargo', 'tbl_usuario_sistema.us_cargo', '=', 'tbl_cargo.carg_codigo')
            ->join('tbl_tipo_usuario', 'tbl_usuario_sistema.us_tipo', '=', 'tbl_tipo_usuario.tpu_codigo')
            ->select('tbl_usuario_sistema.*', 'tbl_cargo.*', 'tbl_tipo_usuario.*')
            ->where('tbl_usuario_sistema.us_codigo', '=', $id)
            ->first();
        $acao = $request->input('acao');
        $title = "Detalhes do Usu�rio {$show->name}";

        if($acao){
            return view('painel.usuario_sistema.show_usuario_sistema', compact('acao','show', 'title'));
        }
        else{
            $acao = false;
            return view('painel.usuario_sistema.show_usuario_sistema', compact('acao','show', 'title'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $cargo = DB::table('tbl_cargo')->pluck('carg_nome', 'carg_codigo')->all();
        $tipo_usuario =DB::table('tbl_tipo_usuario')->pluck('tpu_nome', 'tpu_codigo')->all();
        $usuario_sistema = $this->usuario_sis->find($id);
        $title = "Actualizar {$usuario_sistema->name}";
        return view('painel.usuario_sistema.create_edit_usuario_sistema', compact('usuario_sistema', 'title', 'cargo', 'tipo_usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $dataForm = $request->all();
        $usuario_sistema = $this->usuario_sis->find($id);
        $update = $usuario_sistema->update($dataForm);
        if($update){
            $sucesso = "Registo actualizado com Sucesso!";
            return redirect()->route('usuario_sistema.index')->withErrors($sucesso);
        }
        else{
            $erro = "Erro ao inserir o registo!";
            return redirect()->route('usuario_sistema.edit', $id)->withErrors($erro);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $usuario_sistema = $this->usuario_sis->find($id);
        try{
            $delete = $usuario_sistema->delete();
            if($delete){
                return redirect()->route('usuario_sistema.index');
            }
            else{
                $erro = "Erro ao apagar!";
                return redirect()->route('usuario_sistema.index')->withErrors($erro);
            }
        }catch (QueryException $e){
            $erro_fk = "Não foi possível apagar o registo";
            $show = $this->usuario_sis->find($id);
            $acao = false;
            if($e->getCode()==23000){
                $erro_fk = "Registo em uso! Não foi possível apagar o registo";
                return view('painel.usuario_sistema.show_usuario_sistema', compact('show', 'acao'))->withErrors($erro_fk);
            }
            else{
                return view('painel.usuario_sistema.show_usuario_sistema', compact('show', 'acao'))->withErrors($erro_fk);
            }
        }
    }
}
