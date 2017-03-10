@extends('layouts.app')

@section('content')

    @component('sections.breadcrumbs')
        @slot('title')
            Community Links
            @if($channel->exists)
                <span>&mdash; {{ $channel->title }}</span>
            @endif
        @endslot

    @endcomponent

    @component('layouts.public-layout')
        @slot('content')
            <div class="row">
                <div class="col-md-2">
                    <h3 class="c-font-uppercase c-font-bold">Channels</h3>
                    <ul class="c-content-list-1 c-theme c-separator-dot">
                        <li class="c-bg-before-black">
                            <a href="/members/community-links">
                                All Channels
                            </a>
                        </li>
                        @foreach ($channels as $channel)
                            <li class="c-bg-before-{{ $channel->color }}">
                                <a href="/members/community-links/{{ $channel->slug }}" class="c-theme-link">
                                    {{ $channel->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-6">
                    <div class="c-content-tab-1 c-theme">
                        <div class="clearfix">
                            <ul class="nav nav-tabs c-font-uppercase c-font-bold">
                                <li class="{{ request()->exists('popular') ? '' : 'active' }}"><a href="{{ request()->url() }}">Most Recent</a></li>
                                <li class="{{ request()->exists('popular') ? 'active' : '' }}"><a href="?popular">Most Popular</a></li>
                            </ul>
                            <div class="tab-content">
                                @include('member.community-links.list')
                            </div>
                        </div>
                    </div>
                    {!! $links->appends(request()->query())->links('vendor.pagination.bootstrap-4') !!}
                </div>

                <div class="col-md-4">
                    @include('member.community-links.create')
                </div>
            </div>

        @endslot
    @endcomponent
@stop