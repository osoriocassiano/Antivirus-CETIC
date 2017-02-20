@extends('templates.appAdministrativo')

@section('title')
    {{ isset($title) ? $title : 'Licença' }}
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
    <fieldset class="fieldset">
        <legend><h5 class="txt_azul"><i class="fi-eye"></i> Detalhes <i class="fi-arrow-right"></i> <b style="color: darkslategray">{{$show->apc_serial_antiv.' '.$show->uc_serial}}</b> </h5></legend>
        <div class="small-12 columns detalhes"><b>Serial do Antivírus: </b> {{$show->apc_serial_antiv}}</div>
        <div class="small-12 columns detalhes"><b>Marca do Antivírus: </b> {{$show->mar_ant_nome}}</div>
        <div class="small-12 columns detalhes"><b>Serial do PC: </b> {{$show->apc_serial_pc}}</div>
        <div class="small-12 columns detalhes"><b>Usuário Associado: </b> {{$show->uc_nome.' '.$show->uc_apelido}}</div>
        <div class="small-12 columns detalhes"><b>Data de Registo: </b> {{$show->apc_data_registo}}</div>
        <div class="small-12 columns detalhes"><b>Dias de Validade: </b> {{$show->apc_validade}}</div>
        <div class="small-12 columns detalhes"><b>Data de Vencimento do Prazo: </b> {{$show->apc_data_vencimento}}</div>
        <div class="small-12 columns detalhes"><b>Responsável pelo Registo no Sistema: </b> {{$show->name.' '.$show->us_apelido}}</div>
        <div class="small-12 columns detalhes"><b>Data de Registo no Sistema: </b> {{$show->apc_data_registo_no_sistema}}</div>
        <div class="small-12 columns detalhes"><b>Data da Ultima Actualização no Sistema: </b> {{$show->apc_ultima_actualizacao }}</div>


        <div class="row">
            <div class="small-12 columns">
                {!! Form::open(['route' => ['licenca.destroy', $show->apc_codigo], 'method' => 'DELETE']) !!}

                @if($acao)
                    <a href="{{route('licenca.index')}}" class="small secondary button"><i class="fi-previous"></i> Voltar </a>
                @else
                    {!! Form::button('<i class="fi-minus"></i> Apagar', ['type'=>'submit', 'class'=>'small alert button']) !!}
                    <a href="{{route('licenca.index')}}" class="small alert button"><i class="fi-x"></i> Cancelar </a>
                @endif
                {!! Form::close() !!}
            </div>
        </div>
    </fieldset>

@endsection