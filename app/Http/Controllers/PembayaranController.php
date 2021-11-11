<?php

namespace QurirQ\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;
use QurirQ\JenisPembayaran;
use QurirQ\MstJual;
use QurirQ\MstQsend;
use Redirect;
use Session;

class PembayaranController extends Controller
{
	public function index()
	{
		$data = JenisPembayaran::all();
		
		return view('jenis_pembayaran.index', compact('data'));
	}
	
	public function getBank(Request $request)
	{
		$data = JenisPembayaran::where('nama_bank', 'like', '%'.$request->nama_bank.'%')->get();
		
		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}
	
	public function updateStsByr(Request $request)
	{
		$decode_image = base64_decode($request->bukti_tf);
		$f = finfo_open();

		$mime_type = finfo_buffer($f, $decode_image, FILEINFO_MIME_TYPE);
		$extension = explode('/', $mime_type);

		$nama_gbr = uniqid().".".$extension[1];

		$p = \Storage::put('/public/bukti_tf/' . $nama_gbr, base64_decode($request->bukti_tf), 0755);
		
		if ($p) {
			$data = MstJual::where('id', '=', $request->id_mst)->update([
				'bukti_tf'	=> 'bukti_tf/'.$nama_gbr,
				'sts_byr'	=> '1'
			]);
		}
		
		if ($data) {
			return response()->json(['message' => 'Pembayaran Diterima'], 200);
		} else {
			return response()->json(['message' => 'Update pembayaran gagal'], 401);
		}
	}

	public function updateStsByrQsend(Request $request)
	{
		$decode_image = base64_decode($request->bukti_tf);
		$f = finfo_open();

		$mime_type = finfo_buffer($f, $decode_image, FILEINFO_MIME_TYPE);
		$extension = explode('/', $mime_type);

		$nama_gbr = uniqid().".".$extension[1];

		$p = \Storage::put('/public/bukti_tf/' . $nama_gbr, base64_decode($request->bukti_tf), 0755);
		
		if ($p) {
			$data = MstQsend::where('id', '=', $request->id_mst)->update([
				'bukti_tf'	=> 'bukti_tf/'.$nama_gbr,
				'sts_bayar'	=> '1'
			]);
		}
		
		if ($data) {
			return response()->json(['message' => 'Pembayaran Diterima'], 200);
		} else {
			return response()->json(['message' => 'Update pembayaran gagal'], 401);
		}
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