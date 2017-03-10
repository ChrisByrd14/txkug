<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{ config('app.name', 'TXKUG') }}</title>
        <link rel="shortcut icon" href="/favicon.ico" />

        <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700&amp;subset=all' rel='stylesheet'>

        <link href="{{ asset('assets/plugins/socicon/socicon.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/bootstrap-social/bootstrap-social.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" />

        <link href="{{ asset('assets/plugins/animate/animate.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/sweetalert/dist/sweetalert.css') }}" rel="stylesheet" />

        @yield('header_scripts')

        <link href="{{ asset('assets/base/css/plugins.css') }}" rel="stylesheet"  />
        <link href="{{ asset('assets/base/css/components.css') }}" id="style_components" rel="stylesheet" />
        <link href="{{ asset('assets/base/css/themes/red3.css') }}" rel="stylesheet" id="style_theme" />
        <link href="{{ asset('assets/base/css/custom.css') }}" rel="stylesheet" />

        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>

    </head>

        <body class="c-layout-header-fixed c-layout-header-mobile-fixed">

        @include('layouts.header')

        <main>
            <div class="c-layout-page">
                <div id="app">
                    @yield('content')
                </div>
            </div>
        </main>

        @include('layouts.footer')

        <script src="{{ asset('assets/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/jquery-migrate.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/jquery.easing.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/reveal-animate/wow.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/base/js/scripts/reveal-animate/reveal-animate.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/plugins/smooth-scroll/jquery.smooth-scroll.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/sweetalert/dist/sweetalert.min.js') }}" type="text/javascript"></script>

        @include('sweet::alert')

        <script src="{{ asset('assets/base/js/components.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/base/js/app.js') }}" type="text/javascript"></script>
        <script>
            $(document).ready(function() {
                App.init(); // init core/**/
            });
        </script>

        <script src="{{ asset('js/app.js') }}"></script>

        @yield('footer_scripts')
    </body>
</html>
