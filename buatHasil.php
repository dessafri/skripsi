<?php
require './functions.php';

if (hitungJawaban()) {
    echo json_encode('SUKSES');
} else {
    echo json_encode('GAGAL');
}

?>