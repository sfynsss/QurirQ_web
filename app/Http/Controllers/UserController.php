<?php

namespace Larisso\Http\Controllers;

use Illuminate\Http\Request;
use Larisso\User;
use Larisso\Outlet;
use Session;
use Redirect;

class UserController extends Controller
{
	public function index($id, $kd_outlet)
	{
		if ($id == "admin") {
			if ($kd_outlet == "all") {
				$data = User::join('outlet', 'outlet.kd_outlet', '=', 'users.kd_outlet')->where('otoritas', '=', 'ADMIN')->get();	
			} else {
				$data = User::join('outlet', 'outlet.kd_outlet', '=', 'users.kd_outlet')->where('users.kd_outlet', '=', $kd_outlet)->where('otoritas', '=', 'ADMIN')->get();	
			}
		} else if ($id == "sales") {
			$data = User::where('otoritas', '=', 'SALES')->get();	
		}

		$outlet = Outlet::all();
		$status = $id;
		return view('User.user', compact('data', 'status', 'outlet'));
	}

	public function tambahUser($id, Request $request)
	{
		if ($id == "admin") {
			$insert = User::insert([
				'name' => $request->name,
				'tanggal_lahir' => $request->tgl_lahir,
				'email' => $request->email,
				'alamat' => $request->alamat,
				'no_telp' => $request->no_telp,
				'password' => bcrypt($request->password),
				'api_token' => bin2hex(openssl_random_pseudo_bytes(30)),
				'email_activation' => '1', 
				'otoritas'	=> 'ADMIN',
				'kd_outlet' => $request->kd_outlet
			]);
		} else if ($id == "sales") {
			$insert = User::insert([
				'name' => $request->name,
				'tanggal_lahir' => $request->tgl_lahir,
				'email' => $request->email,
				'alamat' => $request->alamat,
				'no_telp' => $request->no_telp,
				'password' => bcrypt($request->password),
				'api_token' => bin2hex(openssl_random_pseudo_bytes(30)),
				'email_activation' => '1', 
				'otoritas'	=> 'SALES',
				'kd_peg'	=> $request->kd_peg
			]);	
		}

		if ($insert) {
			Session::flash('success', "Data Berhasil Ditambahkan !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Ditambahkan !!!");
			return Redirect::back();
		}
	}

	public function editUser($id)
	{
		$outlet = Outlet::all();
		$user = User::where('id', '=', $id)->first();

		return view('User.edit', compact('outlet', 'user'));
	}

	public function updateUser(Request $request)
	{
		$update = User::where('id', '=', $request->id_user)->update([
			'kd_outlet'	=> $request->kd_outlet,
			'name'		=> $request->name,
			'email'		=> $request->email,
			'no_telp'	=> $request->no_telp,
			'password'	=> bcrypt($request->password)
		]);
		
		if ($update) {
			Session::flash('success', "Data Berhasil Diubah !!!");
			return redirect('user/admin/all');
		} else {
			Session::flash('error', "Data Gagal Diubah !!!");
			return redirect('user/admin/all');
		}
	}
}
