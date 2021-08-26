<?php

namespace Larisso\Http\Controllers;

use Illuminate\Http\Request;
use Larisso\MstJual;
use Larisso\DetJual;
use Larisso\VwMstJual;
use Larisso\MstOrderJual;
use Larisso\DetOrderJual;
use Larisso\Barang;
use Larisso\Customer;
use Session;
use Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use PDF;

class PenjualanController extends Controller
{

    public function index()
    {
    	$data = MstJual::join('customer', 'customer.id', '=', 'id_user')->where('sts_jual', '!=', 'OFFLINE')->orderBy('mst_jual.tanggal', 'desc')->get();
    	// dd($data);
    	return view('penjualan.penjualan', compact('data'));
    }

    public function penjualanPickup()
    {
        $data = MstJual::join('customer', 'customer.id', '=', 'id_user')->where('sts_jual', '!=', 'OFFLINE')->orderBy('mst_jual.tanggal', 'desc')->where('jns_pengiriman', '=', 'pickup')->get();
        return view('penjualan.penjualan', compact('data'));
    }

    public function penjualanCOD()
    {
        $data = MstJual::join('customer', 'customer.id', '=', 'id_user')->where('sts_jual', '!=', 'OFFLINE')->orderBy('mst_jual.tanggal', 'desc')->where('jns_pengiriman', '=', 'cod')->get();
        return view('penjualan.penjualan', compact('data'));
    }

    public function penjualanJNE()
    {
        $data = MstJual::join('customer', 'customer.id', '=', 'id_user')->where('sts_jual', '!=', 'OFFLINE')->orderBy('mst_jual.tanggal', 'desc')->where('jns_pengiriman', '=', 'jne')->get();
        return view('penjualan.penjualan', compact('data'));
    }

    public function penjualanJNT()
    {
        $data = MstJual::join('customer', 'customer.id', '=', 'id_user')->where('sts_jual', '!=', 'OFFLINE')->orderBy('mst_jual.tanggal', 'desc')->where('jns_pengiriman', '=', 'jnt')->get();
        return view('penjualan.penjualan', compact('data'));
    }

    public function penjualanPOS()
    {
        $data = MstJual::join('customer', 'customer.id', '=', 'id_user')->where('sts_jual', '!=', 'OFFLINE')->orderBy('mst_jual.tanggal', 'desc')->where('jns_pengiriman', '=', 'pos')->get();
        return view('penjualan.penjualan', compact('data'));
    }

    public function laporanPenjualan()
    {
        $data = MstJual::join('customer', 'customer.id', '=', 'id_user')
            ->where('sts_jual', '!=', 'OFFLINE')
            ->where('sts_transaksi', '=', 'SELESAI')
            ->whereDate('tanggal', Carbon::today())
            ->orderBy('mst_jual.tanggal', 'desc')
            ->get();
        return view('penjualan.laporan_penjualan', compact('data'));
    }

    public function detailJual($id)
    {
        $barang = Barang::All();
        $data = DetJual::where('no_ent', '=', str_replace('-', '/', $id))->get();
        $mst = MstJual::join('customer', 'customer.kd_cust', '=', 'mst_jual.kd_cust')->where('no_ent', '=', str_replace('-', '/', $id))->first();
        // print_r($data);
        // print_r($mst);
        return view('penjualan.detailJual', compact('data', 'mst', 'barang'));
    }

    public function detPenjualan($no_ent)
    {
    	$data = DetJual::where('no_ent', '=', str_replace('-', '/', $no_ent))->get();

    	return json_encode($data);
    }

    public function inputResi(Request $request)
    {
    	$data = MstJual::where('no_ent', '=', $request->no_ent)->update([
    		"no_resi" => $request->no_resi
    	]);

    	return back();	
    }

    public function gantiStatusTransaksi(Request $request)
    {
        $data = MstJual::where('no_ent', '=', $request->no_ent1)->update([
            "sts_transaksi" => $request->status
        ]);

        if ($data) {
            Session::flash('success', "Data Berhasil Diupdate !!!");
            return Redirect::back();
        } else {
            Session::flash('error', "Data Gagal Diupdate !!!");
            return Redirect::back();
        }
    }    

    public function orderPenjualan()
    {
        $data = MstOrderJual::join('customer', 'customer.KD_CUST', '=', 'mst_ord_jual_mob.KD_CUST')->get();
        // dd($data);
        return view('penjualan.order', compact('data'));
    }

    public function detailOrder($id)
    {
        $barang = Barang::All();
        $data = DetOrderJual::where('NO_ENT', '=', str_replace('-', '/', $id))->get();
        $mst = MstOrderJual::join('customer', 'customer.KD_CUST', '=', 'mst_ord_jual_mob.KD_CUST')->where('NO_ENT', '=', str_replace('-', '/', $id))->first();
        // dd($id);
        return view('penjualan.detailOrder', compact('data', 'mst', 'barang'));
    }

    public function simpanPenjualan(Request $request)
    {
        $no_ent = MstJual::where('id_user', '=', $request->id)->orderBy('no_ent', 'desc')->first();
        // $kd_cust = Customer::select('kd_cust')->where('id', '=', $request->id)->first();

        date_default_timezone_set("Asia/Jakarta");

        if ($no_ent) {
            $data = (int) substr($no_ent->no_ent, 15, 8) + 1;
            // print_r($data);
            $tmp = "INVJ".date('md').'/'.sprintf("%'.05d", $request->id).'/'.sprintf("%'.08d", $data);
        } else {
            $tmp = "INVJ".date('md').'/'.sprintf("%'.05d", $request->id).'/'.sprintf("%'.08d", 1);
        }

        $mst_order = MstOrderJual::where('NO_ENT', '=', $request->no_ent)->get();
        $kd_cust = Customer::where('KD_CUST', '=', $mst_order[0]->KD_CUST)->get();

        $mst = MstJual::insertGetId([
            'no_ent'            => $tmp,
            'id_user'           => $request->id,
            'transaction_id'    => "",
            'kd_cust'           => $mst_order[0]->KD_CUST,
            'nm_penerima'       => $kd_cust[0]->NM_CUST,
            'alm_penerima'      => $kd_cust[0]->ALM_CUST,
            'no_telp_penerima'  => $kd_cust[0]->HP,
            'total'             => $mst_order[0]->TOTAL,
            'disc_pr'           => 0,
            'disc_value'        => 0,
            'kd_voucher'        => 0,
            'jns_bayar'         => "KREDIT",
            'netto'             => $mst_order[0]->TOTAL,
            'ongkir'            => 0,
            'jns_pengiriman'    => "",
            'no_resi'           => "",
            'sts_byr'           => 0
        ]);

        $det_order = DetOrderJual::where('NO_ENT', '=', $request->no_ent)->get();

        for ($i=0; $i < count($det_order); $i++) { 
            $det = DetJual::insert([
                "no_ent"    =>  $tmp,
                "kd_brg"    =>  $det_order[$i]->KD_BRG,
                "nm_brg"    =>  $det_order[$i]->NM_BRG,
                "harga"     =>  $det_order[$i]->HARGA,
                "jumlah"    =>  $det_order[$i]->JUMLAH,
                "satuan"    =>  $det_order[$i]->SATUAN,
                "sub_total" =>  $det_order[$i]->SUB_TOTAL
            ]);
        }

        if ($det) {
            $mst_order = MstOrderJual::where('NO_ENT', '=', $request->no_ent)->update([
                "PROSES"    => "JUAL"
            ]);

            Session::flash('success', "Data Berhasil Ditambahkan !!!");
            return Redirect::back();
        } else {
            Session::flash('error', "Data Gagal Ditambahkan !!!");
            return Redirect::back();
        }
    }

    public function print_ticket($id)
    {
        $mst = MstJual::join('customer', 'customer.kd_cust', '=', 'mst_jual.kd_cust')->where('no_ent', '=', str_replace('-', '/', $id))->first();

        $pdf = PDF::loadView('penjualan.print_ticket', compact('mst')); //load view page
        // return $pdf->download('Ticket '.$mst->no_ent.'.pdf'); // download pdf file
        return $pdf->stream(); // download pdf file
        // return view('penjualan.print_ticket', compact('mst'));
    }
}
