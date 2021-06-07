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

    <!-- TULISAN DARI GOOGLE -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Halant:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="font.css" rel="stylesheet">
    <link rel="icon" href="asset/kuybelajaricon.jpg">
    <title>Profil - KuyBelajar</title>

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
        .tombolPerbarui
        {
          width: 100px;
        }
        .tombolPerbarui:hover
        {
          background-color: #2c8be4;
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
                <div class="card-header kepalaKartu fontKerasBesar">
                  Profil
                </div>
                <div class="card-body badanKelas">
                  <form action="userController.php" method="POST"  enctype="multipart/form-data">
                        <input type="hidden" name="aksi" value="simpan"> 
                    <?php
                    $id_pengguna=$_SESSION["id_pengguna"];
                    $result = mysqli_query($mysqli, "SELECT * FROM penggunas where id_pengguna='$id_pengguna' limit 1");
                    while($data_table = mysqli_fetch_array($result)) {
                      ?>
                    <div class="form-group row">
                      <label for="namaDepan" class="col-sm-2 col-form-label fontKeras">Nama Depan</label>
                      <div class="col-sm">
                        <input type="text" name="nama_depan" class="form-control fontKeras" placeholder="Nama Depan" value="<?php echo $data_table["nama_depan"] ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="namaBelakang" class="col-sm-2 col-form-label fontKeras">Nama Belakang</label>
                      <div class="col-sm">
                        <input type="text" name="nama_belakang" class="form-control fontKeras" placeholder="Nama Belakang" value="<?php echo $data_table["nama_belakang"] ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="nomorHp" class="col-sm-2 col-form-label fontKeras">Nomor Hp</label>
                      <div class="col-sm">
                        <input type="text" name="no_hp" name="" class="form-control fontKeras" placeholder="Nomor Hp" value="<?php echo $data_table["no_hp"] ?>" id="nomorHp">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="fotoPengguna" class="col-sm-2 col-form-label fontKeras">Foto Pengguna</label>
                      <div class="col-sm">
                        <div class="custom-file pilihfotoPengguna">
                          <input type="file" name="foto" class="custom-file-input" id="fotoPengguna">
                          <label class="custom-file-label fontKeras" for="customFile">Pilih Foto</label>
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="deskripsiKelas" class="col-sm-2 col-form-label fontKeras">Foto Saat Ini</label>
                      <div class="col-sm">
                        <?php if( $data_table["foto"]==""){
                          ?>
                        <label for="fotoPengguna" class="col-sm-2 col-form-label fontKeras">Belum Ada Foto</label>
                          <?php
                        } 
                        else{
                          ?>
                        <img src="admin/images/foto_pengguna/<?php echo $data_table["foto"] ?>" class="img-thumbnail" width="19%">
                        <?php
                        }
                      }
                      ?>
                      </div>
                    </div>
                  
                </div>
                
                <div class="card-footer kakiKartu">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary float-right tombolPerbarui" data-toggle="modal" data-target="#staticBackdrop">Perbarui</button>
                  <!-- <button type="button" class="btn btn-dark float-left tombolKembali" data-toggle="modal" data-target="#staticBackdrop">KEMBALI</button> -->
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
                          Yakin Ingin Memperbarui Profil?
                        </div>
                        <div class="modal-footer ">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-primary">Simpan</button>
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