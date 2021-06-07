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
    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Halant:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="font.css" rel="stylesheet">
    <link rel="icon" href="asset/kuybelajaricon.jpg">
    <title>Kelas KuyBelajar</title>
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
        .contohDeskripsi
        {
          font-family: 'Nunito', sans-serif;
          font-size: 17px;
        }
        /* AKHIR TULISAN NAMA CHANNEL DAN DESKRIPSI */

        /* AWAL JUDUL, NAMA CHANNEL (LINK HREF) */
        .videoBelajarBesar
        {
          color: black;
        }
        .videoBelajarBesar:hover
        {
          cursor: pointer;
        }
        .videoBelajarKecil:hover
        {
          cursor: pointer;
          color: black;
        }
        /* AKHIR JUDUL, NAMA CHANNEL (LINK HREF) */

        /* AWAL VIDEO */
        .videoTerbaru
        {
          width: auto;
        }
        .videoKb
        {
          padding: 8px;
          
        }
        /* AWAL GAMBAR NAMA CHANNEL DI VIDEO TERBARU */
        .gambar
        {
          border-radius: 50%;
          margin-top: 3px;
          cursor: pointer;
        }
    </style>
  </head>
  <body>

  <?php 
    include('header.php');
  ?>
 <section class="jumbotron-bg ">
   <!-- <div class="jumbotron warna-bg text-black"> -->
    <div class="container" class="bg-container">
      <?php
                  $id_kelas=$_GET['id_kelas'];
                    $result = mysqli_query($mysqli, "SELECT * FROM kelass where id_kelas='$id_kelas'");
                    while($data_table = mysqli_fetch_array($result)) {
                    ?>
      <img src="admin/images/foto_sampul/<?php echo $data_table['foto_sampul'] ?>" class="d-block w-100" style="max-height: 400px;" />
      <div class="display-4 fontKerasBesar mt-3">SELAMAT DATANG</div>
      <div class="lead fontKeras mt-3">Di Kelas <?php echo $data_table["nama_kelas"] ?></div>
    </div>
  </section>

  <section class="putar">
    <div class="container mt-5">
      <div class="row">
        <div class="col-lg col-md col-sm mb-4">
          <!-- TULISAN BAWAH VIDEO PUTAR -->
          <div class="card-subtitle mb-3 fontLembutBesar">DESKRIPSI KELAS</div>
          <div class="card-subtitle mb-1 text-muted contohDeskripsi"><?php echo $data_table["deskripsi"] ?></div>
        </div>
      </div>
    </div>
  </section>
  
  <section class="videoTerbaru">
        <!-- GRID TULISAN VIDEO TERBARU -->
        <div class="container mt-5">
          <div class="row mb-4 pt-4">
            <div class="col fontKerasBesar">
              Video Terbaru
            </div>
          </div>

          <!-- GRID VIDEO -->
          <div class="row mb-5">
            <?php
                    $result = mysqli_query($mysqli, "SELECT * FROM postingans inner join kelass on kelass.id_kelas=postingans.id_kelas inner join penggunas on kelass.id_pengguna=penggunas.id_pengguna where postingans.id_kelas=$id_kelas order by id_postingan desc");
                    while($data_table = mysqli_fetch_array($result)) {
                      ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 videoKb">
              <div class="card videoPutar" data-id='<?php echo $data_table["id_postingan"] ?>'>
                <video controls>
                  <source src="admin/images/video/<?php echo $data_table['video'] ?>" type="video/mp4" />
                </video>
                <div class="card-body">
                    <div class="row">
                      <div class="col-3">
                        <img src="admin/images/foto_pengguna/<?php echo $data_table['foto'] ?>" width="50px" class="gambar">
                      </div>
                      <div class="col-9">
                        <div class="card-title fontKeras videoBelajarBesar"><?php echo $data_table["judul"] ?></div>
                        <div class="card-subtitle mb-1 fontLembutBesar videoBelajarKecil"><?php echo $data_table["nama_kelas"] ?></div>
                        <div class="card-subtitle mt-1 fontLembutKecil"><?php echo $data_table["updated_at"] ?></div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <?php
          }
            ?>
          </div>
        </div>
    </section>
  <?php
  }
        include('footer.php');
        ?>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script>
$(function () {
$('body').on('click', '.videoPutar', function () {
    var id_postingan = $(this).data('id');
    window.location.href = "putar.php?id_postingan="+id_postingan;
  });
});
</script>

    <!-- <script type="text/javascript" src="jquery-3.5.1.slim.min.js"></script>
    <script type="text/javascript" src="popper.min.js"></script>
    <script type="text/javascript" src="bootstrap.min.js"></script> -->
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  </body>
</html>