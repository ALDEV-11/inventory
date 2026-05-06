<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Kategori Barang - SmartStock</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            @include('partials.sidebar-header')
            @include('admin.partials.sidebar')
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
                    <h3>Master Kategori Barang</h3>
                    <p class="text-subtitle text-muted">Kelola kategori untuk pengelompokan barang</p>
                </div>
                <a href="{{ route('kategori-barang.create') }}" class="btn btn-primary px-4 py-2 shadow-sm fw-bold">
                    <i class="fas fa-plus me-2"></i> Tambah Kategori
                </a>
            </div>
        </div>

        <div class="page-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible show fade shadow-sm border-0 mb-4" style="border-left: 5px solid #4fbe87 !important;">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible show fade shadow-sm border-0 mb-4" style="border-left: 5px solid #f3616d !important;">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-header bg-white border-0 py-3">
                    <form action="{{ route('kategori-barang.index') }}" method="GET" class="row g-2">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-search text-muted"></i></span>
                                <input type="text" name="search" id="searchInput" class="form-control bg-light border-0" placeholder="Cari nama atau deskripsi..." value="{{ $search }}" autocomplete="off">
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
                                    <th class="ps-4">No</th>
                                    <th>Nama Kategori</th>
                                    <th>Deskripsi</th>
                                    <th class="text-end pe-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kategori as $index => $item)
                                <tr>
                                    <td class="ps-4 text-muted small">{{ $kategori->firstItem() + $index }}</td>
                                    <td><span class="fw-bold text-dark">{{ $item->nama_kategori }}</span></td>
                                    <td><span class="text-muted">{{ Str::limit($item->deskripsi, 50) ?: '-' }}</span></td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group">
                                            <a href="{{ route('kategori-barang.edit', $item->id_kategori) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete" 
                                                data-id="{{ $item->id_kategori }}" 
                                                data-name="{{ $item->nama_kategori }}"
                                                title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="py-3">
                                            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">Tidak ada data kategori ditemukan.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="small text-muted mb-0">Menampilkan {{ $kategori->firstItem() ?: 0 }} - {{ $kategori->lastItem() ?: 0 }} dari {{ $kategori->total() }} data</p>
                        {{ $kategori->appends(['search' => $search])->onEachSide(1)->links('pagination::bootstrap-5') }}
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.partials.footer')
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 12px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <div class="text-center mb-3">
                    <i class="fas fa-exclamation-triangle fa-3x text-danger opacity-25"></i>
                </div>
                <p class="text-center mb-0">Apakah Anda yakin ingin menghapus kategori <span id="deleteItemName" class="fw-bold text-danger"></span>?</p>
                <p class="text-muted small text-center">Data yang dihapus tidak dapat dikembalikan jika tidak ada backup.</p>
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-center pb-4">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-light px-4 py-2" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger px-4 py-2 fw-bold shadow-sm">Hapus Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('dist-dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('dist-dashboard/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist-dashboard/assets/js/main.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const tableContainer = document.getElementById('table-container');
        let timeout = null;

        searchInput.addEventListener('input', function() {
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                const searchValue = searchInput.value;
                const url = new URL(window.location.href);
                url.searchParams.set('search', searchValue);
                url.searchParams.delete('page'); // Reset to page 1 on search

                tableContainer.style.opacity = '0.5';

                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newContent = doc.getElementById('table-container').innerHTML;
                        tableContainer.innerHTML = newContent;
                        tableContainer.style.opacity = '1';
                        
                        window.history.pushState({}, '', url);
                    })
                    .catch(error => {
                        console.error('Error fetching search results:', error);
                        tableContainer.style.opacity = '1';
                    });
            }, 500); 
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.btn-delete').on('click', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const url = "{{ route('kategori-barang.destroy', ':id') }}".replace(':id', id);
            
            $('#deleteItemName').text(name);
            $('#deleteForm').attr('action', url);
            $('#deleteModal').modal('show');
        });
    });
</script>

</body>

</html>
