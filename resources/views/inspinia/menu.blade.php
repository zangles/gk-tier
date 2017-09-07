<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element text-center">
                        <span>
                            <a href="/">
                                <img alt="image" class="img-rounded" src="{{ asset('/img/logo.png') }}"  style="max-height: 90px"/>
                            </a>
                         </span>
                </div>
                <div class="logo-element">
                    GK
                </div>
            </li>
            <li class="{{ Request::is('/') ? 'active' : '' }}">
                <a href="/"><i class="fa fa-users"></i> <span>Pilots</span></a>
            </li>
            <li class="{{ Request::is('best/*') ? 'active' : '' }}">
                <a href="#"><i class="fa fa-line-chart"></i> <span class="nav-label">The best in...</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    @foreach($raids as $raid)
                        <li><a href="{{ route('best',$raid->id) }}">{{ $raid->name }}</a></li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
</nav>