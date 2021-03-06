<nav class="navbar navbar-default header navbar-fixed-top">
    <div class="col-md-12 nav-wrapper">
        <div class="navbar-header" style="width:100%;">
            <div class="opener-left-menu is-open">
                <span class="top"></span>
                <span class="middle"></span>
                <span class="bottom"></span>
            </div>
            <a href="index.html" class="navbar-brand">
                <b>Fundacion Antioquía</b>
            </a>


            <ul class="nav navbar-nav navbar-right user-nav">
                <li class="user-name"><span>{{Auth::user()->nombre." ".Auth::user()->apellido}}</span></li>
                <li class="dropdown avatar-dropdown">
                    <img src="/img/{{Auth::user()->avatar}}" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                    <ul class="dropdown-menu user-dropdown">
                        <li><a href="{{route("perfil")}}"><span class="fa fa-user"></span> Mi perfil</a></li>
                        {{--<li><a href="#"><span class="fa fa-calendar"></span> My Calendar</a></li>--}}
                        <li role="separator" class="divider"></li>
                        <li class="more text-center">
                            <a href="{{route("logout")}}"><span class="fa fa-sign-out fa-2x "></span></a>
                            {{--<ul style="width: 100%;height: 40px;">--}}
                                {{--<li><a href=""><span class="fa fa-cogs"></span></a></li>--}}
                                {{--<li><a href=""><span class="fa fa-lock"></span></a></li>--}}
                                {{--<li><a href=""><span class="fa fa-power-off "></span></a></li>--}}
                            {{--</ul>--}}
                        </li>
                    </ul>
                </li>
                {{--<li ><a href="#" class="opener-right-menu"><span class="fa fa-coffee"></span></a></li>--}}
            </ul>
        </div>
    </div>
</nav>