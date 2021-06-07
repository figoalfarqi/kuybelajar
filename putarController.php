
<?php
include_once("config.php");

        $tanggal=date('Y-m-d H:i:s');
if(isset($_POST['aksi'])){
  
  if($_POST['aksi']=="tambahMenonton"){
        $id_pengguna=$_POST['id_pengguna'];
        $id_postingan=$_POST['id_postingan'];
        $result = mysqli_query($mysqli, "SELECT * FROM menontons where id_pengguna='$id_pengguna' and id_postingan='$id_postingan'");
      while($data_table = mysqli_fetch_array($result)) {
        $id_menonton=$data_table['id_menonton'];
        $jumlah_menonton=$data_table['jumlah_menonton'];
        $jumlah_menonton++;
      }
    if(isset($id_menonton)){
        $result = mysqli_query($mysqli, "UPDATE menontons set jumlah_menonton='$jumlah_menonton', updated_at='$tanggal' where id_menonton='$id_menonton'");
      
    }
    else{
      $result = mysqli_query($mysqli, "INSERT INTO menontons(id_pengguna,id_postingan,jumlah_menonton, created_at, updated_at) 
        values(
        '$id_pengguna',
        '$id_postingan',
        '1',
        '$tanggal',
        '$tanggal'
      )");
    }
  }
  if($_POST['aksi']=="tambahMenyukai"){
        $id_pengguna=$_POST['id_pengguna'];
        $id_postingan=$_POST['id_postingan'];
        $tanggal=date('Y-m-d H:i:s');
        $result = mysqli_query($mysqli, "SELECT * FROM menyukais where id_pengguna='$id_pengguna' and id_postingan='$id_postingan'");
      while($data_table = mysqli_fetch_array($result)) {
        $id_menyukai=$data_table['id_menyukai'];
      }
    if(isset($id_menyukai)){
        $result = mysqli_query($mysqli, "DELETE FROM menyukais where id_menyukai='$id_menyukai'");
        $hapus="hapus";
        echo json_encode($hapus);
    }
    else{
      $result = mysqli_query($mysqli, "INSERT INTO menyukais(id_pengguna, id_postingan, created_at, updated_at) 
        values(
        '$id_pengguna',
        '$id_postingan',
        '$tanggal',
        '$tanggal'
      )");
      $hapus="tidak";
      echo json_encode($hapus);
    }
  }
}

  // else if($_POST['aksi']=="hapus"){
  //   $id_menonton=$_POST['id_menonton'];
  //   $result = mysqli_query($mysqli, "DELETE FROM menontons where id_menonton='$id_menonton'");
  // }

   else if(isset($_POST['isiKomen'])){

    $isiKomen=$_POST['isiKomen'];
    $id_pengguna=$_POST['id_pengguna'];
    $id_postingan=$_POST['id_postingan'];
    $result = mysqli_query($mysqli, "INSERT INTO komentars(id_pengguna, id_postingan, isi_komentar, created_at, updated_at) 
        values(
        '$id_pengguna',
        '$id_postingan',
        '$isiKomen',
        '$tanggal',
        '$tanggal'
      )");
  }



?>