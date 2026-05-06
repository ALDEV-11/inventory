<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang - SmartStock</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-dashboard/assets/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="shortcut icon" href="{{ asset('dist-dashboard/assets/images/logo/logo.png') }}" type="image/x-icon">

    <style>
        .table thead th {
            background-color: #f8f9fa;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            font-weight: 700;
            border: none;
        }
        .badge { font-weight: 700; }
        .img-thumbnail-custom {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
        }
        .logo img {
            height: 3.5rem !important;
        }
    </style>
</head>

<body>
<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between">
                    <div class="logo">
                        <a href="#"><img src="{{ asset('dist-dashboard/assets/images/logo/smartstock.png') }}" alt="Logo"></a>
                    </div>
                </div>
            </div>
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
                    <h3>Daftar Barang</h3>
                    <p class="text-subtitle text-muted">Kelola data inventaris barang gudang</p>
                </div>
                <a href="{{ route('barang.create') }}" class="btn btn-primary px-4 shadow-sm">
                    <i class="fas fa-plus me-2"></i> Tambah Barang
                </a>
            </div>
        </div>

        <div class="page-content">
            <div class="card shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-body">
                    <form action="{{ route('barang.index') }}" method="GET" class="mb-4">
                        <div class="input-group" style="max-width: 400px;">
                            <input type="text" name="search" id="searchInput" class="form-control border-light-subtle" placeholder="Cari nama atau kode barang..." value="{{ $search }}" autocomplete="off">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    <div id="table-container">
                        <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="ps-3">Gambar</th>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th class="text-center">Stok Saat Ini</th>
                                    <th class="text-center">Stok Min</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-end pe-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($barang as $item)
                                <tr>
                                    <td class="ps-3">
                                        @if($item->gambar)
                                            <img src="{{ asset('storage/' . $item->gambar) }}" class="img-thumbnail-custom border shadow-sm" alt="Gambar">
                                        @else
                                            <div class="img-thumbnail-custom bg-light d-flex align-items-center justify-content-center border">
                                                <i class="fas fa-box text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td><code>{{ $item->kode_barang }}</code></td>
                                    <td class="fw-semibold">{{ $item->nama_barang }}</td>
                                    <td><span class="badge bg-light-primary text-primary">{{ $item->kategoriBarang->nama_kategori ?? '-' }}</span></td>
                                    <td class="text-center fw-bold">{{ $item->stok_saat_ini }}</td>
                                    <td class="text-center text-muted">{{ $item->stok_min }}</td>
                                    <td class="text-center">
                                        @if($item->stok_saat_ini <= $item->stok_min)
                                            <span class="badge bg-danger shadow-sm px-3">KRITIS</span>
                                        @else
                                            <span class="badge bg-success shadow-sm px-3">AMAN</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-3">
                                        <div class="btn-group">
                                            <a href="{{ route('barang.show', $item->id_barang) }}" class="btn btn-sm btn-outline-info" title="Detail"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('barang.edit', $item->id_barang) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('barang.destroy', $item->id_barang) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <p class="text-muted">Tidak ada data barang ditemukan.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    </div>

                    <div class="card-footer bg-white border-0 py-3 mt-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="small text-muted mb-0">Menampilkan {{ $barang->firstItem() ?: 0 }} - {{ $barang->lastItem() ?: 0 }} dari {{ $barang->total() }} data</p>
                            {{ $barang->appends(['search' => $search, 'kategori' => request('kategori'), 'stok' => request('stok')])->onEachSide(1)->links('pagination::bootstrap-5') }}
                        </div>
                    </div>

                    </div> <!-- #table-container -->
                </div> <!-- .card-body -->
            </div> <!-- .card -->
        </div> <!-- .page-content -->

        @php
            $footerView = ($role == 'admin') ? 'admin.partials.footer' : (($role == 'petugas') ? 'petugas.partials.footer' : 'kepala.partials.footer');
        @endphp
        @include($footerView)
    </div>
</div>

<script src="{{ asset('dist-dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('dist-dashboard/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist-dashboard/assets/js/main.js') }}"></script>

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

                // Add a visual 'loading' indicator (optional but premium)
                tableContainer.style.opacity = '0.5';

                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newContent = doc.getElementById('table-container').innerHTML;
                        tableContainer.innerHTML = newContent;
                        tableContainer.style.opacity = '1';
                        
                        // Update the browser URL without reloading
                        window.history.pushState({}, '', url);
                    })
                    .catch(error => {
                        console.error('Error fetching search results:', error);
                        tableContainer.style.opacity = '1';
                    });
            }, 500); // 500ms debounce
        });
    });
</script>

</body>

</html>
