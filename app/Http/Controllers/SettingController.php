<?php

namespace QurirQ\Http\Controllers;

use Illuminate\Http\Request;
use QurirQ\Komisi;
use Redirect;
use Session;

class SettingController extends Controller
{
    public function index(){
    	$data = Komisi::all();
    	return view('setting.index', compact('data'));
    }

    public function tambahKomisi(Request $request)
	{
		$save = Komisi::insert([
			"komisi_outlet"		    => $request->komisi_outlet,
			"komisi_qurir"			=> $request->komisi_qurir
		]);

		if ($save) {
			Session::flash('success', "Data Berhasil Ditambahkan !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Ditambahkan !!!");
			return Redirect::back();
		}
	}

	public function updateKomisi(Request $request)
	{
		$save = Komisi::where('id', '=', $request->id_komisi)->update([
			"komisi_outlet"		    => $request->komisi_outlet,
			"komisi_qurir"			=> $request->komisi_qurir
 		]);

		if ($save) {
			Session::flash('success', "Data Berhasil Diubah !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Diubah !!!");
			return Redirect::back();
		}
	}

	public function deleteKomisi($id)
	{
		$delete = Komisi::findOrFail($id);
		$delete->delete();
		if ($delete) {
			Session::flash('success', "Data Berhasil Dihapus !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Dihapus !!!");
			return Redirect::back();
		}
		return redirect()->route('komisi');
	}
}
