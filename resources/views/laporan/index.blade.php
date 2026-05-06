<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - SmartStock</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="shortcut icon" href="{{ asset('dist-dashboard/assets/images/logo/logo.png') }}" type="image/x-icon">
</head>
<body>
<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            @include('partials.sidebar-header')
            @php $role = Auth::user()->role; $sidebarView = ($role == 'admin') ? 'admin.partials.sidebar' : 'kepala.partials.sidebar'; @endphp
            @include($sidebarView)
        </div>
    </div>
    <div id="main">
        <header class="mb-3"><a href="#" class="burger-btn d-block d-xl-none"><i class="bi bi-justify fs-3"></i></a></header>
        <div class="page-heading">
            <h3>Pusat Laporan</h3>
            <p class="text-subtitle text-muted">Pilih jenis laporan yang ingin Anda generate</p>
        </div>
        <div class="page-content">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center py-4">
                            <i class="bi bi-arrow-left-right fs-1 text-primary mb-3"></i>
                            <h5 class="fw-bold">Laporan Mutasi</h5>
                            <p class="text-muted small">Pergerakan barang masuk, keluar, dan retur dalam periode tertentu.</p>
                            <a href="{{ route('laporan.mutasi') }}" class="btn btn-outline-primary mt-2">Buka Laporan</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center py-4">
                            <i class="bi bi-clipboard-data fs-1 text-success mb-3"></i>
                            <h5 class="fw-bold">Stok Opname</h5>
                            <p class="text-muted small">Snapshot stok seluruh barang saat ini beserta nilai inventaris.</p>
                            <a href="{{ route('laporan.opname') }}" class="btn btn-outline-success mt-2">Buka Laporan</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center py-4">
                            <i class="bi bi-journal-text fs-1 text-warning mb-3"></i>
                            <h5 class="fw-bold">Kartu Stok</h5>
                            <p class="text-muted small">Histori lengkap pergerakan stok per barang dengan saldo berjalan.</p>
                            <a href="{{ route('laporan.kartu') }}" class="btn btn-outline-warning mt-2">Buka Laporan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.partials.footer')
    </div>
</div>
<script src="{{ asset('dist-dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('dist-dashboard/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist-dashboard/assets/js/main.js') }}"></script>
</body>
</html>
