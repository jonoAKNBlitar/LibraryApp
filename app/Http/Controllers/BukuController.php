<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Buku;
use Validator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $buku=Buku::all();
		return view('buku.buku', ['post'=>$buku]);
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
        //
        $message=['kode_buku.unique'=>'Kode buku sudah ada','judul.required'=>'Judul tidak boleh kosong'];
        if($request->ajax()) {
            $validator=Validator($request->all(),['kode_buku'=>'unique:bukus','judul'=>'required'],$message);       
        if ($validator->fails()){
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            
        }else{
        $buku=new Buku;
        $buku->kode_buku=$request->kode_buku;
        $buku->judul=$request->judul;
        $buku->tahun_terbit=$request->tahun_terbit;
        $buku->jumlah=$request->jumlah;
        $buku->pengarang_id=$request->pengarang_id;
        $buku->penerbit_id=$request->penerbit_id;
        $buku->rak_kode_rak=$request->rak_kode_rak;
        $buku->save();

        //return response()->json('success');
        return response()->json(['success' => true, 'message' => 'success'], 200);
        }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kode_buku)
    {
        //
        $buku = Buku::find($kode_buku);       
        return response()->json($buku);
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
    public function update(Request $request)
    {
        //
        Buku::updateOrCreate(['kode_buku' => $request->kode_buku],
        ['judul' => $request->judul, 'tahun_terbit'=> $request->tahun_terbit,'jumlah'=> $request->jumlah,'pengarang_id'=>$request->pengarang_id,'penerbit_id'=>$request->penerbit_id,'rak_kode_rak'=>$request->rak_kode_rak]); 
        
        return response()->json(['success' => true, 'message' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode_buku)
    {
        //
        $data = Buku::findOrFail($kode_buku);
        $data->delete();
    }
}