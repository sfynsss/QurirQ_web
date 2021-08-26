<?php

namespace Larisso\Http\Controllers;

use Illuminate\Http\Request;
use Larisso\Outlet;
use Larisso\KategoriOutlet;
use Larisso\KategoriAndroid;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Session;
use Redirect;

class OutletController extends Controller
{
	public function index(){
		$data = Outlet::all();

		return view('outlet.index', compact('data'));
	}

	public function tambahOutlet(Request $request)
	{
		$status = 0;
		$kd_outlet = "";

		if ($request->status == 1) {
			$status = 1	;
		} 

		$kd_outlet = $request->kd_outlet."";
		if (! Schema::hasColumn('customer', $kd_outlet)) {
			Schema::table('customer', function (Blueprint $table) use ($kd_outlet) {
				$table->tinyInteger($kd_outlet)->default(1);
			});
		} else {
			
		}

		if ($request->gambar_outlet != "") {
			$path = $request->file('gambar_outlet')->store(
				'gambar_outlet', 'public'
			);

			$insert = Outlet::insert([
				'kd_outlet'			=> $request->kd_outlet,
				'nama_outlet'		=> $request->nama_outlet,
				'keterangan'		=> $request->keterangan,
				'status'			=> $status,
				'gambar_outlet'		=> $path,
				'alamat'			=> $request->alamat
			]);
		} else {
			$insert = Outlet::insert([
				'kd_outlet'			=> $request->kd_outlet,
				'nama_outlet'		=> $request->nama_outlet,
				'keterangan'		=> $request->keterangan,
				'status'			=> $status,
				'gambar_outlet'		=> "",
				'alamat'			=> $request->alamat
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

	public function ubahOutlet(Request $request)
	{
		$status = 0;

		if ($request->status == 1) {
			$status = 1	;
		} 

		if ($request->gambar_outlet != "") {
			$path = $request->file('gambar_outlet')->store(
				'gambar_outlet', 'public'
			);

			$insert = Outlet::where('kd_outlet', '=', $request->kd_outlet)->update([
				'nama_outlet'		=> $request->nama_outlet,
				'keterangan'		=> $request->keterangan,
				'status'			=> $status,
				'gambar_outlet'		=> $path,
				'alamat'			=> $request->alamat
			]);

		} else {
			$insert = Outlet::where('kd_outlet', '=', $request->kd_outlet)->update([
				'nama_outlet'		=> $request->nama_outlet,
				'keterangan'		=> $request->keterangan,
				'status'			=> $status,
				'alamat'			=> $request->alamat
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

	public function deleteOutlet($id)
	{
		$insert = Outlet::where('kd_outlet', '=', $id)->delete();

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
