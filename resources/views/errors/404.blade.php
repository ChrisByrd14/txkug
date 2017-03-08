@extends('layouts.app')

@section('content')
    <div class="c-content-box c-size-md c-bg-grey-1">
        <div class="container">
            <div class="c-content-bar-1 c-opt-1">
                <div class="row" data-auto-height="true">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="c-content-title-2" data-height="height">
                            <h3 class="c-font-uppercase c-font-bold">404 Page Not Found</h3>
                            <p class="c-font-uppercase c-font-bold">
                                We're sorry, but the page you are looking for could not be found.
                            </p>
                            <a href="{{ route('welcome.index') }}" class="btn btn-md c-theme-btn c-btn-uppercase c-btn-bold">
                                Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop