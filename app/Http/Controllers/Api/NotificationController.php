<?php

namespace QurirQ\Http\Controllers\Api;

use Illuminate\Http\Request;
use QurirQ\Http\Controllers\Controller;
use QurirQ\DetNotif;
use QurirQ\Customer;

class NotificationController extends Controller
{
    public function getNotif(Request $request)
    {
    	$cust = Customer::where('id', '=', $request->id)->first();

    	$data = DetNotif::join('notif', 'notif.id_notif', '=', 'det_notif.id_notif')->where('kd_cust', '=', $cust->KD_CUST)->get();
    	if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
    }
}
