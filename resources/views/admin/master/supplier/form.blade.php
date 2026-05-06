<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($supplier) ? 'Edit' : 'Tambah' }} Supplier - SmartStock</title>

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
                    <h3>{{ isset($supplier) ? 'Edit' : 'Tambah' }} Supplier</h3>
                    <p class="text-subtitle text-muted">Isi formulir untuk {{ isset($supplier) ? 'memperbarui' : 'menambah' }} data penyedia barang</p>
                </div>
                <a href="{{ route('supplier.index') }}" class="btn btn-outline-secondary px-4">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>

        <div class="page-content">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-body p-4">
                            <form action="{{ isset($supplier) ? route('supplier.update', $supplier->id_supplier) : route('supplier.store') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                @if(isset($supplier))
                                    @method('PUT')
                                @endif

                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label fw-bold">Kode Supplier</label>
                                        <input type="text" name="kode_supplier" class="form-control @error('kode_supplier') is-invalid @enderror" 
                                            value="{{ old('kode_supplier', $supplier->kode_supplier ?? '') }}" 
                                            required placeholder="Contoh: SUP-001" maxlength="20">
                                        <div class="invalid-feedback">Masukkan kode supplier.</div>
                                        @error('kode_supplier')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-8 mb-4">
                                        <label class="form-label fw-bold">Nama Perusahaan / Perorangan</label>
                                        <input type="text" name="nama_supplier" class="form-control @error('nama_supplier') is-invalid @enderror" 
                                            value="{{ old('nama_supplier', $supplier->nama_supplier ?? '') }}" 
                                            required maxlength="100">
                                        <div class="invalid-feedback">Masukkan nama supplier.</div>
                                        @error('nama_supplier')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label class="form-label fw-bold">Nomor Telepon</label>
                                        <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" 
                                            value="{{ old('no_telp', $supplier->no_telp ?? '') }}" 
                                            required maxlength="20">
                                        <div class="invalid-feedback">Masukkan nomor telepon.</div>
                                        @error('no_telp')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label class="form-label fw-bold">Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                            value="{{ old('email', $supplier->email ?? '') }}" maxlength="100">
                                        @error('email')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label class="form-label fw-bold">Person in Charge (PIC)</label>
                                        <input type="text" name="pic" class="form-control @error('pic') is-invalid @enderror" 
                                            value="{{ old('pic', $supplier->pic ?? '') }}" maxlength="100">
                                        @error('pic')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-5">
                                        <label class="form-label fw-bold">Alamat Lengkap</label>
                                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required>{{ old('alamat', $supplier->alamat ?? '') }}</textarea>
                                        <div class="invalid-feedback">Masukkan alamat supplier.</div>
                                        @error('alamat')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm">
                                        <i class="fas fa-save me-2"></i> {{ isset($supplier) ? 'Perbarui' : 'Simpan' }}
                                    </button>
                                    <button type="reset" class="btn btn-light px-4 py-2">Reset</button>
                                </div>
                            </form>
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
    // Client-side validation
    (function () {
      'use strict'
      var forms = document.querySelectorAll('.needs-validation')
      Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }
            form.classList.add('was-validated')
          }, false)
        })
    })()
</script>

</body>

</html>
