<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Painel\TipoUsuarioModel;
use App\Http\Requests\Painel\TipoUsuarioPcStoreUpdateFormRequest;



class TipoUsuarioController extends Controller
{
    private $tipo_usuario;

    public function __construct(TipoUsuarioModel $tipoUsuarioModel){
        $this->tipo_usuario = $tipoUsuarioModel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tipo_usuario = $this->tipo_usuario->all();
        //$prazos = DB::table('tbl_dias_remanescentes')->get();
        return view('painel.tipo_usuario.index_tipo_usuario', compact('tipo_usuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('painel.tipo_usuario.create_edit_tipo_usuario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoUsuarioPcStoreUpdateFormRequest $request)
    {
        //
        $dataForm = $request->all();

        $cadastro = $this->tipo_usuario->create($dataForm);

        if($cadastro){
            $sucesso = "Registo inserido com sucesso!";
            return redirect()->route('tipo_usuario.index')->withErrors($sucesso);
        }
        else{
            $erro = "Não foi possível inserir o registo!";
            return redirect()->route('tipo_usuario.create')->withErrors($erro);
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
        $show = $this->tipo_usuario->find($id);
        $acao = $request->input('acao');
        $title = "Detalhes do Tipo";

        if($acao){
            return view('painel.tipo_usuario.show_tipo_usuario', compact('acao','show', 'title'));
        }
        else{
            $acao = false;
            return view('painel.tipo_usuario.show_tipo_usuario', compact('acao','show', 'title'));
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
        $tipo_usuario = $this->tipo_usuario->find($id);

        //Deine o titulo da pagina
        $title = "Editando $tipo_usuario->tpu_nome";

        //Retorna a view com os dados a serem editados
        return view('painel.tipo_usuario.create_edit_tipo_usuario', compact('tipo_usuario', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoUsuarioPcStoreUpdateFormRequest $request, $id)
    {
        //
        $dataForm = $request->all();
        $tipo_usuario = $this->tipo_usuario->find($id);

        $update = $tipo_usuario->update($dataForm);

        if($update){
            $sucesso = "Registo actualizado com sucesso!";
            return redirect()->route('tipo_usuario.index')->withErrors($sucesso);
        }
        else{
            $erro = "Erro ao actualizar o registo";
            return redirect()->route('tipo_usuario.edit', $id)->withErrors($erro);
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
        $tipo_usuario = $this->tipo_usuario->find($id);
        try{
            $delete = $tipo_usuario->delete();
            if($delete){
                return redirect()->route('tipo_usuario.index');
            }
            else{
                $erro = "Erro ao apagar!";
                return redirect()->route('tipo_usuario.index')->withErrors($erro);
            }
        }catch (QueryException $e){
            $erro_fk = "Não foi possível apagar o registo";
            $show = $this->tipo_usuario->find($id);
            $acao = false;
            if($e->getCode()==23000){
                $erro_fk = "Registo em uso! Não foi possível apagar o registo";
                return view('painel.tipo_usuario.show_tipo_usuario', compact('show', 'acao'))->withErrors($erro_fk);
            }
            else{
                return view('painel.tipo_usuario.show_tipo_usuario', compact('show', 'acao'))->withErrors($erro_fk);
            }
        }
    }
}
