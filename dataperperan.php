<?php
require './functions.php';

$idkategori = $_POST['id'];

$data = query("SELECT * FROM peran WHERE ID_PERAN = '$idkategori'");

echo json_encode($data);
?>