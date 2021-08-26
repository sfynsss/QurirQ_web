<?php

namespace Larisso\Http\Controllers;

use Illuminate\Http\Request;
use Larisso\OngkirCod;
use Redirect;
use Session;

class OngkirCodController extends Controller
{
    public function index(){
    	$data = OngkirCod::all();
    	return view('OngkirCod.index', compact('data'));
    }

    public function tambahOngkirCod(Request $request)
	{
		$count = OngkirCod::all()->count();

		$save = OngkirCod::insert([
			"harga_awal"		=> $request->harga_awal,
			"harga_per_km"		=> $request->harga_per_km,
			"harga_per_kg"		=> $request->harga_per_kg,
			"sts_aktif"			=> $request->sts_aktif
		]);

		if ($save) {
			Session::flash('success', "Data Berhasil Ditambahkan !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Ditambahkan !!!");
			return Redirect::back();
		}
	}

	public function updateOngkirCod(Request $request)
	{
		$save = OngkirCod::where('id', '=', $request->id_ongkir)->update([
			"harga_awal"	=> $request->harga_awal,
			"harga_per_km"	=> $request->harga_per_km,
			"harga_per_kg"	=> $request->harga_per_kg,
			"sts_aktif"		=> $request->sts_aktif
 		]);

		if ($save) {
			Session::flash('success', "Data Berhasil Diubah !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Diubah !!!");
			return Redirect::back();
		}
	}

	public function deleteOngkirCod($id)
	{
		$delete = OngkirCod::findOrFail($id);
		$delete->delete();
		if ($delete) {
			Session::flash('success', "Data Berhasil Diubah !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Diubah !!!");
			return Redirect::back();
		}
		return redirect()->route('ongkircod');
	}
}
