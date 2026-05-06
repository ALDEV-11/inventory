<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Stok Per Barang - SmartStock</title>
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
            <h3>Kartu Stok Per Barang</h3>
            <p class="text-subtitle text-muted">Histori lengkap pergerakan stok per barang</p>
        </div>
        <div class="page-content">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Pilih Barang <span class="text-danger">*</span></label>
                            <select id="id_barang" class="form-select" required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach($barang as $b)
                                    <option value="{{ $b->id_barang }}">{{ $b->kode_barang }} - {{ $b->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="date" id="dari" class="form-control" value="{{ date('Y-m-01') }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Tanggal Selesai <span class="text-danger">*</span></label>
                            <input type="date" id="sampai" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex gap-2">
                                <a href="#" id="btnPreview" class="btn btn-primary flex-fill">
                                    <i class="fas fa-eye me-1"></i> Preview
                                </a>
                                <a href="#" id="btnPdf" class="btn btn-danger flex-fill">
                                    <i class="fas fa-file-pdf me-1"></i> PDF
                                </a>
                                <a href="#" id="btnExcel" class="btn btn-success flex-fill">
                                    <i class="fas fa-file-csv me-1"></i> CSV
                                </a>
                            </div>
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
<script>
    function buildUrl(base) {
        let idBarang = document.getElementById('id_barang').value;
        let dari = document.getElementById('dari').value;
        let sampai = document.getElementById('sampai').value;
        if (!idBarang) { alert('Silakan pilih barang terlebih dahulu!'); return null; }
        if (!dari || !sampai) { alert('Tanggal mulai dan selesai wajib diisi!'); return null; }
        return base + '?id_barang=' + idBarang + '&dari=' + dari + '&sampai=' + sampai;
    }
    document.getElementById('btnPreview').addEventListener('click', function(e) {
        e.preventDefault();
        let url = buildUrl('{{ route("laporan.kartu.preview") }}');
        if (url) window.open(url, '_blank');
    });
    document.getElementById('btnPdf').addEventListener('click', function(e) {
        e.preventDefault();
        let url = buildUrl('{{ route("laporan.kartu.pdf") }}');
        if (url) window.open(url, '_blank');
    });
    document.getElementById('btnExcel').addEventListener('click', function(e) {
        e.preventDefault();
        let url = buildUrl('{{ route("laporan.kartu.excel") }}');
        if (url) window.open(url, '_blank');
    });
</script>
</body>
</html>
