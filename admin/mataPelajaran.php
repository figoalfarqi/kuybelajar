<?php
include('auth.php');
$title = 'data mata pelajaran';
$menuMapel = 'active';
include 'master.php';
?>
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Mata Pelajaran</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="tabelData" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Mata Pelajaran</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                  </tr>
                  </thead>
                  <tbody class="isiData">
              </tbody>

                </table>
                <button id="btnTambah" type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#modalMapel">Tambah</button>
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
  $(document).ready(function(){
      $('.isiData').load("mataPelajaranController.php");
  });
$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
  });
  $('#tambahmapel').validate({
    rules: {
      nama_mapel: {
        required: true,
      },
    },
    messages: {
      email: {
        required: "Mohon masukkan nama mata pelajaran",
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
    $('#judulModal').html('Tambah Mata Plejaran');
    $('#tambahMapel').trigger("reset");
    $('#id_mapel').val("");
    $('#btnSimpan').html("Simpan");
  });

  $('body').on('click', '.btnEdit', function () {
    var id_mapel = $(this).data('id');
    $('#judulModal').html('Edit Mata Pelajaran');
    $('#btnSimpan').html("Edit");
    $.ajax({
        data: {
          'id_mapel': id_mapel,
        },
        url: "mataPelajaranController.php",
        type: "GET",
            success: function (data) {
              myObj = JSON.parse(data);
                $('#id_mapel').val(myObj.id_mata_pelajaran);
                $('#nama_mapel').val(myObj.nama_mata_pelajaran);
                $('#modalMapel').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
      
  });

  $('body').on('click', '.btnHapus', function () {

    var id_mapel = $(this).data("id");
    $.ajax({
        data: {
          'id_mapel': id_mapel,
        },
        url: "mataPelajaranController.php",
        type: "GET",
            success: function (data) {
              myObj = JSON.parse(data);
                $('#hid_mapel').val(myObj.id_mata_pelajaran);
                $('#hnama_mapel').val(myObj.nama_mata_pelajaran);
                $('#modalHapusMapel').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
  });
  $('#hbtnHapus').click(function (e) {
    var id_mapel = $("#hid_mapel").val();
    $.ajax({
        data: {
          'aksi': 'hapus',
          'id_mapel': id_mapel,
        },
        url: "mataPelajaranController.php",
        type: "POST",
            success: function (data) {
                $('#hapusMapel').trigger("reset");
                $('#modalHapusMapel').modal('hide');
                $('.isiData').load("mataPelajaranController.php");
                berhasilHapus();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
  });
  $('#btnSimpan').click(function (e) {
    e.preventDefault();
    nama_mata_pelajaran=$('#nama_mapel').val();
    id_mapel=$('#id_mapel').val();
    $.ajax({
      data: {
        'aksi': 'simpan',
        'id_mapel': id_mapel,
        'nama_mata_pelajaran': nama_mata_pelajaran,
      },
      url: "mataPelajaranController.php",
      type: "POST",
      success: function (data) {
        $('.isiData').load("mataPelajaranController.php");
        $('#tambahMapel').trigger("reset");
        $('#modalMapel').modal('hide');
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
      url: "{{ route('tabel-mata-pelajaran.index') }}",
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
<div class="modal fade" id="modalMapel">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="judulModal">Tambah Mata Pelajaran</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="tambahMapel">
                <input type="hidden" id="aksi" name="aksi" value="simpan">
                <input type="hidden" id="id_mapel" name="id_mapel">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Mata Pelajaran</label>
                    <div class="col-sm-10">
                      <input type="text" id="nama_mapel" name="nama_mapel" class="form-control" placeholder="Nama Mata Pelajaran">
                    </div>
                  </div>
                </div>
              </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="simpan" id="btnSimpan" style="margin-right: 0%;width:20%">Simpan</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="modalHapusMapel">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="judulModal">Apakah Anda yakin untuk menghapus data ini?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="post" id="hapusMapel">
                {{ csrf_field() }}
                <input type="hidden" id="hid_mapel" name="id_mapel">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Mata Pelajaran</label>
                    <div class="col-sm-10">
                      <input type="text" id="hnama_mapel" name="nama_mapel" class="form-control" disabled="">
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