<nav class="top-bar azul">
    <div class="top-bar-title">
            <span data-responsive-toggle="responsive-menu" data-hide-for="medium">
              <button class="menu-icon dark" type="button" data-toggle></button>
            </span>
        <strong>Antivirus</strong>
    </div>
    <div id="responsive-menu">
        <div class="top-bar-right" style="background-color: #fff">
            @if(Auth::guest())
                <span class="transparent li-login" > Usuário não registado </span>
            @else
                <span class="transparent li-login" > {{ Auth::user()->name }} </span>
                <span class="transparent li-login" >
                    <a href="{{url('/logout')}}"
                       onclick="event.preventDefault();
                            document.getElementById('form-submit').submit();
                    ">
                        | Sair <i class="fi-power"></i>
                    </a>
                </span>
            @endif

            <form id="form-submit" action="{{url('/logout')}}" method="POST" >
                {{ csrf_field() }}
            </form>

        </div>
    </div>
</nav>