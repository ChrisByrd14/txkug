@extends('layouts.app')

@section('content')

    @component('sections.breadcrumbs')
        @slot('title')
            Member Directory
        @endslot
    @endcomponent

    @component('layouts.public-layout')
        @slot('content')
            <div class="row">
                <div class="col-md-12">
                    <div class="c-content-title-1">
                        <h3 class="c-font-uppercase c-font-bold">{{ $member->first_name }} {{ $member->last_name }}</h3>
                    </div>
                    <div class="c-content-divider c-divider-sm c-theme-bg"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="c-bg-img-center" data-height="height" style="height: 250px; background-image: url({{ $member->slack_avatar_192 }});"></div>
                    {{--<img src="{{ $user->slack_avatar_192 }}" class="img-responsive">--}}
                </div>

                <div class="col-md-9">
                    <p>
                        
                        Slack handle: {{ '@' . $member->slack_handle }}<br />
                        @if ( $member->slack_title  ) Slack Title: {{ $member->slack_title }} <br /> @endif
                        Email: <a href="mailto:{{ $member->email }}">{{ $member->email }}</a><br />
                        Joined: {{ $member->created_at->format('l F d, Y') }}
                    </p>
                </div>
            </div>
        @endslot
    @endcomponent
@stop