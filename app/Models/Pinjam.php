<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;
use App\Models\DetilPinjam;
use App\Models\Mahasiswa;

class Pinjam extends Model
{
    use HasFactory;
    protected $table='pinjams';
    protected $fillable =['tanggal_pinjam','tanggal_kembali','nim','pegawai_id'];
    public function detil()
    {
        return $this->belongsToMany(Buku::class,'detil_pinjams','pinjam_id','kode_buku')->withPivot('jml_pinjam','status')->withTimestamps();
    }
    /*public function detil_pinjam(){
        return $this->belongsToMany(DetilPinjam::class);
    }
    function mhs_pinjam(){
        return $this->belongsTo(Mahasiswa::class,'nim','nim');
    }*/
    function buku_detil(){
        return $this->hasMany(DetilPinjam::class,'pinjam_id','pinjam_id');
    }
    


}
