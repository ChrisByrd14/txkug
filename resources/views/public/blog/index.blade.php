@extends('layouts.app')


@section('content')

    @component('sections.breadcrumbs')
        @slot('title')
            Blog
        @endslot
    @endcomponent

    @component('layouts.public-layout')
        @slot('content')

        @endslot
    @endcomponent

@stop
