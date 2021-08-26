<?php

namespace Larisso;

use Illuminate\Database\Eloquent\Model;

class KategoriAndroid extends Model
{
	protected $table = "kat_android";

	public $timestamps = false;
	
	protected $fillable = ['kd_kat_android', 'nm_kat_android', 'kd_outlet'];


	public function KategoriOutlet()
	{
		return $this->belongsTo(KategoriOutlet::class, 'kd_kat_android', 'id');
	}
}

