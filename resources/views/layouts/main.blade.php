<!DOCTYPE html>
<html lang="en">
@section('head')
    @include('layouts.head')
@show

<body>
    <!-- .app -->
    <div class="app">
        @section('header')
            @include('layouts.header')
        @show
        <!-- .app-aside -->
        <aside class="app-aside app-aside-expand-md app-aside-light">
            <!-- .aside-content -->
            <div class="aside-content">
                <!-- .aside-header -->
                <header class="aside-header d-block d-md-none">
                    <!-- .btn-account -->
                    <button class="btn-account" type="button" data-toggle="collapse" data-target="#dropdown-aside"><span
                            class="user-avatar user-avatar-lg"><img
                                src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" alt=""></span> <span
                            class="account-icon"><span class="fa fa-caret-down fa-lg"></span></span> <span
                            class="account-summary"><span class="account-name">{{ Auth::user()->name }}</span> <span
                                class="account-description">{{ Auth::user()->role }}</span></span></button>
                    <!-- /.btn-account -->
                    <!-- .dropdown-aside -->
                    <div id="dropdown-aside" class="dropdown-aside collapse">
                        <!-- dropdown-items -->
                        <div class="pb-3">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}"><span
                                    class="dropdown-icon oi oi-person"></span> Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"><span
                                        class="dropdown-icon oi oi-account-logout"></span>
                                    Logout</a>
                            </form>
                        </div><!-- /dropdown-items -->
                    </div><!-- /.dropdown-aside -->
                </header><!-- /.aside-header -->
                @section('sidebar')
                    @include('layouts.sidebar')
                @show

                <footer class="aside-footer border-top p-2">
                    <button class="btn btn-light btn-block link-text" data-toggle="skin"><span
                            class="d-compact-menu-none ">Dark mode</span> <i class="fas fa-moon ml-1"></i></button>
                </footer>
                <!-- /Skin changer -->
            </div><!-- /.aside-content -->
        </aside><!-- /.app-aside -->
        <!-- .app-main -->
        <main class="app-main">
            <!-- .wrapper -->
            <div class="wrapper">
                <!-- .page -->
                <div class="page">
                    <!-- .page-inner -->
                    <div class="page-inner">
                        <!-- .page-title-bar -->
                        <header class="page-title-bar">
                            <!-- page title stuff goes here -->
                            <h1 class="page-title">{{ $title }}</h1>
                        </header><!-- /.page-title-bar -->
                        <!-- .page-section -->
                        <div class="page-section">
                            <!-- .section-block -->
                            @yield('content')
                            <!-- /.section-block -->
                        </div><!-- /.page-section -->
                    </div><!-- /.page-inner -->
                </div><!-- /.page -->
            </div>
            @section('footer')
                @include('layouts.footer')
            @show
        </main><!-- /.app-main -->
    </div><!-- /.app -->
    @section('script')
        @include('layouts.script')
    @show
</body>

</html>
