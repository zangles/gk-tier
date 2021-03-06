<?php
header('X-Frame-Options: ALLOW-FROM http://gkgirlstiers.tk/');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta property="og:image" content="{{ asset('/img/logo.png') }}" />
    <meta property="og:title" content="GK Girls - Tiers - {{ $title }}" />
    <meta property="og:description" content="GK Girls - Tiers - {{ $title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://67.205.181.93" />

    <title>GK Girls - Tiers - {{ $title }}</title>

    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/plugins/bootstrapSocial/bootstrap-social.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/plugins/summernote/summernote.css') }}" rel="stylesheet">

    @yield('styles')

</head>

<body>

<div id="wrapper">

    @include('inspinia.menu')

    <div id="page-wrapper" class="gray-bg">
        @include('inspinia.navbar')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>{{ $title }}</h2>
            </div>
            <div class="col-sm-8">
                <div class="title-action">
                    <?php
                        use Chencha\Share\ShareFacade;
                        $links = Share::load(url()->current(), $title )->services('facebook', 'twitter');
                    ?>
                    @foreach($links as $social => $link)
                        <a href="{{ $link }}" target="_blank" class="btn btn-social-icon btn-{{ $social }}"><span class="fa fa-{{ $social }}"></span></a>
                    @endforeach

                    <button type="button" class="btn btn-warning btn-copy" title="Copy to Clipboad">
                        <i class="fa fa-clipboard" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="wrapper wrapper-content">
            @yield('content')
        </div>
        @include('inspinia.footer')

    </div>
    <input type="hidden" id="input-url" value="Copied!">
</div>

<!-- Mainly scripts -->
<script src="{{ asset('/js/jquery-2.1.1.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('/js/plugins/summernote/summernote.min.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('/js/inspinia.js') }}"></script>
<script src="{{ asset('/js/plugins/pace/pace.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>

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

@if (App::environment('production'))
    <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-106151130-1', 'auto');
            ga('send', 'pageview');
    </script>
@endif

@yield('scripts')

</body>

</html>
