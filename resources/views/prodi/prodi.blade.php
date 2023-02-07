@extends('layout.app')


<!---------------------------------->
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" id="muncul_modal">
                        Tambah Prodi
                    </button>

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
                                    <th>Nim</th>
                                    <th>Nama</th>
                                    <th>Prodi</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Kode prodi</th>
                                    <th>Nama Prodi</th>
                                    <th>Singkatan</th>

                                    <th>Opsi</th>
                                </tr>
                            </tfoot>
                            <tbody>

                                @foreach ($prodi as $p)
                                    <tr>
                                        <td>{{ $p->kode_prodi }}</td>
                                        <td>{{ $p->nama_prodi }}</td>
                                        <td>{{ $p->singkatan }}</td>

                                        <td>
                                            <a onclick="javascript:void(0)" data-id="{{ $p->kode_prodi }}"
                                                class="btn btn-success btn-sm editCustomer">
                                                <span class="icon text-white-50"><i class="fas fa-check"></i></span>
                                                <span class="text">Edit</span></a>

                                            <a onclick="javascript:void(0)" data-id="{{ $p->kode_prodi }}"
                                                class="btn btn-warning btn-sm deleteCustomer">
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
            <!---ini adalah untuk form modal-->

            <div class="modal fade" id="addTodoModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Prodi</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">

                                <input type="hidden" name="ver" id="ver" value="0">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                                        <input type="text" class="form-control form-control-user" id="kode_prodi"
                                            name="kode_prodi" placeholder="Kode prodi">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="nama_prodi"
                                            name="nama_prodi" placeholder="nama_prodi">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="singkatan"
                                            name="singkatan" placeholder="singkatan">
                                    </div>
                                    <span id="taskError" class="alert-message"></span>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-primary btn-user btn-block" id="tambah_prodi"
                                type="submit">Save</button>
                            <button type="button" class="btn btn-google btn-user btn-block"
                                data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            @push('page-script')
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#muncul_modal').click(function() {
                            alert("hallo");
                            $('#addTodoModal').modal('show');
                            $('#ver').val("0");
                        });
                        $('#tambah_prodi').click(function() {
                            let kode_prodi = $('#kode_prodi').val();
                            let nama_prodi = $('#nama_prodi').val();
                            let singkatan = $('#singkatan').val();
                            let ver = $('#ver').val();

                            if (kode_prodi != "" && nama_prodi != "" && singkatan != "" && ver == "0") {
                                $.ajax({
                                    url: "/prodi/tambah",
                                    type: "POST",
                                    data: {
                                        _token: $("#csrf").val(),
                                        kode_prodi: kode_prodi,
                                        nama_prodi: nama_prodi,
                                        singkatan: singkatan,
                                    },
                                    success: function(data) {
                                        if (data)
                                            alert('Sukses');
                                        window.location = "/prodi";


                                    },
                                    error: function(response) {
                                        let data = response.responseJSON.error;
                                        $.each(data, function(key, value) {
                                            alert(value);
                                        });
                                        $('#kode_prodi').val("");
                                        $('#nama_prodi').val("");
                                        $('#singkatan').val("");
                                    }
                                });
                                // ini untuk edit proses
                            } else if ((kode_prodi != "" && nama_prodi != "" && singkatan != "" && ver == "1")) {
                                $.ajax({
                                    url: "/prodi/edit-prodi",
                                    type: "POST",
                                    data: {
                                        _token: $("#csrf").val(),
                                        kode_prodi: kode_prodi,
                                        nama_prodi: nama_prodi,
                                        singkatan: singkatan,

                                    },
                                    success: function(data) {
                                       if (data)
                                            alert('Sukses');
                                        window.location = "/prodi";
                                  
                                      // console.log(data);

                                    }
                                });
                            } else {
                                alert('Lengkapi isian data !');

                            }

                        });

                        // ini untuk edit show
                        $('body').on('click', '.editCustomer', function() {
                            var id = $(this).data('id');
                            //console.log(id);
                            /*$.get("{{ url('edit') }}/"+kode_prodi,{}, function(data, status) {
                                console.log(data);
                                //alert("Data: " + data + "\nStatus: " + status);
                            });*/
                            $.ajax({
                                url: "/edit/" + id,
                                type: "GET",
                                dataType: 'json',
                                success: function(data) {
                                    console.log(data);
                                    $('#addTodoModal').modal('show');
                                    $('#tambah_prodi').html('Edit');
                                    $('#ver').val("1");
                                    $('.modal-title').html('Edit Prodi')
                                    $.each(data.data, function(key, item) {

                                        $('#kode_prodi').val(data.data.kode_prodi);
                                        $('#nama_prodi').val(data.data.nama_prodi);
                                        $('#singkatan').val(data.data.singkatan);

                                    });
                                }
                            });
                            /*
                            $.get("{{ url('edit') }}/" + id,                                                     
                            function(data) {
                                //var result = JSON.stringify(data);
                                //let myArr =Object.entries(data)
                                //console.log(myArr);
                                console.log(data);
                                //console.log(result.kode_prodi);
                                //alert(myArr);
                               
                               
                               // $kode_prodi=data['kode_prodi'];
                                $('#addTodoModal').modal('show');
                                $('#kode_prodi').val(data.kode_prodi);
                                $('#nama_prodi').val(data.nama_prodi);
                                $('#singkatan').val(data.singkatan);
                                $('#tambah_prodi').html('Edit');
                                $('#ver').val("1");
                                $('.modal-title').html('Edit Prodi')

                            });*/
                        });

                        //untuk proses delete
                        $('body').on('click', '.deleteCustomer', function() {
                            var id = $(this).data('id');
                           
                            confirm("Are You sure want to delete !");
                            $.ajax({
                                type: "DELETE",
                                url: "/delete" + '/' + id,
                                data: {
                                    _token: $("#csrf").val(),
                                },
                                success: function(data) {
                                  //  window.location = "/prodi";
                                  //console.log(data);
                                },
                                error: function(data) {
                                    console.log('Error:', data);
                                }
                            });
                        });


                    });
                </script>
            @endpush
        @endsection
