@extends('templates.appAdministrativo')

@section('title')
    {{ isset($title) ? $title : 'Licença' }}
@endsection

@section('content')

    <fieldset class="fieldset">

        <legend><h5 class="txt_azul"> {!! isset($licenca) ? '<i class="fi-pencil"></i> '."<b>$licenca->apc_serial_antiv </b>" : '<i class="fi-plus"></i> Licença do Antivírus'!!} </h5> </legend>

        @if( isset($licenca))
            {!! Form::model($licenca, ['route' => ['licenca.update', $licenca->apc_codigo], 'method' => 'PUT', 'class' => 'form'] ) !!}
        @else
            {!! Form::open(['route' => 'licenca.store', 'class' => 'form']) !!}
            {!! Form::hidden('apc_responsavel_registo', Auth::user()->us_codigo) !!}
        @endif
        <div class="row">
            <div class="small-12 medium-6 columns">
                {!! Form::label('apc_serial_antiv', 'Serial Antivírus' )!!}
                {!! Form::text('apc_serial_antiv', null, ['placeholder' => 'Serial do Antivírus']) !!}
                <span class="validacao">{{$errors->first('apc_serial_antiv')}}</span>
            </div>
            <div class="small-12 medium-3 columns">
                {!! Form::label('apc_marca_antiv', 'Marca Antivírus' )!!}
                {!! Form::select('apc_marca_antiv', ['' => 'Selecione a marca'] + $marca, null ) !!}
                <span class="validacao">{{$errors->first('apc_marca_antiv')}}</span>
            </div>
            <div class="small-12 medium-3 columns">
                {!! Form::label('apc_validade', 'Dias' )!!}
                {!! Form::text('apc_validade', null, ['placeholder' => 'Validade']) !!}
                <span class="validacao">{{$errors->first('apc_validade')}}</span>
            </div>
        </div>
        <div class="row">
            <div class="small-12 medium-6 columns">
                {!! Form::label('apc_serial_pc', 'Serial PC' )!!}
                {!! Form::select('apc_serial_pc', ['' => 'Selecione o serial do PC'] + $serial_pc, null, ['id'=>'select_pc', 'class'=>'select_pc'] ) !!}
                <span class="validacao">{{$errors->first('apc_serial_pc')}}</span>
                <script type="text/javascript">
				  $(".select_pc").select2();
				</script>
            </div>
                <div class="small-12 medium-6 columns">
                {!! Form::label('apc_data_registo', 'Data Registo' )!!}
                {!! Form::text('apc_data_registo', null, ['placeholder' => 'Data do Registo: Ano-Mês-Dia']) !!}
                <span class="validacao">{{$errors->first('apc_data_registo')}}</span>
            </div>
        </div>
        <div class="row">
            <div class="small-12 medium-12 columns" style="margin-top: 0.7rem">
                {{--{{ Form::button("!isset($prazo) ? Salvar : Actualizar", ['type'=>'submit', 'class' => 'success button']) }}--}}
                @if(!isset($licenca))
                    {!! Form::button('<i class="fi-check"></i> Salvar', ['type'=>'submit', 'class'=>'success button']) !!}
                @else
                    {!! Form::button('<i class="fi-check"></i> Actualizar', ['type'=>'submit', 'class'=>'success button']) !!}
                @endif
                {!! Form::reset('Limpar', ['class' => 'warning button']) !!}
                <a href="{{route('licenca.index')}}" class="alert button"><i class="fi-x"></i> Cancelar </a>
            </div>
        </div>
        {!! Form::close() !!}

    </fieldset>
@endsection
