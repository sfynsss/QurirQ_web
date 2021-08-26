<?php

namespace QurirQ\Http\Controllers\Api;

use Illuminate\Http\Request;
use QurirQ\Http\Controllers\Controller;
use QurirQ\Penawaran;
use QurirQ\GambarPromo;

class PenawaranController extends Controller
{
	public function index(Request $request)
	{
		$data = Penawaran::all();

		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function getGambarPromo(Request $request)
	{
		$data = GambarPromo::all();
		
		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}
}
