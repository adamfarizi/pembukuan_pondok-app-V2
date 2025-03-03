<?php

use App\Http\Controllers\Guest\GuestDonasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Wali\WaliBerandaController;
use App\Http\Controllers\Wali\WaliTagihanController;
use App\Http\Controllers\Admin\AdminMasterController;
use App\Http\Controllers\Admin\AdminSantriController;
use App\Http\Controllers\Admin\AdminTamrinController;
use App\Http\Controllers\Wali\WaliCekNilaiController;
use App\Http\Controllers\Wali\WaliCekPointController;
use App\Http\Controllers\Admin\AdminBerandaController;
use App\Http\Controllers\Admin\AdminHafalanController;
use App\Http\Controllers\Guest\GuestBerandaController;
use App\Http\Controllers\Wali\WaliCekHafalanController;
use App\Http\Controllers\Admin\AdminPemasukanController;
use App\Http\Controllers\Wali\WaliDataPribadiSantriController;
use App\Http\Controllers\Admin\AdminDaftarUlangController;
use App\Http\Controllers\Admin\AdminGuestMasterController;
use App\Http\Controllers\Admin\AdminPendaftaranController;
use App\Http\Controllers\Admin\AdminPengeluaranController;
use App\Http\Controllers\Guest\GuestPendaftaranController;
use App\Http\Controllers\Admin\AdminIuranBulananController;
use App\Http\Controllers\Wali\WaliDaftarPengajarController;
use App\Http\Controllers\Admin\AdminMataPelajaranController;
use App\Http\Controllers\Admin\AdminLaporanKeuanganController;
use App\Http\Controllers\Wali\WaliDaftarMataPelajaranController;
use App\Http\Controllers\Admin\AdminPointPelanggaranController;
use App\Http\Controllers\Admin\AdminWaliMasterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['guest:web,wali_santri'])->group(function () {
  Route::get('/', [GuestBerandaController::class, 'index'])->name('login');
  Route::post('/login', [GuestBerandaController::class, 'login']);
  Route::get('/pendaftaran-santri-baru', [GuestPendaftaranController::class, 'index']);
  Route::post('/pendaftaran-santri-baru', [GuestPendaftaranController::class, 'create']);
  Route::get('/pendaftaran-santri-baru/konfirmasi/{id}', [GuestPendaftaranController::class, 'index_konfirmasi'])->name('guest.pendaftaran.konfirmasi');
  Route::get('/donasi', [GuestDonasiController::class, 'index']);
  Route::post('/donasi/create', [GuestDonasiController::class, 'create']);
  Route::get('/donasi/finish/{id}', [GuestDonasiController::class, 'index_finish'])->name('guest.donasi.finish');
});

Route::middleware(['auth:web'])->group(function () {
  Route::get('/admin/beranda', [AdminBerandaController::class, 'index'])->name('admin-beranda');
  Route::get('/admin/daftar_ulang', [AdminDaftarUlangController::class, 'index'])->name('daftar_ulang');
  Route::get('/admin/daftar_ulang/select2', [AdminDaftarUlangController::class, 'select2'])->name('daftar_ulang.select2');
  Route::put('/admin/daftar_ulang/edit/{id}/action', [AdminDaftarUlangController::class, 'edit']);
  Route::get('/admin/iuran_bulanan', [AdminIuranBulananController::class, 'index'])->name('iuran_bulanan');
  Route::get('/admin/iuran_bulanan/select2', [AdminIuranBulananController::class, 'select2'])->name('iuran_bulanan.select2');
  Route::put('/admin/iuran_bulanan/edit/{id}/action', [AdminIuranBulananController::class, 'edit']);
  Route::get('/admin/tamrin', [AdminTamrinController::class, 'index'])->name('tamrin');
  Route::get('/admin/tamrin/seletc2', [AdminTamrinController::class, 'select2'])->name('tamrin.select2');
  Route::get('/admin/tamrin/cicilan/{id}/bayar', [AdminTamrinController::class, 'show'])->name('cicilan_detail');
  Route::post('/admin/pembayaran/cicilan/add', [AdminTamrinController::class, 'add_cicilan'])->name('add_cicilan');
  Route::delete('/admin/pembayaran/cicilan/delete/{id}', [AdminTamrinController::class, 'delete_cicilan'])->name('delete_cicilan');
  Route::put('/admin/tamrin/edit/{id}/action', [AdminTamrinController::class, 'edit']);
  Route::get('/admin/pemasukan', [AdminPemasukanController::class, 'index'])->name('pemasukan');
  Route::post('/admin/pemasukan/create/action', [AdminPemasukanController::class, 'create']);
  Route::put('/admin/pemasukan/edit/{id}/action', [AdminPemasukanController::class, 'edit']);
  Route::delete('/admin/pemasukan/delete/{id}', [AdminPemasukanController::class, 'delete']);
  Route::get('/admin/pengeluaran', [AdminPengeluaranController::class, 'index'])->name('pengeluaran');
  Route::post('/admin/pengeluaran/create/action', [AdminPengeluaranController::class, 'create']);
  Route::put('/admin/pengeluaran/edit/{id}/action', [AdminPengeluaranController::class, 'edit']);
  Route::delete('/admin/pengeluaran/delete/{id}', [AdminPengeluaranController::class, 'delete']);
  Route::get('/admin/laporan_keuangan', [AdminLaporanKeuanganController::class, 'index'])->name('laporan_keuangan');
  Route::get('/admin/laporan_keuangan/pemasukan_data', [AdminLaporanKeuanganController::class, 'getPemasukan'])->name('getPemasukan');
  Route::get('/admin/laporan_keuangan/pengeluaran_data', [AdminLaporanKeuanganController::class, 'getPengeluaran'])->name('getPengeluaran');
  Route::get('/admin/santri', [AdminSantriController::class, 'index'])->name('santri');
  Route::get('/admin/santri/{id}/info', [AdminSantriController::class, 'index_info']);
  Route::put('/admin/santri/pembayaran/{jenis_pembayaran}/{id_pembayaran}/update', [AdminSantriController::class, 'update_pembayaran']);
  Route::get('/admin/santri/pembayaran/cetak-riwayat/{id_santri}/{tanggal}', [AdminSantriController::class, 'cetakRiwayat'])->name('cetak.riwayat');
  Route::get('/admin/santri/create', [AdminSantriController::class, 'index_create']);
  Route::post('/admin/santri/create/action', [AdminSantriController::class, 'create']);
  Route::get('/admin/santri/edit/{id}', [AdminSantriController::class, 'index_edit']);
  Route::put('/admin/santri/edit/{id}/action', [AdminSantriController::class, 'edit']);
  Route::delete('/admin/santri/delete/{id}', [AdminSantriController::class, 'delete']);
  Route::get('/admin/mata_pelajaran', [AdminMataPelajaranController::class, 'index'])->name('mata_pelajaran');
  Route::get('/admin/mata_pelajaran/{id}', [AdminMataPelajaranController::class, 'index_nilai']);
  Route::post('/admin/mata_pelajaran/{id}/create', [AdminMataPelajaranController::class, 'create']);
  Route::put('/admin/mata_pelajaran/{id}/edit', [AdminMataPelajaranController::class, 'edit']);
  Route::delete('/admin/mata_pelajaran/{id}/delete', [AdminMataPelajaranController::class, 'delete']);
  Route::get('/admin/hafalan', [AdminHafalanController::class, 'index'])->name('hafalan');
  Route::get('/admin/hafalan/{id}', [AdminHafalanController::class, 'index_hafalan']);
  Route::post('/admin/hafalan/{id}/create', [AdminHafalanController::class, 'create']);
  Route::put('/admin/hafalan/{id}/edit', [AdminHafalanController::class, 'edit']);
  Route::delete('/admin/hafalan/{id}/delete', [AdminHafalanController::class, 'delete']);
  Route::get('/admin/point_pelanggaran', [AdminPointPelanggaranController::class, 'index'])->name('point_pelanggaran');
  Route::get('/admin/point_pelanggaran/{id}', [AdminPointPelanggaranController::class, 'index_point']);
  Route::post('/admin/point_pelanggaran/{id}/create', [AdminPointPelanggaranController::class, 'create']);
  Route::put('/admin/point_pelanggaran/{id}/edit', [AdminPointPelanggaranController::class, 'edit']);
  Route::delete('/admin/point_pelanggaran/{id}/delete', [AdminPointPelanggaranController::class, 'delete']);
  Route::get('/admin/pendaftaran', [AdminPendaftaranController::class, 'index'])->name('pendaftaran');
  Route::get('/admin/pendaftaran/{id}', [AdminPendaftaranController::class, 'index_info']);
  Route::post('/admin/pendaftaran/verifikasi/{id}', [AdminPendaftaranController::class, 'create']);
  Route::get('/admin/master_admin', [AdminMasterController::class, 'index'])->name('master_admin');
  Route::put('/admin/master_admin/edit_pembayaran', [AdminMasterController::class, 'edit_pembayaran']);
  Route::post('/admin/master_admin/create_iuran', [AdminMasterController::class, 'create_iuran']);
  Route::delete('/admin/master_admin/delete_iuran', [AdminMasterController::class, 'delete_iuran']);
  Route::post('/admin/master_admin/buat_tagihan_daftar_ulang', [AdminMasterController::class, 'createTagihanDaftarUlang'])->name('buat_tagihan_daftar_ulang');
  Route::post('/admin/master_admin/buat_tagihan_iuran_bulanan', [AdminMasterController::class, 'createTagihanIuranBulanan'])->name('buat_tagihan_iuran_bulanan');
  Route::post('/admin/master_admin/buat_tagihan_semester', [AdminMasterController::class, 'createTagihanSemester'])->name('buat_tagihan_semester');
  Route::post('/admin/master_admin/create', [AdminMasterController::class, 'create_admin']);
  Route::put('/admin/master_admin/edit/{id}', [AdminMasterController::class, 'edit_admin']);
  Route::delete('/admin/master_admin/delete/{id}', [AdminMasterController::class, 'delete_admin`']);
  Route::get('/admin/master_guest', [AdminGuestMasterController::class, 'index'])->name('master_guest');
  Route::put('/admin/master_guest/simpan/{id}', [AdminGuestMasterController::class, 'update'])->name('master_guest_save');
  Route::delete('/admin/master_guest/delete_misi/{id}', [AdminGuestMasterController::class, 'delete_misi'])->name('master_guest_delete_misi');
  Route::delete('/admin/master_guest/delete_foto/{id}', [AdminGuestMasterController::class, 'delete_foto'])->name('master_guest_delete_foto');
  Route::delete('/admin/master_guest/delete_rekening/{id}', [AdminGuestMasterController::class, 'delete_rekening'])->name('master_guest_delete_rekening');
  Route::get('/admin/master_wali', [AdminWaliMasterController::class, 'index'])->name('master_wali');
});

Route::middleware(['auth:wali_santri'])->group(function () {
  Route::get('/wali/beranda', [WaliBerandaController::class, 'index'])->name('wali-beranda');
  Route::get('/wali/tagihan', [WaliTagihanController::class, 'index'])->name('tagihan');
  Route::get('/wali/cek_nilai', [WaliCekNilaiController::class, 'index'])->name('cek_nilai');
  Route::get('/wali/cek_hafalan', [WaliCekHafalanController::class, 'index'])->name('cek_hafalan');
  Route::get('/wali/cek_point', [WaliCekPointController::class, 'index'])->name('cek_point');
  Route::get('/wali/daftar_pengajar', [WaliDaftarPengajarController::class, 'index'])->name('daftar_pengajar');
  Route::get('/wali/daftar_mata_pelajaran', [WaliDaftarMataPelajaranController::class, 'index'])->name('daftar_mata_pelajaran');
  Route::get('/wali/data_pribadi_santri', [WaliDataPribadiSantriController::class, 'index'])->name('data_pribadi_santri');
});

Route::post('/logout', [GuestBerandaController::class, 'logout'])->name('logout');
