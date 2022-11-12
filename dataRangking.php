<?php
require './functions.php';

$data = query(
    'SELECT sekolah.ID_SEKOLAH,sekolah.NAMA_SEKOLAH,tingkat_kesesuaian_total.NILAI,perangkingan_sekolah.NILAI as NILAI_RANGKING FROM perangkingan_sekolah LEFT JOIN tingkat_kesesuaian_total ON perangkingan_sekolah.ID_SEKOLAH = tingkat_kesesuaian_total.ID_SEKOLAH LEFT JOIN sekolah ON perangkingan_sekolah.ID_SEKOLAH = sekolah.ID_SEKOLAH ORDER BY NILAI_RANGKING DESC'
);

echo json_encode($data);
?>