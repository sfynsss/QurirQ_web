<?php

namespace Larisso\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Larisso\Imports\ImportBarang;
use Illuminate\Http\Request;
use Larisso\KategoriAndroid;
use Larisso\Barang;
use Larisso\Outlet;
use Larisso\User;
use Excel;

class BarangController extends Controller
{
	public function barang()
	{
		if (Auth::user()->kd_outlet == 'all') {
			$data = Barang::LeftJoin('kat_android', 'barang.kd_kat_android', '=', 'kat_android.kd_kat_android')->get();
			$kat_barang = KategoriAndroid::all();
		} else {
			$data = Barang::LeftJoin('kat_android', 'barang.kd_kat_android', '=', 'kat_android.kd_kat_android')
				->where('barang.kd_outlet', '=', Auth::user()->kd_outlet)->get();
			$kat_barang = KategoriAndroid::where('kd_outlet', '=', Auth::user()->kd_outlet)->get();
		}

		return view('barang.barang', compact('data', 'kat_barang'));
	}

	public function import(Request $request)
	{
		if($request->hasFile('file_barang')){
			$path = $request->file('file_barang')->getRealPath();
			$data = Excel::import(new ImportBarang, $path);
			if ($data) {
				return back()->with('success','Data Berhasil di Upload');
			}
		} else {
			return back()->with('error','File Excel error, tolong cek kembali file Anda!');
		}
	}

	public function edit_barang(Request $request)
	{
		if ($request->gambar_barang != "") {
			$path = $request->file('gambar_barang')->store(
				'gambar_barang', 'public'
			);

			if ($path) {
				$update = Barang::where('kd_brg', '=', $request->kd_brg_edit)->update([
					"gambar"			=> $path,
					"kd_kat_android"	=> $request->kat_barang,
					"nm_brg"			=> $request->nm_brg_edit,
					"harga_jl"			=> $request->hrg_brg_edit,
					"berat"				=> $request->berat_edit,
					"volume"			=> $request->volume_edit,
					"disc"				=> $request->disc_brg_edit,
					"harga_disc"		=> $request->harga_disc_brg_edit
				]);

				if ($update) {
					return back()->with('success','Data Barang Berhasil Diubah');
				} else {
					return back()->with('error','Data Barang Gagal Diubah');
				}
			} else {
				return back()->with('error','Harap Periksa Kembali file inputan Anda !!!');
			}
		} else {
			$update = Barang::where('kd_brg', '=', $request->kd_brg_edit)->update([
				"kd_kat_android"	=> $request->kat_barang,
				"nm_brg"			=> $request->nm_brg_edit,
				"harga_jl"			=> $request->hrg_brg_edit,
				"berat"				=> $request->berat_edit,
				"volume"			=> $request->volume_edit,
				"disc"				=> $request->disc_brg_edit,
				"harga_disc"		=> $request->harga_disc_brg_edit
			]);

			if ($update) {
				return back()->with('success','Data Barang Berhasil Diubah');
			} else {
				return back()->with('error','Data Barang Gagal Diubah');
			}
		}
	}

	public function detail_barang($kd_brg)
	{
		$data = Barang::LeftJoin('kat_android', 'barang.kd_kat_android', '=', 'kat_android.kd_kat_android')->where('kd_brg', '=', $kd_brg)->get();
		$kat_barang = KategoriAndroid::all();

		return view('barang.detail_barang', compact('data', 'kat_barang'));
	}

	public function kategori_barang()
	{
		if (Auth::user()->kd_outlet == "all") {
			$data = KategoriAndroid::join('outlet', 'outlet.kd_outlet', '=', 'kat_android.kd_outlet')->get();
			$outlet = Outlet::all();
		} else {
			$data = KategoriAndroid::join('outlet', 'outlet.kd_outlet', '=', 'kat_android.kd_outlet')->where('kat_android.kd_outlet', '=', Auth::user()->kd_outlet)->get();
			$outlet = Outlet::where('kd_outlet', '=', Auth::user()->kd_outlet)->get();
		}

		return view('barang.kategori', compact('data', 'outlet'));
	}	

	public function edit_kategori(Request $request)
	{
		if ($request->gambar != "") {
			$path = $request->file('gambar')->store(
				'kategori_barang', 'public'
			);

			if ($path) {
				$update = KategoriAndroid::where('kd_kat_android', '=', $request->kd_kategori_edit)->update([
					"nm_kat_android"	=> $request->nm_kategori_edit,
					"sts_tampil"		=> $request->status,
					"gbr_kat_android"	=> $path,
					"kd_outlet"			=> $request->kd_outlet
				]);
			} else {
				return back()->with('error','Harap Periksa Kembali file inputan Anda !!!');
			}
		} else {
			$update = KategoriAndroid::where('kd_kat_android', '=', $request->kd_kategori_edit)->update([
				"nm_kat_android"	=> $request->nm_kategori_edit,
				"sts_tampil"		=> $request->status,
				"kd_outlet"			=> $request->kd_outlet
			]);
		}
		if ($update) {
			return back()->with('success','Data Barang Berhasil Diubah');
		} else {
			return back()->with('error','Data Barang Gagal Diubah');
		}
	}

	public function inputKategori(Request $request)
	{
		if ($request->gambar != "") {
			$path = $request->file('gambar')->store(
				'kategori_barang', 'public'
			);

			if ($path) {
				$insert = KategoriAndroid::insert([
					"kd_outlet"			=> $request->kd_outlet,
					"kd_kat_android"	=> $request->kd_kategori,
					"nm_kat_android"	=> $request->nm_kategori,
					"sts_tampil"		=> $request->status,
					"sts_point"			=> 0,
					"gbr_kat_android"	=> $path
				]);

				if ($insert) {
					return back()->with('success','Data Kategori Berhasil Disimpan');
				} else {
					return back()->with('error','Data Kategori Gagal Disimpan');
				}
			} else {
				return back()->with('error','Harap Periksa Kembali file inputan Anda !!!');
			}
		} else {
			$insert = KategoriAndroid::insert([
				"kd_outlet"			=> $request->kd_outlet,
				"kd_kat_android"	=> $request->kd_kategori,
				"nm_kat_android"	=> $request->nm_kategori,
				"sts_tampil"		=> $request->status,
				"sts_point"			=> 0,
				"gbr_kat_android"	=> ""
			]);
		}

		if ($insert) {
			return back()->with('success','Data Kategori Berhasil Disimpan');
		} else {
			return back()->with('error','Data Kategori Gagal Disimpan');
		}

	}
}
