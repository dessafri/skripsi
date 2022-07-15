<?php
require './functions.php';

if (deletePertanyaan($_POST) > 0) {
    echo json_encode('SUKSES');
} else {
    echo json_encode('GAGAL');
}
?>