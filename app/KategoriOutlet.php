<?php

namespace QurirQ;

use Illuminate\Database\Eloquent\Model;

class KategoriOutlet extends Model
{
	protected $table = "kategori_outlet";

	public $timestamps = false;

	public function Outlet(){
		return $this->hasMany('QurirQ\Outlet', 'id_kategori_outlet', 'id');
	}
}
