<?php

$request = $_SERVER['REQUEST_URI'];
$me = "/kuybelajar/admin";


	switch ($request) {
        case $me.'/' :
            break;
        case $me.'/login' :
            require "login.php";
            break;
        case $me.'/tabel-admin' :
            require "admin.php";
            break;
        case $me.'/tabel-pengguna' :
            require "pengguna.php";
            break;
        case $me.'/tabel-kelas' :
            require "kelas.php";
            break;
        case $me.'/tabel-postingan' :
            require "postingan.php";
            break;
        case $me.'/tabel-mata-pelajaran' :
            require "mataPelajaran.php";
            break;
        case $me.'/tabel-komentar' :
            require "komentar.php";
            break;
        case $me.'/tabel-menyukai' :
            require "menyukai.php";
            break;
        case $me.'/tabel-menonton' :
            require "menonton.php";
            break;
        case $me.'/tabel-slideshow' :
            require "slideshow.php";
            break;
        default:
            http_response_code(404);
            echo "404";
            break;
    }
?>