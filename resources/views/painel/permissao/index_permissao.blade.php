@extends('templates.appAdministrativo')
@section('title')
    {{isset($title) ? $title : 'Permissao'}}
@endsection

@section('content')
    <div class="row">
        <div class="small-12 medium-6 columns">
            <a href="{{route('permissao.create')}}" class="small button"><i class="fi-plus"></i> Permissão </a>
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
            <table id="mostrar" class="hover tbl_mostrar">
                <thead>
                <tr>
                    <th>Permissão</th>
                    <th>Descrição</th>
                    <th class="top-bar-right">Opções</th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissoes as $permissao)
                    <tr>
                        <td>{{$permissao->per_nome}}</td>
                        <td>{{$permissao->per_descricao}}</td>
                        <td class="top-bar-right">
                            {!! Form::open(['route'=>['permissao.show', $permissao->per_codigo], 'method'=>'GET']) !!}

                            {!! Form::hidden('acao', true)!!}
                            <ul class="menu">
                                <li>
                                    <span>{!! Form::button('<i class="fi-eye"></i>', ['type'=>'submit', 'class'=>'tiny secondary button']) !!}</span>
                                </li>
                                <li><span><a href="{{route('permissao.edit', $permissao->per_codigo) }}"
                                             class="tiny success button"><i class="fi-pencil"></i></a></span></li>
                                <li><span><a href="{{route('permissao.show', $permissao->per_codigo)}}"
                                             class="tiny alert button"><i class="fi-trash"></i> </a></span></li>
                            </ul>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection