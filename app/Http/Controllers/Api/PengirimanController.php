<?php

namespace QurirQ\Http\Controllers\Api;

use Illuminate\Http\Request;
use QurirQ\Http\Controllers\Controller;
use Steevenz\Rajaongkir;
use QurirQ\OngkirFood;
use QurirQ\OngkirSend;

class PengirimanController extends Controller
{
	public function cekOngkirFood(Request $request)
	{
		$data = OngkirFood::where('sts_aktif', '=', '1')->get();
		
		if (count($data) > 0) {
			if ($request->jarak > $data[0]->km_awal) {
				$harga = $data[0]->harga_awal + (($request->jarak-$data[0]->km_awal) * $data[0]->harga_per_km);
			} else {
				$harga = $data[0]->harga_awal;
			}
			return response()->json(['message' => $harga], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function cekOngkirQsend(Request $request)
	{
		$data = OngkirSend::where('sts_aktif', '=', '1')->get();
		
		if (count($data) > 0) {
			$harga = $data[0]->harga_awal + (($request->jarak-$data[0]->km_awal) * $data[0]->harga_per_km);
			return response()->json(['message' => $harga], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function getOngkirQsend()
	{
		$data = OngkirSend::where('sts_aktif', '=', '1')->get();
		
		if (count($data) > 0) {
			// $harga = $data[0]->harga_awal + (($request->jarak-$data[0]->km_awal) * $data[0]->harga_per_km);
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

}
