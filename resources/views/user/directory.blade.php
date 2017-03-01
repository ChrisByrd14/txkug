@extends('layouts.app')

@section('content')

    @component('sections.breadcrumbs')
        @slot('title')
            Member Directory
        @endslot
    @endcomponent

    @component('layouts.public-layout')
        @slot('content')

            @foreach($users->chunk(4) as $users)
                <div class="row">
                @foreach ($users as $user )
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
                            <div class="btn-group btn-group-justified" role="group">
                                {{--<div class="btn-group c-border-top" role="group">--}}
                                    {{--<a href="shop-product-wishlist.html" class="btn btn-sm c-btn-white c-btn-uppercase c-btn-square c-font-grey-3 c-font-white-hover c-bg-red-2-hover c-btn-product">Wishlist</a>--}}
                                {{--</div>--}}
                                <div class="btn-group c-border-left c-border-top" role="group">
                                    <a href="{{ route('user.directory.show', [$user->slug]) }}" class="btn btn-sm c-btn-white c-btn-uppercase c-btn-square c-font-grey-3 c-font-white-hover c-bg-red-2-hover c-btn-product">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

            {{--<div class="col-md-3 col-sm-6 c-margin-b-30">--}}
                {{--<div class="c-content-person-1 c-option-2">--}}
                    {{--<div class="c-caption c-content-overlay">--}}
                        {{--<div class="c-overlay-wrapper">--}}
                            {{--<div class="c-overlay-content">--}}
                                {{--<a href="#">--}}
                                    {{--<i class="icon-link"></i>--}}
                                {{--</a>--}}
                                {{--<a href="assets/base/img/content/team/team13.jpg" data-lightbox="fancybox" data-fancybox-group="gallery-4">--}}
                                    {{--<i class="icon-magnifier"></i>--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<img class="c-overlay-object img-responsive" src="{{ $user->slack_avatar_192 }}" alt=""> </div>--}}
                    {{--<div class="c-body">--}}
                        {{--<div class="c-head">--}}
                            {{--<div class="c-name c-font-uppercase c-font-bold">{{ $user->name }}</div>--}}
                            {{--<ul class="c-socials c-theme-ul-ul">--}}
                                {{--<li>--}}
                                    {{--<a href="#">--}}
                                        {{--<i class="icon-social-twitter"></i>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#">--}}
                                        {{--<i class="icon-social-facebook"></i>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#">--}}
                                        {{--<i class="icon-social-dribbble"></i>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="c-position">{{ $user->slack_title }}</div>--}}
                        {{--<p>--}}
                            {{--BIO: Tolerare unus ducunt ad brevis buxum. Est alter buxum, cesaris. Eheu, lura!--}}
                            {{--Racanas crescere in emeritis oenipons! Ubi est rusticus repressor? Lixa grandis clabulare est.--}}
                            {{--Eposs tolerare, tanquam fatalis.--}}
                        {{--</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--@endforeach--}}

        @endslot
    @endcomponent

@stop
