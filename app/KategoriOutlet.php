<?php

namespace QurirQ;

use Illuminate\Database\Eloquent\Model;

class KategoriOutlet extends Model
{
	protected $table = "kategori_outlet";

	public $timestamps = false;

	public function KategoriAndroid(){
		return $this->hasMany(KategoriAndroid::class, 'kd_kat_android', 'id');
	}
}
