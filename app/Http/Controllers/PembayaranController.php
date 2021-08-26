<?php

namespace Larisso\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Larisso\MstJual;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use Larisso\User;
use Larisso\Customer;
use Larisso\Notif;
use Larisso\DetNotif;

class PembayaranController extends Controller
{
	public function __construct(Request $request)
	{
		$this->request = $request;
        // Set your Merchant Server Key
		\Midtrans\Config::$serverKey = 'Mid-server-xTaMzZDeY2QEujZxMmpTXxIW';
		//\Midtrans\Config::$serverKey = 'SB-Mid-server-fQhLQ_KX1fnc33JY51LS8Il0';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
		//\Midtrans\Config::$isProduction = false;
		\Midtrans\Config::$isProduction = true;
        // Set sanitization on (default)
		\Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
		\Midtrans\Config::$is3ds = true;
	}

	public function notification(Request $request)
	{
		// print_r("test")	;
		$paymentNotification = new \Midtrans\Notification();

		$transaction = $paymentNotification->transaction_status;
		$orderId = $paymentNotification->transaction_id;

		if ($transaction == 'settlement') {			
			$firebase_token = MstJual::join('users', 'mst_jual.id_user', '=', 'users.id')->where('transaction_id', '=', $orderId)->first();			
			$update = MstJual::where('transaction_id', '=', $orderId)->update([
				'sts_byr'	=> 1
			]);

			// print_r($firebase_token->firebase_token);
			if ($update) {
				$title = "Larisso Apps";
				$notif = "Pembayaran dengan no. Transaksi ".$firebase_token->no_ent." berhasil";
				$jenis_notif = 2;

				$save = Notif::insertGetId([
					"judul"			=> $title,
					"notif"			=> $notif,
					"jenis_notif"	=> $jenis_notif
				]);

				$save2 = DetNotif::insert([
					"kd_cust"	=> $firebase_token->kd_cust,
					"id_notif"	=> $save
				]);

				if ($save) {
					return "berhasil";
				} else {
					return "error send notif";
				}

				$optionBuilder = new OptionsBuilder();
				$optionBuilder->setTimeToLive(60*20);

				$notificationBuilder = new PayloadNotificationBuilder($title);
				$notificationBuilder->setBody($notif)
				->setSound('default')
				->setClickAction('act_home')
				->setBadge(1);

				$dataBuilder = new PayloadDataBuilder();
				$option = $optionBuilder->build();
				$notification = $notificationBuilder->build();
				$data = $dataBuilder->build();

				$downstreamResponse = FCM::sendTo($firebase_token->firebase_token, $option, $notification, $data);
				$downstreamResponse->numberSuccess();
				$downstreamResponse->numberFailure();
				$downstreamResponse->numberModification();
				$downstreamResponse->tokensToDelete();
				$downstreamResponse->tokensToModify();
				$downstreamResponse->tokensToRetry();
				$downstreamResponse->tokensWithError();
			} else {
				return 'error';
			}

			// $data = MstJual::where('transaction_id', '=', $orderId)->get();
			// dd($data);
		} else {
			return "not settlement";
		}
	}

	public function get_transaction_status($order_id){
		try {
			$get_transaction_status = \Midtrans\Transaction::status($order_id);
		} catch (\Exception $e) {
			return 'error';
		}

		return $get_transaction_status->transaction_status;
	}

	public function get_paid(){
		$data = MstJual::where('sts_byr', 0)->get();
		if(!empty($data)){
			foreach ($data as $value) {
				$return = $this->get_transaction_status($value->transaction_id);
				// dd($return);
				if ($return == "settlement") {
					$update = MstJual::where('no_ent', $value->no_ent)->update([
						'sts_byr'	=> 1
					]);
				} else if ($return == "failur") {
					$update = MstJual::where('no_ent', $value->no_ent)->update([
						'sts_byr'	=> 2
					]);
				} else if ($return == "expire") {
					$update = MstJual::where('no_ent', $value->no_ent)->update([
						'sts_byr'	=> 2
					]);
				}
			}
		}
	}
}