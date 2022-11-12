<?php
require './functions.php';

$idSekolah = $_POST['id'];

$data = query(
    'SELECT sekolah.NAMA_SEKOLAH,perangkingan_sekolah.NILAI FROM perangkingan_sekolah LEFT JOIN sekolah ON sekolah.ID_SEKOLAH = perangkingan_sekolah.ID_SEKOLAH ORDER BY NILAI DESC'
);

echo json_encode($data);
?>