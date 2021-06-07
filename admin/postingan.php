<?php
include('auth.php');
$title = 'data postingan';
$menuPostingan = 'active';
include 'master.php';
?>
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Postingan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabelData" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Nama Mata Pelajaran</th>
                    <th>Judul</th>
                    <th>Kelas</th>
                    <th>Deskripsi</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                  </tr>
                  </thead>
                  <tbody class="isiData">
                  </tbody>
                </table>
                <button id="btnTambah" type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#modalpostingan">Tambah</button>
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
  $('.isiData').load("postinganController.php");
  $.validator.setDefaults({
    submitHandler: function () {
    }
  });
  $('#tambahPostingan').validate({
    rules: {
      judul: {
        required: true,
      },
    },
    messages: {
      judul: {
        required: "Mohon masukkan judul",
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
    ambilKelas(0);
    ambilMata_pelajaran(0);
    $('#judulModal').html('Tambah postingan');
    $('#tambahPostingan').trigger("reset");
    $('#id_postingan').val("");
    $('#btnSimpan').html("Simpan");
    $('#fotosi').html("");
  });

  $('body').on('click', '.btnEdit', function () {
    var id_postingan = $(this).data('id');
    $('#judulModal').html('Edit postingan');
    $('#btnSimpan').html("Edit");
    $.ajax({
      data: {
        'id_postingan': id_postingan,
      },
      url: "postinganController.php",
      type: "GET",
        success: function (data) {
          myObj = JSON.parse(data);
      ambilKelas(myObj.id_kelas);
      ambilMata_pelajaran(myObj.id_mata_pelajaran);
      $('#id_postingan').val(myObj.id_postingan);
      $('#judul').val(myObj.judul);
      $('#kelas').val(myObj.kelas);
      $('#deskripsi').val(myObj.deskripsi);
      var fotosi='<div class="form-group row"> <label class="col-sm-2 col-form-label">Video saat ini</label> <div class="col-sm-10"><div class="custom-file"><img src="images/video/'+myObj.video+'" style="margin-bottom: 100px;height:100px;max-width:600px"></div></div></div>';
      $('#fotosi').html(fotosi);
      $('#modalpostingan').modal('show');
      },
        error: function (data) {
          console.log('Error:', data);
      },
    });
  });

  $('body').on('click', '.btnHapus', function () {
    var id_postingan = $(this).data("id");
    $.ajax({
      data: {
        'id_postingan': id_postingan,
      },
      url: "postinganController.php",
      type: "GET",
        success: function (data) {
          myObj = JSON.parse(data);
      ambilKelas(myObj.id_kelas);
      ambilMata_pelajaran(myObj.id_mata_pelajaran);
      $('#hid_postingan').val(myObj.id_postingan);
      $('#hjudul').val(myObj.judul);
      $('#hkelas').val(myObj.kelas);
      $('#hdeskripsi').val(myObj.deskripsi);
      $('#modalHapusPostingan').modal('show');
      },
        error: function (data) {
          console.log('Error:', data);
      },
    });
  });
  $('#hbtnHapus').click(function (e) {
    var id_postingan = $("#hid_postingan").val();
    $.ajax({
            data: {
                'aksi': 'hapus',
                'id_postingan': id_postingan,
            },
            type: "POST",
            url: "postinganController.php",
            success: function (data) {
                $('#hapusPostingan').trigger("reset");
                $('#modalHapusPostingan').modal('hide');
                berhasilHapus();
                $('.isiData').load("postinganController.php");
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
  });
  $("#tambahPostingan").submit(function(e){
    e.preventDefault();
    $.ajax({
      data: new FormData(this),
      processData: false,
            contentType: false,
            cache: false,
      url: "postinganController.php",
      type: "POST",
      enctype: 'multipart/form-data',
      success: function (data) {
        $('.isiData').load("postinganController.php");
        $('#tambahPostingan').trigger("reset");
        $('#modalpostingan').modal('hide')
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
      url: "{{ route('tabel-postingan.index') }}",
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
  function ambilKelas(id){
    var id_kelas = id;
    $.ajax({
      data: {
        'id_kelas':id_kelas,
        'aksi': 'ambil_kelas',
      },
      url: "postinganController.php",
      type: "GET",
      success: function (data) {
          $('#id_kelas').html(data);
          $('#hid_kelas').html(data);
      },
      error: function (data) {
        console.log('Error:', data);
      },
    });
  };
  function ambilMata_pelajaran(id){
    var id_mata_pelajaran = id;
    $.ajax({
      data: {
        'id_mata_pelajaran':id_mata_pelajaran,
        'aksi': 'ambil_mata_pelajaran',
      },
      url: "postinganController.php",
      type: "GET",
      success: function (data) {
          $('#id_mata_pelajaran').html(data);
          $('#hid_mata_pelajaran').html(data);
      },
      error: function (data) {
        console.log('Error:', data);
      },
    });
  }
});

</script>



<!-- ./wrapper -->
<div class="modal fade" id="modalpostingan">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="judulModal">Tambah postingan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="post" id="tambahPostingan" enctype="multipart/form-data">
                <input type="hidden" id="id_postingan" name="id_postingan">
                <input type="hidden" id="aksi" name="aksi" value="simpan">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Kelas</label>
                    <div class="col-sm-10">
                      <select class="form-control select2bs4" style="width: 100%;" id="id_kelas" name="id_kelas">
                        
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Mata Pelajaran</label>
                    <div class="col-sm-10">
                      <select class="form-control select2bs4" style="width: 100%;" id="id_mata_pelajaran" name="id_mata_pelajaran">
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                      <input type="text" id="judul" name="judul" class="form-control" placeholder="Judul">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kelas</label>
                    <div class="col-sm-10">
                      <select class="form-control select2bs4" style="width: 100%;" id="kelas" name="kelas">
                        <option selected="selected">1 SD</option>
                        <option>2 SD</option>
                        <option>3 SD</option>
                        <option>4 SD</option>
                        <option>5 SD</option>
                        <option>Texas</option>
                        <option>Washington</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                      <input type="text" id="deskripsi" name="deskripsi" class="form-control" placeholder="Deskripsi">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Video</label>
                    <div class="col-sm-10">
                      <div class="custom-file">
                        <input type="file" name ="video" class="custom-file-input" id="video">
                        <label class="custom-file-label" for="foto">Choose file</label>
                      </div>
                    </div>
                  </div>
                  <div id="fotosi">
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
      <div class="modal fade" id="modalHapusPostingan">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="judulModal">Apakah Anda yakin untuk menghapus data ini?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="post" id="hapusPostingan" enctype="multipart/form-data">
                <input type="hidden" id="hid_postingan" name="id_postingan">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Kelas</label>
                    <div class="col-sm-10">
                      <select class="form-control select2bs4" style="width: 100%;" id="hid_kelas" name="id_kelas"  disabled="">
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Mata Pelajaran</label>
                    <div class="col-sm-10">
                      <select class="form-control select2bs4" style="width: 100%;" id="hid_mata_pelajaran" name="id_mata_pelajaran"  disabled="">
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                      <input type="text" id="hjudul" name="judul" class="form-control" disabled="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kelas</label>
                    <div class="col-sm-10">
                      <input type="text" id="hkelas" name="kelas" class="form-control" disabled="">
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