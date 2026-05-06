<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Stok Opname</title>
</head>
<body style="font-family: Arial, sans-serif; font-size: 12px; margin: 20px;">

    <div style="text-align: center; margin-bottom: 10px;">
        <p style="font-size: 14px; font-weight: bold; margin: 0;">SIGAP — Sistem Informasi Gudang dan Persediaan</p>
        <p style="font-size: 13px; font-weight: bold; margin: 4px 0;">LAPORAN STOK OPNAME</p>
        <p style="margin: 2px 0;">Per Tanggal: {{ now()->format('d/m/Y') }}</p>
        <p style="margin: 2px 0;">Kategori: {{ $namaKategori ?? 'Semua Kategori' }}</p>
        <p style="margin: 2px 0;">Dicetak: {{ now()->format('d/m/Y H:i') }}</p>
    </div>
    <hr>

    <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
        <thead>
            <tr>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">No</th>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">Kode Barang</th>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">Nama Barang</th>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">Kategori</th>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">Satuan</th>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">Stok Min</th>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">Stok Saat Ini</th>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">Harga Beli</th>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">Nilai Stok</th>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @php $totalNilai = 0; @endphp
            @foreach($data as $i => $item)
            @php
                $nilaiStok = $item->stok_saat_ini * $item->harga_beli;
                $totalNilai += $nilaiStok;

                if ($item->stok_saat_ini == 0) $status = 'HABIS';
                elseif ($item->stok_saat_ini <= $item->stok_min) $status = 'KRITIS';
                elseif ($item->stok_saat_ini <= $item->stok_min * 1.5) $status = 'HAMPIR';
                else $status = 'AMAN';
            @endphp
            <tr>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px; text-align: center;">{{ $i + 1 }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px;">{{ $item->kode_barang }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px;">{{ $item->nama_barang }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px;">{{ $item->kategoriBarang->nama_kategori ?? '-' }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px; text-align: center;">{{ $item->satuan }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px; text-align: center;">{{ $item->stok_min }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px; text-align: center;">{{ $item->stok_saat_ini }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px; text-align: right;">{{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px; text-align: right;">{{ number_format($nilaiStok, 0, ',', '.') }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px; text-align: center;">{{ $status }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8" style="border: 1px solid #000; padding: 4px 8px; font-weight: bold; text-align: right;">TOTAL NILAI STOK GUDANG</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-weight: bold; text-align: right;">{{ number_format($totalNilai, 0, ',', '.') }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px;"></td>
            </tr>
        </tfoot>
    </table>

    <br><br><br>
    <table style="width: 100%;">
        <tr>
            <td style="text-align: center; width: 50%;">
                <p>Mengetahui,</p>
                <p>Kepala Gudang</p>
                <br><br><br>
                <p>(____________)</p>
            </td>
            <td style="text-align: center; width: 50%;">
                <p>Dibuat oleh,</p>
                <p>{{ auth()->user()->name }}</p>
                <br><br><br>
                <p>(____________)</p>
            </td>
        </tr>
    </table>

</body>
</html>
