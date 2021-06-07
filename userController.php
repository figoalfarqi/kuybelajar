<?php
session_start();
include_once("config.php");

if(isset($_POST['aksi'])){
	if($_POST['aksi']=="daftar"){
		$foto="";
		$email=$_POST['email'];
        $password=md5($_POST['password']);
        $nama_depan=$_POST['nama_depan'];
        $nama_belakang=$_POST['nama_belakang'];
        $no_hp=$_POST['no_hp'];
        $tanggal=date('Y-m-d H:i:s');
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
      	header("Location:home.php?buka=daftarLogin");
    }
    else if($_POST['aksi']=="login"){
		$email=$_POST['email'];
		$password=md5($_POST['password']);
	  	$result = mysqli_query($mysqli, "SELECT * FROM penggunas where email='$email' and password='$password' limit 1");
	  	while($data_table = mysqli_fetch_array($result)) {
	  		$_SESSION["id_pengguna"]=$data_table["id_pengguna"];
	  		$_SESSION["email"]=$data_table["email"];
			$_SESSION["nama_depan"]=$data_table["nama_depan"];
			$_SESSION["nama_belakang"]=$data_table["nama_belakang"]; 
	  	}
			if($_SESSION["email"]==$email){
				header("Location:home.php");
			}
			else{
				header("Location:home.php?buka=gagalLogin");
			}
    }
	else if($_POST['aksi']=="simpan"){
	    $foto="";
	    if(is_uploaded_file($_FILES['foto']['tmp_name'])) {
	        $rand = rand();
	        $sourcePath = $_FILES['foto']['tmp_name'];
	        $targetPath = "admin/images/foto_pengguna/".$rand.$_FILES['foto']['name'];
	        move_uploaded_file($sourcePath,$targetPath);
	        $foto=$rand.$_FILES['foto']['name'];
	    }
	        $nama_depan=$_POST['nama_depan'];
	        $nama_belakang=$_POST['nama_belakang'];
	        $no_hp=$_POST['no_hp'];
	        $tanggal=date('Y-m-d H:i:s');
	      $id_pengguna=$_SESSION["id_pengguna"];
	      if($foto==""){
	        $result = mysqli_query($mysqli, "UPDATE penggunas set  nama_depan='$nama_depan', nama_belakang='$nama_belakang', no_hp='$no_hp',updated_at='$tanggal' where id_pengguna='$id_pengguna'");
	      }
	      else{
	        $result = mysqli_query($mysqli, "UPDATE penggunas set  nama_depan='$nama_depan',nama_belakang='$nama_belakang', no_hp='$no_hp', foto='$foto',updated_at='$tanggal' where id_pengguna='$id_pengguna'");
	      }
	     header("Location:profil.php");
	}
}
else if(isset($_GET['aksi'])){
	session_unset();
	session_destroy();
	header('Location:home.php');
}