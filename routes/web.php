<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\CalonPenerimaController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\PemukimanController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\HasilPenilaianController;
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

Route::any('/', [LoginController::class, 'index'])->name('index');
Route::any('/daftar', [LoginController::class, 'daftar'])->name('daftar');
Route::any('/kelurahan', [LoginController::class, 'kelurahan'])->name('kelur');
Route::any('/proses_daftar', [LoginController::class, 'prosesDaftar'])->name('prosesDaftar');
Route::any('/proses_login',[LoginController::class, 'prosesLogin'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->middleware(['admin'])->group(function () {
        Route::get('/home', [AdminController::class, 'index'])->name('home_admin');
        Route::get('/logout', [AdminController::class, 'logout'])->name('logout_admin');
        Route::any('/data_profile', [AdminController::class, 'dataProfile'])->name('profile_admin');
        Route::any('/update_profile', [AdminController::class, 'updateProfile'])->name('update_admin');


        Route::prefix('kecamatan')->group( function (){
            Route::any('/data_kecamatan', [WilayahController::class, 'index'])->name('data_kecamatan');
            Route::any('/simpan_data_kecamatan', [WilayahController::class, 'simpan_kecamatan'])->name('simpan_kecamatan');
            Route::any('/edit_data_kecamatan', [WilayahController::class, 'edit_kecamatan'])->name('edit_kecamatan');
            Route::any('/hapus_data_kecamatan{id_kecamatan}', [WilayahController::class, 'hapus_kecamatan'])->name('hapus_kecamatan');
        });
        Route::prefix('kelurahan')->group( function (){
            Route::any('/data_kelurahan{kecamatan_id}', [WilayahController::class, 'data_kelurahan'])->name('data_kelurahan');
            Route::any('/simpan_data_kelurahan', [WilayahController::class, 'simpan_kelurahan'])->name('simpan_kelurahan');
            Route::any('/edit_data_kelurahan', [WilayahController::class, 'edit_kelurahan'])->name('edit_kelurahan');
            Route::any('/hapus_data_kelurahan{kelurahan_id}', [WilayahController::class, 'hapus_kelurahan'])->name('hapus_kelurahan');
        });
        Route::prefix('calon_penerima')->group( function (){
            Route::any('/data_calon_penerima', [CalonPenerimaController::class, 'index'])->name('data_calon');
            Route::any('/detail_calon_penerima{id}', [CalonPenerimaController::class, 'detailCalon'])->name('detail_calon');
            Route::any('/hapus_calon_penerima{id}', [CalonPenerimaController::class, 'hapusCalon'])->name('hapus_calon');
            Route::any('/setujui_calon_penerima{id}', [CalonPenerimaController::class, 'setujuiCalon'])->name('setujui_calon');
        });
        Route::prefix('penerima')->group( function (){
            Route::any('/data_penerima', [PenerimaController::class, 'index'])->name('data_penerima');
            Route::any('/detail_penerima{id}', [PenerimaController::class, 'detailPenerima'])->name('detail_penerima');
            Route::any('/hapus_penerima{id}', [PenerimaController::class, 'hapusPenerima'])->name('hapus_penerima');
        });
        Route::prefix('penilaian')->group( function (){
            Route::any('/data_penilaian', [PenilaianController::class, 'index'])->name('data_penilaian');
            Route::any('/detail_penilaian{id}', [PenilaianController::class, 'detailPenilaian'])->name('detail_penilaian');
            Route::any('/simpan_penilaian', [PenilaianController::class, 'simpanPenilaian'])->name('simpan_penilaian');
        });
        Route::prefix('hasil_penilaian')->group( function (){
            Route::any('/data_nilai', [HasilPenilaianController::class, 'index'])->name('data_nilai');
            Route::any('/detail_hasil_penilaian{nilai_id}', [HasilPenilaianController::class, 'detailNilai'])->name('detail_nilai');
            Route::any('/hapus_hasil_penilaian{nilai_id}', [HasilPenilaianController::class, 'hapusNilai'])->name('hapus_nilai');
            Route::any('/pilih_penerima_bantuan', [HasilPenilaianController::class, 'pilihPenerima'])->name('pilih_penerima');
            Route::any('/penerima_bantuan', [HasilPenilaianController::class, 'penerimaBantuan'])->name('penerima_bantuan');
            Route::any('/cetak_berita_acara', [HasilPenilaianController::class, 'beritaAcara'])->name('berita_acara');
            Route::any('/hapus_semua_penerima', [HasilPenilaianController::class, 'hapusPenerima'])->name('hapus_semua_penerima');
            Route::any('/hapus_semua_nilai', [HasilPenilaianController::class, 'hapusSemuaNilai'])->name('hapus_semua_nilai');
            
        });
    });

    Route::prefix('pemukiman')->middleware(['pemukiman'])->group(function () {
        Route::get('/home', [PemukimanController::class, 'index'])->name('home_pemukiman');
        Route::get('/logout', [PemukimanController::class, 'logout'])->name('logout_pemukiman');
        Route::any('/data_profile', [PemukimanController::class, 'dataProfile'])->name('profile_pemukiman');
        Route::any('/update_profile', [PemukimanController::class, 'updateProfile'])->name('update_pemukiman');

        Route::prefix('penerima')->group( function (){
            Route::any('/data_penerima', [PemukimanController::class, 'dataPenerima'])->name('dataPenerima');
            Route::any('/detail_penerima{id}', [PemukimanController::class, 'detailPenerima'])->name('detailPenerima');
        });
        Route::prefix('penilaian')->group( function (){
            Route::any('/data_penilaian', [PemukimanController::class, 'dataPenilaian'])->name('dataPenilaian');
            Route::any('/detail_penilaian{nilai_id}', [PemukimanController::class, 'detailPenilaian'])->name('detailPenilaian');
            Route::any('/data_penerima_bantuan', [PemukimanController::class, 'dataHasil'])->name('dataHasil');
        });
    });

    Route::prefix('masyarakat')->middleware(['masyarakat'])->group(function () {
        Route::any('/home', [MasyarakatController::class, 'index'])->name('home_masyarakat');
        Route::any('/logout', [MasyarakatController::class, 'logout'])->name('logout_masyarakat');
        Route::any('/data_kriteria', [MasyarakatController::class, 'dataKriteria'])->name('data_kriteria');
        Route::any('/insert_kriteria', [MasyarakatController::class, 'insertKriteria'])->name('simpan_kriteria');
        Route::any('/data_profile', [MasyarakatController::class, 'dataProfile'])->name('data_profile');
        Route::any('/update_profile', [MasyarakatController::class, 'updateProfile'])->name('update_profile');
    });
});
