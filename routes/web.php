<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ResepObatController;
use App\Http\Controllers\PemeriksaanDokterController;
use App\Http\Controllers\PemeriksaanPerawatController;

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

Route::get('/', function () {
    return view('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', ['title' => 'Dashboard Admin']);
    });
});


//Login
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/loginproses', 'loginproses')->name('loginproses');
    Route::get('/logout', 'logout')->name('logout');

    // Register
    Route::get('/register', 'register')->name('register');
    Route::post('/registeruser', 'registeruser')->name('registeruser');
    Route::post('/registeradmin', 'registeradmin')->name('registeradmin');
});

//Data User
Route::controller(UserController::class)->group(function () {
    Route::get('/useradmin', 'index');
    Route::get('/tambahuser', 'tambahuser');
    Route::post('/tambahdatauser', 'tambahdatauser');
    Route::get('/tampilkandatauser/{id}', 'tampilkandatauser');
    Route::post('/updatedatauser/{id}', 'updatedatauser');
    Route::get('/happussss/{id}', 'hapus');

    Route::get('/batal', 'tambahuser');
});

//Role Admin
Route::middleware(['auth', 'hakakses:admin,loket,dokter,perawat,apoteker'])->group(function () {
    //Pasien
    Route::controller(PasienController::class)->group(function () {
        Route::get('/pasien', 'index');
        Route::get('/tambahpasien', 'tambahpasien');
        Route::post('/aksi_tambah_pasien', 'aksi_tambah_pasien');
        Route::get('/editpasien/{id}', 'editpasien');
        Route::post('/aksi_edit_pasien/{id}', 'aksi_edit_pasien');
        Route::get('/hapus/{id}', 'hapus');

        //Eksport PDF
        Route::get('/eksportpdf', 'eksportpdf');
        //Eksport Excel
        Route::get('/eksportexcel', 'eksportexcel');


        Route::get('/cancel', 'tambahwisataadmin');
    });

    //Obat
    Route::controller(ObatController::class)->group(function () {
        Route::get('/obat', 'index');
        Route::get('/tambahobat', 'tambahobat');
        Route::post('/aksi_tambah_obat', 'aksi_tambah_obat');
        Route::get('/editobat/{id}', 'editobat');
        Route::post('/aksi_edit_obat/{id}', 'aksi_edit_obat');
        Route::get('/hapusss/{id}', 'hapus');

        //Eksport PDF
        Route::get('/ekspoortpdf', 'ekspoortpdf');
        //Eksport Excel
        Route::get('/eksportexcell', 'eksportexcell');

        Route::get('/batall', 'tambahobat');
    });

    //Pemeriksaan Dokter
    Route::controller(PemeriksaanDokterController::class)->group(function () {
        Route::get('/pemeriksaandokter', 'index');
        Route::post('/aksi_input_resumemedis/{id}', 'aksi_input_resumemedis');
        Route::get('/detailpemeriksaandokter/{id}', 'detailpemeriksaandokter');
        Route::get('/tambahpemeriksaandokter', 'tambahpemeriksaandokter');
        Route::post('/aksi_tambah_pemeriksaan_perawat', 'aksi_tambah_pemeriksaan_perawat');
        Route::get('/inputpemeriksaandokter/{id}', 'inputpemeriksaandokter');
        Route::get('/hapuss/{id}', 'hapus');

        //Eksport PDF
        Route::get('/Ekspooortpdf', 'Ekspooortpdf');
        Route::get('/bataal', 'tambahpemeriksaandokter');
    });
    
    //Pemeriksaan Perawat
    Route::controller(PemeriksaanPerawatController::class)->group(function () {
        Route::get('/pemeriksaanperawat', 'index');
        Route::post('/aksi_input_vitalsign/{id}', 'aksi_input_vitalsign');
        Route::get('/detailpemeriksaanperawat/{id}', 'detailpemeriksaanperawat');
        Route::get('/detailpemeriksaanpasien', 'detailpemeriksaanpasien');
        Route::get('/inputpemeriksaanperawat/{id}', 'inputpemeriksaanperawat');
        Route::get('/hapuss/{id}', 'hapus');

        //Eksport PDF
        Route::get('/EKSPORTpdf', 'EKSPORTpdf');
        Route::get('/bataal', 'inputpemeriksaanperawat');
    });

    //ResepObat
    Route::controller(ResepObatController::class)->group(function () {
        Route::get('/resepobat', 'index');
        Route::get('/inputresepobat/{id}', 'inputresepobat');
        Route::post('/aksi_input_resep/{id}', 'aksi_input_resep');
        Route::get('/detailresepobat/{id}', 'detailresepobat');
        Route::get('/editresepobat/{id}', 'editresepobat');
        Route::post('/aksi_edit_resep/{id}', 'aksi_edit_resep');
        Route::get('/hapussss/{id}', 'hapus');

        //Eksport PDF
        Route::get('/EKspooortpdf', 'EKspooortpdf');

        Route::get('/batal', 'inputresepobat');
    });

    //Data User
    Route::controller(UserController::class)->group(function () {
        Route::get('/useradmin', 'index');
        Route::get('/tambahuser', 'tambahuser');
        Route::post('/tambahdatauser', 'tambahdatauser');
        Route::get('/tampilkandatauser/{id}', 'tampilkandatauser');
        Route::post('/updatedatauser/{id}', 'updatedatauser');
        Route::get('/happussss/{id}', 'hapus');

        Route::get('/batal', 'tambahuser');
    });

});
