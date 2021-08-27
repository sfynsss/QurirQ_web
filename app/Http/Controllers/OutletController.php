<?php

namespace QurirQ\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use QurirQ\Outlet;
use QurirQ\KategoriOutlet;
use QurirQ\KategoriAndroid;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Session;
use Redirect;

class OutletController extends Controller
{
	public function kategori_outlet()
	{
		$data = KategoriOutlet::all();

		return view('outlet.kategori', compact('data'));
	}

	public function simpan_kategori_outlet(Request $request)
	{
		if ($request->gambar != "") {
			$path = $request->file('gambar')->store(
				'kategori_outlet', 'public'
			);

			if ($path) {
				$insert = KategoriOutlet::insert([
					"nm_kategori_outlet"	=> $request->nm_kategori,
					"gbr_kategori_outlet"	=> $path,
					"sts_tampil"			=> $request->status
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
			$insert = KategoriOutlet::insert([
				"nm_kategori_outlet"	=> $request->nm_kategori,
				"gbr_kategori_outlet"	=> "",
				"sts_tampil"			=> $request->status
			]);
		}

		if ($insert) {
			return back()->with('success','Data Kategori Berhasil Disimpan');
		} else {
			return back()->with('error','Data Kategori Gagal Disimpan');
		}
	}

	public function ubah_kategori_outlet(Request $request)
	{
		if ($request->gambar != "") {
			$path = $request->file('gambar')->store(
				'kategori_outlet', 'public'
			);

			if ($path) {
				$insert = KategoriOutlet::where('id', $request->id_kategori)->update([
					"nm_kategori_outlet"	=> $request->nm_kategori,
					"gbr_kategori_outlet"	=> $path,
					"sts_tampil"			=> $request->status
				]);

				if ($insert) {
					return back()->with('success','Data Kategori Berhasil Diubah');
				} else {
					return back()->with('error','Data Kategori Gagal Diubah');
				}
			} else {
				return back()->with('error','Harap Periksa Kembali file inputan Anda !!!');
			}
		} else {
			$insert = KategoriOutlet::where('id', $request->id_kategori)->update([
				"nm_kategori_outlet"	=> $request->nm_kategori,
				"gbr_kategori_outlet"	=> "",
				"sts_tampil"			=> $request->status
			]);
		}

		if ($insert) {
			return back()->with('success','Data Kategori Berhasil Diubah');
		} else {
			return back()->with('error','Data Kategori Gagal Diubah');
		}
	}

	public function data_outlet($id){
		$data = Outlet::where('id_kategori_outlet', $id)->get();
		$kategori = KategoriOutlet::findOrFail($id);

		return view('outlet.data_outlet', compact('data', 'kategori'));
	}

	public function simpan_outlet(Request $request)
	{
		$status = 0;
		$kd_outlet = "";

		if ($request->status == 1) {
			$status = 1	;
		} 

		if ($request->gambar_outlet != "") {
			$path = $request->file('gambar_outlet')->store(
				'gambar_outlet', 'public'
			);

			$insert = Outlet::insert([
				'id_kategori_outlet'	=> $request->id_kategori_outlet,
				'nama_outlet'			=> $request->nama_outlet,
				'keterangan'			=> $request->keterangan,
				'status'				=> $status,
				'gambar_outlet'			=> $path,
				'alamat'				=> $request->alamat,
				'lat'					=> $request->lat,
				'long'					=> $request->long
			]);
		} else {
			$insert = Outlet::insert([
				'id_kategori_outlet'	=> $request->id_kategori_outlet,
				'nama_outlet'			=> $request->nama_outlet,
				'keterangan'			=> $request->keterangan,
				'status'				=> $status,
				'gambar_outlet'			=> "",
				'alamat'				=> $request->alamat,
				'lat'					=> $request->lat,
				'long'					=> $request->long
			]);
		}

		if ($insert) {
			Session::flash('success', "Data Berhasil Ditambahkan !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Ditambahkan !!!");
			return Redirect::back();
		}	
	}

	public function ubah_outlet(Request $request)
	{
		$status = 0;

		if ($request->status == 1) {
			$status = 1	;
		} 

		if ($request->gambar_outlet != "") {
			$path = $request->file('gambar_outlet')->store(
				'gambar_outlet', 'public'
			);

			$insert = Outlet::where('id', '=', $request->id_outlet)->update([
				'id_kategori_outlet'	=> $request->id_kategori_outlet,
				'nama_outlet'			=> $request->nama_outlet,
				'keterangan'			=> $request->keterangan,
				'status'				=> $status,
				'gambar_outlet'			=> $path,
				'alamat'				=> $request->alamat,
				'lat'					=> $request->lat,
				'long'					=> $request->long
			]);

		} else {
			$insert = Outlet::where('id', '=', $request->id_outlet)->update([
				'id_kategori_outlet'	=> $request->id_kategori_outlet,
				'nama_outlet'			=> $request->nama_outlet,
				'keterangan'			=> $request->keterangan,
				'status'				=> $status,
				'gambar_outlet'			=> "",
				'alamat'				=> $request->alamat,
				'lat'					=> $request->lat,
				'long'					=> $request->long
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

	public function hapus_outlet($id)
	{
		$insert = Outlet::where('id', '=', $id)->delete();

		if ($insert) {
			Session::flash('success', "Data Berhasil Dihapus !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Dihapus !!!");
			return Redirect::back();
		}
	}

	public function detailOutlet($id){
		$kategori = KategoriAndroid::all();
		$nama_outlet = Outlet::where('kd_outlet', '=', $id)->first();
		$data = KategoriOutlet::join('kat_android', 'kat_android.kd_kat_android', '=', 'kat_outlet.kd_kat_android')->where('kd_outlet', '=', $id)->get();

		return view('outlet.detail', compact('data', 'nama_outlet', 'kategori'));
	}

	public function tambahKategoriOutlet(Request $request)
	{
		$status = 0;

		if ($request->status == 1) {
			$status = 1	;
		} 

		if ($request->kategori[0] == "semua") {
			$data_kat = KategoriAndroid::all();
			foreach ($data_kat as $data) {
				$insert = KategoriOutlet::insert([
					'kd_outlet'			=> $request->kd_outlet,
					'kd_kat_android'	=> $data->kd_kat_android,
					'status'			=> $status,
				]);
			}
		} else {
			for ($i=0; $i < count($request->kategori); $i++) { 
				$insert = KategoriOutlet::insert([
					'kd_outlet'			=> $request->kd_outlet,
					'kd_kat_android'	=> $request->kategori[$i],
					'status'			=> $status,
				]);
			}
		}

		if ($insert) {
			Session::flash('success', "Data Berhasil Ditambahkan !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Ditambahkan !!!");
			return Redirect::back();
		}
	}

	public function deleteKategoriOutlet($id)
	{
		$insert = KategoriOutlet::where('nmr', '=', $id)->delete();

		if ($insert) {
			Session::flash('success', "Data Berhasil Dihapus !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Dihapus !!!");
			return Redirect::back();
		}
	}
}
