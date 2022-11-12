<?php
require './functions.php';

if (putKunci() > 0) {
    echo json_encode('SUKSES');
} else {
    echo json_encode('GAGAL');
}

?>