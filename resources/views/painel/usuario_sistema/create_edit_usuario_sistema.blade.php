@extends('templates.appAdministrativo')

@section('title')
    Usuário do Sistema
@endsection

@section('content')
    {{--    {!! Form::macro('salvar', function(){
                return '<button type="submit" class="success button"><i class="fi-check"></i> Salvar </button>';
        }) !!}

        {!! Form::macro('editar', function(){
                return '<button type="submit" class="success button"><i class="fi-check"></i> Actualizar </button>';
        }) !!}--}}

    <fieldset class="fieldset">

        <legend><h5 class="txt_azul"> {!! isset($usuario_sistema) ? '<i class="fi-pencil"></i> '."<b>$usuario_sistema->name $usuario_sistema->us_apelido</b>" : '<i class="fi-plus"></i> Novo Usuário'!!} </h5> </legend>
        @if( isset($usuario_sistema))
            {!! Form::model($usuario_sistema, ['route' => ['usuario_sistema.update', $usuario_sistema->us_codigo], 'method' => 'PUT', 'class' => 'form'] ) !!}
        @else
            {!! Form::open(['route' => 'register', 'class' => 'form', 'method'=>'POST']) !!}
        @endif
        <div class="row">
            <div class="small-12 medium-7 columns">
                @if(!isset($usuario_sistema))
                    {!! Form::label('name', 'Nome' )!!}
                    {!! Form::text('name', null, ['placeholder' => 'Nome do Usuário']) !!}
                    <span class="validacao">{{$errors->first('name')}}</span>

                    {!! Form::label('us_apelido', 'Apelido' )!!}
                    {!! Form::text('us_apelido', null, ['placeholder' => 'Apelido do Usuário']) !!}
                    <span class="validacao">{{$errors->first('us_apelido')}}</span>
                @endif

                {!! Form::label('us_cargo', 'Cargo' )!!}
                {!! Form::select('us_cargo', ['' => 'Selecione o cargo'] + $cargo, null ) !!}
                <span class="validacao">{{$errors->first('us_cargo')}}</span>


                {!! Form::label('us_tipo', 'Tipo' )!!}
                {!! Form::select('us_tipo', ['' => 'Selecione o tipo'] + $tipo_usuario, null ) !!}
                <span class="validacao">{{$errors->first('us_tipo')}}</span>

                @if(!isset($usuario_sistema))
                        {!! Form::label('email', 'Email' )!!}
                        {!! Form::text('email', null, ['placeholder' => 'Email do Usuário']) !!}
                        <span class="validacao">{{$errors->first('email')}}</span>
                @endif
            </div>

            @if(!isset($usuario_sistema))
            <div class="small-12 medium-5 columns">
                <fieldset class="fieldset">
                    <legend class="txt_azul"> Dados de Login </legend>
                    {!! Form::label('username', 'Usuário' )!!}
                    {!! Form::text('username', null, ['placeholder' => 'Usuário de Login']) !!}
                    <span class="validacao">{{$errors->first('username')}}</span>

                    <span class="validacao">{{ $errors->has('password') ? ' has-error' : '' }}</span>
                    {!! Form::label('password', 'Senha') !!}
                    {!! Form::password('password', ['name'=>'password']) !!}
                    <span class="validacao">{{$errors->first('password')}}</span>

                    {!! Form::label('passowrd-confirm', 'Confirmar Senha') !!}
                    {!! Form::password('password-confirm', ['name'=>'password_confirmation', 'id'=>'password-confirm']) !!}

                </fieldset>
            </div>
            @endif



        </div>
        <div class="row">
            <div class="small-12 columns">
                @if(!isset($usuario_sistema))
                    {!! Form::button('<i class="fi-check"></i> Registar', ['type'=>'submit', 'class'=>'success button']) !!}
                @else
                    {!! Form::button('<i class="fi-check"></i> Actualizar', ['type'=>'submit', 'class'=>'success button']) !!}
                @endif
                {!! Form::reset('Limpar', ['class' => 'warning button']) !!}
                <a href="{{route('usuario_sistema.index')}}" class="alert button"><i class="fi-x"></i> Cancelar </a>
            </div>
        </div>
        {!! Form::close() !!}

    </fieldset>
@endsection