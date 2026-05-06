<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/css/app.css') }}">
    {{-- FontAwesome 6 Free CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="shortcut icon" href="{{ asset('dist-dashboard/assets/images/logo/logo.png') }}" type="image/x-icon">

    <style>
        .stats-icon.blue { background-color: rgba(67, 94, 190, 0.1); color: #435ebe; }
        .stats-icon.red { background-color: rgba(243, 97, 109, 0.1); color: #f3616d; }
        .stats-icon.yellow { background-color: rgba(234, 202, 74, 0.1); color: #eaca4a; }
        
        .shortcut-card {
            border-radius: 12px;
            /* Disabled hover animations as requested */
            transition: none !important;
        }
        .shortcut-card:hover {
            transform: none !important;
            box-shadow: none !important;
        }
        .stats-icon i {
            line-height: 50px;
        }
        .badge {
            font-weight: 700;
            letter-spacing: 0.5px;
        }
    </style>
</head>

<body>
<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            @include('partials.sidebar-header')
            @include('petugas.partials.sidebar')
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>

    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Dashboard Petugas</h3>
                        <p class="text-subtitle text-muted">Selamat datang, {{ Auth::user()->name }}!</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content">
            {{-- BARIS 1: 3 Transaksi Cards --}}
            <div class="row g-4 mb-4">
                {{-- Barang Masuk --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow-sm border-0 h-100" style="border-left: 5px solid #435ebe !important; border-radius: 10px;">
                        <div class="card-body py-4 px-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="stats-icon blue mb-2" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 10px;">
                                    <i class="fas fa-arrow-down fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted font-semibold small mb-1">Barang Masuk Hari Ini</h6>
                                    <h3 class="fw-bold mb-0" style="color: #435ebe;">{{ $transaksiMasukHariIni }}</h3>
                                </div>
                            </div>
                            <p class="text-muted small mt-2 mb-0">yang kamu input hari ini</p>
                        </div>
                    </div>
                </div>
                
                {{-- Barang Keluar --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow-sm border-0 h-100" style="border-left: 5px solid #f3616d !important; border-radius: 10px;">
                        <div class="card-body py-4 px-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="stats-icon red mb-2" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 10px;">
                                    <i class="fas fa-arrow-up fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted font-semibold small mb-1">Barang Keluar Hari Ini</h6>
                                    <h3 class="fw-bold mb-0" style="color: #f3616d;">{{ $transaksiKeluarHariIni }}</h3>
                                </div>
                            </div>
                            <p class="text-muted small mt-2 mb-0">yang kamu input hari ini</p>
                        </div>
                    </div>
                </div>

                {{-- Retur --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow-sm border-0 h-100" style="border-left: 5px solid #eaca4a !important; border-radius: 10px;">
                        <div class="card-body py-4 px-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="stats-icon yellow mb-2" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 10px;">
                                    <i class="fas fa-undo fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted font-semibold small mb-1">Retur Hari Ini</h6>
                                    <h3 class="fw-bold mb-0" style="color: #eaca4a;">{{ $returHariIni }}</h3>
                                </div>
                            </div>
                            <p class="text-muted small mt-2 mb-0">yang kamu input hari ini</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BARIS 2: 2 Shortcut Cards --}}
            <div class="row g-4 mb-4">
                {{-- Shortcut Masuk --}}
                <div class="col-lg-6">
                    <div class="card border-0 text-white shortcut-card overflow-hidden h-100" style="background-color: #435ebe; border-radius: 12px;">
                        <div class="card-body p-4 position-relative">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="fw-bold text-white mb-1"><i class="fas fa-plus-circle me-2"></i> Input Barang Masuk</h4>
                                    <p class="opacity-75 mb-4">Catat penerimaan barang baru</p>
                                    <a href="{{ url('barang-masuk/create') }}" class="btn btn-light fw-bold px-4 py-2 border-0" style="border-radius: 10px; color: #435ebe;">Input Sekarang</a>
                                </div>
                                <div class="opacity-25">
                                    <i class="fas fa-plus-circle" style="font-size: 8rem; position: absolute; right: -20px; top: 10px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Shortcut Keluar --}}
                <div class="col-lg-6">
                    <div class="card border-0 text-white shortcut-card overflow-hidden h-100" style="background-color: #f3616d; border-radius: 12px;">
                        <div class="card-body p-4 position-relative">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="fw-bold text-white mb-1"><i class="fas fa-minus-circle me-2"></i> Input Barang Keluar</h4>
                                    <p class="opacity-75 mb-4">Catat pengeluaran barang</p>
                                    <a href="{{ url('barang-keluar/create') }}" class="btn btn-light fw-bold px-4 py-2 border-0" style="border-radius: 10px; color: #f3616d;">Input Sekarang</a>
                                </div>
                                <div class="opacity-25">
                                    <i class="fas fa-minus-circle" style="font-size: 8rem; position: absolute; right: -20px; top: 10px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BARIS 3: Tabel Stok Kritis --}}
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold"><i class="fas fa-exclamation-triangle text-danger me-2"></i> Barang Perlu Perhatian</h5>
                        </div>
                        <div class="card-body p-0">
                            @if($daftarStokKritis->isEmpty())
                                <div class="text-center py-5">
                                    <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                                    <h5 class="text-muted">Semua stok aman</h5>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="ps-4">Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Kategori</th>
                                                <th class="text-center">Stok Min</th>
                                                <th class="text-center">Stok Saat Ini</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($daftarStokKritis as $barang)
                                            <tr>
                                                <td class="ps-4"><code>{{ $barang->kode_barang }}</code></td>
                                                <td>{{ $barang->nama_barang }}</td>
                                                <td>{{ $barang->kategoriBarang->nama_kategori ?? '-' }}</td>
                                                <td class="text-center text-muted">{{ $barang->stok_min }}</td>
                                                <td class="text-center fw-bold">{{ $barang->stok_saat_ini }}</td>
                                                <td class="text-center">
                                                    @if($barang->stok_saat_ini == 0)
                                                        <span class="badge px-3 py-2" style="background-color: #f3616d;">HABIS</span>
                                                    @elseif($barang->stok_saat_ini <= $barang->stok_min)
                                                        <span class="badge px-3 py-2" style="background-color: #f3616d;">KRITIS</span>
                                                    @elseif($barang->stok_saat_ini <= ($barang->stok_min * 1.5))
                                                        <span class="badge px-3 py-2" style="background-color: #eaca4a; color: #fff;">HAMPIR</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- BARIS 4: Tabel Riwayat Transaksi --}}
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold"><i class="fas fa-history text-primary me-2"></i> Riwayat Transaksi Terakhir <span class="text-muted fw-normal small">(Input oleh Kamu)</span></h5>
                        </div>
                        <div class="card-body p-0">
                            @if($riwayatTransaksi->isEmpty())
                                <div class="text-center py-5">
                                    <p class="text-muted">Belum ada transaksi yang kamu input</p>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="ps-4">No. Transaksi</th>
                                                <th class="text-center">Jenis</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($riwayatTransaksi as $trx)
                                            <tr>
                                                <td class="ps-4"><code>{{ $trx->nomor }}</code></td>
                                                <td class="text-center">
                                                    @if($trx->jenis == 'Masuk')
                                                        <span class="badge px-3" style="background-color: #435ebe;">Masuk</span>
                                                    @elseif($trx->jenis == 'Keluar')
                                                        <span class="badge px-3" style="background-color: #f3616d;">Keluar</span>
                                                    @else
                                                        <span class="badge px-3" style="background-color: #eaca4a; color: #fff;">Retur</span>
                                                    @endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d/m/Y') }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @include('petugas.partials.footer')
    </div>
</div>

<script src="{{ asset('dist-dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('dist-dashboard/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist-dashboard/assets/js/main.js') }}"></script>

</body>

</html>