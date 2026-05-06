<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($lokasi) ? 'Edit' : 'Tambah' }} Lokasi - SmartStock</title>

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
                    <h3>{{ isset($lokasi) ? 'Edit' : 'Tambah' }} Lokasi</h3>
                    <p class="text-subtitle text-muted">Isi formulir untuk {{ isset($lokasi) ? 'memperbarui' : 'menambah' }} data titik penyimpanan</p>
                </div>
                <a href="{{ route('lokasi.index') }}" class="btn btn-outline-secondary px-4">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>

        <div class="page-content">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-body p-4">
                            <form action="{{ isset($lokasi) ? route('lokasi.update', $lokasi->id_lokasi) : route('lokasi.store') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                @if(isset($lokasi))
                                    @method('PUT')
                                @endif

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Kode Rak / Area</label>
                                    <input type="text" name="kode_rak" class="form-control @error('kode_rak') is-invalid @enderror" 
                                        value="{{ old('kode_rak', $lokasi->kode_rak ?? '') }}" 
                                        required placeholder="Contoh: RAK-A1" maxlength="20">
                                    <div class="invalid-feedback">Masukkan kode rak atau area.</div>
                                    @error('kode_rak')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Nama Lokasi</label>
                                    <input type="text" name="nama_lokasi" class="form-control @error('nama_lokasi') is-invalid @enderror" 
                                        value="{{ old('nama_lokasi', $lokasi->nama_lokasi ?? '') }}" 
                                        required maxlength="100">
                                    <div class="invalid-feedback">Masukkan nama lokasi.</div>
                                    @error('nama_lokasi')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-5">
                                    <label class="form-label fw-bold">Deskripsi Tambahan</label>
                                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3">{{ old('deskripsi', $lokasi->deskripsi ?? '') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm">
                                        <i class="fas fa-save me-2"></i> {{ isset($lokasi) ? 'Perbarui' : 'Simpan' }}
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
