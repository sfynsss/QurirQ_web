<?php

namespace Larisso\Http\Controllers\Api;

use Illuminate\Http\Request;
use Larisso\Http\Controllers\Controller;
use Larisso\Outlet;

class OutletController extends Controller
{
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

	public function getOutlet()
	{
		$data = Outlet::where('status', '1')->get();

		if ($data) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}	
	}
}
