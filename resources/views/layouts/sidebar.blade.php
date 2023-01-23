<div class="aside-menu overflow-hidden">
    <!-- .stacked-menu -->
    <nav id="stacked-menu" class="stacked-menu">
        <!-- .menu -->
        <ul class="menu">
            <!-- .menu-item -->
            <li class="menu-item {{ Route::is('dashboard') ? 'has-active' : '' }}">
                <a href="{{ route('dashboard') }}" class="menu-link"><span class="menu-icon oi oi-home"></span>
                    <span class="menu-text">Dashboard</span></a>
            </li><!-- /.menu-item -->
            <!-- .menu-item -->
            <!-- .menu-item -->
            <li class="menu-item {{ Route::is('user.index') ? 'has-active' : '' }}">
                <a href="{{ route('user.index') }}" class="menu-link"><span class="menu-icon oi oi-basket"></span>
                    <span class="menu-text">Data User & UMKM</span></a>
            </li><!-- /.menu-item -->
            <!-- .menu-item -->
            <li class="menu-item {{ Route::is('category.index') ? 'has-active' : '' }} has-child">
                <a href="#" class="menu-link"><span class="menu-icon oi oi-book"></span> <span
                        class="menu-text">Data Master</span></a> <!-- child menu -->
                <ul class="menu">
                    <li class="menu-item {{ Route::is('category.index') ? 'has-active' : '' }}">
                        <a href="{{ route('category.index') }}" class="menu-link">Kategori Usaha</a>
                    </li>
                </ul><!-- /child menu -->
            </li><!-- /.menu-item -->

            <!-- .menu-header -->
            <li class="menu-header">Admin </li><!-- /.menu-header -->
            <!-- .menu-item -->
            <li class="menu-item {{ Route::is('profile.edit') ? 'has-active' : '' }}">
                <a href="{{ route('profile.edit') }}" class="menu-link"><span class="menu-icon oi oi-person"></span>
                    <span class="menu-text">Profile</span></a>
                </form>
            </li><!-- /.menu-item -->
            <li class="menu-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                this.closest('form').submit();"
                        class="menu-link"><span class="menu-icon oi oi-account-logout"></span> <span
                            class="menu-text">Log
                            Out</span></a>
                </form>
            </li><!-- /.menu-item -->
            <!-- /.menu-item -->
        </ul><!-- /.menu -->
    </nav><!-- /.stacked-menu -->
</div>
