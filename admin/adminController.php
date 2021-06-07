
<?php
include_once("../config.php");
if(isset($_GET['id_admin'])){
  $id_admin=$_GET['id_admin'];
  $result = mysqli_query($mysqli, "SELECT * FROM admins where id_admin='$id_admin'");
  while($data_table = mysqli_fetch_array($result)) { 
    $haha=$data_table;
  }
  echo json_encode($haha);
}

else if(isset($_POST['aksi'])){
  
  if($_POST['aksi']=="simpan"){
    $foto_admin="";
    if(is_uploaded_file($_FILES['foto_admin']['tmp_name'])) {
        $rand = rand();
        $sourcePath = $_FILES['foto_admin']['tmp_name'];
        $targetPath = "images/foto_admin/".$rand.$_FILES['foto_admin']['name'];
        move_uploaded_file($sourcePath,$targetPath);
        $foto_admin=$rand.$_FILES['foto_admin']['name'];
    }
        $email_admin=$_POST['email_admin'];
        if($_POST['password_admin'].strlen()<20){
          $password_admin=md5($_POST['password_admin']);
        }
        else{
          $password_admin=$_POST['password_admin'];
        }
        $nama_depan_admin=$_POST['nama_depan_admin'];
        $nama_belakang_admin=$_POST['nama_belakang_admin'];
        $no_hp_admin=$_POST['no_hp_admin'];
        $alamat_admin=$_POST['alamat_admin'];
        $tipe_admin=$_POST['tipe_admin'];
        $tanggal=date('Y-m-d H:i:s');
    if(!$_POST['id_admin']==""){
      $id_admin=$_POST['id_admin'];
      if($foto_admin==""){
        $result = mysqli_query($mysqli, "UPDATE admins set email_admin='$email_admin', password_admin='$password_admin', nama_depan_admin='$nama_depan_admin',nama_belakang_admin='$nama_belakang_admin', no_hp_admin='$no_hp_admin', alamat_admin='$alamat_admin', tipe_admin='$tipe_admin',updated_at='$tanggal' where id_admin='$id_admin'");
      }
      else{
        $result = mysqli_query($mysqli, "UPDATE admins set email_admin='$email_admin', password_admin='$password_admin', nama_depan_admin='$nama_depan_admin',nama_belakang_admin='$nama_belakang_admin', no_hp_admin='$no_hp_admin', foto_admin='$foto_admin', alamat_admin='$alamat_admin', tipe_admin='$tipe_admin',updated_at='$tanggal' where id_admin='$id_admin'");
      }
      
    }
    else{
      $result = mysqli_query($mysqli, "INSERT INTO admins(email_admin, password_admin, nama_depan_admin,nama_belakang_admin, no_hp_admin, foto_admin, alamat_admin, tipe_admin, created_at, updated_at) 
        values('$email_admin',
        '$password_admin',
        '$nama_depan_admin',
        '$nama_belakang_admin',
        '$no_hp_admin',
        '$foto_admin',
        '$alamat_admin',
        '$tipe_admin',
        '$tanggal',
        '$tanggal'
      )");
    }
  }
  else if($_POST['aksi']=="hapus"){
    $id_admin=$_POST['id_admin'];
    $result = mysqli_query($mysqli, "DELETE FROM admins where id_admin='$id_admin'");
  }
}
else{
  $result = mysqli_query($mysqli, "SELECT * FROM admins ORDER BY id_admin DESC");
                    $no=0;
                    while($data_table = mysqli_fetch_array($result)) { 
                    $no++; 
                      ?>
                      <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $data_table['email_admin'] ?></td>
                    <td><?php echo $data_table['nama_depan_admin'] ?></td>
                    <td><?php echo $data_table['nama_belakang_admin'] ?></td>
                    <td><?php echo $data_table['no_hp_admin'] ?></td>
                    <td><?php echo $data_table['tipe_admin'] ?></td>
                    <td><button type='button' class='btn btn-block btn-primary btnEdit' data-id='<?php echo $data_table["id_admin"] ?>'>Edit</button></td>
                    <td><button type='button' class='btn btn-block btn-danger btnHapus' data-id='<?php echo $data_table["id_admin"] ?>'>Hapus</button></td>
                  </tr>
                <?php } 
}
?>