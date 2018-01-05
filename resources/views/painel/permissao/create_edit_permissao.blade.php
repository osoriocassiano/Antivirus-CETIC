@extends('templates.appAdministrativo')

@section('title')
    {{ isset($title) ? $title : 'Editar Permissão' }}
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
            <h5 class="txt_azul">{!! isset($permissao) ? '<i class="fi-pencil"></i> '."<b>$permissao->per_nome</b>" : '<i class="fi-plus"></i> Permissão'!!} </h5>
        </legend>

        @if( isset($permissao))
            {!! Form::model($permissao, ['route' => ['permissao.update', $permissao->per_codigo], 'method' => 'PUT', 'class' => 'form', 'data-abide novalidate'] ) !!}
        @else
            {!! Form::open(['route' => 'permissao.store', 'class' => 'form', 'data-abide novalidate']) !!}
        @endif
        <div class="row">
            <div class="small-12 medium-12 columns">

                {!! Form::label('per_nome', 'Permissão' )!!}
                {!! Form::text('per_nome', null, ['placeholder' => 'Permissão', 'id'=>'permissao', 'required']) !!}
                {{--Validacao--}}
                @if($errors->first('per_nome') == null)
                    <span class="form-error"
                          data-form-error-for="permissao">{{'O nome da Permissão é obrigatório!'}}</span>
                @else
                    <span class="validacao">{{$errors->first('per_nome')}}</span>

                @endif
                {{--Validacao--}}

            </div>

        </div>
        <div class="row">
            <div class="small-12 medium-12 columns" style="margin-top: 0.7rem">
                {{--{{ Form::button("!isset($prazo) ? Salvar : Actualizar", ['type'=>'submit', 'class' => 'success button']) }}--}}
                @if(!isset($permissao))
                    {!! Form::button('<i class="fi-check"></i> Salvar', ['type'=>'submit', 'class'=>'small success button']) !!}
                @else
                    {!! Form::button('<i class="fi-check"></i> Actualizar', ['type'=>'submit', 'class'=>'small success button']) !!}
                @endif
                {!! Form::reset('Limpar', ['class' => 'small warning button']) !!}
                <a href="{{route('permissao.index')}}" class="small alert button"><i class="fi-x"></i> Cancelar </a>
            </div>
        </div>
        {!! Form::close() !!}

    </fieldset>
@endsection