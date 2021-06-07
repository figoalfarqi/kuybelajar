<?php
include('auth.php');
$title = 'data menyukai';
$menuMenyukai = 'active';
include 'master.php';
?>
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data menyukai</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabelData" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Judul</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                  </tr>
                  </thead>
                  <tbody class="isiData">
                  </tbody>
                </table>
                <button id="btnTambah" type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#modalmenyukai">Tambah</button>
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
  $('.isiData').load("menyukaiController.php");
  $.validator.setDefaults({
    submitHandler: function () {
    }
  });
  $('#tambahMenyukai').validate({
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
    ambilPostingan(0);
    $('#judulModal').html('Tambah Menyukai');
    $('#tambahMenyukai').trigger("reset");
    $('#id_menyukai').val("");
    $('#btnSimpan').html("Simpan");
  });

  $('body').on('click', '.btnEdit', function () {
    var id_menyukai = $(this).data('id');
    $('#judulModal').html('Edit menyukai');
    $('#btnSimpan').html("Edit");
    $.ajax({
      data: {
        'id_menyukai': id_menyukai,
      },
      url: "menyukaiController.php",
      type: "GET",
        success: function (data) {
          myObj = JSON.parse(data);
      ambilPengguna(myObj.id_pengguna);
      ambilPostingan(myObj.id_postingan);
      $('#id_menyukai').val(myObj.id_menyukai);
      $('#modalmenyukai').modal('show');
      },
        error: function (data) {
          console.log('Error:', data);
      },
    });
  });

  $('body').on('click', '.btnHapus', function () {
    var id_menyukai = $(this).data('id');
    $.ajax({
      data: {
        'id_menyukai': id_menyukai,
      },
      url: "menyukaiController.php",
      type: "GET",
        success: function (data) {
          myObj = JSON.parse(data);
      ambilPengguna(myObj.id_pengguna);
      ambilPostingan(myObj.id_postingan);
      $('#hid_menyukai').val(myObj.id_menyukai);
      $('#modalHapusMenyukai').modal('show');
      },
        error: function (data) {
          console.log('Error:', data);
      },
      
    });
  });
  $('#hbtnHapus').click(function (e) {
    var id_menyukai = $("#hid_menyukai").val();
    $.ajax({
            data: {
                'aksi': 'hapus',
                'id_menyukai': id_menyukai,
            },
            type: "POST",
            url: "menyukaiController.php",
            success: function (data) {
                $('#hapusMenyukai').trigger("reset");
                $('#modalHapusMenyukai').modal('hide');
                berhasilHapus();
                $('.isiData').load("menyukaiController.php");
            },
            error: function (data) {
                console.log('Error:', data);
            },
        });
  });
  $("#tambahMenyukai").submit(function(e){
    e.preventDefault();
    $.ajax({
      data: new FormData(this),
      processData: false,
            contentType: false,
            cache: false,
      url: "menyukaiController.php",
      type: "POST",
      enctype: 'multipart/form-data',
      success: function (data) {
        $('.isiData').load("menyukaiController.php");
        $('#tambahMenyukai').trigger("reset");
        $('#modalmenyukai').modal('hide')
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
<div class="modal fade" id="modalmenyukai">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="judulModal">Tambah menyukai</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="post" id="tambahMenyukai" enctype="multipart/form-data">
                <input type="hidden" id="id_menyukai" name="id_menyukai">
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
      <div class="modal fade" id="modalHapusMenyukai">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="judulModal">Apakah Anda yakin untuk menghapus data ini?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="post" id="hapusmenyukai" enctype="multipart/form-data">
                <input type="hidden" id="hid_menyukai" name="id_menyukai">
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