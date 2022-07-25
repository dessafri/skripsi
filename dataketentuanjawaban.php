<?php
require './functions.php';

$idperan = $_POST['id'];

$datajawaban = query(
    "SELECT ketentuan_jawaban.ID_KETENTUAN_JAWABAN,ketentuan_jawaban.KETENTUAN_JAWABAN,ketentuan_jawaban.NILAI_JAWABAN FROM indikator LEFT JOIN kriteria_peran ON indikator.ID_INDIKATOR = kriteria_peran.ID_INDIKATOR LEFT JOIN pertanyaan ON pertanyaan.ID_INDIKATOR = indikator.ID_INDIKATOR LEFT JOIN ketentuan_jawaban ON pertanyaan.ID_PERTANYAAN = ketentuan_jawaban.ID_PERTANYAAN WHERE kriteria_peran.ID_PERAN = '$idperan'"
);

echo json_encode($datajawaban);
?>