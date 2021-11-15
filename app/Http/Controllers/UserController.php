<?php

namespace QurirQ\Http\Controllers;

use Illuminate\Http\Request;
use QurirQ\User;
use QurirQ\Outlet;
use Session;
use Redirect;

class UserController extends Controller
{
	public function index($id)
	{
		if ($id == "admin") {
			$data = User::where('otoritas', '=', 'ADMIN')->get();	
		} else if ($id == "driver") {
			$data = User::where('otoritas', '=', 'DRIVER')->get();	
		} else if ($id == "resto") {
			$data = User::where('otoritas', '=', 'RESTO')->get();	
		}

		$status = $id;
		if($id == 'resto') {
			$outlet = Outlet::all();
			return view('User.user', compact('data', 'status', 'outlet'));
		} else {
			return view('User.user', compact('data', 'status'));
		}
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
		} else if ($id == "driver") {
			$insert = User::insert([
				'name' => $request->name,
				'tanggal_lahir' => $request->tgl_lahir,
				'email' => $request->email,
				'alamat' => $request->alamat,
				'no_telp' => $request->no_telp,
				'password' => bcrypt($request->password),
				'api_token' => bin2hex(openssl_random_pseudo_bytes(30)),
				'email_activation' => '1', 
				'otoritas'	=> 'DRIVER',
				'kd_peg'	=> $request->kd_peg,
				'nopol'		=> $request->nopol
			]);	
		} else if ($id == "resto") {
			$insert = User::insert([
				'name' => $request->name,
				'tanggal_lahir' => $request->tgl_lahir,
				'email' => $request->email,
				'alamat' => $request->alamat,
				'no_telp' => $request->no_telp,
				'password' => bcrypt($request->password),
				'api_token' => bin2hex(openssl_random_pseudo_bytes(30)),
				'email_activation' => '1', 
				'otoritas'	=> 'RESTO',
				'id_outlet'	=> $request->id_outlet,
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
		if (isset($request->password)) {
			if(isset($request->id_outlet)) {
				$update = User::where('id', '=', $request->id_user)->update([
					'name'		=> $request->name,
					'email'		=> $request->email,
					'no_telp'	=> $request->no_telp,
					'id_outlet'	=> $request->id_outlet,
					'password'	=> bcrypt($request->password)
				]);	
			} else if(isset($request->nopol)) {
				$update = User::where('id', '=', $request->id_user)->update([
					'name'		=> $request->name,
					'email'		=> $request->email,
					'no_telp'	=> $request->no_telp,
					'nopol'		=> $request->nopol,
					'password'	=> bcrypt($request->password)
				]);	
			} else {
				$update = User::where('id', '=', $request->id_user)->update([
					'name'		=> $request->name,
					'email'		=> $request->email,
					'no_telp'	=> $request->no_telp,
					'password'	=> bcrypt($request->password)
				]);	
			}
		} else {
			if(isset($request->id_outlet)) {
				$update = User::where('id', '=', $request->id_user)->update([
					'name'		=> $request->name,
					'email'		=> $request->email,
					'id_outlet'	=> $request->id_outlet,
					'no_telp'	=> $request->no_telp
				]);	
			} else if(isset($request->nopol)) {
				$update = User::where('id', '=', $request->id_user)->update([
					'name'		=> $request->name,
					'email'		=> $request->email,
					'nopol'		=> $request->nopol,
					'no_telp'	=> $request->no_telp
				]);	
			} else {
				$update = User::where('id', '=', $request->id_user)->update([
					'name'		=> $request->name,
					'email'		=> $request->email,
					'no_telp'	=> $request->no_telp
				]);	
			}
		}
		
		if ($update) {
			Session::flash('success', "Data Berhasil Diubah !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Diubah !!!");
			return Redirect::back();
		}
	}

	public function getKurir()
	{
		$data = User::where('otoritas', '=', 'DRIVER')->where('sts_online', '=', '1')->get();

    	return json_encode($data);
	}

}
