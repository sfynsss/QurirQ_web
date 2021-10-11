<?php

namespace QurirQ\Http\Controllers;

use Illuminate\Http\Request;
use QurirQ\OngkirFood;
use QurirQ\OngkirSend;
use Redirect;
use Session;

class OngkirController extends Controller
{
    public function index(){
    	$data = OngkirFood::all();
    	return view('OngkirFood.index', compact('data'));
    }

    public function tambahOngkirFood(Request $request)
	{
		$count = OngkirFood::all()->count();

		$save = OngkirFood::insert([
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

	public function updateOngkirFood(Request $request)
	{
		$save = OngkirFood::where('id', '=', $request->id_ongkir)->update([
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

	public function deleteOngkirFood($id)
	{
		$delete = OngkirFood::findOrFail($id);
		$delete->delete();
		if ($delete) {
			Session::flash('success', "Data Berhasil Diubah !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Diubah !!!");
			return Redirect::back();
		}
		return redirect()->route('ongkirFood');
	}

	public function send(){
    	$data = OngkirSend::all();
    	return view('OngkirFood.send', compact('data'));
    }

    public function tambahOngkirSend(Request $request)
	{
		$count = OngkirSend::all()->count();

		$save = OngkirSend::insert([
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

	public function updateOngkirSend(Request $request)
	{
		$save = OngkirSend::where('id', '=', $request->id_ongkir)->update([
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

	public function deleteOngkirSend($id)
	{
		$delete = OngkirSend::findOrFail($id);
		$delete->delete();
		if ($delete) {
			Session::flash('success', "Data Berhasil Diubah !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Diubah !!!");
			return Redirect::back();
		}
		return redirect()->route('ongkirFood');
	}
}
