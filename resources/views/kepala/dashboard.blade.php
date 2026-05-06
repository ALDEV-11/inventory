<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kepala Gudang</title>

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
        /* --- Summary Cards Gradient --- */
        .card.summary-kepala {
            border: none;
            border-radius: 12px;
            color: #fff;
            transition: none !important;
        }
        .card.summary-kepala:hover { transform: none !important; box-shadow: none !important; }
        
        .bg-solid-green  { background-color: #4fbe87; }
        .bg-solid-red    { background-color: #f3616d; }
        .bg-solid-yellow { background-color: #eaca4a; }

        .summary-kepala .icon-box {
            width: 60px; height: 60px; border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem;
        }

        /* --- Performance Cards --- */
        .card.perf-card {
            border: none;
            border-radius: 12px;
            border-left: 5px solid;
            transition: none !important;
        }
        .card.perf-card.masuk  { border-left-color: #435ebe; }
        .card.perf-card.keluar { border-left-color: #f3616d; }
        .card.perf-card:hover { transform: none !important; box-shadow: none !important; }

        .perf-card .icon-circle {
            width: 48px; height: 48px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
        }

        /* --- Table Styling --- */
        .section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #444;
        }
        .table thead th {
            background-color: #f8f9fa;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            font-weight: 700;
            border: none;
        }
        .badge { font-weight: 700; letter-spacing: 0.3px; }
    </style>
</head>

<body>
<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            @include('partials.sidebar-header')
            @include('kepala.partials.sidebar')
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
                        <h3>Dashboard Kepala Gudang</h3>
                        <p class="text-subtitle text-muted">Akses cepat laporan stok dan approval sistem</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content">
            {{-- BARIS 1: 3 Summary Cards (Solid) --}}
            <div class="row g-4 mb-4">
                {{-- Total Nilai Stok --}}
                <div class="col-lg-4">
                    <div class="card summary-kepala bg-solid-green h-100 shadow-sm">
                        <div class="card-body p-4 d-flex align-items-center gap-3">
                            <div class="icon-box">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0 text-white">Rp {{ number_format($totalNilaiStok, 0, ',', '.') }}</h4>
                                <span class="small opacity-75">Total Nilai Stok Gudang</span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Stok Kritis --}}
                <div class="col-lg-4">
                    <div class="card summary-kepala bg-solid-red h-100 shadow-sm">
                        <div class="card-body p-4 d-flex align-items-center gap-3">
                            <div class="icon-box">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0 text-white">{{ $totalStokKritis }} Item</h4>
                                <span class="small opacity-75">Barang Stok Kritis</span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- PO Pending --}}
                <div class="col-lg-4">
                    <div class="card summary-kepala bg-solid-yellow h-100 shadow-sm">
                        <div class="card-body p-4 d-flex align-items-center gap-3">
                            <div class="icon-box">
                                <i class="fas fa-clock" style="color: #fff;"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0 text-white">{{ $totalPoPending }} PO</h4>
                                <span class="small opacity-75">PO Menunggu Approval</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BARIS 2: 2 Performa Cards (Border-left) --}}
            <div class="row g-4 mb-4">
                {{-- Total Masuk Bulan Ini --}}
                <div class="col-lg-6">
                    <div class="card perf-card masuk shadow-sm h-100">
                        <div class="card-body p-4 d-flex align-items-center gap-3">
                            <div class="icon-circle" style="background-color: rgba(67, 94, 190, 0.1); color: #435ebe;">
                                <i class="fas fa-arrow-down"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0" style="color: #435ebe;">{{ $totalMasukBulanIni }}</h3>
                                <span class="text-muted small">Total transaksi masuk {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Total Keluar Bulan Ini --}}
                <div class="col-lg-6">
                    <div class="card perf-card keluar shadow-sm h-100">
                        <div class="card-body p-4 d-flex align-items-center gap-3">
                            <div class="icon-circle" style="background-color: rgba(243, 97, 109, 0.1); color: #f3616d;">
                                <i class="fas fa-arrow-up"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0" style="color: #f3616d;">{{ $totalKeluarBulanIni }}</h3>
                                <span class="text-muted small">Total transaksi keluar {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BARIS 3: Grafik Tren 6 Bulan --}}
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="section-title mb-0"><i class="fas fa-chart-line text-primary me-2"></i> Tren Mutasi Barang Tahun Ini ({{ date('Y') }})</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="trenChart" height="80"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BARIS 4: 2 Tabel Berdampingan --}}
            <div class="row g-4 mb-4">
                {{-- Tabel PO Menunggu Approval --}}
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 h-100" style="border-radius: 12px;">
                        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                            <h5 class="section-title mb-0"><i class="fas fa-hourglass-half text-warning me-2"></i> PO Menunggu Approval</h5>
                            <a href="{{ url('/approval/po') }}" class="btn btn-sm btn-outline-warning fw-bold">Lihat Semua</a>
                        </div>
                        <div class="card-body p-0">
                            @if($daftarPoPending->isEmpty())
                                <div class="text-center py-5">
                                    <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                                    <p class="text-muted mb-0">Tidak ada PO pending</p>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th class="ps-3">Nomor PO</th>
                                                <th>Supplier</th>
                                                <th>Tanggal</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($daftarPoPending as $po)
                                            <tr>
                                                <td class="ps-3"><code>{{ $po->nomor_po }}</code></td>
                                                <td class="small">{{ $po->supplier->nama_supplier ?? '-' }}</td>
                                                <td class="small">{{ \Carbon\Carbon::parse($po->tanggal)->format('d/m/Y') }}</td>
                                                <td class="text-center">
                                                    @if($po->status == 'draft')
                                                        <a href="{{ url('/approval/po/'.$po->id_masuk) }}" class="btn btn-sm btn-warning px-3 py-1 fw-bold text-white shadow-sm" style="font-size: 0.75rem;">Approve</a>
                                                    @elseif($po->status == 'disetujui')
                                                        <a href="{{ url('/approval/po/'.$po->id_masuk) }}" class="btn btn-sm btn-primary px-3 py-1 fw-bold shadow-sm" style="font-size: 0.75rem;">Terima</a>
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

                {{-- Tabel Daftar Stok Kritis --}}
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 h-100" style="border-radius: 12px;">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="section-title mb-0"><i class="fas fa-exclamation-triangle text-danger me-2"></i> Daftar Stok Kritis</h5>
                        </div>
                        <div class="card-body p-0">
                            @if($daftarStokKritis->isEmpty())
                                <div class="text-center py-5">
                                    <i class="fas fa-shield-check fa-2x text-success mb-2"></i>
                                    <p class="text-muted mb-0">Semua stok aman</p>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th class="ps-3">Nama Barang</th>
                                                <th class="text-center">Stok</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($daftarStokKritis as $barang)
                                            <tr>
                                                <td class="ps-3">
                                                    <span class="fw-semibold d-block">{{ $barang->nama_barang }}</span>
                                                    <span class="text-muted small">{{ $barang->kode_barang }}</span>
                                                </td>
                                                <td class="text-center fw-bold">{{ $barang->stok_saat_ini }}</td>
                                                <td class="text-center">
                                                    @if($barang->stok_saat_ini == 0)
                                                        <span class="badge" style="background-color: #f3616d;">HABIS</span>
                                                    @elseif($barang->stok_saat_ini <= $barang->stok_min)
                                                        <span class="badge" style="background-color: #f3616d;">KRITIS</span>
                                                    @elseif($barang->stok_saat_ini <= ($barang->stok_min * 1.5))
                                                        <span class="badge" style="background-color: #eaca4a; color: #fff;">HAMPIR</span>
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

        </div>

        @include('kepala.partials.footer')
    </div>
</div>

<script src="{{ asset('dist-dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('dist-dashboard/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist-dashboard/assets/js/main.js') }}"></script>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const trenCtx = document.getElementById('trenChart').getContext('2d');
new Chart(trenCtx, {
    type: 'line', // tetap 'line', fill: true yang bikin jadi area
    data: {
        labels: {!! json_encode($chartTren['labels']) !!},
        datasets: [
            {
                label: 'Barang Masuk',
                data: {!! json_encode($chartTren['masuk']) !!},
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13, 110, 253, 0.15)',
                borderWidth: 2.5,
                tension: 0.4,
                fill: true, // ← ini yang bikin jadi area chart
                pointBackgroundColor: '#0d6efd',
                pointRadius: 5,
                pointHoverRadius: 7,
            },
            {
                label: 'Barang Keluar',
                data: {!! json_encode($chartTren['keluar']) !!},
                borderColor: '#dc3545',
                backgroundColor: 'rgba(220, 53, 69, 0.15)',
                borderWidth: 2.5,
                tension: 0.4,
                fill: true, // ← ini yang bikin jadi area chart
                pointBackgroundColor: '#dc3545',
                pointRadius: 5,
                pointHoverRadius: 7,
            }
        ]
    },
    options: {
        responsive: true,
        interaction: {
            mode: 'index',
            intersect: false,
        },
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    usePointStyle: true,
                    padding: 16,
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return ` ${context.dataset.label}: ${context.parsed.y} transaksi`;
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1 },
                grid: { color: 'rgba(0,0,0,.05)' }
            },
            x: {
                grid: { display: false }
            }
        }
    }
});
    });
</script>

</body>

</html>