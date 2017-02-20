<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use App\Model\Painel\AntivirusModel;
use App\Http\Requests\Painel\MarcaStoreUpdateFormRequest;

class AntivirusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $antivirus;

    public function __construct(AntivirusModel $antivirusModel){
        $this->antivirus = $antivirusModel;
    }
    public function index()
    {
        //
        $antivirus = $this->antivirus->all();
        return view('painel.antivirus.index_antivirus', compact('antivirus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //'
        return view('painel.antivirus.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarcaStoreUpdateFormRequest $request)
    {
        //
        $dataForm = $request->all();
        $cadastro = $this->antivirus->create($dataForm);
        if($cadastro){
            $sucesso = "Registo inserido com sucesso!";
            return redirect()->route('antivirus.index')->withErrors($sucesso);
        }
        else{
            $erro = "Erro ao cadastrar";
            return redirect()->route('antivirus.create')->withErrors($erro);
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
        $show = $this->antivirus->find($id);
        $acao = $request->input('acao');
        $title = "Detalhes da Marca";
        if($acao){
            return view('painel.antivirus.show_antivirus', compact('acao', 'show', 'title'));
        }
        else{
            $acao = false;
            return view('painel.antivirus.show_antivirus', compact('acao', 'show', 'title'));
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
        $marca = $this->antivirus->find($id);
        $title = "Marca";
        return view('painel.antivirus.create_edit', compact('marca', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MarcaStoreUpdateFormRequest $request, $id)
    {
        //
        $dataForm = $request->all();
        $marca = $this->antivirus->find($id);
        $update = $marca->update($dataForm);
        if($update){
            $sucesso = "Actualizado com sucesso!";
            return redirect()->route('antivirus.index')->withErrors($sucesso);
        }
        else{
            $erro = "Erro ao actualizar!";
            return redirect()->route('antivirus.create')->withErrors($erro);
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
        $marca = $this->antivirus->find($id);
        try{
            $delete = $marca->delete();
            if($delete){
                return redirect()->route('antivirus.index');
            }
            else{
                $erro = "Erro ao apagar!";
                return redirect()->route('antivirus.index')->withErrors($erro);
            }
        }catch (QueryException $e){
            $erro_fk = "Não foi possível apagar o registo";
            $show = $this->antivirus->find($id);
            $acao = false;
            if($e->getCode()==23000){
                $erro_fk = "Registo em uso! Não foi possível apagar o registo";
                return view('painel.antivirus.show_antivirus', compact('show', 'acao'))->withErrors($erro_fk);
            }
            else{
                return view('painel.antivirus.show_antivirus', compact('show', 'acao'))->withErrors($erro_fk);
            }
        }
    }
}
