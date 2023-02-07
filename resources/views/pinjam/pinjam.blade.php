@extends('layout.app')

<!---------------------------------->
@section('content')
    <form class="user" action="/peminjaman/tambah">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card bg-light text-black shadow">
                    <div class="card-body">
                        Cari Mahasiswa
                        <input type="text" class="form-control form-control-user" " id="carimhs" name="carimhs" placeholder="Cari Mahasiswa...."
                                aria-label="Search" aria-describedby="basic-addon2">
                                    <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                                
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-light text-black shadow">
                                <div class="card-body">
                                    NIM
                                    <input type="text" class="form-control form-control-user" id="nim" name="nim" placeholder="Nim"
                                    value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    
                                    Status Peminjaman
                                    <div class="text-white-50 small">Tepat Waktu/Tidak</div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="card shadow mb-4" id="buku_form">
                    <div class="card-header py-3">
                        <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                Cari Buku
                            <input type="text" class="form-control form-control-user" id="caribuku" name="caribuku" placeholder="Cari buku...."
                            value="">
                            </div>
                            <div class="form-group">
                                Kode Buku
                                <input type="text" class="form-control form-control-user" id="kode_buku" name="kode_buku" placeholder="Kode Buku"
                                value="" >
                                </div>
                                <div class="form-group">
                                    Tanggal Pinjam
                                    <input type="text" class="form-control form-control-user" id="tanggal_pinjam" name="tanggal_pinjam" placeholder="Kode Buku"
                                    value="{{ date('Y-m-d') }}">
                                    </div><div class="form-group">
                                        Pegawai
                                        <input type="text" class="form-control form-control-user" id="pegawai_id" name="pegawai_id" placeholder="Kode Buku"
                                        value="1">
                                        </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            Jumlah Peminjaman
                            <input type="text" class="form-control form-control-user" id="jumlah_pinjam" name="jumlah_pinjam" placeholder="Jumlah dipinjam"
                            value="">
                            </div>
                            <div class="form-group">
                                Stok
                                <input type="text" class="form-control form-control-user" id="jumlah" name="jumlah" placeholder="Stok Buku"
                                value="" >
                                </div>
                                <div class="form-group">
                                    Tanggal Kembali
                                    <input type="text" class="form-control form-control-user" id="tanggal_kembali" name="tanggal_kembali" placeholder="Kode Buku"
                                    value="{{ date('Y-m-d', strtotime('+6 day', time())) }}">
                                    </div>
                        </div>
                        </div>
                        
                            <button type="button" class="btn btn-info" id="tambah_tabel">
                                Tambah Keranjang
                            </button>
                            
                    </div>
                    
                    <table id="tabelPinjam" name="tabelPinjam" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Buku</th>
                                <th>Kode Buku</th>
                                <th>Stok Buku</th>
                                <th>Jumlah dipinjam</th>
                                <th>Sisa</th>
                                <th>Status</th>
                                
                            </tr>
                        </thead>

                        <tbody id="template">
                            
                        </tbody>
                    </table>
                    <div class="card-body">
                        <button  type="submit" class="btn btn-info" >
                            Pinjam
                        </button>
                        
                        </a>
                    </div>
                </div>
            </form>
            @push('page-script')
        <script type="text/javascript">
            $(document).ready(function() {
                let form_buku = document.getElementById('buku_form');
                form_buku.style.visibility = 'hidden';
                //alert("ready");
                $("#carimhs").autocomplete({
                    source: function(request, response) {
                        // Fetch data
                        $.ajax({
                            url: "{{ route('peminjam.cari') }}",
                            type: 'post',
                            dataType: "json",
                            data: {
                                _token: $("#csrf").val(),
                                search: request.term
                            },
                            success: function(data) {
                                response(data);

                            }
                        });
                    },
                    select: function(event, ui) { // Set selection
                        $('#carimhs').val(ui.item.label); // display the selected text
                        $('#nim').val(ui.item.value); // save selected id to input
                        form_buku.style.visibility = 'visible';

                        return false;
                    }
                });

                $("#caribuku").autocomplete({
                    source: function(request, response) {
                        // Fetch data
                        $.ajax({
                            url: "{{ route('peminjam.buku') }}",
                            type: 'post',
                            dataType: "json",
                            data: {
                                _token: $("#csrf").val(),
                                search: request.term
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                    },
                    select: function(event, ui) {
                        // Set selection
                        $('#caribuku').val(ui.item.label); // display the selected text
                        $('#kode_buku').val(ui.item.value); // save selected id to input
                        $('#jumlah').val(ui.item.jumlah); // save selected id to input
                        return false;
                    }
                });
                var row = 1;
                $('#tambah_tabel').click(function() {

                    let buku = $("#caribuku").val();
                    let kode_buku = $("#kode_buku").val();
                    let stok = $("#jumlah").val();
                    let jml_pinjam = $("#jumlah_pinjam").val();
                    let sisa = $("#jumlah").val() - $("#jumlah_pinjam").val();
                    let tgl_pinjam = $("#tgl_pinjam").val();
                    let tgl_kembali = $("#tgl_kembali").val();


                    let new_row = row - 1;
                    $('#template').append(
                        '<tr><td><input type="text" class="form-control form-control-user"name="nomor[]" value="' +
                        row +
                        '" readonly></td><td><input type="text" class="form-control form-control-user" name="nama_buku[]" value="' +
                        buku +
                        '"readonly></td><td><input type="text" class="form-control form-control-user" name=kode_buku[]" value="' +
                        kode_buku +
                        '"readonly></td><td><input type="text" class="form-control form-control-user" name="stok_buku[]" value="' +
                        stok +
                        '"readonly></td><td><input type="text" class="form-control form-control-user" name="jml_pinjam[]" value="' +
                        jml_pinjam +
                        '"></td><td><input type="text" class="form-control form-control-user" name="sisa[]" value="' +
                        sisa +
                        '" readonly></td><td><input type="text" class="form-control form-control-user" name="status[]" value="1" readonly></td></tr>'
                        );
                    row++;
                    document.getElementById("kode_buku").value = "";
                    document.getElementById("caribuku").value = "";
                    document.getElementById("jumlah_pinjam").value = "";
                    document.getElementById("jumlah").value = "";
                });


            });
        </script>
    @endpush
@endsection
