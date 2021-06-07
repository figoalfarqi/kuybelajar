
<?php
include_once("../config.php");
if(isset($_GET['id_menyukai'])){
  $id_menyukai=$_GET['id_menyukai'];
  $result = mysqli_query($mysqli, "SELECT * FROM menyukais where id_menyukai='$id_menyukai'");
  while($data_table = mysqli_fetch_array($result)) { 
    $haha=$data_table;
  }
  echo json_encode($haha);
}

else if(isset($_POST['aksi'])){
  
  if($_POST['aksi']=="simpan"){
        $id_pengguna=$_POST['id_pengguna'];
        $id_postingan=$_POST['id_postingan'];
        $tanggal=date('Y-m-d H:i:s');
    if(!$_POST['id_menyukai']==""){

      $id_menyukai=$_POST['id_menyukai'];
        $result = mysqli_query($mysqli, "UPDATE menyukais set id_pengguna='$id_pengguna',id_postingan='$id_postingan',updated_at='$tanggal' where id_menyukai='$id_menyukai'");
      
    }
    else{
      $result = mysqli_query($mysqli, "INSERT INTO menyukais(id_pengguna,id_postingan, created_at, updated_at) 
        values(
        '$id_pengguna',
        '$id_postingan',
        '$tanggal',
        '$tanggal'
      )");
    }
  }
  else if($_POST['aksi']=="hapus"){
    $id_menyukai=$_POST['id_menyukai'];
    $result = mysqli_query($mysqli, "DELETE FROM menyukais where id_menyukai='$id_menyukai'");
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
  $result = mysqli_query($mysqli, "SELECT * FROM menyukais left join penggunas on menyukais.id_pengguna=penggunas.id_pengguna left join postingans on menyukais.id_postingan=postingans.id_postingan ORDER BY id_menyukai DESC");
                    $no=0;
                    while($data_table = mysqli_fetch_array($result)) { 
                    $no++; 
                      ?>
                      <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $data_table['nama_depan']." ".$data_table['nama_belakang'] ?></td>
                    <td><?php echo $data_table['judul'] ?></td>
                    <td><button type='button' class='btn btn-block btn-primary btnEdit' data-id='<?php echo $data_table["id_menyukai"] ?>'>Edit</button></td>
                    <td><button type='button' class='btn btn-block btn-danger btnHapus' data-id='<?php echo $data_table["id_menyukai"] ?>'>Hapus</button></td>
                  </tr>
                <?php } 
}


?>