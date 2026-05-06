<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat PO Baru - SmartStock</title>

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
                    <h3>Buat Purchase Order Baru</h3>
                    <p class="text-subtitle text-muted">Input data penerimaan barang</p>
                </div>
                <a href="{{ route('barang-masuk.index') }}" class="btn btn-outline-secondary px-4 shadow-sm">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>

<div class="page-content">
    <form action="{{ route('barang-masuk.store') }}" method="POST" id="poForm">
        @csrf
        
        <!-- Header PO -->
        <div class="card shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h5 class="card-title mb-0"><i class="fas fa-file-invoice me-2 text-primary"></i> Data Header PO</h5>
            </div>
            <div class="card-body mt-3">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Nomor PO</label>
                        <input type="text" name="nomor_po" class="form-control bg-light" value="{{ $nomorPo }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Supplier <span class="text-danger">*</span></label>
                        <select name="id_supplier" class="form-select pe-5" required>
                            <option value="">-- Pilih Supplier --</option>
                            @foreach($suppliers as $sup)
                                <option value="{{ $sup->id_supplier }}">{{ $sup->nama_supplier }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="2" placeholder="opsional"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Barang -->
        <div class="card shadow-sm" style="border-radius: 12px;">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h5 class="card-title mb-0"><i class="fas fa-boxes me-2 text-primary"></i> Detail Barang</h5>
            </div>
            <div class="card-body mt-3">
                <div class="table-responsive" style="overflow-x: visible;">
                    <table class="table table-bordered align-middle" id="detailTable">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 30%">Barang</th>
                                <th style="width: 20%">Lokasi Rak</th>
                                <th style="width: 15%">Jumlah</th>
                                <th style="width: 20%">Harga Satuan (Rp)</th>
                                <th style="width: 10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="detailBody">
                            <tr class="detail-row">
                                <td>
                                    <select name="details[0][id_barang]" class="form-select barang-select pe-5" required>
                                        <option value="">Pilih Barang</option>
                                        @foreach($barang as $brg)
                                            <option value="{{ $brg->id_barang }}" data-harga="{{ $brg->harga_beli }}">{{ $brg->kode_barang }} - {{ $brg->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="details[0][id_lokasi]" class="form-select pe-5" required>
                                        <option value="">Pilih Lokasi</option>
                                        @foreach($lokasi as $lok)
                                            <option value="{{ $lok->id_lokasi }}">{{ $lok->nama_lokasi }} ({{ $lok->kode_rak }})</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="details[0][jumlah]" class="form-control jumlah-input" min="1" value="1" required>
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
                    <button type="submit" class="btn btn-primary px-5 py-2 shadow-sm fw-bold">
                        <i class="fas fa-save me-2"></i> Simpan Purchase Order
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
                <option value="">Pilih Barang</option>
                @foreach($barang as $brg)
                    <option value="{{ $brg->id_barang }}" data-harga="{{ $brg->harga_beli }}">{{ $brg->kode_barang }} - {{ $brg->nama_barang }}</option>
                @endforeach
            </select>
        </td>
        <td>
            <select name="details[__INDEX__][id_lokasi]" class="form-select pe-5" required>
                <option value="">Pilih Lokasi</option>
                @foreach($lokasi as $lok)
                    <option value="{{ $lok->id_lokasi }}">{{ $lok->nama_lokasi }} ({{ $lok->kode_rak }})</option>
                @endforeach
            </select>
        </td>
        <td>
            <input type="number" name="details[__INDEX__][jumlah]" class="form-control jumlah-input" min="1" value="1" required>
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
            document.querySelectorAll('.detail-row').forEach(row => {
                const jumlah = parseFloat(row.querySelector('.jumlah-input').value) || 0;
                const harga = parseFloat(row.querySelector('.harga-input').value) || 0;
                total += jumlah * harga;
            });
            document.getElementById('grandTotal').innerText = total.toLocaleString('id-ID');
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
                const selectedOption = e.target.options[e.target.selectedIndex];
                const harga = selectedOption.getAttribute('data-harga');
                const row = e.target.closest('tr');
                if (harga) {
                    row.querySelector('.harga-input').value = harga;
                }
                calculateTotal();
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

