<?php

namespace Larisso\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Larisso\Customer;
use Larisso\DetCustomer;
use Larisso\vw_laba_kotor;
use Larisso\Wilayah;
use Larisso\User;
use Larisso\SettingVoucher;
use Larisso\Voucher;
use Larisso\Outlet;
use Larisso\RecordPointEdit;
use Carbon\Carbon;
use Validator;
use Session;
use Redirect;

class CustomerController extends Controller
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
    	$data = Customer::join('users', 'users.id', '=', 'customer.id')
            ->where('KATEGORI', '=', 'RETAIL')
            ->orderby('customer.KD_CUST', 'desc')->get();
    	//$data = Customer::join('users', 'users.id', '=', 'customer.id')->where('customer.KD_CUST', '=', '99000011')->get();
        if (Auth::user()->kd_outlet == "") {
            $outlet = Outlet::all();
        } else {
            $outlet = Outlet::where('kd_outlet', '=', Auth::user()->kd_outlet)->get();
        }
        
    	// print_r($cabang);

        return view('customer.customer', compact('data', 'outlet'));
    }

    public function customerGrosir()
    {
        $data = Customer::join('users', 'users.id', '=', 'customer.id')
            ->where('KATEGORI', '=', 'GROSIR')
            ->orderby('customer.KD_CUST', 'desc')->get();
        
        if (Auth::user()->kd_outlet == "") {
            $outlet = Outlet::all();
        } else {
            $outlet = Outlet::where('kd_outlet', '=', Auth::user()->kd_outlet)->get();
        }
        
        // print_r($cabang);

        return view('customer.customer_grosir', compact('data', 'outlet'));
    }

    public  function pointCustomer()
    {
        $data = Customer::join('users', 'users.id', '=', 'customer.id')->orderby('customer.POINT_BL_INI', 'desc')->get();
        if (Auth::user()->kd_outlet == "") {
            $outlet = Outlet::all();
        } else {
            $outlet = Outlet::where('kd_outlet', '=', Auth::user()->kd_outlet)->get();
        }
        
        // print_r($cabang);

        return view('customer.point_customer', compact('data', 'outlet'));
    }

    public function editPointCustomer(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");

        $data = Customer::where('id', $request->id_user)->update([
                    'POINT_BL_INI' => $request->point_akhir
            ]);

            $user = RecordPointEdit::insertGetId([
                'nm_user' => Auth::user()->name,
                'kd_cust' => $request->kode_cust,
                'nm_cust' => $request->nm_cust,
                'tanggal' => Carbon::now(),
                'point_awal' => $request->point_awal,
                'point_akhir' => $request->point_akhir
            ]);

            if ($data) {
                Session::flash('success', "Point Berhasil Dirubah");
                return Redirect::back();
            } else {
                Session::flash('error', "Point Gagal Dirubah");
                return Redirect::back();
            }

            if ($user) {
                Session::flash('success', "Point Berhasil Dirubah");
                return Redirect::back();
            } else {
                Session::flash('error', "Point Gagal Dirubah");
                return Redirect::back();
            }

    }

    public function recordPointEdit()
    {
        $data = RecordPointEdit::orderby('id', 'desc')->get();
        return view('customer.record_point_edit', compact('data'));
    }

    public function tambahCustomer(Request $request)
    {
        // print_r($request->tgl_lahir."<br>");
    	$validasi = Validator::make($request->all(), [
    		'name' => 'required|string|max:255',
    		'email' => 'required|string|email|max:255|unique:users,email',
    		'no_telp' => 'required|string|unique:users,no_telp'
    	]);

    	if ($validasi->fails()) {
    		$errors = $validasi->errors();

    		Session::flash('error', $errors->first('email')." ".$errors->first('no_telp'));
    		return Redirect::back();
    	} else {
    		$user = User::insertGetId([
    			'name' => $request->name,
    			'email' => $request->email,
    			'no_telp' => $request->no_telp,
    			'password' => bcrypt(substr($request->tgl_lahir, 8, 2)."".substr($request->tgl_lahir, 5,2)."".substr($request->tgl_lahir, 2,2)),
    			'api_token' => bin2hex(openssl_random_pseudo_bytes(30)),
                'tanggal_lahir' => $request->tgl_lahir,
                'email_activation' => '0', 
                'otoritas' => $request->kategori,
                'alamat' => $request->alamat,
                'activation_token' => str_random(255)
            ]);

    		$data = Customer::insert([
                'kd_cust'       => $request->kode_cust,
                'id'            => $user,
                'kategori'      => $request->kategori,
                'nm_cust'       => $request->name,
                'alm_cust'      => $request->alamat,
                'e_mail'        => $request->email,
                'tgl_lhr'       => $request->tgl_lahir,
                'hp'            => $request->no_telp,
                'jns_kelamin'   => $request->jenis_kelamin
            ]);

            if ($data) {
                $register = User::where('id', '=', $user)->first();
                
                $name = $register['name'];
                $token = $register['activation_token'];
                Mail::to($register['email'])->send(new EmailActivation($name, $token));

                Session::flash('success', "Data Berhasil Ditambahkan !!!");
                return Redirect::back();
            } else {
                Session::flash('error', "Data Gagal Ditambahkan !!!");
                return Redirect::back();
            }
        }
    }

    public function editCustomer(Request $request)
    {
        //$cek = User::where('email', $request->email)->get();
        // if (count($cek) > 0) {
        //     Session::flash('error', "Alamat Email Sudah Terdaftar !!!");
        //     return Redirect::back();
        // } else {
        //     $update = User::where('id', $request->id_user)->update([
        //         'email'     => $request->email,
        //         'password'  => bcrypt($request->password)
        //     ]);
        //     if ($update) {
        //         Session::flash('success', "Data User Berhasil Diubah");
        //         return Redirect::back();
        //     } else {
        //         Session::flash('error', "Data User Gagal Diubah");
        //         return Redirect::back();
        //     }
        // }

            $update = User::where('id', $request->id_user)->update([
                'email'     => $request->email,
                'password'  => bcrypt($request->password)
            ]);

            if ($update) {
                Session::flash('success', "Data User Berhasil Diubah");
                return Redirect::back();
            } else {
                Session::flash('error', "Data User Gagal Diubah");
                return Redirect::back();
            }
        
    }

    public function downloadCustomer()
    {
        $data = Customer::all();
        $client = new \GuzzleHttp\Client();

        $myip = \request()->ip();
        foreach ($data as $data) {
            // print_r($data->KD_CUST);
            $response = $client->request('POST', "http://".$myip."/senyum_sinkron/index.php/customer/tambahCustomer", [
                'form_params'       => [
                    'KD_CUST'       => $data->KD_CUST,
                    'NM_CUST'       => $data->NM_CUST,
                    'ALM_CUST'      => $data->ALM_CUST,
                    'KD_KAT'        => $data->KD_KAT,
                    'KA_KAT'        => $data->KA_KAT,
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

        $body = json_decode($response->getBody(), true);

        if ($body['success'] == "Data Berhasil Ditambahkan") {
            Session::flash('success', "Data Berhasil Ditambahkan !!!");
            return Redirect::back();
        } else {
            Session::flash('error', "Data Gagal Ditambahkan !!!");
            return Redirect::back();
        }

    }

    public function sinkronisasi()
    {
        $client = new \GuzzleHttp\Client();
        $myip = \request()->ip();
        $response = $client->request('GET', 'http://'.$myip.'/senyum_sinkron/index.php/customer/getCustomer');
        $body = json_decode($response->getBody(), true);
        $setting = SettingVoucher::first();
        $hitung = 0;

        if (count($body["CUSTOMER"]["KD_CUST"]) > 0) {
            for ($i=0; $i < count($body["CUSTOMER"]["KD_CUST"]); $i++) { 
                $customer = $body["CUSTOMER"]["KD_CUST"][$i];
                $data = Customer::where('KD_CUST', '=', $customer)->first();
                $det_customer = DetCustomer::where('KD_CUST', '=', $customer)->where('cabang', '=', Auth::user()->cabang)->first();
                $tmp = 0;

                if (count($data) > 0) {
                    if (count($det_customer) == 0) {
                        $insert_det = DetCustomer::insert([
                            "kd_cust"           => $customer,
                            "cabang"            => Auth::user()->cabang,
                            "HJUAL_JUAL_BI"     => str_replace(",", "", $body["CUSTOMER"]["HJUAL_JUAL_BI"][$i]),
                            "HPP_JUAL_BI"       => str_replace(",", "", $body["CUSTOMER"]["HPP_JUAL_BI"][$i])
                        ]);
                    } else {
                        $insert_det = DetCustomer::where('KD_CUST', '=', $customer)->where('cabang', '=', Auth::user()->cabang)->update([
                            "HJUAL_JUAL_BI"     => str_replace(",", "", $body["CUSTOMER"]["HJUAL_JUAL_BI"][$i]),
                            "HPP_JUAL_BI"       => str_replace(",", "", $body["CUSTOMER"]["HPP_JUAL_BI"][$i])
                        ]);
                    }   

                    if ($insert_det) {
                        $laba_kotor = vw_laba_kotor::select('laba_kotor')->where('kd_cust', '=', $customer)->first();
                        $ketentuan = $setting['ketentuan'];
                        $laba_digunakan = $data['LABA_DIGUNAKAN'];
                        $sisa = $laba_kotor['laba_kotor'] - $laba_digunakan;

                        if ($sisa >= $ketentuan) {
                            $hitung = floor($sisa / $ketentuan); 
                            $tmp = $sisa - ($sisa % $ketentuan);

                            //tambah voucher elektrik
                            for ($j=0; $j < $hitung; $j++) {
                                $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
                                $randomString = ''; 
                                for ($k = 0; $k < 6; $k++) { 
                                    $index = rand(0, strlen($characters) - 1); 
                                    $randomString .= $characters[$index]; 
                                } 
                                $insert = Voucher::insert([
                                    "kd_voucher"        => $randomString,
                                    "kd_cust"           => $customer,
                                    "nama_voucher"      => $setting['nama_voucher'],
                                    "nilai_voucher"     => $setting['nilai_voucher'],
                                    "tgl_berlaku_1"     => date_create('now')->format('Y-m-d'),
                                    "tgl_berlaku_2"     => date('Y-m-d',strtotime('+30 days',strtotime(now()))) . PHP_EOL,
                                    "jenis_voucher"     => "ELEKTRONIK",
                                    "status_voucher"    => "NON-AKTIF",
                                    "gambar"            => $setting['gambar_voucher'],
                                    "sk"                => $setting['sk']
                                ]);    
                            }
                            //end tambah voucher elektrik
                        }


                        $update = Customer::where('KD_CUST', '=', $customer)->update([
                            "LABA_DIGUNAKAN"    => $tmp
                        ]);
                    }
                }
            }

            Session::flash('success', "Sinkronisasi berhasil !!!");
            return Redirect::back();
        } else {
            Session::flash('error', "Data Customer Kosong !!!");
            return Redirect::back();
        }
    }

    public function cabang()
    {
        $data = Cabang::all();

        return view('customer.cabang', compact('data'));
    }

    public function aktifasiAkun($email)
    {
        $cek = User::where('email', $email)->where('email_activation', '1')->get();
        $update1 = false;
        if (count($cek) > 0) {
            $update1 = User::where('email', '=', $email)->update([
                'activation_token' => substr(str_shuffle("0123456789"), 0, 4), 
                'email_activation' => '0'
            ]);
        } else {
            $update = User::where('email', $email)->update([
                'email_activation'      => '1',
                'activation_token'      => ""
            ]);
        }

        if ($update1) {
            Session::flash('warning', "Akun berhasil di nonaktifkan !!!");
            return Redirect::back();
        } else if ($update) {
            Session::flash('success', "Akun berhasil di aktifkan !!!");
            return Redirect::back();
        } else {
            Session::flash('error', "Operasi Gagal !!!");
            return Redirect::back();
        }
    }

    public function deaktifasiAkun(Request $request)
    {
        $save = User::where('id', '=', $request->id)->update([
            'otoritas'          => 'RETAIL',
            'foto_ktp'          => 'kosong'
        ]);

        $save2 = Customer::join('users', 'users.id', '=', 'customer.id')->where('users.id', '=', $request->id)->update([
            'KATEGORI'          => 'RETAIL'
        ]);

        if ($save) {
            Session::flash('warning', "Akun telah di non-aktifkan");
            return Redirect::back();
        } else {
            Session::flash('error', "Akun gagal di non-aktifkan");
            return Redirect::back();
        }
    }
}
