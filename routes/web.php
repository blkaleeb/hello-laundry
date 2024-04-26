<?php

use App\Http\Controllers\FiturCariController;
use App\Http\Controllers\HalDashboardController;
use App\Http\Controllers\HalLaporanController;
use App\Http\Controllers\HalOutletController;
use App\Http\Controllers\HalPaketController;
use App\Http\Controllers\HalPelangganController;
use App\Http\Controllers\HalPenggunaController;
use App\Http\Controllers\HalPesananPelangganController;
use App\Http\Controllers\HalProfilController;
use App\Http\Controllers\HalTransaksiController;
use App\Http\Controllers\SistemLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ========================================== SISTEM LOGIN =========================================
Route::post('/registrasi_awal', [SistemLoginController::class, 'registrasiAwal']);
Route::get('/login', [SistemLoginController::class, 'halamanLogin'])->name('login');
Route::post('/login_verifikasi', [SistemLoginController::class, 'verifikasiLogin']);
Route::get('/logout', [SistemLoginController::class, 'prosesLogout']);
// =================================================================================================

// =============================== AKSES ADMIN, KASIR, DAN PELANGGAN ===============================
Route::group(['middleware' => ['auth', 'verified']], function () {
    // => Fitur Cari Halaman
    Route::get('/cari_halaman/{kata}', [FiturCariController::class, 'cariHalaman']);
    // => Halaman Dashboard
    Route::get('/dashboard', [HalDashboardController::class, 'halamanDashboard']);
    // => Hubungan Transaksi
    Route::get('/pdf_transaksi/{id}', [HalTransaksiController::class, 'pdfTransaksi']);
    Route::get('/ubah_status_transaksi/{status}/{id}', [HalTransaksiController::class, 'ubahStatusTransaksi']);
});
// =================================================================================================

// ===================================== AKSES ADMIN DAN KASIR =====================================
Route::group(['middleware' => ['auth']], function () {
    // => Halaman Profil
    Route::get('/kelola_profil', [HalProfilController::class, 'halamanProfil']);
    Route::post('/update_profil', [HalProfilController::class, 'updateProfil']);
    Route::post('/ubah_password/{id}', [HalProfilController::class, 'ubahPassword']);
    // => Halaman Pelanggan
    Route::get('/registrasi_pelanggan', [HalPelangganController::class, 'registrasiPelanggan']);
    Route::get('/kelola_transaksi', [HalPelangganController::class, 'halamanTransaksi']);
    Route::get('/kelola_pelanggan', [HalPelangganController::class, 'halamanPelanggan']);
    Route::get('/detail_pelanggan_member/{id}', [HalPelangganController::class, 'detailPelangganMember']);
    Route::get('/detail_pelanggan_non_member/{id}', [HalPelangganController::class, 'detailPelangganNonMember']);
    Route::get('/layanan_member/{id}', [HalPelangganController::class, 'halamanLayananMember']);
    Route::get('/sort_outlet_tabel_kiloan/{id}', [HalPelangganController::class, 'sortOutletTabelKiloan']);
    Route::get('/sort_outlet_tabel_satuan/{id}', [HalPelangganController::class, 'sortOutletTabelSatuan']);
    Route::post('/simpan_pelanggan', [HalPelangganController::class, 'simpanPelanggan']);
    Route::post('/simpan_pesanan', [HalPelangganController::class, 'simpanPesanan']);
    Route::get('/lihat_paket_kilo_member/{id}', [HalPelangganController::class, 'lihatPaketKiloMember']);
    Route::get('/lihat_paket_satu_member/{id}', [HalPelangganController::class, 'lihatPaketSatuMember']);
    Route::get('/update_status_transaksi/{id}/{status}', [HalPelangganController::class, 'updateStatusTransaksi']);
    Route::get('/hapus_pesanan_kilo/{id}', [HalPelangganController::class, 'hapusPesananKilo']);
    Route::get('/hapus_pesanan_satu/{id}', [HalPelangganController::class, 'hapusPesananSatu']);
    Route::get('/hapus_pelanggan/{id}', [HalPelangganController::class, 'hapusPelanggan']);
    Route::get('/pdf_pelanggan/{id}', [HalPelangganController::class, 'pdfPelanggan']);
    // => Halaman Transaksi
    Route::get('/lihat_transaksi_selesai/{id}', [HalTransaksiController::class, 'lihatTransaksiSelesai']);
    Route::get('/lihat_transaksi_diantar/{id}', [HalTransaksiController::class, 'lihatTransaksiDiantar']);
    Route::get('/lihat_transaksi_diambil/{id}', [HalTransaksiController::class, 'lihatTransaksiDiambil']);
    Route::post('/bayar_pesanan', [HalTransaksiController::class, 'bayarPesanan']);
    // => Halaman Laporan
    Route::get('/laporan_transaksi', [HalLaporanController::class, 'halamanLaporanTransaksi']);
    Route::get('/laporan_pegawai', [HalLaporanController::class, 'halamanLaporanPegawai']);
    Route::get('/laporan_pegawai_riwayat/{id}', [HalLaporanController::class, 'halamanLaporanPegawaiRiwayat']);
    Route::post('/filter_laporan_transaksi', [HalLaporanController::class, 'filterLaporanTransaksi']);
    Route::post('/filter_laporan_pegawai/{id}', [HalLaporanController::class, 'filterLaporanPegawai']);
    Route::post('/pdf_laporan_transaksi', [HalLaporanController::class, 'pdfLaporanTransaksi']);
    Route::post('/pdf_laporan_pegawai/{id}', [HalLaporanController::class, 'pdfLaporanPegawai']);
});
// =================================================================================================

// ========================================== AKSES ADMIN ==========================================
Route::group(['middleware' => ['auth']], function () {
    // => Halaman Pengguna
    Route::get('/kelola_pengguna', [HalPenggunaController::class, 'halamanPengguna']);
    Route::get('/tambah_pengguna', [HalPenggunaController::class, 'tambahPengguna']);
    Route::post('/simpan_pengguna', [HalPenggunaController::class, 'simpanPengguna']);
    Route::get('/lihat_pengguna/{id}', [HalPenggunaController::class, 'lihatPengguna']);
    Route::get('/edit_pengguna/{id}', [HalPenggunaController::class, 'editPengguna']);
    Route::post('/update_pengguna/{id}', [HalPenggunaController::class, 'updatePengguna']);
    Route::get('/hapus_pengguna/{id}', [HalPenggunaController::class, 'hapusPengguna']);
    // => Halaman Outlet
    Route::get('/kelola_outlet', [HalOutletController::class, 'halamanOutlet']);
    Route::get('/tambah_outlet', [HalOutletController::class, 'tambahOutlet']);
    Route::post('/simpan_outlet', [HalOutletController::class, 'simpanOutlet']);
    Route::get('/lihat_outlet/{id}', [HalOutletController::class, 'lihatOutlet']);
    Route::get('/edit_outlet/{id}', [HalOutletController::class, 'editOutlet']);
    Route::post('/update_outlet/{id}', [HalOutletController::class, 'updateOutlet']);
    Route::get('/hapus_outlet/{id}', [HalOutletController::class, 'hapusOutlet']);
    // => Halaman Paket
    Route::get('/kelola_paket', [HalPaketController::class, 'halamanPaket']);
    Route::get('/tambah_paket_kiloan', [HalPaketController::class, 'tambahPaketKiloan']);
    Route::get('/tambah_paket_satuan', [HalPaketController::class, 'tambahPaketSatuan']);
    Route::post('/simpan_paket_kiloan', [HalPaketController::class, 'simpanPaketKiloan']);
    Route::post('/simpan_paket_satuan', [HalPaketController::class, 'simpanPaketSatuan']);
    Route::get('/lihat_paket_kiloan/{id}', [HalPaketController::class, 'lihatPaketKiloan']);
    Route::get('/lihat_paket_satuan/{id}', [HalPaketController::class, 'lihatPaketSatuan']);
    Route::get('/edit_paket_kiloan/{id}', [HalPaketController::class, 'editPaketKiloan']);
    Route::get('/edit_paket_satuan/{id}', [HalPaketController::class, 'editPaketSatuan']);
    Route::post('/update_paket_kiloan/{id}', [HalPaketController::class, 'updatePaketKiloan']);
    Route::post('/update_paket_satuan/{id}', [HalPaketController::class, 'updatePaketSatuan']);
    Route::get('/hapus_paket_kiloan/{id}', [HalPaketController::class, 'hapusPaketKiloan']);
    Route::get('/hapus_paket_satuan/{id}', [HalPaketController::class, 'hapusPaketSatuan']);
});
// =================================================================================================

// ======================================== AKSES PELANGGAN ========================================
Route::group(['middleware' => ['auth']], function () {
    // => Dashboard Pelanggan
    Route::get('/data_outlet_dashboard/{id}', [HalDashboardController::class, 'dashboardPelanggan']);
    Route::get('/outlet_tabel_kiloan/{id}', [HalDashboardController::class, 'outletTabelKiloan']);
    Route::get('/outlet_tabel_satuan/{id}', [HalDashboardController::class, 'outletTabelSatuan']);
    Route::post('/update_profil_pelanggan', [HalDashboardController::class, 'updateProfilPelanggan']);
    Route::get('/pesanan_saya', [HalPesananPelangganController::class, 'halamanPesananPelanggan']);
    Route::get('/lihat_pesanan_pelanggan/{id}', [HalPesananPelangganController::class, 'lihatPesananPelanggan']);
});
// =================================================================================================
