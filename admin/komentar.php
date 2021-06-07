<?php
include 'auth.php';
$title = 'data komentar';
$menuKomentar = 'active';
include 'master.php';
?>
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Komentar</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabelData" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Judul</th>
                    <th>Isi Komentar</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                  </tr>
                  </thead>
                  <tbody class="isiData">
                  </tbody>
                </table>
                <button id="btnTambah" type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#modalKomentar">Tambah</button>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script>
$(function () {

  $('.isiData').load("komentarController.php");
  
  $('#tambahKomentar').validate({
    rules: {
        id_pengguna: {
            required: true,
        },
        id_postingan: {
            required: true,
        },
        isi_komentar: {
            required: true,
        },
    },
    messages: {
        id_pengguna: {
            required: "Mohon masukkan id_pengguna"
        },
        id_postingan: {
            required: "Mohon masukkan id_postingan"
        },
        isi_komentar: {
            required: "Mohon masukkan isi komentar"
        },
    },
    submitHandler: function(form) {
      $("#tambahKomentar").submit(function(e){
    e.preventDefault();
    $.ajax({
      data: new FormData(this),
      processData: false,
            contentType: false,
            cache: false,
      url: "komentarController.php",
      type: "POST",
      enctype: 'multipart/form-data',
      success: function (data) {
        $('.isiData').load("komentarController.php");
        $('#tambahKomentar').trigger("reset");
        $('#modalKomentar').modal('hide')
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
    ambilPengguna(0);
    ambilPostingan(0);
    $('#judulModal').html('Tambah Komentar');
    $('#tambahKomentar').trigger("reset");
    $('#id_komentar').val("");
    $('#btnSimpan').html("Simpan");
  });

  $('body').on('click', '.btnEdit', function () {
    var id_komentar = $(this).data('id');
    $('#judulModal').html('Edit Komentar');
    $('#btnSimpan').html("Edit");
    $.ajax({
      data: {
        'id_komentar': id_komentar,
      },
      url: "komentarController.php",
      type: "GET",
        success: function (data) {
          myObj = JSON.parse(data);
      ambilPengguna(myObj.id_pengguna);
      ambilPostingan(myObj.id_postingan);
      $('#id_komentar').val(myObj.id_komentar);
      $('#isi_komentar').val(myObj.isi_komentar);
      $('#modalKomentar').modal('show');
      },
        error: function (data) {
          console.log('Error:', data);
      },
    });
  });

  $('body').on('click', '.btnHapus', function () {
    var id_komentar = $(this).data('id');
    $.ajax({
      data: {
        'id_komentar': id_komentar,
      },
      url: "komentarController.php",
      type: "GET",
        success: function (data) {
          myObj = JSON.parse(data);
      ambilPengguna(myObj.id_pengguna);
      ambilPostingan(myObj.id_postingan);
      $('#hid_komentar').val(myObj.id_komentar);
      $('#hisi_komentar').val(myObj.isi_komentar);
      $('#modalHapusKomentar').modal('show');
      },
        error: function (data) {
          console.log('Error:', data);
      },
      
    });
  });
  $('#hbtnHapus').click(function (e) {
    var id_komentar = $("#hid_komentar").val();
    $.ajax({
            data: {
                'aksi': 'hapus',
                'id_komentar': id_komentar,
            },
            type: "POST",
            url: "komentarController.php",
            success: function (data) {
                $('#hapusKomentar').trigger("reset");
                $('#modalHapusKomentar').modal('hide');
                berhasilHapus();
                $('.isiData').load("komentarController.php");
            },
            error: function (data) {
                console.log('Error:', data);
            },
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

function ambilPengguna(id){
    var id_pengguna = id;
    $.ajax({
      data: {
        'id_pengguna':id_pengguna,
        'aksi': 'ambil_pengguna',
      },
      url: "menyukaiController.php",
      type: "GET",
      success: function (data) {
          $('#id_pengguna').html(data);
          $('#hid_pengguna').html(data);
      },
      error: function (data) {
        console.log('Error:', data);
      },
    });
  };
  function ambilPostingan(id){
    var id_postingan = id;
    $.ajax({
      data: {
        'id_postingan':id_postingan,
        'aksi': 'ambil_postingan',
      },
      url: "menyukaiController.php",
      type: "GET",
      success: function (data) {
          $('#id_postingan').html(data);
          $('#hid_postingan').html(data);
      },
      error: function (data) {
        console.log('Error:', data);
      },
    });
  }
});

</script>



<!-- ./wrapper -->
<div class="modal fade" id="modalKomentar">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="judulModal">Tambah komentar</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="post" id="tambahKomentar" enctype="multipart/form-data">
                <input type="hidden" id="id_komentar" name="id_komentar">
                <input type="hidden" id="aksi" name="aksi" value="simpan">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Pengguna</label>
                    <div class="col-sm-10">
                      <select class="form-control select2bs4" style="width: 100%;" id="id_pengguna" name="id_pengguna">
                        
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Judul Postingan</label>
                    <div class="col-sm-10">
                      <select class="form-control select2bs4" style="width: 100%;" id="id_postingan" name="id_postingan">
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Isi Komentar</label>
                    <div class="col-sm-10">
                      <input type="text" id="isi_komentar" name="isi_komentar" class="form-control" placeholder="Isi Komentar">
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
      <div class="modal fade" id="modalHapusKomentar">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="judulModal">Apakah Anda yakin untuk menghapus data ini?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="post" id="hapuskomentar" enctype="multipart/form-data">
                <input type="hidden" id="hid_komentar" name="id_komentar">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Pengguna</label>
                    <div class="col-sm-10">
                       <select class="form-control select2bs4" style="width: 100%;" id="hid_pengguna" name="id_pengguna" disabled="">
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Judul Postingan</label>
                    <div class="col-sm-10">
                      <select class="form-control select2bs4" style="width: 100%;" id="hid_postingan" name="id_postingan" disabled="">
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Isi Komentar</label>
                    <div class="col-sm-10">
                      <input type="text" id="hisi_komentar" name="isi_komentar" class="form-control" disabled="">
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