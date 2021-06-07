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
    <title>KuyBelajar - Contact Us</title>
<style type="text/css">
         html
        {
          min-height:100vh;
        }
        body
        {
          min-height: 100vh;
          position: relative;
          background-color: #f7f5f5;
          padding-bottom: 50px; //height of the footer
        }
</style>
</head>
  
  <body>
    <?php
            include('header.php');
            ?>

    <section id="hubungiKami" class="hubungiKami mb-4">
      <div class="container mt-5">
        <div class="row">
          <div class="col text-center">
              <div class="fontKerasBesar mb-5">Contact Us</div>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-md-4">
            <div class="card text-white mb-3 text-center bg-secondary">
              <div class="card-body">
                <div class="card-title fontKeras">Hubungi</div>
                <div class="card-text fontKeras">Nomor Telepon</div>
              </div>
            </div>
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="fontKerasBesar">Lokasi</div>
                </li>
                <li class="list-group-item fontKeras">Surabaya</li>
                <li class="list-group-item fontKeras">Jawa Timur, Indonesia</li>
            </ul>
          </div>
          <div class="col-md-6">
            <form>
              <div class="form-group">
                <label for="nama" class="fontKeras">Nama</label>
                <input type="text" class="form-control fontKeras" id="nama" placeholder="Masukkan Nama Anda">
              </div>
              <div class="form-group">
                <label for="email" class="fontKeras">Email</label>
                <input type="text" class="form-control fontKeras" id="email" placeholder="Masukkan Email Anda">
              </div>
              <div class="form-group">
                <label for="pesan" class="fontKeras">Pesan Anda</label>
                <textarea name="pesan" id="pesan" class="form-control fontKeras" placeholder="Masukkan Pesan Anda"></textarea>
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-primary">Kirim Pesan</button>
              </div>
            </form>
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