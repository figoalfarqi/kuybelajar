<?php
session_start();
include_once("../config.php");
if(isset($_POST['email'])){
	$email=$_POST['email'];
	$password=md5($_POST['password']);
  $result = mysqli_query($mysqli, "SELECT * FROM admins where email_admin='$email' and password_admin='$password' limit 1");
  while($data_table = mysqli_fetch_array($result)) {
  $_SESSION["email_admin"]=$data_table["email_admin"];
		$_SESSION["foto_admin"]=$data_table["foto_admin"];
		$_SESSION["nama_depan_admin"]=$data_table["nama_depan_admin"];
		$_SESSION["nama_belakang_admin"]=$data_table["nama_belakang_admin"]; 
		$_SESSION["tipe_admin"]=$data_table["tipe_admin"]; 
    
  }
  if($_SESSION["email_admin"]==$email){
  	header("Location:tabel-admin");
  }
  else{
  	header("Location:login.php");
  }
}
else{
	session_unset();
	session_destroy();
	header('Location:login.php');
}
