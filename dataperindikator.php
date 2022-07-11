<?php
require './functions.php';

$idindikator = $_POST['id'];

$data = query("SELECT * FROM indikator WHERE ID_INDIKATOR = '$idindikator'");

echo json_encode($data);
?>