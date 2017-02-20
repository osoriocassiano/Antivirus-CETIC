@extends('templates.appAdministrativo')

@section('title')
    {{ isset($title) ? $title : 'Tipo de Usuário' }}
@endsection

@section('content')

    <div class="row">
        <div class="small-12 columns">
            <ul class="menu">
                <li><a href="{{route('usuario_pc.index')}}" class="small button"><i class="fi-torso"></i>  Usuário & <i class="fi-monitor"></i> Serial de PC</a></li>
                <li><a href="{!! route('usuario_sistema.index') !!}" class="small button"><i class="fi-torsos"></i> Usuário Sistema </a></li>
                <li><a href="{{route('cargo.index')}}" class="small button"><i class="fi-torso-business"></i> Cargo </a></li>
                <li><a href="{{route('tipo_usuario.index')}}" class="small button"><i class="fi-torso-business"></i> Tipo </a></li>
            </ul>
        </div>
    </div>
    <div class="espaco-vertical"></div>
    <div class="row">
        <div class="small-12 medium-6 columns">
            <a href="{{route('tipo_usuario.create')}}" class="small button"><i class="fi-plus"></i> Tipo de Usuário </a>
        </div>
        <div class="small-12 medium-6 columns">
            <div><input type="text" id="pesq" placeholder="Pesquisa..."></div>
        </div>
    </div>
    <div class="row">
        <div class="small-12 medium-12 columns">
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
            <table id="mostrar" class="hover">
                <thead>
                <tr>
                    <th>Tipo</th>
                    <th class="top-bar-right">Opções</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tipo_usuario as $tipo)
                    <tr>
                        <td>{{$tipo->tpu_nome}}</td>
                        <td class="top-bar-right">
                            {!! Form::open(['route'=>['tipo_usuario.show', $tipo->tpu_codigo], 'method'=>'GET']) !!}

                            {!! Form::hidden('acao', true)!!}
                            {!! Form::button('<i class="fi-eye"></i>', ['type'=>'submit', 'class'=>'tiny secondary button']) !!}
                            <a href="{{route('tipo_usuario.edit', $tipo->tpu_codigo) }}" class="tiny success button"><i class="fi-pencil"></i></a>
                            <a href="{{route('tipo_usuario.show', $tipo->tpu_codigo)}}" class="tiny alert button"><i class="fi-trash"></i> </a>

                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection