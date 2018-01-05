<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Requests\Painel\PermissaoStoreUpdateFormRequest;
use App\Http\Controllers\Controller;
use App\Model\Painel\PermissaoModel;
use Illuminate\Support\Facades\Gate;

class PermissaoController extends Controller
{
    //
    private $permissao;

    /**
     * PermissaoController constructor.
     */
    public function __construct(PermissaoModel $permissao)
    {
        $this->permissao = $permissao;

    }

    public function index()
    {
        if (Gate::denies('gerir_permissoes'))
            abort(403, "Sem autorizacao");

        $permissoes = $this->permissao->all();
        return view('painel.permissao.index_permissao', compact('permissoes'));
    }

    public function create()
    {
        return view('painel.permissao.create_edit_permissao');
    }

    public function store(PermissaoStoreUpdateFormRequest $request)
    {
        $dataForm = $request->all();
        $cadastro = $this->permissao->create($dataForm);

        if ($cadastro) {
            $sucesso = "Registo inserido com sucesso!";
            return redirect()->route('permissao.index')->withErrors($sucesso);
        } else {
            $erro = "Não foi possível inserir o registo!";
            return redirect()->route('permissao.create')->withErrors($erro);
        }
    }

    public function edit($id)
    {
        //Recupera todos dados do prazo pelo seu ID
        $permissao = $this->permissao->find($id);

        //Deine o titulo da pagina
        $title = "Editando o prazo $permissao->per_nome";

        //Retorna a view com os dados a serem editados
        return view('painel.permissao.create_edit_permissao', compact('permissao', 'title'));
    }

    public function update(PermissaoStoreUpdateFormRequest $request, $id)
    {
        //
        $dataForm = $request->all();
        $permissao = $this->permissao->find($id);

        $update = $permissao->update($dataForm);

        if ($update) {
            return redirect()->route('permissao.index');
        } else {
            return redirect()->route('permissao.edit', $id)->with(['errors' => 'Erro ao Editar']);
        }
    }

    public function show(Request $request, $id)
    {
        //
        /*

                return view('painel.prazo.show_prazo', compact('show'));*/
        $show = $this->permissao->find($id);
        $acao = $request->input('acao');
        $title = "Detalhes do Permissão";

        if ($acao) {
            return view('painel.permissao.show_permissao', compact('acao', 'show', 'title'));
        } else {
            $acao = false;
            return view('painel.permissao.show_permissao', compact('acao', 'show', 'title'));
        }

        //return "Mostrar {$acao}{$id}";
    }

    public function destroy($id)
    {
        //
        $permissao = $this->permissao->find($id);

        try {
            $delete = $permissao->delete();

            if ($delete) {
                return redirect()->route('permissao.index');
            } else {
                $erro = "Erro ao apagar";
                return redirect()->route('permissao.index')->withErrors($erro);
            }
        } catch (QueryException $e) {
            $erro_fk = "Não foi possível apagar o registo";
            $show = $this->permissao->find($id);
            $acao = false;
            if ($e->getCode() == 23000) {
                $erro_fk = "Registo em uso! Não foi possível apagar o registo";
                return view('painel.prazo.show_prazo', compact('show', 'acao'))->withErrors($erro_fk);
            } else {
                return view('painel.prazo.show_prazo', compact('show', 'acao'))->withErrors($erro_fk);
            }
        }
    }
}
