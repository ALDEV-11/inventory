<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Barang Keluar - SmartStock</title>

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
                    <h3>Input Barang Keluar</h3>
                    <p class="text-subtitle text-muted">Catat pengeluaran barang ke tujuan</p>
                </div>
                <a href="{{ route('barang-keluar.index') }}" class="btn btn-outline-secondary px-4 shadow-sm">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>

<div class="page-content">

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible show fade shadow-sm mb-4" style="border-left: 5px solid #f3616d;">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('barang-keluar.store') }}" method="POST" id="bkForm">
        @csrf
        
        <!-- Header PO -->
        <div class="card shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h5 class="card-title mb-0"><i class="fas fa-file-export me-2 text-primary"></i> Data Keluar</h5>
            </div>
            <div class="card-body mt-3">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Nomor Keluar</label>
                        <input type="text" name="nomor_keluar" class="form-control bg-light" value="{{ $nomorKeluar }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Tujuan / Tujuan Proyek <span class="text-danger">*</span></label>
                        <input type="text" name="tujuan" class="form-control" placeholder="Contoh: Unit Produksi A" value="{{ old('tujuan') }}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="2" placeholder="Alasan dikeluarkan...">{{ old('keterangan') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Barang -->
        <div class="card shadow-sm" style="border-radius: 12px;">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h5 class="card-title mb-0"><i class="fas fa-boxes me-2 text-primary"></i> Item Barang</h5>
            </div>
            <div class="card-body mt-3">
                <div class="table-responsive" style="overflow-x: visible;">
                    <table class="table table-bordered align-middle" id="detailTable">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 35%">Barang</th>
                                <th style="width: 15%">Stok Tersedia</th>
                                <th style="width: 15%">Jumlah <span class="text-danger">*</span></th>
                                <th style="width: 20%">Harga Satuan (Rp)</th>
                                <th style="width: 10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="detailBody">
                            <tr class="detail-row">
                                <td>
                                    <select name="details[0][id_barang]" class="form-select barang-select pe-5" required>
                                        <option value="">Pilih Barang...</option>
                                        @foreach($barang as $brg)
                                            <option value="{{ $brg->id_barang }}">{{ $brg->kode_barang }} - {{ $brg->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <span class="stok-display badge bg-secondary text-white p-2 d-block w-100 text-center">-</span>
                                </td>
                                <td>
                                    <input type="number" name="details[0][jumlah]" class="form-control text-center jumlah-input" min="1" value="1" required>
                                    <small class="text-danger error-stok d-none d-block mt-1">Stok tidak cukup!</small>
                                </td>
                                <td>
                                    <input type="number" name="details[0][harga_satuan]" class="form-control harga-input" min="0" step="0.01" required>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger btn-remove shadow-sm" disabled><i class="fas fa-times"></i></button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-start border-0 pt-3">
                                    <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3" id="btnAddRow">
                                        <i class="fas fa-plus me-1"></i> Tambah Baris
                                    </button>
                                </td>
                            </tr>
                            <tr class="bg-light mt-2">
                                <td colspan="3" class="text-end fw-bold">Total Nilai (Rp)</td>
                                <td colspan="2" class="fw-bold text-success fs-5 p-3" id="grandTotal">0</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-5 py-2 shadow-sm fw-bold border-0" id="btnSubmit">
                        <i class="fas fa-save me-2"></i> Proses Pengeluaran
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Template for new hidden row -->
<template id="rowTemplate">
    <tr class="detail-row">
        <td>
            <select name="details[__INDEX__][id_barang]" class="form-select barang-select pe-5" required>
                <option value="">Pilih Barang...</option>
                @foreach($barang as $brg)
                    <option value="{{ $brg->id_barang }}">{{ $brg->kode_barang }} - {{ $brg->nama_barang }}</option>
                @endforeach
            </select>
        </td>
        <td>
            <span class="stok-display badge bg-secondary text-white p-2 d-block w-100 text-center">-</span>
        </td>
        <td>
            <input type="number" name="details[__INDEX__][jumlah]" class="form-control text-center jumlah-input" min="1" value="1" required>
            <small class="text-danger error-stok d-none d-block mt-1">Stok tidak cukup!</small>
        </td>
        <td>
            <input type="number" name="details[__INDEX__][harga_satuan]" class="form-control harga-input" min="0" step="0.01" required>
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-sm btn-danger btn-remove shadow-sm"><i class="fas fa-times"></i></button>
        </td>
    </tr>
</template>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let rowIndex = 1;
        
        function calculateTotal() {
            let total = 0;
            let formValid = true;

            document.querySelectorAll('.detail-row').forEach(row => {
                const jumlahInput = row.querySelector('.jumlah-input');
                const hargaInput = row.querySelector('.harga-input');
                const errorHelp = row.querySelector('.error-stok');
                const stokBadge = row.querySelector('.stok-display');
                
                const jumlah = parseFloat(jumlahInput.value) || 0;
                const harga = parseFloat(hargaInput.value) || 0;
                const maxStok = parseFloat(stokBadge.getAttribute('data-stok')) || 0;

                total += jumlah * harga;

                // Validate if selected an item
                if (stokBadge.getAttribute('data-stok') !== null) {
                    if (jumlah > maxStok) {
                        jumlahInput.classList.add('is-invalid');
                        errorHelp.classList.remove('d-none');
                        formValid = false;
                    } else {
                        jumlahInput.classList.remove('is-invalid');
                        errorHelp.classList.add('d-none');
                    }
                }
            });
            
            document.getElementById('grandTotal').innerText = total.toLocaleString('id-ID');
            document.getElementById('btnSubmit').disabled = !formValid;
        }

        function updateRemoveButtons() {
            const rows = document.querySelectorAll('.detail-row');
            rows.forEach((row, index) => {
                const btn = row.querySelector('.btn-remove');
                if (rows.length === 1) {
                    btn.disabled = true;
                } else {
                    btn.disabled = false;
                }
            });
        }

        document.getElementById('detailBody').addEventListener('change', function(e) {
            if (e.target.classList.contains('barang-select')) {
                const idBarang = e.target.value;
                const row = e.target.closest('tr');
                const stokBadge = row.querySelector('.stok-display');
                const hargaInput = row.querySelector('.harga-input');
                
                if (!idBarang) {
                    stokBadge.innerText = '-';
                    stokBadge.className = 'stok-display badge bg-secondary text-white p-2 d-block w-100 text-center';
                    stokBadge.removeAttribute('data-stok');
                    hargaInput.value = '';
                    calculateTotal();
                    return;
                }

                stokBadge.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

                fetch(`/api/barang/${idBarang}/stok`)
                    .then(response => response.json())
                    .then(data => {
                        stokBadge.innerText = data.stok_saat_ini;
                        stokBadge.setAttribute('data-stok', data.stok_saat_ini);
                        
                        if (data.stok_saat_ini <= 10) {
                            stokBadge.className = 'stok-display badge bg-warning text-dark p-2 d-block w-100 text-center';
                        } else {
                            stokBadge.className = 'stok-display badge bg-success text-white p-2 d-block w-100 text-center';
                        }

                        // Pre-fill cost with harga beli standard (harga pokok) if available
                        if (data.harga_jual) {
                            hargaInput.value = data.harga_jual;
                        }

                        calculateTotal();
                    })
                    .catch(err => {
                        stokBadge.innerText = 'Error';
                        stokBadge.className = 'stok-display badge bg-danger text-white p-2 d-block w-100 text-center';
                    });
            }
        });

        document.getElementById('detailBody').addEventListener('input', function(e) {
            if (e.target.classList.contains('jumlah-input') || e.target.classList.contains('harga-input')) {
                calculateTotal();
            }
        });

        document.getElementById('btnAddRow').addEventListener('click', function() {
            const template = document.getElementById('rowTemplate').innerHTML;
            const newRowHtml = template.replace(/__INDEX__/g, rowIndex);
            
            document.getElementById('detailBody').insertAdjacentHTML('beforeend', newRowHtml);
            rowIndex++;
            updateRemoveButtons();
        });

        document.getElementById('detailBody').addEventListener('click', function(e) {
            if (e.target.closest('.btn-remove')) {
                const row = e.target.closest('tr');
                row.remove();
                calculateTotal();
                updateRemoveButtons();
            }
        });
    });
</script>
        </div>
    </div>
    
    @include('admin.partials.footer')
</div>

<script src="{{ asset('dist-dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('dist-dashboard/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist-dashboard/assets/js/main.js') }}"></script>

</body>
</html>
