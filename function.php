<?php
//panggil file koneksi.php untuk menghubungkan ke database
require_once ('koneksi.php');

//membuat query ke database untuk menampilkan data user
function query($query) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}