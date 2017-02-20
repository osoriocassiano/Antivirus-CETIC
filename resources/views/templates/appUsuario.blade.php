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

<table style="border:1px solid black">
    <thead id="mostrar" class="hover">
    <tr>
        <th class="txt_azul">Nome</th>
        <th><i class="fi-torso"></i> Email</th>
        <th><i class="fi-torso"></i> Email</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td>Eu</td>
            <td>Eu</td>
            <td>Eu</td>
        </tr>
        <tr>
            <td>Eu</td>
            <td>Eu</td>
            <td>Eu</td>
        </tr><tr>
            <td>Eu</td>
            <td>Eu</td>
            <td>Eu</td>
        </tr><tr>
            <td>Eu</td>
            <td>Eu</td>
            <td>Eu</td>
        </tr><tr>
            <td>Eu</td>
            <td>Eu</td>
            <td>Eu</td>
        </tr><tr>
            <td>Eu</td>
            <td>Eu</td>
            <td>Eu</td>
        </tr><tr>
            <td>Eu</td>
            <td>Eu</td>
            <td>Eu</td>
        </tr><tr>
            <td>Eu</td>
            <td>Eu</td>
            <td>Eu</td>
        </tr><tr>
            <td>Eu</td>
            <td>Eu</td>
            <td>Eu</td>
        </tr><tr>
            <td>Eu</td>
            <td>Eu</td>
            <td>Eu</td>
        </tr><tr>
            <td>Eu</td>
            <td>Eu</td>
            <td>Eu</td>
        </tr>
    </tbody>
</table>


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