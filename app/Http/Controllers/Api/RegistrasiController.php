<?php

namespace QurirQ\Http\Controllers\Api;

use Illuminate\Http\Request;
use QurirQ\Http\Controllers\Controller;
use QurirQ\AuthAndroid;

class RegistrasiController extends Controller
{
    function registrasi(Request $request)
	{
		$insert = AuthAndroid::insert([
			'NAMA_PERUSAHAAN'	=> $request->nama_toko,
			'PAKET'				=> $request->paket,
			'MAC_ADDRESS'		=> $request->mac_address,
			'KUNCI_PROGRAM'		=> $request->kunci
		]);

		if ($insert) {
			return response()->json(['message' => 'Registrasi Berhasil'], 200);
		} else {
			return response()->json(['message' => 'Registrasi Gagal'], 401);
		}
	}

	function cekRegis(Request $request)
	{
		$data = AuthAndroid::where('NAMA_PERUSAHAAN', '=', $request->nama_toko)->where('PAKET', '=', $request->paket)->where('MAC_ADDRESS', '=', $request->mac_address)->where('KUNCI_PROGRAM', '=', $request->kunci)->get();

		if (count($data) > 0) {
			return response()->json(['message' => 'Registrasi Berhasil'], 200);
		} else {
			return response()->json(['message' => 'Registrasi Bermasalah'], 401);
		}
	}
}
