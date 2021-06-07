
<?php
include_once("../config.php");
if(isset($_GET['id_komentar'])){
  $id_komentar=$_GET['id_komentar'];
  $result = mysqli_query($mysqli, "SELECT * FROM komentars where id_komentar='$id_komentar'");
  while($data_table = mysqli_fetch_array($result)) { 
    $haha=$data_table;
  }
  echo json_encode($haha);
}

else if(isset($_POST['aksi'])){
  
  if($_POST['aksi']=="simpan"){
        $id_pengguna=$_POST['id_pengguna'];
        $id_postingan=$_POST['id_postingan'];
        $isi_komentar=$_POST['isi_komentar'];
        $tanggal=date('Y-m-d H:i:s');
    if(!$_POST['id_komentar']==""){

      $id_komentar=$_POST['id_komentar'];
        $result = mysqli_query($mysqli, "UPDATE komentars set id_pengguna='$id_pengguna',id_postingan='$id_postingan',isi_komentar='$isi_komentar', updated_at='$tanggal' where id_komentar='$id_komentar'");
      
    }
    else{
      $result = mysqli_query($mysqli, "INSERT INTO komentars(id_pengguna,id_postingan,isi_komentar, created_at, updated_at) 
        values(
        '$id_pengguna',
        '$id_postingan',
        '$isi_komentar',
        '$tanggal',
        '$tanggal'
      )");
    }
  }
  else if($_POST['aksi']=="hapus"){
    $id_komentar=$_POST['id_komentar'];
    $result = mysqli_query($mysqli, "DELETE FROM komentars where id_komentar='$id_komentar'");
  }
}
else if(isset($_GET['aksi'])){
  $haha="";
  if(isset($_GET['id_postingan'])){
    $id_postingan=$_GET['id_postingan'];
    $result = mysqli_query($mysqli, "SELECT * FROM postingans ORDER BY id_postingan DESC");
    while($data_table = mysqli_fetch_array($result)) {
      if($data_table['id_postingan']==$id_postingan){
        $haha.= "<option value=".$data_table['id_postingan']." selected>".$data_table['judul']."</option>";
      }
      else{
        $haha.= "<option value=".$data_table['id_postingan'].">".$data_table['judul']."</option>";
      }                
    }
  }
  else if(isset($_GET['id_pengguna'])){
    $id_pengguna=$_GET['id_pengguna'];
    $result = mysqli_query($mysqli, "SELECT * FROM penggunas ORDER BY id_pengguna DESC");
    while($data_table = mysqli_fetch_array($result)) {
      if($data_table['id_pengguna']==$id_pengguna){
        $haha.= "<option value=".$data_table['id_pengguna']." selected>".$data_table['nama_depan']." ".$data_table['nama_belakang']."</option>";
      }
      else{
        $haha.= "<option value=".$data_table['id_pengguna'].">".$data_table['nama_depan']." ".$data_table['nama_belakang']."</option>";
      }                
    }
  }
  echo $haha;
}
else{
  $result = mysqli_query($mysqli, "SELECT * FROM komentars left join penggunas on komentars.id_pengguna=penggunas.id_pengguna left join postingans on komentars.id_postingan=postingans.id_postingan ORDER BY id_komentar DESC");
                    $no=0;
                    while($data_table = mysqli_fetch_array($result)) { 
                    $no++; 
                      ?>
                      <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $data_table['nama_depan']." ".$data_table['nama_belakang'] ?></td>
                    <td><?php echo $data_table['judul'] ?></td>
                    <td><?php echo $data_table['isi_komentar'] ?></td>
                    <td><button type='button' class='btn btn-block btn-primary btnEdit' data-id='<?php echo $data_table["id_komentar"] ?>'>Edit</button></td>
                    <td><button type='button' class='btn btn-block btn-danger btnHapus' data-id='<?php echo $data_table["id_komentar"] ?>'>Hapus</button></td>
                  </tr>
                <?php } 
}


?>