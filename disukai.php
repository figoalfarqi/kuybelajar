<?php
session_start();
                        include_once("config.php");
                        ?>
<!DOCTYPE html>
<html>
<head>
	<title>Disukai</title>
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
</head>

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

        /* AWAL KOTAK VIDEO DAN TULISAN */
        .kotakVideoTulisan
        {
          background-color:white;
        }
        /* AKHIR KOTAK VIDEO DAN TULISAN */
</style>

<body>
    <?php 
    include('header.php');
  ?>
  <div class="container mt-5">
    <div class="row mb-4 pt-4">
      <div class="col">
        <div class="fontKerasBesar">Video yang anda sukai</div>
      </div>
    </div>
  </div>
  <?php
    $id_pengguna=$_SESSION["id_pengguna"];
                  
                    $result = mysqli_query($mysqli, "SELECT  *,
                     postingans.deskripsi as deskripsi_postingan,
                     postingans.updated_at as tanggal_postingan
                    FROM postingans inner join kelass on kelass.id_kelas=postingans.id_kelas inner join menyukais on menyukais.id_postingan=postingans.id_postingan WHERE 
                    menyukais.id_pengguna = '$id_pengguna' 
                    order by menyukais.id_menyukai desc limit 10");
                    while($data_table = mysqli_fetch_array($result)) {
                      $video_deskripsi = $data_table["deskripsi_postingan"];
                      ?>
<section class="putar">
  <div class="container videoPutar" data-id='<?php echo $data_table["id_postingan"] ?>'>
    <div class="row mb-4 kotakVideoTulisan">
      <div class="col-5">
        <div class="card">
          <!-- VIDEO PUTAR -->
          <video controls>
            <source src="admin/images/video/<?php echo $data_table['video'] ?>" type="video/mp4" />
          </video>
        </div>
      </div>
      <div class="col-7">
        <div class="card-body">
          <!-- TULISAN BAWAH VIDEO PUTAR -->
          <div class="card-title mt-3 fontKeras"><?php echo $data_table["judul"] ?></div>
          <div class="card-subtitle mb-1 text-muted fontLembutBesar"><?php echo $data_table["nama_kelas"] ?></div>
          <?php 
            $id_postingan=$data_table["id_postingan"];
                $result2 = mysqli_query($mysqli, "SELECT sum(jumlah_menonton) as total_menonton FROM menontons where id_postingan=$id_postingan");
                      while($data_table2 = mysqli_fetch_array($result2)) {
                        $total_menonton=$data_table2['total_menonton'];
                      }
                    ?>
          <div class="card-subtitle mt-1 text-muted tontonTanggal fontLembutKecil"><?php echo $total_menonton;  ?> x ditonton | <?php echo $data_table["tanggal_postingan"] ?></div>
          <div class="card-titlle mt-5 contohDeskripsi"><?php echo $data_table["deskripsi_postingan"] ?></div>
        </div>
      </div>
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


