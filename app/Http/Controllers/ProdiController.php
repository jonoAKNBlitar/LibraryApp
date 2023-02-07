<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Response;
class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //view awal prodi
        $prodi=DB::table('prodis')->get();
        return view('prodi.prodi',['prodi'=>$prodi]);
        
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
        //tambah data
        $message=['kode_prodi.unique'=>'Kode Prodi Sudah ada','nama_prodi.unique'=>'Nama Prodi Sudah Ada','singkatan.unique'=>'singkatan Prodi Sudah Ada'];
        if($request->ajax())
        {
            $validator = Validator::make($request->all(), [
                'kode_prodi' => 'required|unique:prodis',
                'nama_prodi' => 'required|unique:prodis',
                'singkatan' => 'required|unique:prodis',
            ],$message);
                   
            if($validator->passes()){
                        DB::table('prodis')->insert([
                            'kode_prodi' => $request->kode_prodi,
                            'nama_prodi' => $request->nama_prodi,
                            'singkatan' => $request->singkatan                  

                    ]);	
                        return response()->json(['success'=>'Added new records.']);
                    }else{                    
                        return response()->json(['error'=>$validator->errors()->all()],422);
                    }
        }
   
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
        //
        //if ($request->ajax()) {
        $prodi=DB::table('prodis')->where('kode_prodi',$id)->first();
       // $arrMhs=["JOko","Sari"];
        //return \view('prodi.prodi',['data'=>$prodi]);
        return response()->json(array('data'=>$prodi));
      
        //return response()->json(['data'=>$prodi]);
      //  }
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
        try{
        $ubah=DB::table('prodis')->where('kode_prodi',$request->kode_prodi)->update([
            'nama_prodi' => $request->nama_prodi,
            'singkatan' => $request->singkatan
            
        ]);
        return response()->json(array('data'=>$ubah),200);
    }catch(Exception $e){
        return response()->json($e->getMessage(), 500);
    }
    
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
        $hapus=DB::table('prodis')->where('kode_prodi',$id)->delete();
        return response()->json(array('data'=>$hapus),200);
    }
}