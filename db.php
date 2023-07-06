<?php

$DOCKER_PROCESS = getenv("DOCKER_PROCESS");

if ($DOCKER_PROCESS == "true") {
   $server = getenv("DB_HOST");
   $username = getenv("DB_USERNAME");
   $password = getenv("DB_PASSWORD");
   $database = getenv("DB_SCHEME");
} else {
   // deklarasi parameter koneksi database
   $server   = "localhost";
   $username = "root";
   $password = "";
   $database = "db_apotek";
}

// koneksi database
$mysqli = new mysqli($server, $username, $password, $database);

// cek koneksi
if ($mysqli->connect_error) {
   die('Koneksi Database Gagal : '.$mysqli->connect_error);
}
?>