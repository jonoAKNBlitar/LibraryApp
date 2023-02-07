<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Pinjam;
use App\Models\DetilPinjam;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;


class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //       
        return view('pinjam.pinjam');
    }

    public function aksiAutoComplete(Request $request)
    {
        //
        $search=$request->search;
        if($search==''){
            $cari=DB::table('mahasiswas')->orderBy('nama', 'asc')->select('nama','nim')->limit(5)
            ->get();
        }else{
            $cari=DB::table('mahasiswas')->orderBy('nama', 'asc')->select('nama','nim')->where('nama','like','%'.$search.'%')->limit(5)->get();
        }

        $response = array();
        foreach($cari as $mhs){
            $response[] = array("value"=>$mhs->nim,"label"=>$mhs->nama);
        }
        
         return response()->json($response);
    }

    public function getDataBuku(Request $request){
        $search = $request->search;
      if($search == ''){
         $buku = Buku::orderby('judul','asc')->select('kode_buku','judul','jumlah')->limit(5)->get();
      }else{
         $buku = Buku::orderby('judul','asc')->select('kode_buku','judul','jumlah')->where('judul', 'like', '%' .$search . '%')->limit(5)->get();
      }

      $response = array();
      foreach($buku as $buku){
         $response[] = array("value"=>$buku->kode_buku,"label"=>$buku->judul,"jumlah"=>$buku->jumlah);
      }
      return response()->json($response);
   }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $pinjam=Pinjam::create($request->all());        
        $kode_buku = $request->input('kode_buku', []);
        $jml_pinjam = $request->input('jml_pinjam', []);
        $status = $request->input('status', []);
        $jumlah=$request->input('sisa', []);
        //dd($jml_pinjam);
        //count jumlah 
        for ($i=0; $i < count($kode_buku); $i++) {
            if ($kode_buku[$i] != '') {
                for($j=0; $j<jml_pinjam[$i];$j++){
                    $pinjam->detil()->attach($kode_buku[$i],['jml_pinjam' => 1,'status' =>1]);
                }              
                Buku::updateOrCreate(['kode_buku' => $kode_buku],['jumlah'=> $jumlah[$i]]);
            }
        }
    
        return \redirect('/peminjaman');

    }

    public function indexKembali()
    {
        //       
        return view('pinjam.kembali');
    }

   
    public function infopinjam(){
        $infobuku=Buku::get();
        //dd($infobuku);
		return view('pinjam.infopinjam', ['infobuku'=>$infobuku]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        //
        //$judul=DetilPinjam::with('tampil','balik_detil')->where('status',1)->get()
        $judul=DetilPinjam::with('tampil','balik_detil')->where('status',1)->whereRelation('balik_detil','nim',$nim)->get();
        //https://stackoverflow.com/questions/29989908/laravel-where-on-relationship-object
       
       
        //dd($judul);
        return response()->json($judul);
        
    }
    public function showKembali(Request $request){
        
            $urutan=$request->input('row',[]);
            $checked=$request->input('cekbox',[]);       
            $id=$request->input('id',[]);
            $kode_buku=$request->input('kode_buku',[]);
            $jml_pinjam=$request->input('jml_pinjam',[]);
        
       
        //dd($request);
        // urutan semua yang dikriim 0 dan 1
        //checked yang dicek saja saja index 0 dan 1
        for ($j=0; $j < count($id); $j++) {
        for ($i=0; $i < count($checked); $i++) {
            if($checked[$i]==$id[$j]){    
            DetilPinjam::updateOrCreate(['id' => $checked[$i]],['status' => '2' ]);
            $jumlahstokawal=Buku::find($kode_buku[$j])->jumlah;           
            Buku::updateOrCreate(['kode_buku'=>$kode_buku[$j]],['jumlah'=>$jml_pinjam[$j]+$jumlahstokawal]);           
            }    
        }
    }
        return \redirect('/kembali');
    }
    public function lihatmhs($nim){
        $mhs = Mahasiswa::with('prodi')->where('nim',$nim)->get();
        //$prodi=$mhs->prodi; 
       // dd($mhs);      
        return response()->json($mhs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}