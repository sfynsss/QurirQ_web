<?php

namespace Larisso\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Larisso\Http\Controllers\Controller;
use Larisso\User;

class ActivationController extends Controller
{
	public function activate(Request $request)
	{
		$user = User::where('activation_token', '=', $request->token)->update([
			'email_activation'		=> '1',
			'activation_token'		=> ""
		]);

		if ($user) {
			$data = "SUKSES";
			$data1 = "Aktifasi Akun Berhasil !!!";
			return view('auth/verify-success', compact('data', 'data1'));
		} else {
			return abort(404);
		}

	}

	public function forget(Request $request)
	{
		$user = User::where('activation_token', '=', $request->token)->where('email', '=', $request->email)->firstOrFail();

		if ($user) {
			$token = $request->token;
			$email = $request->email;
			return view('auth/reset_password', compact('token', 'email'));
		} 
	}

	public function ganti(Request $request)
	{
		$user 	= User::where('activation_token', '=', $request->token)->where('email', '=', $request->email)->firstOrFail();
		$update = $user->update([
			'password' 			=> bcrypt($request->password),
			'activation_token'	=> ""
		]);

		if ($update) {
			$data = "SUKSES";
			$data1 = "Ganti Password Berhasil !!!";
			return view('auth/verify-success', compact('data', 'data1'));
		} 
	}
}
