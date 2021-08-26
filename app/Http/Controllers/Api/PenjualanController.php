<?php

namespace Larisso\Http\Controllers\Api;

use Illuminate\Http\Request;
use Larisso\Http\Controllers\Controller;
use Larisso\Cart;
use Larisso\Wishlist;
use Larisso\MstJual;
use Larisso\DetJual;
use Larisso\Customer;
use Larisso\VwMstJual;
use Larisso\MstOrderJual;
use Larisso\DetOrderJual;
use Larisso\Voucher;
use Illuminate\Support\Facades\Auth;
use DB;

class PenjualanController extends Controller
{
	public function inputToCart(Request $request)
	{
		$get = Cart::where('id_user', '=', $request->id_user)
			->where('kd_brg', '=', $request->kd_brg)
			->where('kd_outlet', '=', $request->kd_outlet)
			->first();

		if ($get) {
			$update = Cart::where('id_user', '=', $request->id_user)
				->where('kd_brg', '=', $request->kd_brg)
				->where('kd_outlet', '=', $request->kd_outlet) 
				->increment("qty", $request->qty);

			if ($update) {
				return response()->json(['message' => 'Jumlah Barang ditambahkan'], 200);
			} else {
				return response()->json(['message' => 'Update Jumlah Barang Gagal'], 401);
			}	
		} else {
			if ($request->gambar == "" && !isset($request->sts_jual)) {
				$insert = Cart::insert([
					"id_user"			=> $request->id_user,
					"kd_brg"			=> $request->kd_brg,
					"nm_brg"			=> $request->nm_brg,
					"satuan1"			=> $request->satuan1,
					"harga_jl"			=> str_replace(",", "", number_format($request->harga_jl)),
					"qty"				=> $request->qty,
					"berat"				=> $request->berat,
					"volume"			=> $request->volume,
					"gambar"			=> "",
					"kategori_barang"	=> $request->kategori, 
					"kd_outlet"			=> $request->kd_outlet,
					"sts_jual"			=> 'RETAIL'
				]);
			} else if ($request->gambar == "" && $request->sts_jual == 'GROSIR'){
				$insert = Cart::insert([
					"id_user"			=> $request->id_user,
					"kd_brg"			=> $request->kd_brg,
					"nm_brg"			=> $request->nm_brg,
					"satuan1"			=> $request->satuan1,
					"harga_jl"			=> str_replace(",", "", number_format($request->harga_jl)),
					"qty"				=> $request->qty,
					"berat"				=> $request->berat,
					"volume"			=> $request->volume,
					"gambar"			=> "",
					"kategori_barang"	=> $request->kategori, 
					"kd_outlet"			=> $request->kd_outlet,
					"sts_jual"			=> 'GROSIR'
				]);
			} else if (!isset($request->sts_jual)) {
				$insert = Cart::insert([
					"id_user"			=> $request->id_user,
					"kd_brg"			=> $request->kd_brg,
					"nm_brg"			=> $request->nm_brg,
					"satuan1"			=> $request->satuan1,
					"harga_jl"			=> str_replace(",", "", number_format($request->harga_jl)),
					"qty"				=> $request->qty,
					"berat"				=> $request->berat,
					"volume"			=> $request->volume,
					"gambar"			=> $request->gambar,
					"kategori_barang"	=> $request->kategori, 
					"kd_outlet"			=> $request->kd_outlet,
					"sts_jual"			=> 'RETAIL'
				]);
			} else {
				$insert = Cart::insert([
					"id_user"			=> $request->id_user,
					"kd_brg"			=> $request->kd_brg,
					"nm_brg"			=> $request->nm_brg,
					"satuan1"			=> $request->satuan1,
					"harga_jl"			=> str_replace(",", "", number_format($request->harga_jl)),
					"qty"				=> $request->qty,
					"berat"				=> $request->berat,
					"volume"			=> $request->volume,
					"gambar"			=> $request->gambar,
					"kategori_barang"	=> $request->kategori, 
					"kd_outlet"			=> $request->kd_outlet,
					"sts_jual"			=> 'GROSIR'
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
		$data = Cart::select('cart.*', 'barang.gambar', 'barang.sts_point')
				->where('id_user', '=', $request->id_user)
				->where('barang.kd_outlet', '=', $request->kd_outlet)
				->where('cart.harga_jl', '!=', '0')
				->join('barang', 'barang.kd_brg', '=', 'cart.kd_brg')
				->join('users', 'users.id', '=', 'cart.id_user')
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
				->join('barang', 'barang.kd_brg', '=', 'cart.kd_brg')
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
		$update = Cart::where('id_user', '=', $request->id_user)->where('kd_brg', '=', $request->kd_brg)->update([
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
		$delete = Cart::where('id_user', '=', $request->id_user)->where('kd_brg', '=', $request->kd_brg)->delete();

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
		$kd_cust = Customer::where('id', '=', $request->kd_cust)->get();
		if ($request->point == 0) {
			$point = 0;
		} else {
			$point = $request->point;
		}
		if ($request->jns_pengiriman == "pickup") {
			$mst = MstJual::insertGetId([
				'no_ent'			=> $request->no_ent,
				'id_user'			=> $request->kd_cust,
				'kd_cust'			=> $kd_cust[0]->KD_CUST,
				'nm_penerima'		=> $request->nm_penerima,
				'alm_penerima'		=> $request->alm_penerima,
				'no_telp_penerima'	=> $request->no_telp_penerima,
				'total'				=> $request->total,
				'disc_pr'			=> $request->disc_pr,
				'disc_value'		=> $request->disc_value,
				'kd_voucher'		=> $request->kd_voucher,
				'jns_bayar'			=> $request->jns_bayar,
				'netto'				=> $request->netto,
				'ongkir'			=> "0",
				'jns_pengiriman'	=> $request->jns_pengiriman,
				'no_resi'			=> $request->no_resi,
				'sts_byr'			=> $request->sts_bayar,
				'sts_jual'			=> $request->sts_jual,
				'transaction_id'	=> $request->transaction_id,
				'va_number'			=> $request->no_va,
				'bank_name'			=> $request->payment_bank,
				'payment_type'		=> $request->payment_type,
				'point'				=> $point
			]);
		} else {
			$mst = MstJual::insertGetId([
				'no_ent'			=> $request->no_ent,
				'id_user'			=> $request->kd_cust,
				'kd_cust'			=> $kd_cust[0]->KD_CUST,
				'nm_penerima'		=> $request->nm_penerima,
				'alm_penerima'		=> $request->alm_penerima,
				'no_telp_penerima'	=> $request->no_telp_penerima,
				'total'				=> $request->total,
				'disc_pr'			=> $request->disc_pr,
				'disc_value'		=> $request->disc_value,
				'kd_voucher'		=> $request->kd_voucher,
				'jns_bayar'			=> $request->jns_bayar,
				'netto'				=> $request->netto,
				'ongkir'			=> $request->ongkir,
				'jns_pengiriman'	=> $request->jns_pengiriman,
				'no_resi'			=> $request->no_resi,
				'sts_byr'			=> $request->sts_bayar,
				'sts_jual'			=> $request->sts_jual,
				'transaction_id'	=> $request->transaction_id,
				'va_number'			=> $request->no_va,
				'bank_name'			=> $request->payment_bank,
				'payment_type'		=> $request->payment_type,
				'point'				=> $point
			]);
		}
		

		if ($request->kd_voucher != "") {
			$update = Voucher::where('kd_voucher', '=', $request->kd_voucher)->update([
				'status_voucher'	=> 'DIGUNAKAN'
			]);
		}

		$tmp_kd_brg			= explode(";", $request->kd_brg);
		$tmp_nm_brg			= explode(";", $request->nm_brg);
		$tmp_harga			= explode(";", $request->harga);
		$tmp_jumlah			= explode(";", $request->jumlah);

		for ($i=0; $i < count($tmp_kd_brg); $i++) { 
			$subtot = ($tmp_harga[$i] * $tmp_jumlah[$i]);
			$det = DetJual::insert([
				"no_ent"	=>	$request->no_ent,
				"kd_brg"	=>	$tmp_kd_brg[$i],
				"nm_brg"	=>	$tmp_nm_brg[$i],
				"harga"		=>	$tmp_harga[$i],
				"jumlah"	=>	$tmp_jumlah[$i],
				"satuan"	=>	$request->satuan,
				"sub_total"	=>	$subtot
			]);
		}

		if ($det) {
			$delete = Cart::where('id_user', '=', $request->kd_cust)->delete();
			if ($delete) {
				$sukses = "Input Order Berhasil";
				return response()->json(compact('sukses'), 200);
			} else {
				return response()->json('Hapus Cart gagal', 404);	
			}
		} else {
			return response()->json('Update gagal', 404);
		}
	}

	public function inputPenjualangGrosir(Request $request)
	{
		$kd_cust = Customer::where('id', '=', $request->kd_cust)->get();
		if ($request->point_grosir == 0) {
			$point_grosir = 0;
		} else {
			$point_grosir = $request->point_grosir;
		}
		if ($request->jns_pengiriman == "pickup") {
			$mst = MstJual::insertGetId([
				'no_ent'			=> $request->no_ent,
				'id_user'			=> $request->kd_cust,
				'kd_cust'			=> $kd_cust[0]->KD_CUST,
				'nm_penerima'		=> $request->nm_penerima,
				'alm_penerima'		=> $request->alm_penerima,
				'no_telp_penerima'	=> $request->no_telp_penerima,
				'total'				=> $request->total,
				'disc_pr'			=> $request->disc_pr,
				'disc_value'		=> $request->disc_value,
				'kd_voucher'		=> $request->kd_voucher,
				'jns_bayar'			=> $request->jns_bayar,
				'netto'				=> $request->netto,
				'ongkir'			=> "0",
				'jns_pengiriman'	=> $request->jns_pengiriman,
				'no_resi'			=> $request->no_resi,
				'sts_byr'			=> $request->sts_bayar,
				'sts_jual'			=> $request->sts_jual,
				'transaction_id'	=> $request->transaction_id,
				'va_number'			=> $request->no_va,
				'bank_name'			=> $request->payment_bank,
				'payment_type'		=> $request->payment_type,
				'point_grosir'		=> $point_grosir
			]);
		} else {
			$mst = MstJual::insertGetId([
				'no_ent'			=> $request->no_ent,
				'id_user'			=> $request->kd_cust,
				'kd_cust'			=> $kd_cust[0]->KD_CUST,
				'nm_penerima'		=> $request->nm_penerima,
				'alm_penerima'		=> $request->alm_penerima,
				'no_telp_penerima'	=> $request->no_telp_penerima,
				'total'				=> $request->total,
				'disc_pr'			=> $request->disc_pr,
				'disc_value'		=> $request->disc_value,
				'kd_voucher'		=> $request->kd_voucher,
				'jns_bayar'			=> $request->jns_bayar,
				'netto'				=> $request->netto,
				'ongkir'			=> $request->ongkir,
				'jns_pengiriman'	=> $request->jns_pengiriman,
				'no_resi'			=> $request->no_resi,
				'sts_byr'			=> $request->sts_bayar,
				'sts_jual'			=> $request->sts_jual,
				'transaction_id'	=> $request->transaction_id,
				'va_number'			=> $request->no_va,
				'bank_name'			=> $request->payment_bank,
				'payment_type'		=> $request->payment_type,
				'point_grosir'		=> $point_grosir
			]);
		}
		

		if ($request->kd_voucher != "") {
			$update = Voucher::where('kd_voucher', '=', $request->kd_voucher)->update([
				'status_voucher'	=> 'DIGUNAKAN'
			]);
		}

		$tmp_kd_brg			= explode(";", $request->kd_brg);
		$tmp_nm_brg			= explode(";", $request->nm_brg);
		$tmp_harga			= explode(";", $request->harga);
		$tmp_jumlah			= explode(";", $request->jumlah);

		for ($i=0; $i < count($tmp_kd_brg); $i++) { 
			$subtot = ($tmp_harga[$i] * $tmp_jumlah[$i]);
			$det = DetJual::insert([
				"no_ent"	=>	$request->no_ent,
				"kd_brg"	=>	$tmp_kd_brg[$i],
				"nm_brg"	=>	$tmp_nm_brg[$i],
				"harga"		=>	$tmp_harga[$i],
				"jumlah"	=>	$tmp_jumlah[$i],
				"satuan"	=>	$request->satuan,
				"sub_total"	=>	$subtot
			]);
		}

		if ($det) {
			$delete = Cart::where('id_user', '=', $request->kd_cust)->delete();
			if ($delete) {
				$sukses = "Input Order Berhasil";
				return response()->json(compact('sukses'), 200);
			} else {
				return response()->json('Hapus Cart gagal', 404);	
			}
		} else {
			return response()->json('Update gagal', 404);
		}
	}

	public function getDataTransaksi(Request $request)
	{
		$data = MstJual::select('mst_jual.no_ent', 'mst_jual.id_user', 'mst_jual.sts_byr', 'mst_jual.tanggal', 'mst_jual.jns_pengiriman', 'mst_jual.netto as total', 'mst_jual.ongkir', 'mst_jual.disc_value', DB::raw('count(det_jual.no_ent) AS jumlah'), 'mst_jual.payment_type', 'mst_jual.bank_name', 'mst_jual.va_number', 'mst_jual.sts_transaksi')->join('det_jual', 'det_jual.no_ent', '=', 'mst_jual.no_ent')->where('mst_jual.id_user', '=', $request->id)->groupby('mst_jual.no_ent', 'mst_jual.id_user', 'mst_jual.sts_byr', 'mst_jual.tanggal', 'mst_jual.jns_pengiriman', 'mst_jual.ongkir', 'mst_jual.disc_value', 'mst_jual.netto', 'mst_jual.payment_type', 'mst_jual.bank_name', 'mst_jual.va_number', 'mst_jual.sts_transaksi')->orderBy('mst_jual.no_ent')->get();

		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function getDataTransaksiSukses(Request $request)
	{
		$data = MstJual::select('mst_jual.no_ent', 'mst_jual.id_user', 'mst_jual.sts_byr', 'mst_jual.tanggal', 'mst_jual.jns_pengiriman', 'mst_jual.netto as total', 'mst_jual.ongkir', 'mst_jual.disc_value', DB::raw('count(det_jual.no_ent) AS jumlah'), 'mst_jual.payment_type', 'mst_jual.bank_name', 'mst_jual.va_number', 'mst_jual.sts_transaksi')->join('det_jual', 'det_jual.no_ent', '=', 'mst_jual.no_ent')
			->where('mst_jual.id_user', '=', $request->id)
			->where('mst_jual.sts_transaksi', '=', 'SELESAI')->groupby('mst_jual.no_ent', 'mst_jual.id_user', 'mst_jual.sts_byr', 'mst_jual.tanggal', 'mst_jual.jns_pengiriman', 'mst_jual.ongkir', 'mst_jual.disc_value', 'mst_jual.netto', 'mst_jual.payment_type', 'mst_jual.bank_name', 'mst_jual.va_number', 'mst_jual.sts_transaksi')->orderBy('mst_jual.no_ent')->get();

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
		$data = DetJual::where('no_ent', '=', $request->no_ent)->get();

		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function batalkanTransaksi(Request $request)
	{
		$data = MstJual::where('no_ent', '=', $request->no_ent)->update([
			'sts_transaksi' => 'BATAL'
		]);

		if ($data) {
			return response()->json(['message' => 'Data Berhasil Dirubah'], 200);
		} else {
			return response()->json(['message' => 'Data Gagal Dirubah'], 401);
		}
	}

	public function getStatusTransaksi(Request $request)
	{
		$data = MstJual::select('sts_transaksi')->where('no_ent', '=', $request->no_ent)->get();

		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data[0]], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
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

	public function inputPenjualanOffline(Request $request)
	{
		$mst = MstJual::insert([
			'no_ent'			=> $request->no_ent,
			'tanggal'			=> $request->tanggal,
			'netto'				=> $request->netto,
			'kd_cust'			=> $request->kd_cust,
			'id_user'			=> Auth::user()->id,
			'kd_outlet'			=> Auth::user()->kd_outlet,
			'point'				=> $request->point,
			'sts_jual'			=> 'OFFLINE'
		]);

		if ($mst) {
			return response()->json(['message' => 'Input Master Jual Berhasil'], 200);
		} else {
			return response()->json(['message' => 'Input Master Jual Gagal'], 401);
		}
	}

	public function inputPenjualanOfflineGrosir(Request $request)
	{
		$mst = MstJual::insert([
			'no_ent'			=> $request->no_ent,
			'tanggal'			=> $request->tanggal,
			'netto'				=> $request->netto,
			'kd_cust'			=> $request->kd_cust,
			'id_user'			=> Auth::user()->id,
			'kd_outlet'			=> Auth::user()->kd_outlet,
			'point_grosir'		=> $request->point_grosir,
			'sts_jual'			=> 'OFFLINE'
		]);

		if ($mst) {
			return response()->json(['message' => 'Input Master Jual Berhasil'], 200);
		} else {
			return response()->json(['message' => 'Input Master Jual Gagal'], 401);
		}
	}

	public function getNoResi(Request $request)
	{
		$data = MstJual::select('no_resi')->where('no_ent', '=', $request->no_ent)->get();
		
		if ($data) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}	

	}

}
