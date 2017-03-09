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
                    <h1>Channels</h1>

                        <ul class="c-content-list-1 c-theme c-separator-dot">
                            <li class="c-bg-before-black">
                                <a href="/members/community-links" class="c-theme-link">
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
                    <div class="nav-justified">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="{{ request()->exists('popular') ? '' : 'active' }}"><a href="{{ request()->url() }}">Most Recent</a></li>
                            <li class="{{ request()->exists('popular') ? 'active' : '' }}"><a href="?popular">Most Popular</a></li>
                        </ul>
                        <div class="tab-content">
                            @include('member.community-links.list')
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