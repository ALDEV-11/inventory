<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($barang) ? 'Edit' : 'Tambah' }} Barang - SmartStock</title>

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
                    <h3>{{ isset($barang) ? 'Edit' : 'Tambah' }} Barang</h3>
                    <p class="text-subtitle text-muted">Isi formulir untuk {{ isset($barang) ? 'memperbarui' : 'menambah' }} data barang</p>
                </div>
                <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary px-4">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>

        <div class="page-content">
            <div class="card shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <form action="{{ isset($barang) ? route('barang.update', $barang->id_barang) : route('barang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($barang))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Kode Barang</label>
                                <input type="text" name="kode_barang" class="form-control @error('kode_barang') is-invalid @enderror" placeholder="Biarkan kosong untuk auto-generate" value="{{ old('kode_barang', $barang->kode_barang ?? '') }}">
                                @error('kode_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Kategori Barang</label>
                                <select name="id_kategori" class="form-select @error('id_kategori') is-invalid @enderror">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategori as $kat)
                                        <option value="{{ $kat->id_kategori }}" {{ (old('id_kategori', $barang->id_kategori ?? '') == $kat->id_kategori) ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                @error('id_kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-8 mb-3">
                                <label class="form-label fw-bold">Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" value="{{ old('nama_barang', $barang->nama_barang ?? '') }}" required>
                                @error('nama_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Satuan</label>
                                <input type="text" name="satuan" class="form-control @error('satuan') is-invalid @enderror" placeholder="Pcs, Box, Rim, dll" value="{{ old('satuan', $barang->satuan ?? '') }}" required>
                                @error('satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Harga Beli</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga_beli" class="form-control @error('harga_beli') is-invalid @enderror" value="{{ old('harga_beli', $barang->harga_beli ?? '') }}" min="0" required>
                                </div>
                                @error('harga_beli')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Harga Jual</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror" value="{{ old('harga_jual', $barang->harga_jual ?? '') }}" min="0" required>
                                </div>
                                @error('harga_jual')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Stok Minimal</label>
                                <input type="number" name="stok_min" class="form-control @error('stok_min') is-invalid @enderror" value="{{ old('stok_min', $barang->stok_min ?? '0') }}" min="0" required>
                                @error('stok_min')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Stok Saat Ini (Read-Only)</label>
                                <input type="number" class="form-control bg-light" value="{{ $barang->stok_saat_ini ?? '0' }}" readonly>
                                <small class="text-muted italic">*Stok hanya berubah via transaksi</small>
                            </div>
                            <div class="col-12 mb-4">
                                <label class="form-label fw-bold">Gambar Barang</label>
                                <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
                                @if(isset($barang) && $barang->gambar)
                                    <div class="mt-2 text-center">
                                        <p class="small text-muted mb-1">Gambar Saat Ini:</p>
                                        <img src="{{ asset('storage/'.$barang->gambar) }}" class="img-thumbnail" style="max-height: 150px;">
                                    </div>
                                @endif
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm">
                                <i class="fas fa-save me-2"></i> {{ isset($barang) ? 'Perbarui' : 'Simpan' }}
                            </button>
                            <button type="reset" class="btn btn-light px-4 py-2">Reset</button>
                        </div>
                    </form>
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
