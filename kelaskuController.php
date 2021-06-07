
<?php
include_once("config.php");


if(isset($_POST['aksi'])){
  
  if($_POST['aksi']=="simpan"){
    $foto_sampul="";
    if(is_uploaded_file($_FILES['foto_sampul']['tmp_name'])) {
        $rand = rand();
        $sourcePath = $_FILES['foto_sampul']['tmp_name'];
        $targetPath = "admin/images/foto_sampul/".$rand.$_FILES['foto_sampul']['name'];
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
          echo $foto_sampul;
          header("Location:kelasku.php?buka=updateKelas");
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
      header("Location:kelasku.php?buka=updateKelas");
    }
  }
  else if($_POST['aksi']=="hapus"){
    $id_kelas=$_POST['id_kelas'];
    $result = mysqli_query($mysqli, "DELETE FROM kelass where id_kelas='$id_kelas'");
  }
}



?>