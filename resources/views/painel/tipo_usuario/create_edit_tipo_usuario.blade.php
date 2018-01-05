@extends('templates.appAdministrativo')

@section('title')
{{ isset($title) ? $title : 'Tipo de Usuário' }}
@endsection
@section('content')



@if( isset($tipo_usuario))
{!! Form::model($tipo_usuario, ['route' => ['tipo_usuario.update', $tipo_usuario->tpu_codigo], 'method' => 'PUT', 'class' => 'form', 'role'=>'form', 'data-abide novalidate'] ) !!}
@else
{!! Form::open(['route' => 'tipo_usuario.store', 'class' => 'form', 'data-abide novalidate']) !!}
@endif

<div class="row">
    <div class="small-12 medium-9 columns">
        <fieldset class="fieldset container-white">
            <h5 class="txt_azul"><b>{!! isset($tipo_usuario) ? '<i class="fi-pencil"></i> '."$tipo_usuario->tpu_nome" : '<i class="fi-plus"></i> Tipo de Usuário'!!}</b></h5><hr>

            <div class="row">
             <div class="small-12 medium-2 columns">
                 {!! Form::label('tpu_nome', 'Nome' )!!}
             </div>
             <div class="small-12 medium-10 columns">
                {!! Form::text('tpu_nome', null, ['placeholder' => 'Nome do tipo de Usuário', 'id'=>'tpu_nome', 'required']) !!}
                {{--Validacao--}}
                @if($errors->first('tpu_nome') == null)
                <span class="form-error" data-form-error-for="tpu_nome">{{'O nome é obrigatório!'}}</span>
                @else
                <span class="validacao">{{$errors->first('tpu_nome')}}</span>
                @endif
                {{--Validacao--}}
            </div>
        </div>

        <div class="row">
            <div class="small-12 medium-2 columns">
                {!! Form::label('tpu_sigla', 'Sigla' )!!}
            </div>
            <div class="small-12 medium-10 columns">


                {!! Form::text('tpu_sigla', null, ['placeholder' => 'Nome da sigla', 'id'=>'tpu_sigla', 'required pattern'=>'alpha']) !!}
                {{--Validacao--}}
                @if($errors->first('tpu_sigla') == null)
                <span class="form-error" data-form-error-for="tpu_sigla">{{'Introduza uma sigla válido. (Valores alfabéticos)!.'}}</span>
                @else
                <span class="validacao">{{$errors->first('tpu_sigla')}}</span>
                @endif
                {{--Validacao--}}
            </div>

        </div>



        <div class="row">
            <div class="small-12 medium-2 columns">
                {!! Form::label('tpu_descricao', 'Descrição' )!!}
            </div>
            <div class="small-12 medium-10 columns">


                {!! Form::textarea('tpu_descricao', null, ['placeholder' => 'Descrição', 'rows'=>'5']) !!}
                {{--Validacao--}}
                @if($errors->first('tpu_descricao') == null)
                <span class="form-error" data-form-error-for="tpu_descricao">{{'Introduza uma sigla válido. (Valores Alfanuméricos)!.'}}</span>
                @else
                <span class="validacao">{{$errors->first('tpu_descricao')}}</span>
                @endif
                {{--Validacao--}}

            </div>
        </div>

    </fieldset>
</div>

<div class="small-12 medium-3 columns ">
    @if(isset($tipo_usuario))
    <div class="row">
        <div class="small-12 columns">

            <fieldset class="fieldset container-white">
                <h5><b class="txt_azul">Permissões</b></h5><hr>

                @foreach($permissoes as $permissao)

                <div class="checkbox primary">
                    {!! Form::checkbox('check[]', $permissao->per_codigo, $tipo_usuario->permissoes->contains($permissao->per_codigo), ['class'=>'styled']) !!}
                    {!! Form::label('check', $permissao->per_nome)!!}
                </div>

                @endforeach


            </fieldset>

        </div>
    </div>
    @endif
</div>
</div>


<div class="row">
    <div class="small-12 medium-12 columns">
        <fieldset class="fieldset container-white">
            @if(!isset($tipo_usuario))
            {!! Form::button('<i class="fi-check"></i> Salvar', ['type'=>'submit', 'class'=>'small success button btn-margem-bottom']) !!}
            @else

            <!-- Para ser capturado no FormRequest -->
            {!! Form::hidden('tipo_usuario_codigo', $tipo_usuario->tpu_codigo)!!}

            {!! Form::button('<i class="fi-check"></i> Actualizar', ['type'=>'submit', 'class'=>'small success button btn-margem-bottom']) !!}
            @endif
            {!! Form::reset('Limpar', ['class' => 'small warning button btn-margem-bottom']) !!}
            <a href="{{route('tipo_usuario.index')}}" class="small alert button btn-margem-bottom"><i class="fi-x"></i> Cancelar </a>
        </fieldset>
    </div>
</div>

{!! Form::close() !!}



@endsection