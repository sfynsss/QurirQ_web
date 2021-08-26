<?php

namespace Larisso\Http\Controllers;

use Illuminate\Http\Request;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use Larisso\User;
use Larisso\Customer;
use Larisso\Notif;
use Larisso\DetNotif;
use Session;
use Redirect;
use store;
use Larisso\Voucher;
use Larisso\TukarVoucher;

class NotificationController extends Controller
{
	public function index()
	{
		$user = User::join('customer', 'customer.id', '=', 'users.id')->where('firebase_token', '!=', "")->get();
		$data = Notif::all();
		return view('Notification.notif', compact('user', 'data'));
	}

	public function notifGlobal(Request $request)
	{
		// print_r($request->title." | ".$request->notif." | ".$request->gambar);

		$save = Notif::insertGetId([
			"judul"			=> $request->title,
			"notif"			=> $request->notif,
			"jenis_notif"	=> $request->jenis_notif
		]);

		if ($save != 0) {
			if ($request->user[0] == "semua") {
				$user = User::join('customer', 'customer.id', '=', 'users.id')->where('firebase_token', '!=', "")->get();
				foreach ($user as $data) {
					$save2 = DetNotif::insert([
						"kd_cust"	=> $data->KD_CUST,
						"id_notif"	=> $save
					]);

					$token[] = Customer::select('users.firebase_token')->join('users', 'users.id', '=', 'customer.id')->where('kd_cust', '=', $data->KD_CUST)->pluck('users.firebase_token');
				}
			} else {
				for ($i=0; $i < count($request->user); $i++) { 
					$save2 = DetNotif::insert([
						"kd_cust"	=> $request->user[$i],
						"id_notif"	=> $save
					]);

					$token[] = Customer::select('users.firebase_token')->join('users', 'users.id', '=', 'customer.id')->where('kd_cust', '=', $request->user[$i])->pluck('users.firebase_token');
				}
			}

			if ($save2) {
				for ($i=0; $i < count($token); $i++) { 
					$tk[] = $token[$i][0];
				}

				$optionBuilder = new OptionsBuilder();
				$optionBuilder->setTimeToLive(60*20);

				$notificationBuilder = new PayloadNotificationBuilder($request->title);
				$notificationBuilder->setBody($request->notif)
				->setSound('default')
				->setClickAction('act_home')
				->setBadge(1);

				$dataBuilder = new PayloadDataBuilder();
				$option = $optionBuilder->build();
				$notification = $notificationBuilder->build();
				$data = $dataBuilder->build();

				$downstreamResponse = FCM::sendTo($tk, $option, $notification, $data);
				$downstreamResponse->numberSuccess();
				$downstreamResponse->numberFailure();
				$downstreamResponse->numberModification();
				$downstreamResponse->tokensToDelete();
				$downstreamResponse->tokensToModify();
				$downstreamResponse->tokensToRetry();
				$downstreamResponse->tokensWithError();

				Session::flash('success', "Notifikasi Berhasil Dikirim");
				return Redirect::back();	
			} else {
				Session::flash('error', "Notifikasi Gagal Dikirim");
				return Redirect::back();		
			}
		} else {
			Session::flash('error', "Notifikasi Gagal Dikirim");
			return Redirect::back();	
		}

		
	}

	public function toMultiDevice()
	{
		$token = Voucher::select('users.firebase_token')->join('customer', 'customer.kd_cust', '=', 'voucher.kd_cust')->join('users', 'users.id', '=', 'customer.id')->where('jenis_voucher', '=', 'ELEKTRONIK')->where('status_voucher', '=', 'AKTIF')->groupBy('voucher.kd_cust', 'users.firebase_token')->pluck('users.firebase_token')->toArray();
		// $token = "fM5XZlYoC9U:APA91bGQu-Og3B-i6s88nngxu6lDqbx_3yJmsMR_GjZquuEC45_dN7dHG59xa9At6iUP0BRtogDszR0DpMfAFvopcNYmkwndJOp2mFGaY03z5d9PJHmA1ONYJgWyD8KHjhUV2tkFvK0I";

		$optionBuilder = new OptionsBuilder();
		$optionBuilder->setTimeToLive(60*20);

		$notificationBuilder = new PayloadNotificationBuilder("Voucher Belanja");
		$notificationBuilder->setBody("Selamat Anda Mendapatkan Voucher Belanja, Cek Sekarang Juga !!!")
		->setSound('default')
		->setClickAction('act_home')
		->setBadge(1);

		$dataBuilder = new PayloadDataBuilder();
		$option = $optionBuilder->build();
		$notification = $notificationBuilder->build();
		$data = $dataBuilder->build();

		$downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
		$downstreamResponse->numberSuccess();
		$downstreamResponse->numberFailure();
		$downstreamResponse->numberModification();
		$downstreamResponse->tokensToDelete();
		$downstreamResponse->tokensToModify();
		$downstreamResponse->tokensToRetry();
		$downstreamResponse->tokensWithError();

		Session::flash('success', "Notifikasi Berhasil Dikirim");
		return Redirect::back();
	}
}
