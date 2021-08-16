<?php
header('Content-Type: application/json');

$response = [];
$response['status'] = 'OK';
$response['connection'] = 'OK';

return json_encode($response);