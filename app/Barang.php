<?php

namespace QurirQ;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = "barang";
    
    public $timestamps = false;

    protected $fillable = ['kd_brg','kd_kat_android'];

    function kategori(){
    	return $this->belongsTo('QurirQ\KategoriBarang', 'id_kategori_barang', 'id');
    }

    public function outlet()
    {
        return $this->belongsTo('QurirQ\Outlet', 'id_outlet', 'id');
    }
}
