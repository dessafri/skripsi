<?php
require './functions.php';

$idkategori = $_POST['id'];

$data = query("SELECT * FROM kategori WHERE ID_KATEGORI = '$idkategori'");

echo json_encode($data);
?>