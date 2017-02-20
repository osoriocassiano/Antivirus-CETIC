<?php

namespace App\Http\Controllers\Painel;

use App\Http\Requests\Painel\PrazoStoreUpdateFormRequest;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use App\Model\Painel\PrazoModel;
use Illuminate\Support\Facades\DB;

class PrazoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $prazo;

    public function __construct(PrazoModel $prazo){
        $this->prazo = $prazo;
    }
    public function index()
    {
        //
        $prazos = $this->prazo->all();
        //$prazos = DB::table('tbl_dias_remanescentes')->get();
        return view('painel.prazo.index_prazo', compact('prazos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('painel.prazo.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrazoStoreUpdateFormRequest $request)
    {
        // Pega todos dados vindo do formulario
        $dataForm = $request->all();

        //
/*        $this->validate($request, $this->prazo->rules);
        $validator = validator($dataForm, $this->prazo->rules);
        if( $validator->fails()){
            return redirect()->route('prazo.create')->withErrors($validator)->withInput();
        }*/

        $cadastro = $this->prazo->create($dataForm);

        if($cadastro){
            $sucesso = "Registo inserido com sucesso!";
            return redirect()->route('prazo.index')->withErrors($sucesso);
        }
        else{
            $erro = "Não foi possível inserir o registo!";
            return redirect()->route('prazo.create')->withErrors($erro);
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
/*

        return view('painel.prazo.show_prazo', compact('show'));*/
        $show = $this->prazo->find($id);
        $acao = $request->input('acao');
        $title = "Detalhes do Prazo";

        if($acao){
            return view('painel.prazo.show_prazo', compact('acao','show', 'title'));
        }
        else{
            $acao = false;
            return view('painel.prazo.show_prazo', compact('acao','show', 'title'));
        }

        //return "Mostrar {$acao}{$id}";
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Recupera todos dados do prazo pelo seu ID
        $prazo = $this->prazo->find($id);

        //Deine o titulo da pagina
        $title = "Editando o prazo $prazo->dr_nome";

        //Retorna a view com os dados a serem editados
        return view('painel.prazo.create-edit', compact('prazo', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PrazoStoreUpdateFormRequest $request, $id)
    {
        //
        $dataForm = $request->all();
        $prazo = $this->prazo->find($id);

        $update = $prazo->update($dataForm);

        if($update){
            return redirect()->route('prazo.index');
        }
        else{
            return redirect()->route('prazo.edit', $id)->with(['errors' => 'Erro ao Editar']);
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
        $prazo = $this->prazo->find($id);

        try{
            $delete = $prazo->delete();

            if($delete){
                return redirect()->route('prazo.index');
            }
            else{
                $erro = "Erro ao apagar";
                return redirect()->route('prazo.index')->withErrors($erro);
            }
        }catch (QueryException $e){
            $erro_fk = "Não foi possível apagar o registo";
            $show = $this->prazo->find($id);
            $acao = false;
            if($e->getCode()==23000){
                $erro_fk = "Registo em uso! Não foi possível apagar o registo";
                return view('painel.prazo.show_prazo', compact('show', 'acao'))->withErrors($erro_fk);
            }
            else{
                return view('painel.prazo.show_prazo', compact('show', 'acao'))->withErrors($erro_fk);
            }
        }
    }
}
