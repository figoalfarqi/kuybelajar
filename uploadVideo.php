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
    <title>Upload Video Pembelajaran - KuyBelajar</title>

    <style>
        body
        {
          background-color: #f7f5f5;
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

        /* AWAL TULISAN */
        

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
    <?php include("header.php");
    ?>


    <section class="membuatKelas">
        <div class="container">
            <div class="card kartu mt-5">
                  <?php
                  $id_pengguna=$_SESSION["id_pengguna"];
                  $result = mysqli_query($mysqli, "SELECT * FROM kelass inner join penggunas on kelass.id_pengguna=penggunas.id_pengguna where penggunas.id_pengguna='$id_pengguna'");
                    while($data_table = mysqli_fetch_array($result)) {
                      $id_kelas=$data_table["id_kelas"];
                      $id_postingan="";
                      if(isset($_GET["id_postingan"])){
                        $id_postingan=$_GET["id_postingan"] ;
                      }
                      ?>
                      <div class="card-header kepalaKartu fontKerasBesar">
                  <?php if( $id_postingan==""){
                    $id_mata_pelajaran="";
                    $judul="";
                    $kelas="";
                    $deskripsi="";
                    $video="";
                  echo "Upload Video Pembelajaran";
                }
                else{
                  $result = mysqli_query($mysqli, "SELECT * FROM postingans where id_postingan='$id_postingan'");
                  while($data_table2 = mysqli_fetch_array($result)) {
                      $id_mata_pelajaran=$data_table2['id_mata_pelajaran'];
                      $judul=$data_table2['judul'];
                      $kelas=$data_table2['kelas'];
                      $deskripsi=$data_table2['deskripsi'];
                      $video=$data_table2['video'];
                  }
                  echo "Perbarui Video Pembelajaran";
                }
              }
                  ?>
                </div>
                <div class="card-body badanKelas">
                  <form action="postinganController.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="aksi" value="simpan"> 
                    <input type="hidden" name="id_kelas" value="<?php echo $id_kelas ?>"> 
                    <input type="hidden" name="id_postingan" value="<?php echo $id_postingan ?>">
                    <div class="form-group row">
                      <label for="mataPelajaran" class="col-sm-2 col-form-label fontKeras">Mata Pelajaran</label>
                      <div class="col-sm">
                      <select class="form-control fontKeras" name="id_mata_pelajaran">
                        <?php
                      $result = mysqli_query($mysqli, "SELECT * FROM mata_pelajarans ORDER BY id_mata_pelajaran DESC");
                      while($data_table = mysqli_fetch_array($result)) {
                        if($data_table['id_mata_pelajaran']==$id_mata_pelajaran){
                          echo "<option value=".$data_table['id_mata_pelajaran']." selected>".$data_table['nama_mata_pelajaran']."</option>";
                        }
                        else{
                          echo  "<option value=".$data_table['id_mata_pelajaran'].">".$data_table['nama_mata_pelajaran']."</option>";
                        }                
                      }
                      ?>
                      </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="judulKelas" class="col-sm-2 col-form-label fontKeras">Judul</label>
                      <div class="col-sm">
                        <input type="text"  name="judul" class="form-control fontKeras" placeholder="Judul" id="judulKelas" value="<?php echo $judul ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Kelas" class="col-sm-2 col-form-label fontKeras">Kelas</label>
                      <div class="col-sm">
                        <select class="form-control fontKeras" name="kelas">
                        <option>3 SMA</option>
                        <option>2 SMA</option>
                        <option>1 SMA</option>
                        <option>3 SMP</option>
                        <option>2 SMP</option>
                        <option>1 SMP</option>
                        <option>6 SD</option>
                        <option>5 SD</option>
                        <option>4 SD</option>
                        <option>3 SD</option>
                        <option>2 SD</option>
                        <option>1 SD</option>
                        <option>UMUM</option>
                      </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="deskripsi" class="col-sm-2 col-form-label fontKeras">Deskripsi</label>
                      <div class="col-sm">
                        <textarea  name="deskripsi" class="form-control fontKeras" id="deskripsiKelas" rows="3" placeholder="Deskripsi Kelas"><?php echo $deskripsi ?></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="videoPembelajaran" class="col-sm-2 col-form-label fontKeras">Video Pembelajaran</label>
                      <div class="col-sm">
                        <div class="custom-file pilihVideoPembelajaran">
                          <input type="file" class="custom-file-input" name="video" id="videoPembelajaran">
                          <label class="custom-file-label fontKeras" for="customFile">Pilih Video</label>
                        </div>
                      </div>
                    </div>
                        <?php if( !$video==""){
                          ?>
                    <div class="form-group row">
                      <label for="Video" class="col-sm-2 col-form-label fontKeras">Video Saat Ini</label>
                      <div class="col-sm">
                        <video controls>
                  <source src="admin/images/video/<?php echo $video ?>" type="video/mp4" />
                </video>
                      </div>
                    </div>
                        <?php
                        }
                      
                      ?>
                  
                </div>
                
                <div class="card-footer kakiKartu">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary float-right tombolBuat" data-toggle="modal" data-target="#staticBackdrop">BUAT</button>
                  <a href="postingan.php">
                    <button type="button" class="btn btn-dark float-left tombolKembali">KEMBALI</button>
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
                          Yakin Ingin Mengupload Video Ini?
                        </div>
                        <div class="modal-footer ">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-success">Upload</button>
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