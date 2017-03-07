@extends('layouts.app')

@section('content')

    @include('sections.intro-slider')
    @include('sections.modals.slack-invite')
    @include('sections.about-us')

@stop

@section('footer_scripts')
    <script src="{{ asset('assets/base/js/scripts/revo-slider/slider-4.js') }}" type="text/javascript"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
        @if (count($errors) > 0)
            $('#slackInviteRequestModal').modal('show');
        @endif
    </script>
@stop



