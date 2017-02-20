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

        $(document).ready(function() {
            var oTable = $('#mostrar').DataTable( {
                "pagingType": "full_numbers",
                "dom": 'rtpl'
            } );

            $('#pesq').keyup(function(){
                oTable.search($(this).val()).draw();
            });
        } );
    </script>
    <script>
        $(function(){
            $('#prazo').change(function() {
                var valor = $(".pega_valor:selected").text();
                $.ajax({
                    url: 'listar_por_prazo',
                    type: 'POST',
                    data: { id: valor },
                    success: function(response)
                    {
                        $("#display").fadeOut().html(response).fadeIn();
                        //alert("sucesso");
                    }
                });
            });
        });
    </script>

</head>
<body>
@include('includes.header')
@include('includes.nav')


    <div class="espaco-vertical"></div>
    <div class="row">
        <div class="small-2 columns">
            <div class="row">
                <div class="small-12 columns ">
                    <ul class="menu vertical">
                        <li><h2><a href="{{route('licenca.index')}}"><button class="button expanded"><i class="fi-annotate"></i> Uso de Licença </button> </a> </h2></li>
                        <li><h2><a href="{{route('usuario_pc.index')}}"><button class="button expanded"><i class="fi-torsos"></i> Usuários </button> </a> </h2></li>
                        <li><h2><a href="{{route('antivirus.index')}}"><button class="button expanded"><i class="fi-shield"></i> Antivírus </button> </a> </h2></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="small-10 columns">
            <div class="row">
                <div class="small-12 columns">
                    @yield('content')
                </div>
            </div>
        </div>

    </div>




<script>
    $(document).foundation();
</script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
</script>
@include('includes.footer')
</body>
</html>