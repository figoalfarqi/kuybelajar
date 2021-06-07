<?php
include('auth.php');
$title = 'data pengguna';
$menuPengguna = 'active';
include 'master.php';
?>
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Pengguna</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="tabelData" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Email</th>
                    <th>Nama Depan</th>
                    <th>Nama Belakang</th>
                    <th>No Hp</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                  </tr>
                  </thead>

                  <tbody class="isiData">
              </tbody>

                </table>
                <button id="btnTambah" type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#modalPengguna">Tambah</button>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script>
$(function () {
  $('.isiData').load("penggunaController.php");
  $.validator.setDefaults({
    submitHandler: function () {
    }
  });
  $('#tambahPengguna').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 6
      },
    },
    messages: {
      email: {
        required: "Mohon masukkan alamat email",
        email: "Mohon masukkan alamat email yang valid"
      },
      password: {
        required: "Mohon masukkan password",
        minlength: "Password setidaknya memiliki panjang 6 karakter"
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
    $('#judulModal').html('Tambah Pengguna');
    $('#tambahPengguna').trigger("reset");
    $('#id_pengguna').val("");
    $('#btnSimpan').html("Simpan");
    $('#fotosi').html("");
  });

  $('body').on('click', '.btnEdit', function () {
    $('#judulModal').html('Edit Pengguna');
    $('#btnSimpan').html("Edit");
    $('#tambahPengguna').trigger("reset");
    var id_pengguna = $(this).data("id");
    $.ajax({
        data: {
          'id_pengguna': id_pengguna,
        },
        url: "penggunaController.php",
        type: "GET",
            success: function (data) {
              myObj = JSON.parse(data);
                $('#id_pengguna').val(myObj.id_pengguna);
                $('#email').val(myObj.email);
                $('#password').val(myObj.password);
                $('#nama_depan').val(myObj.nama_depan);
                $('#nama_belakang').val(myObj.nama_belakang);
                $('#no_hp').val(myObj.no_hp);
            
                var fotosi='<div class="form-group row"> <label class="col-sm-2 col-form-label">Foto Saat ini</label> <div class="col-sm-10"><div class="custom-file"><img src="images/foto_pengguna/'+myObj.foto+'" style="margin-bottom: 100px;height:100px;max-width:600px"></div></div></div>';
                $('#fotosi').html(fotosi);
                $('#modalPengguna').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            },
    });
  });

  $('body').on('click', '.btnHapus', function () {
    var id_pengguna = $(this).data("id");
    $.ajax({
        data: {
          'id_pengguna': id_pengguna,
        },
        url: "penggunaController.php",
        type: "GET",
            success: function (data) {
              myObj = JSON.parse(data);
                $('#hid_pengguna').val(myObj.id_pengguna);
                $('#hemail').val(myObj.email);
                $('#hnama_depan').val(myObj.nama_depan);
                $('#hnama_belakang').val(myObj.nama_belakang);
                $('#hno_hp').val(myObj.no_hp);
                $('#modalHapusPengguna').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            },
        });
      
  });
  $('#hbtnHapus').click(function (e) {
    var id_pengguna = $("#hid_pengguna").val();
    $.ajax({
            data: {
                'aksi': 'hapus',
                'id_pengguna': id_pengguna,
            },
            type: "POST",
            url: "penggunaController.php",
            success: function (data) {
                $('#hapusPengguna').trigger("reset");
                $('#modalHapusPengguna').modal('hide');
                $('.isiData').load("penggunaController.php");
                berhasilHapus();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
  });
  $("#tambahPengguna").submit(function(e){
    e.preventDefault();
    $.ajax({
      data: new FormData(this),
      processData: false,
            contentType: false,
            cache: false,
      url: "penggunaController.php",
      type: "POST",
      enctype: 'multipart/form-data',
      success: function (data) {
        $('#tambahPengguna').trigger("reset");
        $('#modalPengguna').modal('hide');
        $('.isiData').load("penggunaController.php");
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
      title: 'Data berhasil disimpan.'
    })
  };

  function ambil(){
    $.ajax({
      url: "{{ route('tabel-pengguna.index') }}",
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
});

</script>



<!-- ./wrapper -->
<div class="modal fade" id="modalPengguna">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="judulModal">Tambah Pengguna</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="post" id="tambahPengguna" enctype="multipart/form-data">
                <input type="hidden" id="id_pengguna" name="id_pengguna">
                <input type="hidden" id="aksi" name="aksi" value="simpan">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="text" id="email" name="email" class="form-control" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Depan</label>
                    <div class="col-sm-10">
                      <input type="text" id="nama_depan" name="nama_depan" class="form-control" placeholder="Nama Depan">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Belakang</label>
                    <div class="col-sm-10">
                      <input type="text" id="nama_belakang" name="nama_belakang" class="form-control" placeholder="Nama Belakang">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-10">
                      <div class="custom-file">
                        <input type="file" name ="foto" class="custom-file-input" id="foto">
                        <label class="custom-file-label" for="foto">Choose file</label>
                      </div>
                    </div>
                  </div>
                  <div id="fotosi">
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nomor Handphone</label>
                    <div class="col-sm-10">
                      <input type="text" id="no_hp" name="no_hp" class="form-control" placeholder="Nomor Handphone">
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
      <div class="modal fade" id="modalHapusPengguna">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="judulModal">Apakah Anda yakin untuk menghapus data ini?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="post" id="hapusPengguna" enctype="multipart/form-data">
                <input type="hidden" id="hid_pengguna" name="id_pengguna">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" id="hemail" name="email" class="form-control" disabled="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Depan</label>
                    <div class="col-sm-10">
                      <input type="text" id="hnama_depan" name="nama_depan" class="form-control" disabled="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Belakang</label>
                    <div class="col-sm-10">
                      <input type="text" id="hnama_belakang" name="nama_belakang" class="form-control"  disabled="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nomor Handphone</label>
                    <div class="col-sm-10">
                      <input type="text" id="hno_hp" name="no_hp" class="form-control"  disabled="">
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