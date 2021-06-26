<?php
include 'db.inc.php';
global $con;
$data = [];
$mysql = "select `house_id`, `rentedBy` from `rentals_info` where `isRented` = true;";
$mysql = mysqli_query($con, $mysql);
if ($mysql != false)
    if (mysqli_num_rows($mysql) > 0) {
        while ($result = mysqli_fetch_assoc($mysql)) {
            $data_object = [];
            $house_id = $result['house_id'];
            $house_renter_id = $result['rentedBy'];
//            echo mb_strtoupper($result['rentedBy'])."\n";
            $house_det_mysql = "select `house_number`, `house_location` from `house_info` where `house_id` = $house_id";
            $house_det = mysqli_fetch_assoc(mysqli_query($con, $house_det_mysql));
            $data_object['house_no'] = $house_det['house_number'];
            $data_object['house_loc'] = $house_det['house_location'];
            $renter_det_mysql = "select `NIN`, `fName`, `lName` from `NINS` where `NIN` = '$house_renter_id'";
            $renter_det = mysqli_fetch_assoc(mysqli_query($con, $renter_det_mysql));
            $data_object['nin'] = $renter_det['NIN'];
            $data_object['first_name'] = $renter_det['fName'];
            $data_object['last_name'] = $renter_det['lName'];
            $data_object['in_debt'] = rand(0, 2);
            array_push($data, $data_object);
        }

    }
?>
<style>
    th:not(:nth-of-type(0)) {
        border-left: #2e3133 !important;
    }
</style>
<div class="row">
    <div class="col-xs-12 col-md-7 col-lg-12">
        <div class="panel panel-default credit-card-box">
            <div class="panel-heading display-table" style="width:100%">
                <h3 class="panel-title display-td tms-center">Tenants List</h3>
            </div>
            <div class="panel-body">
                <form action="javascript:void(0)" method="post" id="filter_tenant_list_table" class="filter_form"
                      role="form">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group" style="float: right">
                                <label for="filter_names" style="font-size: 12px">
                                    Filter:
                                    <span class="alert-error filter_names"
                                          style="color:red; display: none;"></span>
                                </label>
                                <div class="form-group" style="position: relative;">
                                    <input type="text" name="filter_names" id="filter_names" class="form-control"
                                           placeholder="Search Criteria" autocomplete="false"
                                           required="required" autofocus="autofocus">
                                    <i class="fa fa-search" id="filter_search_submit"
                                       style="position: absolute; right: 8px; top: 10px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <table class="table-striped table-hover .table-responsive panel panel-default credit-card-box" style="width: 100%; table-layout: auto"
                       border="1px #ddd solid">
                    <thead class="panel-heading display-table">
                    <tr>
                        <th class="d-none d-md-table-cell" style="text-align: left; padding: 10px 10px 4px 10px;">No.</th>
                        <th style="text-align: center; padding: 10px 10px 4px 10px;">NIN</th>
                        <th style="text-align: left; padding: 10px 10px 4px 10px;">First Name</th>
                        <th style="text-align: left; padding: 10px 10px 4px 10px;">Last Name</th>
                        <th class="d-none d-md-table-cell" style="text-align: center; padding: 10px 10px 4px 10px;">House #</th>
                        <th class="d-none d-md-table-cell" style="text-align: left; padding: 10px 10px 4px 10px;">Location</th>
                        <th class="d-none d-md-table-cell" style="text-align: center; padding: 10px 10px 4px 10px;">In Debt</th>
                    </tr>
                    </thead>
                    <tbody class="panel-body">
                    <?php
                    $i = 1;
                    foreach ($data as $info) {
                        echo "<tr>";
                        echo "<td class='d-none d-md-table-cell' style='text-align: center; padding: 10px 10px 4px 10px;'>";
                        echo $i++;
                        echo"</td>";
                        echo "<td style='text-align: center; padding: 10px 10px 4px 10px;'><a href='/man?nin=".$info['nin']."#tenants'>";
                        echo $info['nin'];
                        echo '</a></td>';
                        echo '<td style="text-align: left; padding: 10px 10px 4px 10px;">';
                        echo $info['first_name'];
                        echo "</td>";
                        echo '<td style="text-align: left; padding: 10px 10px 4px 10px;">';
                        echo $info['last_name'];
                        echo "</td>";
                        echo "<td class='d-none d-md-table-cell' style='text-align: center; padding: 10px 10px 4px 10px;'>";
                        echo $info['house_no'];
                        echo "</td>";
                        echo '<td class="d-none d-md-table-cell" style="text-align: left; padding: 10px 10px 4px 10px;">';
                        echo $info['house_loc'];
                        echo "</td>";
                        $color = $info["in_debt"] ? "green" : "red";
                        echo "<td class='d-none d-md-table-cell' style='text-align: center; background-color: $color; color: whitesmoke; padding: 10px 10px 4px 10px;'>";
                        echo $info['in_debt'] ? "true" : "false";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--</div>-->
<script>
    $('#filter_names').on('keyup', _ => {
        const fValue = _.target.value
        if (fValue.length > 0) {
            console.log(fValue)
        }
    })
</script>