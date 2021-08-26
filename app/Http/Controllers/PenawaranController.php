<?php

namespace Larisso\Http\Controllers;

use Illuminate\Http\Request;
use Larisso\Penawaran;
use Larisso\GambarPromo;
use Redirect;
use Session;

class PenawaranController extends Controller
{
	public function index()
	{
		$data = Penawaran::all();
		return view('Penawaran.penawaran', compact('data'));
	}

	public function inputPenawaran(Request $request) {

		if ($request->gambar_penawaran != "") {
			$path = $request->file('gambar_penawaran')->store(
				'gambar_penawaran', 'public'
			);

			if ($path) {
				$insert = Penawaran::insert([
					"gambar"		=> $path,
					"penawaran"	    => $request->penawaran
				]);
			} else {
				return back()->with('error','Harap Periksa Kembali file inputan Anda !!!');
			}
		} else {
			$insert = Penawaran::insert([
				"gambar"		=> "",
				"penawaran"	    => $request->penawaran
			]);
		}
		if ($insert) {
			return back()->with('success','Data Penawaran Berhasil Diinputkan');
		} else {
			return back()->with('error','Data Penawaran Gagal Diinputkan');
		}
	}

	public function updatePenawaran(Request $request)
	{
		if ($request->gambar_penawaran != "") {
			$path = $request->file('gambar_penawaran')->store(
				'gambar_penawaran', 'public'
			);

			$insert = Penawaran::where('id', '=', $request->id_penawaran)->update([
				'penawaran'		=> $request->penawaran,
				'gambar'	=> $path,
			]);

		} else {
			$insert = Penawaran::where('id', '=', $request->id_penawaran)->update([
				'penawaran'		=> $request->penawaran,
			]);
		}

		if ($insert) {
			Session::flash('success', "Data Berhasil Diubah !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Diubah !!!");
			return Redirect::back();
		}

	}

	public function deletePenawaran($id)
	{
		$delete = Penawaran::findOrFail($id);
		$delete->delete();
		if ($delete) {
			Session::flash('success', "Data Berhasil Dihapus !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Dihapus !!!");
			return Redirect::back();
		}
		return redirect()->route('penawaran');
	}

	public function gambarPromo()
	{
		$data = GambarPromo::all();
		return view('Penawaran.gambar_promo', compact('data'));
	}

	public function inputGambarPromo(Request $request) {

		if ($request->gambar_promo != "") {
			$path = $request->file('gambar_promo')->store(
				'gambar_promo', 'public'
			);

			if ($path) {
				$insert = GambarPromo::insert([
					"gambar"		=> $path,
				]);
			} else {
				return back()->with('error','Harap Periksa Kembali file inputan Anda !!!');
			}
		} else {
			return back()->with('error','Gambar Kosong, Silahkan isi gambar terlebih dahulu !!!');
		}
		if ($insert) {
			return back()->with('success','Data Penawaran Berhasil Diinputkan');
		} else {
			return back()->with('error','Data Penawaran Gagal Diinputkan');
		}
	}

	public function updateGambarPromo(Request $request)
	{
		if ($request->gambar_promo != "") {
			$path = $request->file('gambar_promo')->store(
				'gambar_promo', 'public'
			);

			$insert = GambarPromo::where('id', '=', $request->id)->update([
				'gambar'	=> $path,
			]);

			if ($insert) {
				Session::flash('success', "Data Berhasil Diubah !!!");
				return Redirect::back();
			} else {
				Session::flash('error', "Data Gagal Diubah !!!");
				return Redirect::back();
			}
		} else {
			return back()->with('error','Gambar Kosong, Silahkan isi gambar terlebih dahulu s!!!');
		}

	}

	public function deleteGambarPromo($id)
	{
		$delete = GambarPromo::findOrFail($id);
		$delete->delete();
		if ($delete) {
			Session::flash('success', "Data Berhasil Dihapus !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Dihapus !!!");
			return Redirect::back();
		}
		return redirect()->route('gambarPromo');
	}

}
