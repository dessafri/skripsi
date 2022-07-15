<?php
require './functions.php';

$idindikator = $_POST['id'];

$data = query(
    "SELECT ind.ID_INDIKATOR,ind.NAMA_INDIKATOR,kp.ID_KRITERIA_PERAN,p.NAMA_PERAN from (indikator ind left JOIN kriteria_peran kp on ind.ID_INDIKATOR = kp.ID_INDIKATOR) LEFT JOIN peran p on kp.ID_PERAN = p.ID_PERAN WHERE ind.ID_INDIKATOR = $idindikator'"
);

echo json_encode($data);
?>