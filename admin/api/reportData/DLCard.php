<?php
    header('Content-type: application/vnd-ms-excel');
    $filename="Consultations.xls";
    header("Content-Disposition:attachment;filename=\"$filename\"");
?>