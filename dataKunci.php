<?php
require './functions.php';

$data = query('SELECT VALUE FROM kunci');

echo json_encode($data);
?>