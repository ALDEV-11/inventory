<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Kartu Stok - {{ $barang->kode_barang }}</title>
</head>
<body style="font-family: Arial, sans-serif; font-size: 12px; margin: 20px;">

    <div style="text-align: center; margin-bottom: 10px;">
        <p style="font-size: 14px; font-weight: bold; margin: 0;">SIGAP — Sistem Informasi Gudang dan Persediaan</p>
        <p style="font-size: 13px; font-weight: bold; margin: 4px 0;">KARTU STOK BARANG</p>
        <p style="margin: 2px 0;">Nama Barang: {{ $barang->nama_barang }} ({{ $barang->kode_barang }})</p>
        <p style="margin: 2px 0;">Kategori: {{ $barang->kategoriBarang->nama_kategori ?? '-' }}</p>
        <p style="margin: 2px 0;">Periode: {{ $dari }} s/d {{ $sampai }}</p>
        <p style="margin: 2px 0;">Dicetak: {{ now()->format('d/m/Y H:i') }}</p>
    </div>
    <hr>

    <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
        <thead>
            <tr>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">No</th>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">Tanggal</th>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">No. Transaksi</th>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">Keterangan</th>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">Masuk</th>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">Keluar</th>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">Saldo</th>
            </tr>
        </thead>
        <tbody>
            {{-- Saldo Awal --}}
            <tr>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px; text-align: center;">-</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px;">-</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px;">-</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px; font-weight: bold;">Saldo Awal</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px; text-align: center;">-</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px; text-align: center;">-</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px; text-align: center; font-weight: bold;">{{ $saldoAwal }}</td>
            </tr>
            @php $totalMasuk = 0; $totalKeluar = 0; @endphp
            @foreach($data as $i => $item)
            @php
                $totalMasuk += $item->masuk ?? 0;
                $totalKeluar += $item->keluar ?? 0;
            @endphp
            <tr>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px; text-align: center;">{{ $i + 1 }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px;">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px;">{{ $item->nomor }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px;">{{ $item->keterangan }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px; text-align: center;">{{ $item->masuk > 0 ? $item->masuk : '-' }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px; text-align: center;">{{ $item->keluar > 0 ? $item->keluar : '-' }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px; text-align: center; font-weight: bold;">{{ $item->saldo }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="border: 1px solid #000; padding: 4px 8px; font-weight: bold; text-align: right;">TOTAL</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-weight: bold; text-align: center;">{{ $totalMasuk }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-weight: bold; text-align: center;">{{ $totalKeluar }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-weight: bold; text-align: center;">{{ $saldoAkhir }}</td>
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
