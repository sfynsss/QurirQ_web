<?php

namespace Larisso;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = "barang";
    
    public $timestamps = false;

    protected $fillable = ['kd_brg','kd_kat_android'];

    function kategori(){
    	return $this->belongsTo('Larisso\KategoriAndroid');
    }
}
