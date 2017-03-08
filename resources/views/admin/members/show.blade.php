@extends('layouts.app')

@section('content')

    @component('sections.breadcrumbs')
        @slot('title')
            Member Profile
        @endslot
    @endcomponent

    @component('layouts.admin-layout')

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
                    <img src="{{ $member->slack_avatar_192 }}" class="img-responsive">
                </div>
                <div class="col-md-4">
                    Member Since: {{ $member->created_at->format('F d, Y') }} <br />
                    Role: {{ title_case($member->role->name) }}
                </div>
                <div class="col-md-4">
                    <p>
                        Slack handle: {{ '@' . $member->slack_handle }}<br />
                        @if ( $member->slack_title  ) Slack Title: {{ $member->slack_title }} <br /> @endif
                        Email: <a href="mailto:{{ $member->email }}">{{ $member->email }}</a><br />

                    </p>
                </div>
            </div>

            <div class="row c-margin-t-20">
                <div class="col-md-12">
                    <h2>Areas of Expertise</h2>
                    <hr />
                    <p>
                        <span class="label label-default c-font-slim">Default</span>
                        <span class="label label-success c-font-slim">Success</span>
                        <span class="label label-warning c-font-slim">Warning</span>
                        <span class="label label-danger c-font-slim">Danger</span>
                        <span class="label label-info c-font-slim">Info</span>
                        <span class="label label-primary c-font-slim">Primary</span>
                    </p>

                </div>
            </div>

            <div class="row c-margin-t-20">
                <div class="col-md-12">
                    <h2>Event Attendance</h2>
                    <hr />
                    <p>
                        {{ $member->first_name }} has attended  {{ $member->attendance->count() }} {{ str_plural('event', $member->attendance->count()) }}
                    </p>

                    @if($member->attendance->count() > 0 )
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-hover">
                                <thead class="c-theme-bg">
                                    <tr>
                                        <th class="c-font-white">Event</th>
                                        <th class="c-font-white">Venue</th>
                                        <th class="c-font-white">Date & Time</th>
                                        <th class="c-font-white">Check-In Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($member->attendance as $attendance)
                                    <tr>
                                        <td><a href="/admin/events/{{ $attendance->events->event_type->slug }}">{{ $attendance->events->event_type->event_type }}</a></td>
                                        <td><a href="/admin/venues/{{ $attendance->events->venue->slug }}">{{ $attendance->events->venue->venue_name }}</a></td>
                                        <td>{{ $attendance->events->event_date->format('l F d, Y') }}</td>
                                        <td>{{ $attendance->created_at->format('h:i A') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

        @endslot
    @endcomponent
@stop