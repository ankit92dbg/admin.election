<?php
session_start();
unset($_SESSION);
session_destroy();
$response = new stdClass();
$response->message = "success";
echo json_encode($response);
?>