<?php

namespace QurirQ\Http\Controllers\Api;

use Illuminate\Http\Request;
use QurirQ\Http\Controllers\Controller;
use QurirQ\Cart;
use QurirQ\Wishlist;
use QurirQ\MstJual;
use QurirQ\DetJual;
use QurirQ\MstQsend;
use QurirQ\DetQsend;
use QurirQ\Customer;
use QurirQ\VwMstJual;
use QurirQ\MstOrderJual;
use QurirQ\DetOrderJual;
use QurirQ\Voucher;
use QurirQ\User;
use QurirQ\Komisi;
use QurirQ\JurnalKeuangan;
use Illuminate\Support\Facades\Auth;
use DB;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class PenjualanController extends Controller
{
	public function cekOutlet(Request $request)
	{
		$outlet = Cart::select('id_outlet')->where('id_user', '=', Auth::user()->id)->first();
		
		if ($outlet->id_outlet == $request->id_outlet) {
			return response()->json(['message' => 'Outlet sama'], 200);
		} else {
			return response()->json(['message' => 'Outlet beda'], 400);
		}
	}
	
	public function inputToCart(Request $request)
	{
		$get = false;
		
		if($request->status == "") {
			$get = Cart::where('id_user', '=', $request->id_user)
			->where('id_barang', '=', $request->id_barang)
			->where('id_outlet', '=', $request->id_outlet)
			->first();	
		} else {
			$delete = Cart::where('id_user', '=', Auth::user()->id)
			->delete();
		}
		
		if ($get) {
			$update = Cart::where('id_user', '=', $request->id_user)
			->where('id_barang', '=', $request->id_barang)
			->where('id_outlet', '=', $request->id_outlet) 
			->increment("qty", $request->qty);
			
			if ($update) {
				return response()->json(['message' => 'Jumlah Barang ditambahkan'], 200);
			} else {
				return response()->json(['message' => 'Update Jumlah Barang Gagal'], 401);
			}	
		} else {
			if ($request->gambar == "") {
				$insert = Cart::insert([
					"id_user"			=> $request->id_user,
					"id_barang"			=> $request->id_barang,
					"nm_brg"			=> $request->nm_brg,
					"satuan1"			=> $request->satuan1,
					"harga_jl"			=> str_replace(",", "", number_format($request->harga_jl)),
					"qty"				=> $request->qty,
					"gambar"			=> "",
					"kategori_barang"	=> $request->kategori, 
					"id_outlet"			=> $request->id_outlet,
				]);
			} else {
				$insert = Cart::insert([
					"id_user"			=> $request->id_user,
					"id_barang"			=> $request->id_barang,
					"nm_brg"			=> $request->nm_brg,
					"satuan1"			=> $request->satuan1,
					"harga_jl"			=> str_replace(",", "", number_format($request->harga_jl)),
					"qty"				=> $request->qty,
					"gambar"			=> $request->gambar,
					"kategori_barang"	=> $request->kategori, 
					"id_outlet"			=> $request->id_outlet,
				]);
			}
			
			if ($insert) {
				return response()->json(['message' => 'Input Data Berhasil'], 200);
			} else {
				return response()->json(['message' => 'Input Data Gagal'], 401);
			}	
		}
	}
	
	public function getDataCart(Request $request)
	{
		$data = Cart::select('cart.*', 'barang.gambar', 'barang.sts_point', 'outlet.nama_outlet', 'outlet.lat', 'outlet.long')
		->where('id_user', '=', $request->id_user)
		->where('cart.harga_jl', '!=', '0')
		->join('barang', 'barang.id', '=', 'cart.id_barang')
		->join('users', 'users.id', '=', 'cart.id_user')
		->join('outlet', 'outlet.id', '=', 'cart.id_outlet')
		->get();
		
		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}
	
	public function getDataCartGrosir(Request $request)
	{
		$data = Cart::select('cart.*', 'barang.gambar', 'barang.sts_point')
		->where('id_user', '=', $request->id_user)
		->where('barang.kd_outlet', '=', $request->kd_outlet)
		->join('barang', 'barang.id', '=', 'cart.id_barang')
		->join('users', 'users.id', '=', 'cart.id_user')
		->where('users.otoritas', '=', 'GROSIR')
		->get();
		
		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}
	
	public function updateCart(Request $request)
	{
		$update = Cart::where('id_user', '=', $request->id_user)->where('id_barang', '=', $request->kd_brg)->update([
			"qty"				=> $request->qty,
		]);
		
		if ($update) {
			return response()->json(['message' => 'Update Jumlah Barang Berhasil'], 200);
		} else {
			return response()->json(['message' => 'Update Jumlah Barang Gagal'], 401);
		}	
	}
	
	public function deleteCart(Request $request)
	{
		$delete = Cart::where('id_user', '=', $request->id_user)->where('id_barang', '=', $request->kd_brg)->delete();
		
		if ($delete) {
			return response()->json(['message' => 'Barang Berhasil Dihapus'], 200);
		} else {
			return response()->json(['message' => 'Barang Gagal Dihapus'], 401);
		}	
	}
	
	public function inputToWishlist(Request $request)
	{
		$get = Wishlist::where('id_user', '=', $request->id_user)->where('kd_brg', '=', $request->kd_brg)->first();
		
		if ($get) {
			return response()->json(['message' => 'Barang sudah ada dalam favorit'], 201);
		} else {
			$insert = Wishlist::insert([
				"id_user"			=> $request->id_user,
				"kd_brg"			=> $request->kd_brg,
				"nm_brg"			=> $request->nm_brg,
				"satuan1"			=> $request->satuan1,
				"harga_jl"			=> $request->harga_jl,
				"berat"				=> $request->berat,
				"volume"			=> $request->volume,
				"gambar"			=> $request->gambar,
				"kategori_barang"	=> $request->kategori
			]);
			
			if ($insert) {
				return response()->json(['message' => 'Input Data Berhasil'], 200);
			} else {
				return response()->json(['message' => 'Input Data Gagal'], 401);
			}	
		}
	}
	
	public function getDataWishlist(Request $request)
	{
		$data = Wishlist::where('id_user', '=', $request->id_user)->get();
		
		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}
	
	public function deleteWishlist(Request $request)
	{
		$delete = Wishlist::where('id_user', '=', $request->id_user)->where('kd_brg', '=', $request->kd_brg)->delete();
		
		if ($delete) {
			return response()->json(['message' => 'Barang Berhasil Dihapus'], 200);
		} else {
			return response()->json(['message' => 'Barang Gagal Dihapus'], 401);
		}	
	}
	
	public function getNoEnt(Request $request)
	{
		$no_ent = MstJual::where('id_user', '=', $request->id)->orderBy('no_ent', 'desc')->first();
		// $kd_cust = Customer::select('kd_cust')->where('id', '=', $request->id)->first();
		
		date_default_timezone_set("Asia/Jakarta");
		
		if ($no_ent) {
			$data = (int) substr($no_ent->no_ent, 15, 8) + 1;
			// print_r($data);
			$tmp = "INVJ".date('md').'/'.sprintf("%'.05d", $request->id).'/'.sprintf("%'.08d", $data);
		} else {
			$tmp = "INVJ".date('md').'/'.sprintf("%'.05d", $request->id).'/'.sprintf("%'.08d", 1);
		}
		
		return response()->json($tmp, 200);
	}
	
	public function inputPenjualan(Request $request)
	{
		$mst = MstJual::insertGetId([
			'id_user'			=> $request->id_user,
			'nama_penerima'		=> $request->nama_penerima,
			'alamat_penerima'	=> $request->alamat_penerima,
			'no_telp_penerima'	=> $request->no_telp_penerima,
			'lat_penerima'		=> $request->lat_penerima,
			'lng_penerima'		=> $request->lng_penerima,
			'jns_bayar'			=> $request->jns_bayar,
			'ongkir'			=> $request->ongkir,
			'netto'				=> $request->netto,
			'grand_total'		=> $request->grand_total,
			'sts_byr'			=> $request->sts_bayar,
			'id_outlet'			=> $request->kd_outlet,
			'komisi_outlet'		=> $request->komisi_outlet,
			'komisi_qurir'		=> $request->komisi_qurir
		]);
		
		$tmp_kd_brg			= explode(";", $request->kd_brg);
		$tmp_nm_brg			= explode(";", $request->nm_brg);
		$tmp_harga			= explode(";", $request->harga);
		$tmp_jumlah			= explode(";", $request->jumlah);
		
		for ($i=0; $i < count($tmp_kd_brg); $i++) { 
			$subtot = ($tmp_harga[$i] * $tmp_jumlah[$i]);
			$det = DetJual::insert([
				"id_mst"		=>	$mst,
				"id_barang"		=>	$tmp_kd_brg[$i],
				"nm_brg"		=>	$tmp_nm_brg[$i],
				"harga"			=>	$tmp_harga[$i],
				"jumlah"		=>	$tmp_jumlah[$i],
				"sub_total"		=>	$subtot
			]);
		}
		
		if ($det) {
			$delete = Cart::where('id_user', '=', $request->id_user)->delete();
			if($request->jns_bayar == "BAYAR DITEMPAT") {
				$user = User::where('id_outlet', '=', $request->kd_outlet)->first();
				$optionBuilder = new OptionsBuilder();
				$optionBuilder->setTimeToLive(60*20);
				
				$notificationBuilder = new PayloadNotificationBuilder("Pesanan Baru");
				$notificationBuilder->setBody("Pesanan Baru Diterima")
				->setSound('default')
				->setClickAction('act_home')
				->setBadge(1);
				
				$dataBuilder = new PayloadDataBuilder();
				$option = $optionBuilder->build();
				$notification = $notificationBuilder->build();
				$dt = $dataBuilder->build();
				
				$downstreamResponse = FCM::sendTo($user->firebase_token, $option, $notification, $dt);
				$downstreamResponse->numberSuccess();
				$downstreamResponse->numberFailure();
				$downstreamResponse->numberModification();
				$downstreamResponse->tokensToDelete();
				$downstreamResponse->tokensToModify();
				$downstreamResponse->tokensToRetry();
				$downstreamResponse->tokensWithError();
			}
			
			if ($delete) {
				return response()->json(['message' => $mst], 200);
			} else {
				return response()->json('Hapus Cart gagal', 404);	
			}
		} else {
			return response()->json('Update gagal', 404);
		}
	}
	
	public function getDataTransaksi(Request $request)
	{
		$data = MstJual::select('mst_jual.id', 'mst_jual.id_user', 'mst_jual.sts_byr', 'mst_jual.jns_bayar', 'mst_jual.tanggal', 'mst_jual.grand_total as total', 'mst_jual.ongkir', 
		DB::raw('count(det_jual.id_mst) AS jumlah'), 'mst_jual.sts_transaksi', 'outlet.nama_outlet', 'users.name', 'users.no_telp')
		->join('det_jual', 'det_jual.id_mst', '=', 'mst_jual.id')
		->join('outlet', 'outlet.id', '=', 'mst_jual.id_outlet')
		->leftjoin('users', 'users.id', '=', 'mst_jual.id_qurir')
		->where('mst_jual.id_user', '=', $request->id)
		->groupby('mst_jual.id', 'mst_jual.id_user', 'mst_jual.sts_byr', 'mst_jual.jns_bayar', 'mst_jual.tanggal',
		'mst_jual.ongkir', 'mst_jual.grand_total', 'mst_jual.sts_transaksi', 'outlet.nama_outlet', 'users.name', 'users.no_telp')->orderBy('mst_jual.id')->get();
		
		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}
	
	public function getDataTransaksiQsend(Request $request)
	{
		$data = MstQsend::select('mst_qsend.*', 'users.name as qurir_name', 'users.no_telp as no_telp_qurir')->leftjoin('det_qsend', 'det_qsend.id_mst', '=', 'mst_qsend.id')->leftjoin('users', 'users.id', '=', 'mst_qsend.id_qurir')
		->where('mst_qsend.id_user', '=', $request->id)
		// ->where('mst_qsend.sts_transaksi', '!=', 'SELESAI')
		// ->where('mst_qsend.sts_transaksi', '!=', 'BATAL')
		->get();
		
		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}
	
	public function getTransaksiDriver(Request $request)
	{
		$data = MstJual::select('mst_jual.id as id_mst', 'mst_jual.*', 'outlet.alamat as alamat_outlet', 'outlet.*', 'users.*')->join('outlet', 'outlet.id', '=', 'id_outlet')->join('users', 'users.id_outlet', '=', 'outlet.id')
		->where('mst_jual.id_qurir', '=', $request->id)
		->where('mst_jual.sts_transaksi', '!=', 'SELESAI')
		->where('mst_jual.sts_transaksi', '!=', 'BATAL')
		->get();
		
		$data1 = MstQsend::join('det_qsend', 'det_qsend.id_mst', '=', 'mst_qsend.id')
		->where('mst_qsend.id_qurir', '=', $request->id)
		->where('mst_qsend.sts_transaksi', '!=', 'SELESAI')
		->where('mst_qsend.sts_transaksi', '!=', 'BATAL')
		->get();
		
		if (count($data) > 0) {
			return response()->json(['message' => 'Q-Food', 'data' => $data], 200);
		} else if(count($data1) > 0) {
			return response()->json(['message' => 'Q-Send', 'data' => $data1], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}
	
	public function updateStatusTransaksiQsend(Request $request)
	{
		$data = MstQsend::where('id', '=', $request->id)->update([
			"sts_transaksi" => $request->status
		]);
		
		if ($data) {
			return response()->json(['message' => 'Data Berhasil Dirubah'], 200);
		} else {
			return response()->json(['message' => 'Data Gagal Dirubah'], 401);
		}
	}
	
	public function updateStatusTransaksiQsendSelesai(Request $request)
	{
		$data = MstQsend::where('id', '=', $request->id)->update([
			"sts_transaksi" => $request->status
		]);
		
		if ($data) {
			$mst = MstQsend::where('id', '=', $request->id)->first();
			$qurir = User::where('id', '=', $mst->id_qurir)->first();
			if($mst->jns_bayar != 'BAYAR DITEMPAT'){
				$update1 = User::where('id', '=', $mst->id_qurir)->update([
					'saldo' 	=> $qurir->saldo + ($mst->total - $mst->komisi)
				]);
				
				$insert1 = JurnalKeuangan::insert([
					'id_user'			=> $mst->id_qurir,
					'jns_transaksi'		=> 'Q-Send',
					'saldo_awal'		=> $qurir->saldo,
					'masuk'				=> $mst->total - $mst->komisi,
					'saldo_akhir'		=> ($qurir->saldo + $mst->total - $mst->komisi)
				]);
				
				if($update1 && $insert1) {
					return response()->json(['message' => 'Data Berhasil Dirubah'], 200);
				} else {
					return response()->json(['message' => 'Data Berhasil Dirubah, Saldo tidak terupdate'], 200);
				}
			} else {
				$update1 = User::where('id', '=', $mst->id_qurir)->update([
					'saldo' 	=> $qurir->saldo - $mst->komisi
				]);
				
				$insert1 = JurnalKeuangan::insert([
					'id_user'			=> $mst->id_qurir,
					'jns_transaksi'		=> 'Q-Send',
					'saldo_awal'		=> $qurir->saldo,
					'keluar'			=> $mst->komisi,
					'saldo_akhir'		=> ($qurir->saldo - $mst->komisi)
				]);
				
				if($update1 && $insert1) {
					return response()->json(['message' => 'Data Berhasil Dirubah'], 200);
				} else {
					return response()->json(['message' => 'Data Berhasil Dirubah, Saldo tidak terupdate'], 200);
				}
			}
		} else {
			return response()->json(['message' => 'Data Gagal Dirubah'], 401);
		}
	}
	
	public function getTransaksiOutlet(Request $request)
	{
		$data = MstJual::select('mst_jual.id', 'mst_jual.nama_penerima',DB::raw('count(det_jual.id_mst) AS jumlah'), 'mst_jual.sts_transaksi', 'outlet.lat as lat_penerima', 'outlet.long as lng_penerima')
		->join('det_jual', 'det_jual.id_mst', '=', 'mst_jual.id')
		->join('outlet', 'outlet.id', '=', 'mst_jual.id_outlet')
		->where('mst_jual.id_outlet', '=', $request->id)->where('mst_jual.sts_byr', '=', '2')
		->where('mst_jual.sts_transaksi', '!=', 'SELESAI')->where('mst_jual.sts_transaksi', '!=', 'BATAL')->where('mst_jual.sts_transaksi', '!=', 'DITOLAK')
		->groupby('mst_jual.id', 'mst_jual.nama_penerima', 'mst_jual.sts_transaksi', 'mst_jual.lat_penerima', 'mst_jual.lng_penerima', 'outlet.lat', 'outlet.long')->orderBy('mst_jual.id')->get();
		
		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}
	
	public function getHistoryTransaksiOutlet()
	{
		$data = MstJual::select('mst_jual.id', 'mst_jual.tanggal', 'mst_jual.grand_total as total', 'outlet.nama_outlet')
		->join('det_jual', 'det_jual.id_mst', '=', 'mst_jual.id')
		->join('outlet', 'outlet.id', '=', 'mst_jual.id_outlet')
		->where('mst_jual.id_outlet', '=', Auth::user()->id_outlet)->where('mst_jual.sts_byr', '=', '2')
		->where('mst_jual.sts_transaksi', '=', 'SELESAI')->orwhere('mst_jual.sts_transaksi', '=', 'BATAL')->orwhere('mst_jual.sts_transaksi', '=', 'DITOLAK')
		->groupby('mst_jual.id', 'mst_jual.tanggal', 'mst_jual.grand_total', 'outlet.nama_outlet')->orderBy('mst_jual.id')->get();
		
		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}
	
	public function getJumlahTransaksiOutlet()
	{
		$data = MstJual::where('mst_jual.id_outlet', '=', Auth::user()->id_outlet)->where('mst_jual.sts_transaksi', '=', 'SELESAI')->count();
		
		if ($data > 0) {
			return response()->json(['message' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}
	
	public function getDataTransaksiSukses(Request $request)
	{
		$data = MstJual::select('mst_jual.no_ent', 'mst_jual.id_user', 'mst_jual.sts_byr', 'mst_jual.tanggal', 'mst_jual.jns_pengiriman', 'mst_jual.netto as total', 'mst_jual.ongkir', 'mst_jual.disc_value', DB::raw('count(det_jual.no_ent) AS jumlah'), 'mst_jual.payment_type', 'mst_jual.bank_name', 'mst_jual.va_number', 'mst_jual.sts_transaksi')->join('det_jual', 'det_jual.no_ent', '=', 'mst_jual.no_ent')
		->where('mst_jual.id_user', '=', $request->id)
		->where('mst_jual.sts_transaksi', '!=', 'SELESAI')
		->where('mst_jual.sts_transaksi', '!=', 'BATAL')
		->groupby('mst_jual.no_ent', 'mst_jual.id_user', 'mst_jual.sts_byr', 'mst_jual.tanggal', 'mst_jual.jns_pengiriman', 'mst_jual.ongkir', 'mst_jual.disc_value', 'mst_jual.netto', 'mst_jual.payment_type', 'mst_jual.bank_name', 'mst_jual.va_number', 'mst_jual.sts_transaksi')
		->orderBy('mst_jual.no_ent')->get();
		
		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}
	
	public function getDataTransaksiPending(Request $request)
	{
		$data = MstJual::select('mst_jual.no_ent', 'mst_jual.id_user', 'mst_jual.sts_byr', 'mst_jual.tanggal', 'mst_jual.jns_pengiriman', 'mst_jual.netto as total', 'mst_jual.ongkir', 'mst_jual.disc_value', DB::raw('count(det_jual.no_ent) AS jumlah'), 'mst_jual.payment_type', 'mst_jual.bank_name', 'mst_jual.va_number', 'mst_jual.sts_transaksi')->join('det_jual', 'det_jual.no_ent', '=', 'mst_jual.no_ent')
		->where('mst_jual.id_user', '=', $request->id)
		->where('mst_jual.sts_transaksi', '=', 'MASUK')->groupby('mst_jual.no_ent', 'mst_jual.id_user', 'mst_jual.sts_byr', 'mst_jual.tanggal', 'mst_jual.jns_pengiriman', 'mst_jual.ongkir', 'mst_jual.disc_value', 'mst_jual.netto', 'mst_jual.payment_type', 'mst_jual.bank_name', 'mst_jual.va_number', 'mst_jual.sts_transaksi')->orderBy('mst_jual.no_ent')->get();
		
		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}
	
	public function getDataTransaksiBatal(Request $request)
	{
		$data = MstJual::select('mst_jual.no_ent', 'mst_jual.id_user', 'mst_jual.sts_byr', 'mst_jual.tanggal', 'mst_jual.jns_pengiriman', 'mst_jual.netto as total', 'mst_jual.ongkir', 'mst_jual.disc_value', DB::raw('count(det_jual.no_ent) AS jumlah'), 'mst_jual.payment_type', 'mst_jual.bank_name', 'mst_jual.va_number', 'mst_jual.sts_transaksi')->join('det_jual', 'det_jual.no_ent', '=', 'mst_jual.no_ent')
		->where('mst_jual.id_user', '=', $request->id)
		->where('mst_jual.sts_transaksi', '=', 'BATAL')
		->groupby('mst_jual.no_ent', 'mst_jual.id_user', 'mst_jual.sts_byr', 'mst_jual.tanggal', 'mst_jual.jns_pengiriman', 'mst_jual.ongkir', 'mst_jual.disc_value', 'mst_jual.netto', 'mst_jual.payment_type', 'mst_jual.bank_name', 'mst_jual.va_number', 'mst_jual.sts_transaksi')
		->orderBy('mst_jual.no_ent')->get();
		
		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}
	
	public function getDetailTransaksi(Request $request)
	{
		$data = DetJual::where('id_mst', '=', $request->id)->get();
		
		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}
	
	public function getDetailQsend(Request $request)
	{
		$data = DetQsend::where('id_mst', '=', $request->id)->get();
		
		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}
	
	public function batalkanTransaksi(Request $request)
	{
		$data = MstJual::where('id', '=', $request->id)->update([
			'sts_transaksi' => 'BATAL'
		]);
		
		if ($data) {
			return response()->json(['message' => 'Data Berhasil Dirubah'], 200);
		} else {
			return response()->json(['message' => 'Data Gagal Dirubah'], 401);
		}
	}
	
	public function updateStatusTransaksi(Request $request)
	{
		$data = MstJual::where('id', '=', $request->id)->update([
			"sts_transaksi" => $request->status
		]);
		
		if ($data) {
			return response()->json(['message' => 'Data Berhasil Dirubah'], 200);
		} else {
			return response()->json(['message' => 'Data Gagal Dirubah'], 401);
		}
	}
	
	public function updateStatusTransaksiSelesai(Request $request)
	{
		$data = MstJual::where('id', '=', $request->id)->update([
			"sts_transaksi" => $request->status
		]);
		
		if ($data) {
			$mst = MstJual::where('id', '=', $request->id)->first();
			$resto = User::where('id', '=', $mst->id_outlet)->first();
			$qurir = User::where('id', '=', $mst->id_qurir)->first();
			if($mst->jns_bayar != 'BAYAR DITEMPAT'){
				$update = User::where('id', '=', $mst->id_outlet)->update([
					'saldo' 	=> $mst->netto - $mst->komisi_outlet
				]);
				
				$insert = JurnalKeuangan::insert([
					'id_user'			=> $mst->id_outlet,
					'jns_transaksi'		=> 'Q-Food',
					'saldo_awal'		=> $resto->saldo,
					'masuk'				=> $mst->netto - $mst->komisi_outlet,
					'saldo_akhir'		=> ($resto->saldo + $mst->netto - $mst->komisi_outlet)
				]);
				
				$update1 = User::where('id', '=', $mst->id_qurir)->update([
					'saldo' 	=> $mst->ongkir - $mst->komisi_qurir
				]);
				
				$insert1 = JurnalKeuangan::insert([
					'id_user'			=> $mst->id_qurir,
					'jns_transaksi'		=> 'Q-Food',
					'saldo_awal'		=> $qurir->saldo,
					'masuk'				=> $mst->ongkir - $mst->komisi_qurir,
					'saldo_akhir'		=> ($qurir->saldo + $mst->ongkir - $mst->komisi_qurir)
				]);
				
				if($update && $insert && $update1 && $insert1) {
					return response()->json(['message' => 'Data Berhasil Dirubah'], 200);
				} else {
					return response()->json(['message' => 'Data Berhasil Dirubah, Saldo tidak terupdate'], 200);
				}
			} else {
				$update = User::where('id', '=', $mst->id_outlet)->update([
					'saldo' 	=> $resto->saldo - $mst->komisi_outlet
				]);
				
				$insert = JurnalKeuangan::insert([
					'id_user'			=> $mst->id_outlet,
					'jns_transaksi'		=> 'Q-Food',
					'saldo_awal'		=> $resto->saldo,
					'keluar'			=> $mst->komisi_outlet,
					'saldo_akhir'		=> ($resto->saldo - $mst->komisi_outlet)
				]);
				
				$update1 = User::where('id', '=', $mst->id_qurir)->update([
					'saldo' 	=> $qurir->saldo - $mst->komisi_qurir
				]);
				
				$insert1 = JurnalKeuangan::insert([
					'id_user'			=> $mst->id_qurir,
					'jns_transaksi'		=> 'Q-Food',
					'saldo_awal'		=> $qurir->saldo,
					'keluar'			=> $mst->komisi_qurir,
					'saldo_akhir'		=> ($qurir->saldo - $mst->komisi_qurir)
				]);
				
				if($update && $insert && $update1 && $insert1) {
					return response()->json(['message' => 'Data Berhasil Dirubah'], 200);
				} else {
					return response()->json(['message' => 'Data Berhasil Dirubah, Saldo tidak terupdate'], 200);
				}
			}
		} else {
			return response()->json(['message' => 'Data Gagal Dirubah'], 401);
		}
	}
	
	public function updateStatusTransaksiDiterima(Request $request)
	{
		$update = MstJual::where('id', '=', $request->id)->update([
			"sts_transaksi" => $request->status
		]);
		
		if ($update) {
			// $data = User::where('otoritas', '=', 'DRIVER')->where('sts_online', '=', '1')->get();
			$mst = MstJual::join('outlet', 'outlet.id', '=', 'mst_jual.id_outlet')->where('mst_jual.id', '=', $request->id)->first();
			
			$lat = $mst->lat;
			$lng = $mst->long;
			$data = DB::table("users")
			->select("users.id", "users.firebase_token"
			,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
			* cos(radians(users.lat_driver)) 
			* cos(radians(users.lng_driver) - radians(" . $lng . ")) 
			+ sin(radians(" .$lat. ")) 
			* sin(radians(users.lat_driver))) AS distance"))
			->where('otoritas', '=', 'DRIVER')
			->where('sts_online', '=', '1')
			->groupBy("users.id", "users.firebase_token", "users.lat_driver", "users.lng_driver")
			->orderBy('distance', 'asc')
			->first();
			
			$update1 = MstJual::where('id', '=', $request->id)->update([
				"id_qurir" => $data->id
			]);
			
			$update2 = User::where('id', '=', $data->id)->update([
				'sts_online' => '2'
			]);
			
			$optionBuilder = new OptionsBuilder();
			$optionBuilder->setTimeToLive(60*20);
			
			$notificationBuilder = new PayloadNotificationBuilder("Pesanan Baru");
			$notificationBuilder->setBody("Pesanan Baru Diterima")
			->setSound('default')
			->setClickAction('act_home')
			->setBadge(1);
			
			$dataBuilder = new PayloadDataBuilder();
			$option = $optionBuilder->build();
			$notification = $notificationBuilder->build();
			$dt = $dataBuilder->build();
			
			$downstreamResponse = FCM::sendTo($data->firebase_token, $option, $notification, $dt);
			$downstreamResponse->numberSuccess();
			$downstreamResponse->numberFailure();
			$downstreamResponse->numberModification();
			$downstreamResponse->tokensToDelete();
			$downstreamResponse->tokensToModify();
			$downstreamResponse->tokensToRetry();
			$downstreamResponse->tokensWithError();
			
			return response()->json(['message' => 'Data Berhasil Dirubah'], 200);
		} else {
			return response()->json(['message' => 'Data Gagal Dirubah'], 401);
		}
	}
	
	public function getNoEntOrderJual(Request $request)
	{
		$data = MstOrderJual::where('KD_USER', '=', $request->username)->orderBy('NO_ENT', 'desc')->first();
		
		if ($data != false) {
			$st = $data->NO_ENT;
			$message = substr($st, strpos($st, "/")+5);
			return response()->json(compact('message'), 200);
		}else{
			$message = 'Data Tidak Ditemukan';
			return response()->json(compact('message'), 401);
		}
	}
	
	public function insertMasterOrderJual(Request $request)
	{
		$insert = MstOrderJual::insert([
			'NO_ENT'			=> $request->no_ent,
			'TANGGAL'			=> $request->tanggal,
			'KD_CUST'			=> $request->kd_cust,
			'TOTAL'				=> $request->total,
			'KD_USER'			=> $request->kd_user,
			'KD_PEG'			=> $request->kd_peg
		]);
		
		
		if ($insert) {
			return response()->json(['message' => 'Input Data Berhasil'], 200);
		} else {
			return response()->json(['message' => 'Input Data Gagal'], 401);
		}	
	}
	
	public function insertDetailOrderJual(Request $request)
	{
		$kd_brg 	= explode(',', $request->kd_brg);
		$nm_brg 	= explode(',', $request->nm_brg);
		$satuan 	= explode(',', $request->satuan);
		$jumlah 	= explode(',', $request->jumlah);
		$harga 		= explode(',', $request->harga);
		$sub_total 	= explode(',', $request->sub_total);
		$hpp 		= explode(',', $request->hpp);
		
		for ($i=0; $i < count($kd_brg); $i++) { 
			$insert = DetOrderJual::insert([
				'NO_ENT'	=> $request->no_ent,
				'KD_BRG'	=> $kd_brg[$i],
				'NM_BRG'	=> $nm_brg[$i],
				'SATUAN'	=> $satuan[$i],
				'JUMLAH'	=> $jumlah[$i],
				'HARGA'		=> $harga[$i],
				'SUB_TOTAL'	=> $sub_total[$i],
				'HPP'		=> $hpp[$i]
			]);
		}
		
		if ($insert) {
			return response()->json(['message' => 'Input Data Berhasil'], 200);
		} else {
			return response()->json(['message' => 'Input Data Gagal'], 401);
		}	
	}
	
	public function insertDetailOrderJual1(Request $request)
	{
		$kd_brg 	= explode(',', $request->kd_brg);
		$nm_brg 	= explode(',', $request->nm_brg);
		$satuan 	= explode(',', $request->satuan);
		$jumlah 	= explode(',', $request->jumlah);
		$harga 		= explode(',', $request->harga);
		$sub_total 	= explode(',', $request->sub_total);
		$hpp 		= explode(',', $request->hpp);
		
		for ($i=0; $i < count($kd_brg); $i++) { 
			$test = DetJual::where('NO_ENT', '=', $request->no_ent)->where('KD_BRG', '=', $kd_brg[$i])->get();
			if (count($test) > 0) {
				$insert = DetOrderJual::where('NO_ENT', '=', $request->no_ent)->where('KD_BRG', '=', $kd_brg[$i])->increment('JUMLAH', $jumlah[$i]);
				$insert = DetOrderJual::where('NO_ENT', '=', $request->no_ent)->where('KD_BRG', '=', $kd_brg[$i])->increment('SUB_TOTAL', ($jumlah[$i]*$harga[$i]));
			} else {
				$insert = DetOrderJual::insert([
					'NO_ENT'	=> $request->no_ent,
					'KD_BRG'	=> $kd_brg[$i],
					'NM_BRG'	=> $nm_brg[$i],
					'SATUAN'	=> $satuan[$i],
					'JUMLAH'	=> $jumlah[$i],
					'HARGA'		=> $harga[$i],
					'SUB_TOTAL'	=> $sub_total[$i],
					'HPP'		=> $hpp[$i]
				]);
			}
		}
		
		if ($insert) {
			$data = DetOrderJual::where('NO_ENT', '=', $request->no_ent)->get();
			$mst = MstOrderJual::join('customer', 'customer.KD_CUST', '=', 'mst_ord_jual_mob.KD_CUST')->where('NO_ENT', '=', $request->no_ent)->first();
			
			if (count($data) > 0) {
				return response()->json(['message' => 'Data Ditemukan', 'data' => compact('data', 'mst')], 200);
			} else {
				return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
			}
		} else {
			return response()->json(['message' => 'Input Data Gagal'], 401);	
		}
	}
	
	public function getDataOrderJual(Request $request)
	{
		$data = MstOrderJual::where('KD_USER', '=', $request->username)->join('customer', 'customer.KD_CUST', '=', 'mst_ord_jual_mob.KD_CUST')->where('TANGGAL', '>=', $request->tgl_start)->where('TANGGAL', '<=', $request->tgl_end)->get();
		
		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}
	
	public function putStatusMstJual(Request $request)
	{
		$save = MstJual::where('no_ent', '=', $request->no_ent)->update([
			"sts_byr"	=> 1,
		]);
		
		if ($save) {
			return response()->json(['message' => 'Ubah Status MST Jual Berhasil'], 200);
		} else {
			return response()->json(['message' => 'Ubah Status MST Jual Gagal'], 401);
		}
	}
	
	public function cariQurir(Request $request)
	{
		$lat = $request->lat;
		$lng = $request->lng;
		$data = DB::table("users")
		->select("users.id", "users.firebase_token"
		,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
		* cos(radians(users.lat_driver)) 
		* cos(radians(users.lng_driver) - radians(" . $lng . ")) 
		+ sin(radians(" .$lat. ")) 
		* sin(radians(users.lat_driver))) AS distance"))
		->where('otoritas', '=', 'DRIVER')
		->where('sts_online', '=', '1')
		->groupBy("users.id", "users.firebase_token", "users.lat_driver", "users.lng_driver")
		->orderBy('distance', 'asc')
		->first();
		
		$update1 = MstQsend::where('id', '=', $request->id)->update([
			"id_qurir" => $data->id
		]);
		
		$update2 = User::where('id', '=', $data->id)->update([
			'sts_online' => '2'
		]);
		
		$optionBuilder = new OptionsBuilder();
		$optionBuilder->setTimeToLive(60*20);
		
		$notificationBuilder = new PayloadNotificationBuilder("Pesanan Baru");
		$notificationBuilder->setBody("Pesanan Baru Diterima")
		->setSound('default')
		->setClickAction('act_home')
		->setBadge(1);
		
		$dataBuilder = new PayloadDataBuilder();
		$option = $optionBuilder->build();
		$notification = $notificationBuilder->build();
		$dt = $dataBuilder->build();
		
		$downstreamResponse = FCM::sendTo($data->firebase_token, $option, $notification, $dt);
		$downstreamResponse->numberSuccess();
		$downstreamResponse->numberFailure();
		$downstreamResponse->numberModification();
		$downstreamResponse->tokensToDelete();
		$downstreamResponse->tokensToModify();
		$downstreamResponse->tokensToRetry();
		$downstreamResponse->tokensWithError();
		
		if ($data != false) {
			return response()->json(['message' => 'Data Berhasil Dirubah'], 200);
		} else {
			return response()->json(['message' => 'Data Gagal Dirubah'], 401);
		}
	}
	
	public function getKomisi()
	{
		$data = Komisi::all();
		
		if (count($data) > 0) {
			return response()->json(['message' => "Data Ditemukan", 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}
}
