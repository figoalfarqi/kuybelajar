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
    <title>Awal - KuyBelajar</title>

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

        /* AWAL TOMBOL UPLOAD */
        .tombolUpload
        {
          color: white;
          background-color: rgb(37, 158, 37);
        }
        .tombolUpload:hover
        {
          background-color: #2ce435;
        }
        /* AKHIR TOMBOL UPLOAD */


        /* AWAL TOMBOL EDIT DAN HAPUS */
        .tombolEdit
        {
          width: 100%;
        }
        .tombolEdit:hover
        {
          color: black;
          background-color: #2c8be4;
        }
        .tombolHapus
        {
          width: 100%;
        }
        .tombolHapus:hover
        {
          color: black;
          background-color: rgb(231, 66, 66);
        }
        /* AKHIR TOMBOL EDIT DAN HAPUS */
    </style>
  </head>
  <body>
    <?php include("header.php");
    ?>

    <section class="tabelData">
        <div class="container-fluid">
            <div class="card kartu mt-5">
                <div class="card-header kepalaKartu fontKerasBesar">
                  Data Upload Video
                </div>
                <div class="card-body badanKelas fontKeras">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Mata Pelajaran</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Deskripsi Video</th>
                            <th scope="col">EDIT</th>
                            <th scope="col">HAPUS</th>
                          </tr>
                        </thead>

                        <tbody>


                          <?php
                  $id_pengguna=$_SESSION["id_pengguna"];
                  $result = mysqli_query($mysqli, "SELECT * FROM kelass inner join penggunas on kelass.id_pengguna=penggunas.id_pengguna where penggunas.id_pengguna='$id_pengguna'");
                    while($data_table = mysqli_fetch_array($result)) {
                      $id_kelas=$data_table["id_kelas"];
                  }
                  $no=1;
                  $result = mysqli_query($mysqli, "SELECT * FROM postingans where id_kelas='$id_kelas'");
                  while($data_table = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $data_table["judul"] ?></td>
                            <td><?php echo $data_table["id_mata_pelajaran"] ?></td>
                            <td><?php echo $data_table["kelas"] ?></td>
                            <td><?php echo $data_table["deskripsi"] ?></td>
                            <td>
                              <form action="uploadVideo.php" method="get">  
                                <input type="hidden" name="id_postingan" value="<?php echo $data_table["id_postingan"] ?>">
                              <button type="submit" class="btn btn-primary tombolEdit" >EDIT</button></td>
                              </form>
                            <td><button type="button" class="btn btn-danger tombolHapus" data-toggle="modal" data-target="#staticBackdrop">HAPUS</button></td>
                          </tr>
                          <?php
                }
                ?>
                          
                        </tbody>
                      </table>
                </div>
                <div class="card-footer kakiKartu">
                  <!-- Button trigger modal -->
                  <form action="uploadVideo.php">
                  <button type="submit" class="btn btn-lg btn-block tombolUpload">UPLOAD VIDEO</button>
                </form>
                </div>
              </div>
            </div>
        </div>
    </section>
<!-- Modal -->
                              <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="staticBackdropLabel">Yakin Ingin Menghapus?</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <form>
                                        <div class="form-group row">
                                          <label for="mataPelajaran" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                                          <div class="col-sm">
                                            <input type="nk" class="form-control" placeholder="Mata Pelajaran" id="mataPelajaran" readonly>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label for="judulKelas" class="col-sm-2 col-form-label">Judul</label>
                                          <div class="col-sm">
                                            <input type="nk" class="form-control" placeholder="Judul" id="judulKelas" readonly>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label for="Kelas" class="col-sm-2 col-form-label">Kelas</label>
                                          <div class="col-sm">
                                            <input type="nk" class="form-control" placeholder="Kelas" id="Kelas" readonly>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label for="deskripsiKelas" class="col-sm-2 col-form-label">Deskripsi Kelas</label>
                                          <div class="col-sm">
                                            <textarea class="form-control" id="deskripsiKelas" rows="3" placeholder="Deskripsi Kelas" readonly></textarea>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label for="videoPembelajaran" class="col-sm-2 col-form-label">Video Pembelajaran</label>
                                          <div class="col-sm">
                                            <input type="nk" class="form-control" placeholder="Video Pembelajarn" id="videoPembelajaran" readonly>
                                          </div>
                                        </div>
                                      </form>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger">HAPUS</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
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