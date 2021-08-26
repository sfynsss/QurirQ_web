<?php

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
// Route::get('/token', function ()
// {
//       echo csrf_token(); 
// });

Route::get('/', function () {
    // return view('welcome');
	return redirect('login');
});

Route::get('/privacy_policy', function () {
    // return view('welcome');
	return view('privacy_policy');
});

Route::get('/privacy-policy', function () {
    // return view('welcome');
	return view('privacy-policy');
});

Auth::routes([
	'register' => false, // Registration Routes...
  	'reset' => false, // Password Reset Routes...
  	'verify' => false, // Email Verification Routes...
]);

Route::post('notifPembayaran', 'PembayaranController@notification');
Route::get('/midtrans/pay','PembayaranController@getPayment');
Route::get('/coba', "MidtransController@getSnapToken");
Route::post('/coba/charge', "MidtransController@getSnapToken");

Route::get('auth/activate', 'Auth\ActivationController@activate');
Route::get('auth/forgetPassword', 'Auth\ActivationController@forget');
Route::post('auth/gantiPassword', 'Auth\ActivationController@ganti');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/downloadData', 'HomeController@downloadData');

//Barang
Route::get('barang', 'BarangController@barang');
Route::get('barang/json', 'BarangController@datajson');
Route::get('detail_barang/{kd_brg}', 'BarangController@detail_barang');
Route::post('barang/import', 'BarangController@import');
Route::get('kategori_barang', 'BarangController@kategori_barang');
Route::post('edit_kategori', 'BarangController@edit_kategori');
Route::post('barang/input_kategori', 'BarangController@inputKategori');
Route::post('barang/edit_barang', 'BarangController@edit_barang');
//endOfBarang

//penjualan
Route::get('penjualan', 'PenjualanController@index');
Route::get('invoice/{id}', 'PenjualanController@detailJual');
Route::get('detPenjualan/{no_ent}', 'PenjualanController@detPenjualan');

Route::get('orderPenjualan', 'PenjualanController@orderPenjualan');
Route::get('detailOrder/{id}', 'PenjualanController@detailOrder');
Route::post('inputResi', 'PenjualanController@inputResi');
Route::post('simpanPenjualan', 'PenjualanController@simpanPenjualan');
Route::post('gantiStatusTransaksi', 'PenjualanController@gantiStatusTransaksi');

Route::get('penjualanPickup', 'PenjualanController@penjualanPickup');
Route::get('penjualanCOD', 'PenjualanController@penjualanCOD');
Route::get('penjualanJNE', 'PenjualanController@penjualanJNE');
Route::get('penjualanJNT', 'PenjualanController@penjualanJNT');
Route::get('penjualanPOS', 'PenjualanController@penjualanPOS');

Route::get('laporanPenjualan', 'PenjualanController@laporanPenjualan');
//endOfPenjualan

//customer
Route::get('/customer', 'CustomerController@index');
Route::get('/customerGrosir', 'CustomerController@customerGrosir');
Route::post('/tambahCustomer', 'CustomerController@tambahCustomer');
Route::post('/editCustomer', 'CustomerController@editCustomer');
Route::get('/sinkronisasi', 'CustomerController@sinkronisasi');
Route::get('/downloadCustomer', 'CustomerController@downloadCustomer');
Route::get('/pointCustomer', 'CustomerController@pointCustomer');
Route::get('/aktifasiAkun/{id}', 'CustomerController@aktifasiAkun');
Route::get('/deaktifasiAkun/{id}', 'CustomerController@deaktifasiAkun');
Route::post('/editPointCustomer', 'CustomerController@editPointCustomer');
Route::get('/recordPointEdit', 'CustomerController@recordPointEdit');
//endOfCustomer

//voucher
Route::get('/settingVoucher', 'VoucherController@settingVoucher');
Route::get('/settingPoint', 'VoucherController@settingPoint');
Route::post('/tambahSettingVoucher', 'VoucherController@tambahSettingVoucher');
Route::post('/tambahSettingPoint', 'VoucherController@tambahSettingPoint');

Route::get('/voucherFisik', 'VoucherController@voucherFisik');
Route::get('/eVoucher', 'VoucherController@eVoucher');
Route::get('/voucherGlobal', 'VoucherController@voucherGlobal');
Route::post('/tambahVoucher', 'VoucherController@tambahVoucher');
Route::get('/tukarVoucher', 'VoucherController@tukarVoucher');
Route::get('/sinkronisasiVoucher', 'VoucherController@sinkronisasiVoucher');
Route::get('validasiVoucher', 'VoucherController@validasi');	
Route::post('penukaranVoucher', 'VoucherController@penukaranVoucher');	
//endOfVoucher

//notif
Route::get('/notification', 'NotificationController@index');
Route::post('notifGlobal', 'NotificationController@notifGlobal');
Route::get('notifMultiDevice', 'NotificationController@toMultiDevice');
//endOfNotif

//user
Route::get('/cabang', 'CustomerController@cabang');
Route::post('/tambahCabang', 'CabangController@tambahCabang');
Route::post('/updateCabang', 'CabangController@updateCabang');
//endOfUser

//user
Route::get('/user/{id}/{kd_outlet}', 'UserController@index');
Route::post('/tambahUser/{id}', 'UserController@tambahUser');
Route::get('/editUser/{id}', 'UserController@editUser');
Route::post('/updateUser', 'UserController@updateUser');
//endOfUser

//email
Route::get('/send/email', 'HomeController@mail');
//endOfEmail

//setting
Route::get('/penawaran', 'PenawaranController@index');
Route::post('inputPenawaran', 'PenawaranController@inputPenawaran');
Route::post('/updatePenawaran', 'PenawaranController@updatePenawaran');
Route::get('/deletePenawaran/{id}', 'PenawaranController@deletePenawaran');

Route::get('/gambarPromo', 'PenawaranController@gambarPromo');
Route::post('inputGambarPromo', 'PenawaranController@inputGambarPromo');
Route::post('/updateGambarPromo', 'PenawaranController@updateGambarPromo');
Route::get('/deleteGambarPromo/{id}', 'PenawaranController@deleteGambarPromo');
//endofSetting

//promo
Route::get('/promo', 'PromoController@index');
Route::post('/updatePromo', 'PromoController@updatePromo');

//ongkir cod
Route::get('/ongkircod', 'OngkirCodController@index');
Route::post('/tambahOngkirCod', 'OngkirCodController@tambahOngkirCod');
Route::get('/editOngkirCod/{id}', 'OngkirCodController@editOngkirCod');
Route::post('/updateOngkirCod', 'OngkirCodController@updateOngkirCod');
Route::get('/deleteOngkirCod/{id}', 'OngkirCodController@deleteOngkirCod');


//outlet
Route::get('/outlet', 'OutletController@index');
Route::post('/tambahOutlet', 'OutletController@tambahOutlet');
Route::post('/ubahOutlet', 'OutletController@ubahOutlet');
Route::get('/deleteOutlet/{id}', 'OutletController@deleteOutlet');

Route::get('/detailOutlet/{id}', 'OutletController@detailOutlet');
Route::post('/tambahKategoriOutlet', 'OutletController@tambahKategoriOutlet');
Route::get('/deleteKategoriOutlet/{id}', 'OutletController@deleteKategoriOutlet');

//pembayaran
Route::post('/getStatusPembayaran', 'PembayaranController@get_transaction_status');

// Cron job Get Paid
Route::get('/cronjob_pembayaran', 'PembayaranController@get_paid')->name('getpaid');

//Print Ticket
Route::get('/print_ticket/{id}', 'PenjualanController@print_ticket');