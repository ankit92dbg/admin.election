<?php
require_once('../whatsapp-api/ultramsg.class.php'); // if you download ultramsg.class.php

$ultramsg_token="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY1YTRkYTUyODdlZTUxMmUzMzFjMzJhYyIsIm5hbWUiOiJQb2xpYXJjIFNlcnZpY2VzIFB2dCBMdGQiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjVhNGRhNTI4N2VlNTEyZTMzMWMzMmExIiwiYWN0aXZlUGxhbiI6IkJBU0lDX01PTlRITFkiLCJpYXQiOjE3MDUzMDI2MTB9.47UJMCvdUWfMNJ8OF5_ku9i8NmhefLvGLemcAY28z0Y"; // Ultramsg.com token
$instance_id="instance1150"; // Ultramsg.com instance id
$client = new UltraMsg\WhatsAppApi($ultramsg_token,$instance_id);

$to="put_your_mobile_number_here"; 
$body="Hello world"; 
$api=$client->sendChatMessage($to,$body);
print_r($api);

?>