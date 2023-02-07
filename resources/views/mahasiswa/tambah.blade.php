@extends('layout.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    
    
    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <a class="btn btn-primary btn-sm" href="/mahasiswa/tambah/form">Tambah Mahasiswa Baru</a>
    
                </div>
            </div>
        </div>
        
        

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Earnings (Annual)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        
    </div>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nim</th>
                                <th>Nama</th>
                                <th>Prodi</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Tahun Masuk</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nim</th>
                                <th>Nama</th>
                                <th>Prodi</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Tahun Masuk</th>
                                <th>Opsi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                                @php
                                 $no=1;   
                                @endphp
                            @foreach ($postingan as $p)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $p->nim }}</td>
                                    <td>{{ $p->nama }}</td>
                                    <td>{{ $p->nama_prodi }}</td>
                                    <td>{{ $p->tempat_lahir }}</td>
                                    <td>{{ $p->tgl_lahir }}</td>
                                    <td>{{ $p->th_masuk }}</td>
                                    <td>
                                        <a href="/mahasiswa/edit/{{ $p->nim }}" class="btn btn-success btn-sm">
                                            <span class="icon text-white-50"><i class="fas fa-check"></i></span>
                                            <span class="text">Edit</span></a>

                                        <a href="/mahasiswa/hapus/{{ $p->nim }}"  class="btn btn-warning btn-sm">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </span>
                                            <span class="text">Hapus</span>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection