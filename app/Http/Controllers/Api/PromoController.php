<?php

namespace QurirQ\Http\Controllers\Api;

use Illuminate\Http\Request;
use QurirQ\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use QurirQ\Promo;

class PromoController extends Controller
{

	public function getPromo()
	{
		$data = Promo::all();

		if ($data) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}	
	}

}
