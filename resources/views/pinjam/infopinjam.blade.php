@extends('layout.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
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
                                <th>Kode Buku</th>
                                <th>Judul</th>
                                <th>Peminjam</th>
                                <th>Jumlah Buku Keluar</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Kode Buku</th>
                                <th>Judul</th>
                                <th>Peminjam</th>
                                <th>Jumlah Buku Keluar</th>
                                <th>Stok</th>
                            </tr>
                        </tfoot>
                        <tbody>
                                @php
                                 $no=1;   
                                @endphp
                            @foreach ($infobuku as $p)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $p->kode_buku }}</td>
                                    <td>{{ $p->judul }}</td>
                                   
                                    <td>
                                        <ul>                                            
                                            @foreach($p->info_pinjam()->where('status',1)->get() as $h)                                                                                    
                                            <li>{{$h->nim}}<a onclick="javascript:void(0)" data-id="{{ $h->nim }}"
                                                class="btn btn-success btn-sm editCustomer">
                                                <span class="icon text-white-50"><i class="fas fa-check"></i></span>
                                                <span class="text">Lihat</span></a>   </li>
                                                                    
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{$p->info_pinjam()->where('status',1)->get()->count()}}</td>
                                    <td>{{ $p->jumlah }}</td>
                                    
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!---ini adalah untuk form modal-->

        <div class="modal fade" id="addTodoModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Lihat Mahasiswa</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                                    <input type="text" class="form-control form-control-user" id="nim"
                                        name="nim" placeholder="Kode prodi">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="nama"
                                        name="nama" placeholder="nama">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="prodi_id"
                                        name="prodi_id" placeholder="singkatan">
                                </div>
                                <span id="taskError" class="alert-message"></span>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        
                        <button type="button" class="btn btn-google btn-user btn-block"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @push('page-script')
        <script type="text/javascript">
        $('body').on('click', '.editCustomer', function() {
            var nim = $(this).data('id');
            console.log(nim);
           
            $.ajax({
                url: "/lihatmhs/" + nim,
                type: "GET",
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    
                    $('#addTodoModal').modal('show');
                    $('.modal-title').html('Edit Prodi');
                    let modifiedArr = data.map(function(element) {
                        $('#nim').val(element.nim);
                        $('#nama').val(element.nama);                        
                        $('#prodi_id').val(element.prodi.nama_prodi);
                    });
                }
            });
        });
        </script>
        @endpush
@endsection