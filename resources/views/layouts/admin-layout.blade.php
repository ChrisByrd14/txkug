<div class="container">
    <div class="c-layout-sidebar-menu c-theme">

        <div class="c-sidebar-menu-toggler">
            <h3 class="c-title c-font-uppercase c-font-bold">Admin Menu</h3>
            <a href="javascript:;" class="c-content-toggler" data-toggle="collapse" data-target="#admin-sidebar-menu">
                <span class="c-line"></span>
                <span class="c-line"></span>
                <span class="c-line"></span>
            </a>
        </div>

        <ul class="c-sidebar-menu collapse c-option-2" id="admin-sidebar-menu">
            <li class="{{ set_sidebar_active('admin') }}">
                <a href="{{ route('admin.home') }}">Dashboard</a>
            </li>

            <li class="{{ set_sidebar_active('admin/members*') }}">
                <a href="{{ route('admin.members.index') }}">Members</a>
            </li>

            <li class="c-dropdown {{ set_sidebar_active('admin/venues*') }}">
                <a href="javascript:;" class="c-toggler">Venues  <span class="c-arrow"></span></a>
                <ul class="c-dropdown-menu">
                    <li><a href="{{ route('admin.venues.index') }}">Venue List</a></li>
                    <li><a href="{{ route('admin.venues.create') }}">Add Venue</a></li>
                </ul>
            </li>

            <li class="c-dropdown {{ set_sidebar_active('admin/events*') }}">
                <a href="javascript:;" class="c-toggler">Events <span class="c-arrow"></span></a>
                <ul class="c-dropdown-menu">
                    <li><a href="{{ route('admin.events.index') }}">Event List</a></li>
                    <li><a href="{{ route('admin.events.create') }}">Add Event</a></li>
                </ul>
            </li>

        </ul>
    </div>

    <div class="c-layout-sidebar-content ">
        {{ $content }}
    </div>
</div>