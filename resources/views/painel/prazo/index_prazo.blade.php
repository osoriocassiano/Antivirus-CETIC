@extends('templates.appAdministrativo')

@section('title')
    {{ isset($title) ? $title : 'Prazos' }}
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
            <a href="{{route('prazo.create')}}" class="small button"><i class="fi-plus"></i> Novo dia de consulta </a>
        </div>
        <div class="small-12 medium-6 columns">
            {!! Form::text('pesq', null, ['id'=>'pesq', 'placeholder'=>'Pesquisa...']) !!}
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
            <table id="mostrar" class="hover table table-bordered">

                <thead>
                <tr>
                    <th>Dias</th>
                    <th class="top-bar-right">Opções</th>
                </tr>
                </thead>



                <tbody>
                    @foreach($prazos as $prazo)
                        <tr>
                            <td > {{$prazo->dr_nome}}
                                </td>
                            <td class="top-bar-right">

                                {!! Form::open(['route'=>['prazo.show', $prazo->dr_codigo], 'method'=>'GET']) !!}

                                {!! Form::hidden('acao', true)!!}
                                {!! Form::button('<i class="fi-eye"></i>', ['type'=>'submit', 'class'=>'tiny secondary button'/*, 'onclick'=>"return confirm('ARE YOU SURE?')"*/]) !!}
                                <a href="{{route('prazo.edit', $prazo->dr_codigo) }}" class="tiny success button"><i class="fi-pencil"></i></a>
                                <a href="{{route('prazo.show', [$prazo->dr_codigo])}}" class="tiny alert button"><i class="fi-trash"></i> </a>

                                {!! Form::close() !!}

                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
@endsection