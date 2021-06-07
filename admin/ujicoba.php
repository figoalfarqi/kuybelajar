<?php
include_once("../config.php");
$email=$_POST['email'];
        $password=$_POST['password'];
        $nama_depan=$_POST['nama_depan'];
        $nama_belakang=$_POST['nama_belakang'];
        $no_hp=$_POST['no_hp'];
      $result = mysqli_query($mysqli, "INSERT INTO penggunas(email, password, nama_depan,nama_belakang, no_hp) 
        values('$email',
        '$password',
        '$nama_depan',
        '$nama_belakang',
        '$no_hp')");
  ?>