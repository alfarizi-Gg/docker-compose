<?php
function connectDB() {
    $host = "db";
    $user = "user";
    $password = "password";
    $dbname = "mydatabase";
    $port = 3306;

    $conn = new mysqli($host, $user, $password, $dbname, $port);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    return $conn;
}
?>
