@extends('templates.appAdministrativo')

@section('title')
    {{isset($title) ? $title : "Usuário"}}
@endsection

@section('content')

    <div class="row">
        <div class="small-12 medium-6 columns">
            <a href="{{route('cargo.create')}}" class="small button"><i class="fi-plus"></i> Cargo </a>
        </div>
        <div class="small-12 medium-6 columns">
            <div><input type="text" id="pesq" placeholder="Pesquisa..."></div>
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
            <table id="mostrar" class="hover tbl_mostrar">

                <thead>
                <tr>
                    <th>Cargo</th>
                    <th class="top-bar-right">Opções</th>
                </tr>
                </thead>


                <tbody>
                @foreach($cargo as $carg)
                    <tr>
                        <td> {{$carg->carg_nome}}
                        </td>
                        <td class="top-bar-right">

                            {!! Form::open(['route'=>['cargo.show', $carg->carg_codigo], 'method'=>'GET']) !!}
                            {!! Form::hidden('acao', true)!!}
                            <ul class="menu">
                                <li>
                                    <span>{!! Form::button('<i class="fi-eye"></i>', ['type'=>'submit', 'class'=>'tiny secondary button'/*, 'onclick'=>"return confirm('ARE YOU SURE?')"*/]) !!}</span>
                                </li>
                                <li><span><a href="{{route('cargo.edit', $carg->carg_codigo) }}"
                                             class="tiny success button"><i
                                                    class="fi-pencil"></i></a></span></li>
                                <li><span><a href="{{route('cargo.show', $carg->carg_codigo)}}"
                                             class="tiny alert button"><i
                                                    class="fi-trash"></i> </a></span></li>
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