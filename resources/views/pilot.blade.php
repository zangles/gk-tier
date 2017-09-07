<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GK Girls - Tiers - {{ $pilot->name }}</title>

    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/plugins/fooTable/footable.bootstrap.css') }}" rel="stylesheet">
</head>

<body>

<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element text-center">
                        <span>
                            <img alt="image" class="img-rounded" src="{{ asset('/img/logo.png') }}"  style="max-height: 90px"/>
                         </span>
                    </div>
                    <div class="logo-element">
                        GK
                    </div>
                </li>
                <li class="active">
                    <a href="/"><i class="fa fa-users"></i> <span>Pilots</span></a>
                </li>
                <li>
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

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Welcome to GK Girls Tiers.</span>
                    </li>
                    <li>
                        <a href="login.html">
                            <i class="fa fa-sign-out"></i> Log in
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>{{ $title }}</h2>
            </div>
            <div class="col-sm-8">
                <div class="title-action">
                    <button type="button" class="btn btn-primary btn-copy">Copy Link</button>
                </div>
            </div>
        </div>

        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Pilot info</h5>
                        </div>
                        <div class="ibox-content">
                            <input type="hidden" id="input-url" value="Copied!">
                            @include('partials.pilotTier')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="pull-right">

            </div>
            <div>
                <strong>Copyright</strong> Zangles &copy; 2017
            </div>
        </div>

    </div>
</div>

<!-- Mainly scripts -->
<script src="{{ asset('/js/jquery-2.1.1.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('/js/plugins/fooTable/footable.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>


<!-- Custom and plugin javascript -->
<script src="{{ asset('/js/inspinia.js') }}"></script>
<script src="{{ asset('/js/plugins/pace/pace.min.js') }}"></script>

<script>
    var clipboard = new Clipboard('.btn-copy', {
        text: function() {
            return document.querySelector('input[type=hidden]').value;
        }
    });
    clipboard.on('success', function(e) {
        alert("Copied!");
        e.clearSelection();
    });
    $("#input-url").val(location.href);
    //safari
    if (navigator.vendor.indexOf("Apple")==0 && /\sSafari\//.test(navigator.userAgent)) {
        $('.btn-copy').on('click', function() {
            var msg = window.prompt("Copy this link", location.href);

        });
    }


</script>

@yield('scripts')

</body>

</html>
