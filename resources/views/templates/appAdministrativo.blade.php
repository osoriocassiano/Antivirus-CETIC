<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="{{ url('assets/painel/css/foundation.css') }}" rel="stylesheet">
    <link href="{{ url('assets/painel/css/app.css') }}" rel="stylesheet">
    <link href="{{ url('assets/painel/css/awesome-foundation6-checkbox.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/painel/css/foundation-icons.css') }}" rel="stylesheet">
    <link href="{{ url('assets/painel/css/dataTables.foundation.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/painel/css/select2-zurbfoundation5.css') }}" rel="stylesheet">

    <script src="{{url('assets/painel/js/vendor/jquery.js')}}"></script>
    <script src="{{url('assets/painel/js/vendor/what-input.js')}}"></script>
    <script src="{{url('assets/painel/js/vendor/foundation.js')}}"></script>
    <script src="{{url('assets/painel/js/app.js')}}"></script>
    <script src="{{url('assets/painel/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/painel/js/dataTables.foundation.min.js')}}"></script>
    <script src="{{url('assets/painel/js/select2.min.js')}}"></script>

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
    {{--@include('includes.nav')--}}


    <div class="espaco-vertical"></div>
    <div class="row">
        <div class="small-2 columns">

            <div class="row">
                <div class="small-12 columns">
                    <ul class="vertical dropdown menu blue" id="menu-syst-functionality" data-dropdown-menu>
                        <li> <a href="{{route('licenca.index')}}" class="text-center c-white"> <i class="fi-annotate xlarge-i"></i><br> Uso de Licença </a> </li>
                        <li class="is-dropdown-submenu-parent" style="color: #ffffff;"> <a href="{{route('usuario_pc.index')}}" class="text-center c-white"> <i    class="fi-torsos xlarge-i"></i><br>Usuários </a>

                            <ul class="vertical menu nested blue" id="submenu-syst-functionality">
                                <li><a href="{{route('usuario_pc.index')}}"><i class="fi-torso"></i>Usuário & </i>Serial de PC <i class="fi-monitor"></i></a></li>
                                <li><a href="{{route('usuario_sistema.index')}}"><i class="fi-torsos"></i>Usuário Sistema </a></li>
                                <li><a href="{{route('cargo.index')}}"><i class="fi-torso-business"></i>Cargo </a></li>
                                <li class="is-dropdown-submenu-parent"><a href="{{route('tipo_usuario.index')}}"><i class="fi-torso-business"></i>
                                    Tipo </a>
                                    <ul class="vertical menu nested blue" id="submenu-syst-functionality">
                                            <li><a href="{{route('tipo_usuario_permissao.create')}}">Tipo Usuário e Permissões</a></li>
                                    </ul>
                                </li>
                                    <li><a href="{{route('permissao.index')}}"><i class="fi-torso-business"></i>
                                        Permissões </a>
                                    </li> 
                                </ul>

                            </li>
                            <li> <a href="{{route('antivirus.index')}}" class="text-center c-white"> <i class="fi-shield xlarge-i"></i><br>Antivírus </a> </li>
                            <li> <a href="{{route('prazo.index')}}" class="text-center c-white"> <i class="fi-shield xlarge-i"></i><br>Consultas </a> </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="small-10 columns">
                        @yield('content')
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
        <div class="espaco-vertical"></div>
        @include('includes.footer')
    </body>
    </html>
