@extends('layouts.app')

@section('content')

    @component('sections.breadcrumbs')
        @slot('title')
            Event Types
        @endslot
        @slot('subTitle')
            Used in the creation of events to identify the type of event
        @endslot
    @endcomponent

    @component('layouts.admin-layout')
        @slot('content')

            <event-types></event-types>

        @endslot
    @endcomponent
@stop