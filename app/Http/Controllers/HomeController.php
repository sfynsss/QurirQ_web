<?php

namespace Larisso\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Larisso\Mail\SendMailable;
use Session;
use Redirect;
use Larisso\Customer;
use Larisso\Voucher;
use Larisso\Barang;
use Larisso\KategoriAndroid;
use Larisso\MstJual;
use Larisso\outlet;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $retail = Customer::where('KATEGORI', '=', 'RETAIL')->count();
        $grosir = Customer::where('KATEGORI', '=', 'GROSIR')->count();

        $barang = Barang::count();
        $kategori = KategoriAndroid::count();
        $outlet = outlet::where('status', '=', '1')->count();

        $total_retail = MstJuaL::where('sts_jual', '=', 'RETAIL')->sum('netto');
        $total_grosir = MstJuaL::where('sts_jual', '=', 'GROSIR')->sum('netto');
        $total_offline = MstJuaL::where('sts_jual', '=', 'OFFLINE')->sum('netto'); 

        return view('home', compact('retail', 'grosir', 'barang', 'kategori', 'outlet', 'total_retail', 'total_grosir', 'total_offline'));
    }

    public function mail()
    {
        $name = 'Selamat Anda mendapatkan email baru';
        Mail::to('sm.mahsun@yahoo.com')->send(new SendMailable($name));

        print_r("Email was sent");
    }

    public function downloadData()
    {
        $data = Customer::all();
        $client = new \GuzzleHttp\Client();
        $client2 = new \GuzzleHttp\Client();

        $myip = \request()->ip();
        foreach ($data as $data) {
            // print_r($data->KD_CUST);
            $response = $client->request('POST', "http://".$myip."/senyum_sinkron/index.php/customer/tambahCustomer", [
                'form_params'       => [
                    'KD_CUST'       => $data->KD_CUST,
                    'NM_CUST'       => $data->NM_CUST,
                    'ALM_CUST'      => $data->ALM_CUST,
                    'KD_KAT'        => $data->KD_KAT,
                    'KRD_LIMIT'     => $data->KRD_LIMIT,
                    'E_MAIL'        => $data->E_MAIL,
                    'TGL_LHR'       => $data->TGL_LHR,
                    'KD_WIL'        => $data->KD_WIL,
                    'WILAYAH'       => $data->WILAYAH,
                    'HP'            => $data->HP,
                    'JNS_KELAMIN'   => $data->JNS_KELAMIN
                ]
            ]);

        }

        $voucher = Voucher::where('status_voucher', '=', 'AKTIF')->get();

        foreach ($voucher as $vc) {
            $response1 = $client2->request('POST', "http://".$myip."/senyum_sinkron/index.php/voucher/tambahVoucher", [
                'form_params'           => [
                    'NO_VOUCHER'        => $vc->kd_voucher,
                    'NIL_VOUCHER'       => $vc->nilai_voucher,
                    'TGL_BERLAKU_1'     => $vc->tgl_berlaku_1,
                    'TGL_BERLAKU_2'     => $vc->tgl_berlaku_2,
                    'JNS_VOUCHER'       => $vc->jenis_voucher,
                    'KD_CUST'           => $vc->kd_cust
                ]
            ]);
        }

        $body   = json_decode($response->getBody(), true);

        if ($body['success'] == "Data Berhasil Ditambahkan") {
            Session::flash('success', "Download Data Berhasil !!!");
            return Redirect::back();
        } else {
            Session::flash('error', "Download Data Gagal !!!");
            return Redirect::back();
        }
    }
}
