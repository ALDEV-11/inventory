<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Barang - SmartStock</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .section-title { font-weight: 700; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px; margin-bottom: 20px; }
        .info-label { color: #888; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .info-value { font-weight: 600; color: #333; }
        .badge { font-weight: 700; }
    </style>
</head>

<body>
<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            @include('partials.sidebar-header')
            @php
                $role = Auth::user()->role;
                $sidebarView = ($role == 'admin') ? 'admin.partials.sidebar' : (($role == 'petugas') ? 'petugas.partials.sidebar' : 'kepala.partials.sidebar');
            @endphp
            @include($sidebarView)
        </div>
    </div>

    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>Detail Barang</h3>
                    <p class="text-subtitle text-muted">Informasi lengkap dan histori transaksi barang</p>
                </div>
                <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary px-4">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>

        <div class="page-content">
            <div class="row">
                {{-- Detail Card --}}
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 h-100" style="border-radius: 12px;">
                        <div class="card-body p-4 text-center">
                            @if($barang->gambar)
                                <img src="{{ asset('storage/'.$barang->gambar) }}" class="img-fluid rounded shadow-sm mb-4" style="max-height: 250px; width: 100%; object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center mb-4" style="height: 250px;">
                                    <i class="fas fa-box fa-4x text-muted"></i>
                                </div>
                            @endif
                            <h4 class="fw-bold mb-1">{{ $barang->nama_barang }}</h4>
                            <p class="text-muted small"><code>{{ $barang->kode_barang }}</code></p>
                            <div class="d-flex justify-content-center gap-2 mb-4">
                                <span class="badge bg-light-primary text-primary px-3">{{ $barang->kategoriBarang->nama_kategori ?? 'Tanpa Kategori' }}</span>
                                @if($barang->stok_saat_ini <= $barang->stok_min)
                                    <span class="badge bg-danger shadow-sm px-3">KRITIS</span>
                                @else
                                    <span class="badge bg-success shadow-sm px-3">AMAN</span>
                                @endif
                            </div>
                            <hr>
                            <div class="row text-start mt-3">
                                <div class="col-6 mb-3">
                                    <p class="info-label mb-0">Stok Saat Ini</p>
                                    <p class="info-value mb-0">{{ $barang->stok_saat_ini }} {{ $barang->satuan }}</p>
                                </div>
                                <div class="col-6 mb-3">
                                    <p class="info-label mb-0">Stok Minimal</p>
                                    <p class="info-value mb-0">{{ $barang->stok_min }} {{ $barang->satuan }}</p>
                                </div>
                                <div class="col-6 mb-3">
                                    <p class="info-label mb-0">Harga Beli</p>
                                    <p class="info-value mb-0">Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</p>
                                </div>
                                <div class="col-6 mb-3">
                                    <p class="info-label mb-0">Harga Jual</p>
                                    <p class="info-value mb-0">Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('barang.edit', $barang->id_barang) }}" class="btn btn-warning w-100 fw-bold mb-2 shadow-sm">
                                    <i class="fas fa-edit me-2"></i> Edit Barang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- History Table --}}
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 h-100" style="border-radius: 12px;">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="section-title mb-0"><i class="fas fa-history text-muted me-2"></i> Histori Transaksi</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4">No. Transaksi</th>
                                            <th>Tanggal</th>
                                            <th class="text-center">Jenis</th>
                                            <th class="text-end pe-4">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($history as $item)
                                        <tr>
                                            <td class="ps-4"><code>{{ $item->nomor }}</code></td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                            <td class="text-center">
                                                @if($item->jenis == 'Masuk')
                                                    <span class="badge bg-primary px-3">Masuk</span>
                                                @elseif($item->jenis == 'Keluar')
                                                    <span class="badge bg-danger px-3">Keluar</span>
                                                @else
                                                    <span class="badge bg-warning text-dark px-3">Retur</span>
                                                @endif
                                            </td>
                                            <td class="text-end pe-4">
                                                <span class="fw-bold {{ $item->jenis == 'Masuk' ? 'text-success' : ($item->jenis == 'Keluar' ? 'text-danger' : 'text-warning') }}">
                                                    {{ $item->jenis == 'Masuk' ? '+' : '-' }} {{ $item->jumlah }}
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5">
                                                <p class="text-muted">Belum ada histori transaksi untuk barang ini.</p>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php
            $footerView = ($role == 'admin') ? 'admin.partials.footer' : (($role == 'petugas') ? 'petugas.partials.footer' : 'kepala.partials.footer');
        @endphp
        @include($footerView)
    </div>
</div>

<script src="{{ asset('dist-dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('dist-dashboard/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist-dashboard/assets/js/main.js') }}"></script>

</body>

</html>
