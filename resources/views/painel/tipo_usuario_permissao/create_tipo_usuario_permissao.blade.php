@extends('templates.appAdministrativo')

@section('title')
{{ isset($title) ? $title : 'Tipo de Usuário & Permissões' }}
@endsection
@section('content')

@if($errors->all())
        <div class="success callout" data-closable="slide-out-right">
            @foreach($errors->all() as $erro)
            {{$erro}}
            @endforeach
            <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

<div class="row">
    <div class="small-12 medium-7 columns">

        <fieldset class="fieldset container-white">

            <h5 class="txt_azul"><b><i class="fi-plus"></i> Tipo de Usuário & Permissões </b></h5><hr>

            {!! Form::open(['route' => 'tipo_usuario_permissao.store', 'class' => 'form', 'data-abide novalidate']) !!}

            <div class="row">
                <div class="small-12 medium-3 columns">
                    {!! Form::label('tpu_nome', 'Tipo de Usuário' )!!}
                </div>
                <div class="small-12 medium-9 columns">

                    {!! Form::select('tpu_codigo', ['' => 'Selecione o Tipo de Usuário'] + $tipo_usuario, null, ['id'=>'tpu_nome', 'required'] ) !!}
                    {{--Validacao--}}
                    @if($errors->first('tpu_nome') == null)
                    <span class="form-error" data-form-error-for="tpu_nome">{{'O tipo é obrigatório!'}}</span>
                    @else
                    <span class="validacao">{{$errors->first('tpu_nome')}}</span>
                    @endif
                    {{--Validacao--}}
                </div>
            </div>
        </fieldset>
    </div>

    <div class="small-12 medium-5 columns">
        <fieldset class="fieldset container-white"><h5 class="txt_azul"><b>Permissões</b></h5><hr>


            @foreach($permissoes as $permissao)

            <div class="checkbox primary">
                {!! Form::checkbox('check[]', $permissao->per_codigo) !!}
                {!! Form::label('check', $permissao->per_nome)!!}
            </div>

            @endforeach


        </fieldset>
    </div>
</div>

<div class="row">
    <div class="small-12 columns">

        <fieldset class="fieldset container-white">

            {!! Form::button('<i class="fi-check"></i> Salvar', ['type'=>'submit', 'class'=>'small success button btn-margem-bottom']) !!}

            {!! Form::reset('Limpar', ['class' => 'small warning button btn-margem-bottom']) !!}
            
            <a href="{{route('tipo_usuario.index')}}" class="small alert button btn-margem-bottom"><i class="fi-x"></i> Cancelar </a>
        </fieldset>
    </div>
</div>
{!! Form::close() !!}
@endsection