<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pinjam;
use App\Models\Buku;


class DetilPinjam extends Model
{
    use HasFactory;
    protected $table='detil_pinjams';
    protected $guarded=['id','created_at','upadated_at'];
    
    public function balik_detil(){
        return $this->belongsTo(Pinjam::class,'pinjam_id','id');
    }

    public function tampil(){
        return $this->belongsTo(Buku::class,'kode_buku','kode_buku');
    }
    //public function tampil_mhs()
    //{
      //  return $this->belongsToMany(Mahasiswa::class,'pinjams','nim','nim');
   // }
}
