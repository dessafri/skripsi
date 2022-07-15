<?php
require './functions.php';

$idpertanyaan = $_POST['id'];

$data = query(
    "SELECT pertanyaan.ID_PERTANYAAN,pertanyaan.ID_INDIKATOR,pertanyaan.NAMA_PERTANYAAN,ketentuan_jawaban.ID_KETENTUAN_JAWABAN,ketentuan_jawaban.KETENTUAN_JAWABAN,pertanyaan.KATEGORI FROM pertanyaan LEFT JOIN ketentuan_jawaban ON pertanyaan.ID_PERTANYAAN = ketentuan_jawaban.ID_PERTANYAAN WHERE pertanyaan.ID_PERTANYAAN = '$idpertanyaan'"
);

echo json_encode($data);
?>