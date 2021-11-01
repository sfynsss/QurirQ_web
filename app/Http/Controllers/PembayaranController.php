<?php

namespace QurirQ\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;
use QurirQ\JenisPembayaran;
use Redirect;
use Session;

class PembayaranController extends Controller
{
	public function index()
	{
		$data = JenisPembayaran::all();
		
		return view('jenis_pembayaran.index', compact('data'));
	}
	public function inputJenisPembayaran(Request $request) {
		
		if ($request->gambar_bank != "") {
			$path = $request->file('gambar_bank')->store(
				'gambar_bank', 'public'
			);
			
			if ($path) {
				$insert = JenisPembayaran::insert([
					"gambar_bank"		=> $path,
					"sts_aktif"	    	=> $request->sts_aktif,
					"nama_bank"	    	=> $request->nama_bank,
					"no_rekening"	    => $request->no_rekening,
					"keterangan"	    => $request->keterangan
				]);
			} else {
				return back()->with('error','Harap Periksa Kembali file inputan Anda !!!');
			}
		} else {
			$insert = JenisPembayaran::insert([
				"gambar_bank"		=> "",
				"sts_aktif"	    	=> $request->sts_aktif,
				"nama_bank"	    	=> $request->nama_bank,
				"no_rekening"	    => $request->no_rekening,
				"keterangan"	    => $request->keterangan
			]);
		}
		if ($insert) {
			Session::flash('success', "Data Berhasil Ditambakan !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Ditambahkan !!!");
			return Redirect::back();
		}
	}
	
	public function updateJenisPembayaran(Request $request)
	{
		if ($request->gambar_bank != "") {
			$path = $request->file('gambar_bank')->store(
				'gambar_bank', 'public'
			);
			
			$insert = JenisPembayaran::where('id', '=', $request->id_jenis)->update([
				"gambar_bank"		=> $path,
				"sts_aktif"	    	=> $request->sts_aktif,
				"nama_bank"	    	=> $request->nama_bank,
				"no_rekening"	    => $request->no_rekening,
				"keterangan"	    => $request->keterangan
			]);
			
		} else {
			$insert = JenisPembayaran::where('id', '=', $request->id_jenis)->update([
				"sts_aktif"	    	=> $request->sts_aktif,
				"nama_bank"	    	=> $request->nama_bank,
				"no_rekening"	    => $request->no_rekening,
				"keterangan"	    => $request->keterangan
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
	
	public function deleteJenisPembayaran($id)
	{
		$delete = JenisPembayaran::findOrFail($id);
		$delete->delete();
		if ($delete) {
			Session::flash('success', "Data Berhasil Dihapus !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Dihapus !!!");
			return Redirect::back();
		}
		return redirect()->route('jenis_pembayaran');
	}
	
}