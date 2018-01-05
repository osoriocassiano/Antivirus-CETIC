<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="{{ url('assets/painel/css/foundation.css') }}" rel="stylesheet">
    <link href="{{ url('assets/painel/css/app.css') }}" rel="stylesheet">
    <link href="{{ url('assets/painel/css/foundation-icons.css') }}" rel="stylesheet">
    <link href="{{ url('assets/painel/css/dataTables.foundation.min.css') }}" rel="stylesheet">

    <script src="{{url('assets/painel/js/vendor/jquery.js')}}"></script>
    <script src="{{url('assets/painel/js/vendor/what-input.js')}}"></script>
    <script src="{{url('assets/painel/js/vendor/foundation.js')}}"></script>
    <script src="{{url('assets/painel/js/app.js')}}"></script>
    <script src="{{url('assets/painel/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/painel/js/dataTables.foundation.min.js')}}"></script>

    <meta name="_token" content="{!! csrf_token() !!}"/>
    <script>

        $(document).ready(function () {
            var oTable = $('#mostrar').DataTable({
                "pagingType": "full_numbers",
                "dom": 'rtpl'
            });

            $('#pesq').keyup(function () {
                oTable.search($(this).val()).draw();
            });
        });
    </script>


</head>
<div class="row">
    <div class="small-12 medium-6 columns">
        <a href="{{route('licenca.create')}}" class="small button"><i class="fi-plus"></i> Novo Registo </a>
    </div>
    <div class="small-12 medium-6 columns">
        <div><input type="text" id="pesq" placeholder="Pesquisa..."></div>
    </div>
</div>
<table id="mostrar" class="hover tbl_mostrar">
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
    foreach ($dias as $d) {
        $vector_dia[] = $d->dr_nome;
    }
    ?>
    @foreach($licenca as $lice)
        <tr
        <?php
                $hoje = strtotime(date('y-m-d'));
                $d_registo = strtotime($lice->apc_data_registo);
                $dias_validade = $lice->apc_validade;
                $resultado = $dias_validade - ($hoje - $d_registo) / 86400;
                $i = 0;


                if ($resultado < 0) {
                    echo 'class="txt_vermelho"';
                } elseif ($resultado < $vector_dia[$i]) {
                    echo 'class="txt_verde"';
                } elseif ($resultado < $vector_dia[$i + 1]) {
                    echo 'class="txt_azul"';
                }

                ?>
                >
            <td>{{$lice->apc_serial_antiv}}</td>
            <td>{{$lice->uc_nome}}</td>
            <td>{{$lice->uc_serial}}</td>
            <td>{{$lice->apc_data_vencimento}}</td>
            <td class="top-bar-right">
                {!! Form::open(['route'=>['licenca.show', $lice->apc_codigo], 'method'=>'GET']) !!}
                {!! Form::hidden('acao', true)!!}

                <ul class="menu">
                    <li>
                        <span>{!! Form::button('<i class="fi-eye"></i>', ['type'=>'submit', 'class'=>'tiny secondary button']) !!}</span>
                    </li>
                    <li><span><a href="{{route('licenca.edit', $lice->apc_codigo) }}" class="tiny success button"><i
                                        class="fi-pencil"></i></a></span></li>
                    <li><span><a href="{{route('licenca.show', $lice->apc_codigo)}}" class="tiny alert button"><i
                                        class="fi-trash"></i> </a></span></li>
                </ul>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<script>
    $(document).foundation();
</script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
    });
</script>