@extends('layout.app')
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Edit Mahasiswa</h1>
                </div>
                @foreach($mahasiswa as $s)
                <form class="user" action="/mahasiswa/update/{{ $s->nim }}">
                    <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nim" name="nim"
                            placeholder="Nim" value="{{$s->nim}}"> 
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nama" name="nama"
                            placeholder="Nama" value="{{$s->nama}}">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="tempat_lahir" name="tempat_lahir"
                            placeholder="tempat_lahir" value="{{$s->tempat_lahir}}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="tgl_lahir" name="tgl_lahir"
                            placeholder="YYYY/MM/DD" value="{{$s->tgl_lahir}}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="prodi_id" name="prodi_id"
                            placeholder="Id Prodi" value="{{$s->prodi_id}}">
                    </div>
                    <div class="form-group">
                        <label for="position-option">Program Studi</label>
                        <select class="form-control" id="prodi_id" name="prodi_id" >         
                           
                           <option value="{{$s->prodi_id}}" selected="selected">{{$s->prodi_id}}</option>
                           @foreach($prodi as $p)
                            <option value="{{ $p->kode_prodi }}">{{ $p->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="th_masuk" name="th_masuk"
                            placeholder="Semester" value="{{$s->th_masuk}}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block" >Update</button>
                    <hr>
                    <a href="/mahasiswa/tambah" class="btn btn-facebook btn-user btn-block">
                        <i class="fab fa-facebook-f fa-fw"></i> Kembali
                    </a>
                </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection


