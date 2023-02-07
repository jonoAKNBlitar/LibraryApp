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
                        Tambah Buku
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
                    <h6 class="m-0 font-weight-bold text-primary">Data Buku</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Kode Buku</th>
                                    <th>Judul</th>
                                    <th>Tahun Terbit</th>
                                    <th>Jumlah</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>Rak</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Kode Buku</th>
                                    <th>Judul</th>
                                    <th>Tahun Terbit</th>
                                    <th>Jumlah</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>Rak</th>
                                    <th>Opsi</th>
                                </tr>
                            </tfoot>
                            <tbody>

                                @foreach ($post as $p)
                                    <tr>
                                        <td>{{ $p->kode_buku }}</td>
                                        <td>{{ $p->judul }}</td>
                                        <td>{{ $p->tahun_terbit }}</td>
                                        <td>{{ $p->jumlah }}</td>
                                        <td>{{ $p->pengarang_id }}</td>
                                        <td>{{ $p->penerbit_id }}</td>
                                        <td>{{ $p->rak_kode_rak }}</td>

                                        <td>
                                            <a onclick="javascript:void(0)" data-id="{{ $p->kode_buku }}"
                                                class="btn btn-success btn-sm editCustomer">
                                                <span class="icon text-white-50"><i class="fas fa-check"></i></span>
                                                <span class="text">Edit</span></a>

                                            <a onclick="javascript:void(0)" data-id="{{ $p->kode_buku }}"
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
                            <h4 class="modal-title">Tambah Buku</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">

                                <input type="text" name="ver" id="ver" value="0">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                                        <input type="text" class="form-control form-control-user" id="kode_buku"
                                            name="kode_buku" placeholder="Kode Buku">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="judul"
                                            name="judul" placeholder="judul">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="tahun_terbit"
                                            name="tahun_terbit" placeholder="tahun_terbit">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="jumlah"
                                            name="jumlah" placeholder="jumlah">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="pengarang_id"
                                            name="pengarang_id" placeholder="pengarang_id">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="penerbit_id"
                                            name="penerbit_id" placeholder="penerbit_id">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="rak_kode_rak"
                                            name="rak_kode_rak" placeholder="rak_kode_rak">
                                    </div>
                                    <span id="taskError" class="alert-message"></span>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-primary btn-user btn-block" id="tambah_buku"
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
                            //alert("hallo");
                            $('#addTodoModal').modal('show');
                            $('#ver').val("0");
                        });
                        $('#tambah_buku').click(function() {
                            let kode_buku = $('#kode_buku').val();
                            let judul = $('#judul').val();
                            let tahun_terbit = $('#tahun_terbit').val();
                            let jumlah = $('#jumlah').val();
                            let pengarang_id = $('#pengarang_id').val();
                            let penerbit_id = $('#penerbit_id').val();
                            let rak_kode_rak = $('#rak_kode_rak').val();
                            var ver = $('#ver').val();


                            if (kode_buku != "" && judul != "" && tahun_terbit != "" && jumlah !== "" &&
                                pengarang_id !== "" && penerbit_id !== "" && rak_kode_rak !== "" && ver == "0") {
                                $.ajax({
                                    url: "/buku/tambah",
                                    //url:"{{ route('tambah_buku') }}",
                                    type: "POST",
                                    data: {
                                        _token: $("#csrf").val(),
                                        kode_buku: kode_buku,
                                        judul: judul,
                                        tahun_terbit: tahun_terbit,
                                        jumlah: jumlah,
                                        pengarang_id: pengarang_id,
                                        penerbit_id: penerbit_id,
                                        rak_kode_rak: rak_kode_rak
                                    },
                                    success: function(data) {
                                        if (data)
                                            alert(data.message);
                                        window.location = "/buku";
                                        $('#kode_buku').val("");
                                        $('#judul').val("");
                                        $('#tahun_terbit').val("");
                                        $('#jumlah').val("");
                                        $('#pengarang_id').val("");
                                        $('#penerbit_id').val("");
                                        $('#rak_kode_rak').val("");
                                    },
                                    error: function(response) {
                                        let data = response.responseJSON.error;
                                        $.each(data, function(key, value) {
                                            alert(value);
                                        });
                                        alert(response);
                                    }
                                });
                                // ini untuk edit proses
                            } else if (kode_buku != "" && judul != "" && tahun_terbit != "" && jumlah !== "" &&
                                pengarang_id !== "" && penerbit_id !== "" && rak_kode_rak !== "" && ver == "1") {
                                $.ajax({
                                    url: "/buku/edit-proses",
                                    type: "POST",
                                    data: {
                                        _token: $("#csrf").val(),
                                        kode_buku: kode_buku,
                                        judul: judul,
                                        tahun_terbit: tahun_terbit,
                                        jumlah: jumlah,
                                        pengarang_id: pengarang_id,
                                        penerbit_id: penerbit_id,
                                        rak_kode_rak: rak_kode_rak
                                    },
                                    success: function(data) {
                                        if (data)
                                        alert(data.message);
                                        window.location = "/buku";
                                        // console.log(data);
                                    },
                                    error: function(response) {
                                        let data = response.responseJSON.error;
                                        $.each(data, function(key, value) {
                                            alert(value);
                                        });
                                        alert(response);

                                    }
                                });
                            } else {
                                alert('Lengkapi isian data !');
                            }

                        });

                        // ini untuk memunculkan edit modal
                        $('body').on('click', '.editCustomer', function() {
                            var kode_buku = $(this).data('id');
                           
                            $.ajax({
                                url: "/show/" + kode_buku,
                                type: "GET",
                                dataType: 'json',
                                success: function(data, status) {
                                    console.log(status);
                                    $('#addTodoModal').modal('show');
                                    $('#tambah_buku').html('Edit');
                                    $('#ver').val("1");
                                    $('.modal-title').html('Edit Buku');
                                    $('#kode_buku').val(data.kode_buku);
                                    $('#judul').val(data.judul);
                                    $('#tahun_terbit').val(data.tahun_terbit);
                                    $('#jumlah').val(data.jumlah);
                                    $('#penerbit_id').val(data.penerbit_id);
                                    $('#pengarang_id').val(data.pengarang_id);
                                    $('#rak_kode_rak').val(data.rak_kode_rak);
                                    $('#kode_buku').prop("readonly", true);
                                }
                            });
                        });

                        //untuk proses delete
                        $('body').on('click', '.deleteCustomer', function() {
                            var id = $(this).data('id');
                            //alert(id);
                            confirm("Are You sure want to delete !");
                            $.ajax({
                                type: "DELETE",
                                url: "/delete" + '/' + id,
                                data: {
                                    _token: $("#csrf").val(),
                                },
                                success: function(data) {
                                    window.location = "/buku";
                                    console.log(data);
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
