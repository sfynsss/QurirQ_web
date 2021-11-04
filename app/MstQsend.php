<?php

namespace QurirQ;

use Illuminate\Database\Eloquent\Model;

class MstQsend extends Model
{
    protected $table = "mst_qsend";

	public $timestamps = false;

    public function qurir()
    {
        return $this->belongsTo('QurirQ\User', 'id_qurir', 'id');
    }
}
