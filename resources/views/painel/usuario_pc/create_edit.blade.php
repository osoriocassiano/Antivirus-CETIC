@extends('templates.appAdministrativo')

@section('title')
    {{ isset($title) ? $title : 'Novo Usuário de PC' }}
@endsection

@section('content')
    {{--    {!! Form::macro('salvar', function(){
                return '<button type="submit" class="success button"><i class="fi-check"></i> Salvar </button>';
        }) !!}

        {!! Form::macro('editar', function(){
                return '<button type="submit" class="success button"><i class="fi-check"></i> Actualizar </button>';
        }) !!}--}}

    <fieldset class="fieldset">

        <legend><h5 class="txt_azul"> {!! isset($usuario_pc) ? '<i class="fi-pencil"></i> '."<b>$usuario_pc->uc_nome $usuario_pc->uc_apelido</b>" : '<i class="fi-plus"></i> Novo Usuário'!!} </h5> </legend>

        @if( isset($usuario_pc))
            {!! Form::model($usuario_pc, ['route' => ['usuario_pc.update', $usuario_pc->uc_codigo], 'method' => 'PUT', 'class' => 'form'] ) !!}
        @else
            {!! Form::open(['route' => 'usuario_pc.store', 'class' => 'form']) !!}
        @endif
        <div class="row">
            <div class="small-12 medium-6 columns">

                {!! Form::label('uc_nome', 'Nome' )!!}
                {!! Form::text('uc_nome', null, ['placeholder' => 'Nome do Usuário']) !!}
                <span class="validacao">{{$errors->first('uc_nome')}}</span>
            </div>
            <div class="small-12 medium-6 columns">

                {!! Form::label('uc_apelido', 'Apelido' )!!}
                {!! Form::text('uc_apelido', null, ['placeholder' => 'Apelido do Usuário']) !!}
                <span class="validacao">{{$errors->first('uc_apelido')}}</span>
            </div>
        </div>

            <div class="row">
            <div class="small-12 medium-6 columns">

                {!! Form::label('uc_serial', 'Serial PC' )!!}
                {!! Form::text('uc_serial', null, ['placeholder' => 'Serial do PC']) !!}
                <span class="validacao">{{$errors->first('uc_serial')}}</span>
            </div>
            <div class="small-12 medium-6 columns">

                {!! Form::label('uc_data_registo', 'Data Registo' )!!}
                {!! Form::text('uc_data_registo', null, ['placeholder' => 'Ano-Mês-Dia']) !!}
                <span class="validacao">{{$errors->first('uc_data_registo')}}</span>
            </div>

        </div>
        <div class="row">
            <div class="small-12 medium-12 columns" style="margin-top: 0.7rem">
                {{--{{ Form::button("!isset($prazo) ? Salvar : Actualizar", ['type'=>'submit', 'class' => 'success button']) }}--}}
                @if(!isset($usuario_pc))
                    {!! Form::button('<i class="fi-check"></i> Salvar', ['type'=>'submit', 'class'=>'success button']) !!}
                @else
                    {!! Form::button('<i class="fi-check"></i> Actualizar', ['type'=>'submit', 'class'=>'success button']) !!}
                @endif
                {!! Form::reset('Limpar', ['class' => 'warning button']) !!}
                <a href="{{route('usuario_pc.index')}}" class="alert button"><i class="fi-x"></i> Cancelar </a>
            </div>
        </div>
        {!! Form::close() !!}

    </fieldset>
@endsection