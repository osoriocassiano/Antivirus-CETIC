<?php

namespace App\Http\Controllers\Painel\Auxiliar;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class LicencaAuxiliarController extends Controller
{
    //
    public function dentroDoPrazo(){
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

        return view('painel.licenca.index_licenca', compact('licenca','prazo'));
    }

    public function listarTodos(){
        $prazo = DB::table('tbl_dias_remanescentes')->select('tbl_dias_remanescentes.dr_nome', 'tbl_dias_remanescentes.dr_codigo')->get();

        $licenca = DB::table('tbl_antivirus_pc')
            ->leftjoin('tbl_usuario_computador', 'tbl_antivirus_pc.apc_serial_pc', '=', 'tbl_usuario_computador.uc_serial')
            ->leftjoin('tbl_marca_antiv', 'tbl_antivirus_pc.apc_marca_antiv', '=', 'tbl_marca_antiv.mar_ant_codigo')
            ->leftjoin('tbl_usuario_sistema', 'tbl_antivirus_pc.apc_responsavel_registo', '=', 'tbl_usuario_sistema.us_codigo')
            ->select('tbl_antivirus_pc.*', 'tbl_usuario_computador.*', 'tbl_marca_antiv.mar_ant_nome', 'tbl_usuario_sistema.*')
            ->get();

        return view('painel.licenca.index_licenca', compact('licenca','prazo'));
    }

    public function listarPorPrazo(Request $request){
        /*$codigo = $request->input('dias');
        return "{$codigo}";*/
        //$userID = $_GET['valor'];
        //return "{$userID}";
        //$prazo = DB::table('tbl_dias_remanescentes')->select('tbl_dias_remanescentes.dr_nome', 'tbl_dias_remanescentes.dr_codigo')->get();

        $licenca = DB::select( DB::raw("SELECT * FROM tbl_antivirus_pc
                                                 LEFT JOIN tbl_usuario_computador ON tbl_antivirus_pc.apc_serial_pc = tbl_usuario_computador.uc_serial
                                                 LEFT JOIN tbl_marca_antiv ON tbl_antivirus_pc.apc_marca_antiv = tbl_marca_antiv.mar_ant_codigo
                                                 LEFT JOIN tbl_usuario_sistema ON tbl_antivirus_pc.apc_responsavel_registo = tbl_usuario_sistema.us_codigo
                                                 WHERE (apc_validade-DATEDIFF(CURDATE(), apc_data_registo)) > 0
                                       ")
        );

        //return view('painel.licenca.index_licenca', compact('licenca','prazo'));
        //eturn view('painel.query');
       /* if(Request::ajax()) {
            //$data = Input::all();
            //print_r($data);die;
        }*/
        /*$data = $request->input('id');
        return "{$data}";*/
        return view('painel.query', compact('licenca'));

    }
}
