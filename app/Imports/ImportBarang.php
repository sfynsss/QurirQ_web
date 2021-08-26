<?php

namespace Larisso\Imports;

use Larisso\Barang;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportBarang implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
      $disc;
      $disc_rp;

      foreach ($collection as $i => $value) {
        if ($i > 0) {

          if ($value[23] == "") {
            $disc = 0;
            $disc_rp = 0;
          } else {
            $disc = $value[23];
            $disc_rp = $value[24];
          }

          if ($value[0] != '') {
            $cek = Barang::where('kd_brg', '=', $value[0])->get();
            if ($cek) {
              $insert = Barang::where('kd_brg', '=', $value[0])->update([
                'kd_kat_android'    => $value[1],      
                'jns_brg'           => $value[2],
                'nm_brg'            => $value[3],
                'stok'              => $value[4],
                'satuan1'           => $value[5],
                'satuan2'           => $value[6]."",
                'satuan3'           => $value[7]."",
                'satuan4'           => $value[8]."",
                'sat_tur2'          => $value[9]."",  
                'sat_tur3'          => $value[10]."",  
                'sat_tur4'          => $value[11]."",  
                'kapasitas2'        => $value[12],    
                'kapasitas3'        => $value[13],    
                'kapasitas4'        => $value[14],    
                'harga_bl'          => $value[15],  
                'harga_jl'          => $value[16],  
                'harga_jl2'         => $value[17],  
                'harga_jl3'         => $value[18],  
                'harga_jl4'         => $value[19],  
                'qty_min2'          => $value[20],  
                'qty_min3'          => $value[21],  
                'qty_min4'          => $value[22],  
                'disc'              => $disc,
                'harga_disc'        => $disc_rp,
                'sts_tampil'        => $value[25],    
                'sts_promo'         => $value[26],    
                'sts_poin'          => $value[27],  
                'kd_outlet'         => $value[28]
              ]);
            } else {
              $insert = Barang::insert([
                'kd_brg'            => $value[0],
                'kd_kat_android'    => $value[1],      
                'jns_brg'           => $value[2],
                'nm_brg'            => $value[3],
                'stok'              => $value[4],
                'satuan1'           => $value[5],
                'satuan2'           => $value[6]."",
                'satuan3'           => $value[7]."",
                'satuan4'           => $value[8]."",
                'sat_tur2'          => $value[9]."",  
                'sat_tur3'          => $value[10]."",  
                'sat_tur4'          => $value[11]."", 
                'kapasitas2'        => $value[12],    
                'kapasitas3'        => $value[13],    
                'kapasitas4'        => $value[14],    
                'harga_bl'          => $value[15],  
                'harga_jl'          => $value[16],  
                'harga_jl2'         => $value[17],  
                'harga_jl3'         => $value[18],  
                'harga_jl4'         => $value[19],  
                'qty_min2'          => $value[20],  
                'qty_min3'          => $value[21],  
                'qty_min4'          => $value[22],  
                'disc'              => $disc,
                'harga_disc'        => $disc_rp,
                'sts_tampil'        => $value[25],    
                'sts_promo'         => $value[26],    
                'sts_poin'          => $value[27],  
                'kd_outlet'         => $value[28]
              ]);
            }
          } else {
            $data = Barang::select('kd_brg')->whereRaw('length(kd_brg) = ?', [10])->orderBy('kd_brg', 'desc')->get();
            $kd_brg = substr($data[0]->kd_brg, 2)+1;
            $insert = Barang::insert([
              'kd_brg'            => '01'.sprintf('%08d', $kd_brg).'',
              'kd_kat_android'    => $value[1],      
              'jns_brg'           => $value[2],
              'nm_brg'            => $value[3],
              'stok'              => $value[4],
              'satuan1'           => $value[5],
              'satuan2'           => $value[6]."",
              'satuan3'           => $value[7]."",
              'satuan4'           => $value[8]."",
              'sat_tur2'          => $value[9]."",  
              'sat_tur3'          => $value[10]."",  
              'sat_tur4'          => $value[11]."", 
              'kapasitas2'        => $value[12],    
              'kapasitas3'        => $value[13],    
              'kapasitas4'        => $value[14],    
              'harga_bl'          => $value[15],  
              'harga_jl'          => $value[16],  
              'harga_jl2'         => $value[17],  
              'harga_jl3'         => $value[18],  
              'harga_jl4'         => $value[19],  
              'qty_min2'          => $value[20],  
              'qty_min3'          => $value[21],  
              'qty_min4'          => $value[22],  
              'disc'              => $disc,
              'harga_disc'        => $disc_rp,
              'sts_tampil'        => $value[25],    
              'sts_promo'         => $value[26],    
              'sts_poin'          => $value[27],  
              'kd_outlet'         => $value[28]
            ]);
          }
        }
      }
      if ($insert) {
        return true;
      } else {
        return false;
      }
    }
  }
