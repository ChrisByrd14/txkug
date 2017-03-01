<section class="c-layout-revo-slider c-layout-revo-slider-4" dir="ltr">
    <div class="tp-banner-container c-theme">
        <div class="tp-banner rev_slider" data-version="5.0">
            <ul>
                @if($nextEvent)
                    <li data-transition="fade" data-slotamount="1" data-masterspeed="1000">
                        <img alt="" src="{{ asset('assets/base/img/content/backgrounds/shutterstock_483915301-calendar-overlay-blur-v2.jpg') }}" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">

                        <div class="tp-caption customin customout" data-x="center" data-y="center" data-hoffset="" data-voffset="-50" data-speed="500" data-start="1000" data-transform_idle="o:1;" data-transform_in="rX:0.5;scaleX:0.75;scaleY:0.75;o:0;s:500;e:Back.easeInOut;"
                             data-transform_out="rX:0.5;scaleX:0.75;scaleY:0.75;o:0;s:600;e:Back.easeInOut;" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="600">
                            <h3 class="c-main-title-circle c-font-48 c-font-bold c-font-center c-font-uppercase c-font-white c-block">
                                Join us for <br /> our next Event!
                            </h3>
                        </div>

                        <div class="tp-caption lft" data-x="center" data-y="center" data-voffset="110" data-speed="900" data-start="2000" data-transform_idle="o:1;" data-transform_in="x:100;y:100;rX:120;scaleX:0.75;scaleY:0.75;o:0;s:900;e:Back.easeInOut;"
                             data-transform_out="x:100;y:100;rX:120;scaleX:0.75;scaleY:0.75;o:0;s:900;e:Back.easeInOut;">
                            <a href="{{ route('events.show', [$slug = $nextEvent->slug]) }}" class="c-action-btn btn btn-lg c-btn-square c-theme-btn c-btn-bold c-btn-uppercase">Learn More!</a>
                        </div>
                    </li>
                @endif

                <li data-transition="fade" data-slotamount="1" data-masterspeed="1000">
                    <img alt="" src="{{ asset('assets/base/img/content/backgrounds/shutterstock_413674186-hands-in-overlay-less-blur-v3.jpg') }}" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">

                    <div class="tp-caption customin customout" data-x="center" data-y="center" data-hoffset="" data-voffset="-50" data-speed="500" data-start="1000" data-transform_idle="o:1;" data-transform_in="rX:0.5;scaleX:0.75;scaleY:0.75;o:0;s:500;e:Back.easeInOut;"
                         data-transform_out="rX:0.5;scaleX:0.75;scaleY:0.75;o:0;s:500;e:Back.easeInOut;" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="600">
                        <h3 class="c-main-title-circle c-font-48 c-font-bold c-font-center c-font-uppercase c-font-white c-block"> JOIN OUR SLACK TEAM</h3>
                    </div>

                    {{--<div class="tp-caption customin customout" data-x="center" data-y="center" data-hoffset="0" data-voffset="10" data-speed="500" data-start="1500" data-transform_in="x:0;y:0;z:0;rotationX:0.5;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;s:500;e:Back.easeInOut;"--}}
                         {{--data-transform_out="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;s:600;e:Back.easeInOut;" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1"--}}
                         {{--data-endspeed="600">--}}
                        {{--<p class="c-font-20 c-line-height-28 c-font-white c-opacity-07 c-font-thin c-center c-sub-title">--}}
                            {{--Lorem ipsum dolor sit amet, consectetuer elit sed--}}
                            {{--<br> et nibh euismod aliquam sed--}}
                        {{--</p>--}}
                    {{--</div>--}}

                    <div class="tp-caption lft" data-x="center" data-y="center" data-voffset="110" data-speed="900" data-start="2000" data-transform_idle="o:1;" data-transform_in="x:100;y:100;rX:120;scaleX:0.75;scaleY:0.75;o:0;s:500;e:Back.easeInOut;"
                         data-transform_out="x:100;y:100;rX:120;scaleX:0.75;scaleY:0.75;o:0;s:500;e:Back.easeInOut;">
                        <a href="#" class="c-action-btn btn btn-lg c-btn-square c-theme-btn c-btn-bold c-btn-uppercase" data-toggle="modal" data-target="#slackInviteRequestModal">REQUEST AN INVITE!</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>

<div class="modal fade c-content-login-form" id="slackInviteRequestModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content c-square">
            <div class="modal-header c-no-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="slackInviteRequest">TXKUG Slack Team Invite Request</h4>
            </div>
            <div class="modal-body">
                {{--<h3 class="c-font-24 c-font-sbold">Create An Account</h3>--}}
                <p>Please fill in below form to create an account with us</p>
                <form>
                    <div class="form-group">
                        <label for="signup-email" class="hide">Email</label>
                        <input type="email" class="form-control input-lg c-square" id="signup-email" placeholder="Email"> </div>
                    <div class="form-group">
                        <label for="signup-username" class="hide">Username</label>
                        <input type="email" class="form-control input-lg c-square" id="signup-username" placeholder="Username"> </div>
                    <div class="form-group">
                        <label for="signup-fullname" class="hide">Fullname</label>
                        <input type="email" class="form-control input-lg c-square" id="signup-fullname" placeholder="Fullname"> </div>
                    <div class="form-group">
                        <label for="signup-country" class="hide">Captcha</label>

                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square c-btn-login">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>









{{--<div id="slackInviteRequestModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="slackInviteRequest" aria-hidden="true">--}}
    {{--<div class="modal-dialog">--}}
        {{--<div class="modal-content c-square">--}}
            {{--<div class="modal-header">--}}
                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                    {{--<span aria-hidden="true">×</span>--}}
                {{--</button>--}}
                {{--<h4 class="modal-title" id="slackInviteRequest">TXKUG Slack Team Invite Request</h4>--}}
            {{--</div>--}}
            {{--<div class="modal-body">--}}
                {{--<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip--}}
                    {{--ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt--}}
                    {{--mollit anim id est laborum </p>--}}
            {{--</div>--}}
            {{--<div class="modal-footer">--}}
                {{--<button type="button" class="btn c-theme-btn c-btn-square c-btn-bold c-btn-uppercase">Submit</button>--}}
                {{--<button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Close</button>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<!-- /.modal-content -->--}}
    {{--</div>--}}
    {{--<!-- /.modal-dialog -->--}}
{{--</div>--}}