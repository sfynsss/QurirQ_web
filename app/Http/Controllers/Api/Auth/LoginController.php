<?php

namespace Larisso\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Larisso\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Larisso\User;

class LoginController extends Controller
{
	public function updateToken(Request $request)
	{
		$data = User::where('id', '=', $request->user_id)->update([
			'firebase_token' => $request->firebase_token
		]);

		if ($data) {
			return response()->json(['message' => 'Update Token Berhasil'], 200);
		} else {
			return response()->json(['message' => 'Update Token Gagal'], 401);
		}	
	}

	public function login(Request $request)
	{
		if (Auth::attempt(['email' => $request->email, 'password' => $request->password]) or Auth::attempt(['no_telp' => $request->email, 'password' => $request->password])) {
			$data = User::where('id', '=', Auth::user()->id)->update([
				'api_token' => bin2hex(openssl_random_pseudo_bytes(30))
			]);
			if ($data) {
				$user = User::leftjoin('alamat', 'users.id', '=', 'alamat.id_user')->leftjoin('customer', 'users.id', '=', 'customer.id')->where('users.id', '=', Auth::user()->id)->first();
				return response()->json(['user'	=> $user], 200);
			}
		} else {
			return response()->json(['error' => 'Unauthorised'], 401);
		}
	}

	public function loginSales(Request $request)
	{
		if (Auth::attempt(['email' => $request->email, 'password' => $request->password]) or Auth::attempt(['no_telp' => $request->email, 'password' => $request->password])) {
			$data = User::where('id', '=', Auth::user()->id)->update([
				'api_token' => bin2hex(openssl_random_pseudo_bytes(30))
			]);
			if ($data) {
				$user = User::where('users.id', '=', Auth::user()->id)->first();
				return response()->json(['user'	=> $user], 200);
			}
		} else {
			return response()->json(['error' => 'Unauthorised'], 401);
		}
	}
}
