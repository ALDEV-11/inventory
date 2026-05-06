<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Mutasi Barang</title>
</head>
<body style="font-family: Arial, sans-serif; font-size: 12px; margin: 20px;">

    <div style="text-align: center; margin-bottom: 10px;">
        <p style="font-size: 14px; font-weight: bold; margin: 0;">SMARTSTOCK  WAREHOUSE</p>
        <p style="font-size: 13px; font-weight: bold; margin: 4px 0;">LAPORAN MUTASI BARANG</p>
        <p style="margin: 2px 0;">Periode: {{ $dari }} s/d {{ $sampai }}</p>
        <p style="margin: 2px 0;">Kategori: {{ $namaKategori ?? 'Semua Kategori' }}</p>
        <p style="margin: 2px 0;">Dicetak: {{ now()->format('d/m/Y H:i') }}</p>
    </div>
    <hr>

    <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
        <thead>
            <tr>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">No</th>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">Tanggal</th>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">No. Transaksi</th>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">Nama Barang</th>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">Jenis</th>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">Jumlah</th>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">Harga Satuan</th>
                <th style="border: 1px solid #000; padding: 4px 8px; text-align: center;">Total Nilai</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @forelse($data as $i => $item)
            @php $grandTotal += $item->total_nilai; @endphp
            <tr>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px; text-align: center;">{{ $i + 1 }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px;">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px;">{{ $item->nomor }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px;">{{ $item->nama_barang }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px; text-align: center;">{{ $item->jenis }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px; text-align: center;">{{ $item->jumlah }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px; text-align: right;">{{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-size: 11px; text-align: right;">{{ number_format($item->total_nilai, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="border: 1px solid #000; padding: 10px; text-align: center;">Tidak ada data mutasi pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>
        @if($data->count() > 0)
        <tfoot>
            <tr>
                <td colspan="7" style="border: 1px solid #000; padding: 4px 8px; font-weight: bold; text-align: right;">TOTAL</td>
                <td style="border: 1px solid #000; padding: 4px 8px; font-weight: bold; text-align: right;">{{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
        @endif
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
