<?php

namespace Larisso;

use Illuminate\Database\Eloquent\Model;

class KategoriOutlet extends Model
{
	protected $table = "kat_outlet";

	public $timestamps = false;

	protected $guarded = [];

	public $timestamps = false;

	public function KategoriAndroid(){
		return $this->hasMany(KategoriAndroid::class, 'kd_kat_android', 'id');
	}
}
