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
    
    <title>Home - KuyBelajar</title>

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

        /* AWAL TULISAN SLIDESHOW*/
        .fontKerasBesarSlideshow
        {
          font-family: 'Halant', serif;
          font-weight: 600;
          font-size: 50px;
        }
        .fontLembutBesarSlideshow
        {
          font-family: 'Nunito', sans-serif;
          font-weight: 600;
          font-size: 30px;
        }
        /* AKHIR TULISAN SLIDESHOW */


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
        
        /* AKHIR VIDEO */

        /* AWAL GAMBAR NAMA CHANNEL DI VIDEO TERBARU */
        .gambar
        {
          border-radius: 50%;
          margin-top: 3px;
          cursor: pointer;
        }
        /* AKHIR GAMBAR NAMA CHANNEL DI VIDEO TERBARU */

        .slideDua .isiSlideDua
        {
          margin-top: -135px;
        }
    </style>
  </head>

  <body>
    <section class="slideShow">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner semuaSlide">
              <div class="carousel-item active slideSatu">
                <img src="mtk.png" class="d-block w-100" style="max-height: 300px;">
                <div class="carousel-caption d-none d-md-block text-left">
                  <div class="mb-5 fontKerasBesarSlideshow">Selamat Datang di KuyBelajar</div>
                  <div class="mb-5 fontLembutBesarSlideshow">Everywhere We Can Learning</div>
                </div>
              </div>
              <div class="carousel-item slideDua">
                <img src="kim.jpg" class="d-block w-100" style="max-height: 300px;">
                <div class="carousel-caption d-none d-md-block text-center">
                  <div class="fontLembutBesarSlideshow isiSlideDua">Temukan guru dengan metode belajar yang kamu sukai</div>
                </div>
              </div>
              <div class="carousel-item slideTiga">
                <img src="global.jpg" class="d-block w-100" style="max-height: 300px;">
                <div class="carousel-caption d-none d-md-block text-center">
                  <div class="mb-5 fontKerasBesarSlideshow">Belajar Nyaman Hanya di KuyBelajar</div>
                  <div class="mb-5 fontLembutBesarSlideshow">Dimana saja dan kapan saja</div>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev tombolKiri" href="#carouselExampleCaptions" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next tombolKanan" href="#carouselExampleCaptions" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    <?php
        include('header.php');
        ?>

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
                    
                    $result = mysqli_query($mysqli, "SELECT * FROM postingans inner join kelass on kelass.id_kelas=postingans.id_kelas inner join penggunas on kelass.id_pengguna=penggunas.id_pengguna order by id_postingan desc limit 12");
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
                        <div class="card-subtitle mt-1 text-muted fontLembutKecil"><?php echo $data_table["updated_at"] ?></div>
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
    <section class="videoTerbaru">
        <!-- GRID TULISAN VIDEO TERBARU -->
        <div class="container mt-5">
          <div class="row mb-4 pt-4">
            <div class="col fontKerasBesar">
              Video Matematika
            </div>
          </div>

          <!-- GRID VIDEO -->
          <div class="row mb-5">
            <?php
                    
                    $result = mysqli_query($mysqli, "SELECT * FROM postingans inner join kelass on kelass.id_kelas=postingans.id_kelas inner join penggunas on kelass.id_pengguna=penggunas.id_pengguna where postingans.id_mata_pelajaran=25 order by id_postingan desc limit 12");
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
                        <div class="card-subtitle mt-1 text-muted fontLembutKecil"><?php echo $data_table["updated_at"] ?></div>
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