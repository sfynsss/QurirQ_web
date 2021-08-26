<?php

namespace Larisso\Http\Controllers\Api;

use Illuminate\Http\Request;
use Larisso\Http\Controllers\Controller;
use Larisso\Kunjungan;

class KunjunganController extends Controller
{
	function insertKunjungan(Request $request)
	{
		$insert = Kunjungan::insert([
			"KD_CUST"		=>	$request->kd_cust,
			"NO_USER"		=>	$request->no_user,
			"TGL_KUNJUNGAN"	=>	$request->tgl,
			"LAT"			=>	$request->lat,
			"LANG"			=>	$request->lang
		]);

		if ($insert) {
			return response()->json(['message' => 'Input Data Berhasil'], 200);
		} else {
			return response()->json(['message' => 'Input Data Gagal'], 401);
		}	
	}

	function dataKunjungan(Request $request)
	{
		$data = Kunjungan::join('customer', 'customer.KD_CUST', '=', 'kunjungan.KD_CUST')->where('TGL_KUNJUNGAN', '>=', $request->tgl_start)->where('TGL_KUNJUNGAN', '<=', $request->tgl_end)->where('NO_USER', '=', $request->no_user)->get();

		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}
}
