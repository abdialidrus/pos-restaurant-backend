<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main Menu</li>
                <li class="{{ Request::is('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}"
                    class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
                </li>
                <li class="{{ Request::is('users') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}"
                    class="nav-link"><i class="fas fa-user"></i><span>Users</span></a>
                </li>
                <li class="{{ Request::is('product_categories') ? 'active' : '' }}">
                    <a href="{{ route('product_categories.index') }}"
                    class="nav-link"><i class="fas fa-user"></i><span>Product Categories</span></a>
                </li>
        </ul>
    </aside>
</div>
