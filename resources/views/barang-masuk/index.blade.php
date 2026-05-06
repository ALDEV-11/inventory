
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Order (Barang Masuk) - SmartStock</title>

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
                    <h3>Purchase Order (Barang Masuk)</h3>
                    <p class="text-subtitle text-muted">Kelola penerimaan barang dari supplier</p>
                </div>
                <a href="{{ route('barang-masuk.create') }}" class="btn btn-primary px-4 py-2 shadow-sm fw-bold">
                    <i class="fas fa-plus me-2"></i> Buat PO Baru
                </a>
            </div>
        </div>

<div class="page-content">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible show fade shadow-sm" style="border-left: 5px solid #4fbe87;">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible show fade shadow-sm" style="border-left: 5px solid #f3616d;">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0" style="border-radius: 12px;">
        <div class="card-header bg-white border-0 py-3">
            <form action="{{ route('barang-masuk.index') }}" method="GET" class="row g-2">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" id="searchInput" class="form-control bg-light border-0" placeholder="Cari No. PO atau Supplier..." value="{{ $search }}" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary px-4">Filter</button>
                </div>
            </form>
        </div>

        <div id="table-container">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>No. PO</th>
                                <th>Tanggal</th>
                                <th>Supplier</th>
                                <th>Total Nilai</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($barangMasuk as $item)
                            <tr>
                                <td><span class="fw-bold">{{ $item->nomor_po }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                <td>{{ $item->supplier->nama_supplier ?? '-' }}</td>
                                <td>Rp {{ number_format($item->total_nilai, 0, ',', '.') }}</td>
                                <td>
                                    @if($item->status == 'draft')
                                        <span class="badge bg-secondary">Draft</span>
                                    @elseif($item->status == 'disetujui')
                                        <span class="badge bg-warning text-dark">Disetujui</span>
                                    @elseif($item->status == 'diterima')
                                        <span class="badge bg-success">Diterima</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('barang-masuk.show', $item->id_masuk) }}" class="btn btn-sm btn-outline-info" title="Detail"><i class="fas fa-eye"></i> Detail</a>
                                    @if($item->status == 'draft')
                                        <form action="{{ route('barang-masuk.destroy', $item->id_masuk) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus PO ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Belum ada data Purchase Order.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white border-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="small text-muted mb-0">Menampilkan {{ $barangMasuk->firstItem() ?: 0 }} - {{ $barangMasuk->lastItem() ?: 0 }} dari {{ $barangMasuk->total() }} data</p>
                    {{ $barangMasuk->appends(['search' => $search])->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.partials.footer')
 
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const tableContainer = document.getElementById('table-container');
        let timeout = null;

        searchInput.addEventListener('input', function() {
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                const url = new URL(window.location.href);
                url.searchParams.set('search', searchInput.value);
                url.searchParams.delete('page');

                tableContainer.style.opacity = '0.5';

                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        const doc = new DOMParser().parseFromString(html, 'text/html');
                        tableContainer.innerHTML = doc.getElementById('table-container').innerHTML;
                        tableContainer.style.opacity = '1';
                        window.history.pushState({}, '', url);
                    });
            }, 500);
        });
    });
</script>
        </div>
    </div>
    
</div>

<script src="{{ asset('dist-dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('dist-dashboard/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist-dashboard/assets/js/main.js') }}"></script>

</body>
</html>

