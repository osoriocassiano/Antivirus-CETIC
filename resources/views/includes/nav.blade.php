<nav class="top-bar" id="main-nav">
    <div class="top-bar-title">
            <span data-responsive-toggle="responsive-menu" data-hide-for="medium">
              <button class="menu-icon dark" type="button" data-toggle></button>
            </span>
        {{--<strong>Gestão de Antivírus</strong>--}}
    </div>

    <div id="responsive-menu" style="bottom: 0em">
        <ul class="menu top-bar-right" data-dropdown-menu style="background-color: #2199e8">
            @if(Auth::guest())
                <li> Usuário não registado </li>
            @else
                <li> 
                    <a href="#" class="tiny secondary button" id="user-name"> {{ Auth::user()->name }} | Sair <i class="fi-arrow-right"></i> </a>
                </li>
                    
                 <li>
                    <span>
                    <a href="{{url('/logout')}}" 
                        onclick="event.preventDefault();
                            document.getElementById('form-submit').submit();"
                                class="tiny secondary button" id="logout"
                    >
                       <i class="fi-power"></i> 
                    </a>
                    </span>
                </li> 
            @endif

            <form id="form-submit" action="{{url('/logout')}}" method="POST" >
                {{ csrf_field() }}
            </form>

        </ul>
    </div>
</nav>