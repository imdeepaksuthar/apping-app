<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link {{ Request::segment(2) == 'categories' ? 'active' : '' }}"
                    href="{{ route('categories.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Categories
                </a>
                <a class="nav-link {{ Request::segment(2) == 'products' ? 'active' : '' }}"
                    href="{{ route('products.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Products
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ config('app.name') }}
        </div>
    </nav>
</div>
