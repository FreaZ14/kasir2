<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->is('/dashboard') ? 'active' : 'collapsed' }}" href="/dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Pages</li>

        @if (auth()->user()->id != 2)
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('users*') ? 'active' : 'collapsed' }}"
                    href="{{ route('users.index') }}">
                    <i class="bi bi-people"></i>
                    <span>Users</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('barang*') ? 'active' : 'collapsed' }}"
                    href="{{ route('barang.index') }}">
                    <i class="bi bi-box"></i>
                    <span>Barang</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('pembelian*') ? 'active' : 'collapsed' }}"
                    href="{{ route('pembelian.index') }}">
                    <i class="bi bi-basket2"></i>
                    <span>Pembelian</span>
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('penjualan*') ? 'active' : 'collapsed' }}"
                href="{{ route('penjualan.index') }}">
                <i class="bi bi-cart"></i>
                <span>Penjualan</span>
            </a>
        </li>



    </ul>

</aside>
