@extends('templates.appAdministrativo')

@section('title')
    {{ isset($title) ? $title : 'Marca' }}
@endsection
@section('content')
<fieldset class="fieldset">

    <legend><h5 class="txt_azul">{!! isset($marca) ? '<i class="fi-pencil"></i> '."<b>$marca->mar_ant_nome</b>" : '<i class="fi-plus"></i> Marca de Antivírus'!!}</h5> </legend>

    @if( isset($marca))
        {!! Form::model($marca, ['route' => ['antivirus.update', $marca->mar_ant_codigo], 'method' => 'PUT', 'class' => 'form'] ) !!}
    @else
        {!! Form::open(['route' => 'antivirus.store', 'class' => 'form']) !!}
    @endif
    <div class="row">
        <div class="small-12 medium-12 columns">

            {!! Form::label('mar_ant_nome', 'Marca' )!!}
            {!! Form::text('mar_ant_nome', null, ['placeholder' => 'Marca do Antivírus']) !!}
            <span class="validacao">{{$errors->first('mar_ant_nome')}}</span>
        </div>

    </div>
    <div class="row">
        <div class="small-12 medium-12 columns" style="margin-top: 0.7rem">
            {{--{{ Form::button("!isset($prazo) ? Salvar : Actualizar", ['type'=>'submit', 'class' => 'success button']) }}--}}
            @if(!isset($marca))
                {!! Form::button('<i class="fi-check"></i> Salvar', ['type'=>'submit', 'class'=>'success button']) !!}
            @else
                {!! Form::button('<i class="fi-check"></i> Actualizar', ['type'=>'submit', 'class'=>'success button']) !!}
            @endif
            {!! Form::reset('Limpar', ['class' => 'warning button']) !!}
            <a href="{{route('antivirus.index')}}" class="alert button"><i class="fi-x"></i> Cancelar </a>
        </div>
    </div>
    {!! Form::close() !!}

</fieldset>
@endsection