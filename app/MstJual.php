<?php

namespace QurirQ;

use Illuminate\Database\Eloquent\Model;

class MstJual extends Model
{
    protected $table = "mst_jual";

	public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('QurirQ\User', 'id_user', 'id');
    }

    public function qurir()
    {
        return $this->belongsTo('QurirQ\User', 'id_qurir', 'id');
    }
}
