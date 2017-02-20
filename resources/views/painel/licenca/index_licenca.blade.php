@extends('templates.appAdministrativo')

@section('title')
    Licenças
@endsection
@section('content')
    <div class="row">
        <div class="small-12 medium-6 columns ">
                <ul class="menu">
                    <li><a href="{{url('dentro_prazo')}}" class="small button"><i class="fi-list"></i> Listar Dentro do prazo</a></li>
                    <li><a href="{{url('listar_todos')}}" class="small button"><i class="fi-list"></i> Listar Todos</a></li>
                </ul>
        </div>
        <div class="small-12 medium-6 columns">
            {{--<script>
                var select = document.getElementById('prazo');
                select.onchange = function(){
                    this.form.action = 'painel/auxiliar/listar_por_prazo' + this.value;
                    this.form.submit();
                };
                $('#prazo').on('change', function(e){
                    var select = $(this), form = select.closest('form');
                    form.attr('action', 'painel/auxiliar/listar_por_prazo' + select.val());
                    form.submit();
                });
            </script>--}}
            {{--{{ Form::model(null, ['url'=>'foot/bar', 'method'=>'post']) }}
            {{ Form::select('prazo', ['' => 'Selecione a validade'] + $prazo, null) }}
            {{Form::close()}}--}}
{{--
            {{Form::select('prazo', ['' => 'Selecione a validade'] + $prazo, null)}}
--}}


            <select id="prazo" name="dias">
                <option value="">Selecione o prazo</option>
                @foreach($prazo as $pra)
                    <option class="pega_valor" value="{{$pra->dr_codigo}}">{{$pra->dr_nome}}</option>
                @endforeach
            </select>

        </div>
    </div>
    <div class="row">
        <div class="small-12 columns" id="display">
            <div class="row">
                <div class="small-12 medium-6 columns">
                    <a href="{{route('licenca.create')}}" class="small button"><i class="fi-plus"></i> Novo Registo </a>
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
                            <th>Serial do Antivírus</th>
                            <th>Usuário</th>
                            <th>Serial PC</th>
                            <th>Data Vencimento</th>
                            <th class="top-bar-right">Opções</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach($dias as $d){
                                $vector_dia[] = $d->dr_nome;
                            }
                        ?>
                        @foreach($licenca as $lice)


                            <tr
                                <?php
                                        $hoje = strtotime(date('y-m-d'));
                                        $d_registo = strtotime($lice->apc_data_registo);
                                        $dias_validade = $lice->apc_validade;
                                        $resultado = $dias_validade-($hoje-$d_registo)/86400;
                                        $i = 0;


                                            if($resultado<0){
                                                echo 'class="txt_vermelho"';
                                            }
                                            elseif($resultado<$vector_dia[$i]){
                                                echo 'class="txt_verde"';
                                            }
                                            elseif($resultado<$vector_dia[$i+1]){
                                                echo 'class="txt_azul"';
                                            }

                                ?>
                            >


                                <td>{{$lice->apc_serial_antiv}}</td>
                                <td>{{$lice->uc_nome}}</td>
                                <td>{{$lice->apc_serial_pc}}</td>
                                <td>{{$lice->apc_data_vencimento}}</td>
                                <td class="top-bar-right">
                                    {!! Form::open(['route'=>['licenca.show', $lice->apc_codigo], 'method'=>'GET']) !!}

                                    {!! Form::hidden('acao', true)!!}
                                    {!! Form::button('<i class="fi-eye"></i>', ['type'=>'submit', 'class'=>'tiny secondary button']) !!}
                                    <a href="{{route('licenca.edit', $lice->apc_codigo) }}" class="tiny success button"><i class="fi-pencil"></i></a>
                                    <a href="{{route('licenca.show', $lice->apc_codigo)}}" class="tiny alert button"><i class="fi-trash"></i> </a>

                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
    </div>
@endsection