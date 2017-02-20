<!Doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CETIC-Antivirus</title>




    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('assets/painel/css/foundation.css')}}">
    <link rel="stylesheet" href="{{asset('assets/painel/css/app.css')}}">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>

</head>
<body style="background-color: #e6e6e6;">
<header class="header_login">
    <img src="{{asset('/assets/painel/img/Logo_CE.png')}}"/>
</header>
<div class="row">
    <div style=" background-color: #ffffff;" class="medium-6 medium-centered large-4 large-centered columns">

        <h2 class="text-center" style="color: #2199E8"> Acesso ao Sistema </h2>
                {!! Form::open(['url'=>'/login', 'method'=>'POST']) !!}

        <div class="row column log-in-form">
                {{ csrf_field() }}
                {!! Form::label('username', 'Usuário') !!}
                {!! Form::text('username', null, ['name'=>'username', 'id'=>'username']) !!}
                <span class="validacao">{{$errors->first('username')}}</span>

                {!! Form::label('password', 'Senha') !!}
                {!! Form::password('password', ['name'=>'password', 'id'=>'password']) !!}
                <span class="validacao" style="display: inline">{{$errors->first('password')}}</span>
                <span>{{ $errors->has('password') ? ' Erro Existente' : '' }}</span>


        <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
                </label>
                 {{--Mostrar Senha
                 {!! Form::checkbox('Remember me', null, ['name'=>'remember']) !!}--}}

                {!! Form::button('Acesso', ['type'=>'submit', 'class'=>'primary button expanded']) !!}
            </div>
                {!! Form::close() !!}
    </div>

    </div>

<script src="public/js/vendor/jquery.js"></script>
<script src="public/js/vendor/what-input.js"></script>
<script src="public/js/vendor/foundation.js"></script>
<script charset="utf-8">
    $(document).foundation();
</script>
</body>
</html>



