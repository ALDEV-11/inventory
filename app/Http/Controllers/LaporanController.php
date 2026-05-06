<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use App\Models\DetailBarangMasuk;
use App\Models\DetailBarangKeluar;
use App\Models\DetailRetur;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LaporanController extends Controller
{
    // ==================== INDEX ====================

    public function index()
    {
        return view('laporan.index');
    }

    // ==================== MUTASI ====================

    public function mutasi()
    {
        $kategori = KategoriBarang::all();
        return view('laporan.mutasi', compact('kategori'));
    }

    private function queryMutasi(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $idKategori = $request->id_kategori;

        $results = collect();

        // Barang Masuk (status diterima)
        $masukQuery = DetailBarangMasuk::whereHas('barangMasuk', function ($q) use ($dari, $sampai) {
            $q->whereBetween('tanggal', [$dari, $sampai])->where('status', 'diterima');
        })->with(['barang.kategoriBarang', 'barangMasuk']);

        if ($idKategori) {
            $masukQuery->whereHas('barang', fn($q) => $q->where('id_kategori', $idKategori));
        }

        foreach ($masukQuery->get() as $d) {
            $results->push((object)[
                'tanggal' => $d->barangMasuk->tanggal,
                'nomor' => $d->barangMasuk->nomor_po,
                'nama_barang' => $d->barang->nama_barang,
                'jenis' => 'Masuk',
                'jumlah' => $d->jumlah,
                'harga_satuan' => $d->harga_satuan,
                'total_nilai' => $d->subtotal,
            ]);
        }

        // Barang Keluar
        $keluarQuery = DetailBarangKeluar::whereHas('barangKeluar', function ($q) use ($dari, $sampai) {
            $q->whereBetween('tanggal', [$dari, $sampai]);
        })->with(['barang.kategoriBarang', 'barangKeluar']);

        if ($idKategori) {
            $keluarQuery->whereHas('barang', fn($q) => $q->where('id_kategori', $idKategori));
        }

        foreach ($keluarQuery->get() as $d) {
            $results->push((object)[
                'tanggal' => $d->barangKeluar->tanggal,
                'nomor' => $d->barangKeluar->nomor_keluar,
                'nama_barang' => $d->barang->nama_barang,
                'jenis' => 'Keluar',
                'jumlah' => $d->jumlah,
                'harga_satuan' => $d->harga_satuan,
                'total_nilai' => $d->subtotal,
            ]);
        }

        // Retur
        $returQuery = DetailRetur::whereHas('returBarang', function ($q) use ($dari, $sampai) {
            $q->whereBetween('tanggal', [$dari, $sampai]);
        })->with(['barang.kategoriBarang', 'returBarang']);

        if ($idKategori) {
            $returQuery->whereHas('barang', fn($q) => $q->where('id_kategori', $idKategori));
        }

        foreach ($returQuery->get() as $d) {
            $results->push((object)[
                'tanggal' => $d->returBarang->tanggal,
                'nomor' => $d->returBarang->nomor_retur,
                'nama_barang' => $d->barang->nama_barang,
                'jenis' => 'Retur (' . $d->returBarang->jenis . ')',
                'jumlah' => $d->jumlah,
                'harga_satuan' => $d->harga_satuan,
                'total_nilai' => $d->subtotal,
            ]);
        }

        return $results->sortBy('tanggal')->values();
    }

    public function mutasiPdf(Request $request)
    {
        $request->validate(['dari' => 'required|date', 'sampai' => 'required|date|after_or_equal:dari']);

        $data = $this->queryMutasi($request);
        $dari = Carbon::parse($request->dari)->format('d/m/Y');
        $sampai = Carbon::parse($request->sampai)->format('d/m/Y');
        $namaKategori = $request->id_kategori ? KategoriBarang::find($request->id_kategori)->nama_kategori : null;

        $pdf = Pdf::loadView('laporan.pdf.mutasi', compact('data', 'dari', 'sampai', 'namaKategori'))
            ->setPaper('a4', 'portrait');
        return $pdf->download('laporan-mutasi.pdf');
    }

    public function mutasiExcel(Request $request)
    {
        $request->validate(['dari' => 'required|date', 'sampai' => 'required|date|after_or_equal:dari']);

        $data = $this->queryMutasi($request);
        $headings = ['No', 'Tanggal', 'No. Transaksi', 'Nama Barang', 'Jenis', 'Jumlah', 'Harga Satuan', 'Total Nilai'];
        $rows = $data->map(function ($item, $i) {
            return [$i + 1, Carbon::parse($item->tanggal)->format('d/m/Y'), $item->nomor, $item->nama_barang, $item->jenis, $item->jumlah, $item->harga_satuan, $item->total_nilai];
        })->toArray();

        return $this->exportCsv('laporan-mutasi.csv', $headings, $rows);
    }

    public function mutasiPreview(Request $request)
    {
        $request->validate(['dari' => 'required|date', 'sampai' => 'required|date|after_or_equal:dari']);

        $data = $this->queryMutasi($request);
        $dari = Carbon::parse($request->dari)->format('d/m/Y');
        $sampai = Carbon::parse($request->sampai)->format('d/m/Y');
        $namaKategori = $request->id_kategori ? KategoriBarang::find($request->id_kategori)->nama_kategori : null;

        return view('laporan.pdf.mutasi', compact('data', 'dari', 'sampai', 'namaKategori'));
    }

    // ==================== OPNAME ====================

    public function opname()
    {
        $kategori = KategoriBarang::all();
        return view('laporan.opname', compact('kategori'));
    }

    private function queryOpname($idKategori = null)
    {
        $query = Barang::with('kategoriBarang')->orderBy('kode_barang');
        if ($idKategori) {
            $query->where('id_kategori', $idKategori);
        }
        return $query->get();
    }

    public function opnamePdf(Request $request)
    {
        $data = $this->queryOpname($request->id_kategori);
        $namaKategori = $request->id_kategori ? KategoriBarang::find($request->id_kategori)->nama_kategori : null;

        $pdf = Pdf::loadView('laporan.pdf.opname', compact('data', 'namaKategori'))
            ->setPaper('a4', 'portrait');
        return $pdf->download('laporan-stok-opname.pdf');
    }

    public function opnameExcel(Request $request)
    {
        $data = $this->queryOpname($request->id_kategori);
        $headings = ['No', 'Kode Barang', 'Nama Barang', 'Kategori', 'Satuan', 'Stok Min', 'Stok Saat Ini', 'Harga Beli', 'Nilai Stok', 'Status'];
        $rows = $data->map(function ($item, $i) {
            if ($item->stok_saat_ini == 0) $status = 'HABIS';
            elseif ($item->stok_saat_ini <= $item->stok_min) $status = 'KRITIS';
            elseif ($item->stok_saat_ini <= $item->stok_min * 1.5) $status = 'HAMPIR';
            else $status = 'AMAN';
            return [$i + 1, $item->kode_barang, $item->nama_barang, $item->kategoriBarang->nama_kategori ?? '-', $item->satuan, $item->stok_min, $item->stok_saat_ini, $item->harga_beli, $item->stok_saat_ini * $item->harga_beli, $status];
        })->toArray();

        return $this->exportCsv('laporan-stok-opname.csv', $headings, $rows);
    }

    public function opnamePreview(Request $request)
    {
        $data = $this->queryOpname($request->id_kategori);
        $namaKategori = $request->id_kategori ? KategoriBarang::find($request->id_kategori)->nama_kategori : null;

        return view('laporan.pdf.opname', compact('data', 'namaKategori'));
    }

    // ==================== KARTU STOK ====================

    public function kartu()
    {
        $barang = Barang::orderBy('nama_barang')->get();
        return view('laporan.kartu', compact('barang'));
    }

    private function queryKartuStok($idBarang, $dari, $sampai)
    {
        $barang = Barang::with('kategoriBarang')->findOrFail($idBarang);

        // Hitung saldo awal: semua masuk - semua keluar SEBELUM tanggal $dari
        $masukSebelum = DetailBarangMasuk::where('id_barang', $idBarang)
            ->whereHas('barangMasuk', fn($q) => $q->where('tanggal', '<', $dari)->where('status', 'diterima'))
            ->sum('jumlah');

        $keluarSebelum = DetailBarangKeluar::where('id_barang', $idBarang)
            ->whereHas('barangKeluar', fn($q) => $q->where('tanggal', '<', $dari))
            ->sum('jumlah');

        $returMasukSebelum = DetailRetur::where('id_barang', $idBarang)
            ->whereHas('returBarang', fn($q) => $q->where('tanggal', '<', $dari)->where('jenis', 'Dari Pelanggan'))
            ->sum('jumlah');

        $returKeluarSebelum = DetailRetur::where('id_barang', $idBarang)
            ->whereHas('returBarang', fn($q) => $q->where('tanggal', '<', $dari)->where('jenis', 'Ke Supplier'))
            ->sum('jumlah');

        $saldoAwal = $masukSebelum - $keluarSebelum + $returMasukSebelum - $returKeluarSebelum;

        // Movements dalam periode
        $movements = collect();

        // Barang Masuk
        $masuk = DetailBarangMasuk::where('id_barang', $idBarang)
            ->whereHas('barangMasuk', fn($q) => $q->whereBetween('tanggal', [$dari, $sampai])->where('status', 'diterima'))
            ->with('barangMasuk')->get();

        foreach ($masuk as $d) {
            $movements->push((object)[
                'tanggal' => $d->barangMasuk->tanggal,
                'nomor' => $d->barangMasuk->nomor_po,
                'keterangan' => 'Barang Masuk',
                'masuk' => $d->jumlah,
                'keluar' => 0,
            ]);
        }

        // Barang Keluar
        $keluar = DetailBarangKeluar::where('id_barang', $idBarang)
            ->whereHas('barangKeluar', fn($q) => $q->whereBetween('tanggal', [$dari, $sampai]))
            ->with('barangKeluar')->get();

        foreach ($keluar as $d) {
            $movements->push((object)[
                'tanggal' => $d->barangKeluar->tanggal,
                'nomor' => $d->barangKeluar->nomor_keluar,
                'keterangan' => 'Barang Keluar',
                'masuk' => 0,
                'keluar' => $d->jumlah,
            ]);
        }

        // Retur
        $retur = DetailRetur::where('id_barang', $idBarang)
            ->whereHas('returBarang', fn($q) => $q->whereBetween('tanggal', [$dari, $sampai]))
            ->with('returBarang')->get();

        foreach ($retur as $d) {
            $isMasuk = $d->returBarang->jenis === 'Dari Pelanggan';
            $movements->push((object)[
                'tanggal' => $d->returBarang->tanggal,
                'nomor' => $d->returBarang->nomor_retur,
                'keterangan' => 'Retur ' . $d->returBarang->jenis,
                'masuk' => $isMasuk ? $d->jumlah : 0,
                'keluar' => $isMasuk ? 0 : $d->jumlah,
            ]);
        }

        // Sort and compute running saldo
        $sorted = $movements->sortBy('tanggal')->values();
        $saldo = $saldoAwal;
        foreach ($sorted as $m) {
            $saldo += $m->masuk - $m->keluar;
            $m->saldo = $saldo;
        }

        $saldoAkhir = $saldo;

        return compact('barang', 'sorted', 'saldoAwal', 'saldoAkhir');
    }

    public function kartuPdf(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barang,id_barang',
            'dari' => 'required|date',
            'sampai' => 'required|date|after_or_equal:dari',
        ]);

        $result = $this->queryKartuStok($request->id_barang, $request->dari, $request->sampai);
        $barang = $result['barang'];
        $data = $result['sorted'];
        $saldoAwal = $result['saldoAwal'];
        $saldoAkhir = $result['saldoAkhir'];
        $dari = Carbon::parse($request->dari)->format('d/m/Y');
        $sampai = Carbon::parse($request->sampai)->format('d/m/Y');

        $pdf = Pdf::loadView('laporan.pdf.kartu', compact('barang', 'data', 'saldoAwal', 'saldoAkhir', 'dari', 'sampai'))
            ->setPaper('a4', 'landscape');
        return $pdf->download('kartu-stok-' . $barang->kode_barang . '.pdf');
    }

    public function kartuExcel(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barang,id_barang',
            'dari' => 'required|date',
            'sampai' => 'required|date|after_or_equal:dari',
        ]);

        $result = $this->queryKartuStok($request->id_barang, $request->dari, $request->sampai);
        $barang = $result['barang'];
        $headings = ['No', 'Tanggal', 'No. Transaksi', 'Keterangan', 'Masuk', 'Keluar', 'Saldo'];
        $rows = array_merge(
            [['--', '--', '--', 'Saldo Awal', '--', '--', $result['saldoAwal']]],
            $result['sorted']->map(function ($item, $i) {
                return [$i + 1, Carbon::parse($item->tanggal)->format('d/m/Y'), $item->nomor, $item->keterangan, $item->masuk > 0 ? $item->masuk : '--', $item->keluar > 0 ? $item->keluar : '--', $item->saldo];
            })->toArray()
        );

        return $this->exportCsv('kartu-stok-' . $barang->kode_barang . '.csv', $headings, $rows);
    }

    public function kartuPreview(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barang,id_barang',
            'dari' => 'required|date',
            'sampai' => 'required|date|after_or_equal:dari',
        ]);

        $result = $this->queryKartuStok($request->id_barang, $request->dari, $request->sampai);
        $barang = $result['barang'];
        $data = $result['sorted'];
        $saldoAwal = $result['saldoAwal'];
        $saldoAkhir = $result['saldoAkhir'];
        $dari = Carbon::parse($request->dari)->format('d/m/Y');
        $sampai = Carbon::parse($request->sampai)->format('d/m/Y');

        return view('laporan.pdf.kartu', compact('barang', 'data', 'saldoAwal', 'saldoAkhir', 'dari', 'sampai'));
    }

    // ==================== CSV HELPER ====================

    private function exportCsv(string $filename, array $headings, array $rows): StreamedResponse
    {
        return response()->streamDownload(function () use ($headings, $rows) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $headings);
            foreach ($rows as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
