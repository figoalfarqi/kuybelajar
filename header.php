 <style>
        /* AWAL KEPALA ATAU HEADER */
        .kepala
        {
          background-color: #5ffae0;
        }
        .isiKepala li a
        {
          color: rgb(25, 98, 233);
        }
        .isiKepala li a:hover
        {
          color: black;
        }
        /* AKHIR KEPALA ATAU HEADER */

        /* AWAL DROPDOWN */
        .dropdown div a:hover
        {
          background-color: #5ffae0;
        }
        .dropdown div a
        {
          color: #2c8be4;
        }
        /* AKHIR DROPDOWN */

        /* AWAL SEARCH */
        .formSearch .ukuranFormSearch
        {
            width: 300px;
        }
        .btnSearch
        {
          color: black;
        }
        .btnSearch:hover
        {
          background-color: white;
          color: #2c8be4;
        }
        /* AKHIR SEARCH */

        .gambarLogin {
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
        }
        .btnlogin{
            border: none;
            outline: none;
            height: 50px;
            width: 100%;
            background-color: black;
            color: white;
            border-radius: 4px;
            font-weight: bold; 
        }
        .btnlogin:hover{
            background: white;
            border: 1px solid;
            color: black;
        }
        .imgDaftar{
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
        }
        .btndaftar{
            border: none;
            outline: none;
            height: 50px;
            width: 100%;
            background-color: rgb(0, 132, 255);
            color: white;
            border-radius: 4px;
            font-weight: bold; 
        }
        .btndaftar:hover{
            background: white;
            border: 1px solid;
            color:  rgb(0, 132, 255);
        }
        .font-weight-bold{
            color: white;
        }
        .label{
            color: white;
        }

        .tunjuk{
            cursor: pointer;
        }
    </style>

<section class="kepala">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <nav class="navbar navbar-expand-lg">                      
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <!-- NAVBAR KIRI -->
                          <ul class="navbar-nav isiKepala">
                            <li class="nav-item mr-4">
                                <a class="nav-link" href="home.php">Home</a>
                            </li>
                            <li class="nav-item mr-4">
                              <a class="nav-link" href="aboutus.php">About Us</a>
                            </li>
                            <li class="nav-item mr-4">
                                <a class="nav-link" href="contact.php">Contact</a>
                            </li>
                            <li class="nav-item dropdown mr-5">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Mata Pelajaran
                              </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php
                      $result = mysqli_query($mysqli, "SELECT * FROM mata_pelajarans ORDER BY id_mata_pelajaran DESC");
                      while($data_table = mysqli_fetch_array($result)) {
                        $nama_mapel=$data_table['nama_mata_pelajaran'];
                                echo '<a class="dropdown-item" href="cari.php?cari='.$nama_mapel.'">'.$nama_mapel.'</a>';
                            }
                                ?>
                              </div>
                            </li>
                          </ul>
                          <form class="form-inline formSearch my-2 my-lg-0 mr-auto" action="cari.php" method="get">
                            <input class="form-control ukuranFormSearch mr-sm-2 ml-4" type="search" placeholder="Search" aria-label="Search" name="cari">
                            <button class="btn btn-outline-light btnSearch my-2 my-sm-0" type="submit">Search</button>
                          </form>
                          <!-- NAVBAR KANAN -->
                          <?php
                        
                        if(isset($_SESSION["email"])){
                            ?>
                            <ul class="navbar-nav isiKepala">
                            <li class="nav-item mr-4 dropdown">
                              <a class="nav-link  dropdown-toggle" href="#" id="userNavbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php
                                echo "hai, ".$_SESSION["nama_depan"];
                                ?>
                              </a>
                              <div class="dropdown-menu" aria-labelledby="userNavbarDropdown">
                                <a class="dropdown-item" href="profil.php">Profil</a>
                                <?php
                    $id_pengguna=$_SESSION["id_pengguna"];
                    $result = mysqli_query($mysqli, "SELECT * FROM kelass right join penggunas on kelass.id_pengguna=penggunas.id_pengguna where penggunas.id_pengguna='$id_pengguna'");
                    while($data_table = mysqli_fetch_array($result)) {
                       if( isset($data_table["id_kelas"])){
                  ?>
                                <a class="dropdown-item" href="kelasku.php"><?php echo $data_table["nama_kelas"] ?></a>
                                <a class="dropdown-item" href="postingan.php">Postingan</a>
                  <?php
                }
                else{
                  ?>
                                <a class="dropdown-item" href="kelasku.php">Buat Kelas</a>
                  <?php
                }
            }
                  ?>
                                
                                <a class="dropdown-item" href="histori.php">Histori</a>
                                <a class="dropdown-item" href="disukai.php">Disukai</a>
                                <a class="dropdown-item" href="userController.php?aksi=logout">Logout</a>
                              </div>
                            </li>
                          </ul>
                            <?php
                        }
                        else{
                            ?>
                          <ul class="navbar-nav isiKepala">
                            <li class="nav-item mr-4">
                                <a class="nav-link tunjuk" data-toggle="modal" data-target="#loginModal">Log In</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link tunjuk" data-toggle="modal" data-target="#daftarModal">Daftar</a>
                              </li>
                          </ul>
                        <?php
                        }
                            ?>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <?php
    if(isset($_GET['buka'])){
        $buka=$_GET['buka'];
        if($buka=="daftarLogin"){
        ?>
        <script type="text/javascript">    
            $(function () {
        $('#pengumumanModal').modal('show');
        });
        </script>
    <?php
        }
        if($buka=="gagalLogin"){
        ?>  
        <script type="text/javascript">  
        $(function () {  
            $('#gagalLoginModal').modal('show');
        });
        </script>
    <?php
        }
        if($buka=="harusLogin"){
        ?>  
        <script type="text/javascript">  
        $(function () {  
            $('#harusLoginModal').modal('show');
        });
        </script>
    <?php
        }
    }
    ?>
    <div class="modal fade" id="pengumumanModal" tabindex="-1" aria-labelledby="pengumumanModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulPengumuman">Selamat!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="isiPengumuman">
        Selamat Anda telah berhasil mendaftar
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">Login</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="harusLoginModal" tabindex="-1" aria-labelledby="harusLoginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulharusLogin">Informasi!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="isiharusLogin">
        Anda harus login terlebih dahulu sebeum memutar video
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">Login</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="gagalLoginModal" tabindex="-1" aria-labelledby="gagalLoginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulgagalLogin">Gagal login!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="isigagalLogin">
        Maaf. kombinasi email dan password anda salah!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">Login lagi</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" >
    <div class="modal-content" style="border-radius: 30px;background: darkgrey;">
      
            <div class="row no-gutters">
                <div class="col-lg-5">
                    <img src="asset/login.jpg" class="img-fluid gambarLogin" alt="">
                </div>
                <div class="col-lg-7 px-5 pt-5">
                    <h1 class="font-weight-bold py-3">KuyBelajar LOGIN</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -95px; font-size: 30px;">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="userController.php" method="POST">
                        <input type="hidden" name="aksi" value="login"> 
                        <div class="form-row">
                            <div class="col-lg-7">
                                <label class="label control-label">Email</label>
                                <input type="email" name="email" placeholder="Email-Adress" class="form-control my-1 p-1" > 
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-7">
                                <label class="label control-label">Password</label>
                                <input type="password" name="password" placeholder="******" class="form-control my-1 p-1"> 
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-7">
                                <button type="submit" class="btnlogin my-3 mb-5">Login</button>  
                            </div>
                        </div>
                    </form>
                        <a href="#">Lupa Password</a>
                        <p>Belum punya akun? <span class="tunjuk" data-toggle="modal" data-dismiss="modal" data-target="#daftarModal">Daftar</span></p>
                </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="daftarModal" tabindex="-1" aria-labelledby="daftarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" >
    <div class="modal-content" style="border-radius: 30px;background: rgb(1, 1, 44);">
      
            <div class="row no-gutters">
            <div class="col-lg-5 ">
                <img src="asset/daftar.jpg" class="img-fluid imgDaftar" alt="">
            </div>
            <div class="col-lg-7 px-5 pt-10">
                <h1 class="font-weight-bold py-1">KuyBelajar DAFTAR </h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -35px; font-size: 30px;color:white;">
                      <span aria-hidden="true">&times;</span>
                    </button>
                <form action="userController.php" method="POST">
                    <input type="hidden" name="aksi" value="daftar"> 
                    <div class="form-row">
                        <div class="col-lg-7">
                            <label class="label control-label">Nama Depan</label>
                            <input type="text" name="nama_depan" placeholder="Nama Depan" class="form-control my-1 p-1" > 
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <label class="label control-label">Nama Belakang</label>
                            <input type="text" name="nama_belakang" placeholder="Nama Belakang" class="form-control my-1 p-1" > 
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <label class="label control-label">E-mail</label>
                            <input type="email" name="email" placeholder="Email-Adress" class="form-control my-1 p-1" > 
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <label class="label control-label">Password</label>
                            <input type="password" name="password" placeholder="Password" class="form-control  my-1 p-1">  
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <label class="label control-label">Nomor Telepon</label>
                            <input type="text" name="no_hp" placeholder=" No. Telpon" class="form-control my-1 p-1" > 
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col-lg-7">
                            <button type="submit" class="btndaftar my-3 mb-5">Daftar</button>  
                        </div>
                    </div>
                </form>
                <p class="label">Sudah punya akun? <span class="tunjuk" data-toggle="modal" data-dismiss="modal" data-target="#loginModal">Login</span></p>
            </div>
        </div>


      </div>
    </div>
  </div>
</div>