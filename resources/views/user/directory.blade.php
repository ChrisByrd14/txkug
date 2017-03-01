@extends('layouts.app')

@section('content')

    @component('sections.breadcrumbs')
        @slot('title')
            Member Directory
        @endslot
    @endcomponent

    @component('layouts.public-layout')
        @slot('content')

            @foreach ($users as $user )
            <div class="col-md-4 col-sm-6 c-margin-b-30">
                <div class="c-content-person-1 c-option-2">
                    <div class="c-caption c-content-overlay">
                        <div class="c-overlay-wrapper">
                            <div class="c-overlay-content">
                                <a href="#">
                                    <i class="icon-link"></i>
                                </a>
                                <a href="assets/base/img/content/team/team13.jpg" data-lightbox="fancybox" data-fancybox-group="gallery-4">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </div>
                        </div>
                        <img class="c-overlay-object img-responsive" src="assets/base/img/content/team/team13.jpg" alt=""> </div>
                    <div class="c-body">
                        <div class="c-head">
                            <div class="c-name c-font-uppercase c-font-bold">{{ $user->name }}</div>
                            <ul class="c-socials c-theme-ul-ul">
                                <li>
                                    <a href="#">
                                        <i class="icon-social-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-social-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-social-dribbble"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="c-position">{{ $user->slack_title }}</div>
                        <p>BIO</p>
                    </div>
                </div>
            </div>
            @endforeach

        @endslot
    @endcomponent

@stop
