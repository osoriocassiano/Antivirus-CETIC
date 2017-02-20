@extends('templates.appAdministrativo')

@section('title')
    {{ isset($title) ? $title : 'Usuário' }}
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
        <legend><h5 class="txt_azul"><i class="fi-eye"></i> Detalhes <i class="fi-arrow-right"></i> <b style="color: darkslategray">{{$show->uc_nome.' '.$show->uc_apelido}}</b> </h5></legend>
        <div class="small-12 columns detalhes"><b>Nome: </b> {{$show->uc_nome}}</div>
        <div class="small-12 columns detalhes"><b>Apelido: </b> {{$show->uc_apelido}}</div>
        <div class="small-12 columns detalhes"><b>Serial: </b> {{$show->uc_serial}}</div>
        <div class="small-12 columns detalhes"><b>Data Regsito: </b> {{$show->uc_data_registo}}</div>


        <div class="row">
            <div class="small-12 columns">
                {!! Form::open(['route' => ['usuario_pc.destroy', $show->uc_codigo], 'method' => 'DELETE']) !!}

                @if($acao)
                    <a href="{{route('usuario_pc.index')}}" class="small secondary button"><i class="fi-previous"></i> Voltar </a>
                @else
                    {!! Form::button('<i class="fi-minus"></i> Apagar', ['type'=>'submit', 'class'=>'small alert button']) !!}
                    <a href="{{route('usuario_pc.index')}}" class="small alert button"><i class="fi-x"></i> Cancelar </a>
                @endif
                {!! Form::close() !!}
            </div>
        </div>
    </fieldset>

@endsection