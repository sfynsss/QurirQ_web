<?php

namespace Larisso\Http\Controllers\Api;

use Illuminate\Http\Request;
use Larisso\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Larisso\DetVoucher;
use Larisso\Customer;
use Larisso\Voucher;
use Larisso\SettingPoint;
use Larisso\SettingVoucher;
use Illuminate\Support\Str;

class VoucherController extends Controller
{
	public function getVoucher(Request $request)
	{
		$kd_cust = Customer::where('id', '=', $request->id)->first();
		$data = Voucher::where('kd_cust', '=', $kd_cust['KD_CUST'])->where('status_voucher', '=', "AKTIF")->get();

		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function validasi(Request $request)
	{
		if ($request->data == "kosong") {
			return response()->json("gagal", 200);
		} else {
			$tmp_kd_voucher = explode(";", $request->data);
			for ($i=0; $i < count($tmp_kd_voucher); $i++) { 
				$update = Voucher::where('kd_voucher', '=', $tmp_kd_voucher[$i])->where('status_voucher', '=', "NON-AKTIF")->update([
					'status_voucher'	=> "AKTIF"
				]);
			}

			if ($update) {
				return response()->json("berhasil", 200);
			} else {
				return response()->json("Voucher Telah Aktif", 200);
			}
		}
	}

	public function countPointVoucher(Request $request)
	{
		$kd_cust = Customer::where('id', '=', $request->id)->first();
		$data['voucher'] = Voucher::where('kd_cust', '=', $kd_cust['KD_CUST'])->where('status_voucher', '=', "AKTIF")->count();
		$data['point'] = $kd_cust['POINT_BL_INI'];

		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function countPointVoucherGrosir(Request $request)
	{
		$kd_cust = Customer::where('id', '=', $request->id)->first();
		$data['voucher'] = Voucher::where('kd_cust', '=', $kd_cust['KD_CUST'])->where('status_voucher', '=', "AKTIF")->count();
		$data['point_grosir'] = $kd_cust['POINT_BL_INI_GROSIR'];

		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function getSettingPoint()
	{
		$data = SettingPoint::orderBy('nmr', 'desc')->get();
		
		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function getSettingVoucher()
	{
		$data = SettingVoucher::all();
		
		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function tambahVoucher(Request $request)
	{
		$insert = Voucher::insert([
			"kd_voucher"		=> substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6),
			"kd_cust"			=> $request->kd_cust,
			"nama_voucher"		=> $request->nama_voucher,
			"nilai_voucher"		=> $request->nilai_voucher,
			"tgl_berlaku_1"		=> $request->tgl_start,
			"tgl_berlaku_2"		=> $request->tgl_end,
			"sk"				=> "Nikmati ".$request->nama_voucher." tanpa minimum pembelian di semua outlet LaRisso",
			"gambar"			=> $request->gambar,
			"jns_voucher"		=> "SEMUA",
			"status_voucher"	=> "AKTIF"
		]);

		if ($insert) {
			$update = Customer::where('kd_cust', '=', $request->kd_cust)->decrement('POINT_BL_INI', $request->ketentuan);
			if ($update) {	
				return response()->json(['message' => 'Voucher Berhasil Ditambahkan'], 200);
			} else {	
				return response()->json(['message' => 'Voucher Gagal Ditambahkan'], 401);
			}
		} else {
			return response()->json(['message' => 'Voucher Gagal Ditambahkan'], 401);
		}
	}
}
