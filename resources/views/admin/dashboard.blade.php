<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

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
        /* ── Summary Cards ── */
        .summary-card {
            border: none;
            border-radius: 12px;
            /* Disabled hover animations as requested */
        }
        .summary-card .icon-box {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            background: rgba(255,255,255,.2);
        }
        .summary-card .card-body {
            color: #fff;
        }
        .summary-card .number {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1;
        }
        .summary-card .label {
            font-size: .85rem;
            opacity: .9;
        }

        /* ── Transaksi Cards ── */
        .trx-card {
            border: none;
            border-radius: 12px;
            border-left: 5px solid;
            /* Disabled hover animations as requested */
        }
        .trx-card.masuk  { border-color: #0d6efd; }
        .trx-card.keluar { border-color: #dc3545; }
        .trx-card.retur  { border-color: #ffc107; }
        .trx-card .icon-circle {
            width: 52px; height: 52px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
        }
        .trx-card .trx-number {
            font-size: 2rem; font-weight: 800;
        }

        /* ── Alert Cards ── */
        .alert-card { border-radius: 12px; border: none; }

        /* ── Chart Card ── */
        .chart-card { border-radius: 12px; border: none; }

        /* ── Table ── */
        .table th { background: #f8f9fa; font-size:.85rem; white-space: nowrap; }
        .table td { vertical-align: middle; font-size:.9rem; }
        .section-title {
            font-size: 1rem;
            font-weight: 700;
            color: #444;
            border-left: 4px solid #0d6efd;
            padding-left: 10px;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            @include('partials.sidebar-header')
            @include('admin.partials.sidebar')
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
            <h3>Dashboard Admin</h3>
            <p class="text-muted mb-0">Ringkasan aktivitas sistem inventaris hari ini</p>
        </div>

        <div class="page-content">

            
            <div class="row g-3 mb-4">
                {{-- Total Barang --}}
                <div class="col-lg-3 col-md-6">
                    <div class="card summary-card" style="background-color: #56b6f7;">
                        <div class="card-body d-flex align-items-center gap-3 py-4">
                            <div class="icon-box"><i class="fas fa-boxes-stacked"></i></div>
                            <div>
                                <div class="number">{{ $totalBarang }}</div>
                                <div class="label">Total Barang</div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Total Kategori --}}
                <div class="col-lg-3 col-md-6">
                    <div class="card summary-card" style="background-color: #4fbe87;">
                        <div class="card-body d-flex align-items-center gap-3 py-4">
                            <div class="icon-box"><i class="fas fa-tags"></i></div>
                            <div>
                                <div class="number">{{ $totalKategori }}</div>
                                <div class="label">Total Kategori</div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Total Supplier --}}
                <div class="col-lg-3 col-md-6">
                    <div class="card summary-card" style="background-color: #eaca4a;">
                        <div class="card-body d-flex align-items-center gap-3 py-4">
                            <div class="icon-box"><i class="fas fa-truck"></i></div>
                            <div>
                                <div class="number">{{ $totalSupplier }}</div>
                                <div class="label">Total Supplier</div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Total Lokasi --}}
                <div class="col-lg-3 col-md-6">
                    <div class="card summary-card" style="background-color: #f3616d;">
                        <div class="card-body d-flex align-items-center gap-3 py-4">
                            <div class="icon-box"><i class="fas fa-warehouse"></i></div>
                            <div>
                                <div class="number">{{ $totalLokasi }}</div>
                                <div class="label">Total Lokasi / Rak</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="row g-3 mb-4">
                {{-- Barang Masuk --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card trx-card masuk p-3 shadow-sm" style="border-left-color: #435ebe;">
                        <div class="card-body d-flex align-items-center gap-3">
                            <div class="icon-circle bg-opacity-10" style="background-color: rgba(67, 94, 190, 0.1); color: #435ebe;">
                                <i class="fas fa-arrow-down"></i>
                            </div>
                            <div>
                                <div class="trx-number" style="color: #435ebe;">{{ $transaksiMasukHariIni }}</div>
                                <div class="text-muted small fw-semibold">Barang Masuk Hari Ini</div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Barang Keluar --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card trx-card keluar p-3 shadow-sm" style="border-left-color: #f3616d;">
                        <div class="card-body d-flex align-items-center gap-3">
                            <div class="icon-circle bg-opacity-10" style="background-color: rgba(243, 97, 109, 0.1); color: #f3616d;">
                                <i class="fas fa-arrow-up"></i>
                            </div>
                            <div>
                                <div class="trx-number" style="color: #f3616d;">{{ $transaksiKeluarHariIni }}</div>
                                <div class="text-muted small fw-semibold">Barang Keluar Hari Ini</div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Retur --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card trx-card retur p-3 shadow-sm" style="border-left-color: #eaca4a;">
                        <div class="card-body d-flex align-items-center gap-3">
                            <div class="icon-circle bg-opacity-10" style="background-color: rgba(234, 202, 74, 0.1); color: #eaca4a;">
                                <i class="fas fa-undo"></i>
                            </div>
                            <div>
                                <div class="trx-number" style="color: #eaca4a;">{{ $returHariIni }}</div>
                                <div class="text-muted small fw-semibold">Retur Hari Ini</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                {{-- Stok Kritis --}}
                <div class="col-lg-6">
                    <div class="card alert-card text-white" style="background-color: #f3616d;">
                        <div class="card-body d-flex align-items-center gap-3 py-4">
                            <div class="icon-box" style="background:rgba(255,255,255,.2);width:56px;height:56px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.5rem;">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div>
                                <div style="font-size:2rem;font-weight:800;line-height:1;">{{ $totalStokKritis }}</div>
                                <div style="font-size:.9rem;opacity:.9;">Barang dengan Stok Kritis</div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- PO Pending --}}
                <div class="col-lg-6">
                    <div class="card alert-card text-white" style="background-color: #eaca4a;">
                        <div class="card-body d-flex align-items-center gap-3 py-4">
                            <div class="icon-box" style="background:rgba(255,255,255,.2);width:56px;height:56px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.5rem;">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <div style="font-size:2rem;font-weight:800;line-height:1;">{{ $totalPoPending }}</div>
                                <div style="font-size:.9rem;opacity:.9;">PO Menunggu Persetujuan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-lg-8">
                    <div class="card chart-card h-100 shadow-sm border">
                        <div class="card-header bg-white border-0 pb-0">
                            <h6 class="section-title mb-0"><i class="fas fa-chart-line me-2" style="color: #435ebe;"></i> Mutasi Barang 7 Hari Terakhir</h6>
                        </div>
                        <div class="card-body">
                            <canvas id="mutasiChart" height="100"></canvas>
                        </div>
                    </div>
                </div>
                {{-- Bar Chart: Top 5 Barang Keluar --}}
                <div class="col-lg-4">
                    <div class="card chart-card h-100 shadow-sm border">
                        <div class="card-header bg-white border-0 pb-0">
                            <h6 class="section-title mb-0"><i class="fas fa-trophy me-2 text-warning"></i> Top 5 Barang Keluar Bulan Ini</h6>
                        </div>
                        <div class="card-body">
                            <canvas id="topBarangChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-lg-12">
                    <div class="card chart-card shadow-sm border">
                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                            <h6 class="section-title mb-0"><i class="fas fa-triangle-exclamation me-2" style="color: #f3616d;"></i> Daftar Barang Stok Kritis</h6>
                            <a href="{{ url('/barang') }}" class="btn btn-sm btn-outline-danger" style="color: #f3616d; border-color: #f3616d;">Lihat Semua</a>
                        </div>
                        <div class="card-body p-0">
                            @if($daftarStokKritis->isEmpty())
                                <div class="text-center text-success py-4">
                                    <i class="fas fa-circle-check fa-2x mb-2" style="color: #4fbe87;"></i>
                                    <p class="mb-0 fw-semibold">Semua stok aman</p>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Kategori</th>
                                                <th class="text-center">Stok Min</th>
                                                <th class="text-center">Stok Saat Ini</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($daftarStokKritis as $b)
                                            <tr>
                                                <td><code>{{ $b->kode_barang }}</code></td>
                                                <td>{{ $b->nama_barang }}</td>
                                                <td>{{ $b->kategoriBarang->nama_kategori ?? '-' }}</td>
                                                <td class="text-center">{{ $b->stok_min }}</td>
                                                <td class="text-center fw-bold">{{ $b->stok_saat_ini }}</td>
                                                <td class="text-center">
                                                    @if($b->stok_saat_ini == 0)
                                                        <span class="badge" style="background-color: #f3616d;">HABIS</span>
                                                    @elseif($b->stok_saat_ini <= $b->stok_min)
                                                        <span class="badge" style="background-color: #f3616d;">KRITIS</span>
                                                    @elseif($b->stok_saat_ini <= $b->stok_min * 1.5)
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

            <div class="row g-3 mb-4">
                <div class="col-lg-6">
                    <div class="card chart-card h-100 shadow-sm border">
                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                            <h6 class="section-title mb-0"><i class="fas fa-list-check me-2" style="color: #eaca4a;"></i> PO Menunggu Approval</h6>
                            <a href="{{ url('/barang-masuk') }}" class="btn btn-sm btn-outline-warning" style="color: #eaca4a; border-color: #eaca4a;">Lihat Semua</a>
                        </div>
                        <div class="card-body p-0">
                            @if($daftarPoPending->isEmpty())
                                <div class="text-center text-success py-4">
                                    <i class="fas fa-circle-check fa-2x mb-2" style="color: #4fbe87;"></i>
                                    <p class="mb-0 fw-semibold">Tidak ada PO pending</p>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Nomor PO</th>
                                                <th>Supplier</th>
                                                <th>Tanggal</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($daftarPoPending as $po)
                                            <tr>
                                                <td><code>{{ $po->nomor_po }}</code></td>
                                                <td>{{ $po->supplier->nama_supplier ?? '-' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($po->tanggal)->format('d/m/Y') }}</td>
                                                <td class="text-center">
                                                    @if($po->status === 'draft')
                                                        <span class="badge" style="background-color: #eaca4a; color: #fff;">Draft</span>
                                                    @elseif($po->status === 'disetujui')
                                                        <span class="badge" style="background-color: #435ebe;">Disetujui</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ ucfirst($po->status) }}</span>
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

                {{-- Tabel Transaksi Terbaru --}}
                <div class="col-lg-6">
                    <div class="card chart-card h-100 shadow-sm border">
                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                            <h6 class="section-title mb-0"><i class="fas fa-clock-rotate-left me-2" style="color: #435ebe;"></i> Transaksi Terbaru</h6>
                            <a href="{{ url('/barang-keluar') }}" class="btn btn-sm btn-outline-primary" style="color: #435ebe; border-color: #435ebe;">Lihat Semua</a>
                        </div>
                        <div class="card-body p-0">
                            @if($transaksiTerbaru->isEmpty())
                                <div class="text-center text-muted py-4">
                                    <p class="mb-0">Belum ada transaksi.</p>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>No. Transaksi</th>
                                                <th class="text-center">Jenis</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($transaksiTerbaru as $trx)
                                            <tr>
                                                <td><code>{{ $trx->nomor }}</code></td>
                                                <td class="text-center">
                                                    @if($trx->jenis === 'Masuk')
                                                        <span class="badge" style="background-color: #435ebe;">Masuk</span>
                                                    @elseif($trx->jenis === 'Keluar')
                                                        <span class="badge" style="background-color: #f3616d;">Keluar</span>
                                                    @else
                                                        <span class="badge" style="background-color: #eaca4a; color: #fff;">Retur</span>
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

        </div>{{-- end page-content --}}

        @include('admin.partials.footer')
    </div>{{-- end #main --}}
</div>{{-- end #app --}}

<script src="{{ asset('dist-dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('dist-dashboard/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist-dashboard/assets/js/main.js') }}"></script>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
    // ── Line Chart: Mutasi 7 Hari Terakhir ──────────────────────────────
    const mutasiCtx = document.getElementById('mutasiChart').getContext('2d');
    new Chart(mutasiCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartMutasi['labels']) !!},
            datasets: [
                {
                    label: 'Barang Masuk',
                    data: {!! json_encode($chartMutasi['masuk']) !!},
                    borderColor: '#435ebe',
                    backgroundColor: 'rgba(67, 94, 190, 0.1)',
                    borderWidth: 2.5,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#435ebe',
                    pointRadius: 4,
                },
                {
                    label: 'Barang Keluar',
                    data: {!! json_encode($chartMutasi['keluar']) !!},
                    borderColor: '#f3616d',
                    backgroundColor: 'rgba(243, 97, 109, 0.1)',
                    borderWidth: 2.5,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#f3616d',
                    pointRadius: 4,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 },
                    grid: { color: 'rgba(0,0,0,.05)' }
                },
                x: { grid: { display: false } }
            }
        }
    });

    // ── Bar Chart: Top 5 Barang Keluar Bulan Ini ────────────────────────
    const topCtx = document.getElementById('topBarangChart').getContext('2d');
new Chart(topCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($chartTopBarang['labels']) !!},
        datasets: [{
            label: 'Qty Keluar',
            data: {!! json_encode($chartTopBarang['data']) !!},
            backgroundColor: [
                'rgba(79, 190, 135, 0.85)',
                'rgba(13, 110, 253, 0.85)',
                'rgba(220, 53, 69, 0.85)',
                'rgba(255, 193, 7, 0.85)',
                'rgba(111, 66, 193, 0.85)',
            ],
            borderColor: [
                '#4fbe87',
                '#0d6efd',
                '#dc3545',
                '#ffc107',
                '#6f42c1',
            ],
            borderWidth: 2,
            hoverOffset: 8,
        }]
    },
    options: {
        responsive: true,
        cutout: '64%',
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    padding: 16,
                    font: { size: 12 },
                    usePointStyle: true,
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const pct = ((context.parsed / total) * 100).toFixed(1);
                        return ` ${context.label}: ${context.parsed} (${pct}%)`;
                    }
                }
            }
        }
    }
});
</script>
</body>

</html>