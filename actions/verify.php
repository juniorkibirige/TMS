<?php
include('../includes/db.inc.php');
if(isset($_GET['id']) && !empty($_GET['id'])){    
    ?>
    <div class="col-md-12 col-xs-12 alert alert-info tms-center" style="margin-left:10px">
    <?php
    $verify = 'update accounts set confirm = 1 where id = "'.$_GET['id'].'"';
    $sql = mysqli_query($con, $verify);
    if(!$sql){
        die('Error:'.mysqli_error($con));
    } else {
        $data = 'select NIN, level from accounts where id = '.$_GET['id'];
        $data = mysqli_query($con,$data);
        $row = mysqli_fetch_assoc($data);
        $sqls = 'select fName, lName from NINS where NIN = "'.$row['NIN'].'"';
        $sqld = mysqli_query($con,$sqls);
        if(!$sqld) die('Error:'.mysqli_error($con));
        $result = mysqli_fetch_assoc($sqld);
        echo '';
        if($row['level'] == 1){
            echo $result['fName'].' '.$result['lName'].' has been verified as a Manager';
        }else if($row['level'] == 2){
            echo $result['fName'].' '.$result['lName'].' has been verified as a Cashier';
        } else if($row['level'] == 3){
            echo $result['fName'].' '.$result['lName'].' has been verified as a Trainer';
        } else if($row['level'] == 4){
            echo $result['fName'].' '.$result['lName'].' has been verified as a Clientele';
        }
    }
    ?>
    </div><?php
?>
<?php
}else{
?>
<div class="container contain alert alert-danger tms-center" style="padding-top:50px">
No data provided.
</div>
<?php
}
?>