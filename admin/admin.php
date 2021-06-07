<?php
include('auth.php');
if (!($_SESSION["tipe_admin"]=="Super Admin")) {
  header("Location:tabel-pengguna");
}
$title = 'data pengguna';
$menuAdmin = 'active';
include 'master.php';
?>
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Admin</h3>
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
                    <th>Tipe Admin</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                  </tr>
                  </thead>
                  <tbody class="isiData">
                  </tbody>
                </table>
                <button id="btnTambah" type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#modalAdmin">Tambah</button>
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
  $('.isiData').load("adminController.php");
  $.validator.setDefaults({

    // submitHandler: function () {
    //   alert( "Form successful submitted!" );
    // }
  });
  $('#tambahAdmin').validate({
    rules: {
      email_admin: {
        required: true,
        email: true,
      },
      password_admin: {
        required: true,
        minlength: 6
      },
      nama_depan_admin: {
          required: true,
      },
      nama_belakang_admin: {
          required: true,
      },
      no_hp_admin: {
        required: true,
        minlength: 10,
        digits: true
      },
      alamat_admin: {
        required: true,
      }
    },
    messages: {
      email_admin: {
        required: "Mohon masukkan alamat email",
        email: "Mohon masukkan alamat email yang valid"
      },
      password_admin: {
        required: "Mohon masukkan password",
        minlength: "Password setidaknya memiliki panjang 6 karakter"
      },
      nama_depan_admin: {
        required: "Mohon masukkan nama depan anda"
      },
      nama_belakang_admin: {
        required: "Mohon masukkan nama belakang anda"
      },
      no_hp_admin: {
        required: "Mohon masukkan nomor hp anda",
        minlength: "Mohon masukkan nomor minimal 10 digit",
        digits: "Mohon hanya masukkan angka",
      },
      alamat_admin: {
        required: "Mohon masukkan alamat anda sesuai dengan tempat tinggal"
      },
    },
    submitHandler: function(form){
      $("#tambahAdmin").submit(function(e){
    e.preventDefault();
    $.ajax({
      data: new FormData(this),
      processData: false,
            contentType: false,
            cache: false,
      url: "adminController.php",
      type: "POST",
      enctype: 'multipart/form-data',
      success: function (data) {
        $('#tambahAdmin').trigger("reset");
        $('#modalAdmin').modal('hide');
        $('.isiData').load("adminController.php");
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
    $('#judulModal').html('Tambah Admin');
    $('#tambahAdmin').trigger("reset");
    $('#id_admin').val("");
    $('#btnSimpan').html("Simpan");
    $('#fotosi').html("");
  });

  $('body').on('click', '.btnEdit', function () {
    var id_admin = $(this).data('id');
    $('#judulModal').html('Edit Admin');
    $('#btnSimpan').html("Edit");

    $.ajax({
        data: {
          'id_admin': id_admin,
        },
        url: "adminController.php",
        type: "GET",
      success: function (data) {
        myObj = JSON.parse(data);
        $('#id_admin').val(myObj.id_admin);
        $('#email_admin').val(myObj.email_admin);
        $('#password_admin').val(myObj.password_admin);
        $('#nama_depan_admin').val(myObj.nama_depan_admin);
        $('#nama_belakang_admin').val(myObj.nama_belakang_admin);
        $('#email_verified_at').val(myObj.email_verified_at);
        $('#no_hp_admin').val(myObj.no_hp_admin);
        $('#alamat_admin').val(myObj.alamat_admin);
        $('#tipe_admin').val(myObj.tipe_admin);
        var fotosi='<div class="form-group row"> <label class="col-sm-2 col-form-label">Foto Saat ini</label> <div class="col-sm-10"><div class="custom-file"><img src="images/foto_admin/'+myObj.foto_admin+'" style="margin-bottom: 100px;height:100px;max-width:600px"></div></div></div>';
        $('#fotosi').html(fotosi);
        $('#modalAdmin').modal('show');
      },
      error: function (data) {
                console.log('Error:', data);
      },
    });
  });

  $('body').on('click', '.btnHapus', function () {
    var id_admin = $(this).data('id');

    $.ajax({
        data: {
          'id_admin': id_admin,
        },
        url: "adminController.php",
        type: "GET",
      success: function (data) {
        myObj = JSON.parse(data);
      $('#hid_admin').val(myObj.id_admin);
      $('#hemail_admin').val(myObj.email_admin);
      $('#hnama_depan_admin').val(myObj.nama_depan_admin);
      $('#hnama_belakang_admin').val(myObj.nama_belakang_admin);
      $('#hno_hp_admin').val(myObj.no_hp_admin);
      $('#halamat_admin').val(myObj.alamat_admin);
      $('#htipe_admin').val(myObj.tipe_admin);
      $('#modalHapusAdmin').modal('show');
      },
      error: function (data) {
                console.log('Error:', data);
      },
    });
  });
  $('#hbtnHapus').click(function (e) {
    var id_admin = $("#hid_admin").val();
    $.ajax({
            data: {
                'aksi': 'hapus',
                'id_admin': id_admin,
            },
            type: "POST",
            url: "adminController.php",
            success: function (data) {
                $('#hapusAdmin').trigger("reset");
                $('#modalHapusAdmin').modal('hide');
                $('.isiData').load("adminController.php");
                berhasilHapus();
            },
            error: function (data) {
                console.log('Error:', data);
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
      url: "{{ route('tabel-admin.index') }}",
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
<div class="modal fade" id="modalAdmin">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="judulModal">Tambah Admin</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="post" id="tambahAdmin" enctype="multipart/form-data">
                <input type="hidden" id="id_admin" name="id_admin">
                <input type="hidden" id="aksi" name="aksi" value="simpan">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="text" id="email_admin" name="email_admin" class="form-control" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" id="password_admin" name="password_admin" class="form-control" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Depan</label>
                    <div class="col-sm-10">
                      <input type="text" id="nama_depan_admin" name="nama_depan_admin" class="form-control" placeholder="Nama Depan">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Belakang</label>
                    <div class="col-sm-10">
                      <input type="text" id="nama_belakang_admin" name="nama_belakang_admin" class="form-control" placeholder="Nama Belakang">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-10">
                      <div class="custom-file">
                        <input type="file" name ="foto_admin" class="custom-file-input" id="foto_admin">
                        <label class="custom-file-label" for="foto_admin">Choose file</label>
                      </div>
                    </div>
                  </div>
                  <div id="fotosi">
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nomor Handphone</label>
                    <div class="col-sm-10">
                      <input type="text" id="no_hp_admin" name="no_hp_admin" class="form-control" placeholder="Nomor Handphone">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                      <input type="text" id="alamat_admin" name="alamat_admin" class="form-control" placeholder="Alamat">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tipe</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" name="tipe_admin" style="width: 100%;">
                        <option selected="selected">Admin</option>
                        <option>Super Admin</option>
                      </select>
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
      <div class="modal fade" id="modalHapusAdmin">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="judulModal">Apakah Anda yakin untuk menghapus data ini?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="post" id="hapusAdmin" enctype="multipart/form-data">
                <input type="hidden" id="hid_admin" name="id_admin">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" id="hemail_admin" name="email_admin" class="form-control" disabled="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Depan</label>
                    <div class="col-sm-10">
                      <input type="text" id="hnama_depan_admin" name="nama_depan_admin" class="form-control" disabled="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Belakang</label>
                    <div class="col-sm-10">
                      <input type="text" id="hnama_belakang_admin" name="nama_belakang_admin" class="form-control"  disabled="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nomor Handphone</label>
                    <div class="col-sm-10">
                      <input type="text" id="hno_hp_admin" name="no_hp_admin" class="form-control"  disabled="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                      <input type="text" id="halamat_admin" name="alamat_admin" class="form-control" disabled="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tipe</label>
                    <div class="col-sm-10">
                      <input type="text" id="htipe_admin" name="tipe_admin" class="form-control" disabled="">
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