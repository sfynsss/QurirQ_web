<?php

namespace Larisso\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Larisso\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Larisso\Mail\EmailActivation;
use Larisso\Mail\ForgetPassword;
use Larisso\User;
use Larisso\Alamat;
use Larisso\Update;
use DB;

class UserController extends Controller
{
	public function forgetPassword(Request $request)
	{
		$user = User::where('email', '=', $request->email)->where('email_activation', '=', '1')->first();

		if ($user) {
			$random = str_random(255);
			$user->update([
				'activation_token'	=> $random
			]);

			$email = $user['email'];
			Mail::to($email)->send(new ForgetPassword($email, $random));

			return response()->json(['message' => 'Silahkan cek email Anda untuk mendapatkan password terbaru'], 200);
		} else {
			return response()->json(['message' => 'Reset password gagal'], 401);
		}
	}

	public function tambahAlamat(Request $request)
	{
		$insert = Alamat::insert([
			"id_user"			=> $request->id_user,
			"nama_penerima"		=> $request->nama,
			"provinsi"			=> $request->provinsi,
			"kota"				=> $request->kota,
			"kecamatan"			=> $request->kecamatan,
			"kd_provinsi"		=> $request->kd_provinsi,
			"kd_kota"			=> $request->kd_kota,
			"kd_kecamatan"		=> $request->kd_kecamatan,
			"alamat_lengkap"	=> $request->alamat,
			"no_telp_penerima"	=> $request->no_telp,
			"kode_pos"			=> $request->kode_pos,
			"latitude"			=> $request->latitude,
			"longitude"			=> $request->longitude

		]);

		if ($insert) {
			return response()->json(['message' => 'Input Data Berhasil'], 200);
		} else {
			return response()->json(['message' => 'Input Data Gagal'], 401);
		}	
	}

	public function ubahAlamat(Request $request)
	{
		$insert = Alamat::where('kd_alamat', '=', $request->kd_alamat)->update([
			"nama_penerima"		=> $request->nama,
			"provinsi"			=> $request->provinsi,
			"kota"				=> $request->kota,
			"kecamatan"			=> $request->kecamatan,
			"kd_provinsi"		=> $request->kd_provinsi,
			"kd_kota"			=> $request->kd_kota,
			"kd_kecamatan"		=> $request->kd_kecamatan,
			"alamat_lengkap"	=> $request->alamat,
			"no_telp_penerima"	=> $request->no_telp,
			"kode_pos"			=> $request->kode_pos,
			"latitude"			=> $request->latitude,
			"longitude"			=> $request->longitude

		]);

		if ($insert) {
			return response()->json(['message' => 'Update Data Berhasil'], 200);
		} else {
			return response()->json(['message' => 'Update Data Gagal'], 401);
		}	
	}

	public function getAlamat(Request $request)
	{
		$insert = Alamat::where('id_user', '=', $request->id_user)->get();

		if ($insert) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $insert], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}	
	}

	public function getKdPeg()
	{
		$data = User::select('kd_peg')->where('otoritas', '=', '5')->orderBy('kd_peg', 'desc')->get();

		if (count($data) > 0) {
			// print_r($data->kd_peg);
			$data = (int) substr($data[0]->kd_peg, 5, 8) + 1;
			$tmp = "P-01".sprintf("%'.04d", $data);
		} else {
			$tmp = "P-01".sprintf("%'.04d", 1);
		}
		// print_r($tmp);
		return response()->json($tmp, 200);
	}

	public function resendAktifasi(Request $request)
	{
		$user = tap(DB::table('users')->where('email', '=', $request->email))->update([
			'activation_token' => substr(str_shuffle("0123456789"), 0, 4)
		])->first();

		if ($user) {
			$name = $user->name;
			$token = $user->activation_token;
			Mail::to($user->email)->send(new EmailActivation($name, $token));

			return response()->json(['message' => 'Silahkan cek email Anda untuk mendapatkan OTP terbaru'], 200);
		} else {
			return response()->json(['message' => 'Request kode OTP gagal'], 401);
		}
	}

	public function generateGrosirToken(Request $request)
	{
		$user = tap(DB::table('users')->where('email', '=', $request->email))->update([
			'grosir_token' => substr(str_shuffle("0123456789"), 0, 4)
		])->first();

		if ($user) {
			return response()->json(['message' => 'Generate Token Berhasil', 'data' => $user->grosir_token], 200);
		} else {
			return response()->json(['message' => 'Generate Token gagal'], 401);
		}
	}

	public function getOtp(Request $request)
	{
		$user = User::where('email', '=', $request->email)->first();

		if ($user) {
			$name = $user->name;
			$token = $user->activation_token;
			Mail::to($user->email)->send(new EmailActivation($name, $token));

			return response()->json(['message' => 'Kode OTP berhasil dikirimkan, silahkan cek email Anda'], 200);
		} else {
			return response()->json(['message' => 'Reset kode OTP gagal'], 401);
		}
	}

	public function getStatusUpdate(Request $request)
	{
		$data = Update::where('sts_update', $request->id)->get();
		if (count($data) > 0) {
			return response()->json(['message' => "not update"], 200);	
		} else {
			return response()->json(['message' => "update"], 200);	
		}
	}

	public function getStatusUpdateGrosir(Request $request)
	{
		$data = Update::where('sts_update_grosir', $request->id)->get();
		if (count($data) > 0) {
			return response()->json(['message' => "not update"], 200);	
		} else {
			return response()->json(['message' => "update"], 200);	
		}
	}

}
