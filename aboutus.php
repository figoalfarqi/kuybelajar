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

    <title>KuyBelajar - About Us</title>

     <!-- My CSS -->
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
      /* AKHIR TULISAN LEMBUT NAMA (BESAR DAN KECIL) */
  </style>
</head>

<body>
<?php
        include('header.php');
        ?>
    
    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
            <img src="asset/kuybelajaricon.jpg" class="rounded-circle img-thumbnail" width = "25%" alt="Cinque Terre">
            <div class="fontKerasBesar mt-3">KuyBelajar</div>
            <div class="fontKeras lead">PTI 2019 A</div>
        </div>
    </div>
    
    <section id="tentangKami" class="tentangKami">
      <div class="container text-center">
          <div class="row">
              <div class="col mt-5 mb-5">
                  <div class="fontKerasBesar">About Us</div>
              </div>
          </div>
          <div class="row justify-content-center mb-4">
            <div class="col-md-5 mb-5">
              <div class="contohDeskripsi">kuybelajar adalah website yang berguna untuk para pelajar yang ingin menemukan guru dengan teknik mengajar yang mereka butuhkan.</div>
            </div>
            <div class="col-md-5 mb-5">
            <div class="contohDeskripsi">kuybelajar adalah website yang berguna untuk para pelajar yang ingin menemukan guru dengan teknik mengajar yang mereka butuhkan.</div>
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