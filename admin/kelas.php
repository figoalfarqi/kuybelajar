<?php
include('auth.php');
$title = 'data kelas';
$menuKelas = 'active';
include 'master.php';

?>
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Kelas</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabelData" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Nama Kelas</th>
                    <th>Deskripsi</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                  </tr>
                  </thead>
                  <tbody class="isiData">
                    
                  </tbody>
                </table>
                <button id="btnTambah" type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#modalKelas">Tambah</button>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script>
$(function () {
  $('.isiData').load("kelasController.php");
  $.validator.setDefaults({
    submitHandler: function () {
    }
  });
  $('#tambahKelas').validate({
    rules: {
      judul: {
        required: true,
      },
    },
    messages: {
      judul: {
        required: "Mohon masukkan alamat id_pengguna",
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });

  $('#btnTambah').click(function (e) {
    ambilPengguna(0);
    $('#judulModal').html('Tambah Kelas');
    $('#tambahKelas').trigger("reset");
    $('#id_kelas').val("");
    $('#btnSimpan').html("Simpan");
    $('#fotosi').html("");
  });

  $('body').on('click', '.btnEdit', function () {
    var id_kelas = $(this).data('id');
    $('#judulModal').html('Edit Kelas');
    $('#btnSimpan').html("Edit");
    $.ajax({
      data: {
        'id_kelas': id_kelas,
      },
      url: "kelasController.php",
      type: "GET",
        success: function (data) {
          myObj = JSON.parse(data);
          ambilPengguna(myObj.id_pengguna);
        $('#id_kelas').val(myObj.id_kelas);
        $('#nama_kelas').val(myObj.nama_kelas);
        $('#deskripsi').val(myObj.deskripsi);
        var fotosi='<div class="form-group row"> <label class="col-sm-2 col-form-label">foto Saat ini</label> <div class="col-sm-10"><div class="custom-file"><img src="images/foto_sampul/'+myObj.foto_sampul+'" style="margin-bottom: 100px;height:100px;max-width:600px"></div></div></div>';
        $('#fotosi').html(fotosi);
        $('#modalKelas').modal('show');
        },
        error: function (data) {
          console.log('Error:', data);
        },
    });
  });

  $('body').on('click', '.btnHapus', function () {
    var id_kelas = $(this).data("id");
    $.ajax({
      data: {
        'id_kelas': id_kelas,
      },
      url: "kelasController.php",
      type: "GET",
        success: function (data) {
          myObj = JSON.parse(data);
          ambilPengguna(myObj.id_pengguna);
      $('#hid_kelas').val(myObj.id_kelas);
      $('#hnama_kelas').val(myObj.nama_kelas);
      $('#hdeskripsi').val(myObj.deskripsi);
      $('#modalHapusKelas').modal('show');
      },
        error: function (data) {
          console.log('Error:', data);
        },
    });
  });
  $('#hbtnHapus').click(function (e) {
    var id_kelas = $("#hid_kelas").val();
    $.ajax({
            data: {
                'aksi': 'hapus',
                'id_kelas': id_kelas,
            },
            type: "POST",
            url: "kelasController.php",
            success: function (data) {
                $('#hapusKelas').trigger("reset");
                $('#modalHapusKelas').modal('hide');
                $('.isiData').load("kelasController.php");
                berhasilHapus();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
  });
  $("#tambahKelas").submit(function(e){
    e.preventDefault();
    $.ajax({
      data: new FormData(this),
      processData: false,
            contentType: false,
            cache: false,
      url: "kelasController.php",
      type: "POST",
      enctype: 'multipart/form-data',
      success: function (data) {
        $('.isiData').load("kelasController.php");
        $('#tambahKelas').trigger("reset");
        $('#modalKelas').modal('hide');
        if($('#btnSimpan').html()=="Edit")
          berhasilEdit();
        else
          berhasilSimpan();
      },
      error: function (data) {
        alert("Data gagal disimpan");
      }
    });
  });
  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
  function berhasilHapus(){
    Toast.fire({
      icon: 'success',
      title: 'Data berhasil dihapus.'
    })
  };
  function berhasilEdit(){
    Toast.fire({
      icon: 'success',
      title: 'Data berhasil diedit.'
    })
  };
  function berhasilSimpan(){
    Toast.fire({
      icon: 'success',
      title: 'Data berhasil ddeskripsimpan.'
    })
  };

  function ambil(){
    $.ajax({
      url: "{{ route('tabel-kelas.index') }}",
      type: "get",
      dataType: 'html',
      success: function (data) { 
        $('#tabelData').html(data);
      },
      error: function (data) {
        alert("gagal");
      }
    });
  };

  function ambilPengguna(id){
    var id_pengguna = id;
    $.ajax({
      data: {
        'id_pengguna':id_pengguna,
        'aksi': 'ambil_pengguna',
      },
      url: "kelasController.php",
      type: "GET",
      success: function (data) {
          $('#id_pengguna').html(data);
          $('#hid_pengguna').html(data);
      },
      error: function (data) {
        console.log('Error:', data);
      },
    });
  }
});

</script>



<!-- ./wrapper -->
<div class="modal fade" id="modalKelas">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="judulModal">Tambah kelas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="post" id="tambahKelas" enctype="multipart/form-data">
                <input type="hidden" id="id_kelas" name="id_kelas">
                <input type="hidden" id="aksi" name="aksi" value="simpan">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">foto Sampul</label>
                    <div class="col-sm-10">
                      <div class="custom-file">
                        <input type="file" name ="foto_sampul" class="custom-file-input" id="foto_sampul">
                        <label class="custom-file-label" for="foto">Choose file</label>
                      </div>
                    </div>
                  </div>
                  <div id="fotosi">
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Pengguna</label>
                    <div class="col-sm-10">
                      <select class="form-control select2bs4" style="width: 100%;" id="id_pengguna" name="id_pengguna">
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Kelas</label>
                    <div class="col-sm-10">
                      <input type="nama_kelas" id="nama_kelas" name="nama_kelas" class="form-control" placeholder="Nama Kelas">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                      <input type="text" id="deskripsi" name="deskripsi" class="form-control" placeholder="Deskripsi">
                    </div>
                  </div>
                </div>
              </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="btnSimpan" style="margin-right: 0%;width:20%">Simpan</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="modalHapusKelas">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="judulModal">Apakah Anda yakin untuk menghapus data ini?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="post" id="hapusKelas" enctype="multipart/form-data">
                <input type="hidden" id="hid_kelas" name="id_kelas">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Pengguna</label>
                    <div class="col-sm-10">
                      <select class="form-control select2bs4" style="width: 100%;" id="hid_pengguna" name="id_pengguna" disabled="">
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Kelas</label>
                    <div class="col-sm-10">
                      <input type="text" id="hnama_kelas" name="nama_kelas" class="form-control" disabled="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                      <input type="text" id="hdeskripsi" name="deskripsi" class="form-control" disabled="">
                    </div>
                  </div>
                </div>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="hbtnHapus" style="margin-right: 0%;width:20%">Hapus</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
     <?php
    include 'footer.php';
    ?>