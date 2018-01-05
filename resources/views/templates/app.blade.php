<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="{{ url('assets/painel/css/foundation.css') }}" rel="stylesheet">
    <link href="{{ url('assets/painel/css/app.css') }}" rel="stylesheet">
    <link href="{{ url('assets/painel/css/foundation-icons.css') }}" rel="stylesheet">
    <link href="{{ url('assets/painel/css/dataTables.foundation.min.css') }}" rel="stylesheet">

    <script>
        $(document).ready(function() {
            $('#mostrar').DataTable( {
                "pagingType": "full_numbers",
                "dom": 'rtpl'
            } );
        } );
    </script>

</head>
<body>
@include('includes.header')
@include('includes.nav')

<div class="espaco-vertical"></div>

<div class="row">

    {{--Lateral Esquerda--}}
    <div class="small-2 columns">
        <div class="row">
            <div class="small-12 columns ">
                <ul class="menu vertical">
                    <li><h2><a href="{{route('licenca.index')}}"><button class="button expanded"><i class="fi-annotate"></i> Uso de Licença </button> </a> </h2></li>
                    <li><h2><a href="{{route('usuario_pc.index')}}"><button class="button expanded"><i class="fi-torsos"></i> Usuários </button> </a> </h2></li>
                    <li><h2><a href="{{route('antivirus.index')}}"><button class="button expanded"><i class="fi-shield"></i> Antivírus </button> </a> </h2></li>
                    <li><h2><a href="{{route('prazo.index')}}"><button class="button expanded"><i class="fi-shield"></i> Consultas </button> </a> </h2></li>
                </ul>
            </div>
        </div>
    </div>

    {{--Centro--}}
    <div class="small-8 columns">
        <div class="row">
            <div class="small-12 columns">
                Central
                @yield('content')
            </div>
        </div>
    </div>

    {{--Lateral direita--}}
    <div class="small-2 columns">
        <div class="fieldset">
            <div class="btn-group-vertical">
                <button class="small button expanded">Ultimos Usuario</button>
                <button class="small button expanded">Antivirus mais usado</button>
            </div>
        </div>
    </div>

</div>


<div class="container">
    @yield('content')
</div>
@include('includes.footer')

<script src="{{url('assets/painel/js/vendor/jquery.js')}}"></script>
<script src="{{url('assets/painel/js/vendor/what-input.js')}}"></script>
<script src="{{url('assets/painel/js/vendor/foundation.js')}}"></script>
<script src="{{url('assets/js/app.js')}}"></script>
<script src="{{url('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/js/dataTables.foundation.min.js')}}"></script>
<script>
    $(document).foundation();
</script>
</body>
</html>