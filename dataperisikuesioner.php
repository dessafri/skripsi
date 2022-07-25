<?php
require './functions.php';

$idperan = $_POST['id'];

$data = query(
    "SELECT ID_INDIKATOR,GROUP_CONCAT(ID_PERTANYAAN) AS ID_PERTANYAAN, GROUP_CONCAT(NAMA_PERTANYAAN) AS NAMA_PERTANYAAN FROM (SELECT indikator.ID_INDIKATOR,pertanyaan.ID_PERTANYAAN,pertanyaan.NAMA_PERTANYAAN FROM indikator LEFT JOIN kriteria_peran ON indikator.ID_INDIKATOR = kriteria_peran.ID_INDIKATOR LEFT JOIN pertanyaan ON pertanyaan.ID_INDIKATOR = indikator.ID_INDIKATOR WHERE kriteria_peran.ID_PERAN = '$idperan') AS A GROUP BY ID_INDIKATOR"
);

echo json_encode($data);
?>