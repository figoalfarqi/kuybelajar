<?php
include('auth.php');
$title = 'data pengguna';
$menuSlideshow = 'active';
include 'master.php';
?>
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Slideshow</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabelData" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Sub Judul</th>
                    <th>Isi</th>
                    <th>Tombol Teks</th>
                    <th>Tombol Url</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                  </tr>
                  </thead>
                  <tbody class="isiData">
                  </tbody>
                </table>
                <button id="btnTambah" type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#modalSlideshow">Tambah</button>
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
  $('.isiData').load("slideshowController.php");
  $.validator.setDefaults({
    submitHandler: function () {
      // alert( "Form successful submitted!" );
    }
  });
  $('#tambahSlideshow').validate({
    rules: {
      judul: {
        required: true,
      },
    },
    messages: {
      judul: {
        required: "Mohon masukkan alamat judul",
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
    $('#judulModal').html('Tambah Slideshow');
    $('#tambahSlideshow').trigger("reset");
    $('#id_slideshow').val("");
    $('#btnSimpan').html("Simpan");
    $('#fotosi').html("");
  });

  $('body').on('click', '.btnEdit', function () {
    var id = $(this).data('id');
    $('#judulModal').html('Edit Slideshow');
    $('#btnSimpan').html("Edit");
    var id_slideshow = $(this).data("id");
    $.ajax({
      data: {
        'id_slideshow': id_slideshow,
      },
      url: "slideshowController.php",
      type: "GET",
        success: function (data) {
          myObj = JSON.parse(data);
          $('#id_slideshow').val(myObj.id_slideshow);
          $('#judul').val(myObj.judul);
          $('#subjudul').val(myObj.subjudul);
          $('#isi').val(myObj.isi);
          $('#tombol_teks').val(myObj.tombol_teks);
          $('#tombol_url').val(myObj.tombol_url);
          var fotosi='<div class="form-group row"> <label class="col-sm-2 col-form-label">Gambar Saat ini</label> <div class="col-sm-10"><div class="custom-file"><img src="images/gambar_slideshow/'+myObj.gambar+'" style="margin-bottom: 100px;height:100px;max-width:600px"></div></div></div>';
          $('#fotosi').html(fotosi);
          $('#modalSlideshow').modal('show');
        },
        error: function (data) {
          console.log('Error:', data);
        },
    });
  });

  $('body').on('click', '.btnHapus', function () {
    var id_slideshow = $(this).data("id");
    $.ajax({
      data: {
        'id_slideshow': id_slideshow,
      },
      url: "slideshowController.php",
      type: "GET",
      success: function (data) {
        myObj = JSON.parse(data);
          $('#hid_slideshow').val(myObj.id_slideshow);
          $('#hjudul').val(myObj.judul);
          $('#hsubjudul').val(myObj.subjudul);
          $('#hisi').val(myObj.isi);
          $('#htombol_teks').val(myObj.tombol_teks);
          $('#htombol_url').val(myObj.tombol_url);
          $('#modalHapusSlideshow').modal('show');
      },
      error: function (data) {
        console.log('Error:', data);
      },
    });
  });
  $('#hbtnHapus').click(function (e) {
    var id_slideshow = $("#hid_slideshow").val();
    $.ajax({
            data: {
                'aksi': 'hapus',
                'id_slideshow': id_slideshow,
            },
            type: "POST",
            url: "slideshowController.php",
            success: function (data) {
                $('#hapusSlideshow').trigger("reset");
                $('#modalHapusSlideshow').modal('hide');
                $('.isiData').load("slideshowController.php");
                berhasilHapus();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
  });
  $("#tambahSlideshow").submit(function(e){
    e.preventDefault();
    $.ajax({
      data: new FormData(this),
      processData: false,
            contentType: false,
            cache: false,
      url: "slideshowController.php",
      type: "POST",
      enctype: 'multipart/form-data',
      success: function (data) {
        $('.isiData').load("slideshowController.php");
        $('#tambahSlideshow').trigger("reset");
        $('#modalSlideshow').modal('hide');
        $('.isiData').load("slideshowController.php");
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
      url: "{{ route('tabel-slideshow.index') }}",
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
<div class="modal fade" id="modalSlideshow">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="judulModal">Tambah Slideshow</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="post" id="tambahSlideshow" enctype="multipart/form-data">
                <input type="hidden" id="id_slideshow" name="id_slideshow">
                <input type="hidden" id="aksi" name="aksi" value="simpan">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                      <div class="custom-file">
                        <input type="file" name ="gambar" class="custom-file-input" id="gambar">
                        <label class="custom-file-label" for="gambar">Choose file</label>
                      </div>
                    </div>
                  </div>
                  <div id="fotosi">
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                      <input type="text" id="judul" name="judul" class="form-control" placeholder="Judul">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Subjudul</label>
                    <div class="col-sm-10">
                      <input type="subjudul" id="subjudul" name="subjudul" class="form-control" placeholder="Subjudul">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Isi</label>
                    <div class="col-sm-10">
                      <input type="text" id="isi" name="isi" class="form-control" placeholder="Isi">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tombol Teks</label>
                    <div class="col-sm-10">
                      <input type="text" id="tombol_teks" name="tombol_teks" class="form-control" placeholder="Tombol Teks">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tombol Url</label>
                    <div class="col-sm-10">
                      <input type="text" id="tombol_url" name="tombol_url" class="form-control" placeholder="Tombol Url">
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
      <div class="modal fade" id="modalHapusSlideshow">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="judulModal">Apakah Anda yakin untuk menghapus data ini?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="post" id="hapusSlideshow" enctype="multipart/form-data">
                <input type="hidden" id="hid_slideshow" name="id_slideshow">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">judul</label>
                    <div class="col-sm-10">
                      <input type="judul" id="hjudul" name="judul" class="form-control" disabled="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">subJudul</label>
                    <div class="col-sm-10">
                      <input type="text" id="hsubjudul" name="subjudul" class="form-control" disabled="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Isi</label>
                    <div class="col-sm-10">
                      <input type="text" id="hisi" name="isi" class="form-control" disabled="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tombol Teks</label>
                    <div class="col-sm-10">
                      <input type="text" id="htombol_teks" name="tombol_teks" class="form-control"  disabled="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tombol Url</label>
                    <div class="col-sm-10">
                      <input type="text" id="htombol_url" name="tombol_url" class="form-control"  disabled="">
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