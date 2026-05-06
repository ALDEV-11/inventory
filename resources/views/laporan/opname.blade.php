<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Stok Opname - SmartStock</title>
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
            <h3>Laporan Stok Opname</h3>
            <p class="text-subtitle text-muted">Snapshot stok seluruh barang saat ini</p>
        </div>
        <div class="page-content">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Kategori <small class="text-muted">(opsional)</small></label>
                            <select id="id_kategori" class="form-select">
                                <option value="">Semua Kategori</option>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex gap-2">
                                <a href="#" id="btnPreview" class="btn btn-primary flex-fill">
                                    <i class="fas fa-eye me-1"></i> Preview
                                </a>
                                <a href="#" id="btnPdf" class="btn btn-danger flex-fill">
                                    <i class="fas fa-file-pdf me-1"></i> Download PDF
                                </a>
                                <a href="#" id="btnExcel" class="btn btn-success flex-fill">
                                    <i class="fas fa-file-csv me-1"></i> Download CSV
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
        let kat = document.getElementById('id_kategori').value;
        let url = base;
        if (kat) url += '?id_kategori=' + kat;
        return url;
    }
    document.getElementById('btnPreview').addEventListener('click', function(e) {
        e.preventDefault();
        window.open(buildUrl('{{ route("laporan.opname.preview") }}'), '_blank');
    });
    document.getElementById('btnPdf').addEventListener('click', function(e) {
        e.preventDefault();
        window.open(buildUrl('{{ route("laporan.opname.pdf") }}'), '_blank');
    });
    document.getElementById('btnExcel').addEventListener('click', function(e) {
        e.preventDefault();
        window.open(buildUrl('{{ route("laporan.opname.excel") }}'), '_blank');
    });
</script>
</body>
</html>
