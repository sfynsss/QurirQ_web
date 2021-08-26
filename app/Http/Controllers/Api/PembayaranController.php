<?php

namespace Larisso\Http\Controllers\Api;

use Illuminate\Http\Request;
use Larisso\Http\Controllers\Controller;

class PembayaranController extends Controller
{
	public function get_transaction_status_midtrans($order_id){

		// print_r($order_id);
		$this->initPaymentGateway();
		$data = str_replace('-', '/', $order_id);
        try {
            $get_transaction_status = \Midtrans\Transaction::status($data);
        } catch (\Exception $e) {
            return 'error';
        }

        return $get_transaction_status;
    }
    
}