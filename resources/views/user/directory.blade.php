@extends('layouts.app')

@section('content')

    @component('sections.breadcrumbs')
        @slot('title')
            Member Directory
        @endslot
    @endcomponent

    @component('layouts.public-layout')
        @slot('content')

            @foreach($users->chunk(8) as $chunked_users)
                <div class="row">
                    @foreach ($chunked_users as $user )
                        <div class="col-lg-3 col-md-3 col-sm-6 c-margin-b-25">
                            <div class="c-content-product-2 c-bg-white c-border">
                                <div class="c-content-overlay">
                                    <div class="c-overlay-wrapper">
                                        <div class="c-overlay-content c-padding-10">
                                            <a href="{{ route('user.directory.show', [$user->slug]) }}" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">More</a>
                                        </div>
                                    </div>
                                    <div class="c-bg-img-center c-overlay-object" data-height="height" style="height: 230px; background-image: url({{ $user->slack_avatar_192 }});"></div>
                                </div>
                                <div class="c-info c-theme-bg c-font-white">
                                    <p class="c-title c-font-16 c-font-slim">{{ $user->name }}</p>
                                    <p class="c-price c-font-14 c-font-slim">@if ( $user->slack_title ) {{ $user->slack_title }} @else &nbsp; @endif</p>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            @endforeach

            <div class="pull-right">{!! $users->links('vendor.pagination.bootstrap-4') !!}</div>

        @endslot
    @endcomponent

@stop
