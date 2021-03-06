<?php

namespace QurirQ\Http\Controllers\Api;

use Illuminate\Http\Request;
use QurirQ\Http\Controllers\Controller;
use QurirQ\MstQsend;
use QurirQ\DetQsend;
use QurirQ\Komisi;

class QsendController extends Controller
{
    public function inputQsend(Request $request)
    {
        $komisi;
        if  ($request->komisi == 0) {
            $dt = Komisi::first();
            $komisi = $request->total * ($dt->komisi_qurir/100);
        } else {
            $komisi = $request->komisi;
        }

        $mst = MstQsend::insertGetId([
            'id_user'			        => $request->id_user,
            'pengirim'		            => $request->nama_pengirim,
            'nama_alamat_pengirim'      => $request->nama_alamat_pengirim,
            'alamat_pengirim'	        => $request->alamat_pengirim,
            'detail_alamat_pengirim'	=> $request->detail_alamat_pengirim,
            'no_telp_pengirim'	        => $request->no_telp_pengirim,
            'lat_pengirim'		        => $request->lat_pengirim,
            'lng_pengirim'		        => $request->lng_pengirim,
            'total' 			        => $request->total,
            'jns_bayar'			        => $request->jns_bayar,
            'sts_bayar'			        => $request->sts_bayar,
            'komisi'			        => $komisi
        ]);
        
        $tmp_nama_penerima			    = explode(";", $request->nama_penerima);
        $tmp_nama_alamat_penerima		= explode(";", $request->nama_alamat_penerima);
        $tmp_alamat_penerima			= explode(";", $request->alamat_penerima);
        $tmp_detail_alamat_penerima		= explode(";", $request->detail_alamat_penerima);
        $tmp_no_telp_penerima			= explode(";", $request->no_telp_penerima);
        $tmp_detail_barang			    = explode(";", $request->detail_barang);
        $tmp_lat_penerima               = explode(";", $request->lat_penerima);
        $tmp_lng_penerima               = explode(";", $request->lng_penerima);
        $tmp_sub_total                  = explode(";", $request->sub_total);
        $tmp_jarak                      = explode(";", $request->jarak);
        
        for ($i=0; $i < count($tmp_nama_penerima); $i++) { 
            $det = DetQsend::insert([
                "id_mst"	                => $mst, 
                "nama_penerima"             => $tmp_nama_penerima[$i],
                "nama_alamat_penerima"      => $tmp_nama_alamat_penerima[$i],
                "alamat_penerima"           => $tmp_alamat_penerima[$i],
                "detail_alamat_penerima"    => $tmp_detail_alamat_penerima[$i],
                "no_telp_penerima"          => $tmp_no_telp_penerima[$i],
                "detail_barang"             => $tmp_detail_barang[$i],
                "lat_penerima"              => $tmp_lat_penerima[$i],
                "lng_penerima"              => $tmp_lng_penerima[$i],
                "sub_total"                 => $tmp_sub_total[$i],
                "jarak"                     => $tmp_jarak[$i]
            ]);
        }
        
        if ($det) {
            return response()->json(['message' => $mst], 200);
        } else {
            return response()->json('Pengiriman gagal ditempatkan', 404);
        }
    }

    public function hapusMstQsend(Request $request)
    {
        $delete = MstQsend::where('id', '=', $request->id)->delete();

        if ($delete) {
            return response()->json(['message' => "data berhasil dihapus"], 200);
        } else {
            return response()->json(['message' => "data gagal dihapus"], 200);
        }
    }
}
