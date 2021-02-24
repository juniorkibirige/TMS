<?php
session_start();
include_once('../includes/db.inc.php');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $fName = mysqli_real_escape_string($con, $_GET['fName']);
    $lName = mysqli_real_escape_string($con, $_GET['lName']);
    $det = 'update nins set fName = "' . $fName . '" where nin = "' . $_SESSION['id'] . '"';
    $det = mysqli_query($con, $det);
    if ($det) {
        $det = 'update nins set lName = "' . $lName . '" where nin = "' . $_SESSION['id'] . '"';
        $det = mysqli_query($con, $det);
        $response['result'] = base64_encode('Success');
        !$det ? die(mysqli_error($con)) : die(json_encode($response));
    } else {
        $response['result'] = base64_encode(mysqli_error($con));
        echo json_encode($response['result']);
    }
} else {
    $response['error'] = 'An Error occurred!';
    echo json_encode($response);
}
