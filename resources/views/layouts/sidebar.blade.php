@if(Auth::user()->getRoleNames()[0] === 'admin')
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item {{ Request::is('*dashboard') ? 'nav-item-active' : '' }}">
        <a href="/admin/dashboard" class="text-white nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    <li class="nav-item {{ Request::is('*masyarakat*') ? 'nav-item-active' : '' }}">
        <a href="/admin/masyarakat" class="text-white nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
                Masyarakat
            </p>
        </a>
    </li>
    <li class="nav-item {{ Request::is('*surat') ? 'nav-item-active' : '' }}">
        <a href="/admin/surat" class="text-white nav-link">
            <i class="nav-icon fas fa-envelope"></i>
            <p>
                Surat
            </p>
        </a>
    </li>
    <li class="nav-item {{ Request::is('*about') ? 'nav-item-active' : '' }}">
        <a href="/admin/about" class="text-white nav-link">
            <i class="nav-icon fas fa-info-circle"></i>
            <p>
                About
            </p>
        </a>
    </li>
</ul>
@else
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item {{ Request::is('*dashboard') ? 'nav-item-active' : '' }}">
        <a href="/user/dashboard" class="text-white nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    <li class="nav-item {{ Request::is('*surat*') ? 'nav-item-active' : '' }}">
        <a href="/user/surat" class="text-white nav-link">
            <i class="nav-icon fas fa-envelope"></i>
            <p>
                Surat
            </p>
        </a>
    </li>
    <li class="nav-item {{ Request::is('*about') ? 'nav-item-active' : '' }}">
        <a href="/user/about" class="text-white nav-link">
            <i class="nav-icon fas fa-info-circle"></i>
            <p>
                About
            </p>
        </a>
    </li>
</ul>
@endif
