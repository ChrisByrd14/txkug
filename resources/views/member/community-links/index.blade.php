@extends('layouts.app')

@section('header_scripts')
    <style>
        .fa-circle-o:hover:before {
            content: "\f111"
        }
    </style>
@stop

@section('content')

    @component('sections.breadcrumbs')
        @slot('title')
            Community Links
        @endslot
        @slot('subTitle')
            @if($channel->exists)
                {{ $channel->title }} Channel
            @else
                All Channels
            @endif
        @endslot

    @endcomponent

    @component('layouts.public-layout')
        @slot('content')
            <div class="row">
                <div class="col-md-3">
                    <h3 class="c-font-uppercase c-font-bold">Channels</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="/members/community-links">
                                <i class="fa fa-circle-o c-font-bold" style="color: #000000;"></i>
                                <span class="c-font-grey-3">All</span>
                            </a>
                        </li>
                        @foreach ($channels as $channel)
                            <li class="list-group-item">
                                <i class="fa fa-circle-o c-font-bold" style="color: #{{ $channel->color }};"></i>
                                <a href="/members/community-links/{{ $channel->slug }}">
                                    <span class="c-font-grey-3">{{ $channel->title }}</span>
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

                <div class="col-md-3">
                    @include('member.community-links.create')
                </div>
            </div>

        @endslot
    @endcomponent
@stop