<?php

namespace QurirQ\Http\Controllers;

use Illuminate\Http\Request;
use QurirQ\MstQsend;
use QurirQ\DetQsend;

class QsendController extends Controller
{
    public function qsend()
    {
        $data = MstQsend::orderBy('tgl', 'desc')->get();
        // dd($data);
        return view('qsend.index', compact('data'));
    }

    public function detQsend($id)
    {
        $data = DetQsend::where('id_mst', '=', $id)->get();
        
        return json_encode($data);
    }
}
