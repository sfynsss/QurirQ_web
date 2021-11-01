<?php

namespace QurirQ\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use QurirQ\Mail\SendMailable;
use Session;
use Redirect;
use QurirQ\Customer;
use QurirQ\Voucher;
use QurirQ\Barang;
use QurirQ\KategoriAndroid;
use QurirQ\MstJual;
use QurirQ\outlet;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

}
