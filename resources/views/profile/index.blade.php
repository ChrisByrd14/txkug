@extends('layouts.app')

@section('content')

    @component('sections.breadcrumbs')
        @slot('title')
            {{ Auth::user()->name }}
        @endslot
    @endcomponent

    @component('layouts.profile-layout')

        @slot('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="c-content-title-1">
                        <h3 class="c-font-uppercase c-font-bold">My Profile</h3>
                    </div>
                    <div class="c-content-divider c-divider-sm c-theme-bg"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <img src="{{ $member->slack_avatar_192 }}" class="img-responsive img-thumbnail">
                </div>

                <div class="col-md-9">
                    <p>
                        Name: {{ $member->first_name }} {{ $member->last_name }}<br />
                        Slack handle: {{ '@' . $member->slack_handle }}<br />
                        @if ( $member->slack_title  ) Slack Title: {{ $member->slack_title }} <br /> @endif
                        Email: <a href="mailto:{{ $member->email }}">{{ $member->email }}</a><br />
                        Joined: {{ $member->created_at->format('l d, Y') }}
                    </p>
                </div>
            </div>

        @endslot
    @endcomponent
@stop