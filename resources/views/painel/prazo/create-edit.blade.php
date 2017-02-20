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

        <legend><h5 class="txt_azul">{!! isset($prazo) ? '<i class="fi-pencil"></i> '."<b>$prazo->dr_nome</b>" : '<i class="fi-plus"></i> Dias para consulta de validade'!!} </h5> </legend>

        @if( isset($prazo))
                {!! Form::model($prazo, ['route' => ['prazo.update', $prazo->dr_codigo], 'method' => 'PUT', 'class' => 'form'] ) !!}
        @else
                {!! Form::open(['route' => 'prazo.store', 'class' => 'form']) !!}
        @endif
            <div class="row">
                <div class="small-12 medium-12 columns">

                        {!! Form::label('dr_nome', 'Dias' )!!}
                        {!! Form::text('dr_nome', null, ['placeholder' => 'Dias']) !!}
                        <span class="validacao">{{$errors->first('dr_nome')}}</span>
                    </div>

                </div>
                <div class="row">
                    <div class="small-12 medium-12 columns" style="margin-top: 0.7rem">
                        {{--{{ Form::button("!isset($prazo) ? Salvar : Actualizar", ['type'=>'submit', 'class' => 'success button']) }}--}}
                        @if(!isset($prazo))
                            {!! Form::button('<i class="fi-check"></i> Salvar', ['type'=>'submit', 'class'=>'success button']) !!}
                        @else
                            {!! Form::button('<i class="fi-check"></i> Actualizar', ['type'=>'submit', 'class'=>'success button']) !!}
                        @endif
                        {!! Form::reset('Limpar', ['class' => 'warning button']) !!}
                        <a href="{{route('prazo.index')}}" class="alert button"><i class="fi-x"></i> Cancelar </a>
                    </div>
                </div>
        {!! Form::close() !!}

    </fieldset>
@endsection