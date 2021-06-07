
<?php
include_once("../config.php");
if(isset($_GET['id_pengguna'])){
  $id_pengguna=$_GET['id_pengguna'];
  $result = mysqli_query($mysqli, "SELECT * FROM penggunas where id_pengguna='$id_pengguna'");
  while($data_table = mysqli_fetch_array($result)) { 
    $haha=$data_table;
  }
  echo json_encode($haha);
}

else if(isset($_POST['aksi'])){
  
  if($_POST['aksi']=="simpan"){
    $foto="";
    if(is_uploaded_file($_FILES['foto']['tmp_name'])) {
        $rand = rand();
        $sourcePath = $_FILES['foto']['tmp_name'];
        $targetPath = "images/foto_pengguna/".$rand.$_FILES['foto']['name'];
        move_uploaded_file($sourcePath,$targetPath);
        $foto=$rand.$_FILES['foto']['name'];
    }
        $email=$_POST['email'];
        $password=$_POST['password'];
        $nama_depan=$_POST['nama_depan'];
        $nama_belakang=$_POST['nama_belakang'];
        $no_hp=$_POST['no_hp'];
        $tanggal=date('Y-m-d H:i:s');
    if(!$_POST['id_pengguna']==""){

      $id_pengguna=$_POST['id_pengguna'];
      if($foto==""){
        $result = mysqli_query($mysqli, "UPDATE penggunas set email='$email', password='$password', nama_depan='$nama_depan', nama_belakang='$nama_belakang', no_hp='$no_hp',updated_at='$tanggal' where id_pengguna='$id_pengguna'");
      }
      else{
        $result = mysqli_query($mysqli, "UPDATE penggunas set email='$email', password='$password', nama_depan='$nama_depan',nama_belakang='$nama_belakang', no_hp='$no_hp', foto='$foto',updated_at='$tanggal' where id_pengguna='$id_pengguna'");
      }
      
    }
    else{
      $result = mysqli_query($mysqli, "INSERT INTO penggunas(email, password, nama_depan,nama_belakang, no_hp, foto, created_at, updated_at) 
        values('$email',
        '$password',
        '$nama_depan',
        '$nama_belakang',
        '$no_hp',
        '$foto',
        '$tanggal',
        '$tanggal'
      )");
    }
  }
  else if($_POST['aksi']=="hapus"){
    $id_pengguna=$_POST['id_pengguna'];
    $result = mysqli_query($mysqli, "DELETE FROM penggunas where id_pengguna='$id_pengguna'");
  }
}
else{
  $result = mysqli_query($mysqli, "SELECT * FROM penggunas ORDER BY id_pengguna DESC");
                    $no=0;
                    while($data_table = mysqli_fetch_array($result)) { 
                    $no++; 
                      ?>
                      <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $data_table['email'] ?></td>
                    <td><?php echo $data_table['nama_depan'] ?></td>
                    <td><?php echo $data_table['nama_belakang'] ?></td>

                    <td><?php echo $data_table['no_hp'] ?></td>
                    <td><button type='button' class='btn btn-block btn-primary btnEdit' data-id='<?php echo $data_table["id_pengguna"] ?>'>Edit</button></td>
                    <td><button type='button' class='btn btn-block btn-danger btnHapus' data-id='<?php echo $data_table["id_pengguna"] ?>'>Hapus</button></td>
                  </tr>
                <?php } 
}
?>