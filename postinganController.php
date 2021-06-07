
<?php
include_once("config.php");
if(isset($_GET['id_postingan'])){
  $id_postingan=$_GET['id_postingan'];
  $result = mysqli_query($mysqli, "SELECT * FROM postingans where id_postingan='$id_postingan'");
  while($data_table = mysqli_fetch_array($result)) { 
    $haha=$data_table;
  }
  echo json_encode($haha);
}

else if(isset($_POST['aksi'])){
  
  if($_POST['aksi']=="simpan"){
    $video="";
    if(is_uploaded_file($_FILES['video']['tmp_name'])) {
        $rand = rand();
        $sourcePath = $_FILES['video']['tmp_name'];
        $targetPath = "admin/images/video/".$rand.$_FILES['video']['name'];
        move_uploaded_file($sourcePath,$targetPath);
        $video=$rand.$_FILES['video']['name'];
    }
        $id_kelas=$_POST['id_kelas'];
        $id_mata_pelajaran=$_POST['id_mata_pelajaran'];
        $judul=$_POST['judul'];
        $kelas=$_POST['kelas'];
        $deskripsi=$_POST['deskripsi'];
        $tanggal=date('Y-m-d H:i:s');
    if(!$_POST['id_postingan']==""){

      $id_postingan=$_POST['id_postingan'];
      if($video==""){
        $result = mysqli_query($mysqli, "UPDATE postingans set id_kelas='$id_kelas',id_mata_pelajaran='$id_mata_pelajaran', judul='$judul',kelas='$kelas',deskripsi='$deskripsi',updated_at='$tanggal' where id_postingan='$id_postingan'");
      }
      else{
        $result = mysqli_query($mysqli, "UPDATE postingans set video='$video', id_kelas='$id_kelas',id_mata_pelajaran='$id_mata_pelajaran', judul='$judul',kelas='$kelas',deskripsi='$deskripsi',updated_at='$tanggal' where id_postingan='$id_postingan'");
      }
      header("Location:postingan.php?buka=editpostingan");
    }
    else{
      $result = mysqli_query($mysqli, "INSERT INTO postingans(video, id_kelas,id_mata_pelajaran, judul, kelas, deskripsi, created_at, updated_at) 
        values('$video',
        '$id_kelas',
        '$id_mata_pelajaran',
        '$judul',
        '$kelas',
        '$deskripsi',
        '$tanggal',
        '$tanggal'
      )");
      header("Location:postingan.php?buka=simpanpostingan");
    }

  }
  else if($_POST['aksi']=="hapus"){
    $id_postingan=$_POST['id_postingan'];
    $result = mysqli_query($mysqli, "DELETE FROM postingans where id_postingan='$id_postingan'");
  }
}
else{
  $result = mysqli_query($mysqli, "SELECT * FROM postingans left join kelass on postingans.id_kelas=kelass.id_kelas left join mata_pelajarans on postingans.id_mata_pelajaran=mata_pelajarans.id_mata_pelajaran ORDER BY id_postingan DESC");
                    $no=0;
                    while($data_table = mysqli_fetch_array($result)) { 
                    $no++; 
                      ?>
                      <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $data_table['nama_kelas'] ?></td>
                    <td><?php echo $data_table['nama_mata_pelajaran'] ?></td>
                    <td><?php echo $data_table['judul'] ?></td>
                    <td><?php echo $data_table['kelas'] ?></td>
                    <td><?php echo $data_table['deskripsi'] ?></td>
                    <td><button type='button' class='btn btn-block btn-primary btnEdit' data-id='<?php echo $data_table["id_postingan"] ?>'>Edit</button></td>
                    <td><button type='button' class='btn btn-block btn-danger btnHapus' data-id='<?php echo $data_table["id_postingan"] ?>'>Hapus</button></td>
                  </tr>
                <?php } 
}


?>