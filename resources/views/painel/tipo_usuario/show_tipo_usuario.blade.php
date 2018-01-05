
@extends('templates.appAdministrativo')

@section('title')
{{ isset($title) ? $title : 'Detalhes do Tipo de Usuário' }}
@endsection

@section('content')
@if($errors->all())
<div class="alert callout" data-closable="slide-out-right">
    @foreach($errors->all() as $erro)
    {{$erro}}
    @endforeach
    <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="row">
    <div class="small-12 columns">
        <fieldset class="fieldset">
            <legend><h5 class="txt_azul"><i class="fi-eye"></i> Detalhes <i class="fi-arrow-right"></i> <b style="color: darkslategray">{{$show->tpu_nome}}</b> </h5></legend>
            
            <div class="small 12 columns">
                <table class="tbl-detalhes">
                    <thead>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr><td><b>Tipo: </b> {{$show->tpu_nome}}</td></tr>
                        <tr><td><b>Sigla: </b> {{$show->tpu_sigla}}</td></tr>
                        <tr><td><b>Descrição: </b> {{$show->tpu_descricao}}</td></tr>
                        <tr>
                            <td>
                                <b>Permissões:</b><br>
                                @foreach($show->permissoes as $permissao)
                                    <p><t><i><b>{{$permissao->per_nome}}</b></i></t> : {{$permissao->per_descricao}}</p>
                                @endforeach

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {!! Form::open(['route' => ['tipo_usuario.destroy', $show->tpu_codigo], 'method' => 'DELETE']) !!}

            @if($acao)
            <a href="{{route('tipo_usuario.index')}}" class="small secondary button"><i class="fi-previous"></i> Voltar </a>
            @else
            {!! Form::button('<i class="fi-minus"></i> Apagar', ['type'=>'submit', 'class'=>'small alert button']) !!}
            <a href="{{route('tipo_usuario.index')}}" class="small alert button"><i class="fi-x"></i> Cancelar </a>
            @endif
            {!! Form::close() !!}
        </fieldset>
    </div>
</div>
@endsection