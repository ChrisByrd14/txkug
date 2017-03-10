@extends('layouts.app')

@section('header_scripts')
    <link href="{{ asset('assets/plugins/revo-slider/css/settings.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/revo-slider/css/layers.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/revo-slider/css/navigation.css') }}" rel="stylesheet" />
@stop

@section('content')

    @include('sections.intro-slider')
    @include('sections.modals.slack-invite')
    @include('sections.about-us')

@stop

@section('footer_scripts')
    <script src="{{ asset('assets/plugins/revo-slider/js/jquery.themepunch.tools.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/revo-slider/js/jquery.themepunch.revolution.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/revo-slider/js/extensions/revolution.extension.slideanims.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/revo-slider/js/extensions/revolution.extension.layeranimation.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/revo-slider/js/extensions/revolution.extension.navigation.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/revo-slider/js/extensions/revolution.extension.video.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/base/js/scripts/revo-slider/slider-4.js') }}" type="text/javascript"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
        @if (count($errors) > 0)
            $('#slackInviteRequestModal').modal('show');
        @endif
    </script>
@stop



