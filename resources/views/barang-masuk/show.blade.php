<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail PO - SmartStock</title>

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
                    <h3>Detail Purchase Order</h3>
                    <p class="text-subtitle text-muted">Nomor PO: <strong>{{ $barangMasuk->nomor_po }}</strong></p>
                </div>
                <a href="{{ route('barang-masuk.index') }}" class="btn btn-outline-secondary px-4 shadow-sm">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>

<div class="page-content">
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible show fade shadow-sm mb-4" style="border-left: 5px solid #4fbe87;">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible show fade shadow-sm mb-4" style="border-left: 5px solid #f3616d;">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Bagian Info Header -->
        <div class="col-md-4 mb-4 mb-md-0">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 12px;">
                <div class="card-body">
                    <h5 class="card-title mb-4"><i class="fas fa-info-circle me-2 text-primary"></i> Informasi PO</h5>
                    
                    <div class="mb-3">
                        <small class="text-muted d-block">Status Saat Ini</small>
                        @if($barangMasuk->status == 'draft')
                            <span class="badge bg-secondary fs-6 mt-1">Draft</span>
                        @elseif($barangMasuk->status == 'disetujui')
                            <span class="badge bg-warning text-dark fs-6 mt-1">Disetujui</span>
                        @elseif($barangMasuk->status == 'diterima')
                            <span class="badge bg-success fs-6 mt-1"><i class="fas fa-check-double me-1"></i> Diterima</span>
                        @else
                            <span class="badge bg-danger fs-6 mt-1">Ditolak</span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Tanggal</small>
                        <span class="fw-bold">{{ \Carbon\Carbon::parse($barangMasuk->tanggal)->format('d F Y') }}</span>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Supplier</small>
                        <span class="fw-bold">{{ $barangMasuk->supplier->nama_supplier ?? '-' }}</span>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Dibuat Oleh</small>
                        <span class="fw-bold">{{ $barangMasuk->user->name ?? '-' }} ({{ $barangMasuk->user->role ?? '-' }})</span>
                    </div>

                    @if($barangMasuk->approvedBy)
                    <div class="mb-3">
                        <small class="text-muted d-block">Disetujui Oleh</small>
                        <span class="fw-bold text-success">{{ $barangMasuk->approvedBy->name }}</span> pada {{ \Carbon\Carbon::parse($barangMasuk->approved_at)->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                    </div>
                    @endif

                    <div class="mb-3">
                        <small class="text-muted d-block">Keterangan</small>
                        <span>{{ $barangMasuk->keterangan ?: '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian List Barang -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 12px;">
                <div class="card-body">
                    <h5 class="card-title mb-4"><i class="fas fa-list me-2 text-primary"></i> Daftar Barang</h5>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th>Barang</th>
                                    <th>Lokasi</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-end">Harga Satuan (Rp)</th>
                                    <th class="text-end">Subtotal (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($barangMasuk->detailBarangMasuk as $detail)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $detail->barang->nama_barang }}</div>
                                        <small class="text-muted">{{ $detail->barang->kode_barang }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">{{ $detail->lokasi->nama_lokasi ?? '-' }}</span>
                                    </td>
                                    <td class="text-center fw-bold">{{ $detail->jumlah }}</td>
                                    <td class="text-end">{{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="text-end fw-bold">{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-light">
                                    <td colspan="4" class="text-end fw-bold">TOTAL NILAI (RP)</td>
                                    <td class="text-end fw-bold text-success fs-5">{{ number_format($barangMasuk->total_nilai, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Action Buttons Based on Role and Status -->
                    <div class="mt-4 border-top pt-4">
                        @if($barangMasuk->status === 'draft' && Gate::allows('approve-po'))
                            <div class="alert alert-info border-0 mb-4 pb-0 pt-3">
                                <p><i class="fas fa-info-circle me-2"></i> PO ini menunggu persetujuan. Setelah disetujui, penerimaan barang dapat dikonfirmasi oleh petugas.</p>
                            </div>
                            <form action="{{ route('barang-masuk.approve', $barangMasuk->id_masuk) }}" method="POST" class="d-inline" onsubmit="return confirm('Setujui Purchase Order ini?')">
                                @csrf
                                <button type="submit" class="btn btn-warning text-dark px-4 py-2 fw-bold shadow-sm">
                                    <i class="fas fa-thumbs-up me-2"></i> Setujui Pesanan
                                </button>
                            </form>
                        @endif

                        @if($barangMasuk->status === 'disetujui' && Gate::allows('receive-po'))
                            <div class="alert alert-warning border-0 mb-4 pb-0 pt-3 text-dark">
                                <p><i class="fas fa-box-open me-2"></i> PO telah disetujui. Konfirmasi penerimaan jika fisik barang sudah sampai. Stok akan bertambah otomatis ke dalam sistem.</p>
                            </div>
                            <form action="{{ route('barang-masuk.receive', $barangMasuk->id_masuk) }}" method="POST" class="d-inline" onsubmit="return confirm('Konfirmasi penerimaan barang? Aksi ini akan menambah stok gudang secara otomatis.')">
                                @csrf
                                <button type="submit" class="btn btn-success px-4 py-2 fw-bold shadow-sm">
                                    <i class="fas fa-check-circle me-2"></i> Konfirmasi Terima Barang
                                </button>
                            </form>
                        @endif

                        @if($barangMasuk->status === 'diterima')
                            <div class="alert alert-success border-0 mb-0">
                                <strong><i class="fas fa-check-double me-2"></i> Tuntas!</strong> Seluruh barang dalam pesanan ini telah diterima dan stok gudang sudah diperbarui.
                            </div>
                        @endif
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

