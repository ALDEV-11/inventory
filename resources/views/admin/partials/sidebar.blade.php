<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        {{-- Dashboard --}}
        <li class="sidebar-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="{{ url('/dashboard') }}" class="sidebar-link">
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>


        {{-- Master Data --}}
        <li class="sidebar-item has-sub {{ request()->is('barang*', 'kategori-barang*', 'supplier*', 'lokasi*') ? 'active' : '' }}">
            <a href="#" class="sidebar-link">
                <i class="bi bi-box"></i>
                <span>Master Data</span>
            </a>
            <ul class="submenu {{ request()->is('barang*', 'kategori-barang*', 'supplier*', 'lokasi*') ? 'submenu-open' : '' }}">
                <li class="submenu-item {{ request()->is('barang*') ? 'active' : '' }}">
                    <a href="{{ url('/barang') }}">Data Barang</a>
                </li>
                <li class="submenu-item {{ request()->is('kategori-barang*') ? 'active' : '' }}">
                    <a href="{{ url('/kategori-barang') }}">Kategori Barang</a>
                </li>
                <li class="submenu-item {{ request()->is('supplier*') ? 'active' : '' }}">
                    <a href="{{ url('/supplier') }}">Data Supplier</a>
                </li>
                <li class="submenu-item {{ request()->is('lokasi*') ? 'active' : '' }}">
                    <a href="{{ url('/lokasi') }}">Lokasi / Rak Gudang</a>
                </li>
            </ul>
        </li>


        {{-- Transaksi --}}
        <li class="sidebar-item has-sub {{ request()->is('barang-masuk*', 'barang-keluar*', 'retur-barang*') ? 'active' : '' }}">
            <a href="#" class="sidebar-link">
                <i class="bi bi-arrow-left-right"></i>
                <span>Transaksi</span>
            </a>
            <ul class="submenu {{ request()->is('barang-masuk*', 'barang-keluar*', 'retur-barang*') ? 'submenu-open' : '' }}">
                <li class="submenu-item {{ request()->is('barang-masuk*') ? 'active' : '' }}">
                    <a href="{{ url('/barang-masuk') }}">Barang Masuk (PO)</a>
                </li>
                <li class="submenu-item {{ request()->is('barang-keluar*') ? 'active' : '' }}">
                    <a href="{{ url('/barang-keluar') }}">Barang Keluar</a>
                </li>
                <li class="submenu-item {{ request()->is('retur-barang*') ? 'active' : '' }}">
                    <a href="{{ url('/retur-barang') }}">Retur Barang</a>
                </li>
            </ul>
        </li>

        


        {{-- Laporan --}}
        <li class="sidebar-item has-sub {{ request()->is('laporan*') ? 'active' : '' }}">
            <a href="#" class="sidebar-link">
                <i class="bi bi-bar-chart-line-fill"></i>
                <span>Laporan</span>
            </a>
            <ul class="submenu {{ request()->is('laporan*') ? 'submenu-open' : '' }}">
                <li class="submenu-item {{ request()->is('laporan/mutasi*') ? 'active' : '' }}">
                    <a href="{{ route('laporan.mutasi') }}">Laporan Mutasi</a>
                </li>
                <li class="submenu-item {{ request()->is('laporan/opname*') ? 'active' : '' }}">
                    <a href="{{ route('laporan.opname') }}">Stok Opname</a>
                </li>
                <li class="submenu-item {{ request()->is('laporan/kartu*') ? 'active' : '' }}">
                    <a href="{{ route('laporan.kartu') }}">Kartu Stok</a>
                </li>
            </ul>
        </li>


        {{-- Notifikasi Stok --}}
        <li class="sidebar-item {{ request()->is('notifikasi*') ? 'active' : '' }}">
            <a href="{{ route('notifikasi.index') }}" class="sidebar-link d-flex justify-content-between align-items-center">
                <div>
                    <i class="bi bi-bell-fill"></i>
                    <span>Notifikasi Stok</span>
                </div>
                @php
                    $unreadCount = Auth::user()->unreadNotifications->count();
                @endphp
                @if($unreadCount > 0)
                    <span class="badge bg-danger rounded-pill">{{ $unreadCount }}</span>
                @endif
            </a>
        </li>

        <li class="sidebar-title">Akun</li>

        {{-- Logout --}}
        <li class="sidebar-item">
            <a href="#" class="sidebar-link text-danger"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-left"></i>
                <span>Logout</span>
            </a>
        </li>

    </ul>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>