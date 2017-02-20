
@extends('templates.appAdministrativo')

@section('title')
    {{ isset($title) ? $title : 'Prazos' }}
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
        <legend><h5 class="txt_azul"><i class="fi-eye"></i> Detalhes <i class="fi-arrow-right"></i> <b style="color: darkslategray">{{$show->dr_nome}}</b> </h5></legend>
        <div class="detalhes"><b>Dia: </b> {{$show->dr_nome}}</div>

        {!! Form::open(['route' => ['prazo.destroy', $show->dr_codigo], 'method' => 'DELETE']) !!}

        @if($acao)
            <a href="{{route('prazo.index')}}" class="small secondary button"><i class="fi-previous"></i> Voltar </a>
        @else
            {!! Form::button('<i class="fi-minus"></i> Apagar', ['type'=>'submit', 'class'=>'small alert button']) !!}
            <a href="{{route('prazo.index')}}" class="small alert button"><i class="fi-x"></i> Cancelar </a>
        @endif
        {!! Form::close() !!}
    </fieldset>
@endsection