
<?php
include_once("../config.php");
if(isset($_GET['id_mapel'])){
  $id_mapel=$_GET['id_mapel'];
  $result = mysqli_query($mysqli, "SELECT * FROM mata_pelajarans where id_mata_pelajaran='$id_mapel'");
  while($user_data = mysqli_fetch_array($result)) { 
    $haha=$user_data;
  }
  echo json_encode($haha);
}
else if(isset($_POST['aksi'])){
  if($_POST['aksi']=="simpan"){
    $name=$_POST['nama_mata_pelajaran'];
    $tanggal=date('Y-m-d H:i:s');
    if(!$_POST['id_mapel']==""){
      $id_mapel=$_POST['id_mapel'];
      $result = mysqli_query($mysqli, "UPDATE mata_pelajarans set nama_mata_pelajaran='$name',updated_at='$tanggal' where id_mata_pelajaran='$id_mapel'");
    }
    else{
      $result = mysqli_query($mysqli, "INSERT INTO mata_pelajarans(nama_mata_pelajaran, created_at, updated_at) values('$name','$tanggal','$tanggal')");
    }
  }
  else if($_POST['aksi']=="hapus"){
    $id_mapel=$_POST['id_mapel'];
    $result = mysqli_query($mysqli, "DELETE FROM mata_pelajarans where id_mata_pelajaran='$id_mapel'");
  }
}
else{
  $result = mysqli_query($mysqli, "SELECT * FROM mata_pelajarans ORDER BY id_mata_pelajaran DESC");
                    $no=0;
                    while($user_data = mysqli_fetch_array($result)) { 
                    $no++; 
                      ?>
                      <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $user_data['nama_mata_pelajaran'] ?></td>
                    <td><button type='button' class='btn btn-block btn-primary btnEdit' data-id='<?php echo $user_data["id_mata_pelajaran"] ?>'>Edit</button></td>
                    <td><button type='button' class='btn btn-block btn-danger btnHapus' data-id='<?php echo $user_data["id_mata_pelajaran"] ?>'>Hapus</button></td>
                  </tr>
                <?php } 
}
?>