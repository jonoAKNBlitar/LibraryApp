@extends('layout.app')

<!---------------------------------->
@section('content')
    <form class="user" action="/kembali/tambah" method="POST">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card bg-light text-black shadow">
                    <div class="card-body">
                        Cari Mahasiswa
                        <input type="text" class="form-control form-control-user" " id="carimhs" name="carimhs" placeholder="Cari Mahasiswa...." aria-label="Search" aria-describedby="basic-addon2">
                            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                                                                                                    
                    </div>
                </div>
            </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-light text-black shadow">
                    <div class="card-body">NIM
                        <input type="text" class="form-control form-control-user" id="nim" name="nim" placeholder="Nim"value="">
                        </div>
                </div>
                </div>
                <div class="col-lg-6 mb-4">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                        Status Peminjaman
                            <div class="text-white-50 small">Tepat Waktu/Tidak</div>
                    </div>
                </div>
                <button type="button" class="btn btn-success " id="tambah">
                    Tampil Peminjaman
                </button>
                </div>
        </div>
            <div class="card shadow mb-4" id="buku_form">
                
                <table id="tabelPinjam" name="tabelPinjam" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>ID</th>
                            <th>Kode Buku</th>
                            <th>Nama Buku</th>
                            <th>Jumlah dipinjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Terlambat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="template">
                    </tbody>
                </table>
                <div class="card-body">
                    <button  type="submit" class="btn btn-success" >
                        Kembalikan
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
                var row = 1;
                $('#tambah').click(function() {
                    var nim = $('#nim').val();
                    // alert(nim);
                    $.ajax({
                        url: "/kembali/" + nim,
                        type: "GET",
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            let modifiedArr = response.map(function(element) {
                              
                                var miliday = 24 * 60 * 60 * 1000;
                                let tgl_kembali = new Date(element.balik_detil
                                    .tanggal_kembali);
                                //new Date().toISOString().slice(0, 10)

                                var tgl_sekarang = new Date();
                               // console.log(tgl_sekarang.getTime());
                                let informasi = "";
                                var telat = Math.round((tgl_sekarang.getTime() - tgl_kembali
                                    .getTime()) / miliday);
                                if (telat >= 0) {
                                    informasi = "Terlambat " + telat + " Hari";
                                } else {
                                    informasi = "Belum Terlambat";
                                }

                                $('#template').append(
                                    '<tr><td><input type="text" class="form-control form-control-user"name="row[]" value="' +
                                    row +
                                    '" readonly></td><td><input type="text" class="form-control form-control-user"name="id[]" value="' +
                                    element.id +
                                    '" readonly></td><td><input type="text" class="form-control form-control-user"name="kode_buku[]" value="' +
                                    element.kode_buku +
                                    '" readonly></td><td><input type="text" class="form-control form-control-user" name=judul[]" value="' +
                                    element.tampil.judul +
                                    '"readonly></td><td><input type="text" class="form-control form-control-user" name="jml_pinjam[]" value="' +
                                    element.jml_pinjam +
                                    '" readonly></td><td><input type="text" class="form-control form-control-user" name="tanggal_pinjam[]" value="' +
                                    element.balik_detil.tanggal_kembali +
                                    '" readonly></td><td><input type="text" class="form-control form-control-user" style="color:black" name="telat[]" value="' +
                                    informasi +
                                    '" readonly></td><td><input type="checkbox" name="cekbox[]" value="' +
                                    element.id + '"></td></tr>'
                                );
                                row++;

                            });
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
