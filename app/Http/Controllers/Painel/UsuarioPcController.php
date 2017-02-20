<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use App\Model\Painel\UsuarioPcModel;
use App\Http\Requests\Painel\UsuarioPcStoreUpdateFormRequest;

class UsuarioPcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $usuario_pc;
    public function __construct(UsuarioPcModel $usuarioPcModel){
        $this->usuario_pc = $usuarioPcModel;
    }
    public function index()
    {
        //
        $usuario_pc = $this->usuario_pc->all();
        return view ('painel.usuario_pc.index_usuario_pc', compact('usuario_pc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('painel.usuario_pc.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioPcStoreUpdateFormRequest $request)
    {
        //
        $dataForm = $request->all();
        $cadastro = $this->usuario_pc->create($dataForm);
        if($cadastro){
            $sucesso = "Registo inserido com sucesso!";
            return redirect()->route('usuario_pc.index')->withErrors($sucesso);
        }
        else{
            $erro = "Não foi possível inserir o registo!";
            return redirect()->route('usuario_pc.create')->withErrors($erro);
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
        $show = $this->usuario_pc->find($id);
        $acao = $request->input('acao');
        $title = "Detalhes do {$show->uc_nome}";

        if($acao){
            return view('painel.usuario_pc.show_usuario_pc', compact('acao','show', 'title'));
        }
        else{
            $acao = false;
            return view('painel.usuario_pc.show_usuario_pc', compact('acao','show', 'title'));
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
        //Recupera todos dados do prazo pelo seu ID
        $usuario_pc = $this->usuario_pc->find($id);

        //Deine o titulo da pagina
        $title = "Editando $usuario_pc->uc_nome";

        //Retorna a view com os dados a serem editados
        return view('painel.usuario_pc.create_edit', compact('usuario_pc', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioPcStoreUpdateFormRequest $request, $id)
    {
        //
        $dataForm = $request->all();
        $usuario_pc = $this->usuario_pc->find($id);

        $update = $usuario_pc->update($dataForm);

        if($update){
            $sucesso = "Registo actualizado com sucesso!";
            return redirect()->route('usuario_pc.index')->withErrors($sucesso);
        }
        else{
            $erro = "Erro ao actualizar o registo";
            return redirect()->route('usuario_pc.edit', $id)->withErrors($erro);
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
        $usuario_pc = $this->usuario_pc->find($id);
        try{
            $delete = $usuario_pc->delete();
            if($delete){
                $sucesso = "Apagado com sucesso!";
                return redirect()->route('usuario_pc.index')->withErrors($sucesso);
            }
            else{
                $erro = "Erro ao apagar!";
                return redirect()->route('usuario_pc.index')->withErrors($erro);
            }
        }catch (QueryException $e){
            $erro_fk = "Não foi possível apagar o registo";
            $show = $this->usuario_pc->find($id);
            $acao = false;
            if($e->getCode()==23000){
                $erro_fk = "Registo em uso! Não foi possível apagar o registo";
                return view('painel.usuario_pc.show_usuario_pc', compact('show', 'acao'))->withErrors($erro_fk);
            }
            else{
                return view('painel.usuario_pc.show_usuario_pc', compact('show', 'acao'))->withErrors($erro_fk);
            }
        }
    }
}
