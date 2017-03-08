@extends('layouts.app')

@section('content')

    @component('sections.breadcrumbs')
        @slot('title')
            Member Directory
        @endslot

    @endcomponent

    @component('layouts.public-layout')
        @slot('content')

            @foreach($members->chunk(6) as $chunked_members)
                <div class="row">
                    @foreach ($chunked_members as $member )
                        <div class="col-md-2 col-sm-6 c-margin-b-25">
                            <div class="c-content-product-2 c-bg-white c-border">
                                <div class="c-content-overlay">
                                    <div class="c-overlay-wrapper">
                                        <div class="c-overlay-content c-padding-10">
                                            <a href="{{ route('members.show', [$member->slug]) }}" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">More</a>
                                        </div>
                                    </div>
                                    <div class="c-bg-img-center c-overlay-object" data-height="height" style="height: 145px; background-image: url({{ $member->slack_avatar_192 }});"></div>
                                </div>
                                <div class="c-info c-theme-bg c-font-white">
                                    <p class="c-title c-font-14 c-font-slim">{{ $member->name }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

            <div class="pull-right">{!! $members->links('vendor.pagination.bootstrap-4') !!}</div>

        @endslot
    @endcomponent

@stop
