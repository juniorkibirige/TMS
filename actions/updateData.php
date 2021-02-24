<?php
include_once './../includes/db.inc.php';
header('Content-Type: application/json');
$res = array();
$username = base64_decode($_COOKIE['user']);
$serviceDetailsUpdate = '';
if ($_SERVER['REQUEST_METHOD'] == 'UPDATE') {
    $data = parse_str(file_get_contents('php://input'), $_UPDATE);
    $cNIN = mysqli_real_escape_string($con, $_UPDATE['cNIN']);
    if (isset($_UPDATE['fN']) || isset($_UPDATE['lN']) || isset($_UPDATE['NIN'])) {
        if (!empty($_UPDATE['fN'])) {
            $fn = mysqli_real_escape_string($con, $_UPDATE['fN']);
            $detailsUpdate = 'update NINS set ';
            $detailsUpdate .= "fName = '$fn' where NIN = '$cNIN'";
            $d1 = $detailsUpdate;
        }
        if (!empty($_UPDATE['lN'])) {
            $ln = mysqli_real_escape_string($con, $_UPDATE['lN']);
            $detailsUpdate = 'update NINS set ';
            $detailsUpdate .= "lName = '$ln' where NIN = '$cNIN'";
            $d2 = $detailsUpdate;
        }
        if (!empty($_UPDATE['NIN'])) {
            $nin = mysqli_real_escape_string($con, $_UPDATE['NIN']);
            $detailsUpdate = 'update NINS set ';
            $detailsUpdate .= "NIN = '$nin' where NIN = '$cNIN'";
            $d3 = $detailsUpdate;
        }
    }
    if (isset($_UPDATE['mNo']) || isset($_UPDATE['hNum']) || isset($_UPDATE['Email'])) {
        if (isset($_UPDATE['mNo']) || isset($_UPDATE['hNum'])) {
            $prevConts = explode(',', mysqli_fetch_assoc(mysqli_query($con, "select ten_contact from tenant_details where ten_nin = '$cNIN'"))['ten_contact']);
            if (isset($_UPDATE['hNum']) && isset($_UPDATE['mNo'])) {
                $contactUpdate = 'update tenant_details set ';
                $updateCont = mysqli_real_escape_string($con, $_UPDATE['mNo']) . ',' . mysqli_real_escape_string($con, $_UPDATE['hNum']);
                $contactUpdate .= 'ten_contact';
                $contactUpdate .= " = '$updateCont' where ten_nin = '$cNIN'";
                $c1 = $contactUpdate;
            } elseif (isset($_UPDATE['mNo'])) {
                $contactUpdate = 'update tenant_details set ';
                $updateCont = !empty($prevConts[1]) ?
                    mysqli_real_escape_string($con, $_UPDATE['mNo']) . ',' . $prevConts[1] : mysqli_real_escape_string($con, $_UPDATE['mNo']);
                $contactUpdate .= 'ten_contact';
                $contactUpdate .= " = '$updateCont' where ten_nin = '$cNIN'";
                $c2 = $contactUpdate;
            } elseif (isset($_UPDATE['hNum'])) {
                $contactUpdate = 'update tenant_details set ';
                $updateCont = $prevConts[0] . ',' . mysqli_real_escape_string($con, $_UPDATE['hNum']);
                $contactUpdate .= 'ten_contact';
                $contactUpdate .= " = '$updateCont' where ten_nin = '$cNIN'";
                $c3 = $contactUpdate;
            }
        }
        if (isset($_UPDATE['Email'])) {
            $contactUpdate = 'update tenant_details set ';
            $email = mysqli_real_escape_string($con, $_UPDATE['Email']);
            $contactUpdate .= 'ten_email';
            $contactUpdate .= " = '$email' where ten_nin = '$cNIN'";
            $c4 = $contactUpdate;
        }
    }
    if (!empty($d1) || !empty($d2) || !empty($d3) || !empty($c1) || !empty($c2) || !empty($c3) || !empty($c4)) {
        if (!empty($d1)) {
            $init = mysqli_query($con, $d1);
            if (!$init) die(json_encode(
                    array(
                        'status' => 'FAIL',
                        'error' => mysqli_error($con)
                    )
                ));
        }
        if (!empty($d2)) {
            $init = mysqli_query($con, $d2);
            if (!$init) die(json_encode(
                    array(
                        'status' => 'FAIL',
                        'error' => mysqli_error($con)
                    )
                ));
        }
        if (!empty($d3)) {
            $init = mysqli_query($con, $d3);
            if (!$init) die(json_encode(
                    array(
                        'status' => 'FAIL',
                        'error' => mysqli_error($con)
                    )
                ));
        }
        if (!empty($c1)) {
            $init = mysqli_query($con, $c1);
            if (!$init) die(json_encode(
                    array(
                        'status' => 'FAIL',
                        'error' => mysqli_error($con)
                    )
                ));
        }
        if (!empty($c2)) {
            $init = mysqli_query($con, $c2);
            if (!$init) die(json_encode(
                    array(
                        'status' => 'FAIL',
                        'error' => mysqli_error($con)
                    )
                ));
        }
        if (!empty($c3)) {
            $init = mysqli_query($con, $c3);
            if (!$init) die(json_encode(
                    array(
                        'status' => 'FAIL',
                        'error' => mysqli_error($con)
                    )
                ));
        }
        if (!empty($c4)) {
            $init = mysqli_query($con, $c4);
            if (!$init) die(json_encode(
                    array(
                        'status' => 'FAIL',
                        'error' => mysqli_error($con)
                    )
                ));
        }
        $res['status'] = 'OK';
    }
}
echo json_encode($res);
