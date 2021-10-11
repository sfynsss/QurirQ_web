<?php

namespace QurirQ\Http\Controllers\Api;

use Illuminate\Http\Request;
use QurirQ\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use QurirQ\OngkirFood;
use QurirQ\OngkirSend;

class OngkirController extends Controller
{

	public function getOngkirFood(Request $request)
	{
		$data = OngkirFood::all();

		if ($data) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}	
	}

	public function getOngkirSend(Request $request)
	{
		$data = OngkirSend::all();

		if ($data) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}	
	}

}
