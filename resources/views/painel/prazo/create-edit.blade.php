@extends('templates.appAdministrativo')

@section('title')
    {{ isset($title) ? $title : 'Prazos' }}
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
            <h5 class="txt_azul">{!! isset($prazo) ? '<i class="fi-pencil"></i> '."<b>$prazo->dr_nome</b>" : '<i class="fi-plus"></i> Dias para consulta de validade'!!} </h5>
        </legend>

        @if( isset($prazo))
            {!! Form::model($prazo, ['route' => ['prazo.update', $prazo->dr_codigo], 'method' => 'PUT', 'class' => 'form', 'data-abide novalidate'] ) !!}
        @else
            {!! Form::open(['route' => 'prazo.store', 'class' => 'form', 'data-abide novalidate']) !!}
        @endif
        <div class="row">
            <div class="small-12 medium-12 columns">

                {!! Form::label('dr_nome', 'Dias' )!!}
                {!! Form::number('dr_nome', null, ['placeholder' => 'Dias', 'id'=>'dias', 'required pattern'=>'number']) !!}
                {{--Validacao--}}
                @if($errors->first('dr_nome') == null)
                    <span class="form-error" data-form-error-for="dias">{{'Valores númericos permitidos!'}}</span>
                @else
                    <span class="validacao">{{dump($errors->first('dr_nome'))}}</span>
                @endif
                {{--Validacao--}}

            </div>

        </div>
        <div class="row">
            <div class="small-12 medium-12 columns" style="margin-top: 0.7rem">
                {{--{{ Form::button("!isset($prazo) ? Salvar : Actualizar", ['type'=>'submit', 'class' => 'success button']) }}--}}
                @if(!isset($prazo))
                    {!! Form::button('<i class="fi-check"></i> Salvar', ['type'=>'submit', 'class'=>'small success button']) !!}
                @else
                    {!! Form::button('<i class="fi-check"></i> Actualizar', ['type'=>'submit', 'class'=>'small success button']) !!}
                @endif
                {!! Form::reset('Limpar', ['class' => 'small warning button']) !!}
                <a href="{{route('prazo.index')}}" class="small alert button"><i class="fi-x"></i> Cancelar </a>
            </div>
        </div>
        {!! Form::close() !!}

    </fieldset>
@endsection