@extends('layouts.app')

@section('content')

    @component('sections.breadcrumbs')
        @slot('title')
            Channels
        @endslot
        @slot('subTitle')
            Channels are used in the creation of links, news, etc.
        @endslot
    @endcomponent

    @component('layouts.admin-layout')

        @slot('content')

            <channels></channels>

        @endslot
    @endcomponent

@stop