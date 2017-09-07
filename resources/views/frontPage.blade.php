<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ env('APP_NAME') }}</title>

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
                {{--<li>--}}
                    {{--<a href="#"><i class="fa fa-line-chart"></i> <span class="nav-label">The best in...</span><span class="fa arrow"></span></a>--}}
                    {{--<ul class="nav nav-second-level">--}}
                        {{--<li><a href="graph_flot.html">Demon</a></li>--}}
                        {{--<li><a href="graph_morris.html">Dragon</a></li>--}}
                        {{--<li><a href="graph_rickshaw.html">Kraken</a></li>--}}
                        {{--<li><a href="graph_chartjs.html">Deathmatch</a></li>--}}
                        {{--<li><a href="graph_peity.html">Shootout</a></li>--}}
                        {{--<li><a href="graph_sparkline.html">Arena</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
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
                <h2>Pilots</h2>
            </div>
            <div class="col-sm-8">
                {{--<div class="title-action">--}}
                    {{--<a href="" class="btn btn-primary">This is action area</a>--}}
                {{--</div>--}}
            </div>
        </div>

        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Pilots</h5>
                        </div>
                        <div class="ibox-content">
                            <table class="table" data-filtering="true" data-sorting="true">
                                <thead>
                                <tr>
                                    <th data-sortable="false">Pilot</th>
                                    <th data-sortable="false">Type</th>
                                    @foreach($raids as $raid)
                                        <th class="td_tier td_{{ $raid->id }}" id="th_{{ $raid->name }} ">{{ $raid->name }}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody style="overflow-y: auto">
                                @foreach($pilots as $pilot)
                                    <tr class="tr_type tr_{{ $pilot->type }}">
                                        <td>
                                            <div style="height: 128px; width: 128px">
                                                <img src="http://gkgirls.info.gf/img/pilots/{{ $pilot->id }}.png" alt="" style="position: absolute">
                                                <img src="http://gkgirls.info.gf/img/frame.png" class="pilot-headshot"  style="position: absolute">
                                            </div>
                                            <p><strong>{{ $pilot->name }}</strong></p>
                                        </td>
                                        <td>
                                            {{ $pilot->type }}
                                        </td>
                                        @foreach($pilot->raid as $tier)
                                            <td class="td_tier td_{{ $tier->id }}">
                                                @include('partials.tierBadge', ['tier' => $tier->pivot->tier ])
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2015
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

<!-- Custom and plugin javascript -->
<script src="{{ asset('/js/inspinia.js') }}"></script>
<script src="{{ asset('/js/plugins/pace/pace.min.js') }}"></script>

<script>
    jQuery(function($){
        $('.table').footable();
    });
</script>


</body>

</html>
