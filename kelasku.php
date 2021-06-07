<?php
session_start();
                        include_once("config.php");
                        ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="font.css" rel="stylesheet">
    <link rel="icon" href="asset/kuybelajaricon.jpg">
    <title>Membuat Kelas - KuyBelajar</title>

    <style>
        html
        {
          min-height:100vh;
        }
        body
        {
          min-height: 100vh;
          position: relative;
          box-sizing: border-box;
          background-color: #f7f5f5;
          padding-bottom: 50px; //height of the footer
        }

        /* AWAL KARTU */
        .kartu
        {
            background-color: white;
        }
        .kepalaKartu
        {
            background-color: white;
            color: black;
        }
        .kakiKartu
        {
            background-color: white;
        }
        /* AKHIR KARTU */


        /* AWAL TOMBOL BUAT DAN KEMBALI */
        .tombolBuat
        {
          width: 100px;
        }
        .tombolBuat:hover
        {
          background-color: #2c8be4;
        }
        .tombolKembali
        {
          width: 100px;
        }
        .tombolKembali:hover
        {
          background-color: rgb(73, 73, 73);
        }
        /* AKHIR TOMBOL BUAT DAN KEMBALI */
    </style>
  </head>
  <body>
    <?php 
    include('header.php');
    ?>

    <section class="membuatKelas">
        <div class="container">
            <div class="card kartu mt-5">
                    <?php
                    $id_pengguna=$_SESSION["id_pengguna"];
                    $result = mysqli_query($mysqli, "SELECT * FROM kelass right join penggunas on kelass.id_pengguna=penggunas.id_pengguna where penggunas.id_pengguna='$id_pengguna'");
                    while($data_table = mysqli_fetch_array($result)) {
                      ?>
                <div class="card-header kepalaKartu fontKerasBesar">
                  <?php if( isset($data_table["id_kelas"])){
                  echo "Meperbarui Data Kelas";
                }
                else{
                  echo "Membuat Kelas Baru";
                }
                  ?>
                </div>
                <div class="card-body badanKelas">
                  <form action="kelaskuController.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="aksi" value="simpan"> 
                    <input type="hidden" name="id_pengguna" value="<?php echo $data_table["id_pengguna"] ?>">
                    <input type="hidden" name="id_kelas" value="<?php echo $data_table["id_kelas"] ?>"> 
                    <div class="form-group row">
                      <label for="namaKelas" class="col-sm-2 col-form-label fontKeras">Nama Kelas</label>
                      <div class="col-sm">
                        <input type="text" name="nama_kelas" class="form-control fontKeras" placeholder="Nama Kelas" id="namaKelas" value="<?php echo $data_table["nama_kelas"] ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="deskripsiKelas" class="col-sm-2 col-form-label fontKeras">Deskripsi Kelas</label>
                      <div class="col-sm">
                        <textarea name="deskripsi" class="form-control fontKeras" id="deskripsiKelas" placeholder="Deskripsi Kelas" rows="5" ><?php echo $data_table["deskripsi"] ?></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="fotoSampul" class="col-sm-2 col-form-label fontKeras">Foto Sampul</label>
                      <div class="col-sm">
                        <div class="custom-file pilihFotoSampul">
                          <input type="file" name="foto_sampul" class="custom-file-input" id="fotoSampul">
                          <label class="custom-file-label fontKeras" for="customFile">Pilih Foto</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="deskripsiKelas" class="col-sm-2 col-form-label fontKeras">Foto Saat Ini</label>
                      <div class="col-sm">
                        <?php if( $data_table["foto_sampul"]==""){
                          ?>
                        <label for="foto_sampulSampul" class="col-sm-5 col-form-label fontKeras">Belum Ada Foto Sampul</label>
                          <?php
                        } 
                        else{
                          ?>
                        <img src="admin/images/foto_sampul/<?php echo $data_table["foto_sampul"] ?>" class="img-thumbnail" width="50%">
                        <?php
                        }
                      
                      ?>
                      </div>
                    </div>
                </div>
                
                <div class="card-footer kakiKartu">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary float-right tombolBuat" data-toggle="modal" data-target="#staticBackdrop">
                    <?php if( isset($data_table["id_kelas"])){
                  echo "Edit";
                }
                else{
                  echo "Buat";
                }
                }
                  ?></button>
                  <a href="home.php">
                    <button type="button" class="btn btn-dark float-left tombolKembali">Kembali</button>
                  </a>
                  <!-- Modal -->
                  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Simpan Data</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Yakin Ingin Membuat Kelas?
                        </div>
                        <div class="modal-footer ">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </section>

    <?php
        include('footer.php');
        ?>

    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
  </body>
</html>