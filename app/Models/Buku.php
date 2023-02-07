<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetilPinjam;


class Buku extends Model
{
    use HasFactory;
    protected $table='bukus'; 
    protected $primaryKey='kode_buku';
    protected $fillable = ['kode_buku', 'judul', 'tahun_terbit', 'pengarang_id', 'jumlah', 'tahun_terbit', 'pengarang_id', 'penerbit_id', 'rak_kode_rak'];

  

    public function info_pinjam(){
        return $this->belongsToMany(Pinjam::class,'detil_pinjams','kode_buku','pinjam_id');
        // detil_pinjams=> tabel, kode_buku=>foreign_key ke buku , pinjam id=>foregin key ke pinjam id
    }
    

}