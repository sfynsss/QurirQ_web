<?php

namespace QurirQ\Http\Controllers\Api;

use Illuminate\Http\Request;
use QurirQ\Http\Controllers\Controller;
use QurirQ\KategoriOutlet;
use QurirQ\Outlet;

class OutletController extends Controller
{
	public function getKategoriOutlet(Request $request)
	{
		if($request->filter == 'all'){
			$data = KategoriOutlet::where('sts_tampil', 1)->get();
		} else {
			$data = KategoriOutlet::take($request->filter)->where('sts_tampil', 1)->get();
		}
		
		if ($data) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}	
	}
	
	public function getKodeOutlet()
	{
		$data = Outlet::select('kd_outlet')->orderBy('kd_outlet', 'desc')->first();
		
		if ($data) {
			// print_r($data->kd_outlet);
			$data1 = (int) substr($data->kd_outlet, 4) + 1;
			$tmp = "OU01".sprintf("%04d", $data1);
		} else {
			$tmp = "OU01".sprintf("%04d", 1);
		}
		return response()->json($tmp, 200);
	}
	
	public function getOutlet(Request $request)
	{
		$data = Outlet::where('id_kategori_outlet', $request->id)->where('status', '1')->get();
		
		if ($data) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}	
	}
}
