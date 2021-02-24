<?php
    include_once('./../includes/db.inc.php');
    // header('Content-Type: application/json');
    // $data = file_get_contents('php://input');
    // parse_str($data, $_PUT);
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        echo json_encode(
            array(
                'status' => 403,
                'advice' => 'Illegal access method!'
            )
        );
    } else {
        var_dump($_PUT);
    }