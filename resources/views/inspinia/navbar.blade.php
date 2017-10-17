<div class="row border-bottom">
    <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">

            @guest
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to GK Girls Tiers.</span>
                </li>
                <li><a href="{{ route('register') }}">Register</a></li>
                <li>
                    <a href="{{ route('login') }}">
                        <i class="fa fa-sign-out"></i> Log in
                    </a>
                </li>
            @else
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to GK Girls Tiers <strong>{{ Auth::user()->name }}</strong></span>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endif
        </ul>
    </nav>
</div>