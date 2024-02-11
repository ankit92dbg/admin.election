<?php
$file_url = 'https://admin.pracharstore.com/uploads/sample-csv.csv';
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
readfile($file_url); 
?>