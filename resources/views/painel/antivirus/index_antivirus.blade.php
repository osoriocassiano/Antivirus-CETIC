@extends('templates.appAdministrativo')

@section('title')
    Antivírus
@endsection
@section('content')
    <div class="row">
        <div class="small-12 columns">
            <ul class="menu">
                <li>
                    <a href="{{route('antivirus.index')}}" class="small button"> Marca </a>
                </li>
                <li>
                    <a href="{{route('prazo.index')}}" class="small button"> Dias de Consulta </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="espaco-vertical"></div>
    <div class="row">
        <div class="small-12 medium-6 columns">
            <a href="{{route('antivirus.create')}}" class="small button"><i class="fi-plus"></i> Marca </a>
        </div>
        <div class="small-12 medium-6 columns">
            <div><input type="text" id="pesq" placeholder="Pesquisa..."/></div>
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns">
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
                    <th>Marca</th>
                    <th class="top-bar-right">Opções</th>
                </tr>
                </thead>
                <tbody>
                @foreach($antivirus as $antiv)
                    <tr>
                        <td>{{$antiv->mar_ant_nome}}</td>
                        <td class="top-bar-right">
                            {!! Form::open(['route'=>['antivirus.show', $antiv->mar_ant_codigo], 'method'=>'GET']) !!}
                            {!! Form::hidden('acao', true) !!}
                            {!! Form::button('<i class="fi-eye"></i>', ['type'=>'submit', 'class'=>'tiny secondary button']) !!}
                            <a href="{{route('antivirus.edit', $antiv->mar_ant_codigo)}}" class="tiny success button"><i class="fi-pencil"></i> </a>
                            <a href="{{route('antivirus.show', $antiv->mar_ant_codigo)}}" class="tiny alert button"><i class="fi-trash"></i> </a>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection