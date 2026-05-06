<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Retur Barang - SmartStock</title>

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
                    <h3>Detail Retur Barang</h3>
                    <p class="text-subtitle text-muted">Nomor Dokumen: <strong>{{ $returBarang->nomor_retur }}</strong></p>
                </div>
                <a href="{{ route('retur-barang.index') }}" class="btn btn-outline-secondary px-4 shadow-sm">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>

<div class="page-content">
    
    <div class="row">
        <!-- Bagian Info Header -->
        <div class="col-md-4 mb-4 mb-md-0">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 12px;">
                <div class="card-body">
                    <h5 class="card-title mb-4"><i class="fas fa-info-circle me-2 text-primary"></i> Informasi Retur</h5>
                    
                    <div class="mb-3">
                        <small class="text-muted d-block">Tanggal</small>
                        <span class="fw-bold">{{ \Carbon\Carbon::parse($returBarang->tanggal)->format('d F Y') }}</span>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Jenis Retur</small>
                        @if($returBarang->jenis == 'Dari Pelanggan')
                            <span class="badge bg-light-success text-success fs-6"><i class="fas fa-arrow-down me-1"></i> Dari Pelanggan</span>
                            <small class="d-block text-muted mt-1">(Stok Dikembalikan ke Gudang)</small>
                        @else
                            <span class="badge bg-light-danger text-danger fs-6"><i class="fas fa-arrow-up me-1"></i> Ke Supplier</span>
                            <small class="d-block text-muted mt-1">(Stok Dikeluarkan dari Gudang)</small>
                        @endif
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Dicatat Oleh</small>
                        <span class="fw-bold"><i class="fas fa-user-circle text-muted me-1"></i> {{ $returBarang->user->name ?? '-' }} ({{ $returBarang->user->role ?? '-' }})</span>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Alasan / Keterangan</small>
                        <span class="text-break">{{ $returBarang->alasan ?: '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian List Barang -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 12px;">
                <div class="card-body">
                    <h5 class="card-title mb-4"><i class="fas fa-boxes me-2 text-primary"></i> Rincian Item Retur</h5>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th>Barang</th>
                                    <th class="text-center">Jumlah Barang</th>
                                    <th class="text-end">Estimasi Harga (Rp)</th>
                                    <th class="text-end">Subtotal (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($returBarang->detailRetur as $detail)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $detail->barang->nama_barang }}</div>
                                        <small class="text-muted">{{ $detail->barang->kode_barang }}</small>
                                    </td>
                                    <td class="text-center fw-bold fs-5">
                                        {{ $detail->jumlah }}
                                        @if($returBarang->jenis == 'Dari Pelanggan')
                                            <span class="text-success ms-1"><i class="fas fa-level-up-alt"></i></span>
                                        @else
                                            <span class="text-danger ms-1"><i class="fas fa-level-down-alt"></i></span>
                                        @endif
                                    </td>
                                    <td class="text-end">{{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="text-end fw-bold">{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-light">
                                    <td colspan="3" class="text-end fw-bold">TOTAL NILAI (RP)</td>
                                    <td class="text-end fw-bold text-dark fs-5">{{ number_format($returBarang->total_nilai, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
    
    @include('admin.partials.footer')
</div>

<script src="{{ asset('dist-dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('dist-dashboard/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist-dashboard/assets/js/main.js') }}"></script>

</body>
</html>
