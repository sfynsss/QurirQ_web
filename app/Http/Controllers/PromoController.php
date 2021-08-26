<?php

namespace Larisso\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Larisso\KategoriAndroid;
use Larisso\Promo;
use Larisso\Barang;
use Larisso\Outlet;
use Redirect;
use Session;

class PromoController extends Controller
{

    public function index()
    {
        $data = Promo::all();

        if (Auth::user()->kd_outlet == 'all') {
			$data2 = Barang::LeftJoin('kat_android', 'barang.kd_kat_android', '=', 'kat_android.kd_kat_android')->where('barang.disc', '>', '0')->get();
			$kat_barang2 = KategoriAndroid::all();
		} else {
			$data2 = Barang::LeftJoin('kat_android', 'barang.kd_kat_android', '=', 'kat_android.kd_kat_android')
                ->where('barang.kd_outlet', '=', Auth::user()->kd_outlet)
                ->where('barang.disc', '>', '0')
                ->get();
			$kat_barang2 = KategoriAndroid::where('kd_outlet', '=', Auth::user()->kd_outlet)->get();
		}

        return view('promo.index', compact('data', 'data2', 'kat_barang2'));
    }

    public function updatePromo(Request $request)
    {
        $save = Promo::where('id', '=', '1')->update([
            "nama_promo"=> $request->nama_promo,
            "tgl_mulai" => $request->tgl_mulai,
            "tgl_akhir" => $request->tgl_akhir
        ]);

        if ($save) {
            Session::flash('success', "Data Berhasil Diubah !!!");
            return Redirect::back();
        } else {
            Session::flash('error', "Data Gagal Diubah !!!");
            return Redirect::back();
        }
    }

}
