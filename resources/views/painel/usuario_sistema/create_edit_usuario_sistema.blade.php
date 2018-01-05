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

        <legend>
            <h5 class="txt_azul"> {!! isset($usuario_sistema) ? '<i class="fi-pencil"></i> '."<b>$usuario_sistema->name $usuario_sistema->us_apelido</b>" : '<i class="fi-plus"></i> Novo Usuário'!!} </h5>
        </legend>
        @if( isset($usuario_sistema))
            {!! Form::model($usuario_sistema, ['route' => ['usuario_sistema.update', $usuario_sistema->us_codigo], 'method' => 'PUT', 'class' => 'form', 'data-abide novalidate'] ) !!}
        @else
            {!! Form::open(['route' => 'register', 'class' => 'form', 'method'=>'POST', 'data-abide novalidate']) !!}
        @endif
        <div class="row">
            <div class="small-12 medium-7 columns">
                @if(!isset($usuario_sistema))
                    {!! Form::label('name', 'Nome' )!!}
                    {!! Form::text('name', null, ['placeholder' => 'Nome do Usuário', 'id'=>'name', 'required pattern'=>'alpha']) !!}
                    {{--Validacao--}}
                    @if($errors->first('name') == null)
                        <span class="form-error"
                              data-form-error-for="name">{{'Caracteres alfabéticos permitidos!'}}</span>
                    @else
                        <span class="validacao">{{$errors->first('name')}}</span>
                    @endif
                    {{--Validacao--}}

                    {!! Form::label('us_apelido', 'Apelido' )!!}
                    {!! Form::text('us_apelido', null, ['placeholder' => 'Apelido do Usuário', 'id'=>'us_apelido', 'required pattern'=>'alpha']) !!}
                    {{--Validacao--}}
                    @if($errors->first('us_apelido') == null)
                        <span class="form-error"
                              data-form-error-for="us_apelido">{{'Caracteres alfabéticos permitidos!'}}</span>
                    @else
                        <span class="validacao">{{$errors->first('us_apelido')}}</span>
                    @endif
                    {{--Validacao--}}

                @endif

                {!! Form::label('us_cargo', 'Cargo' )!!}
                {!! Form::select('us_cargo', ['' => 'Selecione o cargo'] + $cargo, null, ['id'=>'us_cargo', 'required'] ) !!}
                    {{--Validacao--}}
                    @if($errors->first('us_cargo') == null)
                        <span class="form-error" data-form-error-for="us_cargo">{{'O Cargo é obrigatório!'}}</span>
                    @else
                        <span class="validacao">{{$errors->first('us_cargo')}}</span>
                    @endif
                    {{--Validacao--}}

                {!! Form::label('us_tipo', 'Tipo' )!!}
                {!! Form::select('us_tipo', ['' => 'Selecione o tipo'] + $tipo_usuario, null, ['id'=>'us_tipo', 'required'] ) !!}
                    {{--Validacao--}}
                    @if($errors->first('us_tipo') == null)
                        <span class="form-error" data-form-error-for="us_tipo">{{'O Tipo de Usuario é obrigatório!'}}</span>
                    @else
                        <span class="validacao">{{$errors->first('us_tipo')}}</span>
                    @endif
                    {{--Validacao--}}

                @if(!isset($usuario_sistema))
                    {!! Form::label('email', 'Email' )!!}
                    {!! Form::text('email', null, ['placeholder' => 'Email do Usuário', 'id'=>'email', 'required pattern'=>'email']) !!}
                        {{--Validacao--}}
                        @if($errors->first('email') == null)
                            <span class="form-error" data-form-error-for="email">{{'Introduza um email válido!'}}</span>
                        @else
                            <span class="validacao">{{$errors->first('email')}}</span>
                        @endif
                        {{--Validacao--}}
                @endif
            </div>

            @if(!isset($usuario_sistema))
                <div class="small-12 medium-5 columns">
                    <fieldset class="fieldset">
                        <legend class="txt_azul"> Dados de Login</legend>
                        {!! Form::label('username', 'Usuário' )!!}
                        {!! Form::text('username', null, ['placeholder' => 'Usuário de Login', 'id'=>'username', 'required']) !!}
                        {{--Validacao--}}
                        @if($errors->first('username') == null)
                            <span class="form-error" data-form-error-for="username">{{'O nome é obrigatório!'}}</span>
                        @else
                            <span class="validacao">{{$errors->first('username')}}</span>
                        @endif
                        {{--Validacao--}}

                        <span class="validacao">{{ $errors->has('password') ? 'Ocorreu um erro' : '' }}</span>

                        {!! Form::label('password', 'Senha') !!}
                        {!! Form::password('password', ['name'=>'password', 'id'=>'password', 'required']) !!}
                        {{--Validacao--}}
                        @if($errors->first('password') == null)
                            <span class="form-error" data-form-error-for="password">{{'Senha obrigatório!'}}</span>
                        @else
                            <span class="validacao">{{$errors->first('password')}}</span>
                        @endif
                        {{--Validacao--}}


                        {!! Form::label('passowrd-confirm', 'Confirmar Senha') !!}
                        {!! Form::password('password-confirm', ['name'=>'password_confirmation', 'id'=>'password-confirm']) !!}

                    </fieldset>
                </div>
            @endif


        </div>
        <div class="row">
            <div class="small-12 columns">
                @if(!isset($usuario_sistema))
                    {!! Form::button('<i class="fi-check"></i> Registar', ['type'=>'submit', 'class'=>'small success button']) !!}
                @else
                    {!! Form::button('<i class="fi-check"></i> Actualizar', ['type'=>'submit', 'class'=>'small success button']) !!}
                @endif
                {!! Form::reset('Limpar', ['class' => 'small warning button']) !!}
                <a href="{{route('usuario_sistema.index')}}" class="small alert button"><i class="fi-x"></i> Cancelar </a>
            </div>
        </div>
        {!! Form::close() !!}

    </fieldset>
@endsection