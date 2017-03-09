<!-- BEGIN: HEADER -->
<header class="c-layout-header c-layout-header-4 c-layout-header-default-mobile" data-minimize-offset="80">
    <div class="c-navbar">
        <div class="container">
            <div class="c-navbar-wrapper clearfix">
                <div class="c-brand c-pull-left">
                    <a href="/" class="c-logo">
                        <img src="{{ asset('assets/base/img/layout/logos/txkug-logo.png') }}" alt="TXKUG" class="c-desktop-logo">
                        <img src="{{ asset('assets/base/img/layout/logos/txkug-logo.png') }}" alt="TXKUG" class="c-desktop-logo-inverse">
                        <img src="{{ asset('assets/base/img/layout/logos/txkug-logo.png') }}" alt="TXKUG" class="c-mobile-logo">
                    </a>
                    <button class="c-hor-nav-toggler" type="button" data-target=".c-mega-menu">
                        <span class="c-line"></span>
                        <span class="c-line"></span>
                        <span class="c-line"></span>
                    </button>
                </div>
                <nav class="c-mega-menu c-pull-right c-mega-menu-dark c-mega-menu-dark-mobile c-fonts-uppercase c-fonts-bold">
                    <ul class="nav navbar-nav c-theme-nav">
                        <li class="c-link {{ set_active('/') }}">
                            <a href="{{ route('welcome.index') }}" class="c-link">Home</a>
                        </li>
                        <li class="c-link {{ set_active('events*') }}">
                            <a href="{{ route('events.index') }}" class="c-link">Events</a>
                        </li>

                        @if (Auth::guest())
                            <li class="c-link">
                                <a href="{{ route('social.redirect', ['provider' => 'slack']) }}" class="c-link">Sign In</a>
                            </li>
                        @else
                            <li class="c-link {{ set_active('members') }}">
                                <a href="{{ route('members.index') }}" class="c-link">Directory</a>
                            </li>
                            <li class="c-link {{ set_active('members/community-links*') }}">
                                <a href="{{ route('members.community-links.index') }}" class="c-link">Community Links</a>
                            </li>
                            <li class="c-link {{ set_active(Auth::user()->slack_handle . '*') }}">
                                <a href="/{{ Auth::user()->slack_handle }}" class="c-link">My Profile</a>
                            </li>
                            @if(Auth::user()->role->name == 'administrator')
                                <li class="c-link {{ set_active('admin*') }}">
                                    <a href="{{ route('admin.home') }}" class="c-link">Admin</a>
                                </li>
                            @endif
                            <li class="c-link">'
                                <a href="{{ route('authenticated.logout') }}" class="c-link">Logout</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>