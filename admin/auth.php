<?php
session_start();
if (!isset($_SESSION["email_admin"])) {
	header("Location:login.php");
}
?>