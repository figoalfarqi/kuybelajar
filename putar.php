<?php
session_start();
if (!isset($_SESSION["id_pengguna"])) {
  header("Location:home.php?buka=harusLogin");
}
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
    <title>Putar Video - KuyBelajar</title>

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
        /* AWAL LIKE */
        .sukaVideo
        {
          cursor: pointer;
          margin-left: 30%;
          margin-right: 5px;
        }
        .sukaVideo:hover
        {
          opacity: 70%;
        }
        /* AKHIR LIKE */

        
        .contohDeskripsi
        {
          font-family: 'Nunito', sans-serif;
          font-size: 17px;
        }
        /* AKHIR TULISAN LEMBUT NAMA (BESAR DAN KECIL) */

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
        .videoSelanjutnya
        {
          width: auto;
        }
        .videoKb
        {
          padding: 8px;
        }
        /* AKHIR VIDEO */

        .batas
        {
          background-color: rgb(204, 202, 202);
          height: 3px;
        }

        /* AWAL BIODATA CHANNEL */
        .tombolIkuti
        {
          background-color: #2c8be4;
          color: white;
          width: 100px;
        }
        .tombolIkuti:hover
        {
          background-color: #5ffae0;
        }
        .gambar
        {
          border-radius: 50%;
          margin-top: 3px;
          cursor: pointer;  
        }
        .bioChannel
        {
          top: -12px;
          vertical-align: top;
        }
        /* AKHIR BIODATA CHANNEL */

        .tombolBuat
        {
          width: 100px;
        }
        .tombolBuat:hover
        {
          background-color: #2c8be4;
        }
        .formTombolBuat
        {
          width:500px;
        }

        .formMasukkanKomentar .masukkanKomentar
        {
          width: 85%;
        }
    </style>

   
  </head>

  <body>
    <?php
    include('header.php');
    $id_postingan=$_GET['id_postingan'];
                    $id_pengguna=$_SESSION["id_pengguna"];
                    $result = mysqli_query($mysqli, "SELECT *, postingans.deskripsi as deskripsi_video FROM postingans inner join kelass on kelass.id_kelas=postingans.id_kelas where id_postingan='$id_postingan'");
                    while($data_table = mysqli_fetch_array($result)) {
                      $id_kelas=$data_table["id_kelas"];
                      ?>
                      <input type="hidden" name="id_postingan" id="id_postingan" value="<?php echo $id_postingan ?>">
                      <input type="hidden" name="id_pengguna" id="id_pengguna" value="<?php echo $id_pengguna ?>">
    <section class="putar">
      <div class="container mt-5">
          <div class="mb-4">
            <!-- VIDEO PUTAR -->
            <div class="card">
              <video controls>
              <source src="admin/images/video/<?php echo $data_table["video"] ?>" type="video/mp4" />
              </video>
            </div>
            <!-- TULISAN BAWAH VIDEO PUTAR -->
            <div class="card-title mt-3 fontKeras"><?php echo $data_table["judul"] ?></div>
            <div class="row">
              <?php 
              $result = mysqli_query($mysqli, "SELECT sum(jumlah_menonton) as total_menonton FROM menontons where id_postingan=$id_postingan");
                    while($data_table2 = mysqli_fetch_array($result)) {
                      $total_menonton=$data_table2['total_menonton'];
                    }
                    $result = mysqli_query($mysqli, "SELECT count(*) as total_like FROM menyukais where id_postingan=$id_postingan");
                    while($data_table3 = mysqli_fetch_array($result)) {
                      $total_like=$data_table3['total_like'];
                    }
                      ?>
              <div class="card-subtitle mt-1 text-muted fontLembutKecil col-md-6"><span id="jumlah_menonton"><?php echo $total_menonton ?></span> x ditonton | <?php echo $data_table["updated_at"] ?></div>
                <div class="col-md-6">

                  <img src="suka.png" width="23px" class="sukaVideo" id="tambah_like">
                  <span class="menyukaiVideo fontLembutBesar" id="jumlah_like"><?php echo $total_like ?></span>
                  <span class="ml-3 fontLembutBesar komentarPutar" data-toggle="modal" data-target="#modalKomentar">Komentar</span>
                </div>
            </div>
          </div>
      </div>
        <!-- KOMENTAR -->
          <div class="modal fade" id="modalKomentar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title fontKerasBesar">KOMENTAR</div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <?php
                  $result = mysqli_query($mysqli, "SELECT * FROM komentars where id_postingan='$id_postingan'");
                    while($data_table3 = mysqli_fetch_array($result)) {
                      ?>
                        <div class="media mt-3">
                          <img src="madelin.jpeg" class="mr-3 gambar" width="50px">
                          <div class="media-body fontLembutBesar">
                            <div class="fontKeras mt-3 mb-3">Madelin</div>
                            <?php echo $data_table3['isi_komentar']; ?>
                          </div>
                        </div>
                      <?php
                    }
                  ?>
                  <div class="media mt-3">
                    <img src="madelin.jpeg" class="mr-3 gambar" width="50px">
                    <div class="media-body fontLembutBesar">
                      <div class="fontKeras mt-3 mb-3">Madelin</div>
                      Wah aku jadi bisa menjawab soal dengan cepat
                    </div>
                  </div>
                  <div class="media mt-3">
                    <img src="sonia.jpg" class="mr-3 gambar" width="50px">
                    <div class="media-body fontLembutBesar">
                      <div class="fontKeras mt-3 mb-3">Sonia</div>
                      Keren videonya sangat mengedukasi
                    </div>
                  </div>
                  <div class="media mt-3">
                    <img src="figo.jpg" class="mr-3 gambar" width="50px">
                    <div class="media-body fontLembutBesar">
                      <div class="fontKeras mt-3 mb-3">Figo</div>
                      Setelah menonton video dari KuyBelajar aku selalu dapat nilai 100
                    </div>
                  </div>
                  <div class="media mt-3">
                    <img src="zada.jpg" class="mr-3 gambar" width="50px">
                    <div class="media-body fontLembutBesar">
                      <div class="fontKeras mt-3 mb-3">Zada</div>
                      Gak bakal nyesel deh belajar dari web KuyBelajar
                    </div>
                  </div>
                  <form class="mt-5 mb-3 form-inline formMasukkanKomentar" id="komen">
                    <input type="text" class="form-control fontKeras mr-sm-2 masukkanKomentar" width="500px" placeholder="Komentar Anda" name="isiKomen" id="isiKomen">
                    <button class="btn btn-primary float-right tombolBuat my-2 my-sm-0" type="submit">KIRIM</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
    </section>

    <section class="garisPembatas">
      <div class="container">
        <div class="batas"></div>
      </div>
    </section>

    <section class="namaChannel">
      <div class="container mt-4">
        <div class="row">
          <div class="col-1">
            <a href="#" style="text-decoration: none;">
              <?php
                    $result = mysqli_query($mysqli, "SELECT * FROM kelass right join penggunas on kelass.id_pengguna=penggunas.id_pengguna where kelass.id_kelas='$id_kelas'");
                    while($data_table5 = mysqli_fetch_array($result)) {
                      $foto=$data_table5['foto'];
                    }
                    ?>
              <img src="admin/images/foto_pengguna/<?php echo $foto ?>" width="50px" class="gambar">
            </a>
          </div>
          <div class="col-9 bioChannel">
            <a href="kelas.php?id_kelas=<?php echo $data_table["id_kelas"] ?>" style="text-decoration: none;">
              <div class="mt-3 fontKeras videoBelajarBesar"><?php echo $data_table["nama_kelas"] ?></div>
            </a>
              <div class="mb-1 text-muted fontLembutBesar">1 M Pengikut</div>
          </div>
          <div class="col-2 text-right">
            <button type="button" class="btn tombolIkuti" id="tombolIkuti">IKUTI</button>
          </div>
        </div>
      </div>
    </section>

    <section class="deskripsiChannel">
      <div class="container">
        <div class="row">
          <div class="col mt-5 contohDeskripsi">
            <p><?php echo $data_table["deskripsi_video"] ?>.</p>
          </div>
        </div>
      </div>
    </section>
<?php
}
  ?>

    <section class="videoSelanjutnya">
        <!-- GRID TULISAN VIDEO SELANJUTNYA -->
        <div class="container mt-5">
          <div class="row mb-4 pt-4">
            <div class="col fontKerasBesar">
              Video Selanjutnya
            </div>
          </div>
          <!-- GRID VIDEO SELANJUTNYA-->
          <div class="row mb-5">
            <div class="row mb-5">
            <?php
                    
                    $result = mysqli_query($mysqli, "SELECT * FROM postingans inner join kelass on kelass.id_kelas=postingans.id_kelas order by id_postingan desc limit 8");
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
                        <img src="logo kB-1.jpg" width="50px" class="gambar">
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
              Video Terbaru
            </div>
          </div>
          <!-- GRID VIDEO -->
          <div class="row mb-5">
            <?php
                    
                    $result = mysqli_query($mysqli, "SELECT * FROM postingans inner join kelass on kelass.id_kelas=postingans.id_kelas order by id_postingan desc limit 12");
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
                        <img src="logo kB-1.jpg" width="50px" class="gambar">
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
  tambahMenonton();
  $('body').on('click', '.videoPutar', function () {
    var id_postingan = $(this).data('id');
    window.location.href = "putar.php?id_postingan="+id_postingan;
  });
   $('#tombolIkuti').click(function (e) {
    var tombolIkuti = $("#tombolIkuti").html();
    if(tombolIkuti=="IKUTI"){
      $("#tombolIkuti").html("DI IKUTI");
    }
    else{
      $("#tombolIkuti").html("IKUTI");
    }
   });

  $('#tambah_like').click(function (e) {
    var jumlah_like = $("#jumlah_like").html();
    var id_postingan = $("#id_postingan").val();
    var id_pengguna = $("#id_pengguna").val();
    $.ajax({
            data: {
                'aksi': 'tambahMenyukai',
                'id_postingan': id_postingan,
                'id_pengguna': id_pengguna,
            },
            type: "POST",
            url: "putarController.php",
            success: function (data) {
               myObj = JSON.parse(data);
                if(myObj=="hapus"){
                  $("#jumlah_like").html(parseInt(jumlah_like)-1);
                }
                else{
                  $("#jumlah_like").html(parseInt(jumlah_like)+1);
                }
            },
            error: function (data) {
                console.log('Error:', data);
            },
        });
  });
  $("#komen").submit(function(e){
    e.preventDefault();

    var id_postingan = $("#id_postingan").val();
    var id_pengguna = $("#id_pengguna").val();
    var isiKomen = $("#isiKomen").val();
    $.ajax({
      data: {
                'id_postingan': id_postingan,
                'id_pengguna': id_pengguna,
                'isiKomen': isiKomen,
            },
      type: "POST",
      url: "putarController.php",
      success: function (data) {
        $('#komen').trigger("reset");
          alert(data);
      },
      error: function (data) {
        alert("Data gagal disimpan");
      }
    });
  });


  function tambahMenonton(){
    var id_postingan = $("#id_postingan").val();
    var id_pengguna = $("#id_pengguna").val();
    $.ajax({
            data: {
                'aksi': 'tambahMenonton',
                'id_postingan': id_postingan,
                'id_pengguna': id_pengguna,
            },
            type: "POST",
            url: "putarController.php",
            success: function (data) {
                
            },
            error: function (data) {
                console.log('Error:', data);
            },
        });
    };
});
</script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
   <!--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
  </body>
</html>