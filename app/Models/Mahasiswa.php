<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pinjam;
use App\Models\DetilPinjam;

class Mahasiswa extends Model
{
    use HasFactory;
    
    protected $primaryKey='nim';
    protected $guarded=['id','created_at','updated_at'];

    public function prodi(){
        
        return $this->belongsTo(Prodi::class,'prodi_id','kode_prodi');
        // tabel tujuan(prodi), foreign keynya di tabel mahasiswa, dan kode_prodi sebagai primary key ditabel prodi 
    }
}
