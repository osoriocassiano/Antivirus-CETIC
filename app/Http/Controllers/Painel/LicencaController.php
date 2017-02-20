<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use App\Model\Painel\LicencaModel;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Painel\LicencaPcStoreUpdateFormRequest;

class LicencaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $licenca;
    public function __construct(LicencaModel $licencaModel){
        $this->licenca = $licencaModel;
    }
    public function index()
    {
        //
        //$prazo = DB::table('tbl_dias_remanescentes')->pluck('dr_nome', 'dr_codigo')->all();
        $prazo = DB::table('tbl_dias_remanescentes')->select('tbl_dias_remanescentes.dr_nome', 'tbl_dias_remanescentes.dr_codigo')->get();
        $dias = DB::table('tbl_dias_remanescentes')->select('tbl_dias_remanescentes.dr_nome')->take('5')->orderBy('tbl_dias_remanescentes.dr_nome', 'ASC')->get();

        $licenca = DB::table('tbl_antivirus_pc')
            ->leftjoin('tbl_usuario_computador', 'tbl_antivirus_pc.apc_serial_pc', '=', 'tbl_usuario_computador.uc_serial')
            ->leftjoin('tbl_marca_antiv', 'tbl_antivirus_pc.apc_marca_antiv', '=', 'tbl_marca_antiv.mar_ant_codigo')
            ->leftjoin('tbl_usuario_sistema', 'tbl_antivirus_pc.apc_responsavel_registo', '=', 'tbl_usuario_sistema.us_codigo')
            ->select('tbl_antivirus_pc.*', 'tbl_usuario_computador.*', 'tbl_marca_antiv.mar_ant_nome', 'tbl_usuario_sistema.*')
            ->get();

        return view('painel.licenca.index_licenca', compact('licenca','prazo','dias'));
        //return view('painel.teste', compact('dias'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $marca = DB::table('tbl_marca_antiv')->pluck('mar_ant_nome', 'mar_ant_codigo')->all();
        $serial_pc =DB::table('tbl_usuario_computador')->pluck('uc_serial', 'uc_serial')->all();
        return view('painel.licenca.create_edit_licenca', compact('marca', 'serial_pc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LicencaPcStoreUpdateFormRequest $request)
    {
        //
        $dataForm = $request->all();
        $cadastro = $this->licenca->create($dataForm);
        if($cadastro){
            $sucesso = "Registo inserido com sucesso!";
            return redirect()->route('licenca.index')->withErrors($sucesso);
        }
        else{
            $erro = "Não foi possível inserir o registo!";
            return redirect()->route('licenca.create')->withErrors($erro);
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
        $show = DB::table('tbl_antivirus_pc')
            ->leftjoin('tbl_usuario_computador', 'tbl_antivirus_pc.apc_serial_pc', '=', 'tbl_usuario_computador.uc_serial')
            ->leftjoin('tbl_marca_antiv', 'tbl_antivirus_pc.apc_marca_antiv', '=', 'tbl_marca_antiv.mar_ant_codigo')
            ->leftjoin('tbl_usuario_sistema', 'tbl_antivirus_pc.apc_responsavel_registo', '=', 'tbl_usuario_sistema.us_codigo')
            ->select('tbl_antivirus_pc.*', 'tbl_usuario_computador.*', 'tbl_marca_antiv.mar_ant_nome', 'tbl_usuario_sistema.*')
            ->where('tbl_antivirus_pc.apc_codigo', '=', $id)
            ->first();
        $acao = $request->input('acao');
        $title = "Detalhes da Licença {$show->apc_serial_antiv}";

        if($acao){
            return view('painel.licenca.show_licenca', compact('acao','show', 'title'));
        }
        else{
            $acao = false;
            return view('painel.licenca.show_licenca', compact('acao','show', 'title'));
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
        $marca = DB::table('tbl_marca_antiv')->pluck('mar_ant_nome', 'mar_ant_codigo')->all();
        $serial_pc =DB::table('tbl_usuario_computador')->pluck('uc_serial', 'uc_serial')->all();
        $licenca = $this->licenca->find($id);
        $title = "Actualizar {$licenca->apc_serial_antiv}";
        return view('painel.licenca.create_edit_licenca', compact('licenca', 'title', 'marca', 'serial_pc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LicencaPcStoreUpdateFormRequest $request, $id)
    {
        //
        $dataForm = $request->all();
        $licenca = $this->licenca->find($id);
        $update = $licenca->update($dataForm);
        if($update){
            $sucesso = "Registo actualizado com Sucesso!";
            return redirect()->route('licenca.index')->withErrors($sucesso);
        }
        else{
            $erro = "Erro ao inserir o registo!";
            return redirect()->route('licenca.edit', $id)->withErrors($erro);
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
        $licenca = $this->licenca->find($id);

        try{
            $delete = $licenca->delete();

            if($delete){
                return redirect()->route('licenca.index');
            }
            else{
                $erro = "Erro ao apagar!";
                return redirect()->route('licenca.index')->withErrors($erro);
            }
        }catch (QueryException $e){
            $erro_fk = "Não foi possível apagar o registo";
            $show = $this->licenca->find($id);
            $acao = false;
            if($e->getCode()==23000){
                $erro_fk = "Registo em uso! Não foi possível apagar o registo";
                return view('painel.licenca.show_licenca', compact('show', 'acao'))->withErrors($erro_fk);
            }
            else{
                return view('painel.licenca.show_licenca', compact('show', 'acao'))->withErrors($erro_fk);
            }
        }
    }

    public function dentroDoPrazo(){
        $dias = DB::table('tbl_dias_remanescentes')->select('tbl_dias_remanescentes.dr_nome')->take('5')->orderBy('tbl_dias_remanescentes.dr_nome', 'ASC')->get();
        $prazo = DB::table('tbl_dias_remanescentes')->select('tbl_dias_remanescentes.dr_nome', 'tbl_dias_remanescentes.dr_codigo')->get();

        /*$licenca = DB::table('tbl_antivirus_pc')
            ->leftjoin('tbl_usuario_computador', 'tbl_antivirus_pc.apc_serial_pc', '=', 'tbl_usuario_computador.uc_serial')
            ->leftjoin('tbl_marca_antiv', 'tbl_antivirus_pc.apc_marca_antiv', '=', 'tbl_marca_antiv.mar_ant_codigo')
            ->leftjoin('tbl_usuario_sistema', 'tbl_antivirus_pc.apc_responsavel_registo', '=', 'tbl_usuario_sistema.us_codigo')
            ->select('tbl_antivirus_pc.*', 'tbl_usuario_computador.*', 'tbl_marca_antiv.mar_ant_nome', 'tbl_usuario_sistema.*')
            ->where('tbl_antivirus_pc.apc_serial_pc','>', 0)
            ->get();*/

        $dias_restantes = 20;
        $licenca = DB::select( DB::raw("SELECT * FROM tbl_antivirus_pc
                                                 LEFT JOIN tbl_usuario_computador ON tbl_antivirus_pc.apc_serial_pc = tbl_usuario_computador.uc_serial
                                                 LEFT JOIN tbl_marca_antiv ON tbl_antivirus_pc.apc_marca_antiv = tbl_marca_antiv.mar_ant_codigo
                                                 LEFT JOIN tbl_usuario_sistema ON tbl_antivirus_pc.apc_responsavel_registo = tbl_usuario_sistema.us_codigo
                                                 WHERE (apc_validade-DATEDIFF(CURDATE(), apc_data_registo)) > 0
                                       ")
        );

        return view('painel.licenca.index_licenca', compact('licenca','prazo', 'dias'));
    }

    public function listarTodos(){
        $prazo = DB::table('tbl_dias_remanescentes')->select('tbl_dias_remanescentes.dr_nome', 'tbl_dias_remanescentes.dr_codigo')->get();
        $dias = DB::table('tbl_dias_remanescentes')->select('tbl_dias_remanescentes.dr_nome')->take('5')->orderBy('tbl_dias_remanescentes.dr_nome', 'ASC')->get();
        $licenca = DB::table('tbl_antivirus_pc')
            ->leftjoin('tbl_usuario_computador', 'tbl_antivirus_pc.apc_serial_pc', '=', 'tbl_usuario_computador.uc_serial')
            ->leftjoin('tbl_marca_antiv', 'tbl_antivirus_pc.apc_marca_antiv', '=', 'tbl_marca_antiv.mar_ant_codigo')
            ->leftjoin('tbl_usuario_sistema', 'tbl_antivirus_pc.apc_responsavel_registo', '=', 'tbl_usuario_sistema.us_codigo')
            ->select('tbl_antivirus_pc.*', 'tbl_usuario_computador.*', 'tbl_marca_antiv.mar_ant_nome', 'tbl_usuario_sistema.*')
            ->get();

        return view('painel.licenca.index_licenca', compact('licenca','prazo', 'dias'));
    }


    public function listarPorPrazo(Request $request){

        $dias_pesquisa = $request->input('id');
        $dias = DB::table('tbl_dias_remanescentes')->select('tbl_dias_remanescentes.dr_nome')->take('5')->orderBy('tbl_dias_remanescentes.dr_nome', 'ASC')->get();

        //$prazo = DB::table('tbl_dias_remanescentes')->select('tbl_dias_remanescentes.dr_nome', 'tbl_dias_remanescentes.dr_codigo')->get();

        $licenca = DB::select( DB::raw("SELECT * FROM tbl_antivirus_pc
                                                 LEFT JOIN tbl_usuario_computador ON tbl_antivirus_pc.apc_serial_pc = tbl_usuario_computador.uc_serial
                                                 LEFT JOIN tbl_marca_antiv ON tbl_antivirus_pc.apc_marca_antiv = tbl_marca_antiv.mar_ant_codigo
                                                 LEFT JOIN tbl_usuario_sistema ON tbl_antivirus_pc.apc_responsavel_registo = tbl_usuario_sistema.us_codigo
                                                 WHERE ((tbl_antivirus_pc.apc_validade-DATEDIFF(CURDATE(), tbl_antivirus_pc.apc_data_registo)) > 0 && (tbl_antivirus_pc.apc_validade-DATEDIFF(CURDATE(), tbl_antivirus_pc.apc_data_registo)) < $dias_pesquisa)
                                       ")
        );

        return view('painel.query', compact('licenca', 'dias'));

    }
}
