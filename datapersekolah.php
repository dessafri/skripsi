<?php
require './functions.php';

$idsekolah = $_POST['id'];

$data = query("SELECT * FROM sekolah WHERE ID_SEKOLAH = '$idsekolah'");

echo json_encode($data);
?>