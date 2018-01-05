@extends('templates.appAdministrativo')

@section('title')
    {{ isset($title) ? $title : 'Cargos' }}
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
            <h5 class="txt_azul">{!! isset($cargo) ? '<i class="fi-pencil"></i> '."<b>$cargo->carg_nome</b>" : '<i class="fi-plus"></i> Cargo'!!}</h5>
        </legend>

        @if( isset($cargo))
            {!! Form::model($cargo, ['route' => ['cargo.update', $cargo->carg_codigo], 'method' => 'PUT', 'class' => 'form', 'data-abide novalidate'] ) !!}
        @else
            {!! Form::open(['route' => 'cargo.store', 'class' => 'form', 'data-abide novalidate']) !!}
        @endif
        <div class="row">
            <div class="small-12 medium-12 columns">

                {!! Form::label('carg_nome', 'Cargo' )!!}
                {!! Form::text('carg_nome', null, ['placeholder' => 'Cargo do Usuário', 'id'=>'carg_nome', 'required']) !!}
                @if($errors->first('carg_nome') == null)
                    <span class="form-error"
                          data-form-error-for="carg_nome">{{'O nome do Cargo é obrigatório!'}}</span>
                @else
                    <span class="validacao">{{$errors->first('carg_nome')}}</span>
                @endif
            </div>

        </div>
        <div class="row">
            <div class="small-12 medium-12 columns" style="margin-top: 0.7rem">
                {{--{{ Form::button("!isset($prazo) ? Salvar : Actualizar", ['type'=>'submit', 'class' => 'success button']) }}--}}
                @if(!isset($cargo))
                    {!! Form::button('<i class="fi-check"></i> Salvar', ['type'=>'submit', 'class'=>'small success button']) !!}
                @else
                    {!! Form::button('<i class="fi-check"></i> Actualizar', ['type'=>'submit', 'class'=>'small success button']) !!}
                @endif
                {!! Form::reset('Limpar', ['class' => 'small warning button']) !!}
                <a href="{{route('cargo.index')}}" class="small alert button"><i class="fi-x"></i> Cancelar </a>
            </div>
        </div>
        {!! Form::close() !!}

    </fieldset>
@endsection