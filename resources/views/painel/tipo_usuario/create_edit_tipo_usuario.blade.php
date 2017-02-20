@extends('templates.appAdministrativo')

@section('title')
    {{ isset($title) ? $title : 'Tipo de Usuário' }}
@endsection
@section('content')
    <fieldset class="fieldset">

        <legend><h5 class="txt_azul">{!! isset($tipo_usuario) ? '<i class="fi-pencil"></i> '."<b>$tipo_usuario->tpu_nome</b>" : '<i class="fi-plus"></i> Tipo de Usuário'!!}</h5> </legend>

        @if( isset($tipo_usuario))
            {!! Form::model($tipo_usuario, ['route' => ['tipo_usuario.update', $tipo_usuario->tpu_codigo], 'method' => 'PUT', 'class' => 'form'] ) !!}
        @else
            {!! Form::open(['route' => 'tipo_usuario.store', 'class' => 'form']) !!}
        @endif
        <div class="row">
            <div class="small-12 medium-12 columns">

                {!! Form::label('tpu_nome', 'Tipo' )!!}
                {!! Form::text('tpu_nome', null, ['placeholder' => 'Tipo de Usuário']) !!}
                <span class="validacao">{{$errors->first('tpu_nome')}}</span>
            </div>

        </div>
        <div class="row">
            <div class="small-12 medium-12 columns" style="margin-top: 0.7rem">
                {{--{{ Form::button("!isset($prazo) ? Salvar : Actualizar", ['type'=>'submit', 'class' => 'success button']) }}--}}
                @if(!isset($tipo_usuario))
                    {!! Form::button('<i class="fi-check"></i> Salvar', ['type'=>'submit', 'class'=>'success button']) !!}
                @else
                    {!! Form::button('<i class="fi-check"></i> Actualizar', ['type'=>'submit', 'class'=>'success button']) !!}
                @endif
                {!! Form::reset('Limpar', ['class' => 'warning button']) !!}
                <a href="{{route('tipo_usuario.index')}}" class="alert button"><i class="fi-x"></i> Cancelar </a>
            </div>
        </div>
        {!! Form::close() !!}

    </fieldset>
@endsection