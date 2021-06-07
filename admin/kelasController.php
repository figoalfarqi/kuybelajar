
<?php
include_once("../config.php");
if(isset($_GET['id_kelas'])){
  $id_kelas=$_GET['id_kelas'];
  $result = mysqli_query($mysqli, "SELECT * FROM kelass where id_kelas='$id_kelas'");
  while($data_table = mysqli_fetch_array($result)) { 
    $haha=$data_table;
  }
  echo json_encode($haha);
}

else if(isset($_POST['aksi'])){
  
  if($_POST['aksi']=="simpan"){
    $foto_sampul="";
    if(is_uploaded_file($_FILES['foto_sampul']['tmp_name'])) {
        $rand = rand();
        $sourcePath = $_FILES['foto_sampul']['tmp_name'];
        $targetPath = "images/foto_sampul/".$rand.$_FILES['foto_sampul']['name'];
        move_uploaded_file($sourcePath,$targetPath);
        $foto_sampul=$rand.$_FILES['foto_sampul']['name'];
    }
        $id_pengguna=$_POST['id_pengguna'];
        $nama_kelas=$_POST['nama_kelas'];
        $deskripsi=$_POST['deskripsi'];
        $tanggal=date('Y-m-d H:i:s');
    if(!$_POST['id_kelas']==""){

      $id_kelas=$_POST['id_kelas'];
      if($foto_sampul==""){
        $result = mysqli_query($mysqli, "UPDATE kelass set id_pengguna='$id_pengguna', nama_kelas='$nama_kelas',deskripsi='$deskripsi',updated_at='$tanggal' where id_kelas='$id_kelas'");
      }
      else{
        $result = mysqli_query($mysqli, "UPDATE kelass set foto_sampul='$foto_sampul', id_pengguna='$id_pengguna', nama_kelas='$nama_kelas',deskripsi='$deskripsi',updated_at='$tanggal' where id_kelas='$id_kelas'");
      }
      
    }
    else{
      $result = mysqli_query($mysqli, "INSERT INTO kelass(foto_sampul, id_pengguna, nama_kelas, deskripsi, created_at, updated_at) 
        values('$foto_sampul',
        '$id_pengguna',
        '$nama_kelas',
        '$deskripsi',
        '$tanggal',
        '$tanggal'
      )");
    }
  }
  else if($_POST['aksi']=="hapus"){
    $id_kelas=$_POST['id_kelas'];
    $result = mysqli_query($mysqli, "DELETE FROM kelass where id_kelas='$id_kelas'");
  }
}
else if(isset($_GET['aksi'])){
  $id_pengguna=$_GET['id_pengguna'];
  $haha="";
  $result = mysqli_query($mysqli, "SELECT * FROM penggunas ORDER BY id_pengguna DESC");
  while($data_table = mysqli_fetch_array($result)) {
    if($data_table['id_pengguna']==$id_pengguna){
      $haha.= "<option value=".$data_table['id_pengguna']." selected>".$data_table['nama_depan'].' '.$data_table['nama_belakang']."</option>";
    }
    else{
      $haha.= "<option value=".$data_table['id_pengguna'].">".$data_table['nama_depan'].' '.$data_table['nama_belakang']."</option>";
    }
                        
}
  echo $haha;
}
else{
  $result = mysqli_query($mysqli, "SELECT * FROM kelass left join penggunas on kelass.id_pengguna=penggunas.id_pengguna ORDER BY id_kelas DESC");
                    $no=0;
                    while($data_table = mysqli_fetch_array($result)) { 
                    $no++; 
                      ?>
                      <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $data_table['nama_depan'].' '.$data_table['nama_belakang']?></td>
                    <td><?php echo $data_table['nama_kelas'] ?></td>
                    <td><?php echo $data_table['deskripsi'] ?></td>
                    <td><button type='button' class='btn btn-block btn-primary btnEdit' data-id='<?php echo $data_table["id_kelas"] ?>'>Edit</button></td>
                    <td><button type='button' class='btn btn-block btn-danger btnHapus' data-id='<?php echo $data_table["id_kelas"] ?>'>Hapus</button></td>
                  </tr>
                <?php } 
}


?>