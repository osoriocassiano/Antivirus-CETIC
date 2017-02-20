@extends('templates.appAdministrativo')

@section('title')
    {{isset($title) ? $title : 'Usuário do Sistema'}}
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
            <a href="{{route('usuario_sistema.create')}}" class="small button"><i class="fi-plus"></i> Usuário Sistema </a>
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
                    <th>Nome</th>
                    <th>Apelido</th>
                    <th>Email</th>
                    <th>Tipo de Usuário</th>
                    <th>Cargo</th>
                    <th>Opções</th>
                </tr>
                </thead>
                <tbody>
                @foreach($usuarios_sistema as $usu)
                    <tr>
                        <td>{{$usu->name}}</td>
                        <td>{{$usu->us_apelido}}</td>
                        <td>{{$usu->email}}</td>
                        <td>{{$usu->tpu_nome}}</td>
                        <td>{{$usu->carg_nome}}</td>
                        <td>
                            {!! Form::open(['route'=>['usuario_sistema.show', $usu->us_codigo], 'method'=>'GET']) !!}

                            {!! Form::hidden('acao', true)!!}
                            {!! Form::button('<i class="fi-eye"></i>', ['type'=>'submit', 'class'=>'tiny secondary button']) !!}
                            <a href="{{route('usuario_sistema.edit', $usu->us_codigo) }}" class="tiny success button"><i class="fi-pencil"></i></a>
                            <a href="{{route('usuario_sistema.show', [$usu->us_codigo])}}" class="tiny alert button"><i class="fi-trash"></i> </a>

                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection