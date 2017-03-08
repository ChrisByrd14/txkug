<div class="container">
    <div class="c-layout-sidebar-menu c-theme">

        <div class="c-sidebar-menu-toggler">
            <h3 class="c-title c-font-uppercase c-font-bold">User Menu</h3>
            <a href="javascript:;" class="c-content-toggler" data-toggle="collapse" data-target="#user-sidebar-menu">
                <span class="c-line"></span>
                <span class="c-line"></span>
                <span class="c-line"></span>
            </a>
        </div>

        <ul class="c-sidebar-menu collapse c-option-2" id="user-sidebar-menu">
            <li class="{{ set_sidebar_active( Auth::user()->slack_handle ) }}">
                <a href="/{{ Auth::user()->slack_handle }}">My Profile</a>
            </li>

            <li class="{{ set_sidebar_active( Auth::user()->slack_handle . '/my-events*') }}">
                <a href="/{{ Auth::user()->slack_handle }}/my-events">My Events</a>
            </li>

        </ul>
    </div>

    <div class="c-layout-sidebar-content ">
        {{ $content }}
    </div>
</div>