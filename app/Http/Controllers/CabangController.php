<?php

namespace Larisso\Http\Controllers;

use Illuminate\Http\Request;
use Larisso\Cabang;
use Redirect;
use Session;

class CabangController extends Controller
{
	public function index()
	{
		$data = Cabang::all();

		return view('Cabang.cabang', compact('data'));
	}

	public function tambahCabang(Request $request)
	{
		$count = Cabang::all()->count();
		$nm_cb = sprintf("%'.02d", $count + 1).'-'.$request->nama_cabang;

		$save = Cabang::insert([
			"cabang"			=> $nm_cb,
			"alamat_cabang"		=> $request->alamat_cabang
		]);

		if ($save) {
			Session::flash('success', "Data Berhasil Ditambahkan !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Ditambahkan !!!");
			return Redirect::back();
		}
	}

	public function updateCabang(Request $request)
	{
		$save = Cabang::where('cabang', '=', $request->nama_cabang)->update([
			"alamat_cabang"		=> $request->alamat_cabang
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
