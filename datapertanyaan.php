<?php
require './functions.php';

$idperan = $_POST['id'];

$dataPertanyaan = query(
    "SELECT indikator.ID_INDIKATOR,pertanyaan.ID_PERTANYAAN,pertanyaan.NAMA_PERTANYAAN FROM indikator LEFT JOIN kriteria_peran ON indikator.ID_INDIKATOR = kriteria_peran.ID_INDIKATOR LEFT JOIN pertanyaan ON pertanyaan.ID_INDIKATOR = indikator.ID_INDIKATOR WHERE kriteria_peran.ID_PERAN = '$idperan'"
);

echo json_encode($dataPertanyaan);
?>