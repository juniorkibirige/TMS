<?php
include_once('../includes/db.inc.php');
header('Content-Type: application/json');
$rest = array();
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $rest['err'] = 'Direct script access is denied';
} else {
    if ($_POST['ver'] != 'Zm9ydGhlbG92ZW9mdG1zKGMpcGxlYXNlZG9ub3R1c2VzdHlsaW5nc2Vsc2V3aGVyZQ==') {
        $rest['err'] = 'Script is missing required verification parameters';
    } else {
        // die(var_dump(base64_decode($_POST['t'])));
        if (base64_decode($_POST['t']) == 'ten_name') {
            $rest['_info'] = 'Provided Tenant Name!';
            if (count(explode(' ', base64_decode($_POST['sp']))) > 1) {
                $names = explode(' ', base64_decode($_POST['sp']));
                if (count($names) == 2) {
                    $fn = explode(' ', base64_decode($_POST['sp']))[1];
                    $ln = explode(' ', base64_decode($_POST['sp']))[0];
                } elseif (count($names) > 2) {
                    $fn = $names[0] . ' ' . $names[1];
                    $ln = $names[2];
                }
            } else return 0;
            $init = 'select * from NINS where fName = "' . $fn . '"';
            $init = mysqli_query($con, $init);
            if (!$init) {
                $rest['err'] = mysqli_error($con);
            } else {
                if (mysqli_num_rows($init) == 0) {
                    $init = 'select * from NINS where fName = "' . $ln . '"';
                    $init = mysqli_query($con, $init);
                    if (!$init) {
                        $rest['err'] = mysqli_error($con);
                    } else {
                        if (mysqli_num_rows($init) >= 1) {
                            $init = 'select * from NINS where lName = "' . $fn . '"';
                            $init = mysqli_query($con, $init);
                            if (!$init) {
                                $rest['err'] = mysqli_error($con);
                            } else {
                                if (mysqli_num_rows($init) == 0) {
                                    $init = 'select * from NINS where lName = "' . $fn . '"';
                                    $init = mysqli_query($con, $init);
                                    if (!$init) {
                                        $rest['err'] = mysqli_error($con);
                                    } else {
                                        if (mysqli_num_rows($init) == 0)
                                            $rest['err'] = "Confirm Tenant Name entered in Search box";
                                        else {
                                            $data = mysqli_fetch_assoc($init);
                                            $nin = $data['NIN'];
                                            $tenDet = json_decode(curlpost('https://www.tmsystem.live/actions/getSpecTen.inc.php', 'POST', ['tNIN' => $nin]));

                                            $rest['data'] = $tenDet;
                                            $rest['_teninfo']['fn'] = $tenDet->names->fName;
                                            $rest['_teninfo']['fl'] = $tenDet->names->lName;
                                            $rest['_teninfo']['nin'] = $tenDet->names->nin;
                                            $rest['_teninfo']['cont_mobile'] = $tenDet->dets->contact_1 == '' ? $tenDet->dets->contact : $tenDet->dets->contact_1;
                                            $rest['_teninfo']['cont_home'] = $tenDet->dets->contact_2 == '' ? 'NULL' : $tenDet->dets->contact_2;
                                            $rest['_teninfo']['email'] = explode(':', $tenDet->dets->email)[1];
                                            if ($tenDet->dets->img != '')
                                                $rest['_teninfo']['img'] = $tenDet->dets->img;
                                            else
                                                $rest['_teninfo']['img'] = '/images/img_avatar2.png';
                                            $rest['_teninfo']['h_no'] = $tenDet->dets->house->hNo;
                                            $rest['_teninfo']['h_loc'] = $tenDet->dets->house->hLoc;
                                            $rest['_teninfo']['apm'] = $tenDet->dets->house->hApm;
                                            $rest['_teninfo']['water_m'] = $tenDet->dets->services->H2O_m;
                                            $rest['_teninfo']['water_c'] = $tenDet->dets->services->H2O_c;
                                            $rest['_teninfo']['yaka'] = $tenDet->dets->services->yaka;
                                        }
                                    }
                                } else {
                                    $data = mysqli_fetch_assoc($init);
                                    $nin = $data['NIN'];
                                    $tenDet = json_decode(curlpost('https://www.tmsystem.live/actions/getSpecTen.inc.php', 'POST', ['tNIN' => $nin]));

                                    $rest['data'] = $tenDet;
                                    $rest['_teninfo']['fn'] = $tenDet->names->fName;
                                    $rest['_teninfo']['fl'] = $tenDet->names->lName;
                                    $rest['_teninfo']['nin'] = $tenDet->names->nin;
                                    $rest['_teninfo']['cont_mobile'] = $tenDet->dets->contact_1 == '' ? $tenDet->dets->contact : $tenDet->dets->contact_1;
                                    $rest['_teninfo']['cont_home'] = $tenDet->dets->contact_2 == '' ? 'NULL' : $tenDet->dets->contact_2;
                                    $rest['_teninfo']['email'] = explode(':', $tenDet->dets->email)[1];
                                    if ($tenDet->dets->img != '')
                                        $rest['_teninfo']['img'] = $tenDet->dets->img;
                                    else
                                        $rest['_teninfo']['img'] = '/images/img_avatar2.png';
                                    $rest['_teninfo']['h_no'] = $tenDet->dets->house->hNo;
                                    $rest['_teninfo']['h_loc'] = $tenDet->dets->house->hLoc;
                                    $rest['_teninfo']['apm'] = $tenDet->dets->house->hApm;
                                    $rest['_teninfo']['water_m'] = $tenDet->dets->services->H2O_m;
                                    $rest['_teninfo']['water_c'] = $tenDet->dets->services->H2O_c;
                                    $rest['_teninfo']['yaka'] = $tenDet->dets->services->yaka;
                                }
                            }
                        } else {
                            $data = mysqli_fetch_assoc($init);
                            $nin = $data['NIN'];
                            $tenDet = json_decode(curlpost('https://www.tmsystem.live/actions/getSpecTen.inc.php', 'POST', ['tNIN' => $nin]));
                            $rest['_teninfo']['fn'] = $tenDet->names->fName;
                            $rest['_teninfo']['fl'] = $tenDet->names->lName;
                            $rest['_teninfo']['nin'] = $tenDet->names->nin;
                            $rest['_teninfo']['cont_mobile'] = $tenDet->dets->contact_1 == '' ? $tenDet->dets->contact : $tenDet->dets->contact_1;
                            $rest['_teninfo']['cont_home'] = $tenDet->dets->contact_2 == '' ? 'NULL' : $tenDet->dets->contact_2;
                            $rest['_teninfo']['email'] = explode(':', $tenDet->dets->email)[1];
                            if ($tenDet->dets->img != '')
                                $rest['_teninfo']['img'] = $tenDet->dets->img;
                            else
                                $rest['_teninfo']['img'] = '/images/img_avatar2.png';
                            $rest['_teninfo']['h_no'] = $tenDet->dets->house->hNo;
                            $rest['_teninfo']['h_loc'] = $tenDet->dets->house->hLoc;
                            $rest['_teninfo']['apm'] = $tenDet->dets->house->hApm;
                            $rest['_teninfo']['water_m'] = $tenDet->dets->services->H2O_m;
                            $rest['_teninfo']['water_c'] = $tenDet->dets->services->H2O_c;
                            $rest['_teninfo']['yaka'] = $tenDet->dets->services->yaka;
                        }
                    }
                } else {
                    if (mysqli_num_rows($init) >= 1) {
                        $init = 'select * from NINS where lName = "' . $ln . '"';
                        $init = mysqli_query($con, $init);
                        if (!$init) {
                            $rest['err'] = mysqli_error($con);
                        } else {
                            if (mysqli_num_rows($init) == 0) {
                                $init = 'select * from NINS where lName = "' . explode(' ', base64_decode($_POST['sp']))[1] . '"';
                                $init = mysqli_query($con, $init);
                                if (!$init) {
                                    $rest['err'] = mysqli_error($con);
                                } else {
                                    if (mysqli_num_rows($init) == 0)
                                        $rest['err'] = "Confirm Tenant Name entered in Search box";
                                    else {
                                        $data = mysqli_fetch_assoc($init);
                                        $nin = $data['NIN'];
                                        $tenDet = json_decode(curlpost('https://www.tmsystem.live/actions/getSpecTen.inc.php', 'POST', ['tNIN' => $nin]));

                                        $rest['data'] = $tenDet;
                                        $rest['_teninfo']['fn'] = $tenDet->names->fName;
                                        $rest['_teninfo']['fl'] = $tenDet->names->lName;
                                        $rest['_teninfo']['nin'] = $tenDet->names->nin;
                                        $rest['_teninfo']['cont_mobile'] = $tenDet->dets->contact_1 == '' ? $tenDet->dets->contact : $tenDet->dets->contact_1;
                                        $rest['_teninfo']['cont_home'] = $tenDet->dets->contact_2 == '' ? 'NULL' : $tenDet->dets->contact_2;
                                        $rest['_teninfo']['email'] = explode(':', $tenDet->dets->email)[1];
                                        if ($tenDet->dets->img != '')
                                            $rest['_teninfo']['img'] = $tenDet->dets->img;
                                        else
                                            $rest['_teninfo']['img'] = '/images/img_avatar2.png';
                                        $rest['_teninfo']['h_no'] = $tenDet->dets->house->hNo;
                                        $rest['_teninfo']['h_loc'] = $tenDet->dets->house->hLoc;
                                        $rest['_teninfo']['apm'] = $tenDet->dets->house->hApm;
                                        $rest['_teninfo']['water_m'] = $tenDet->dets->services->H2O_m;
                                        $rest['_teninfo']['water_c'] = $tenDet->dets->services->H2O_c;
                                        $rest['_teninfo']['yaka'] = $tenDet->dets->services->yaka;
                                    }
                                }
                            } else {
                                $data = mysqli_fetch_assoc($init);
                                $nin = $data['NIN'];
                                $tenDet = json_decode(curlpost('https://www.tmsystem.live/actions/getSpecTen.inc.php', 'POST', ['tNIN' => $nin]));
                                $rest['_teninfo']['fn'] = $tenDet->names->fName;
                                $rest['_teninfo']['fl'] = $tenDet->names->lName;
                                $rest['_teninfo']['nin'] = $tenDet->names->nin;
                                $rest['_teninfo']['cont_mobile'] = $tenDet->dets->contact_1 == '' ? $tenDet->dets->contact : $tenDet->dets->contact_1;
                                $rest['_teninfo']['cont_home'] = $tenDet->dets->contact_2 == '' ? 'NULL' : $tenDet->dets->contact_2;
                                $rest['_teninfo']['email'] = explode(':', $tenDet->dets->email)[1];
                                if ($tenDet->dets->img != '')
                                    $rest['_teninfo']['img'] = $tenDet->dets->img;
                                else
                                    $rest['_teninfo']['img'] = '/images/img_avatar2.png';
                                $rest['_teninfo']['h_no'] = $tenDet->dets->house->hNo;
                                $rest['_teninfo']['h_loc'] = $tenDet->dets->house->hLoc;
                                $rest['_teninfo']['apm'] = $tenDet->dets->house->hApm;
                                $rest['_teninfo']['water_m'] = $tenDet->dets->services->H2O_m;
                                $rest['_teninfo']['water_c'] = $tenDet->dets->services->H2O_c;
                                $rest['_teninfo']['yaka'] = $tenDet->dets->services->yaka;
                            }
                        }
                    } else {
                        $data = mysqli_fetch_assoc($init);
                        $nin = $data['NIN'];
                        $tenDet = json_decode(curlpost('https://www.tmsystem.live/actions/getSpecTen.inc.php', 'POST', ['tNIN' => $nin]));
                        $rest['_teninfo']['fn'] = $tenDet->names->fName;
                        $rest['_teninfo']['fl'] = $tenDet->names->lName;
                        $rest['_teninfo']['nin'] = $tenDet->names->nin;
                        $rest['_teninfo']['cont_mobile'] = $tenDet->dets->contact_1 == '' ? $tenDet->dets->contact : $tenDet->dets->contact_1;
                        $rest['_teninfo']['cont_home'] = $tenDet->dets->contact_2 == '' ? 'NULL' : $tenDet->dets->contact_2;
                        $rest['_teninfo']['email'] = explode(':', $tenDet->dets->email)[1];
                        if ($tenDet->dets->img != '')
                            $rest['_teninfo']['img'] = $tenDet->dets->img;
                        else
                            $rest['_teninfo']['img'] = '/images/img_avatar2.png';
                        $rest['_teninfo']['h_no'] = $tenDet->dets->house->hNo;
                        $rest['_teninfo']['h_loc'] = $tenDet->dets->house->hLoc;
                        $rest['_teninfo']['apm'] = $tenDet->dets->house->hApm;
                        $rest['_teninfo']['water_m'] = $tenDet->dets->services->H2O_m;
                        $rest['_teninfo']['water_c'] = $tenDet->dets->services->H2O_c;
                        $rest['_teninfo']['yaka'] = $tenDet->dets->services->yaka;
                    }
                }
            }
        } else if (base64_decode($_POST['t']) == 'cust_no') {
            $rest['_info'] = 'Provided Water Customer Number!';
            $init = 'select * from Services where water_cust_no = "' . base64_decode($_POST['sp']) . '"';
            $init = mysqli_query($con, $init);
            if (!$init) die(mysqli_error($con));
            if (mysqli_num_rows($init) == 0) {
                $rest['err'] = "The provided number doesn't belong to our premises!";
            } else {
                $init_data = mysqli_fetch_assoc($init);
                $nin_s = 'select * from tenant_details where house_id = "' . $init_data['service_id'] . '"';
                $nin_s = mysqli_query($con, $nin_s);
                if (!$nin_s) die(mysqli_error($con));
                if (mysqli_num_rows($nin_s) == 0) {
                    $rest['err'] = "Currently no tenant resides in the premise holding the provided number!";
                } else {
                    $nin_s_data = mysqli_fetch_assoc($nin_s);
                    $n = 'select * from NINS where NIN = "' . $nin_s_data['ten_nin'] . '"';
                    $n = mysqli_query($con, $n);
                    if (!$n) die(mysqli_error($con));
                    if (mysqli_num_rows($n) == 0)
                        $rest['err'] = "The tenant data has discrepancies that need to be corrected!";
                    else {
                        $img = mysqli_fetch_assoc(mysqli_query($con, 'select ten_img_location, ten_img_name from tenant_images where ten_img_location = "' . $nin_s_data['ten_img_id']));
                        $house = mysqli_fetch_assoc(mysqli_query($con, 'select * from house_info where house_id = "' . $init_data['service_id'] . '"'));
                        $data = mysqli_fetch_assoc($n);
                        $rest['_teninfo']['fn'] = $data['fName'];
                        $rest['_teninfo']['fl'] = $data['lName'];
                        $rest['_teninfo']['nin'] = $data['NIN'];
                        $rest['_teninfo']['cont_mobile'] = $tenDet->dets->contact_1 == '' ? $tenDet->dets->contact : $tenDet->dets->contact_1;
                        $rest['_teninfo']['cont_home'] = $tenDet->dets->contact_2 == '' ? 'NULL' : $tenDet->dets->contact_2;
                        $rest['_teninfo']['email'] = $nin_s_data['ten_email'];
                        if ($img != null)
                            $rest['_teninfo']['img'] = $img['ten_img_location'] . $img['ten_img_name'];
                        else
                            $rest['_teninfo']['img'] = '/images/img_avatar2.png';
                        $rest['_teninfo']['h_no'] = $house['house_number'];
                        $rest['_teninfo']['h_loc'] = $house['house_location'];
                        $rest['_teninfo']['apm'] = $house['amt_per_mth'];
                        $rest['_teninfo']['water_m'] = $init_data['water_meter_no'];
                        $rest['_teninfo']['water_c'] = $init_data['water_cust_no'];
                        $rest['_teninfo']['yaka'] = $init_data['Umeme_no'];
                    }
                }
            }
        } else if (base64_decode($_POST['t']) == 'ten_nin') {
            $rest['_info'] = 'Provided National ID Number!';
            $nin = base64_decode($_POST['sp']);
            $tenDet = json_decode(curlpost('https://www.tmsystem.live/actions/getSpecTen.inc.php', 'POST', ['tNIN' => $nin]));
            if (isset($tenDet->msg)) {
                $rest['err'] = $tenDet->msg;
            } else {
                $rest['_teninfo']['fn'] = $tenDet->names->fName;
                $rest['_teninfo']['fl'] = $tenDet->names->lName;
                $rest['_teninfo']['nin'] = $tenDet->names->nin;
                $rest['_teninfo']['cont_mobile'] = $tenDet->dets->contact_1 == '' ? $tenDet->dets->contact : $tenDet->dets->contact_1;
                $rest['_teninfo']['cont_home'] = $tenDet->dets->contact_2 == '' ? 'NULL' : $tenDet->dets->contact_2;
                $rest['_teninfo']['email'] = count(explode(':', $tenDet->dets->email)) > 1 ? explode(':', $tenDet->dets->email)[1] : $tenDet->dets->email;
                if ($tenDet->dets->img != '')
                    $rest['_teninfo']['img'] = $tenDet->dets->img;
                else
                    $rest['_teninfo']['img'] = '/images/img_avatar2.png';
                $rest['_teninfo']['h_no'] = $tenDet->dets->house->hNo;
                $rest['_teninfo']['h_loc'] = $tenDet->dets->house->hLoc;
                $rest['_teninfo']['apm'] = $tenDet->dets->house->hApm;
                $rest['_teninfo']['water_m'] = $tenDet->dets->services->H2O_m;
                $rest['_teninfo']['water_c'] = $tenDet->dets->services->H2O_c;
                $rest['_teninfo']['yaka'] = $tenDet->dets->services->yaka;
            }
        } else if (base64_decode($_POST['t']) == 'yaka_no') {
            $yaka = base64_decode($_POST['sp']);
            $init = 'select * from Services where Umeme_no = "'.$yaka.'"';
            $init = mysqli_query($con, $init);
            if(!$init) die(mysqli_error($con));
            if(mysqli_num_rows($init) == 0) $rest['err'] = "The provided Yaka meter number doesn't belong to our premises!";
            else {
                $data = mysqli_fetch_assoc($init)['service_id'];
            }
            $rest['_info'] = 'Provided YAKA Meter Number!';
        } else if (base64_decode($_POST['t']) == 'house_num') {
            $rest['_info'] = 'Provided House Number!';
            $hno = base64_decode($_POST['sp']);
            $init = mysqli_query($con, "select house_id from house_info where house_number = '$hno'");
            $init = !$init ? die(mysqli_error($con)) : mysqli_fetch_assoc($init)['house_id'];
            $nin = mysqli_query($con, "select ten_nin from tenant_details where house_id = '$init'");
            $nin = !$nin ? die(mysqli_error($con)) : mysqli_fetch_assoc($nin)['ten_nin'];
            $tenDet = json_decode(curlpost('https://www.tmsystem.live/actions/getSpecTen.inc.php', 'POST', ['tNIN' => $nin]));
            if (isset($tenDet->msg)) {
                $rest['err'] = $tenDet->msg;
            } else {
                $rest['_teninfo']['fn'] = $tenDet->names->fName;
                $rest['_teninfo']['fl'] = $tenDet->names->lName;
                $rest['_teninfo']['nin'] = $tenDet->names->nin;
                $rest['_teninfo']['cont_mobile'] = $tenDet->dets->contact_1 == '' ? $tenDet->dets->contact : $tenDet->dets->contact_1;
                $rest['_teninfo']['cont_home'] = $tenDet->dets->contact_2 == '' ? 'NULL' : $tenDet->dets->contact_2;
                $rest['_teninfo']['email'] = explode(':', $tenDet->dets->email)[1];
                if ($tenDet->dets->img != '')
                    $rest['_teninfo']['img'] = $tenDet->dets->img;
                else
                    $rest['_teninfo']['img'] = '/images/img_avatar2.png';
                $rest['_teninfo']['h_no'] = $tenDet->dets->house->hNo;
                $rest['_teninfo']['h_loc'] = $tenDet->dets->house->hLoc;
                $rest['_teninfo']['apm'] = $tenDet->dets->house->hApm;
                $rest['_teninfo']['water_m'] = $tenDet->dets->services->H2O_m;
                $rest['_teninfo']['water_c'] = $tenDet->dets->services->H2O_c;
                $rest['_teninfo']['yaka'] = $tenDet->dets->services->yaka;
            }
        }
    }
}
echo json_encode($rest);

function curlpost($url = '', $type = 'POST', $data = NULL)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if (!empty($data)) {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    }
    $response = curl_exec($ch);
    if (curl_error($ch)) {
        trigger_error('Curl Error: ' . curl_error($ch));
    }

    curl_close($ch);
    // echo "<script>console.log('".$response."')</script>";
    // print_r($response);
    return $response;
}
