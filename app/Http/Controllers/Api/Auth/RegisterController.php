<?php

namespace Larisso\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Larisso\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Larisso\Mail\EmailActivation;
use Larisso\User;
use Larisso\Customer;
use Validator;

class RegisterController extends Controller
{
	public function validator(Request $request)
	{

		$validasi = Validator::make($request->all(), [
			'name' => 'required|string|max:255',
			'tanggal_lahir' => 'required|date',
			'email' => 'required|string|email|max:255|unique:users,email',
			'no_telp' => 'required|string|unique:users,no_telp',
			'password' => 'required|string|min:6',
		]);

		if ($validasi->fails()) {
			return response()->json(['message' => 'Unauthorized', 'error' => $validasi->errors()], 422);
		} else {
			return response()->json(['message' => 'Validasi Berhasil'], 200);
		}
	}

	public function register(Request $request)
	{
		// $otor;
		// if ($request->kd_kat == "02") {
		// 	$otor= "RETAIL";
		// } else if ($request->kd_kat == "03") {
		// 	$otor = "GROSIR";
		// } 
		$user = User::insertGetId([
			'name' => $request->name,
			'tanggal_lahir' => $request->tanggal_lahir,
			'email' => $request->email,
			'alamat' => $request->alamat,
			'no_telp' => $request->no_telp,
			'password' => bcrypt($request->password),
			'api_token' => bin2hex(openssl_random_pseudo_bytes(30)),
			'firebase_token' => $request->firebase_token,
			'email_activation' => '0', 
			'otoritas'	=> $request->kd_kat,
			'foto'	=> 'kosong',
			'foto_ktp'	=> 'kosong',
			'activation_token' => substr(str_shuffle("0123456789"), 0, 4),
			'grosir_token' => substr(str_shuffle("0123456789"), 0, 4)
		]);

		if ($user > 0) {
			$data = Customer::max('kd_cust');

			if ($data) {
            // print_r($data);
				$data = (int) substr($data, 2) + 1;
				$tmp = "99".sprintf("%'.06d", $data);
			} else {
				$tmp = "99".sprintf("%'.06d", 1);
			}

			$save = Customer::insert([
				'kd_cust'		=> $tmp,
				'id'			=> $user,
				'kategori'		=> $request->kd_kat,
				'nm_cust'		=> $request->name,
				'alm_cust'		=> $request->alamat,
				'e_mail'		=> $request->email,
				'hp'			=> $request->no_telp,
				'JNS_KELAMIN'	=> $request->jenis_kelamin
			]);

			if ($save) {
				$register = User::select('users.*', 'customer.JNS_KELAMIN', 'customer.KD_CUST')->where('users.id', '=', $user)->join('customer', 'customer.id', '=', 'users.id')->first();

				return response()->json(compact('register'), 200);
			} else {
				return response()->json(['error' => 'Registration Failed'], 401);
			}
		} else {
			//rollback
		}
	}

	public function registerGrosir(Request $request)
	{

		$user = User::insertGetId([
			'name' => $request->name,
			'tanggal_lahir' => $request->tanggal_lahir,
			'email' => $request->email,
			'alamat' => $request->alamat,
			'no_telp' => $request->no_telp,
			'password' => bcrypt($request->password),
			'api_token' => bin2hex(openssl_random_pseudo_bytes(30)),
			'firebase_token' => $request->firebase_token,
			'email_activation' => '0', 
			'otoritas'	=> $request->kd_kat,
			'activation_token' => substr(str_shuffle("0123456789"), 0, 4),
			'grosir_token' => substr(str_shuffle("0123456789"), 0, 4),
			'foto' => $request->foto,
			'foto_ktp' => $request->foto_ktp,
		]);

		if ($user > 0) {
			$data = Customer::max('kd_cust');
			if ($data) {
				$data = (int) substr($data, 2) + 1;
				$tmp = "99".sprintf("%'.06d", $data);
			} else {
				$tmp = "99".sprintf("%'.06d", 1);
			}

			$save = Customer::insert([
				'kd_cust'		=> $tmp,
				'id'			=> $user,
				'kategori'		=> $request->kd_kat,
				'nm_cust'		=> $request->name,
				'alm_cust'		=> $request->alamat,
				'e_mail'		=> $request->email,
				'hp'			=> $request->no_telp,
				'JNS_KELAMIN'	=> $request->jenis_kelamin
			]);

			if ($save) {
				$register = User::select('users.*', 'customer.JNS_KELAMIN', 'customer.KD_CUST')->where('users.id', '=', $user)->join('customer', 'customer.id', '=', 'users.id')->first();

				return response()->json(compact('register'), 200);
			} else {
				return response()->json(['error' => 'Registration Failed'], 401);
			}
		} else {
			//rollback
		}
	}

	public function aktifasi(Request $request)
	{
		$user = User::where('id', '=', $request->id)->where('activation_token', '=', $request->token)->update([
			'email_activation'		=> '1',
			'activation_token'		=> ""
		]);

		if ($user) {
			return response()->json(['message' => 'Aktifasi Berhasil'], 200);
		} else {
			return response()->json(['message' => 'Aktifasi Gagal, silahkan perikasa kembali kode aktifasi Anda'], 401);
		}
	}

	public function aktifasiGrosir(Request $request)
	{
		$decode_image = base64_decode($request->foto_ktp);
		//$decode_image2 = base64_decode($request->foto);
		$f = finfo_open();

		$mime_type = finfo_buffer($f, $decode_image, FILEINFO_MIME_TYPE);
		//$mime_type2 = finfo_buffer($f, $decode_image2, FILEINFO_MIME_TYPE);
		$extension = explode('/', $mime_type);
		//$extension2 = explode('/', $mime_type2);

		$nama_gbr = uniqid().".".$extension[1];
		//$nama_gbr2 = uniqid().".".$extension2[1];

		$p = \Storage::put('/public/gambar_grosir/' . $nama_gbr, base64_decode($request->foto_ktp), 0775);
		//$p2 = \Storage::put('/public/gambar_grosir/' . $nama_gbr2, base64_decode($request->foto), 0775);

		$user = User::where('id', '=', $request->id)->where('grosir_token', '=', $request->token)->update([
			'email_activation'		=> '1',
			'otoritas'				=> 'GROSIR',
			'foto_ktp'				=> $nama_gbr,
			//'foto'					=> $nama_gbr2
		]);

		$user2 = Customer::join('users', 'users.id', '=', 'customer.id')->where('users.id', '=', $request->id)->update([
			'KATEGORI'				=> 'GROSIR'
		]);

		if ($user) {
			return response()->json(['message' => 'Aktifasi Berhasil'], 200);
		} else {
			return response()->json(['message' => 'Aktifasi Gagal, silahkan perikasa kembali kode aktifasi Anda'], 401);
		}
	}

	public function generateGrosirToken(Request $request)
	{
		$user = User::where('id', '=', $request->id)->update([
			'grosir_token' => substr(str_shuffle("0123456789"), 0, 4)
		]);

		if ($user) {
			return response()->json(['message' => 'Aktifasi Berhasil'], 200);
		} else {
			return response()->json(['message' => 'Aktifasi Gagal, silahkan perikasa kembali'], 401);
		}
	}

}
