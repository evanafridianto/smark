<!-- .app-header -->
<header class="app-header app-header-dark">
    <!-- .top-bar -->
    <div class="top-bar">
        <!-- .top-bar-brand -->
        <div class="top-bar-brand" style="background-color: #35817f">
            <!-- toggle aside menu -->
            <button class="hamburger hamburger-squeeze mr-2" type="button" data-toggle="aside-menu"
                aria-label="toggle aside menu"><span class="hamburger-box"><span
                        class="hamburger-inner"></span></span></button> <!-- /toggle aside menu -->
            <a href="{{ route('dashboard') }}">
                <h2>
                    <span style="color: #ED3237">S</span>MARK
                </h2>
            </a>
        </div><!-- /.top-bar-brand -->
        <!-- .top-bar-list -->
        <div class="top-bar-list">
            <!-- .top-bar-item -->
            <div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
                <!-- toggle menu -->
                <button class="hamburger hamburger-squeeze" type="button" data-toggle="aside"
                    aria-label="toggle menu"><span class="hamburger-box"><span
                            class="hamburger-inner"></span></span></button> <!-- /toggle menu -->
            </div><!-- /.top-bar-item -->
            <div class="top-bar-item top-bar-item-right px-0 d-none d-sm-flex">
                <!-- .btn-account -->
                <div class="dropdown d-none d-md-flex">
                    <button class="btn-account" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><span class="user-avatar user-avatar-md"><img
                                src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" alt=""></span>
                        <span class="account-summary pr-lg-4 d-none d-lg-block"><span
                                class="account-name">{{ Auth::user()->name }}</span> <span
                                class="account-description">{{ Auth::user()->role }}</span></span></button>
                    <!-- .dropdown-menu -->
                    <div class="dropdown-menu">
                        <div class="dropdown-arrow d-lg-none" x-arrow=""></div>
                        <div class="dropdown-arrow ml-3 d-none d-lg-block"></div>
                        <h6 class="dropdown-header d-none d-md-block d-lg-none"> {{ Auth::user()->name }} </h6><a
                            class="dropdown-item" href="{{ route('profile.edit') }}"><span
                                class="dropdown-icon oi oi-person"></span> Profile</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();"><span
                                    class="dropdown-icon oi oi-account-logout"></span>
                                Logout</a>
                        </form>
                    </div><!-- /.dropdown-menu -->
                </div><!-- /.btn-account -->
            </div><!-- /.top-bar-item -->
        </div><!-- /.top-bar-list -->
    </div><!-- /.top-bar -->
</header>
