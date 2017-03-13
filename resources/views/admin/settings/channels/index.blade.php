@extends('layouts.app')

@section('content')

    @component('sections.breadcrumbs')
        @slot('title')
            Channels
        @endslot
        @slot('subTitle')
            Used in the creation of links, news, etc.
        @endslot
    @endcomponent

    @component('layouts.admin-layout')

        @slot('content')

            <div class="c-content-title-1">
                <h3 class="c-font-uppercase c-font-bold">Channels</h3>
            </div>
            <div class="c-content-divider c-divider-sm c-theme-bg"></div>

            <channels></channels>



        @endslot
    @endcomponent

@stop