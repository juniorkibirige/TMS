<?php
require_once('db.inc.php');
// A file that holds all functions used in the tenants Dashboard
// for all calculations.
function monthname($var){
    $month_name = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    return $month_name[$var];    
}

function monthdays($var) {
    $month_days = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    return $month_days[$var];
}
// function get_months_paid_left($nin, $con, $month_name)
// {
//     $s = mysqli_query($con, 'select * from pay_info where ten_nin = "' . $nin . '"');
//     if (mysqli_num_rows($s) == 0) {
//         $ml = array();
//         $ml[0] = 'No payments made yet';
//     } else {
//         $data = mysqli_fetch_assoc($s);
//         // var_dump($data);
//         $ml = array();
//         $mlp = $data['month_last_paid'];
//         $mpl = intval($data['mths_paid_left']);
//         $mp4 = intval($data['mths_pd_for']);
//         $ylp = $data['year_last_paid'];
//         $mlp4 = intval($data['last_mth_pd_for']);
//         $cm = (mysqli_fetch_assoc(mysqli_query($con, 'select MONTH(NOW()) limit 1')))['MONTH(NOW())'];
//         $cy = mysqli_fetch_assoc(mysqli_query($con, 'select YEAR(NOW()) limit 1'))['YEAR(NOW())'];

//         if ($ylp == $cy) {
//             if ($mlp <= $cm) {
//                 if ($mpl != 0) {
//                     if ($mlp4 < $cm) {
//                         return ['You have rent arrears!'];
//                     } else if ($cm == $mlp4) {
//                         return [$month_name[$cm - 1]];
//                     } else {
//                         if ($mpl != 0) {
//                             $MPL = $mpl;
//                             $CM = $cm;
//                             if ($mpl > 1) {
//                                 $count = 1;
//                                 while ($MPL != 0) {
//                                     if ($CM < 12) {
//                                         $ml[$count] = $month_name[$CM];
//                                         $CM++;
//                                         $count++;
//                                     } else {
//                                         $CM = 0;
//                                         $ml[$count] = $month_name[$CM];
//                                         $CM++;
//                                         $count++;
//                                     }
//                                     $MPL--;
//                                 }
//                             }
//                         }
//                     }
//                 }
//             }
//         }
//         mysqli_query($con, 'update pay_info set mths_paid_left = "' . $mpl . '" where ten_nin = "' . $nin . '"');
//     }
//     return $ml;
// }

// function get_days_left_to_end_of_paid_period($nin, $con, $month_days)
// {
//     $s = mysqli_query($con, 'select * from pay_info where ten_nin = "' . $nin . '"');
//     // $DL = 12;
//     if (mysqli_num_rows($s) == 0) {
//         $DL = 'No payments made yet';
//     } else {
//         $data = mysqli_fetch_assoc($s);
//         $DL = 0;
//         $mlp = $data['month_last_paid'];
//         $mpl = intval($data['mths_paid_left']);
//         $mlp4 = $data['last_mth_pd_for'];
//         $ylp = $data['year_last_paid'];
//         $dl = $data['days_left'];
//         $cm = (mysqli_fetch_assoc(mysqli_query($con, 'select MONTH(NOW()) limit 1')))['MONTH(NOW())'];
//         $cy = mysqli_fetch_assoc(mysqli_query($con, 'select YEAR(NOW()) limit 1'))['YEAR(NOW())'];
//         $cd = (mysqli_fetch_assoc(mysqli_query($con, 'select DAY(NOW()) limit 1')))['DAY(NOW())'];
//         if ($ylp == $cy) {
//             if ($mlp4 < $cm) {
//                 mysqli_query($con, 'update pay_info set days_left = 0 where ten_nin = "' . $nin . '"');
//                 return 'You have rent arrears!';
//             } else if ($cm == $mlp4) {
//                 $DL = $month_days[$cm - 1] - $cd;
//                 mysqli_query($con, 'update pay_info set days_left = ' . $DL . ' where ten_nin = "' . $nin . '"');
//                 return $month_days[$cm - 1] - $cd;
//             } else {
//                 if ($mlp <= $cm) {
//                     $DL = $DL + ($month_days[$cm - 1] - $cd);
//                     $MPL = $mpl;
//                     $CM = $cm;
//                     if ($mpl > 1) {
//                         $count = 1;
//                         while ($MPL != 0) {
//                             if ($CM < 12) {
//                                 $DL = $DL + $month_days[$CM];
//                                 $CM++;
//                                 $count++;
//                             } else {
//                                 $CM = 0;
//                                 $DL = $DL + $month_days[$CM];
//                                 $CM++;
//                                 $count++;
//                             }
//                             $MPL--;
//                         }
//                     }
//                 }
//             }
//         }
//     }
//     mysqli_query($con, 'update pay_info set days_left = ' . $DL . ' where ten_nin = "' . $nin . '"');
//     return $DL;
// }

// function get_unpaid_mths($con, $nin) {
//     $s = mysqli_query($con, 'select * from pay_info where ten_nin = "' . $nin . '"');
//     $d = mysqli_fetch_assoc($s);
//     $cm = (mysqli_fetch_assoc(mysqli_query($con, 'select MONTH(NOW()) limit 1')))['MONTH(NOW())'];
//     $mlp4 = $d['last_mth_pd_for'];
//     return $mlp4;
// }

// function get_outstanding_balance($nin, $con)
// {
//     $s = mysqli_query($con, 'select * from pay_info where ten_nin = "' . $nin . '"');
//     $d = mysqli_query($con, 'select * from defaulters_rent where ten_nin = "' . $nin . '"');
//     $cm = (mysqli_fetch_assoc(mysqli_query($con, 'select MONTH(NOW()) limit 1')))['MONTH(NOW())'];
//     $cy = mysqli_fetch_assoc(mysqli_query($con, 'select YEAR(NOW()) limit 1'))['YEAR(NOW())'];
//     $cd = (mysqli_fetch_assoc(mysqli_query($con, 'select DAY(NOW()) limit 1')))['DAY(NOW())'];
//     if (mysqli_num_rows($d) == 0) {
//         $ad = 'No outstanding balance';
//     } else {
//         $data = mysqli_fetch_assoc($d);
//         $fm = $data['for_mth'];
//         $ad = $data['amt_defaulted'];
//         if($fm < $cm) {
//             $um = get_unpaid_mths($con, $nin);
//             echo $um;
//         }
//     }
//     if (mysqli_num_rows($s) == 0) {
//         $DL = isset($ad) ? $ad : 'No payments made yet';
//     } else {
//         $data = mysqli_fetch_assoc($s);
//         // var_dump($data);
//         $DL = 0;
//         $mlp = $data['month_last_paid'];
//         $mpl = intval($data['mths_paid_left']);
//         $ylp = $data['year_last_paid'];
//         $dl = $data['days_left'];
//         $cm = (mysqli_fetch_assoc(mysqli_query($con, 'select MONTH(NOW()) limit 1')))['MONTH(NOW())'];
//         $cy = mysqli_fetch_assoc(mysqli_query($con, 'select YEAR(NOW()) limit 1'))['YEAR(NOW())'];
//         $cd = (mysqli_fetch_assoc(mysqli_query($con, 'select DAY(NOW()) limit 1')))['DAY(NOW())'];
//     }
//     return $DL;
// }
// echo get_outstanding_balance('00000000tendo1', $con);
$p_info = 'select * from pay_info where ten_nin = "' . $_SESSION['id'] . '"';
$p_info = mysqli_query($con, $p_info);
$cur_mth = (mysqli_fetch_assoc(mysqli_query($con, 'select MONTH(NOW()) limit 1')))['MONTH(NOW())'];
if (mysqli_num_rows($p_info) != 0) {
    $pay_info = mysqli_fetch_assoc($p_info);
    $mpl = intval($pay_info['month_last_paid']);
    $mlp = intval($pay_info['mths_paid_left']);
    $num_days = monthdays($cur_mth);
    $mthspd = array();
    $cur_day = (mysqli_fetch_assoc(mysqli_query($con, 'select DAY(NOW()) limit 1')))['DAY(NOW())'];
    $days_left = $num_days - intval($cur_day);
    $count = 1;
    $mth = $cur_mth;
    if (intval($mpl) < intval($cur_mth)) {
        $mths_pd_left = -($mlp - (intval($cur_mth) - intval($mpl))) + 1;
        $mdata = -($mlp - (intval($cur_mth) - intval($mpl)));
        if ($mlp > 0) {
            while ($mths_pd_left > 0) {
                if ($mth > 12) {
                    $mth = 1;
                    $mthspd[$count] = monthname($mth);
                    if ($mth != $cur_mth) $days_left += monthdays($mth);
                    $mth += 1;
                } else {
                    $mthspd[$count] = monthname($mth);
                    if ($mth != $cur_mth) $days_left += monthdays($mth);
                    $mth += 1;
                }
                $count++;
                $mths_pd_left--;
            }
            $mths_pd = implode(", ", $mthspd);
            mysqli_query($con, 'update pay_info set mths_paid_left = "' . $mdata . '" where ten_nin = "' . $_SESSION['id'] . '"');
            mysqli_query($con, 'update pay_info set days_left = ' . $days_left . ' where ten_nin = "' . $_SESSION['id'] . '"');
            $days_left = $days_left;
        } else {
            $d =  intval($cur_mth) - intval($mpl);
            $df = mysqli_query($con, 'select * from defaulters_rent where ten_nin = "' . $_SESSION['id'] . '"');
            if (mysqli_num_rows($df) != 0) {
                $de = mysqli_fetch_assoc($df);
                if (intval($de['for_mth']) != intval($cur_mth)) {
                    $amt_def = $de['amt_defaulted'] + intval($rpm * $d);
                    mysqli_query($con, 'update defaulters_rent set amt_defaulted ="' . intval($amt_def) . '" where ten_nin = "' . $_SESSION['id'] . '"');
                    mysqli_query($con, 'update defaulters_rent set for_mth ="' . intval($cur_mth) . '" where ten_nin = "' . $_SESSION['id'] . '"');
                }
            } else {
                $def = mysqli_query($con, 'insert into defaulters_rent (ten_nin, amt_defaulted, for_mth) values("' . $_SESSION['id'] . '","' . $d * $rpm . '", "' . $cur_mth . '")');
                echo mysqli_error($con);
            }
            $mths_pd = 'You have rent arrears!';
            $days_left = 'You have rent arrears!';
            $def_amt = mysqli_fetch_assoc(mysqli_query($con, 'select * from defaulters_rent where ten_nin = "' . $_SESSION['id'] . '"'))['amt_defaulted'];
        }
    } else {
        $num_days = monthdays($cur_mth);
        $mthspd = array();
        $cur_day = (mysqli_fetch_assoc(mysqli_query($con, 'select DAY(NOW()) limit 1')))['DAY(NOW())'];
        $days_left = $num_days - intval($cur_day);
        $mths_pd_left = 0;
        $count = 1;
        $mth = intval($cur_mth);
        while ($mths_pd_left > 0) {
            if ($mth > 12) {
                $mth = 1;
                $mthspd[$count] = monthname($mth);
                if ($mth != $cur_mth) $days_left += monthdays($mth);
                $mth += 1;
            } else {
                $mthspd[$count] = monthname($mth);
                if ($mth != $cur_mth) $days_left += monthdays($mth);
                $mth += 1;
            }
            $count++;
            $mths_pd_left--;
        }
        $mths_pd = $mths_pd_left;
        // mysqli_query($con, 'update pay_info set mths_paid_left = "' . abs((intval($cur_mth) - intval($mpl)) - $pay_info["mths_paid_left"]) . '" where ten_nin = "' . $_SESSION['id'] . '"');
        mysqli_query($con, 'update pay_info set days_left = ' . $days_left . ' where ten_nin = "' . $_SESSION['id'] . '"');
    }
    mysqli_query($con, 'update pay_info set current_month = "' . $cur_mth . '"');
    mysqli_query($con, 'update pay_info set current_year = "' . (mysqli_fetch_assoc(mysqli_query($con, 'select YEAR(NOW()) limit 1')))['YEAR(NOW())'] . '"');
} else {
    $mths_pd = "No data";
    $days_left = "No data";
    $def_amt = "No data";
}
