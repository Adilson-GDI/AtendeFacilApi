<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-headset"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
            Atende Fácil
        </div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Gestão
    </div>

    <li class="nav-item {{ request()->routeIs('admin.empresas.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.empresas.index') }}">
            <i class="fas fa-fw fa-building"></i>
            <span>Empresas</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.usuarios.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Usuários</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.clientes.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.clientes.index') }}">
            <i class="fas fa-fw fa-user-friends"></i>
            <span>Clientes</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.projetos.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.projetos.index') }}">
            <i class="fas fa-fw fa-drafting-compass"></i>
            <span>Projetos</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.fornecedores.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.fornecedores.index') }}">
            <i class="fas fa-fw fa-truck"></i>
            <span>Fornecedores</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.financeiro.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.financeiro.index') }}">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Financeiro</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Comunicação
    </div>

    <li class="nav-item {{ request()->routeIs('admin.push.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.push.index') }}">
            <i class="fas fa-fw fa-bell"></i>
            <span>Push</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>