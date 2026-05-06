<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Barang;
use App\Models\KategoriBarang;
use App\Models\Supplier;
use App\Models\Lokasi;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\ReturBarang;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        if ($role === 'admin') {
            return $this->dashboardAdmin();
        } elseif ($role === 'petugas') {
            return $this->dashboardPetugas();
        } else {
            return $this->dashboardKepala();
        }
    }

    // ─────────────────────────────────────────
    //  DASHBOARD ADMIN
    // ─────────────────────────────────────────
    private function dashboardAdmin()
    {
        $today = Carbon::today();

        // ── Baris 1: Summary Cards ──
        $totalBarang    = Barang::count();
        $totalKategori  = KategoriBarang::count();
        $totalSupplier  = Supplier::count();
        $totalLokasi    = Lokasi::count();

        // ── Baris 2: Transaksi Hari Ini ──
        $transaksiMasukHariIni  = BarangMasuk::whereDate('tanggal', $today)->count();
        $transaksiKeluarHariIni = BarangKeluar::whereDate('tanggal', $today)->count();
        $returHariIni           = ReturBarang::whereDate('tanggal', $today)->count();

        // ── Baris 3: Alert Cards ──
        $totalStokKritis = Barang::whereColumn('stok_saat_ini', '<=', 'stok_min')->count();
        $totalPoPending  = BarangMasuk::whereIn('status', ['draft', 'disetujui'])->count();

        // ── Baris 5: Tabel Stok Kritis ──
        $daftarStokKritis = Barang::with('kategoriBarang')
            ->whereColumn('stok_saat_ini', '<=', 'stok_min')
            ->orderBy('stok_saat_ini', 'asc')
            ->take(5)
            ->get();

        // ── Baris 6: Tabel PO Pending ──
        $daftarPoPending = BarangMasuk::with('supplier')
            ->whereIn('status', ['draft', 'disetujui'])
            ->orderBy('tanggal', 'desc')
            ->take(5)
            ->get();

        // ── Baris 6: Transaksi Terbaru (gabungan masuk + keluar + retur) ──
        $masuk = BarangMasuk::select(
                'nomor_po as nomor',
                'tanggal',
                \DB::raw("'Masuk' as jenis")
            )
            ->latest('tanggal');

        $keluar = BarangKeluar::select(
                'nomor_keluar as nomor',
                'tanggal',
                \DB::raw("'Keluar' as jenis")
            )
            ->latest('tanggal');

        $transaksiTerbaru = ReturBarang::select(
                'nomor_retur as nomor',
                'tanggal',
                \DB::raw("'Retur' as jenis")
            )
            ->latest('tanggal')
            ->union($masuk)
            ->union($keluar)
            ->orderBy('tanggal', 'desc')
            ->take(5)
            ->get();

        // ── Baris 4: Chart Mutasi 7 Hari Terakhir ──
        $labels     = [];
        $dataMasuk  = [];
        $dataKeluar = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $labels[]     = $date->format('d/m');
            $dataMasuk[]  = BarangMasuk::whereDate('tanggal', $date)->count();
            $dataKeluar[] = BarangKeluar::whereDate('tanggal', $date)->count();
        }

        $chartMutasi = [
            'labels' => $labels,
            'masuk'  => $dataMasuk,
            'keluar' => $dataKeluar,
        ];

        // ── Baris 4: Chart Top 5 Barang Keluar Bulan Ini ──
        $topBarang = \DB::table('detail_barang_keluar')
            ->join('barang_keluar', 'detail_barang_keluar.id_keluar', '=', 'barang_keluar.id_keluar')
            ->join('barang', 'detail_barang_keluar.id_barang', '=', 'barang.id_barang')
            ->whereMonth('barang_keluar.tanggal', Carbon::now()->month)
            ->whereYear('barang_keluar.tanggal', Carbon::now()->year)
            ->selectRaw('barang.nama_barang, SUM(detail_barang_keluar.jumlah) as total_keluar')
            ->groupBy('barang.id_barang', 'barang.nama_barang')
            ->orderByDesc('total_keluar')
            ->take(5)
            ->get();

        $chartTopBarang = [
            'labels' => $topBarang->pluck('nama_barang')->toArray(),
            'data'   => $topBarang->pluck('total_keluar')->toArray(),
        ];

        return view('admin.dashboard', compact(
            'totalBarang', 'totalKategori', 'totalSupplier', 'totalLokasi',
            'transaksiMasukHariIni', 'transaksiKeluarHariIni', 'returHariIni',
            'totalStokKritis', 'totalPoPending',
            'daftarStokKritis', 'daftarPoPending', 'transaksiTerbaru',
            'chartMutasi', 'chartTopBarang'
        ));
    }

    // ─────────────────────────────────────────
    //  DASHBOARD PETUGAS
    // ─────────────────────────────────────────
    private function dashboardPetugas()
    {
        $today  = Carbon::today();
        $userId = Auth::id();

        $transaksiMasukHariIni  = BarangMasuk::where('id_user', $userId)
                                    ->whereDate('tanggal', $today)->count();
        $transaksiKeluarHariIni = BarangKeluar::where('id_user', $userId)
                                    ->whereDate('tanggal', $today)->count();
        $returHariIni           = ReturBarang::where('id_user', $userId)
                                    ->whereDate('tanggal', $today)->count();

        $daftarStokKritis = Barang::with('kategoriBarang')
            ->whereColumn('stok_saat_ini', '<=', 'stok_min')
            ->orderBy('stok_saat_ini', 'asc')
            ->take(5)
            ->get();

        $riwayatTransaksi = BarangMasuk::where('id_user', $userId)
            ->select('nomor_po as nomor', 'tanggal', \DB::raw("'Masuk' as jenis"))
            ->union(
                BarangKeluar::where('id_user', $userId)
                    ->select('nomor_keluar as nomor', 'tanggal', \DB::raw("'Keluar' as jenis"))
            )
            ->union(
                ReturBarang::where('id_user', $userId)
                    ->select('nomor_retur as nomor', 'tanggal', \DB::raw("'Retur' as jenis"))
            )
            ->orderBy('tanggal', 'desc')
            ->take(5)
            ->get();

        return view('petugas.dashboard', compact(
            'transaksiMasukHariIni', 'transaksiKeluarHariIni', 'returHariIni',
            'daftarStokKritis', 'riwayatTransaksi'
        ));
    }

    // ─────────────────────────────────────────
    //  DASHBOARD KEPALA
    // ─────────────────────────────────────────
    private function dashboardKepala()
    {
        $now = Carbon::now();

        // Total nilai stok gudang
        $totalNilaiStok = Barang::selectRaw('SUM(stok_saat_ini * harga_beli) as total')
            ->value('total') ?? 0;

        // PO menunggu approval
        $daftarPoPending = BarangMasuk::with('supplier')
            ->whereIn('status', ['draft', 'disetujui'])
            ->orderBy('tanggal', 'desc')
            ->take(5)
            ->get();

        $totalPoPending = BarangMasuk::whereIn('status', ['draft', 'disetujui'])->count();

        // Stok kritis
        $daftarStokKritis = Barang::with('kategoriBarang')
            ->whereColumn('stok_saat_ini', '<=', 'stok_min')
            ->orderBy('stok_saat_ini', 'asc')
            ->take(5)
            ->get();

        $totalStokKritis = Barang::whereColumn('stok_saat_ini', '<=', 'stok_min')->count();

        // Performa bulan ini
        $totalMasukBulanIni  = BarangMasuk::whereMonth('tanggal', $now->month)
                                ->whereYear('tanggal', $now->year)->count();
        $totalKeluarBulanIni = BarangKeluar::whereMonth('tanggal', $now->month)
                                ->whereYear('tanggal', $now->year)->count();

        // Chart tren mutasi bulanan (Tahun ini)
        $labels     = [];
        $dataMasuk  = [];
        $dataKeluar = [];

        for ($i = 1; $i <= 12; $i++) {
            $date = Carbon::create($now->year, $i, 1);
            $labels[]     = $date->translatedFormat('M Y');
            $dataMasuk[]  = BarangMasuk::whereMonth('tanggal', $date->month)
                                ->whereYear('tanggal', $date->year)->count();
            $dataKeluar[] = BarangKeluar::whereMonth('tanggal', $date->month)
                                ->whereYear('tanggal', $date->year)->count();
        }

        $chartTren = [
            'labels' => $labels,
            'masuk'  => $dataMasuk,
            'keluar' => $dataKeluar,
        ];

        return view('kepala.dashboard', compact(
            'totalNilaiStok', 'totalPoPending', 'totalStokKritis',
            'daftarPoPending', 'daftarStokKritis',
            'totalMasukBulanIni', 'totalKeluarBulanIni',
            'chartTren'
        ));
    }
}