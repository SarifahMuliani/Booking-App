<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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
date_default_timezone_set('Asia/Jakarta');

// Route::get('clear_cache', function () {
// 	\Artisan::call('cache:clear');
// 	\Artisan::call('config:cache');
// 	\Artisan::call('view:clear');
// 	dd("Sudah Bersih nih!, Silahkan Kembali ke Halaman Utama");
// });

Route::get('page/logout',[HomeController::class,'logout'])->name('logout');
Route::get('auth-login',[HomeController::class,'login'])->name('login');
Route::post('login/cek',[HomeController::class,'ceklogin'])->name('ceklogin');
Route::get('auth-register',[HomeController::class,'register'])->name('register');
Route::post('register/addreg',[HomeController::class,'addreg'])->name('addreg');

Route::get('/',[HomeController::class,'index'])->name('index');
Route::get('sarana/visit/{id_lapangan}',[HomeController::class,'visit'])->name('visit');
Route::get('sarana/cek_boking/{id_lapangan}',[HomeController::class,'cek_boking'])->name('cek_boking');

Route::group(['middleware'=>['auth','ceklevel:Admin']],function()
{
	Route::get('page/home',[AdminController::class,'home'])->name('home');

	Route::get('page/profil',[AdminController::class,'profil_lapangan'])->name('profil_lapangan');
	Route::post('page/profil/{id_profil}',[AdminController::class,'setting'])->name('setting');

	Route::get('page/user',[AdminController::class,'user'])->name('user');
	Route::get('page/pengguna',[AdminController::class,'pengguna'])->name('pengguna');
	Route::post('page/pengguna/update/{id}',[AdminController::class,'edit_pengguna'])->name('edit_pengguna');
	Route::get('page/user/status_user/{id}',[AdminController::class,'status_user'])->name('status_user');

	Route::get('page/sarana',[AdminController::class,'lapangan'])->name('lapangan');
	Route::post('page/sarana/add',[AdminController::class,'add_lapangan'])->name('add_lapangan');
	Route::post('page/sarana/update/{id_lapangan}',[AdminController::class,'update_lapangan'])->name('update_lapangan');
	Route::get('page/sarana/delete/{id_lapangan}',[AdminController::class,'delete_lapangan'])->name('delete_lapangan');
	Route::get('page/sarana/image/{id_lapangan}',[AdminController::class,'image_lapangan'])->name('image');
	Route::post('page/sarana/image/store',[AdminController::class,'store'])->name('store');
	Route::delete('page/sarana/image/delete/{id_image}',[AdminController::class,'delete_image'])->name('delete_image');

	Route::get('page/payment',[AdminController::class,'payment'])->name('payment');
	Route::post('page/payment/add',[AdminController::class,'add_payment'])->name('add_payment');
	Route::post('page/payment/update',[AdminController::class,'update_payment'])->name('update_payment');
	Route::get('page/payment/delete/{id_payment}',[AdminController::class,'delete_payment'])->name('delete_payment');

	Route::get('page/data_sewa',[AdminController::class,'sewa'])->name('sewa');
	Route::get('page/data_sewa/cek_data/{id_sewa}',[AdminController::class,'cek_data'])->name('cek_data');
	// Route::get('user/data_sewa/delete/{id_sewa}',[UserController::class,'delete_sewa'])->name('delete_sewa');
	Route::post('page/data_sewa/cek_data/keterangan',[AdminController::class,'keterangan'])->name('keterangan');
	Route::get('page/data_sewa/cek_data/konfirmasi/{id_sewa}',[AdminController::class,'konfirmasi'])->name('konfirmasi');

	Route::get('page/data/laporan',[AdminController::class,'laporan'])->name('laporan');
	Route::get('page/data/laporan-export',[AdminController::class,'export_laporan'])->name('export_laporan');
});

Route::group(['middleware'=>['auth','ceklevel:Penyewa,Admin']],function()
{
	Route::get('sarana/user/boking/{id_lapangan}/{gambar}',[UserController::class,'boking'])->name('boking');
	Route::post('sarana/user/boking/add',[UserController::class,'add_sewa'])->name('add_sewa');

	Route::get('user/data_sewa/',[UserController::class,'data_sewa'])->name('data_sewa');
	Route::get('user/data_sewa/delete/{id_sewa}',[UserController::class,'delete_sewa'])->name('delete_sewa');
	Route::post('user/data_sewa/upload',[UserController::class,'upload_bukti'])->name('upload_bukti');

	Route::get('user/profil/',[UserController::class,'profil'])->name('profil');
	Route::post('user/profil/lengkapi',[UserController::class,'lengkapi'])->name('lengkapi');
});