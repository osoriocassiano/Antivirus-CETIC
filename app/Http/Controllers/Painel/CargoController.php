<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Painel\CargoModel;
use App\Http\Requests\Painel\CargoStoreUpdateFormRequest;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $cargo;
    public function __construct(CargoModel $cargoModel){
        $this->cargo = $cargoModel;
    }
    public function index()
    {
        //
        $cargo = $this->cargo->all();
        $title = "Cargos";
        return view('painel.cargo.index_cargo', compact('cargo', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('painel.cargo.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CargoStoreUpdateFormRequest $request)
    {
        //
        $dataForm = $request->all();
        $cadastro = $this->cargo->create($dataForm);
        if($cadastro){
            $sucesso = "Registo inserido com sucesso!";
            return redirect()->route('cargo.index')->withErrors($sucesso);
        }
        else{
            $erro = "Não foi possível inserir o registo!";
            return redirect()->route('cargo.create')->withErrors($erro);
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
        $show = $this->cargo->find($id);
        $acao = $request->input('acao');
        $title = "Detalhes do cargo {$show->carg_nome}";

        if($acao){
            return view('painel.cargo.show_cargo', compact('acao','show', 'title'));
        }
        else{
            $acao = false;
            return view('painel.cargo.show_cargo', compact('acao','show', 'title'));
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
        $cargo = $this->cargo->find($id);
        $title = "Editar o cargo {$cargo->carg_nome}";
        return view('painel.cargo.create_edit', compact('cargo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CargoStoreUpdateFormRequest $request, $id)
    {
        //
        $dataForm = $request->all();
        $cargo = $this->cargo->find($id);
        $update = $cargo->update($dataForm);
        if($update){
            $sucesso = "Registo actualizado com Sucesso!";
            return redirect()->route('cargo.index')->withErrors($sucesso);
        }
        else{
            $erro = "Erro ao inserir o registo!";
            return redirect()->route('cargo.edit', $id)->withErrors($erro);
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
        $cargo = $this->cargo->find($id);

        try{
            $delete = $cargo->delete();

            if($delete){
                return redirect()->route('cargo.index');
            }
            else{
                $erro = "Erro ao apagar!";
                return redirect()->route('cargo.index')->withErrors($erro);
            }
        }catch (QueryException $e){
            $erro_fk = "Não foi possível apagar o registo";
            $show = $this->cargo->find($id);
            $acao = false;
            if($e->getCode()==23000){
                $erro_fk = "Registo em uso! Não foi possível apagar o registo";
                return view('painel.cargo.show_cargo', compact('show', 'acao'))->withErrors($erro_fk);
            }
            else{
                return view('painel.cargo.show_cargo', compact('show', 'acao'))->withErrors($erro_fk);
            }
        }
    }
}
