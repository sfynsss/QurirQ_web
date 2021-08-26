<?php

namespace Larisso\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	protected function initPaymentGateway()
	{
    	// Set your Merchant Server Key
		//\Midtrans\Config::$serverKey = 'Mid-server-xTaMzZDeY2QEujZxMmpTXxIW';
		\Midtrans\Config::$serverKey = 'SB-Mid-client-5ybRjah4KcDwTK_c';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
		\Midtrans\Config::$isProduction = false;
		//\Midtrans\Config::$isProduction = true;
// Set sanitization on (default)
		\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
		\Midtrans\Config::$is3ds = true;
	}
}
