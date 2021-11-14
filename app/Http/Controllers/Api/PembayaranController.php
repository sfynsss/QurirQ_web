<?php

namespace QurirQ\Http\Controllers\Api;

use Illuminate\Http\Request;
use QurirQ\Http\Controllers\Controller;
use QurirQ\JenisPembayaran;
use QurirQ\JurnalKeuangan;
use Auth;

class PembayaranController extends Controller
{
	public function index()
    {
        $data = JenisPembayaran::all();

        if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
    }

	public function getPendapatanDriver()
	{
		$data = JurnalKeuangan::where('id_user', '=', Auth::user()->id)->where(\DB::raw('left(tgl_transaksi, 10)'), '=', date('Y-m-d'))->get();

		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}
}