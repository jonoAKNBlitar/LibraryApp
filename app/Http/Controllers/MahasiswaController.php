<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Buku;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $hitung=Buku::count();
         $hitungMHS=DB::table('mahasiswas')->count();
         $hitungStockBuku=DB::table('bukus')->sum('jumlah');
        return view('index',['hitungbuku'=>$hitung, 'hitungMHS'=>$hitungMHS,'hitungStockBuku'=>$hitungStockBuku]);      
    }
    /*public function muncul_prodi(){
        $prodi=DB::table('prodis')->get();
        return view('mahasiswa.edit_form',['prodi'=>$prodi]);
    }/*

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        //   akan mengakses table mahasiswas dan menuju ke view mahasiswa/tambah   
        $post=DB::table('mahasiswas')
        ->join('prodis','mahasiswas.prodi_id','=','prodis.kode_prodi')                            
        ->get();
        return view('mahasiswa.tambah',['postingan'=>$post]);
 
    }

    public function tambah_mhs(){
        $prodi=DB::table('prodis')->get();           
       
        return view('mahasiswa.tambah_form',['prodi'=>$prodi]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi request, khusus untuk unique ditambah nama tabel
        $this->validate($request,[
            'nim'=>'required|unique:mahasiswas|integer',  // 'nama_input dari view'=>'required|unique:mahasiswas(sebagai nama tabel)'
            'nama'=>'required',
            'tempat_lahir'=>'required',
            'tgl_lahir'=>'required|date',
            'th_masuk'=>'required|integer',
        ]);
                // insert data ke table mahasiswas
	    DB::table('mahasiswas')->insert([
                    'nim' => $request->nim,
                    'nama' => $request->nama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'prodi_id' => $request->prodi_id,
                    'th_masuk' => $request->th_masuk                  

        ]);
	        // alihkan halaman ke halaman mahasiswa
	        return redirect('/mahasiswa/tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    
    {
        $prodi=DB::table('prodis')->get();       
        //ini untuk edit
        $mhs=DB::table('mahasiswas')->where('nim',$id)->get();
        return view('mahasiswa.edit_form',['mahasiswa'=>$mhs,'prodi'=>$prodi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //untuk update
        DB::table('mahasiswas')->where('nim',$id)->update([
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'prodi_id' => $request->prodi_id,
            'th_masuk' => $request->th_masuk  
        ]);
        return \redirect('/mahasiswa/tambah');
    }
    


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //hapus
        DB::table('mahasiswas')->where('nim',$id)->delete();
        return redirect('/mahasiswa/tambah');
    }
}

