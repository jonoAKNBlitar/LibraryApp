<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;
    protected $table='prodis';
    public function post(){
        return $this->hasMany(Mahasiswa::class,'prodi_id','kode_prodi');
        //                                      primary_key (tbl_prodi), fk (tbl_mahasiswa)
    }
}
